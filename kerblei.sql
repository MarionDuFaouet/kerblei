CREATE TABLE Category(
   type ENUM('blanche','brune','rousse','ambree', 'whisky'),
   PRIMARY KEY(type)
);

CREATE TABLE Product(
   productId INT,
   name VARCHAR(50) NOT NULL,
   degree VARCHAR(9),
   designation VARCHAR(50),
   unitPrice DECIMAL(4,2),
   pictureRef VARCHAR(50),
   PRIMARY KEY(productId)
);

CREATE TABLE KerbleiUser(
   accountId INT,
   name VARCHAR(20),
   firstname VARCHAR(20),
   mail VARCHAR(50) NOT NULL,
   phone VARCHAR(14),
   password VARCHAR(50),
   isAdmin BOOLEAN,
   PRIMARY KEY(accountId),
   UNIQUE(mail)
);

CREATE TABLE Cart(
   cartId INT,
   orderDate DATE,
   deliveryDate DATE,
   statement ENUM('pending','completed','cancelled'),
   accountId INT NOT NULL,
   PRIMARY KEY(cartId),
   FOREIGN KEY(accountId) REFERENCES KerbleiUser(accountId)
);

CREATE TABLE orderProduct(
   productId INT,
   cartId INT,
   quantity INT,
   PRIMARY KEY(productId, cartId),
   FOREIGN KEY(productId) REFERENCES Product(productId),
   FOREIGN KEY(cartId) REFERENCES Cart(cartId)
);
