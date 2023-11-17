<!DOCTYPE html>
<html>
<head>
    <title>Búsqueda de Inventario</title>
    <!-- Agrega los enlaces a Bootstrap y jQuery -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./dompdf/autoload.inc.php"></script>
</head>
<body>
    <div class="container">
        <!-- Búsqueda por Nombre -->
        <h3>Búsqueda por Nombre:</h3>
        <input type="text" class="form-control" id="producto" placeholder="Nombre del producto">
        <br>
        <button class="btn btn-primary" onclick="buscar('producto', 'resultadosProducto')">Buscar</button>
        <br><br>
        <!-- Resultados de la búsqueda por Nombre -->
        <div id="resultadosProducto"></div>

        <button class="btn btn-success" onclick="descargarPDF()">Descargar PDF</button>

        <!-- Búsqueda por Proveedor -->
        <h3>Búsqueda por Proveedor:</h3>
        <input type="text" class="form-control" id="proveedor" placeholder="Buscar por proveedor">
        <br>
        <button class="btn btn-primary" onclick="buscar('proveedor', 'resultadosProveedor')">Buscar</button>
        <br><br>
        <!-- Resultados de la búsqueda por Proveedor -->
        <div id="resultadosProveedor"></div>

        <button class="btn btn-success" onclick="descargarPDF()">Descargar PDF</button>

        <!-- Búsqueda por Existencias -->
        <h3>Búsqueda por Existencias mayores o igual:</h3>
        <input type="text" class="form-control" id="existencias" placeholder="cantidad en existencias">
        <br>
        <button class="btn btn-primary" onclick="buscar('existencias', 'resultadosExistencias')">Buscar</button>
        <br><br>
        <!-- Resultados de la búsqueda por Lugar -->
        <div id="resultadosExistencias"></div>

        <button class="btn btn-success" onclick="descargarPDF()">Descargar PDF</button>

            <!-- Búsqueda por Existencias -->
        <h3>Búsqueda por Bodegas:</h3>
        <input type="text" class="form-control" id="bodegas" placeholder="bodegas">
        <br>
        <button class="btn btn-primary" onclick="buscar('bodegas', 'resultadosBodegas')">Buscar</button>
        <br><br>
        <!-- Resultados de la búsqueda por Lugar -->
        <div id="resultadosBodegas"></div>

        <button class="btn btn-success" onclick="descargarPDF()">Descargar PDF</button>

        
    </div>

    <script>

    function buscar(tipo, resultadosID) {
        var valor = document.getElementById(tipo).value;
        $.ajax({
            type: 'POST',
            url: 'buscar.php',
            data: { tipo: tipo, valor: valor },
            success: function(data) {
                $('#' + resultadosID).html(data);
            }
        });
    }

    function descargarPDF() {
    window.location.href = 'descargar_pdf.php';
}


</script>
</body>
</html>

