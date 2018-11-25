

Para pegar a token do usuario

~~~ js
$.ajax({ 
type: 'POST', 
url: 'www.meusistema.local/rest.php', 
{ 
"user": "admin", 
"password": "admin",
}, 
dataType: 'json', 
success: function (response) { 
console.log(response.data); 
} 
}); 

~~~

Usando, aposter a token 

~~~  js
$.ajax({ 
type: 'POST', 
url: 'www.meusistema.local/rest.php', 
 {
        "class":"Home",
        "method":"index",
        "name":"Alexandre souza" // parametro
    }, 
    headers: {
            'Authorization' : 'Bearer '+token
            },
    dataType: 'json', 
    success: function (response) { 
    console.log(response.data); 
} 
}); 

~~~



#Home.class.php

~~~ php

<?php


class Home extends AdiantiRecordService
{
    const DATABASE      = 'janafest';
    const ACTIVE_RECORD = 'Eventos';


    function __construct()
    {
        parent::__construct();
        $this->res = new Request();

    }
    
    public function index($param){
    
     
      
    return $param['user'];
    }
}

~~~