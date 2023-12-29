<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require 'conexion.php'; // Archivo que contiene la configuración de la conexión
require 'autenticacion.php'; // Archivo que contiene la función de autenticación
require 'productos.php'; // Archivo que contiene la función para obtener productos

// API Endpoint para registrar un producto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar la autenticación
    if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
        $user = authenticateUser($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);

        if (!$user) {
            header('WWW-Authenticate: Basic realm="Tienda Artesanías"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Autenticación fallida';
            exit;
        }
    } else {
        header('WWW-Authenticate: Basic realm="Tienda Artesanías"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Autenticación requerida';
        exit;
    }

    // Resto del código para registrar un producto...
}

// API Endpoint para obtener todos los productos con fotos y categorías
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Resto del código para obtener todos los productos...

    if(isset($_GET["id"])){
        $productoConDetalles = getProductDetails($_GET["id"]);
        echo json_encode($productoConDetalles);
    }
    else {
        $productosConDetalles = getProductsDetails();
        echo json_encode($productosConDetalles);
    }
    
}

?>
