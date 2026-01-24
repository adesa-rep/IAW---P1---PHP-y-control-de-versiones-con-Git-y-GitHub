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

// VARIABLES DE CONTROL
$aprobados = 0;
$suspensos = 0;
$promedioGeneral = []; // Nuestra "pizarra" o buffer auxiliar

foreach ($estudiantes as $nombre => $notas) {
    $promedioAlumno = calcularPromedio($notas);
    $promedioGeneral[$nombre] = $promedioAlumno; // Almacenamos el promedio usando el nombre como clave
    
    $estado = ($promedioAlumno >= 6) ? "Aprobado" : "Suspenso";
    echo "<p>Estudiante: $nombre | Promedio: " . number_format($promedioAlumno, 2) . " | Estado: $estado</p>";

  // Contar aprobados y suspensos. Cada vez que se evalúa un estudiante aumenta el contador correspondiente.
  if ($promedioAlumno >= 6) {
          $aprobados++; 
      } else {
          $suspensos++;
      }
}

// BÚSQUEDA DE RESULTADOS USANDO FUNCIONES DE ARRAY
$mejorNota = max($promedioGeneral); // Encuentra el valor más alto en el array
$mejorEstudiante = array_search($mejorNota, $promedioGeneral); // Busca la clave (nombre) asociada a ese valor

echo "\n--- Resumen Final ---\n";
echo "Total Aprobados: $aprobados\n";
echo "Total Suspensos: $suspensos\n";
echo "Estudiante con mejor nota: $mejorEstudiante con un " . number_format($mejorNota, 2);
?>