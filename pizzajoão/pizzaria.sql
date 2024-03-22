CREATE DATABASE pizzaria;
USE pizzaria;

-- TABELAS 
CREATE TABLE bordas(
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
tipo VARCHAR(100)
);

CREATE TABLE massas(
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
tipo VARCHAR(100)
);

CREATE TABLE sabores(
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nome VARCHAR(100),
preco FLOAT(4,2)
);



CREATE TABLE pizzas(
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
borda_id INT NOT NULL,
massa_id INT NOT NULL,
foreign key (borda_id) REFERENCES bordas (id), 
foreign key (massa_id) REFERENCES massas (id)
);

-- n
CREATE TABLE pizza_sabor(
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
pizza_id INT NOT NULL,
sabor_id INT NOT NULL,
foreign key (pizza_id) REFERENCES pizzas (id),
foreign key (sabor_id) REFERENCES sabores (id)
);

CREATE TABLE status(
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
tipo VARCHAR(100)
);

CREATE TABLE pedidos(
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
cliente_id INT,
pizza_id INT NOT NULL,
status_id INT NOT NULL,
data_p DATETIME DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (cliente_id) REFERENCES clientes(id),
foreign key (pizza_id) REFERENCES pizzas (id),
foreign key (status_id) REFERENCES status (id)
);

CREATE TABLE usuarios(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome VARCHAR(255),
    email VARCHAR(255),
    senha VARCHAR(255)
);
CREATE TABLE clientes(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nomeC VARCHAR(255),
    emailC VARCHAR(255)
);
CREATE TABLE enderecos(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    id_cliente INT,
    rua VARCHAR(255),
    numero VARCHAR(255),
    bairro VARCHAR(255),
    FOREIGN KEY(id_cliente) REFERENCES clientes(id)
);
-- INSERTS
INSERT INTO status (tipo) VALUES	
('Em produção'),
('Entrega'),
('Concluída');
 SELECT * FROM status;
 
 INSERT INTO massas (tipo) VALUES 
 ('Comum'),
('Integral'),
('Temperada');

SELECT * FROM massas;

INSERT INTO bordas (tipo) VALUES
('Cheddar'),
('Catupiry');

SELECT * FROM bordas;

INSERT INTO sabores (nome, preco) VALUES 
('4 Queijos', 30.00),
('Frango c/ Catupiry', 32.00),
('Calabresa', 26.00),
('Lombinho', 42.00),
('Filé c/ Cheddar', 50.00),
('Portuguesa', 28.00),
('Margherita', 26.00);

INSERT INTO usuarios(nome, email, senha) VALUES
('Dhiego', 'dhiego@gmail.com', 'qwe123');

SELECT * FROM enderecos;
SELECT * FROM sabores;
SELECT * FROM pizza_sabor;
SELECT * FROM pedidos;

