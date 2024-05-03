<?php

class PeopleComponent extends Nette\Application\UI\Control
{
    private $peopleData;
    public $ids;
    public $onpage=1;
    public $orderby='name';
    
    public function __construct(App\Model\PeopleModel $peopleData,$ids)
    {
        $this->peopleData = $peopleData;
        $this->ids = $ids;
    }
    
    public function handlepeoplepage($onpage){
        $this->onpage = $onpage;
    }
    
    public function handleorderby($orderby){
        $this->orderby = $orderby;
    }
    
    public function render():void{
        bdump($this->ids);
        $paginator = new Nette\Utils\Paginator;
        $paginator->setPage($this->onpage); // číslo aktuální stránky
        $paginator->setItemsPerPage(5); // počet položek na stránce
        $paginator->setItemCount($this->peopleData->allUsersCount()); // celkový počet položek, je-li znám
        $lenght = $paginator->getLength();
	$offset = $paginator->getOffset();
        if($this->ids == null){
            $allUsers = $this->peopleData->allUsers($lenght,$offset, $this->orderby);
            bdump($allUsers);
        }
        else{
            $allUsers = $this->peopleData->getInIds(explode(',',$this->ids));
        }
        
        
        $this->template->paginator = $paginator;
        $this->template->allUsers = $allUsers;
        $this->template->render(__DIR__ .'/people.latte');
    }
}

/** creator */
interface IPeopleFactory
{
    /** @return \PeopleComponent */
    function create($ids): PeopleComponent;
}

