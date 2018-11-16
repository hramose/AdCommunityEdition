<?php
/**
 * Created by PhpStorm.
 * User: Indev
 * Date: 14/11/18
 * Time: 18:19
 */



class UserService extends AdiantiRecordService
{


    function helloRest($param){

        return json_encode(array('status'=>"success","data"=>"A empresa é {$param['empresa']}"));
    }


}