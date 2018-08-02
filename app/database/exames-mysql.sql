begin; 

CREATE TABLE cfc_exames_praticos( 
      id  INT  AUTO_INCREMENT    NOT NULL  , 
      cfc_veiculos_id int   NOT NULL  , 
      cfc_funcionarios_id int   NOT NULL  , 
      inicio datetime   NOT NULL  , 
      fim datetime   NOT NULL  , 
      descricao varchar  (200)   NOT NULL  , 
      valor double   , 
      observacoes text   , 
      quem_cadastrou char  (10)   NOT NULL  , 
      encaixe int   NOT NULL  , 
      substituida int   NOT NULL  , 
 PRIMARY KEY (id)); 

  
 commit;