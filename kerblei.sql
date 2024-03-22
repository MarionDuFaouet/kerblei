CREATE TABLE Product(
   productId INT,
   name VARCHAR(50) NOT NULL,
   designation VARCHAR(50),
   unitPrice DECIMAL(4,2),
   pictureRef VARCHAR(50),
   PRIMARY KEY(productId)
);

CREATE TABLE KerbleiUser(
   accountId INT,
   nameFirstname VARCHAR(50),
   mail VARCHAR(50) NOT NULL,
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
