# Make DB structre
# users list
CREATE TABLE `slutproject`.`users` ( `id` INT NOT NULL AUTO_INCREMENT , `mail` VARCHAR(50) NOT NULL , `user` VARCHAR(100) NOT NULL , `pass` VARCHAR(50) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

# Highscores
CREATE TABLE `slutproject`.`highscore` ( `person_id` INT NOT NULL , `pong_highscore` VARCHAR NOT NULL , `breakout_highscore` VARCHAR NOT NULL ) ENGINE = InnoDB;