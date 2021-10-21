-- Criacao do banco dia 11 do 09

-- Criação da tabela administrators

CREATE TABLE `administrators` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `job` varchar(255) NOT NULL
)CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Criação da tabela employees

CREATE TABLE `employees` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `job` varchar(255) NOT NULL
)CHARACTER SET utf8 COLLATE utf8_general_ci;


-- Criação da tabela schedules

CREATE TABLE `schedules` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `final_date` date NOT NULL,
  `year` year(4) NOT NULL
)CHARACTER SET utf8 COLLATE utf8_general_ci;


-- Criação da tabela employee_hours

CREATE TABLE `employee_hours` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `start_time` time NOT NULL,
  `final_time` time NOT NULL,
  `date` date NOT NULL,
  `id_employee` int(11) NOT NULL,
  `id_schedule` int(11) NOT NULL
)CHARACTER SET utf8 COLLATE utf8_general_ci;


-- Criação da tabela studios

CREATE TABLE `studios` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL
)CHARACTER SET utf8 COLLATE utf8_general_ci;


-- Criação da tabela switchers

CREATE TABLE `switchers` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL
)CHARACTER SET utf8 COLLATE utf8_general_ci;


-- Criação da tabela tv_shows

CREATE TABLE `tv_shows` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `final_time` time NOT NULL,
  `date` date NOT NULL,
  `type` varchar(255) NOT NULL,
  `id_switcher` int(11) NOT NULL,
  `id_studio` int(11) NOT NULL
)CHARACTER SET utf8 COLLATE utf8_general_ci;



-- Criação da tabela tv_shows_hours

CREATE TABLE `tv_shows_hours` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_tv_show` int(11) NOT NULL,
  `id_employee_hour` int(11) NOT NULL
)CHARACTER SET utf8 COLLATE utf8_general_ci;


-- Foreing Key da tabela employee_hours
ALTER TABLE `employee_hours`
  ADD CONSTRAINT `employee_hours_fk_id_employee` FOREIGN KEY (`id_employee`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `employee_hours_fk_id_schedule` FOREIGN KEY (`id_schedule`) REFERENCES `schedules` (`id`);


-- Foreing Key da tabela tv_shows
ALTER TABLE `tv_shows`
  ADD CONSTRAINT `tv_shows_fk_id_switcher` FOREIGN KEY (`id_switcher`) REFERENCES `switchers` (`id`),
  ADD CONSTRAINT `tv_shows_fk_id_studio` FOREIGN KEY (`id_studio`) REFERENCES `studios` (`id`);


-- Foreing Key da tabela tv_shows_hours
ALTER TABLE `tv_shows_hours`
  ADD CONSTRAINT `tv_shows_hours_fk_id_tv_show` FOREIGN KEY (`id_tv_show`) REFERENCES `tv_shows` (`id`),
  ADD CONSTRAINT `tv_shows_hours_fk_id_employee_hour` FOREIGN KEY (`id_employee_hour`) REFERENCES `employee_hours` (`id`);

-- Fim da criacao do banco dia 11 do 09

-- As novas queries devem ser inseridas abaixo.

-- Exclução da coluna phone da tabela administrador
-- dia 16 do 09 de 2021

ALTER TABLE `administrators` DROP COLUMN `job`; 


-- Ajuste na tabela tv_show_hours e  tv_show, mudança de colunas
-- dia 08 do 10 de 2021

ALTER TABLE `tv_shows_hours` ADD COLUMN
	(`start_time` time NOT NULL,
    `final_time` time NOT NULL,
    `id_switcher` int(11) NOT NULL,
    `id_studio` int(11) NOT NULL);

ALTER TABLE `tv_shows_hours`
  ADD CONSTRAINT `tv_shows_hours_fk_id_switcher` FOREIGN KEY (`id_switcher`) REFERENCES `switchers` (`id`),
  ADD CONSTRAINT `tv_shows_hours_fk_id_studio` FOREIGN KEY (`id_studio`) REFERENCES `studios` (`id`);

ALTER TABLE `tv_shows` DROP FOREIGN KEY `tv_shows_fk_id_switcher`;
ALTER TABLE `tv_shows` DROP FOREIGN KEY `tv_shows_fk_id_studio`;

ALTER TABLE `tv_shows` DROP COLUMN `start_time`;
ALTER TABLE `tv_shows` DROP COLUMN `final_time`;
ALTER TABLE `tv_shows` DROP COLUMN `id_switcher`;
ALTER TABLE `tv_shows` DROP COLUMN `id_studio`;

ALTER TABLE `tv_shows_hours` ADD COLUMN
	(`date` DATE NOT NULL,
   `type` VARCHAR(255) NOT NULL);

ALTER TABLE `tv_shows` DROP COLUMN `date`;
ALTER TABLE `tv_shows` DROP COLUMN `type`;


-- Ajuste na tabela tv_show_hours e emplyee_hours, mudança de colunas
-- dia 08 do 10 de 2021

ALTER TABLE `tv_shows_hours` DROP FOREIGN KEY `tv_shows_hours_fk_id_employee_hour`;
ALTER TABLE `tv_shows_hours` DROP COLUMN `id_employee_hour`;

CREATE TABLE `employee_tv_show_hours` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_employee_hours` int(11) NOT NULL,
  `id_tv_show_hours` int(11) NOT NULL
)CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE `employee_tv_show_hours`
  ADD CONSTRAINT `employee_tv_show_hours_fk_id_employee_hours` FOREIGN KEY (`id_employee_hours`) REFERENCES `employee_hours` (`id`),
  ADD CONSTRAINT `employee_tv_show_hours_fk_id_tv_show_hours` FOREIGN KEY (`id_tv_show_hours`) REFERENCES `tv_shows_hours` (`id`);
