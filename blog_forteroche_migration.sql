ALTER TABLE `blog_forteroche`.`article` 
ADD COLUMN `views` INT NOT NULL DEFAULT 0 AFTER `date_update`;
