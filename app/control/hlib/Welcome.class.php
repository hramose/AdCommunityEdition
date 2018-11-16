<?php


class Welcome extends HPage
{

public function __construct(){
parent::__construct();
  
  parent::add(new TLabel("Indev Web"));
  
  }  

    public function onAfterLoad($params){
    
    echo "Antes da pagina ser carregada ".$params['key'];
}

    public function onBeforeLoad($params){
    
        echo " apos a pagina ser carregada ".$params['key'];
    }
}
