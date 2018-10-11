<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12/09/18
 * Time: 11:17
 */

class BoletoEmLoteSplit  extends TPage
{
    /**
     * Class constructor
     * Creates the page
     */
    function __construct()
    {
        parent::__construct();

        $split = new Split("Fornecedor Exemplo", "10488175000143",  "001",
            "0001", "99999-9", "300");

        $boleto = new PjBoleto(
            "12/30/2019",
            "5000",
            "0",
            "0",
            "",
            "Cliente de Exemplo",
            "62936576000112",
            "Rua Joaquim Vilac",
            "509",
            "",
            "Vila Teixeira",
            "SP",
            "Clientes",
            "13301510",
            rand(100,9999),
            "Boletos",
            "Exemplo de emissão de boleto",
            "http://wallpapercave.com/wp/xK64fR4.jpg",
            "",
            "",
            "",
            "",
            $split
        );

        $pjbank = new PJBank(true);
        $pjbank->setKey('9d76aca2823e29c146129e4074dc35a4017bc10f');
        $pjbank->setSecret("85a2cd9b2ceb5e4e84ba0c7f09f80b6a3d40ec73");

        $boletos = new PJBoletoEmLote("d3418668b85cea70aa28965eafaf927cd34d004c"
            ,array($boleto,$boleto));

        $emitidos =  $pjbank->emitirBoletoEmLoteSplit($boletos->prepare()); // funcionando

        var_dump($emitidos);
        exit;


    }
}