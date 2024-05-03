<?php
namespace App\Model;

use Nette\Database\Context;
use Nette\Security\User;

/**
 * Základní třída modelu pro všechny modely aplikace.
 * Předává přístup k práci s databází a userem.
 * @package App\Model
 */
abstract class BaseModel
{              
        /** @var Context Instance třídy pro práci s databází. */
        protected $database;
        protected $user;
        /**
         * Konstruktor s injektovanou třídou pro práci s databází.
         * @param Context $database automaticky injektovaná třída pro práci s databází
         */
        public function __construct(Context $database, User $user)
        {
                $this->database = $database;
                $this->user = $user;
        }
        
}