<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Ejercicio 3 - Analizador Pro</title>
</head>
<body>
    <h1>Analizador de Texto</h1>
    <?php
        // Usamos un texto con repeticiones para probar que el código funciona
        $texto = "PHP es genial porque PHP es rápido y porque PHP es el motor de Internet";

        echo "<p>Texto original:</p><span class='resaltado'>$texto</span>";

        // 1. Convertir a minúsculas
        $textoLimpio = strtolower($texto);

        // 2. Contar cuántas palabras tiene (Total original). Usamos explode para Convertir a array por espacios
        $todasLasPalabras = explode(" ", $textoLimpio);
        $totalPalabrasOriginal = count($todasLasPalabras);

        // 6. Ignorar palabras de menos de 3 letras
        // **** Inicializamos un array vacío para los resultados
        $filtradas = [];

        // **** Iteramos para recorrer todas las palabras
        foreach ($todasLasPalabras as $palabra) {
            // **** filtramos para quedarnos solo con las de 3 o más letras
            if (strlen($palabra) >= 3) {
                // Hacemos un "push" al nuevo array
                $filtradas[] = $palabra; 
            }
        }

        // 3. Contar cuántas veces aparece cada palabra. Esta funcion crea un array asociativo donde la clave es la palabra y el valor es el número de apariciones (es como uan especie de diccionario)
        $conteo = array_count_values($filtradas);
        // print_r($conteo);
        echo "<p>Conteo de palabras (para mostrar como son guardadas en al usar la funcion):</p>";
        foreach ($conteo as $palabra => $veces) {
            // echo "<span class='conteo'>$palabra</span>: $veces veces";
            echo "<p><span class='conteo'>$palabra</span>: $veces veces</p>";
        }

      // 5. Encontrar la palabra más repetida
      // Contadores para la palabra más repetida:
      $masRepetida = "";
      $maxVeces = 0;
      foreach($conteo as $palabra => $veces){
          if($veces > $maxVeces){
              $maxVeces = $veces;
              $masRepetida = $palabra;
          }
      }

      // ? Alternativa con funciones de array:
      // arsort($conteo); 
      // $maxVeces = array_key_first($conteo);

        //! 4. Mostrar solo las que aparecen más de una vez
        echo "<h3>Palabras repetidas (> 1 vez):</h3>";
        echo "
          <table>
          <tr>
            <th>Palabra</th>
            <th>Apariciones</th>
          </tr>
          ";
        foreach ($conteo as $palabra => $veces) {
            if ($veces > 1) { 
                echo "
                  <tr>
                    <td>$palabra</td>
                    <td>$veces</td>
                  </tr>
                ";
              }
        }
        if ($maxVeces <= 1){
            echo "
              <tr>
                <td colspan='2'>No hay palabras repetidas</td>
              </tr>
            ";
        }
        echo "</table>";
    ?>

    <div class="card-resumen">
        <p>Total de palabras en el texto: <strong><?php echo $totalPalabrasOriginal; ?></strong></p>
        <p>Palabras analizadas (de 3+ letras): <strong><?php echo count($filtradas); ?></strong></p>
        <p>Palabra ganadora: <span class="resaltado"><?php echo $masRepetida; ?></span></p>
    </div>
</body>
</html>