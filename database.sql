-- DROP TABLE `Comment`;
-- DROP TABLE `cartProduct`;
-- DROP TABLE `productLikes`;
-- DROP TABLE `Products`;
-- DROP TABLE `productcategory`;
-- DROP TABLE `producttype`;
-- DROP TABLE `User`;
-- DROP TABLE `userRole`;


-- USER ROLE
CREATE TABLE `UserRole` (
  `userRoleID` int(11) NOT NULL AUTO_INCREMENT,
  `userRoleName` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`userRoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Injection of userRole data
INSERT INTO `UserRole` (`userRoleID`, `userRoleName`) VALUES
(1, 'admin'),
(2, 'editor'),
(3, 'customer');

-- USER
CREATE TABLE `User` (
  `userID` int(8) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `userRoleID` int(8) DEFAULT NULL,
  `userFirstName` varchar(255) DEFAULT NULL,
  `userLastName` varchar(255) DEFAULT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userLoginPassword` varchar(255) NOT NULL,
  `cartID` int(8) NULL,
  CONSTRAINT `userEmailConstraint` UNIQUE (userEmail) 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- the user's role id will be edited or removed if the user role id in user role id has changes
ALTER TABLE `user` ADD CONSTRAINT `userRoleIDConstraint` FOREIGN KEY (`userRoleID`) REFERENCES `userrole`(`userRoleID`) ON DELETE CASCADE ON UPDATE CASCADE;


-- PRODUCT TYPE
CREATE TABLE `ProductType` (
  `productTypeID` int(8) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `productType` varchar(255)  UNIQUE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ProductType` VALUES
(1, 'Occasion'),
(2, 'Add On Items');


-- PRODUCT CATEGORY
CREATE TABLE `ProductCategory` (
  `productCategoryID` int(8) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `productTypeID` int(8) NOT NULL,
  `productCategory` varchar(255) UNIQUE  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `productcategory` ADD CONSTRAINT `productCategoryTypeID` FOREIGN KEY (`ProductTypeID`) REFERENCES `producttype`(`ProductTypeID`) ON DELETE CASCADE ON UPDATE CASCADE;

INSERT INTO `ProductCategory` VALUES
(1, 1, 'Wedding'),
(2, 1, 'Condolence'),
(3, 1, 'Graduation'),
(4, 1, 'Anniversary'),
(5, 2, 'Balloons'),
(6, 2, 'Chocolates');


-- PRODUCTS
CREATE TABLE `Products` (
  `productID` int(8) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `productImage` text NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productTypeID` int(8) NOT NULL,
  `productCategoryID` int(8) NOT NULL,
  `productPrice` double(10,2) NOT NULL,
  `forumID` int(8) NOT NULL UNIQUE,
  CONSTRAINT `productNameConstraint` UNIQUE (`productName`),
  CONSTRAINT `forumIDUnique` UNIQUE (`forumID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Injection of products data
INSERT INTO `Products` (`productID`, `productImage`, `productName`, `productTypeID`, `productCategoryID`, `productPrice`, `forumID`) VALUES
(1, 'assets/products/occasion/wedding/Lilac Rose Flower Bouquet.jpg', 'Lilac Rose Flower Bouquet', '1', '1', 179.00, 1),
(2, 'assets/products/occasion/wedding/Fifth Symphony Flower Bouquet.jpg', 'Fifth Symphony Flower Bouquet', '1', '1', 219.00, 2),
(3, 'assets/products/occasion/wedding/Pink Rose Flower Bouquet.jpg', 'Pink Rose Flower Bouquet', '1', '1', 179.00, 3),
(4, 'assets/products/occasion/wedding/Red Rose Flower Bouquet.jpg', 'Red Rose Flower Bouquet', '1', '1', 179.00, 4),
(5, 'assets/products/occasion/wedding/Spring Cantabile Flower Bouquet.jpg', 'Spring Cantabile Flower Bouquet', '1', '1', 209.00, 5),
(6, 'assets/products/occasion/condolence/Champagne Rose Flower Bouquet.jpg', 'Champagne Rose Flower Bouquet', '1', '2', 179.00, 6),
(7, 'assets/products/occasion/condolence/White Eustoma Condolence Funeral Stand.jpg', 'White Eustoma Condolence Funeral Stand', '1', '2', 355.00, 7),
(8, 'assets/products/occasion/condolence/White Tulip Flower Bouquet.jpg', 'White Tulip Flower Bouquet', '1', '2', 175.00, 8),
(9, 'assets/products/occasion/condolence/White Tulips Condolence Funeral Stand.jpg', 'White Tulips Condolence Funeral Stand', '1', '2', 499.00, 9),
(10, 'assets/products/occasion/graduation/Maltese Petite Flower Bouquet.jpg', 'Maltese Petite Flower Bouquet', '1', '3', 49.00, 10),
(11, 'assets/products/occasion/graduation/Corgi Petite Flower Bouquet.jpg', 'Corgi Petite Flower Bouquet', '1', '3', 49.00, 11),
(12, 'assets/products/occasion/graduation/Benny The Bear Flower Bouquet.jpg', 'Benny The Bear Flower Bouquet', '1', '3', 85.00, 12),
(13, 'assets/products/occasion/anniversary/99 Roses Flower Bouquet.jpg', '99 Roses Flower Bouquet', '1', '4', 682.00, 13),
(14, 'assets/products/occasion/anniversary/Andromeda Flower Bouquet.jpg', 'Andromeda Flower Bouquet', '1', '4', 159.00, 14),
(15, 'assets/products/occasion/anniversary/Smile Flower Bouquet.jpg', 'Smile Flower Bouquet', '1', '4', 199.00, 15),
(16, 'assets/products/addOnItems/balloons/Bubbly Love.png', 'Bubbly Love', '2', '5', 149.00, 16),
(17, 'assets/products/addOnItems/balloons/Carnival Red Celebration.png', 'Carnival Red Celebration', '2', '5', 169.00, 17),
(18, 'assets/products/addOnItems/balloons/Red Theme Balloon Bunch.png', 'Red Theme Balloon Bunch', '2', '5', 59.00, 18),
(19, 'assets/products/addOnItems/chocolates/Golden Time.png', 'Golden Time', '2', '6', 149.00, 19),
(20, 'assets/products/addOnItems/chocolates/Merry Gold.png', 'Merry Gold', '2', '6', 329.00, 20);


ALTER TABLE `products` ADD CONSTRAINT `productCategoryID` FOREIGN KEY (`productCategoryID`) REFERENCES `productcategory`(`productCategoryID`) ON DELETE CASCADE ON UPDATE CASCADE; 
ALTER TABLE `products` ADD CONSTRAINT `productTypeID` FOREIGN KEY (`productTypeID`) REFERENCES `producttype`(`productTypeID`) ON DELETE CASCADE ON UPDATE CASCADE;


-- PRODUCT LIKES
CREATE TABLE `productLikes` (
  `productID` INT NOT NULL,
  `userID` INT NOT NULL,
  `ratingAction` varchar(255),
  PRIMARY KEY(productID, userID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- all likes of the product will be removed if the product is removed
-- the ratingAction of the user will be removed if the user is removed
ALTER TABLE `productlikes` ADD CONSTRAINT `productIDConstraint` FOREIGN KEY (`productID`) REFERENCES `products`(`productID`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `productlikes` ADD CONSTRAINT `productLikesUserConstraint` FOREIGN KEY (`userID`) REFERENCES `user`(`userID`) ON DELETE CASCADE ON UPDATE CASCADE;


-- CARTPRODUCT
CREATE TABLE `cartProduct` (
  `cartID` INT NOT NULL,
  `productID` INT NOT NULL,
  `quantity` int(8),
  PRIMARY KEY(cartID, productID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- cart with the product will be removed if the product is removed
ALTER TABLE `cartproduct` ADD CONSTRAINT `cartProductIDConstraint` FOREIGN KEY (`productID`) REFERENCES `products`(`productID`) ON DELETE CASCADE ON UPDATE CASCADE;


-- COMMENT
CREATE TABLE `Comment` (
`commentID` int(8) AUTO_INCREMENT NOT NULL,
`forumID` int(8) NOT NULL,
`userID` int(8) NOT NULL,
`comment` varchar(255),
`dateTime` DATETIME NOT NULL,
PRIMARY KEY(commentID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- comment will be deleted if the user is removed
-- comment will be delted if the forum(product) is removed
ALTER TABLE `comment` ADD CONSTRAINT `commentUserIDConstraint` FOREIGN KEY (`userID`) REFERENCES `user`(`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `comment` ADD CONSTRAINT `forumIDConstraint` FOREIGN KEY (`forumID`) REFERENCES `products`(`forumID`) ON DELETE CASCADE ON UPDATE CASCADE;