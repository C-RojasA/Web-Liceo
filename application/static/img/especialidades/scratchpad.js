
var number = 46786.62; 
// sin parámetros será el formato por defecto de tu navegador 
console.log("Formato automático --- " + number.toLocaleString()); 
// le puedes pasar un código de locale específico 
console.log("Formato en EE.UU. ---- " + number.toLocaleString("en-US")); 
console.log("Formato de España ---- " + number.toLocaleString("es-ES"));