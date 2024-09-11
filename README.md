# System_Management_Web
 A Login and Register system for PSC web development project.

# Dependencies
1. Xampp

# Instructions
After downloading xampp and the zip file,
1. extract zip file into xampp htdocs folder
2. go to http://localhost/phpmyadmin/index.php
3. create a new xampp database named "exampledb"
4. go to SQL (located at the top bar)
5. Ctrl C + Ctrl V the code below and run SQL:
```
CREATE TABLE IF NOT EXISTS accounts (
    id int(11) NOT NULL AUTO_INCREMENT,
    username varchar(50) NOT NULL,
    password varchar(255) NOT NULL,
    email varchar(100) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO accounts (id, username, password, email) VALUES (1, 'test', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'test@test.com');
```
