begin; 

CREATE TABLE cfc_exames_praticos( 
      id number(10)    NOT NULL , 
      cfc_veiculos_id number(10)  (3)    NOT NULL , 
      cfc_funcionarios_id number(10)  (3)    NOT NULL , 
      inicio timestamp(0)    NOT NULL , 
      fim timestamp(0)    NOT NULL , 
      descricao varchar  (200)    NOT NULL , 
      valor binary_double  (6,2)   , 
      observacoes CLOB   , 
      quem_cadastrou char  (10)    NOT NULL , 
      encaixe number(10)  (11)    NOT NULL , 
      substituida number(10)  (11)    NOT NULL , 
 PRIMARY KEY (id)); 

  CREATE SEQUENCE cfc_exames_praticos_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER cfc_exames_praticos_id_seq_tr 

BEFORE INSERT ON cfc_exames_praticos FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT cfc_exames_praticos_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
  
 commit;