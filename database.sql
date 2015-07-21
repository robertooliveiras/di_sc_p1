CREATE DATABASE projeto1;

CREATE TABLE projeto1.produtos ( 
	id INT(4) NOT NULL AUTO_INCREMENT , 
	nome VARCHAR(100) NOT NULL , 
	unidade VARCHAR(20) NOT NULL , 
	PRIMARY KEY (id(4))
	) 
	ENGINE = InnoDB 
	COMMENT = 'produtos que podem ser fornecidos';

CREATE TABLE projeto1.fornecedores ( 
	id INT(4) NOT NULL AUTO_INCREMENT , 
	nome VARCHAR(200) NOT NULL , 
	email VARCHAR(200) NOT NULL , 
	PRIMARY KEY (id)
	) 
	ENGINE = InnoDB 
	COMMENT = 'Fornecedores';

CREATE TABLE projeto1.fornecedor_produto (
    id INT NOT NULL AUTO_INCREMENT,
    id_fornecedor INT(4) NOT NULL,
    id_produto INT(4) NOT NULL,
    quantidade INT(4) NOT NULL,

    PRIMARY KEY(id),

    FOREIGN KEY (id_fornecedor)
      REFERENCES projeto1.fornecedores(id)
      ON UPDATE CASCADE ON DELETE RESTRICT,

    FOREIGN KEY (id_produto)
      REFERENCES projeto1.produtos(id)
      ON UPDATE CASCADE ON DELETE RESTRICT
)   ENGINE=INNODB;


INSERT INTO projeto1.fornecedores (id, nome, email) VALUES 
	('1', 'Nike', 'nike@nike.eee'), 
	('2', 'Adidas', 'adidas@adidas.eee'), 
	('3', 'Rebook', 'rebook@r.eee'), 
	('4', 'Traxart', 'traxart@t.eee'), 
	('5', 'Forn1', 'fff@ff.fff');
	

INSERT INTO projeto1.produtos (id, nome, unidade) VALUES 
	('1', 'Tenis', 'unidade'), 
	('2', 'Camiseta', 'unidade'), 
	('3', 'Short', 'unidade'), 
	('4', 'Luva', 'par'), 
	('5', 'Meia', 'par'), 
	('6', 'Casaco', 'unidade'), 
	('7', 'Sacola', 'unidade'), 
	('8', 'Skate', 'unidade'), 
	('9', 'Bola de futebol', 'unidade'), 
	('10', 'Bola de basquete', 'unidade');
	
	
INSERT INTO projeto1.fornecedor_produto (id, id_fornecedor, id_produto, quantidade) VALUES 
	('1', '1', '1', '222'), 
	('2', '1', '2', '2'), 
	('3', '1', '3', '34'), 
	('4', '1', '4', '543'), 
	('5', '1', '5', '32'), 
	('6', '2', '6', '6'), 
	('7', '2', '7', '1'), 
	('8', '3', '8', '432'), 
	('9', '4', '8', '43'), 
	('10', '5', '9', '56'), 
	('11', '5', '10', '78'), 
	('12', '4', '2', '3'), 
	('13', '3', '1', '0'), 
	('14', '2', '3', '0'), 
	('15', '4', '5', '4');
	
