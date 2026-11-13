CREATE DATABASE IF NOT EXISTS discord;
USE discord;

CREATE TABLE usuarios (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    apelido VARCHAR(25) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    numero VARCHAR(20),
    senha VARCHAR(255) NOT NULL,
    data_cadastro DATETIME
);

CREATE TABLE servidores (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_dono INT,
    nome VARCHAR(25) NOT NULL,
    descricao VARCHAR(250),
    icone VARCHAR(250) NOT NULL,
    cor VARCHAR(20) NOT NULL,
    data_cadastro DATETIME,
    CONSTRAINT fk_dono FOREIGN KEY (id_dono) REFERENCES usuarios(id)
);

CREATE TABLE servidor_cargos (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(25) NOT NULL,
    id_servidor INT,
    adm BOOLEAN DEFAULT FALSE,
    menbro BOOLEAN DEFAULT TRUE,
    moderador BOOLEAN DEFAULT FALSE,
    data_cadastro DATETIME
);

CREATE TABLE servidores_usuario (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_usuario INT NOT NULL,  
    id_servidor INT NOT NULL,
    id_cargo INT NOT NULL, 
    data_cadastro DATETIME,
    CONSTRAINT fk_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    CONSTRAINT fk_servidor FOREIGN KEY (id_servidor) REFERENCES servidores(id),
    CONSTRAINT fk_cargo FOREIGN KEY (id_cargo) REFERENCES servidor_cargos(id)
);

CREATE TABLE servidor_banimentos(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    id_servidor INT NOT NULL,
    id_adm INT NOT NULL,
    motivo VARCHAR(250),
    data_banimento DATETIME,
    data_limite DATETIME,
    CONSTRAINT fk_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    CONSTRAINT fk_servidor FOREIGN KEY (id_servidor) REFERENCES servidores(id),
    CONSTRAINT fk_adm FOREIGN KEY (id_adm) REFERENCES usuarios(id)
);


CREATE TABLE servidor_convites (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_usuario_solicitado INT NOT NULL, 
    id_usuario_solicitante INT NOT NULL,
    id_servidor INT NOT NULL,
    descricao VARCHAR(250),
    data_cadastro DATETIME,
    CONSTRAINT fk_usuario_solicitado FOREIGN KEY (id_usuario_solicitado) REFERENCES usuarios(id),
    CONSTRAINT fk_usuario_solicitante FOREIGN KEY (id_usuario_solicitante) REFERENCES usuarios(id),
    CONSTRAINT fk_servidor FOREIGN KEY (id_servidor) REFERENCES servidores(id)
);



CREATE TABLE solicitacao_amizade (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_usuario_solicitado INT NOT NULL,
    id_usuario_solicitante INT NOT NULL, 
    descricao VARCHAR(250),
    st_status VARCHAR(20),
    data_limite DATETIME,
    data_cadastro DATETIME,
    CONSTRAINT fk_usuario_solicitado FOREIGN KEY (id_usuario_solicitado) REFERENCES usuarios(id),
    CONSTRAINT fk_usuario_solicitante FOREIGN KEY (id_usuario_solicitante) REFERENCES usuarios(id)
);

CREATE TABLE amizades (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_usuario_1 INT NOT NULL,
    id_usuario_2 INT NOT NULL,
    data_cadastro DATETIME,
    CONSTRAINT fk_usuario_1 FOREIGN KEY (id_usuario_1) REFERENCES usuarios(id),
    CONSTRAINT fk_usuario_2 FOREIGN KEY (id_usuario_2) REFERENCES usuarios(id)
);


CREATE TABLE canais_texto ();

CREATE TABLE canais_voz (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
);

CREATE TABLE conversas (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_usuario_1 INT NOT NULL,
    id_usuario_2 INT NOT NULL,
    data_cadastro DATETIME,
    CONSTRAINT fk_usuario_1 FOREIGN KEY (id_usuario_1) REFERENCES usuarios(id),
    CONSTRAINT fk_usuario_2 FOREIGN KEY (id_usuario_2) REFERENCES usuarios(id)
);

CREATE TABLE mensagem (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_conversa INT NOT NULL,
    id_canal INT NOT NULL,
    id_envio INT NOT NULL,
    mensagem varchar(250), 
    data_envio DATETIME,
    data_cadastro DATETIME,
    CONSTRAINT fk_conversa FOREIGN KEY (id_conversa) REFERENCES conversas(id),
    CONSTRAINT fk_envio FOREIGN KEY  (id_envio) REFERENCES usuarios(id)
);