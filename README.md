> [!TIP]
> ### Recomendación:
> A continuacion se muestra el enunciado del ejercicio cuyo codigo se desarrolla en la carpeta "Con CSS". Sin embargo, les invito a utilizar **Codespaces** y desde la carpeta **docker** ejecutar el comando `docker-compose up -d`. Luego, desde la pestaña de **puertos**, acceder al enlace bajo el campo **"direccion reenviada"** que seria el equivalente a **localhost:8080** en este entorno.

---
# PHP y control de versiones con Git y GitHub

**Desarrolla,** **controlando el versionado con Git y GitHub**

## Ejercicio 1: Gestor de notas de estudiantes

**001.php**

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
## Ejercicio 3: Analizador de texto
**003.php**

Crea un programa que analice una frase:
```PHP
$texto = "PHP no está muerto… solo sigue trabajando silenciosamente en el 80% de Internet";
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
