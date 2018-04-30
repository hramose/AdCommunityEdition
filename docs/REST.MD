

Para pegar a token do usuario

~~~ js
$.ajax({ 
type: 'POST', 
url: 'www.meusistema.local/rest.php', 
data: { 
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
    data: { 
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


class Home extends TPage
{

    private $res;
    /**
     * Class constructor
     * Creates the page
     */
    function __construct()
    {
        parent::__construct();
        $this->res = new Request();

    }
    
    public function index(){
    
     
      
    return json_encode(array('data'=> $this->res->get('user')));
    }
}

~~~