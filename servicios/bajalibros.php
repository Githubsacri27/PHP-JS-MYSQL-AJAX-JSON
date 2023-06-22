<?php
// Conexión a la base de datos (incluye el archivo servicios/conexionlibreria.php)
include_once 'conexionlibreria.php';

try {
  // Recuperar el id del libro a dar de baja
  $datos = json_decode(file_get_contents('php://input'), true);
  $idLibro = $datos['idLibro'];

  // Validar el id del libro
  if (!isset($idLibro) || !is_numeric($idLibro) || $idLibro <= 0) {
    throw new Exception('Se debe seleccionar un libro válido');
  }

  // Confeccionar y ejecutar la sentencia SQL para dar de baja el libro
  $sql = "DELETE FROM libros WHERE idLibros = $idLibro";
  $resultado = mysqli_query($conexion, $sql);

  // Comprobar si se borró alguna fila
  if (mysqli_affected_rows($conexion) <= 0) {
    throw new Exception('Libro no existe');
  }

  // Confeccionar el mensaje de respuesta
  $mensaje = ['codigo' => '00', 'texto' => 'Baja del libro efectuada'];
} catch (Exception $e) {
  // En caso de error, enviar el mensaje de error correspondiente
  $mensaje = ['codigo' => $e->getCode(), 'error' => $e->getMessage()];
}

// Enviar el mensaje de respuesta en formato JSON
echo json_encode($mensaje);
?>
