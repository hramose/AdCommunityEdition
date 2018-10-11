<?php


class PJBank {
               
      private $sandbox = 'https://sandbox.pjbank.com.br';
      private $production = 'https://api.pjbank.com.br';
      private $apikey;
      private $secret;
      private $mode;

    /**
     * PJBank constructor.
     * @param string $mode
     */
    public function __construct($mode = false)
    {
        $this->mode = $mode;
    }


    public function setKey($key){
          $this->apikey = $key;
      }

      public function setSecret($key){
        $this->secret = $key;
      }
    /**
     * @param array
     * vencimento string
     * valor decimal
     * juros decimal
     * multa decimal
     * desconto decimal
     * nome_cliente string
     * cpf_cliente string
     * endereco_cliente string
     * numero_cliente string
     * complemento_cliente string
     * bairro_cliente string
     * cidade_cliente string
     * estado_cliente string
     * cep_cliente string
     * logo_url string
     * texto text
     * grupo string
     * split array(nome,cnpj,banco_repasse,agencia_repasse,conta_repasse,valor_fixo)
     */
      public function emitirBoletoSplit($array){
            
            $curl = curl_init();
            $url = ($this->mode ? $this->sandbox:$this->production);
            $url_api = "$url/recebimentos/$this->apikey/transacoes";

           // echo $url_api;

          curl_setopt_array($curl, array(
            CURLOPT_URL => $url_api,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>json_encode($array),
            CURLOPT_HTTPHEADER => array(
              "Content-Type: application/json"
            ),

          ));

          curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
          curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
          
          $response = curl_exec($curl);
          $err = curl_error($curl);
          
          curl_close($curl);
          
          if ($err) {
            echo "cURL Error #:" . $err;
          } else {
              $data =  json_decode($response);
              return new PjReturnBoleto($data->status,$data->msg,$data->nossonumero,
                  $data->id_unico,$data->banco_numero,$data->token_facilitador,$data->credencial
                  ,$data->linkBoleto,$data->linkGrupo,$data->linhaDigitavel,$data->pedido_numero);
          }                                  
                                                        
            }

    public function emitirBoletoEmLoteSplit($array){

        $curl = curl_init();
        $url = ($this->mode ? $this->sandbox:$this->production);
        $url_api = "$url/recebimentos/$this->apikey/transacoes";

        // echo $url_api;

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url_api,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>json_encode($array),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),

        ));

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $dados =  json_decode($response);

            if($dados->status == '400')
                return $dados;

            if($dados->status == '401')
                return $dados;

            $response = [];
            foreach ($dados as $data){
                $response[] =   new PjReturnBoleto($data->status,$data->msg,$data->nossonumero,
                    $data->id_unico,$data->banco_numero,$data->token_facilitador,$data->credencial
                    ,$data->linkBoleto,$data->linkGrupo,$data->linhaDigitavel,$data->pedido_numero);
            }

            return $response;

        }

    }

    /**
     * @param $array
     */
    public function impressaoEmLote($array){
        $curl = curl_init();

        $url = ($this->mode? $this->sandbox:$this->production);

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url/recebimentos/$this->apikey/transacoes/lotes",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>json_encode($array),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "X-CHAVE: $this->secret"
            ),
        ));

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return json_decode($response);
        }
    }

    public function canselarBoleto($numero){
        $curl = curl_init();

        $url = ($this->mode? $this->sandbox:$this->production);

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url/recebimentos/$this->apikey/transacoes/$numero",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "X-CHAVE: $this->secret"
            ),
        ));

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);


        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return json_decode($response);
        }
    }
    public function checkCredencial(){
        $curl = curl_init();

        $url = ($this->mode ? $this->sandbox:$this->production);

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url/recebimentos/$this->apikey",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "X-CHAVE: $this->secret"
            ),
        ));

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);


        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }

    public function doCredenciamento($cliente){
        $curl = curl_init();
        $url = ($this->mode ? $this->sandbox:$this->production);

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url/contadigital",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($cliente),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }
         
             }
             
