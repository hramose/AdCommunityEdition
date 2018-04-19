<?php
  class HDateTimeFormat
  {
      /**
     * Class Constructor
     */
      function __construct()
      {

      }
      
      public static function datetime2br($value, $object = NULL, $row = NULL) 
      { 
            if(empty($value)){ return ''; }
            return TDateTime::convertToMask($value, 'yyyy-mm-dd hh:ii', 'dd/mm/yyyy hh:ii');
      }
      
      public static function datetime2us($value, $object = NULL, $row = NULL) 
      { 
            if(is_nan($value) or empty($value)){ return ''; }
            return TDateTime::convertToMask($value,'dd/mm/yyyy hh:ii', 'yyyy-mm-dd hh:ii');
      }    
  }
  
  
?>
