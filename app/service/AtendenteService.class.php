<?php

class AtendenteService {

  public function getData(){
  
  try{
  
  TTransaction::open('permission');
  
 
  
  $users = SystemUsers::getObjects();
  $obj = [];
  
  foreach($users as $user){
  
  $obj_user =  ["id"=>$user->id,"name"=>$user->name, "email"=>$user->email];
  
  $obj[] = $obj_user;
  }
  
  
  TTransaction::close();
  
 return  json_encode($obj);
  
  }catch(Exception $e){
  
  echo "error ".$e->getMessage();
  }
}  
  
  public function show(){
  
  echo $this->getData();
  
  }
}
