<?php

class CfcExamesPraticos extends TRecord
{
    const TABLENAME  = 'cfc_exames_praticos';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}
    
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('cfc_veiculos_id');
        parent::addAttribute('cfc_funcionarios_id');
        parent::addAttribute('inicio');
        parent::addAttribute('fim');
        parent::addAttribute('descricao');
        parent::addAttribute('valor');
        parent::addAttribute('observacoes');
        parent::addAttribute('quem_cadastrou');
        parent::addAttribute('encaixe');
        parent::addAttribute('substituida');
    }

    
}

