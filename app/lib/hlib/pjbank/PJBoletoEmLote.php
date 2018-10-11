<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12/09/18
 * Time: 10:53
 */

class PJBoletoEmLote extends PJBase
{
    private $credencial;
    private $cobrancas;

    /**
     * PJBoletoEmLote constructor.
     * @param $credencial
     * @param $cobrancas
     */
    public function __construct($credencial, $cobrancas)
    {
        $this->credencial = $credencial;

        foreach ($cobrancas as $c){
            $this->cobrancas[] = $c->prepare();
        }

    }

    /**
     * @return mixed
     */
    public function getCredencial()
    {
        return $this->credencial;
    }

    /**
     * @return mixed
     */
    public function getCobrancas()
    {
        return $this->cobrancas;
    }


}