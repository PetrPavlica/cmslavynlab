<?php

class PeopleDetail extends Nette\Application\UI\Control
{
    private $peopleData;
    public $id;
    public $pozition = array(1=>'Super admin',
                             2=>'Admin',
                             3=>'Obchodní zástupce');
    
    public function __construct(App\Model\PeopleModel $peopleData,$id)
    {
        $this->peopleData = $peopleData;
        $this->id = $id;
    }
    
    public function render():void{
        $this->template->people = $this->peopleData->peopleById($this->id);
        $this->template->people_inf = $this->peopleData->peopleInfById($this->id);
        $this->template->pozition = $this->pozition;
        $this->template->render(__DIR__ .'/peopledetail.latte');
    }
}
interface IPeopleDetailFactory
{
    /** @return \PeopleDetail */
    function create($id): PeopleDetail;
}
