<?php
/**
 * Archivo: altalibros.php
 * Descripción: Permite realizar el alta de un libro en la base de datos.
 * Fecha: 20 de junio de 2023
 * PHP version 8.2
 *
 * @category Archivo_PHP
 * @package  Libreria_Proyecto
 * @author   Rubén Sacristán
 *
 * @global $conexion  Variable global de conexión a la base de datos.
 *
 * @param   mixed   $data   Datos del formulario en formato JSON.
 *
 * @return  void
 * @throws  Exception   Cuando los datos del libro son inválidos o hay errores en el alta.
 */
try {
    include_once 'conexionlibreria.php';

    // Recuperar los datos del formulario
    $data = json_decode(file_get_contents('php://input'), true);
    $titulo = addslashes($data['titulo']);
    $precio = addslashes($data['precio']);

    // Validar título y precio
    if (empty($titulo) || empty($precio) || !is_numeric($precio) || $precio <= 0) {
        throw new Exception('Datos de libro inválidos');
    }

    // Realizar la operativa de alta de libro
    $consulta = "INSERT INTO libros (titulo, precio) VALUES ('$titulo', $precio)";
    $resultado = mysqli_query($conexion, $consulta);

    // Controlar la respuesta de la operación
    if (!$resultado) {
        $codigoError = mysqli_errno($conexion);
        if ($codigoError == 1062) {
            throw new Exception('Título duplicado');
        } else {
            throw new Exception('Error al dar de alta el libro');
        }
    }

    // Construir el mensaje de respuesta
    $mensaje = [
        'codigo' => '00',
        'texto' => 'Alta del libro efectuada'
    ];

    // Enviar la respuesta en formato JSON
    echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    // En caso de error, enviar la respuesta con el error exacto
    $mensaje = [
        'codigo' => $e->getCode(),
        'error' => $e->getMessage()
    ];
    echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
}
?>
