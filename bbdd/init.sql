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
('Portatill', 'Un ordenaor mas pequeño, un poco menos potente y portable'),
('Sobremesa', 'Ordenador que esta en la mesa 🤙'),
('Consolas', 'PlayStation, Xbox, Nintendo.'),
('Electrodomesticos', 'Frigorificos, Cafeteras, Microondas'),
('Perifericos', 'Complementos para dispositivos electronicos');

INSERT INTO products (name, description, base_price, img, category_id, fabricante, active, stock) VALUES
-- Smartphone (1)
('iPhone 14', 'Smartphone Apple con pantalla OLED y Face ID', 899.99, './img/products/1.jpg', 1, 'Apple', 1, 15),
('Samsung Galaxy S23', 'Movil Android de alta gama con gran camara', 849.99, './img/products/2.jpg', 1, 'Samsung', 1, 20),
('Xiaomi Redmi Note 12', 'Smartphone economico con buena autonomia', 249.99, './img/products/3.jpg', 1, 'Xiaomi', 1, 35),
('Google Pixel 7', 'Movil con Android puro y excelente fotografia', 699.99, './img/products/4.jpg', 1, 'Google', 1, 10),
('OnePlus Nord 3', 'Equilibrio perfecto entre precio y potencia', 499.99, './img/products/5.jpg', 1, 'OnePlus', 1, 18),

-- Portátiles (2)
('MacBook Air M2', 'Portatil ligero con chip Apple M2', 1299.99, './img/products/6.jpg', 2, 'Apple', 1, 8),
('Dell XPS 13', 'Portatil premium con pantalla InfinityEdge', 1199.99, './img/products/7.jpg', 2, 'Dell', 1, 6),
('HP Pavilion 15', 'Portatil versatil para estudio y trabajo', 699.99, './img/products/8.jpg', 2, 'HP', 1, 12),
('Lenovo ThinkPad X1', 'Portatil profesional resistente y potente', 1399.99, './img/products/9.jpg', 2, 'Lenovo', 1, 5),
('Asus VivoBook 14', 'Portatil compacto y economico', 549.99, './img/products/10.jpg', 2, 'Asus', 1, 14),

-- Sobremesa (3)
('PC Gaming RTX 4060', 'Ordenador gaming de alto rendimiento', 1499.99, './img/products/11.jpg', 3, 'MSI', 1, 7),
('iMac 24"', 'Todo en uno de Apple con pantalla 4.5K', 1599.99, './img/products/12.jpg', 3, 'Apple', 1, 4),
('PC Oficina i5', 'Equipo silencioso para trabajo diario', 699.99, './img/products/13.jpg', 3, 'Acer', 1, 10),
('PC Ryzen 7', 'Ordenador potente para edicion y multitarea', 999.99, './img/products/14.jpg', 3, 'Custom', 1, 6),
('Mini PC Intel NUC', 'PC compacto y eficiente', 499.99, './img/products/15.jpg', 3, 'Intel', 1, 9),

-- Consolas (4)
('PlayStation 5', 'Consola de nueva generacion de Sony', 549.99, './img/products/16.jpg', 4, 'Sony', 1, 11),
('Xbox Series X', 'Consola potente de Microsoft', 549.99, './img/products/17.jpg', 4, 'Microsoft', 1, 9),
('Nintendo Switch', 'Consola hibrida portatil y sobremesa', 329.99, './img/products/18.jpg', 4, 'Nintendo', 1, 20),
('PlayStation 4 Slim', 'Consola clasica con gran catalogo', 299.99, './img/products/19.jpg', 4, 'Sony', 1, 7),
('Xbox Series S', 'Consola digital compacta', 299.99, './img/products/20.jpg', 4, 'Microsoft', 1, 13),

-- Electrodomésticos (5)
('Frigorifico LG', 'Nevera de gran capacidad y bajo consumo', 899.99, './img/products/21.jpg', 5, 'LG', 1, 4),
('Cafetera Nespresso', 'Cafetera de capsulas rapida y compacta', 149.99, './img/products/22.jpg', 5, 'Nespresso', 1, 22),
('Microondas Samsung', 'Microondas con grill integrado', 129.99, './img/products/23.jpg', 5, 'Samsung', 1, 16),
('Lavadora Bosch', 'Lavadora eficiente y silenciosa', 599.99, './img/products/24.jpg', 5, 'Bosch', 1, 5),
('Aspiradora Dyson', 'Aspiradora sin cable de alta potencia', 499.99, './img/products/25.jpg', 5, 'Dyson', 1, 8),

-- Periféricos (6)
('Teclado Mecanico RGB', 'Teclado gaming con switches mecanicos', 99.99, './img/products/26.jpg', 6, 'Corsair', 1, 25),
('Raton Gaming', 'Raton ergonomico de alta precision', 59.99, './img/products/27.jpg', 6, 'Logitech', 1, 30),
('Monitor 27" 144Hz', 'Monitor gaming fluido y sin tearing', 279.99, './img/products/28.jpg', 6, 'AOC', 1, 10),
('Auriculares Bluetooth', 'Auriculares inalambricos con cancelacion', 199.99, './img/products/29.jpg', 6, 'Sony', 1, 18),
('Webcam Full HD', 'Camara ideal para streaming y videollamadas', 79.99, './img/products/30.jpg', 6, 'Logitech', 1, 14);

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
