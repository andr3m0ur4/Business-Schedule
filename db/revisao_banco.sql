-- Resolução dos exercícios
-- Integrantes: André de Moura Benedicto - Igor Marcondes Santos - Rodrigo Ramos de Freitas

-- Lembrando, para que sejam executados nossas consultas, é necessário ter o DB criado por meio das DDL abaixo

-- 1. Traga o nome do curso (renomeie a coluna para Curso) de todos os cursos que possuam a CH maior ou igual a 2000 horas. (Avalie a tabela)
-- Passo 1: Fazer a inserção dos dados.

INSERT INTO `dis_disciplinas` (DIS_NOME, DIS_CH)
VALUES ('ARDUINO', 2010);

INSERT INTO `grd_gradecurricular` VALUES (4, 21, NOW(), 1);

-- Passo 2: Selecionar todos os cursos que possuem carga horário maior ou igual a 2000 horas.

SELECT CUR.CUR_NOME AS Curso FROM cur_cursos AS CUR
INNER JOIN grd_gradecurricular AS GRD
ON CUR.CUR_CODIGO = GRD.CUR_CODIGO
INNER JOIN dis_disciplinas AS DIS
ON DIS.DIS_CODIGO = GRD.DIS_CODIGO
WHERE DIS.DIS_CH >= 2000;

-- Insira:
-- a. Tabela Pessoas: 13 – RICARDO
INSERT INTO `pes_pessoas` VALUES (13, 'RICARDO');

-- b. Tabela Professores: 50 – 13
INSERT INTO `pro_professores` VALUES (50, 13);

-- 3. Exclua todas as disciplinas que não fazem referência com grade curricular. Utilize sub-select (PESQUISAR) para isso.
DELETE FROM dis_disciplinas
WHERE DIS_CODIGO NOT IN (
    SELECT GDR.DIS_CODIGO FROM grd_gradecurricular AS GDR
);

-- 4. Selecione todas as disciplinas que não estão vinculadas com cursos. Não utilize =, OR ou AND na cláusula WHERE.
SELECT * FROM dis_disciplinas AS DIS
LEFT JOIN grd_gradecurricular AS GRD
ON GRD.dis_codigo = DIS.dis_codigo
LEFT JOIN cur_cursos AS CUR
ON CUR.cur_codigo = GRD.cur_codigo
WHERE GRD.cur_codigo IS NULL;

-- 5. Traga o nome das pessoas que tenham a letra “R” em qualquer parte de seu nome.
SELECT PES_NOME FROM `pes_pessoas` WHERE `PES_NOME` LIKE '%R%';

-- 6. Selecione os dados dos professores que a matrícula esteja entre os valores 30 e 50. Não utilize OR. 
SELECT * FROM `pro_professores` WHERE `PRO_MATRICULA` BETWEEN 30 AND 50;


/**************************************************************************************************************/
-- Criação do banco de Dados

CREATE DATABASE  IF NOT EXISTS `revisaobanco`;

-- Selecionar o DB
USE `revisaobanco`;

-- Criação da tabela Cursos
CREATE TABLE `cur_cursos` (
  `CUR_CODIGO` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `CUR_NOME` varchar(50) NOT NULL
);

-- Inserir cursos
INSERT INTO `cur_cursos` VALUES (1,'ADS'),(2,'GTI'),(3,'LOG'),(4,'G EMP'),(5,'G FIN'),(6,'G COM');

-- Criação da tabela Disciplinas

CREATE TABLE `dis_disciplinas` (
  `DIS_CODIGO` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `DIS_NOME` varchar(45) NOT NULL,
  `DIS_CH` int(10) unsigned NOT NULL
);

-- Inserir disciplinas
INSERT INTO `dis_disciplinas` VALUES 
(1,'ALGORITMO',80),
(2,'LINGUAGEM DE PROGRAMAÇÃO',80),
(3,'BANCO DE DADOS',80),
(4,'ESTRUTURA DE DADOS',80),
(5,'INGLÊS I',40),
(6,'INGLÊS II',40),
(7,'INGLÊS III',40),
(8,'INGLÊS IV',40),
(9,'INGLÊS V',40),
(10,'INGLÊS VI',40),
(11,'ADMINISTRACAO',40),
(12,'MATEMATICA DISCRETA',40),
(13,'MATEMATICA FINANCEIRA',40),
(14,'LOGISTICA BASICA',80),
(15,'CADEIA DE SUPRIMENTOS',40),
(16,'MARKETING',40),
(17,'RH',40),
(18,'B2B',80),
(19,'FUNDAMENTOS DA INFORMATICA',40),
(20,'ALGEBRA',120);

-- Criação da tabela Grade Curricular

