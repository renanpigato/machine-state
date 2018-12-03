
INSERT INTO maquina (nome, quantidade_estados) values ('Controle Portao', 8); 

INSERT INTO saida (nome, sigla, id_maquina) values 
   ('Motor',            'MOT', 1) 
  ,('Sentido do Motor', 'SEN', 1)
;


INSERT INTO estado (nome, valor, id_maquina) values
   ('Estado 1', '000', 1) 
  ,('Estado 2', '001', 1) 
  ,('Estado 3', '010', 1) 
  ,('Estado 4', '011', 1) 
  ,('Estado 5', '100', 1) 
  ,('Estado 6', '101', 1) 
  ,('Estado 7', '110', 1) 
  ,('Estado 8', '111', 1)
; 

INSERT INTO entrada (nome, sigla, id_maquina) values 
   ('Sensor fim de curso ABERTO',  'OPE', 1) 
  ,('Sensor fim de curso FECHADO', 'CLO', 1) 
  ,('Controle remoto',             'REM', 1)
;


INSERT INTO transicao (id_maquina, id_estado_origem, id_estado_destino) VALUES
   (1, 1, 2) 
  ,(1, 2, 3) 
  ,(1, 3, 4) 
  ,(1, 3, 5) 
  ,(1, 4, 5) 
  ,(1, 4, 5) 
  ,(1, 5, 6) 
  ,(1, 6, 7) 
  ,(1, 7, 1) 
  ,(1, 7, 8) 
  ,(1, 8, 1) 
  ,(1, 8, 1) 
;

INSERT INTO entrada_transicao (id_entrada, id_transicao) VALUES
   (3, 1)
  ,(3, 2)
  ,(3, 3)
  ,(1, 4)
  ,(1, 5)
  ,(3, 6)
  ,(3, 7)
  ,(3, 8)
  ,(2, 9)
  ,(3, 10)
  ,(2, 11)
  ,(3, 12)
;

INSERT INTO saida_acionamento (id_estado, id_transicao, id_saida) VALUES
   (3, null, 1)
  ,(4, null, 1)
  ,(7, null, 1)
  ,(8, null, 1)
  ,(7, null, 2)
  ,(8, null, 2)
;

