<?php


class AdVue extends TPage {

    public function __construct(){
    
            try{
        
        parent::__construct();
        $html = new THtmlRenderer('app/view/listar.html');
        
        $html->enableSection('main');
        
        parent::add($html);
        
        }
        catch(Exception $e){
        
        new TMessage('error',$e->getMessage()); 
       
        }
        
    }
  }

