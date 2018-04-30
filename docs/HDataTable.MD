

~~~ php

<?php

class WelcomeView extends TPage
{
    private $html;
    
    /**
     * Class constructor
     * Creates the page
     */
    function __construct()
    {
        parent::__construct();
        
         /*
 text: 'Dessert (100g serving)',
 align: 'left',
 sortable: false,
 value: 'name'
*/
            
        $header = ["nome","cpf","rg"];
        
            
       $datatable = new HDataTable('DataTable',$header);

      $datatable->addProps(['text'=>'Nome','value'=>'nome','align'=> 'left']);
       $datatable->addProps(['text'=>'CPF','value'=>'cpf','sortable'=> false]);
       $datatable->addProps(['text'=>'RG','value'=>'rg','sortable'=> false]);

       $datatable->addItem(['nome'=>'Alexandre','cpf'=>'08080890898080','rg'=>'shdsdhskdhskds']);
       $datatable->addItem(['nome'=>'Rodrigo','cpf'=>'08080890898080','rg'=>'shdsdhskdhskds']);
       $datatable->addItem(['nome'=>'Evadro','cpf'=>'08080890898080','rg'=>'shdsdhskdhskds']);
        
        // add the template to the page
        parent::add($datatable);
    }
}
?>

~~~