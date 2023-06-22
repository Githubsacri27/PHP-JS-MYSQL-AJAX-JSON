/**
 * Archivo: consultalibros.js
 * Descripción: Permite realizar la consulta de libros y mostrarlos en una tabla.
 *
 * @since   8.2
 */

/**
 * Realiza la consulta de libros y muestra los resultados en una tabla.
 *
 * @async
 * @function consultalibros
 *
 * @return {void}
 */
async function consultalibros() {
  let buscar = document.querySelector('#buscar').value;

  // Crea un objeto con los datos a enviar
  let data = {
    buscar: buscar
  };

  // Realiza la petición POST incluyendo los datos en el cuerpo de la solicitud
  fetch('servicios/consultalibros.php', {
    method: 'POST',
    body: JSON.stringify(data)
  })
    .then(response => response.json())
    .then(mensaje => {
      if (mensaje.codigo !== '00') {
        // Mostrar alerta en caso de error en la respuesta
        alert(mensaje.error);
      } else {
        // Construir la tabla con los libros
        let tabla = '';
        let libros = mensaje.libros;
        for (let i in libros) {
          tabla += `<tr onclick="trasladarDatos(this)">`;
          tabla += `<td class="idlibro">${libros[i].idlibros}</td>`;
          tabla += `<td class="titulo">${libros[i].titulo}</td>`;
          tabla += `<td class="precio">${libros[i].precio}</td>`;
          tabla += `</tr>`;
        }
        
        // Agregar la tabla al elemento con el id "listalibros"
        document.getElementById('listalibros').innerHTML = tabla;
      }
    })
    .catch(error => {
      // Mostrar alerta en caso de error en la solicitud
      alert('Error en la consulta de libros: ' + error);
    });
}

/**
 * Traslada los datos del libro seleccionado a los campos del formulario.
 *
 * @function trasladarDatos
 *
 * @param   {HTMLElement}   tr   Fila de la tabla que contiene los datos del libro.
 *
 * @return  {void}
 */
function trasladarDatos(tr) {
  const idlibro = tr.querySelector('.idlibro').innerText;
  const titulo = tr.querySelector('.titulo').innerText;
  const precio = tr.querySelector('.precio').innerText;

  document.querySelector('#id').value = idlibro;
  document.querySelector('#titulo').value = titulo;
  document.querySelector('#precio').value = precio;
}
