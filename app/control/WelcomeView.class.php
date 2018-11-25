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

$html = new THtmlRenderer('app/resources/system_welcome_en.html');
$html2 = new THtmlRenderer('app/resources/system_welcome_pt.html');
$html3 = new THtmlRenderer('app/resources/system_welcome_es.html');

$html->enableSection('main');
$html2->enableSection('main');
$html3->enableSection('main');

$vbox = new TVBox();
$vbox->add($html);
$vbox->add($html2);
$vbox->add($html3);

parent::add($vbox);
    }
}
