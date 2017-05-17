CREATE TABLE produto (

  id_produto serial,

  nome varchar(255),
  unidade integer REFERENCES unidade(id_unidade),

  PRIMARY KEY (id_produto)
);


CREATE TABLE unidade (

  id_unidade serial,

  nome varchar(255),

  PRIMARY KEY (id_unidade)
);


insert into unidade(nome) values('Resma');
insert into unidade(nome) values('Litro');
insert into unidade(nome) values('Unidade');
insert into unidade(nome) values('Kilo');
insert into unidade(nome) values('Fardo');