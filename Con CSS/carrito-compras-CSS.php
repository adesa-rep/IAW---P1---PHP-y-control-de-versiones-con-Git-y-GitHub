<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Ejercicio 2 - Carrito</title>
</head>
<body>
    <h1>Simulador de Carrito de Compras</h1>
    <?php
    $carrito = [
        ["producto" => "Portátil", "precio" => 1200, "cantidad" => 1],
        ["producto" => "Ratón", "precio" => 25, "cantidad" => 2],
        ["producto" => "Teclado", "precio" => 45, "cantidad" => 1],
    ];

    // Función para calcular el total del carrito y mostrar la tabla
    function calcularTotal($carrito) {
        $total = 0;
        //encabezado de la tabla
        echo "
            <table>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cant.</th>
                    <th>Subtotal</th>
                </tr>
        ";

        //recorrer el carrito para mostrar cada elemento calculando subtotal
        foreach ($carrito as $elemento) {
            $sub = $elemento['precio'] * $elemento['cantidad'];
            $total += $sub;
            echo "
                <tr>
                    <td>{$elemento['producto']}</td>
                    <td>{$elemento['precio']}€</td>
                    <td>{$elemento['cantidad']}</td>
                    <td>{$sub}€</td>
                </tr>
            ";
        }
        echo "</table>";
        return $total;
    }

    $totalBruto = calcularTotal($carrito);
    $descPerc = 0;

    // Aplicar descuentos según el total bruto
    if ($totalBruto > 1000) $descPerc = 0.10;
    elseif ($totalBruto > 500) $descPerc = 0.05;
    else $descPerc = 0;

    //otra forma de hacerlo con llaves
    // if ($totalBruto > 1000) {
    //     $descPerc = 0.10;
    // }elseif ($totalBruto > 500) {
    //     $descPerc = 0.05;
    // } else {
    //     $descPerc = 0;
    // }

    $ahorro = $totalBruto * $descPerc;
    $precioFinal = $totalBruto - $ahorro;
    ?>

    <div class="card-resumen">
        <p>Total Bruto: <?php echo number_format($totalBruto, 2); ?>€</p>
        <p>Descuento (<?php echo ($descPerc*100); ?>%): - <?php echo number_format($ahorro, 2); ?>€</p>
        <h2>Total Final: <?php echo number_format($precioFinal, 2); ?>€</h2>
    </div>
</body>
</html>