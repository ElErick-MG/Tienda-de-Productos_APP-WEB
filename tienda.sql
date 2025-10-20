CREATE TABLE productoses (
  id INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(255) DEFAULT NULL,
  descripcion TEXT,
  precio DECIMAL(10, 2) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE productosen (
  id INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(255) DEFAULT NULL,
  descripcion TEXT,
  precio DECIMAL(10, 2) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

INSERT INTO productoses (nombre, descripcion, precio) VALUES
('Camiseta básica', 'Camiseta de algodón 100% color blanco', 9.99),
('Pantalón de mezclilla', 'Pantalón de jean azul para hombre', 24.50),
('Zapatillas deportivas', 'Zapatillas ligeras para correr', 39.90),
('Reloj digital', 'Reloj resistente al agua con cronómetro', 19.75),
('Mochila escolar', 'Mochila con múltiples compartimientos', 15.20),
('Gorra ajustable', 'Gorra de color negro con logotipo bordado', 8.99),
('Audífonos Bluetooth', 'Auriculares inalámbricos con micrófono', 29.99);

INSERT INTO productosen (nombre, descripcion, precio) VALUES
('Basic T-Shirt', '100% cotton white t-shirt', 9.99),
('Denim Jeans', 'Blue jeans for men', 24.50),
('Running Sneakers', 'Lightweight sneakers for running', 39.90),
('Digital Watch', 'Waterproof watch with stopwatch', 19.75),
('School Backpack', 'Backpack with multiple compartments', 15.20),
('Adjustable Cap', 'Black cap with embroidered logo', 8.99),
('Bluetooth Headphones', 'Wireless earbuds with microphone', 29.99);
