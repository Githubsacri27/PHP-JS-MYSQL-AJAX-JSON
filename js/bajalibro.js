/**
 * Archivo: bajalibro.js
 * Descripción: Permite dar de baja un libro seleccionado.
 *
 * @since   8.2
 */

/**
 * Operación de baja de un libro seleccionado.
 *
 * @async
 * @function bajaLibro
 *
 * @return {void}
 * 
 * @throws {Error} Si ocurre un error durante la solicitud o la operación de baja.
 */
async function bajaLibro() {
  // Recuperar el id del libro a dar de baja
  const idLibro = document.querySelector('#id').value;

  // Validar el id del libro
  if (!idLibro || isNaN(idLibro) || idLibro <= 0) {
    alert('Se debe seleccionar un libro válido');
    return;
  }

  // Realizar la llamada asíncrona al servicio de baja de libros
  fetch('servicios/bajalibros.php', {
    method: 'POST',
    body: JSON.stringify({ idLibro: idLibro }),
    headers: {
      'Content-Type': 'application/json'
    }
  })
    .then(response => response.json())
    .then(mensaje => {
      if (mensaje.codigo === '00') {
        // Mostrar el mensaje de respuesta en el <span id="mensajes">
        document.querySelector('#mensajes').innerText = mensaje.texto;
        // Limpiar el formulario de alta de libros
        document.querySelector('#formulario').reset();
        // Ejecutar la función de consulta de libros para actualizar la tabla
        consultalibros();
      } else {
        throw mensaje.error;
      }
    })
    .catch(error => {
      alert(error);
    });
}
