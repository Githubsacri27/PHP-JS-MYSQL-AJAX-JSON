<?php
// Configuración de la conexión a la base de datos
/**
 * Archivo conexionlibreria.php
 * Versión de PHP: 8.2
 * Autor: Rubén Sacristán
 * Fecha: 20 de junio de 2023
 * Tipo de librería utilizada: mysqli (https://www.php.net/manual/es/book.mysqli.php)
 *
 * Este archivo contiene la configuración y establecimiento de la conexión a la base de datos para la librería.
 * 
 * Recomendación: Es altamente recomendable utilizar una contraseña segura para acceder a la base de datos.
 * Sin embargo, en este proyecto con fines de aprendizaje, no se ha implementado una contraseña.
 * En un entorno de producción, siempre se debe asegurar que se utilicen contraseñas seguras y proteger adecuadamente
 * el acceso a la base de datos para garantizar la seguridad.
 *
 */

// Configuración de la conexión a la base de datos
$host = 'localhost';
$usuario = 'root';
$contrasena = '';
$baseDeDatos = 'libreria';

// Crear la conexión
$conexion = mysqli_connect($host, $usuario, $contrasena, $baseDeDatos);

// Verificar si la conexión fue exitosa
if (!$conexion) {
  die('Error al conectar a la base de datos: ' . mysqli_connect_error());
}

// Establecer el conjunto de caracteres de la conexión
mysqli_set_charset($conexion, 'utf8');
?>
