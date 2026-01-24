---

# PHP y control de versiones con Git y GitHub

## Preparación

Creamos carpeta **IAW - P1 - PHP y control de versiones con Git y GitHub** e inicializamos el entorno:

### Inicializamos el repositorio local

Ejecutamos `git init`, para convertir una carpeta normal en un repositorio.

### Creamos y/o modificamos un archivo

```powershell
new-Item -Path:"./gestor_notas.php" -ItemType "file"
```

### Añadir archivos al staging area

```git
git add --all
```

### Guardamos cambios

Si el repositorio esta vacio, no podremos

```git
git commit -m 'creando archivo ejercicio 1'
```

### Conexion con repositorio remoto

Creamos repositorio remoto en GitHub y copiamos el enlace `https://github.com/adesa-rep/IAW---P1---PHP-y-control-de-versiones-con-Git-y-GitHub.git`. Vemos que el repositorio se ha creado sobre la rama `main`.

#### Confirmamos rama de trabajo

Confirmamos qué rama usa por defecto nuestro **repositorio local** con `git branch --show-current` (tambien podemos verlo al hacer un commit). En este caso, ha devuelto `master` y, para evitar conflictos o crear ramas por error, renombramos la rama local para que coincida con la de GitHub, ejecutamos:

```git
git branch -M main
```

Creamos repositorio remoto en GitHub y copiamos el enlace `https://github.com/adesa-rep/adesa-rep-IAW---P1---PHP-y-control-de-versiones-con-Git-y-GitHub.git` para vincularlo con el local.

#### Publicamos/vinculamos repositorio local:

```git
git remote add origin https://github.com/adesa-rep/IAW---P1---PHP-y-control-de-versiones-con-Git-y-GitHub.git
```

#### Subimos los archivos

```git
git push -u origin main
```

## Ejercicio 1: Gestor de notas de estudiantes

Crea un programa en PHP que:

1. Tenga un array con estudiantes y sus notas:
   ```php
   $estudiantes = [
       "Ana" => [8, 7, 9],
       "Luis" => [5, 6, 4],
       "María" => [10, 9, 10],
       "Carlos" => [6, 6, 6]
   ];
   ```
2. Cree una función `calcularPromedio($notas)` que devuelva el promedio.
3. Recorra todos los estudiantes y:
   - Muestre su nombre
   - Muestre su promedio
   - Indique:
     - `"Aprobado"` si el promedio ≥ 6
     - `"Suspenso"` si el promedio < 6
4. Al final, muestre:
   - Cuántos aprobaron
   - Cuántos suspendieron
5. Muestra el estudiante con el promedio más alto.

### Código

```php
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
```

## Ejercicio 2: Simulador de carrito de compras

**002.php**

Crea un carrito de compras con este formato:

```php
$carrito = [
    ["producto" => "Portátil", "precio" => 1200, "cantidad" => 1],
    ["producto" => "Ratón", "precio" => 25, "cantidad" => 2],
    ["producto" => "Teclado", "precio" => 45, "cantidad" => 1],
];
```

El programa debe:

1. Mostrar cada producto con:
   - Nombre
   - Precio unitario
   - Cantidad
   - Subtotal (`precio * cantidad`)
2. Calcular el total general.
3. Aplicar descuentos:
   - Si el total > 1000 → 10% de descuento
   - Si el total > 500 → 5% de descuento
   - Si no → sin descuento
4. Mostrar:
   - Total sin descuento
   - Descuento aplicado
   - Total final
5. Usa una función `calcularTotal($carrito)`.

### Código

```php
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
```

## Ejercicio 3: Analizador de texto

**003.php**

Crea un programa que analice una frase:

```javascript
$texto =
  'PHP no está muerto… solo sigue trabajando silenciosamente en el 80% de Internet';
```

El programa debe:

1. Convertir el texto a minúsculas.
2. Contar cuántas palabras tiene.
3. Contar cuántas veces aparece cada palabra.
4. Mostrar solo las palabras que aparecen más de una vez.
5. Mostrar la palabra más repetida.
   **Pistas**:
   - `strtolower()`
   - `explode()`
   - `array_count_values()`

6\. Ignora palabras de menos de 3 letras.

### Código

```php
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
```

## Hoja CSS utilizada

```css
/* style.css - Estilos Globales */
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  /* background-color: rgb(15, 17, 17); */
  background-color: rgba(0, 0, 0, 0.846);
  color: whitesmoke;
  max-width: 900px;
  margin: 40px auto;
  padding: 20px;
}

h1 {
  color: rgba(14, 232, 14, 0.924);
  line-height: 0.7;
  border-bottom: 2px solid green;
  padding-bottom: 10px;
}

h2 {
  background-color: rgba(0, 128, 0, 0.291);
  border: 1px solid;
  border-radius: 10px;
  padding: 3px 5px;
}

table {
  width: 100%;
  border-collapse: collapse;
  /* background: white; */
  margin: 20px 0;
  box-shadow: 0 0px 10px rgba(245, 245, 245, 0.472);
  /* box-shadow: 0 0px 10px white; */
}

th,
td {
  padding: 12px 15px;
  border: 1px solid #ddd;
  text-align: left;
}

th {
  /* background-color: #3498db; */
  background-color: rgba(0, 128, 0, 0.291);
  color: white;
  text-transform: uppercase;
}

tr:nth-child(even) {
  background-color: rgba(245, 245, 245, 0.058);
}

/* Alertas de Estado */
.aprobado {
  color: #27ae60;
  font-weight: bold;
}

.suspenso {
  color: #e74c3c;
  font-weight: bold;
}

.resaltado {
  background-color: #f1c40f;
  font-weight: bold;
  padding: 2px 5px;
  color: black;
  /* border: 2px solid red; */
  border-radius: 5px;
}

.conteo {
  background-color: rgba(52, 152, 219, 0.274);
  padding: 2px 5px;
  border-radius: 5px;
  font-weight: bold;
  margin: 0px;
}

p:has(.conteo) {
  margin: 8px 100px;
}

/* Resumen final */
.card-resumen {
  background: rgba(245, 245, 245, 0.058);
  padding: 20px;
  border-left: 5px solid rgba(14, 232, 14, 0.924);
  margin-top: 20px;
}
```

# Cómo realizar la entrega:

1. Asegúrate de haber hecho `commit` de todos los archivos.
2. Copia la URL del repositorio.
3. Entrega **únicamente el enlace de GitHub**.
4. Comprueba que tu repositorio está **público**.
