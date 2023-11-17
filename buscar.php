<?php
session_start();

$tipo = $_POST['tipo'];
$valor = $_POST['valor'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventario";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consultas
    if ($tipo === 'producto') {
        $stmt = $conn->prepare("SELECT * FROM tbl_invesproduct WHERE producto = :valor");
    } elseif ($tipo === 'proveedor') {
        $stmt = $conn->prepare("SELECT * FROM tbl_invesproduct WHERE proveedor = :valor");
    } elseif ($tipo === 'existencias') {
        $stmt = $conn->prepare("SELECT * FROM tbl_invesproduct WHERE existencias >= :valor");
    } elseif ($tipo === 'bodegas') {
        $stmt = $conn->prepare("SELECT * FROM tbl_invesproduct WHERE bodegas = :valor");
    }

    $stmt->bindParam(':valor', $valor);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if (count($result) > 0) {
        $_SESSION['search_results'] = $result;

        echo "<div class='table-responsive'>";
        echo "<table class='table table-striped table-bordered'>";
        echo "<tr><th>ID</th><th>Producto</th><th>Proveedor</th><th>Existencias</th><th>Bodegas</th><th>Precio</th><th>Vencimiento</th><th>Introduccion</th></tr>";

        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['producto'] . "</td>";
            echo "<td>" . $row['proveedor'] . "</td>";
            echo "<td>" . $row['existencias'] . "</td>";
            echo "<td>" . $row['bodegas'] . "</td>";
            echo "<td>" . $row['precio'] . "</td>";
            echo "<td>" . $row['vencimiento'] . "</td>";
            echo "<td>" . $row['introduccion'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "</div>";
    } else {
        echo "No se encontraron resultados.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