CREATE TABLE `grd_gradecurricular` (
  `CUR_CODIGO` int(11) NOT NULL,
  `DIS_CODIGO` int(11) NOT NULL,
  `GRD_INPLANTACAO` date,
  `GRD_ATIVA` ENUM('SIM', 'NÃO'),
  PRIMARY KEY (CUR_CODIGO, DIS_CODIGO),
  FOREIGN KEY (CUR_CODIGO) REFERENCES cur_cursos(CUR_CODIGO),
  FOREIGN KEY (DIS_CODIGO) REFERENCES dis_disciplinas(DIS_CODIGO)
);

-- Inserir grades curriculares
INSERT INTO `grd_gradecurricular` VALUES 
(1,1, NOW(), 1),
(2,1, NOW(), 1),
(1,2, NOW(), 1),
(2,2, NOW(), 1),
(1,3, NOW(), 1),
(2,3, NOW(), 1),
(1,4, NOW(), 1),
(1,5, NOW(), 1),
(2,5, NOW(), 1),
(1,6, NOW(), 1),
(2,6, NOW(), 1),
(1,7, NOW(), 1),
(2,7, NOW(), 1),
(1,8, NOW(), 1),
(2,8, NOW(), 1),
(1,9, NOW(), 1),
(2,9, NOW(), 1),
(1,10, NOW(), 1),
(2,10, NOW(), 1),
(3,11, NOW(), 1),
(4,11, NOW(), 1),
(5,11, NOW(), 1),
(6,11, NOW(), 1),
(3,12, NOW(), 1),
(4,12, NOW(), 1),
(5,12, NOW(), 1),
(6,12, NOW(), 1),
(4,13, NOW(), 1),
(5,13, NOW(), 1),
(6,13, NOW(), 1),
(3,15, NOW(), 1);

-- Criação da tabela Pessoas

CREATE TABLE `pes_pessoas` (
  `PES_CODIGO` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `PES_NOME` varchar(50) NOT NULL
);

-- Inserir pessoas
INSERT INTO `pes_pessoas` VALUES (1,'BRUNO'),(2,'ALLBERT'),(3,'RODRIGO'),(4,'CAMILA'),(5,'GUARINO'),(6,'LEANDRO'),(7,'HERIVELTO'),(8,'KATIA'),(9,'TALITA'),(10,'KAREN'),(11,'CLAUDEMIR'),(12,'KARINA');

-- Criação da tabela Alunos

CREATE TABLE `alu_alunos` (
  `ALU_RA` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `CUR_CODIGO` int(11) NOT NULL,
  `PES_CODIGO` int(11) NOT NULL,
  FOREIGN KEY (CUR_CODIGO) REFERENCES cur_cursos(CUR_CODIGO),
  FOREIGN KEY (PES_CODIGO) REFERENCES pes_pessoas(PES_CODIGO)
);

-- Inserir alunos
INSERT INTO `alu_alunos` VALUES (1000,1,1),(2000,1,2),(3000,2,3),(4000,2,4),(5000,2,5),(6000,2,6),(7000,3,7),(8000,3,8);

-- Criação da tabela Professores

CREATE TABLE `pro_professores` (
  `PRO_MATRICULA` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `PES_CODIGO` int(11) NOT NULL,
  FOREIGN KEY (PES_CODIGO) REFERENCES pes_pessoas(PES_CODIGO)
);

-- Inserir professores
INSERT INTO `pro_professores` VALUES (10,9),(20,10),(30,11),(40,12);

-- Criação da tabela Matrículas

CREATE TABLE `mat_matriculas` (
  `ALU_RA` int(11) NOT NULL,
  `PRO_MATRICULA` int(11) NOT NULL,
  `MAT_SEMESTRE` int(11) NOT NULL,
  `MAT_ANO` int(11) NOT NULL,
  `DIS_CODIGO` int(11) NOT NULL,
  FOREIGN KEY (ALU_RA) REFERENCES alu_alunos(ALU_RA),
  FOREIGN KEY (PRO_MATRICULA) REFERENCES pro_professores(PRO_MATRICULA),
  FOREIGN KEY (DIS_CODIGO) REFERENCES dis_disciplinas(DIS_CODIGO)
);

INSERT INTO `mat_matriculas` VALUES 
(1000,10,2,2018,1),
(1000,10,2,2018,2),
(1000,10,2,2018,3),
(1000,10,2,2018,4),
(2000,10,2,2018,1),
(2000,10,2,2018,2),
(2000,10,2,2018,3),
(2000,10,2,2018,4),
(3000,20,2,2018,1),
(3000,20,2,2018,2),
(3000,20,2,2018,3),
(4000,30,2,2018,15);