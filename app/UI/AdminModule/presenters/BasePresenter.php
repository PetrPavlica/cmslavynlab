<?php
namespace App\UI\AdminModule\Presenters;
use Nette;
use Nette\Security\User;

class BasePresenter extends \Nette\Application\UI\Presenter {
   
       
   public function startup() {
       parent::startup();
       /*     if(!$this->user->isLoggedIn() or $this->user->getId() == 0){
               $this->flashMessage('Neplatné jméno nebo heslo.');
               $this->redirect('Start:default');
           } */
   }   
   public function beforeRender() {
        $this->setLayout('layoutSignAdmin');
              
   }
   
   public function handlelogout() {
      $this->user->logout();
      $this->redirect('Start:default');
   }     
}     

