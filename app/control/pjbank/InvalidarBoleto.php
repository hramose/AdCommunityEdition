<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12/09/18
 * Time: 18:23
 */

class InvalidarBoleto extends TPage
{
    /**
     * Class constructor
     * Creates the page
     */
    function __construct()
    {
        parent::__construct();

        $pjbank = new PJBank();
        $pjbank->setKey('20a0cf961a7539fcb7e389973e55f6e64fc3e230');
        $pjbank->setSecret("15de9f3676c46ae29d8fc878de9aebe255b1b19c");


        $delete = $pjbank->canselarBoleto(2);
        var_dump($delete);
    }
}