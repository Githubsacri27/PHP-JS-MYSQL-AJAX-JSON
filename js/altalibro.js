/**
 * Archivo: altalibro.js
 * 
 * Función para realizar el alta de un libro.
 * 
 * Fecha: 20 de junio de 2023
 */
async function altaLibro() {
  // Recuperar los datos del formulario
  let titulo = document.querySelector('#titulo').value;
  let precio = document.querySelector('#precio').value;

  // Validar la obligatoriedad de los campos
  if (titulo === '' || precio === '') {
    alert('Todos los campos son obligatorios');
    return;
  }

  // Realizar la llamada asíncrona al servicio de alta de libros
  fetch('servicios/altalibros.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      titulo: titulo,
      precio: precio
    })
  })
    .then(response => response.json())
    .then(mensaje => {
      // Verificar el código de respuesta
      if (mensaje.codigo === '00') {
        // Mostrar el mensaje de respuesta
        document.querySelector('#mensajes').innerText = mensaje.texto;
        // Limpiar el formulario de alta de libros
        document.querySelector('#formulario').reset();
          // Actualizar la lista de libros
          consultalibros();
      } else {
        // Mostrar una alerta con el mensaje de error
        throw mensaje.error;
      }
    })
    .catch(error => {
      // Mostrar una alerta en caso de error en la petición
      alert('Error en el alta de libro: ' + error);
    });
}
