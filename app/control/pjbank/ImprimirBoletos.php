<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12/09/18
 * Time: 11:17
 */

class ImprimirBoletos  extends TPage
{
    /**
     * Class constructor
     * Creates the page
     */
    function __construct()
    {
        parent::__construct();

        $pjbank = new PJBank();
        $pjbank->setKey('9d76aca2823e29c146129e4074dc35a4017bc10f');
        $pjbank->setSecret("85a2cd9b2ceb5e4e84ba0c7f09f80b6a3d40ec73");
        $numeros = [1,2];
        $boletos_pedidos = ["pedido_numero" => $numeros];


        $prints =  $pjbank->impressaoEmLote($boletos_pedidos);
        var_dump($prints);
        exit;


    }
}