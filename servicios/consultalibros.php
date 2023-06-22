<?php
/**
 * Archivo: consultalibros.php
 * Descripción: Permite consultar libros en la base de datos según un criterio de búsqueda.
 *
 * PHP version 8.2
 *
 * @category Archivo_PHP
 * @package  Libreria_Proyecto
 * @author   Rubén Dacristán
 * @since    8.2
 *
 * @global $conexion  Variable global de conexión a la base de datos.
 *
 * @param   mixed   $data   Datos del formulario en formato JSON.
 *
 * @throws  Exception   Cuando no se encuentran datos o hay errores en la consulta.
 */
try {
    include_once 'conexionlibreria.php';

    // Recibir los datos enviados en la solicitud POST
    $data = json_decode(file_get_contents('php://input'), true);
    $buscar = $data['buscar'] ?? '';

    // Realizar la consulta de todos los libros con el filtro de búsqueda
    $consulta = "SELECT * FROM libros WHERE titulo LIKE '%$buscar%'";
    $resultado = mysqli_query($conexion, $consulta);

    // Verificar si la consulta devuelve resultados
    if (!$resultado) {
        throw new Exception('Sin datos');
    }

    // Extraer el array de libros del resultado de la consulta
    $libros = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

    // Construir el mensaje de respuesta
    $mensaje = [
        'codigo' => '00',
        'libros' => $libros
    ];

    // Enviar la respuesta en formato JSON
    echo json_encode($mensaje);
} catch (Exception $e) {
    // En caso de error, enviar la respuesta con el error exacto
    $mensaje = [
        'codigo' => $e->getCode(),
        'error' => $e->getMessage()
    ];
    echo json_encode($mensaje);
}
?>
