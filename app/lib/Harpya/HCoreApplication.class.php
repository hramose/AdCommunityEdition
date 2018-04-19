<?php
  class HCoreApplication
  {
      /**
     * Class Constructor
     */
      function __construct()
      {

      }
      
      public static function gotoBack($level=1) 
      {
          parse_str(parse_url ( $_SERVER['HTTP_REFERER'],PHP_URL_QUERY ),$PARAM);
          $REFERER_CLASS = $PARAM['class'];
          $REFERER_METHOD = $PARAM['method'];
          unset($PARAM['class']);
          unset($PARAM['method']);  
          AdiantiCoreApplication::gotoPage($REFERER_CLASS, $REFERER_METHOD, $PARAM);
      }
      
      public static function loadBack($level=1) 
      {
          parse_str(parse_url ( $_SERVER['HTTP_REFERER'],PHP_URL_QUERY ),$PARAM);
          $REFERER_CLASS = $PARAM['class'];
          $REFERER_METHOD = $PARAM['method'];
          unset($PARAM['class']);
          unset($PARAM['method']);  
          AdiantiCoreApplication::loadPage($REFERER_CLASS, $REFERER_METHOD, $PARAM);
      }
  }
?>
