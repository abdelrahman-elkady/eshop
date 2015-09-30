CREATE TABLE `users` (

  `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(80) NOT NULL,
  `last_name` VARCHAR(80) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(100) NOT NULL,
  `avatar` VARCHAR(2083) DEFAULT 'assets/images/avatars/default_avatar.png' , -- as suggested in http://stackoverflow.com/questions/219569/best-database-field-type-for-a-url , TODO: DEFAULT Value ?
  PRIMARY KEY(`user_id`)

);

CREATE TABLE `products`(
  `product_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT,
  `price` DECIMAL(11,3) NOT NULL, -- our store is small, we will not rent islands here !
  `stock` INT UNSIGNED NOT NULL, -- TODO : represent out of stock by 0 or NULL ?
  `picture` VARCHAR(2083), -- TODO: DEFAULT Value ?
  PRIMARY KEY(`product_id`)
);
