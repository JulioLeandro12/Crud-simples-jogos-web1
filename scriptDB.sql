CREATE DATABASE jogos_db;

USE jogos_db;

CREATE TABLE `usuarios` (
  `usuarios_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `jogos` (
  `jogos_id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `descricao` text,
  `ano_lancamento` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Tabela Intermediária para Relacionamento N-N
CREATE TABLE usuario_jogo (
    usuarios_id INT NOT NULL,
    jogos_id INT NOT NULL,
    PRIMARY KEY (usuarios_id, jogos_id),
    FOREIGN KEY (usuarios_id) REFERENCES usuarios(usuarios_id) ON DELETE CASCADE,
    FOREIGN KEY (jogos_id) REFERENCES jogos(jogos_id) ON DELETE CASCADE
);