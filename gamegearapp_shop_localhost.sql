-- create and select the database
## DROP DATABASE IF EXISTS gamegearapp_shop;
##CREATE DATABASE gamegearapp_shop;
USE gamegearapp_shop;

-- create the tables for the database
CREATE TABLE addresses (
  addressID         INT            NOT NULL AUTO_INCREMENT,
  street            VARCHAR(60)    NOT NULL,
  appartment        VARCHAR(60)    DEFAULT NULL,
  city              VARCHAR(40)    NOT NULL,
  state             VARCHAR(2)     NOT NULL,
  zipCode           VARCHAR(10)    NOT NULL,
  phone             VARCHAR(12)    NOT NULL,
  CONSTRAINT addresses_PK PRIMARY KEY (addressID)
);

CREATE TABLE users (
  userID           INT             NOT NULL AUTO_INCREMENT,
  emailAddress     VARCHAR(100)    NOT NULL,
  firstName        VARCHAR(20),
  lastName         VARCHAR(20),
  phoneNumber      VARCHAR(10),
  storeName        VARCHAR(30),
  password         VARCHAR(255),
  CONSTRAINT users_PK PRIMARY KEY (userID),
  UNIQUE INDEX users_IDX1(emailAddress)
);

CREATE TABLE categories (
  categoryID        INT            NOT NULL AUTO_INCREMENT,
  categoryName      VARCHAR(255)   NOT NULL,
  CONSTRAINT categories_PK PRIMARY KEY (categoryID)
);

CREATE TABLE products (
  productID         INT            NOT NULL AUTO_INCREMENT,
  categoryID        INT            NOT NULL,
  userID            INT            NOT NULL,
  productName       VARCHAR(255)   NOT NULL,
  description       TEXT           NOT NULL,
  listPrice         DECIMAL(10,2)  NOT NULL,
  discountPercent   DECIMAL(10,2)  NOT NULL DEFAULT 0.00,
  imageFilename     VARCHAR(50)    NOT NULL DEFAULT 'noFile',
  CONSTRAINT products_PK PRIMARY KEY (productID), 
  CONSTRAINT products_FK1 FOREIGN KEY (userID) REFERENCES users(userID),
  CONSTRAINT products_FK2 FOREIGN KEY (categoryID) REFERENCES categories(categoryID),
  INDEX products_IDX1 (categoryID), 
  INDEX products_IDX2 (userID)
);

-- Insert data into the tables
INSERT INTO categories (categoryID, categoryName) VALUES
(1, 'RuneScape'),
(2, 'WoW'),
(3, 'Diablo');

INSERT INTO users (userID, emailAddress, firstName, lastName, phoneNumber, storeName, password) VALUES
(1, 'admin@gamegearapp.com', 'Admin', 'User', '9098889999', 'gamegearapp', '$2y$10$JQqJDR685YYf8Jwz4tbyi.HZZcur.y2hVkAFgeFjhdlV0pAsOX9RO');

INSERT INTO products (productID, categoryID, userID, productName, listPrice, discountPercent, imageFilename, description) VALUES
(1, (SELECT categoryID FROM categories WHERE categoryID = 1), (SELECT userID FROM users WHERE userID = 1),
  'Spirit shards', '24.99', '0.00', 'SpirtShard.gif',
  'Shards of an obelisk. Used in Summoning 1 for training and production.'),
(2, (SELECT categoryID FROM categories WHERE categoryID = 1), (SELECT userID FROM users WHERE userID = 1),
  'Feather', '18.00', '0.00', 'Feather.png',
  'Used for fly fishing.'),
(3, (SELECT categoryID FROM categories WHERE categoryID = 1), (SELECT userID FROM users WHERE userID = 1),
  'Chronotes', '19.00', '0.00', 'Chronotes.gif',
  'A representation of time used by members of the Archaeology Guild.'),
(4, (SELECT categoryID FROM categories WHERE categoryID = 1), (SELECT userID FROM users WHERE userID = 1),
  'Headless arrows', '46.00', '0.00', 'Headlessarrow.gif',
  'A wooden arrow shaft with flights attached.'),
(5, (SELECT categoryID FROM categories WHERE categoryID = 2), (SELECT userID FROM users WHERE userID = 1),
  'Nightshade', '9.99', '0.00', 'Nightshade.jpg',
  'Gathered by players with the Herbalism skill. Can be bought and sold on the auction house.'),
(6, (SELECT categoryID FROM categories WHERE categoryID = 2), (SELECT userID FROM users WHERE userID = 1),
  'Veiled Augment Rune', '9.99', '0.00', 'AugmentRune.jpg',
  'Increases Agility, Intellect and Strength by 18 for 1 hour.  Augment Rune.'),
(7, (SELECT categoryID FROM categories WHERE categoryID = 3), (SELECT userID FROM users WHERE userID = 1),
  'Hand Axe', '10.99', '0.00', 'HandAxe.gif',
  'One handed axe, 33 to 58 damage.'),
(8, (SELECT categoryID FROM categories WHERE categoryID = 3),(SELECT userID FROM users WHERE userID = 1),
  'Small Crescent', '15.45', '0.00', 'SmallCrescent.gif',
  'Small one handed axe, 38 to 60 damage.');

-- create the application user and grant privileges to that user
CREATE USER IF NOT EXISTS 'gamegearapp_shop'@'localhost'
IDENTIFIED BY '7uzPeX=$!ej3XV$!Jp2uQ4Vk43Xa+JWU';

GRANT SELECT, INSERT, DELETE, UPDATE
ON gamegearapp_shop.*
TO 'gamegearapp_shop'@'localhost';
