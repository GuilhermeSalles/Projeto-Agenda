CREATE TABLE `funcionarios` (
    `id` int(11) PRIMARY KEY AUTO_INCREMENT,
    `nomeFuncionario` VARCHAR(15) DEFAULT NULL
);

INSERT INTO `funcionarios`(`nomeFuncionario`) VALUES
('Marcos'),('Carlos'),('Baltazar'); 

CREATE TABLE `trabalhos` (
    `id` int(11) PRIMARY KEY AUTO_INCREMENT,
    `nomeTrabalho` VARCHAR(15) DEFAULT NULL
);

INSERT INTO `trabalhos`(`nomeTrabalho`) VALUES
('Corte Normal'),('Barba'),('Sombrancelha'); 