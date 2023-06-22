/**
 * Archivo inicio.js
 * Fecha: 20 de junio de 2023
 */

window.addEventListener('load', () => {
  consultalibros();
});

document.querySelector('#buscar').onchange = consultalibros;
