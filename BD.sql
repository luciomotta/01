-- ID INT primary Key auto_increment not null;
CREATE TABLE bordas (
ID INT primary Key auto_increment not null,
tipo  VARCHAR(100)
);

SELECT * FROM BORDAS;

CREATE TABLE massas (
ID INT primary Key auto_increment not null,
tipo VARCHAR(100)
);

SELECT * FROM MASSAS;

create table sabores (
ID INT primary Key auto_increment not null,
nome varchar(100)
);

SELECT * FROM sabores;

CREATE TABLE pizzas (
ID INT primary Key auto_increment not null,
borda_id INT NOT NULL,
massa_id INT NOT NULL,
FOREIGN KEY (borda_id) REFERENCES bordas(id),
FOREIGN KEY (massa_id) REFERENCES massas(id)
);

SELECT * FROM PIZZAS;

CREATE TABLE pizza_sabor (
id INT PRIMARY KEY auto_increment NOT NULL,
pizza_id INT not null,
sabores_id INT NOT null,
FOREIGN KEY (pizza_id) REFERENCES pizzas(id),
FOREIGN KEY (sabores_id) REFERENCES sabores(id)
);

SELECT * FROM pizza_sabor;

CREATE TABLE status (
ID INT primary Key auto_increment not null,
tipo VARCHAR(100)
);

create table pedidos (
ID INT primary Key auto_increment not null,
pizza_id INT NOT null,
status_id INT NOT null,
FOREIGN KEY (pizza_id) REFERENCES pizzas(id),
FOREIGN KEY (status_id) REFERENCES status(id)
);

SELECT * FROM pedidos;

INSERT INTO status (tipo) VALUES ("Em Produção");
INSERT INTO status (tipo) VALUES ("Em Entrega");
INSERT INTO status (tipo) VALUES ("Concluido");

SELECT * FROM status;

INSERT INTO massas (tipo) VALUES ("Massa COMUM");
INSERT INTO massas (tipo) VALUES ("Massa integral");
INSERT INTO massas (tipo) VALUES ("Massa temperada");

SELECT * FROM massas;

DELETE FROM status 
WHERE id IN (2,5,6,7,8);

UPDATE massas set tipo = 'Massa Comum'
where id = 1;

INSERT INTO bordas (tipo) VALUES ("Cheddar"); 
INSERT INTO bordas (tipo) VALUES ("Catupiry"); 

SELECT * FROM bordas;

INSERT INTO sabores (NOME) values ("4 qUEIJOS");
INSERT INTO sabores (NOME) values ("Frango");
INSERT INTO sabores (NOME) values ("Calabresa");
INSERT INTO sabores (NOME) values ("Lombinho");
INSERT INTO sabores (NOME) values ("Filé com Cheddar");
INSERT INTO sabores (NOME) values ("Portuguesa");
INSERT INTO sabores (NOME) values ("Margherita");

SELECT * FROM sabores;

UPDATE sabores 
SET nome = "4 Queijos"
WHERE id = 1;