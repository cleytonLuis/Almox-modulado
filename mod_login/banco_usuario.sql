CREATE TABLE usuario (

  id_usuario serial,

  nome varchar(255),
  cpf varchar(255),
  login varchar(255),

  email varchar(255),
  senha varchar(255),

  PRIMARY KEY (id_usuario)
);

