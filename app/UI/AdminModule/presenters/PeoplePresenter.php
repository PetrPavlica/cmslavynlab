<?php

namespace App\UI\AdminModule\Presenters;

class PeoplePresenter extends BasePresenter{
    
    /** @var \IUserFormFactory @inject */
    public $userFormControl;
    
    /** @var \IPeopleDetailFactory @inject */
    public $peopleDetailControl;
    
    /** @var \IPeopleFactory @inject */
    public $peopleControl;
    
    /** @var \IPeopleInfFormFactory @inject */
    public $peopleInfFormControl;
    
    protected function createComponentPeople(): \PeopleComponent {
        
        $component = $this->peopleControl->create($this->getParameter('ids'));
        
        return $component;
    }
    
    protected function createComponentPeopleDetail(): \PeopleDetail {
        
        $component = $this->peopleDetailControl->create($this->getParameter('id'));
        
        return $component;
    }
    
    protected function createComponentUserForm(): \UserForm {
        
        $component = $this->userFormControl->create($this->getParameter('wwwDir'));
        $component->onUserFormSave[] = function ($data) {
                    $this->redirect('People:peopleinf',$data['id']);
		};
        return $component;
    }
    
    
    protected function createComponentPeopleInfForm(): \PeopleInfForm {
        
        $component = $this->peopleInfFormControl->create($this->getParameter('wwwDir'),$this->getParameter('id'));
        return $component;
    }
    
        
    public function renderPeopleInf($id):void{
        
        
    }
    
    public function renderPeople($ids):void{
        $this->template->action = $this->getParameter('do');
    }
    
     public function renderPeopleDetail($id):void{
        $this->template->do = $this->getParameter('do');
    }
}