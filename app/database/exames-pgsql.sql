begin; 

CREATE TABLE cfc_exames_praticos( 
      id  SERIAL    NOT NULL  , 
      cfc_veiculos_id integer   NOT NULL  , 
      cfc_funcionarios_id integer   NOT NULL  , 
      inicio timestamp   NOT NULL  , 
      fim timestamp   NOT NULL  , 
      descricao varchar  (200)   NOT NULL  , 
      valor float   , 
      observacoes text   , 
      quem_cadastrou char  (10)   NOT NULL  , 
      encaixe integer   NOT NULL  , 
      substituida integer   NOT NULL  , 
 PRIMARY KEY (id)); 

  
 commit;