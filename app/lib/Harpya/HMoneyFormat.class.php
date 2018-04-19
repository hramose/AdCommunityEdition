<?php
  class HMoneyFormat
  {
      /**
     * Class Constructor
     */
      function __construct()
      {

      }
      
      public static function reais($value, $object = NULL, $row = NULL) 
      { 
            if(is_nan((float)$value) or empty($value)){ return ''; }
            if(is_numeric($value) == TRUE) { return 'R$ ' . number_format($value, 2, ',', '.'); } 
      }
      
      public static function numeric($value, $object = NULL, $row = NULL) 
      { 
          $value = str_replace(array('.','R$ '), array('',''), $value);
          $value = str_replace(',', '.', $value);    
          return $value;
      }    
  }
  
  
?>
