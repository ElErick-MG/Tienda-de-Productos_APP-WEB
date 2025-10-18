<?php

class Producto {
    private $id;
    private $nombre;
    private $descripcion;
    private $precio;

    function __construct() {
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getPrecio() {
        return $this->precio;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    public function setPrecio($precio) {
        $this->precio = $precio;
    }
    public function __toString() {
        return "ID: " . $this->id . ", Nombre: " . $this->nombre . ", Descripción: " . $this->descripcion . ", Precio: $" . $this->precio;
    }
}