<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12/09/18
 * Time: 23:21
 */

class CriarConta extends TPage
{
    /**
     * Class constructor
     * Creates the page
     */
    function __construct()
    {
        parent::__construct();



        $pjbank = new PJBank(true);


        $cliente = new PJCredencial("Exemplo Conta Digital",20867577000102,
            "13032525","Rua Joaquim Vilac","509","Vila Teixeira","",
            "Campinas","SP","19","987652345","api@pjbank.com.br",
            "http://example.com.br");

        $pjbank->doCredenciamento($cliente->prepare());


    }
}
