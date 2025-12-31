CREATE DATABASE IF NOT EXISTS eCommerce;

USE eCommerce;

CREATE TABLE category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT
) ENGINE=InnoDB;


CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    description TEXT,
    base_price DECIMAL(10,2) NOT NULL,
    img VARCHAR(255),
    category_id INT NOT NULL,
    fabricante VARCHAR(100),
    active TINYINT(1) DEFAULT 1,
    stock INT DEFAULT 0,
    CONSTRAINT fk_products_category
        FOREIGN KEY (category_id) REFERENCES category(id)
) ENGINE=InnoDB;

CREATE TABLE attributes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    unit VARCHAR(50)
) ENGINE=InnoDB;

CREATE TABLE att_value (
    id INT AUTO_INCREMENT PRIMARY KEY,
    att_id INT NOT NULL,
    value VARCHAR(100) NOT NULL,
    CONSTRAINT fk_attvalue_attribute
        FOREIGN KEY (att_id) REFERENCES attributes(id)
) ENGINE=InnoDB;

CREATE TABLE product_attr_value (
    product_id INT NOT NULL,
    att_id INT NOT NULL,
    PRIMARY KEY (product_id, att_id),
    CONSTRAINT fk_pav_product
        FOREIGN KEY (product_id) REFERENCES products(id),
    CONSTRAINT fk_pav_attvalue
        FOREIGN KEY (att_id) REFERENCES att_value(id)
) ENGINE=InnoDB;

CREATE TABLE offers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    type ENUM('percentage','fixed') NOT NULL,
    value DECIMAL(10,2) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL
) ENGINE=InnoDB;

CREATE TABLE offers_products (
    offer_id INT NOT NULL,
    product_id INT NOT NULL,
    PRIMARY KEY (offer_id, product_id),
    CONSTRAINT fk_op_offer
        FOREIGN KEY (offer_id) REFERENCES offers(id),
    CONSTRAINT fk_op_product
        FOREIGN KEY (product_id) REFERENCES products(id)
) ENGINE=InnoDB;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hashed_pass VARCHAR(255) NOT NULL,
    mail VARCHAR(150) NOT NULL UNIQUE,
    telf VARCHAR(20),
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    logup_date DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending','paid','shipped','completed','cancelled') DEFAULT 'pending',
    total DECIMAL(10,2) NOT NULL,
    CONSTRAINT fk_orders_user
        FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB;

CREATE TABLE order_items (
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (order_id, product_id),
    CONSTRAINT fk_oi_order
        FOREIGN KEY (order_id) REFERENCES orders(id),
    CONSTRAINT fk_oi_product
        FOREIGN KEY (product_id) REFERENCES products(id)
) ENGINE=InnoDB;



INSERT INTO category (name, description) VALUES
('Smartphones', 'Telefonos moviles y accesorios'),
('Ordenadores', 'Portatiles y sobremesa'),
('Perifericos', 'Teclados, ratones y monitores'),
('Audio', 'Auriculares y altavoces');

INSERT INTO products (name, description, base_price, img, category_id, fabricante, active, stock) VALUES
('iPhone 15', 'Smartphone Apple 128GB', 999.99, 'iphone15.jpg', 1, 'Apple', 1, 40),
('Samsung Galaxy S24', 'Smartphone Android 256GB', 899.99, 's24.jpg', 1, 'Samsung', 1, 60),
('MacBook Pro M3', 'Portatil Apple para desarrollo', 1999.00, 'mbp_m3.jpg', 2, 'Apple', 1, 15),
('Teclado Mecanico RGB', 'Teclado gaming mecanico', 129.99, 'keyboard.jpg', 3, 'Logitech', 1, 100),
('Auriculares Sony WH-1000XM5', 'Auriculares con cancelacion de ruido', 349.99, 'sony.jpg', 4, 'Sony', 1, 35);

INSERT INTO attributes (name, unit) VALUES
('Color', NULL),
('Almacenamiento', 'GB'),
('RAM', 'GB'),
('Pantalla', 'pulgadas'),
('Conectividad', NULL);

INSERT INTO att_value (att_id, value) VALUES
-- Color
(1, 'Negro'),
(1, 'Blanco'),
(1, 'Azul'),

-- Almacenamiento
(2, '128'),
(2, '256'),
(2, '512'),

-- RAM
(3, '8'),
(3, '16'),

-- Pantalla
(4, '6.1'),
(4, '14'),
(4, '16'),

-- Conectividad
(5, 'Bluetooth'),
(5, 'WiFi'),
(5, 'USB-C');


INSERT INTO product_attr_value (product_id, att_id) VALUES
-- iPhone 15
(1, 1), -- Negro
(1, 4), -- 128 GB
(1, 10), -- 6.1"

-- Galaxy S24
(2, 3), -- Azul
(2, 5), -- 256 GB
(2, 10), -- 6.1"

-- MacBook Pro
(3, 6), -- 512 GB
(3, 8), -- 16 GB
(3, 11), -- 14"

-- Teclado
(4, 1), -- Negro
(4, 14), -- USB-C

-- Auriculares
(5, 1), -- Negro
(5, 13); -- Bluetooth

INSERT INTO offers (name, type, value, start_date, end_date) VALUES
('Black Friday', 'percentage', 15, '2025-11-20', '2025-11-30'),
('Descuento Apple', 'fixed', 200, '2025-01-01', '2025-12-31');

INSERT INTO offers_products (offer_id, product_id) VALUES
(1, 2), -- Galaxy S24
(1, 5), -- Auriculares
(2, 3); -- MacBook Pro


INSERT INTO users (hashed_pass, mail, telf, role) VALUES
('$2y$10$adminhash', 'admin@shop.com', '600000001', 'admin'),
('$2y$10$userhash1', 'cliente1@shop.com', '600000002', 'user'),
('$2y$10$userhash2', 'cliente2@shop.com', '600000003', 'user');

INSERT INTO orders (user_id, status, total) VALUES
(2, 'paid', 1149.98),
(3, 'pending', 349.99);

INSERT INTO order_items (order_id, product_id, quantity, price) VALUES
-- Pedido cliente 1
(1, 1, 1, 999.99),
(1, 4, 1, 129.99),

-- Pedido cliente 2
(2, 5, 1, 349.99);
