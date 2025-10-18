<?php
include_once 'producto.php';

$productos = array();

$producto1 = new Producto();
$producto1->setId(1);
$producto1->setNombre("Producto A");
$producto1->setDescripcion("Descripción del Producto A");
$producto1->setPrecio(15.50);

array_push($productos, $producto1);
$producto2 = new Producto();
$producto2->setId(2);
$producto2->setNombre("Producto B");
$producto2->setDescripcion("Descripción del Producto B");
$producto2->setPrecio(25.00);

array_push($productos, $producto2);

$producto3 = new Producto();
$producto3->setId(3);
$producto3->setNombre("Producto C");
$producto3->setDescripcion("Descripción del Producto C");
$producto3->setPrecio(30.75);
array_push($productos, $producto3);

foreach ($productos as $prod) {
    echo "<h3>$prod</h3>";
}