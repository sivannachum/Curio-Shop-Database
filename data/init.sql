CREATE TABLE items (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  itemname VARCHAR(50) NOT NULL,
  description VARCHAR(500) NOT NULL,
  dateacquired DATE,
  price INT
);
