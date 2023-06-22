/**
 * Archivo: modificacionlibro.js
 * 
 * Descripción: Permite realizar la modificación de un libro seleccionado.
 * 
 * Fecha: 22 de junio de 2023
 * 
 */
async function modificacionLibro() {
  // Recuperar los datos del formulario
  let idLibro = document.querySelector('#id').value;
  let titulo = document.querySelector('#titulo').value;
  let precio = document.querySelector('#precio').value;

  // Validar el ID del libro
  if (!idLibro || isNaN(idLibro) || idLibro <= 0) {
    alert('Se debe seleccionar un libro válido.');
    return;
  }

  // Validar la obligatoriedad de título y precio
  if (!titulo || !precio) {
    alert('Debe completar todos los campos obligatorios.');
    return;
  }

  // Realizar la llamada asíncrona al servicio de modificación de libros
  fetch('servicios/modificacionlibros.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      id: idLibro,
      titulo: titulo,
      precio: precio,
    }),
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (mensaje) {
      // Verificar el código de respuesta
      if (mensaje.codigo === '00') {
        // Mostrar mensaje de respuesta
        document.querySelector('#mensajes').innerText = mensaje.texto;
        // Limpiar el formulario de alta de libros
        document.querySelector('#formulario').reset();

        // Ejecutar la función de consulta de libros para actualizar la tabla
        consultalibros();
      }
    })
    .catch(function (error) {
      // Mostrar alerta en caso de error en la solicitud
      alert('Error en la modificación de libro: ' + error);
      consultalibros();
    });
}
