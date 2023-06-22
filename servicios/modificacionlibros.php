<?php

try {
  include_once 'conexionlibreria.php';
 
 
  // Recuperar los datos del formulario
  $data = json_decode(file_get_contents('php://input'), true);
  $idLibro = addslashes($data['id']);
  $titulo = addslashes($data['titulo']);
  $precio = addslashes($data['precio']);

  // Validar el ID del libro
  if (!$idLibro || !is_numeric($idLibro) || $idLibro <= 0) {
    throw new Exception('Se debe seleccionar un libro válido.');
  }

  // Validar título y precio
  if (!$titulo || !$precio || !is_numeric($precio) || $precio <= 0) {
    throw new Exception('Debe proporcionar un título y un precio válidos.');
  }

  // Confeccionar la sentencia SQL de modificación
  $sql = "UPDATE libros SET titulo = '$titulo', precio = $precio WHERE idLibros = $idLibro";

  // Ejecutar la sentencia SQL
  $resultado = mysqli_query($conexion, $sql);

  // Comprobar que se haya modificado alguna fila
  if (mysqli_affected_rows($conexion)) 
  {
    // Confeccionar el mensaje de respuesta
    $mensaje = ['codigo' => '00', 'texto' => 'Modificación del libro efectuada'];
  } 
  else 
  {
    // Confeccionar el mensaje de respuesta
    $mensaje = ['codigo' => '01', 'texto' => 'No se ha modificado ningún libro'];
  }
}
catch (Exception $e) 
{
  // En caso de error, enviar el mensaje de error correspondiente
  $mensaje = ['codigo' => $e->getCode(), 'error' => $e->getMessage()];
}
// Enviar el mensaje de respuesta en formato JSON
echo json_encode($mensaje);
?>