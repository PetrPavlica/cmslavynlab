<?php

namespace App\Model;

class PeopleModel extends BaseModel{
    
    public function allUsers($limit,$offset,$orderby) {
       return $this->database->table('user')->fetchAll();
    }
    
    public function allUsersCount() {
       return $this->database->table('user_information')->count();
    }
    
     public function addUser($data){
        return $this->database->table('user')->insert($data);
    }
    
     public function addPeopleInf($data){
        return $this->database->table('people_information')->insert($data);
    }
    
    public function updateUser($id,$data){
        $select =  $this->database->table('people')->where('id',$id)->fetch();
        return $select->update($data);
    }
    
    public function allPeopleActive() {
       return $this->database->table('people')->where('active',1);
   }
   
   public function peopleById($id){
        return $this->database->table('people')->where('id',$id)->fetch();
   }
   
   public function userByPeople($user_id){
        return $this->database->table('people')->where('user_id',$user_id)->fetch();
   }
   
   public function peopleInfById($id){
        return $this->database->table('people_inf')->where('people_id',$id)->fetch();
   }
   
   public function peopleSelector($column_name){
        return $this->database->table('people')->fetchPairs('id',$column_name);
   }
   
   public function findName($name){
       return  $this->database->table('people')->select('id')->where('name LIKE ?','%'.$name.'%')->fetchPairs('id');
   }
   
   public function getInIds($ids){
        return  $this->database->table('people')->where('id',$ids)->fetchAll();
   }
   
   
      
}
