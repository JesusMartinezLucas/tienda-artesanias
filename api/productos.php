<?php
// ...

// Función para obtener todos los productos con fotos y categorías
function getProductsDetails() {
    global $conn;

    $query = "SELECT P.*, C.nombreCategoria
              FROM Productos P
              INNER JOIN Categorias C ON P.idCategoria = C.id";

    $result = $conn->query($query);

    $productsDetails = array();
    while ($row = $result->fetch_assoc()) {

        $query = "SELECT F.* FROM Fotos F WHERE F.idProducto = " . $row['id'] . " AND F.tipo = 'Principal';";
        $result2 = $conn->query($query);
        $row['fotoPrincipal'] = $result2->fetch_assoc()['ruta'];

        $query = "SELECT F.* FROM Fotos F WHERE F.idProducto = " . $row['id'] . " AND F.tipo = 'Secundaria';";
        $result2 = $conn->query($query);

        $row['fotosSecundarias'] = array();
        while ($row2 = $result2->fetch_assoc()) {
            $row['fotosSecundarias'][] = $row2['ruta'];
        }

        $productsDetails[] = $row;
    }

    return $productsDetails;
}


function getProductDetails($id) {
    global $conn;

    $query = "SELECT P.*, C.nombreCategoria
              FROM Productos P
              INNER JOIN Categorias C ON P.idCategoria = C.id
              WHERE P.id = $id;";

    $result = $conn->query($query);

    $productDetails = array();

    $row = $result->fetch_assoc();

    $query = "SELECT F.* FROM Fotos F WHERE F.idProducto = " . $row['id'] . " AND F.tipo = 'Principal';";
    $result2 = $conn->query($query);
    $row['fotoPrincipal'] = $result2->fetch_assoc()['ruta'];

    $query = "SELECT F.* FROM Fotos F WHERE F.idProducto = " . $row['id'] . " AND F.tipo = 'Secundaria';";
    $result2 = $conn->query($query);

    $row['fotosSecundarias'] = array();
    while ($row2 = $result2->fetch_assoc()) {
        $row['fotosSecundarias'][] = $row2['ruta'];
    }

    $productDetails = $row;

    return $productDetails;
}


?>
