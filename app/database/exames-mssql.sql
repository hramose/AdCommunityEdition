begin; 

CREATE TABLE cfc_exames_praticos( 
      id  INT IDENTITY    NOT NULL  , 
      cfc_veiculos_id int  (3)   NOT NULL  , 
      cfc_funcionarios_id int  (3)   NOT NULL  , 
      inicio datetime2   NOT NULL  , 
      fim datetime2   NOT NULL  , 
      descricao varchar  (200)   NOT NULL  , 
      valor float  (6,2)   , 
      observacoes nvarchar(max)   , 
      quem_cadastrou char  (10)   NOT NULL  , 
      encaixe int  (11)   NOT NULL  , 
      substituida int  (11)   NOT NULL  , 
 PRIMARY KEY (id)); 

  
 commit;