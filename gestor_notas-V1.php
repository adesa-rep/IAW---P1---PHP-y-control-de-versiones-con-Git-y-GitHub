<?php
$estudiantes = [
  "Ana" => [8, 7, 9],
  "Luis" => [5, 6, 4],
  "María" => [10, 9, 10],
  "Carlos" => [6, 6, 6]
];

function calcularPromedio($notas) {
  return array_sum($notas) / count($notas);
}

$aprobados = 0;
$suspensos = 0;
$mejorPromedio = -1;
$mejorEstudiante = "";

foreach ($estudiantes as $nombre => $notas) {
    $promedio = calcularPromedio($notas);
    $estado = ($promedio >= 6) ? "Aprobado" : "Suspenso";
    
    echo "<p>Estudiante: $nombre | Promedio: " . number_format($promedio, 2) . " | Estado: $estado</p>";

if ($promedio >= 6) {
        $aprobados++; 
    } else {
        $suspensos++;
    }

    if ($promedio > $mejorPromedio) {
        $mejorPromedio = $promedio;
        $mejorEstudiante = $nombre;
    }
}

echo "\nTotal Aprobados: $aprobados\nTotal Suspensos: $suspensos\n";
echo "Estudiante con mejor nota: $mejorEstudiante (" . number_format($mejorPromedio, 2) . ")";
?>