-- Felhasználó és adatbázis készítése
CREATE USER 'nintendo-project'@'%' IDENTIFIED VIA mysql_native_password USING '***'; GRANT USAGE ON *.* TO 'nintendo-project'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0; GRANT ALL PRIVILEGES ON `nintendo-project`.* TO 'nintendo-project'@'%';

-- Konzol tábla készítése
--CREATE TABLE `nintendo-project`.`console` (`id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `price` INT NOT NULL , `in_stock` BOOLEAN NOT NULL , `description` VARCHAR(10000) NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `color` VARCHAR(255) NOT NULL , `storage` INT NOT NULL , `warranty` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Figura tábla készítése
--CREATE TABLE `nintendo-project`.`figure` (`id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `price` INT NOT NULL , `in_stock` BOOLEAN NOT NULL , `description` VARCHAR(10000) NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `franchise` VARCHAR(255) NOT NULL , `theme` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Játék tábla készítése
--CREATE TABLE `nintendo-project`.`game` (`id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `price` INT NOT NULL , `in_stock` BOOLEAN NOT NULL , `description` VARCHAR(10000) NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `age` INT NOT NULL , `platform` VARCHAR(255) NOT NULL , `genre` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- project tábla készítése
CREATE TABLE `nintendo-project`.`project` (`id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `price` INT NOT NULL , `in_stock` BOOLEAN NOT NULL , `description` VARCHAR(10000) NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `color` VARCHAR(255) NOT NULL , `storage` INT NOT NULL , `warranty` INT NOT NULL , `franchise` VARCHAR(255) NOT NULL , `theme` VARCHAR(255) NOT NULL , `age` INT NOT NULL , `platform` VARCHAR(255) NOT NULL , `genre` VARCHAR(255) NOT NULL , `category` VARCHAR(15) NOT NULL ,PRIMARY KEY (`id`)) ENGINE = InnoDB

-- Order tabla
CREATE TABLE `nintendo-project`.`webshop-order` ( `id` INT NOT NULL AUTO_INCREMENT , `email` VARCHAR(255) NOT NULL , `name` VARCHAR(255) NOT NULL , `address` VARCHAR(255) NOT NULL , `total` INT NOT NULL , `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB; 

--admin oldal
nintendo-project
jelszo123