<?php


class DataGrid extends TPage {

    public function __construct(){
    
            try{
        
        parent::__construct();
        $html = new THtmlRenderer('app/control/examples/datagrid/datagrid.html');
        
        $html->enableSection('main');
        
        parent::add($html);
        
        }
        catch(Exception $e){
        
        new TMessage('error',$e->getMessage()); 
       
        }
        
    }
  }

