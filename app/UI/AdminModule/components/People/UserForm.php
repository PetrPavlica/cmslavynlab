<?php

class UserForm extends Nette\Application\UI\Control
{
    private $peopleData;
    
    private $factory;
    private $passwords;
    private $pozition = ['admin'=>'admin'];
    public $onUserFormSave;
    
    private $id=0;
    public $action = 'new';     
   
    public function __construct(Nette\Security\Passwords $passwords,App\Model\PeopleModel $peopleData,\App\Forms\FormFactory $factory)
    {
        $this->passwords = $passwords;
        $this->peopleData = $peopleData;
        $this->factory = $factory;
    }
    
    public function handlenext($id){
        $this->redirect('PeopleInfForm:edit!');
    }
    
    public function handleedit($id){
        $data_default = $this->peopleData->peopleById($id);
        $data_default_array = $data_default->toArray();
        $data_default_array['action']='edit';
        $this['peopleForm']->setDefaults($data_default_array);
        $this->id = $id;
        $this->action = 'edit';
    }
    
    public function handleblock($id){
        $this->id = $id;
        $this->peopleData->updateUser($id, ['active'=>0]);
        $this->action = 'block';
    }
    public function handleunblock($id){
        $this->id = $id;
        $this->peopleData->updatePeople($id, ['active'=>1]);
        $this->action = 'block';
    }

    
    public function createComponentPeopleForm() 

    {
        $form = $this->factory->create();
        
        $form->addText('name','Jméno:')
                        ->setRequired('Zadejte jméno');
        $form->addSelect('pozition','Pozice:',$this->pozition)
                        ->setRequired('Zadejte pozici');
                
        $form->addText('phone','Telefon:')
                        ->setRequired('Zadejte telefon');
        
        $form->addText('email','Email:')
                        ->setRequired('Zadejte email');
        
        $form->addText('password','Heslo:')
                        ->setRequired('Zadejte heslo');
                
        $form->addHidden('id',$this->id);
        $form->addHidden('action',$this->action);
        
        $form->addSubmit('send', 'Uložit')
        ->setAttribute('class', 'btn btn-info btn-sm');   

       
        $form->onSuccess[] = [$this, 'processForm'];
        return $form;
    }

    public function processForm($form)
    {
             
        $data = $form->getValues(); 
        unset($data['action']);
        unset($data['id']);
        if($form['action']->getValue() == 'edit'){
          //$user_id = $this->peopleData->getUserId($people_id);  
          $this->peopleData->updateUser($form['id']->getValue(),$data);
          $save = ['id'=>$form['id']->getValue()];
          $this->flashMessage('Updated');
          
        }
        else{
            $data['password'] = $this->passwords->hash($form['password']->getValue());
            $save = $this->peopleData->addUser($data);
            $this->peopleData->addUser($data);
            $this->flashMessage('Uloženo');
        }
        $this->onUserFormSave($save);
        
    }
    
    public function render(){
       $this->template->render(__DIR__ .'/userform.latte');
    }
}

/** rozhrannĂ­ pro generovanou tovĂˇrniÄŤku */
interface IUserFormFactory
{
    /** @return \UserForm */
    function create(): UserForm;
}
