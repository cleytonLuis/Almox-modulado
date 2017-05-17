CREATE TABLE departamento (

  id_departamento serial,

  nome varchar(255),

  id_secretaria,
  PRIMARY KEY (id_departamento)

  FOREIGN KEY (id_secretaria));

