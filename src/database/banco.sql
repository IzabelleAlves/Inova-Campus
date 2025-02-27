CREATE DATABASE inova_campus
CHARACTER SET utf8mb4  
COLLATE utf8mb4_general_ci;

CREATE TABLE inv_users (
    usr_id INT AUTO_INCREMENT,
    usr_name VARCHAR(100) NOT NULL,
    usr_email VARCHAR(255) NOT NULL,
    usr_password VARCHAR(255) NOT NULL,
    usr_phone VARCHAR(15) NOT NULL,
    usr_function VARCHAR(8) NOT NULL DEFAULT 'cliente',
    PRIMARY KEY (usr_id)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

CREATE TABLE inv_products (
    pdt_id INT AUTO_INCREMENT,
    pdt_name VARCHAR(255) NOT NULL,
    unit_price DECIMAL(5,2) NOT NULL,
    description VARCHAR(400) NOT NULL,
    pdt_user INT NOT NULL,
    PRIMARY KEY (pdt_id),
    FOREIGN KEY (pdt_user) REFERENCES inv_users(usr_id)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;