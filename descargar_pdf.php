<?php
session_start();

// Configura Dompdf
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

// Crea una instancia de Dompdf
$dompdf = new Dompdf();

// Carga el contenido HTML desde la variable de sesión
if (isset($_SESSION['search_results'])) {
    $contenidoHTML = "<div style='width:100%;'><table style='width:100%; border-collapse: collapse; margin-top: 10px;' border='1'>";
    $contenidoHTML .= "<tr style='background-color: #f2f2f2;'><th>ID</th><th>Producto</th><th>Proveedor</th><th>Existencias</th><th>Bodegas</th><th>Precio</th><th>Vencimiento</th><th>Introduccion</th></tr>";
    
    foreach ($_SESSION['search_results'] as $row) {
        $contenidoHTML .= "<tr>";
        $contenidoHTML .= "<td style='padding: 8px;'>" . $row['id'] . "</td>";
        $contenidoHTML .= "<td style='padding: 8px;'>" . $row['producto'] . "</td>";
        $contenidoHTML .= "<td style='padding: 8px;'>" . $row['proveedor'] . "</td>";
        $contenidoHTML .= "<td style='padding: 8px;'>" . $row['existencias'] . "</td>";
        $contenidoHTML .= "<td style='padding: 8px;'>" . $row['bodegas'] . "</td>";
        $contenidoHTML .= "<td style='padding: 8px;'>" . $row['precio'] . "</td>";
        $contenidoHTML .= "<td style='padding: 8px;'>" . $row['vencimiento'] . "</td>";
        $contenidoHTML .= "<td style='padding: 8px;'>" . $row['introduccion'] . "</td>";
        $contenidoHTML .= "</tr>";
    }
    
    $contenidoHTML .= "</table></div>";

    // Carga el contenido HTML
    $dompdf->loadHtml($contenidoHTML);

    // Renderiza el PDF
    $dompdf->render();

    // Descarga el PDF con un nombre específico
    $dompdf->stream('resultados_busqueda.pdf', array('Attachment' => 0));
} else {
    echo "Error: No se encontraron resultados.";
}
?>
