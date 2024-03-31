CREATE TABLE KerbleiUser(
   accountId INT,
   name VARCHAR(20),
   firstname VARCHAR(20),
   mail VARCHAR(50) NOT NULL,
   phone VARCHAR(14),
   password VARCHAR(20),
   isAdmin BOOLEAN,
   PRIMARY KEY(accountId),
   UNIQUE(mail)
);

CREATE TABLE Category(
   categoryId INT
   type ENUM('blanche','brune','rousse','ambree', 'whisky'),
   PRIMARY KEY(categoryId)
);

CREATE TABLE Product(
   productId INT,
   name VARCHAR(50) NOT NULL,
   designation VARCHAR(50),
   unitPrice DECIMAL(4,2),
   pictureRef VARCHAR(50),
   degree VARCHAR(7),
   categoryId INT NOT NULL,
   PRIMARY KEY(productId),
   FOREIGN KEY(categoryId) REFERENCES category(categoryId)
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
