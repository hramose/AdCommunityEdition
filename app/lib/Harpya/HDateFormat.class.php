<?php
  class HDateFormat
  {
      /**
     * Class Constructor
     */
      function __construct()
      {

      }
      
      public static function date2br($value, $object = NULL, $row = NULL) 
      { 
            if(empty($value)){ return ''; }
            return TDate::date2br($value);
      }
      
      public static function date2us($value, $object = NULL, $row = NULL) 
      { 
          return TDate::date2us($value);
      }    
  }
  
  
?>
