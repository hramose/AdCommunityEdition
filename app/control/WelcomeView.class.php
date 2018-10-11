<?php

/**
 * WelcomeView
 *
 * @version    1.0
 * @package    control
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class WelcomeView extends TPage
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


        /**
         * $webcam = new HWebcam('webcam',340,240);
         * $entry = new TEntry('imagem');
         * $entry->{id} = 'input_webcam';
         * $webcam->setInput($entry);
         *
         * parent::add(TVBox::pack($webcam,$entry));
         */
    }
}
