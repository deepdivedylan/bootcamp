-- always start with these statements
-- drop the tables in REVERSE order in which they appear below
-- NEVER, EVER, BLOODY *EVER* use this on live data!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
DROP TABLE IF EXISTS orderLine;
DROP TABLE IF EXISTS order;
DROP TABLE IF EXISTS product;
DROP TABLE IF EXISTS profile;
DROP TABLE IF EXISTS user;

CREATE TABLE user (
    -- AUTO_INCREMENT automatically assigns userId {1, 2, 3, ...}
    userId INT UNSIGNED AUTO_INCREMENT NOT NULL,
    email VARCHAR(64) NOT NULL,
    password CHAR(128) NOT NULL,
    salt CHAR(64) NOT NULL,
    authenticationToken CHAR(32),
    PRIMARY KEY(userId),
    -- UNIQUE() is an index that requires the field have at most one entry per table
    UNIQUE(email)
);

CREATE TABLE profile (
    profileId INT UNSIGNED AUTO_INCREMENT NOT NULL,
    -- userId is included here for the 1-to-1 relation with user
    userId INT UNSIGNED NOT NULL,
    name VARCHAR(64) NOT NULL,
    address1 VARCHAR(64) NOT NULL,
    address2 VARCHAR(64),
    city VARCHAR(64) NOT NULL,
    state CHAR(2) NOT NULL,
    zipCode CHAR(10) NOT NULL,
    phone VARCHAR(24) NOT NULL,
    PRIMARY KEY(profileId),
    -- index the foreign key and declare it
    UNIQUE(userId),
    FOREIGN KEY(userId) REFERENCES user(userId)
);

CREATE TABLE product (
    productId INT UNSIGNED AUTO_INCREMENT NOT NULL,
    productName VARCHAR(64) NOT NULL,
    description TEXT,
    price DECIMAL(9, 2) NOT NULL,
    -- index the name because users search for it
    INDEX(productName),
    PRIMARY KEY(productId)
);

CREATE TABLE order (
    orderId INT UNSIGNED AUTO_INCREMENT NOT NULL,
    -- profileId is included here for the 1-to-n relation with profile
    profileId INT UNSIGNED,
    orderDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    shipDate DATETIME,
    PRIMARY KEY(orderId),
    -- index the foreign key and declare it
    INDEX(profileId),
    FOREIGN KEY(profileId) REFERENCES profile(profileId)
);

-- an intersection table for the m-to-n relation with product and order
CREATE TABLE orderLine (
    orderId INT UNSIGNED NOT NULL,
    productId INT UNSIGNED NOT NULL,
    quantity INT UNSIGNED NOT NULL,
    discount DECIMAL(9, 2),
    -- index the foreign keys individually
    INDEX(orderId),
    INDEX(productId),
    -- declare the foreign keys
    FOREIGN KEY(orderId) REFERENCES order(orderId),
    FOREIGN KEY(productId) REFERENCES product(productId),
    -- now create a composite (two dimensional) primary key
    PRIMARY KEY(orderId, productId)
);