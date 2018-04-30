<?php
/**
 * WelcomeView
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006-2012 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
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
        
        
            $items  = [
             [ "name"=> "test", "email"=> "test@gmail" ],
            ["name"=> "test2", "email"=> "test2@gmail" ],
            ["name"=>  "test3", "email"=> "test3@gmail" ],
            ["name"=>  "test4", "email"=> "test4@gmail" ],
            ["name"=>  "test5", "email"=> "test5@gmail" ],
            ["name"=>  "test6", "email"=> "test6@gmail" ]
            ];
            
       $datatable = new HDataTable($items);
        
        // add the template to the page
        parent::add($datatable);
    }
}
?>
