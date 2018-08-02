begin; 

PRAGMA foreign_keys=OFF; 

CREATE TABLE cfc_exames_praticos( 
      id  INTEGER    NOT NULL  , 
      cfc_veiculos_id int  (3)   NOT NULL  , 
      cfc_funcionarios_id int  (3)   NOT NULL  , 
      inicio datetime   NOT NULL  , 
      fim datetime   NOT NULL  , 
      descricao varchar  (200)   NOT NULL  , 
      valor double  (6,2)   , 
      observacoes text   , 
      quem_cadastrou char  (10)   NOT NULL  , 
      encaixe int  (11)   NOT NULL  , 
      substituida int  (11)   NOT NULL  , 
 PRIMARY KEY (id)); 

  
 commit;