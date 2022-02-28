-- Criacao do banco dia 11 do 09

-- Criação da tabela users

CREATE TABLE `users` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `job` varchar(255) NOT NULL,
  `description` VARCHAR(255) DEFAULT NULL,
  `status` ENUM('S','N') 
)CHARACTER SET utf8 COLLATE utf8_general_ci;


-- Criação da tabela employees_times

CREATE TABLE `employees_times` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `start_time` time NOT NULL,
  `final_time` time NOT NULL,
  `date` date NOT NULL,
  `week_day` TINYINT NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` ENUM('S','N') 
)CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE `employees_times`
  ADD CONSTRAINT `employee_time_fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);


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
  `name` varchar(255) NOT NULL
)CHARACTER SET utf8 COLLATE utf8_general_ci;



-- Criação da tabela tv_shows_times

CREATE TABLE `tv_shows_times` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `start_time` time NOT NULL,
  `final_time` time NOT NULL,
  `date` date NOT NULL,
  `week_day` TINYINT NOT NULL,
  `mode` ENUM('Ao Vivo', 'Gravado', 'Unidade Móvel') NOT NULL,
  `id_switcher` int(11) NOT NULL,
  `id_studio` int(11) NOT NULL,
  `id_tv_show` int(11) NOT NULL,
  `status` ENUM('S','N') 

)CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE `tv_shows_times`
  ADD CONSTRAINT `tv_shows_times_fk_id_switcher` FOREIGN KEY (`id_switcher`) REFERENCES `switchers` (`id`),
  ADD CONSTRAINT `tv_shows_times_fk_id_tv_show` FOREIGN KEY (`id_tv_show`) REFERENCES `tv_shows` (`id`),
  ADD CONSTRAINT `tv_shows_times_fk_id_studio` FOREIGN KEY (`id_studio`) REFERENCES `studios` (`id`);
  
-- Criação da tabela schedules

CREATE TABLE `schedules` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_tv_show_time` int NOT NULL
)CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `schedules_fk_id_tv_show_time` FOREIGN KEY (`id_tv_show_time`) REFERENCES `tv_shows_times` (`id`);