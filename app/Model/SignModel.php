<?php
namespace App\Model;

use Nette;

class SignModel implements Nette\Security\IAuthenticator
{
	private $database;
	private $passwords;

	public function __construct(Nette\Database\Context $database, Nette\Security\Passwords $passwords)
	{
		$this->database = $database;
		$this->passwords = $passwords;
	}

	public function authenticate(array $credentials): Nette\Security\IIdentity
	{
		
		$row = $this->database->table('user')
			->where('email', $credentials[0])
			->fetch();

		if (!$row) {
			new Nette\Security\AuthenticationException('User not found.');
                        
		}

		if (!$this->passwords->verify($credentials[1], $row->password)) {
			new Nette\Security\AuthenticationException('Invalid password.');
                        return new Nette\Security\Identity(
			0,
                        );
		}
                
		return new Nette\Security\Identity(
			$row->user_information_id,
                        $row->pozition,
                        ['name' => $row->email]
                        );
                
	}
}
