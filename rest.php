<?php
// initialization script
require_once 'init.php';
class AdiantiRestServer
{


    public static function auth($login,$password){
    
    try{
        TTransaction::open('permission');
        
        $repos = new TRepository('SystemUser');
        $criteria = new TCriteria;
        $criteria->add(new TFilter('login', '=', $login));
        $criteria->add(new TFilter('password', '=', md5($password)));
        $users = $repos->load($criteria);
        
     foreach($users as $user){       
            if ($user)
            {
              
                $programs = $user->getPrograms();
        
                 return md5($user->name.$user->password.$user->login);  
         
            }else{
            
            return false;
            }
            }
        
        TTransaction::close();
        
        }catch(Exception $e){
        
        echo $e->getMessage();
       
        
        }
    } 
    
        public static function authToken($token){
    
    try{
        TTransaction::open('permission');
        
        $repos = new TRepository('SystemUser');
        $criteria = new TCriteria;
        $criteria->add(new TFilter("MD5(CONCAT(name,password,login))", '=', $token));
    //   echo $criteria->dump();exit;
        $users = $repos->load($criteria);
        
     foreach($users as $user){       
                if ($user)
                {
                return true;
             
                }else{
                
                return false;
                }
          }
        
        TTransaction::close();
        
        }catch(Exception $e){
        
        echo $e->getMessage();
       
        
        }
    } 
    
    
    public static function run($request)
    {
      $json = file_get_contents('php://input');
      $obj = json_decode($json);
      
        $user  = isset($obj->user) ? $obj->user : '';
        $password  = isset($obj->password) ? $obj->password : '';
        $token  = isset($obj->token) ? $obj->token : '';
    
      $login = self::auth($user,$password);
      
     
      
    $headers = apache_request_headers();

   if(empty($user)  || empty($password)  ){
      
      foreach ($headers as $header => $value) {

      if($header == 'Authorization'){
      
      $data = explode(' ',$value);
      $bearer = strtolower($data[0]);
      
      if($bearer === 'bearer'){
      
      $autToken = self::authToken($data[1]);
      
             if(!$autToken){ 
                return "token invalida";
             }
      }
       
        }
                               
      }                                   
      }
      
     else if(!empty($user) || !empty($password)  ){
      
            $login = self::auth($user,$password);
        
             echo $login;exit;    
     
        if ($login  == false)
        {
            return json_encode( array('status' => 'error',
                                      'data'   => _t('Permission denied')));
        }else{
        
        return json_encode( array('status' => 'sucess',
                                      'data'   => $login));
        exit;
        }
     } 
        

          
        $class   = isset($obj->class) ? $obj->class   : '';
        $method  = isset($obj->method) ? $obj->method : '';
        $response = NULL;
        
        
      
  
        
        
        
        try
        {
            if (class_exists($class))
            {
                if (method_exists($class, $method))
                {
                    $rf = new ReflectionMethod($class, $method);
                    if ($rf->isStatic())
                    {
                        $response = call_user_func(array($class, $method), $request);
                    }
                    else
                    {
                        $response = call_user_func(array(new $class($request), $method), $request);
                    }
                    return $response;
                }
                else
                {
                    $error_message = TAdiantiCoreTranslator::translate('Method ^1 not found', "$class::$method");
                    return json_encode( array('status' => 'error', 'data' => $error_message));
                }
            }
            else
            {
                $error_message = TAdiantiCoreTranslator::translate('Class ^1 not found', $class);
                return json_encode( array('status' => 'error', 'data' => $error_message));
            }
        }
        catch (Exception $e)
        {
            return json_encode( array('status' => 'error', 'data' => $e->getMessage()));
        }
    }
}



print AdiantiRestServer::run($_REQUEST);
?>