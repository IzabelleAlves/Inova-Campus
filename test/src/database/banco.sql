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
    CONSTRAINT pk_usuarios_id PRIMARY KEY (usr_id)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

CREATE TABLE inv_products (
    pdt_id INT AUTO_INCREMENT,
    pdt_name VARCHAR(255) NOT NULL,
    pdt_unit_price DECIMAL(5,2) NOT NULL,
    pdt_units INT,
    pdt_description VARCHAR(400) NOT NULL,
    pdt_user INT NOT NULL,
    CONSTRAINT pk_producty_id PRIMARY KEY (pdt_id),
    CONSTRAINT fk_products_users FOREIGN KEY (pdt_user) REFERENCES inv_users(usr_id)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- ALTER TABLE inv_products CHANGE pdt_unit_price pdt_unit_price DECIMAL(5,2) NOT NULL;
-- ALTER TABLE inv_products CHANGE description pdt_description VARCHAR(400) NOT NULL;
-- ALTER TABLE inv_products ADD COLUMN pdt_units INT AFTER pdt_unit_price;

CREATE TABLE inv_orders (
    odr_id INT AUTO_INCREMENT,
    odr_cli_id INT NOT NULL,
    odr_vnd_id INT NOT NULL,
    odr_data DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pk_odr_id PRIMARY KEY (odr_id),
    CONSTRAINT fk_odr_cli_id FOREIGN KEY (odr_cli_id)
        REFERENCES inv_users (usr_id),
    CONSTRAINT fk_odr_vnd_id FOREIGN KEY (odr_vnd_id)
        REFERENCES inv_users (usr_id)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

CREATE TABLE order_details (
	odd_id INT NOT NULL,
    odd_pdt_id INT NOT NULL,
    odd_unit_price DECIMAL(5,2) NOT NULL,
    odd_quantity INT NOT NULL,
    odd_discount DECIMAL(3,2),
    CONSTRAINT pk_odd_details PRIMARY KEY (odd_id, odd_pdt_id),
    CONSTRAINT fk_odd_id FOREIGN KEY (odd_id) REFERENCES inv_orders (odr_id),
    CONSTRAINT fk_odd_pdt_id FOREIGN KEY (odd_pdt_id) REFERENCES inv_products (pdt_id)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- SELECT version()

