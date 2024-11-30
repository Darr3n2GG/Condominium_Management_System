# System_Management_Web

A Login and Register system for PSC web development project.

# Dependencies

1. Xampp
2. Composer (phpunit)

# Instructions

After downloading xampp and the zip file,

1. extract zip file into xampp htdocs folder
2. run Apache and MySQL in xampp control panel
3. go to http://localhost/phpmyadmin/index.php
4. create a new xampp database named "exampledb"
5. go to SQL (located at the top bar)
6. Ctrl C + Ctrl V the code below and run SQL (click GO at the bottom right) :

```
CREATE TABLE IF NOT EXISTS accounts (
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(50) NOT NULL,
    password varchar(255) NOT NULL,
    email varchar(100) NOT NULL,
    house_number int(255) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO accounts (id, name, password, email, house_number) VALUES (1, 'test', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'test@test.com', 1);

CREATE TABLE IF NOT EXISTS payment (
  payment_id int(11) NOT NULL AUTO_INCREMENT,
  id int(11) NOT NULL,
  card_number char(19) NOT NULL,
  expiry_month tinyint(4) NOT NULL,
  expiry_year year(4) NOT NULL,
  PRIMARY KEY (payment_id),
  FOREIGN KEY (id) REFERENCES accounts(id)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO payment (payment_id, id, card_number, expiry_month, expiry_year) VALUES
(1, 1, '696969696996', 1, '2069');
```

7. make sure your webpage runs with the prefix "https://127.0.0.1/" instead of "C://"
