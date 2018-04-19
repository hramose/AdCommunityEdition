<?php
/**
 * Debuging CLass
 * @author  Rodrigo Moglia
 * @version 3.0, 2015-13-11
 * Copyright (c) 2015-2020 Rodrigo Moglia
 * <moglia@interatia.com>. All rights reserved.
 */
class TDebug
{
    /**
     * Class Constructor
     */
    function __construct()
    {

    }
    
    public static function debug($var,$title='info')
    {
        $retorno = var_export($var, TRUE);
        new TMessage('info', "<b>$title</b>:<br/>".$retorno);        
    }
    
    public static function raw($var)
    {
        $retorno = var_export($var, TRUE);
        echo "<pre>$retorno</pre>";        
    }
    
    public static function box($var,$title='info')
    {
        $retorno = var_export($var, TRUE);
        echo "<h2>$title</h2><textarea cols='100' rows='50'>$retorno</textarea><br/>";        
    }
}
?>