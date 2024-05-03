<?php

use Nette\Security\User;
    
class SignForm extends Nette\Application\UI\Control
{
	private $database;

	public $onSignSave;
        
           
        /** @var User */
	private $user;
        
	public function __construct(App\Model\SignModel $database,User $user)
	{
		$this->database = $database;
                $this->user = $user;
	}

	protected function createComponentSignForm()
	{
		$form = new Nette\Application\UI\Form;
		$form->addText('email','Email');
                $form->addPassword('password','Heslo');
		$form->addSubmit('send', 'Odeslat');
		$form->onSuccess[] = [$this, 'processForm'];

		return $form;
	}

	public function processForm($form)
	{
                $values = $form->getValues('array');
                $this->user->setExpiration('20 minutes');
                $this->user->login($values['email'], $values['password']);
		$this->onSignSave();
	}


        public function render(){
             
              $template = $this->template;
              $template->setFile(__DIR__ . '/sign.latte');
              $this->template->render();
        }
}

/** rozhraní pro generovanou továrničku */
interface ISignFormFactory
{
	/** @return \SignForm */
	function create() : SignForm;
}
