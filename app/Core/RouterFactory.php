<?php

declare(strict_types=1);

namespace App\Core;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;
                $admin = new RouteList('Admin');
		$admin->addRoute('[<locale=cs cs|en>/]admin/<presenter>/<action>[/<id>]', 'People:people');
                $router[] = $admin;
                
		return $router;
	}
}
