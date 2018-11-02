<?php


class Welcome extends HPage
{
    /**
     * Class constructor
     * Creates the page
     */
    function __construct()
    {
        parent::__construct();

$html = new THtmlRenderer('app/view/welcome.html');
//$html = new THtmlRenderer('app/view/preact.html');

$html->enableSection('main');

parent::add($html);
    }
    
    public function onAfterLoad($params){
    echo $params['key'];
}
}
