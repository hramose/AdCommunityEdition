<?php


class HWebcamUploadService {
                              
       show($param){
                       
                
                   $filename = $getMercID.'_'.date('dmYHi').'_'.rand(1111,9999).'.jpg'; // Set a filename
        file_put_contents("tmp/$filename", base64_decode($param['data'])); // Save photo to folder   
        return json_encode(array('return'=>'okay'));                  
        }       
}