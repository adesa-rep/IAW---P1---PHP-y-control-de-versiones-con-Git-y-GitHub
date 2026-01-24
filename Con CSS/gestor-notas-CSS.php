<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="./style.css">
    <title>Ejercicio 1 - Notas</title>
</head>
<body>
    <h1>Gestor de Notas de Estudiantes</h1>
    <?php
        $estudiantes = [
            "Ana" => [8, 7, 9],
            "Luis" => [5, 6, 4],
            "María" => [10, 9, 10],
            "Carlos" => [6, 6, 6]
        ];

        function calcularPromedio($notas) {
            //contadores
            $suma = 0;
            $cantidad = 0;

            foreach ($notas as $nota) {
                $suma += $nota;
                $cantidad++;
            }

            return ($cantidad > 0) ? ($suma / $cantidad) : 0;
        }

        $aprobados = 0;
        $suspensos = 0;
        $promedioGeneral = [];

        echo "<table>
                <tr>
                    <th>Estudiante</th>
                    <th>Promedio</th>
                    <th>Estado</th>
                </tr>";

        foreach ($estudiantes as $nombre => $notas) {
            //extraemos la lista de notas de cada alumno y calculamos el promedio
            $promedioCalculado = calcularPromedio($notas);
            //creamos un array con los promedios generales de cada alumno
            $promedioGeneral[$nombre] = $promedioCalculado;
            //determinamos el estado del alumno segun su promedio
            $estado = ($promedioCalculado >= 6) ? "Aprobado" : "Suspenso";
            //usamos el estado como clase para aplicar estilos CSS
            $clase = strtolower($estado);

            // Aumentamos los contadores para el resumen de aprobados y suspensos
            if ($promedioCalculado >= 6) {
                    $aprobados++; 
                } else {
                    $suspensos++;
                }

            echo "<tr>
                    <td>$nombre</td>
                    <td>" . number_format($promedioCalculado, 2) . "</td> 
                    <td class='$clase'>$estado</td>
                </tr>";

                //NOTA: usamos el operador de concatenacion porque estamos dentro de comillas dobles y no se interpreta la funcion
        }
        echo "</table>";

        // Calculamos la nota mayor y el estudiante correspondiente
        //inicializamos variables
        $mejorNota = -1;
        $mejorEstudiante = "";

        foreach ($promedioGeneral as $nombre => $nota) {
            if ($nota > $mejorNota) {
                $mejorNota = $nota;
                $mejorEstudiante = $nombre;
            }
        }
    ?>

     <!-- Cuadro resumen -->
    <div class="card-resumen">
        <p>Aprobados totales: <strong><?php echo $aprobados; ?></strong></p>
        <p>Suspensos totales: <strong><?php echo $suspensos; ?></strong></p>
        <p>Mejor estudiante: <span class="resaltado"><?php echo "$mejorEstudiante (" . number_format($mejorNota, 2) . ")"; ?></span></p>
    </div>
</body>
</html>