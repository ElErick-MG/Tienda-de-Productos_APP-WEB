<?php

$host = 'localhost';
$usuario = "root";
$clave = "";
$db = "tienda";

$conexion = new mysqli($host, $usuario, $clave, $db) or die($conexion->connect_errno);

$sql = "SELECT id, nombre, descripcion, precio FROM productoses";

if (!$resultado = $conexion->query($sql)){ # resultado->canal que se hace a la base de datos
    echo "La consulta falló";
}else{
    if($resultado->num_rows === 0){
        echo "No existen resultados";
    }else{
        while($producto = $resultado->fetch_assoc()){ # traer datos[fetch]- array asociado[associated]
            echo $producto['id'] . "- " . $producto['nombre'] . "<br>";
        }
    }
}
$conexion->close();

?>