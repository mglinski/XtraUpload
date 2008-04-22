<?php
/*
XtraUpload - File Hosting Software
Copyright (C) 2006-2007  Matthew Glinski and XtraFile.com
Link: http://www.xtrafile.com
-----------------------------------------------------------------
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program(LICENSE.txt); if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// Text Strings are defined using the following:
// {FILENAME)/{STRING_NUMBER}
// so for the file main2.php the first piece of text in this array would look like this:
// $lang['home']['1'] = 'Uploading your file! ';

//Language Charset, MetaTag
$lang_charset = "UTF-8";

$lang = array(); // Define the $lang variable as an array
####################################
####################################
####################################
// BEGIN FILE: include/pages/home.php
$lang['home'] = array(); 
$lang['home']['1'] = '¡Subiendo archivo! ';
$lang['home']['2'] = '<br>Tu archivo se esta subiendo! <br> Por favor espera a que finalice. <br />
La proxima vez podras usar la barra flash para ver la informacion del progreso. Subiendo archivo! ';
$lang['home']['3'] = 'Completado';
$lang['home']['4'] = 'Estado: ';
$lang['home']['5'] = 'de';
$lang['home']['6'] = 'enviado (';
$lang['home']['7'] = 'Tiempo restante: ';
$lang['home']['8'] = ' Segundos';
$lang['home']['9'] = 'Tiempo transcurrido: ';
$lang['home']['10'] = 'Para funciones más avanzadas puedes obtener una ';
$lang['home']['11'] = 'Subir archivos';
$lang['home']['12'] = 'Descargar archivos';
$lang['home']['13'] = 'Subir con Flash';
$lang['home']['14'] = 'Subir con URL';
$lang['home']['15'] = 'Subir con navegador';
$lang['home']['16'] = 'Estamos recuperando tu archivo.<br />
Por favor espera mientras te lo transferimos.';
$lang['home']['17'] = 'Selecciona un archivo para subir ( ';
$lang['home']['18'] = ' Megabytes de limite por archivo)';
$lang['home']['19'] = 'Enlace a subida de archivos:';
$lang['home']['20'] = '<strong>Descripcion:</strong> (Opcional) ';
$lang['home']['21'] = '<strong>Contraseña:</strong> (Opcional) ';
$lang['home']['22'] = '  Subir archivo  ';
$lang['home']['23'] = 'Archivo a subir';
$lang['home']['24'] = 'Introduzca un ID de Archivo para descargar:';
$lang['home']['25'] = '  ¡Descargar archivo!  ';
$lang['home']['26'] = '<b>Hacer archivo destado</b>';
$lang['home']['27'] = 'Si';
$lang['home']['28'] = 'No';
$lang['home']['29'] = 'Archivos destacados ';
$lang['home']['30'] = 'Enviar detalles por email';
$lang['home']['31'] = 'Separa las direcciones de email con comas(,)';
$lang['home']['32'] = 'Mas de 100 direcciones. Los emails escritos recibiran los detalles de la contraseña.';
$lang['home']['33'] = '¡Cuenta Premium!';
$lang['home']['34'] = 'Opciones';
$lang['home']['35'] = '';
// END FILE: include/pages/home.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/main.php
$lang['main'] = array(); 
$lang['main']['1'] = 'Se ha superado el maximo de intento(s) de ';
$lang['main']['2'] = ' sin exito!';
$lang['main']['3'] = 'Tienes que introducir el texto de la imagen antes de subir archivos<br />
';
$lang['main']['4'] = 'Intentalo de nuevo';
// END FILE: include/pages/main.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/logout.php
$lang['logout'] = array(); 
$lang['logout']['1'] = '¡Se ha cerrado la sesion correctamente!';
$lang['logout']['2'] = 'Estas siendo redireccionado.';
// END FILE: include/pages/logout.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/rate.php
$lang['rate'] = array(); 
$lang['rate']['1'] = 'Selecciona un archivo para votar.';
$lang['rate']['2'] = 'ID de archivo invalida. \nCompruebala e intentalo de nuevo.';
$lang['rate']['3'] = 'Archivo a votar( Segun ID de archivo ): ';
$lang['rate']['4'] = 'Obtener archivo';
$lang['rate']['5'] = 'Archivo no encontrado en la base de datos. <br />
Conprueba el enlace e intentalo de nuevo.';
$lang['rate']['6'] = 'Ver descripcion del archivo';
$lang['rate']['7'] = 'Votar este archivo ';
$lang['rate']['8'] = 'Tipo de archivo: ';
$lang['rate']['9'] = 'Descargar archivo';
$lang['rate']['10'] = 'Calificacion actual:';
$lang['rate']['11'] = 'No ha sido votado todavia!';
$lang['rate']['12'] = 'Descripcion:';
$lang['rate']['13'] = ' Votar este archivo  ';
$lang['rate']['14'] = '-- Selecciona Calificacion--';
$lang['rate']['15'] = '  Votar este archivo  ';
// END FILE: include/pages/rate.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/points.php
$lang['points'] = array(); 
$lang['points']['1'] = 'Tu cuenta ha sido extendida por ';
$lang['points']['2'] = ' Dias';
$lang['points']['3'] = 'No dispones de puntos para extender tu cuenta';
$lang['points']['4'] = 'No tienes permiso para extender tu cuenta';
$lang['points']['5'] = 'Nombre: ';
$lang['points']['6'] = 'Grupo: ';
$lang['points']['7'] = 'Tu cuenta ';
$lang['points']['8'] = 'Expira en ';
$lang['points']['9'] = ' Nunca expira';
$lang['points']['10'] = 'Puedes extender tu cuenta por ';
$lang['points']['11'] = ' dias con ';
$lang['points']['12'] = ' puntos';
$lang['points']['13'] = 'Actualmente tienes ';
$lang['points']['14'] = 'Extender tu cuenta';
$lang['points']['15'] = 'Debes estar logueado para manejar tus puntos.';
$lang['points']['16'] = 'Tu cuenta no tiene fecha de expiracion, por ello no puede ser extendida.';
$lang['points']['17'] = 'No tienes suficientes puntos para extenderla. <br />
El minimo requerido es ';
$lang['points']['18'] = 'puntos';
// END FILE: include/pages/points.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/support.php
$lang['support'] = array(); 
$lang['support']['1'] = 'Por favor, elija una de las siguientes opciones, a fin de recibir el servicio de atención al cliente más conforme. <br />
Actualmente no ofrecemos un numero de telefono de soporte gratuito, quizas sea ofrecido en un futuro. ';
$lang['support']['2'] = 'Preguntas frecuentes (FAQ)';
$lang['support']['3'] = 'Email de atención al cliente';
// END FILE: include/pages/support.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/url.php
$lang['url'] = array(); 
$lang['url']['1'] = 'Por favor seleccione un archivo para transferir antes de pulsar en "Subir".';
$lang['url']['2'] = 'Archivo demasiado grande. El archivo supera los ';
$lang['url']['3'] = ' megabytes';
$lang['url']['4'] = 'El tipo de archivo que has subido(';
$lang['url']['5'] = ') no esta permitido.';
$lang['url']['6'] = 'Success';
$lang['url']['7'] = 'Enlace de descarga : ';
$lang['url']['8'] = 'ID de archivo: ';
$lang['url']['9'] = '&quot;Vota este archivo&quot; Enlace: ';
$lang['url']['10'] = 'Descripción:';
$lang['url']['11'] = 'Contraseña:';
$lang['url']['12'] = 'Tu IP ';
$lang['url']['13'] = ' ha sido guardada por motivos de seguridad. ';
$lang['url']['14'] = 'Enlace de borrado:';
$lang['url']['15'] = 'Esconder BB Codes';
$lang['url']['16'] = 'Mostrar BB Codes';
$lang['url']['17'] = 'Esconder Video HTML Code';
$lang['url']['18'] = 'Mostrar Video HTML Code';
$lang['url']['19'] = 'Subida exitosa';
$lang['url']['20'] = 'Vista previa:';
$lang['url']['21'] = 'Tipo de archivo:';
$lang['url']['22'] = 'Mostrar BB Codes';
$lang['url']['23'] = 'Mostrar la imagen a tus amigos:';
$lang['url']['24'] = 'Enlace para foros 1:';
$lang['url']['25'] = 'Enlace para foros 2:';
$lang['url']['26'] = 'Vista previa para forums 1: ';
$lang['url']['27'] = 'Vista previa para forums 2: ';
$lang['url']['28'] = 'Enlace para sitios web (HTML): ';
$lang['url']['29'] = 'Enlace directo:';
$lang['url']['30'] = '¡Subida completada!<br />
Por favor espera mientras recuperamos la informacion del archivo.';
// END FILE: include/pages/url.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/upload.php
$lang['upload'] = array(); 
$lang['upload']['1'] = 'Archivo demasiado grande. El archivo supera los ';
$lang['upload']['2'] = ' megabytes';
$lang['upload']['3'] = 'El tipo de archivo subido(';
$lang['upload']['4'] = ') no esta permitido.';
$lang['upload']['5'] = 'Archivo no subido';
$lang['upload']['6'] = 'Redireccionando a la pagina principal';
$lang['upload']['7'] = 'Completado';
$lang['upload']['8'] = 'Enlace de descarga : ';
$lang['upload']['9'] = 'ID de Archivo: ';
$lang['upload']['10'] = '&quot;Vota este archivo&quot; Enlace: ';
$lang['upload']['11'] = 'Descripción:';
$lang['upload']['12'] = 'Contraseña:';
$lang['upload']['13'] = 'Tu IP ';
$lang['upload']['14'] = ' ha sido guardada por motivos de seguridad.';
$lang['upload']['15'] = 'Enlace de borrado:';
$lang['upload']['16'] = 'Ha ocurrido un error en la transferencia de su archivo:';
$lang['upload']['17'] = 'El archivo es mas grande del permitido por su cuenta.';
$lang['upload']['18'] = 'Ha ocurrido un error desconocido mientras se subia su archivo.';
$lang['upload']['19'] = 'No se puede conectar con el servidor FTP. ';
$lang['upload']['20'] = 'Logueo fallido con el servidor FTP ';
$lang['upload']['21'] = 'No es posible obtener el tamaño del archivo desde servidor FTP';
$lang['upload']['22'] = 'Error desconocido ';
$lang['upload']['23'] = 'El archivo temporal no ha sido encontrado, comprueba los permisos del directorio "temp"';
$lang['upload']['24'] = 'El archivo no puede ser movido, comprieba los permisos del directorio "files"';
// END FILE: include/pages/upload.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/addfolder.php
$lang['addfolder'] = array(); 
$lang['addfolder']['1'] = 'Crear directorio ';
$lang['addfolder']['2'] = 'Tu directorio ha sido creado.<br />
';
$lang['addfolder']['3'] = 'Volver a la Administrador de carpetas';
$lang['addfolder']['4'] = 'Informacion del directorio';
$lang['addfolder']['5'] = 'Nombre del directorio:';
$lang['addfolder']['6'] = 'Nombre del enlace:';
$lang['addfolder']['7'] = 'ID del directorio:';
$lang['addfolder']['8'] = 'Contraseña del directorio:';
$lang['addfolder']['9'] = 'Tu contraseña de administracion del directorio:';
$lang['addfolder']['10'] = 'Archivos a añadir, uno por línea:';
$lang['addfolder']['11'] = '';
// END FILE: include/pages/addfolder.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/view.php
$lang['view'] = array(); 
$lang['view']['1'] = ' Contraseña del directorio ';
$lang['view']['2'] = 'Enviar';
$lang['view']['3'] = 'Directorio del archivo: ';
$lang['view']['4'] = 'Creador: ';
$lang['view']['5'] = '&lt;-&lt; Sin descripción &gt;-&gt;';
$lang['view']['6'] = 'Descargar archivo';
$lang['view']['7'] = 'No tienes permiso para ver directorios';
$lang['view']['8'] = '¡Contraseña incorrecta!';
$lang['view']['9'] = 'El administrador de esta carpeta ha puesto una contraseña. <br />Por favor introduce la contraseña para ver el contenido.';
$lang['view']['10'] = 'Uploader';
$lang['view']['11'] = 'Nombre ';
$lang['view']['12'] = 'Enlace ';
$lang['view']['13'] = 'Estado ';
$lang['view']['14'] = 'Ver el directorio del archivo';
$lang['view']['15'] = 'Por favor introduce una ID: ';
$lang['view']['16'] = 'Enviar';
// END FILE: include/pages/view.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/advertising.php
$lang['advertising'] = array(); 
$lang['advertising']['1'] = 'Anunciarse con ';
$lang['advertising']['2'] = '¿Quiere atraer más visitantes a su sitio? ¡Nuestras campañas publicitarias le proporcionan las mejores opciones para que sus anuncios sean vistos por miles de visitantes cada día! ';
$lang['advertising']['3'] = 'Enlaces de texto:<br />	<strong><span class="style4">Precio : $15</span><span class="style11"> / Enlace de texto </span><br /> Validez: 1 mes ';
$lang['advertising']['4'] = 'Banners de 460X60: <br /><strong>Precio: </strong> <strong>20€ / Banner</strong><br />
<strong>Validez: </strong> <strong>1 mes';
$lang['advertising']['5'] = 'Por favor <a href="index.php?p=contact">Pincha Aqui</a> para ponerte en contacto con nosotros y que podamos enviarle un enlace de pago y procesar su información. ';
$lang['advertising']['6'] = 'Una vez efectuado el pago, su anuncio aparecera en unas 3 horas aproximadamente. ';
$lang['advertising']['7'] = 'Ayúdanos añadiendo una imagen enlace o los códigos siguientes a su sitio:';
$lang['advertising']['8'] = ' - Sube tus archivos gratis! ';
// END FILE: include/pages/advertising.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/delacc.php
$lang['delacc'] = array(); 
$lang['delacc']['1'] = '¡Borrado de cuenta completado! ';
$lang['delacc']['2'] = '¡Sentimos que te vallas! <br />
No se olvide de cancelar su suscripción paypal. ';
$lang['delacc']['3'] = 'Estas seguro de que deseas borrar esta cuenta?';
$lang['delacc']['4'] = 'Si';
$lang['delacc']['5'] = '¿Está usted seguro? Esto no podra deshacerse una vez realizado y usted perderá todos sus puntos';
$lang['delacc']['6'] = 'Confirmar';
// END FILE: include/pages/delacc.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/contactus.php
$lang['contactus'] = array(); 
$lang['contactus']['1'] = 'Soporte';
$lang['contactus']['2'] = 'Nuestro equipo de servicio de atención al cliente está a disposición de todos los miembros y está disponible en 10am - 10 pm todos los días a través de mensajes de correo electrónico.';
$lang['contactus']['3'] = 'Su mensaje ha sido enviado. Espere una respuesta en 24 horas ';
$lang['contactus']['4'] = 'Es necesario un email valido!';
$lang['contactus']['5'] = '¡Es necesario un titulo!';
$lang['contactus']['6'] = '¡Es necesario un mensaje!';
$lang['contactus']['7'] = '¡ERROR!';
$lang['contactus']['8'] = 'Tu direccion email:';
$lang['contactus']['9'] = 'Asunto:';
$lang['contactus']['10'] = 'Mensaje:';
$lang['contactus']['11'] = 'Imagen de seguridad:';
$lang['contactus']['12'] = 'Esto es necesario para prevenir abusos y envios de spam.';
$lang['contactus']['13'] = 'Enviar email';
// END FILE: include/pages/contactus.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/download.php
$lang['download'] = array(); 
$lang['download']['1'] = 'Enlace de descarga invalido';
$lang['download']['2'] = '¡El enlace de descarga es invalido!';
$lang['download']['3'] = 'Tu enlace de descarga: ';
$lang['download']['4'] = 'DESCARGA INSTANTANEA';
$lang['download']['5'] = '¡Enlace de descarga invalido!';
$lang['download']['6'] = 'La direccion IP actual no coincide con la de descarga.';
$lang['download']['7'] = '  Estas siendo redireccionado, por favor espera.';
$lang['download']['8'] = 'Ilimitado';
$lang['download']['9'] = 'Anonimo';
$lang['download']['10'] = 'Su archivo de descarga';
$lang['download']['11'] = ' Esta preparado ';
$lang['download']['12'] = 'Descargando, FAQ';
$lang['download']['13'] = '';
$lang['download']['14'] = '';
$lang['download']['15'] = '';
// END FILE: include/pages/download.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/editp.php
$lang['editp'] = array(); 
$lang['editp']['1'] = 'La configuracion de tu cuenta ha sido guardada.';
$lang['editp']['2'] = 'Edita la configuracion y pulsa enviar.';
$lang['editp']['3'] = 'Nombre:';
$lang['editp']['4'] = 'Nueva contraseña:';
$lang['editp']['5'] = 'Nuevo email:';
$lang['editp']['6'] = 'Enviar cambios';
// END FILE: include/pages/editp.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/editimg.php
$lang['editimg'] = array(); 
$lang['editimg']['1'] = 'Archivo ';
$lang['editimg']['2'] = ' Ha sido borrado';
$lang['editimg']['3'] = 'No tienes permiso para borrar archivos';
$lang['editimg']['4'] = 'Maneja tus archivos';
$lang['editimg']['5'] = 'Nombre';
$lang['editimg']['6'] = 'Veces descargado';
$lang['editimg']['7'] = '¿Borrar?';
$lang['editimg']['8'] = 'Archivo no encontrado';
$lang['editimg']['9'] = 'No tienes permiso para manejar archivos';
$lang['editimg']['9'] = 'Estado de archivo';
// END FILE: include/pages/editimg.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/errordl.php
$lang['errordl'] = array(); 
$lang['errordl']['1'] = 'Limite de transferencia excedido! </font></strong> <br />
Para descargar mas debes usar una cuenta premium. <br /><strong>O espera 1 hora para seguir descargando ';
$lang['errordl']['2'] = 'Por favor lee nuestros ';
$lang['errordl']['3'] = 'Terminos de servicio / Codigo de conducta';
// END FILE: include/pages/errordl.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/error.php
$lang['error'] = array(); 
$lang['error']['1'] = '¡Archivo no encontrado! </span><br /> El archivo especificado no se encuentra en nuestros servidores! ';
$lang['error']['2'] = 'Esto puede deberse a distintas razones: ';
$lang['error']['3'] = '1. Denuncias al archivo por infringir nuestras normas.<br /> 2. El archivo ha estado inactivo durante demasiado tiempo<br /> 3. El usuario ha borrado el archivo ';
// END FILE: include/pages/error.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/fastpass.php
$lang['fastpass'] = array(); 
$lang['fastpass']['1'] = 'Registro para una cuenta <br /> Todas las cuentas se activan al instante';
$lang['fastpass']['2'] = '¿Tiene problemas para registrarse? <a href="index.php?p=contactus">Contacte con nosotros</a>. ';
$lang['fastpass']['3'] = 'Una vez que el pago se ha hecho, una contraseña se genera automáticamente y es enviada a usted. Por favor, comprueba tu bandeja de correo no deseado si no encuentras este mensaje. Ninguna contraseña le será enviada sin confirmación de pago.';
// END FILE: include/pages/fastpass.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/folder.php
$lang['folder'] = array(); 
$lang['folder']['1'] = 'Administrar tus directorios';
$lang['folder']['2'] = 'Ver';
$lang['folder']['3'] = 'Borrar';
$lang['folder']['4'] = 'Crear nuevo directorio';
$lang['folder']['5'] = 'Para crear una nueva carpeta de archivos reuna los enlaces de los archivos que desea añadir a su carpeta. Pegue los enlaces uno por línea en el cuadro de texto de enlaces en la página siguiente y pulse continuar.';
$lang['folder']['6'] = 'Nombre:';
$lang['folder']['7'] = 'Contraseña: ';
$lang['folder']['8'] = 'Crear directorio';
$lang['folder']['9'] = 'No tienes permisos para crear directorios de archivos';
$lang['folder']['10'] = 'Tu directorio ha sido editado.<br /><br />
Por favor espera mientras eres redireccionado.';
$lang['folder']['11'] = 'Editar directorio';
$lang['folder']['12'] = 'Borrar archivos';
$lang['folder']['13'] = 'Agregar archivos';
$lang['folder']['14'] = ' Guardar archivo';
$lang['folder']['15'] = ' Agregar archivo al directorio';
$lang['folder']['16'] = 'Enviar cambios';
$lang['folder']['17'] = ' ¡Archivo(s) borrado(s)!';
$lang['folder']['18'] = 'Contraseña de administrador actualizada!';
$lang['folder']['19'] = ' ¡Nuevos archivos añadidos!';
$lang['folder']['20'] = 'Directorio borrado!';
$lang['folder']['21'] = 'Administrar directorio: ';
$lang['folder']['22'] = 'Administrar archivos del directorio';
$lang['folder']['23'] = 'Agregar nuevos archivos';
$lang['folder']['24'] = 'Cambiar contraseña de administrador';
$lang['folder']['26'] = 'Borrar ese directorio';
$lang['folder']['27'] = 'Cambiar contraseña de administrador:';
$lang['folder']['28'] = 'Nueva contraseña de administrador:';
$lang['folder']['29'] = 'Agregar archivos:';
$lang['folder']['30'] = 'Agregar enlaces de archivos. uno por linea:';
$lang['folder']['31'] = 'Agregar nuevos archivos';
$lang['folder']['32'] = 'Actualizar contraseña de administrador';
$lang['folder']['33'] = 'Administrar archivos:';
$lang['folder']['34'] = 'Borrar';
$lang['folder']['35'] = 'Enlace de archivo';
$lang['folder']['36'] = 'Borrar archivos seleccionados';
$lang['folder']['37'] = '¡No existen directorios con los detalles especificados!';
$lang['folder']['38'] = 'Borrar archivo ';
$lang['folder']['39'] = 'Por favor intruduzca la contraseña de administrador para borrar esta carpeta';
$lang['folder']['40'] = 'ID de directorio: ';
$lang['folder']['41'] = 'Contraseña de administrador: ';
$lang['folder']['42'] = 'Borrar directorio';
$lang['folder']['43'] = 'Agregar archivos al directorio ';
$lang['folder']['44'] = 'Acceda a su carpeta antes de añadir archivos a la misma! ';
$lang['folder']['45'] = 'Administrar directorios ';
$lang['folder']['46'] = '¡Acceda asu carpeta antes de comenzar a administrarla! ';
$lang['folder']['47'] = 'Añadir archivos';
$lang['folder']['48'] = 'Directorio de administrador';
$lang['folder']['49'] = '¿Ya tienes una carpeta? Inicia sesion para administrarla! ';
$lang['folder']['50'] = '';
// END FILE: include/pages/folder.php
####################################
####################################
####################################
/*
// BEGIN FILE: include/pages/flash.php
$lang['flash'] = array(); 
$lang['flash']['1'] = 'Completado';
$lang['flash']['2'] = ' Enlace de descarga : ';
$lang['flash']['3'] = 'ID del archivo: ';
$lang['flash']['4'] = '&quot;Votar este archivo&quot; Enlace: ';
$lang['flash']['5'] = 'Descripcion: ';
$lang['flash']['6'] = 'Contraseña: ';
$lang['flash']['7'] = 'Tu IP ';
$lang['flash']['8'] = ' ha sido guardada por motivos de seguridad. ';
$lang['flash']['9'] = ' There was a problem uploading your file. You are being transferred back to the main page.';
$lang['flash']['10'] = 'Enlace de borrado:';
// END FILE: include/pages/flash.php
####################################
####################################
####################################
*/
// BEGIN FILE: include/pages/history.php
$lang['history'] = array(); 
$lang['history']['1'] = 'El historial de tu cuenta se muestra aqui para el usuario ';
$lang['history']['2'] = 'Una vez que expire su cuenta, necesitara volver a registrarse, a fin de continuar con nuestros servicios. ';
$lang['history']['3'] = 'Total de puntos de usuario adquiridos: ';
$lang['history']['4'] = 'Ultimo archivo descargado: ';
$lang['history']['5'] = 'Tamacño de archivo (en kb): ';
$lang['history']['6'] = 'Debes estar logueado para acceder a tu historial de descargas';
// END FILE: include/pages/history.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/join.php
$lang['join'] = array(); 
$lang['join']['1'] = 'Registro Premium ';
$lang['join']['2'] = 'SU IP SE HA REGISTRADO POR MOTIVOS DE SEGURIDAD: ';
$lang['join']['3'] = 'Usted debe estar de acuerdo con lo siguiente para continuar el registro';
$lang['join']['4'] = 'PULSANDO EL BOTON "VOLVER" EN CUALQUIER MOMENTO, SU NOMBRE DE USUARIO NO SE REGISTRARA. Usted podrá actualizar su información dentro de la Zona de Fast Pass. ';
$lang['join']['5'] = 'Terminos y condiciones';
$lang['join']['6'] = ' Estoy deacuerdo';
$lang['join']['7'] = ' No estoy deacuerdo';
$lang['join']['8'] = 'Continuar';
$lang['join']['9'] = 'Debe estar de acuerdo con los terminos y condiciones para crear su cuenta.';
// END FILE: include/pages/.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/login.php
$lang['login'] = array(); 
$lang['login']['1'] = 'Ingresar a  ';
$lang['login']['2'] = 'Nombre: ';
$lang['login']['3'] = 'Contraseña:';
$lang['login']['4'] = '¿Has perdido tu contraseña?';
$lang['login']['5'] = '¡Crear una nueva cuenta!';
$lang['login']['6'] = 'Nombre/Contraseña no ha(n) sido encontrados en nuestra base de datos. Por favor intentelo de nuevo.';
$lang['login']['7'] = 'El tiempo de tu sesion ha acabado.<br />
Por favor logueese de nuevo';
$lang['login']['8'] = '¡Has ingresado correctamente!';
$lang['login']['9'] = 'Por favor espera mientras eres redireccionado.';
// END FILE: include/pages/logout.php
// END FILE: include/pages/login.php
####################################
####################################
####################################
// BEGIN FILE: include/step1.php
$lang['step1'] = array(); 
$lang['step1']['1'] = 'Elija un nombre:';
$lang['step1']['2'] = 'Elija un tipo de pago';
$lang['step1']['3'] = 'Continuar';
// END FILE: include/step1.php
####################################
####################################
####################################
// BEGIN FILE: include/step2.php
$lang['step2'] = array(); 
$lang['step2']['1'] = 'Miembresia premium';
// END FILE: include/step2.php
####################################
####################################
####################################
// BEGIN FILE: include/step3.php
$lang['step3'] = array(); 
$lang['step3']['1'] = 'Membresia premium';
// END FILE: include/step3.php
####################################
####################################
####################################
// BEGIN FILE: include/no_cost.php
$lang['no_cost'] = array(); 
$lang['no_cost']['1'] = 'Este correo electrónico ya está en uso. Por favor, introduzca uno diferente';
$lang['no_cost']['2'] = 'Ese nombre de usuario ya está en uso. Por favor, introduzca uno diferente';
$lang['no_cost']['3'] = 'Las contraseñas no coinciden';
$lang['no_cost']['4'] = 'No se permiten mas registros para este grupo';
$lang['no_cost']['5'] = '
<h3 align="center">Gracias por registrarse con nosotros!</h3>
<div align="center">Tu cuenta ha sido configurada.<br />Por favor espera mientras eres redireccionado.</div>
';
$lang['no_cost']['6'] = 'Por favor introduce una contraseña';
$lang['no_cost']['7'] = 'Las contraseñas no coinciden. Por favor, compruebelas.';
$lang['no_cost']['8'] = 'Por favor, introduzca un nombre de usuario superior a 6 caracteres';
$lang['no_cost']['9'] = 'Por favor introduzca una cuenta de email valida.';
$lang['no_cost']['10'] = 'Enter Information ';
$lang['no_cost']['11'] = 'Nombre';
$lang['no_cost']['12'] = 'Contraseña';
$lang['no_cost']['13'] = 'Confirmar contraseña';
$lang['no_cost']['14'] = 'Direccion de email ';
$lang['no_cost']['15'] = '  Registrar  ';
$lang['no_cost']['16'] = 'La dirección de correo electrónico que has introducido no es válida.';
$lang['no_cost']['17'] = '';
// END FILE: include/no_cost.php
####################################
####################################
####################################
// BEGIN FILE: include/payment/paypal.php
$lang['paypal'] = array(); 
$lang['paypal']['1'] = 'Apreciado usuario, '."\n\n".' Su cuenta premium en ';
$lang['paypal']['2'] = ' ha sido aprobada. Sus datos de acceso aparecen a continuacion.'."\n".'';
$lang['paypal']['3'] = "\n".'Nombre: ';
$lang['paypal']['4'] = "\n".'Contraseña: ';
$lang['paypal']['5'] = 'Gracias por registrarse,'."\n";
$lang['paypal']['6'] = ' Staff';
$lang['paypal']['7'] = '¡Pague ahora con PayPal!';
// END FILE: include/payment/paypal.php
####################################
####################################
####################################
// BEGIN FILE: include/payment/authnet.php
$lang['authnet'] = array(); 
$lang['authnet']['1'] = 'Apreciado usuario, '."\n\n".' Su cuenta premium en ';
$lang['authnet']['2'] = ' ha sido aprobada. Sus datos de acceso aparecen a continuacion.'."\n"."\n";
$lang['authnet']['3'] = "\n".'Nombre: ';
$lang['authnet']['4'] = "\n".'Contraseña: ';
$lang['authnet']['5'] = 'Gracias de nuevo por el registro, '."\n";
$lang['authnet']['6'] = ' Staff';
$lang['authnet']['7'] = 'Número de tarjeta de crédito';
$lang['authnet']['8'] = 'Fecha de caducidad de la tarjeta';
$lang['authnet']['9'] = 'Codigo de seguridad';
$lang['authnet']['10'] = 'Primer nombre';
$lang['authnet']['11'] = 'Apellidos';
$lang['authnet']['12'] = 'Direccion';
$lang['authnet']['13'] = 'Ciudad';
$lang['authnet']['14'] = 'Provincia';
$lang['authnet']['15'] = 'Codigo postal ';
$lang['authnet']['16'] = 'Direccion de email';
$lang['authnet']['17'] = 'Numero de telefono';
$lang['authnet']['18'] = 'Pagar con tarjeta de credito';
$lang['authnet']['19'] = 'Transaccion correcta. <br />
Por favor comprueba tu email para ver los datos de ingreso.';
$lang['authnet']['20'] = 'Transaccion incorrecta. <br />
Razon: ';
$lang['authnet']['21'] = '<br /> Por favor, espere a que un correo electrónico de nuestro departamento de ventas.';
// END FILE: include/payment/authnet.php
####################################
####################################
####################################
// BEGIN FILE: include/payment/2co.php
$lang['2co'] = array(); 
$lang['2co']['1'] = 'Querido usuario, '."\n". 'Su cuenta premium en ';
$lang['2co']['2'] = ' ha sido aprobad. Sus datos de acceso aparecen a continuacion. '."\n"."\n";
$lang['2co']['3'] = "\n".'Nombre: ';
$lang['2co']['4'] = "\n".'Contraseña: ';
$lang['2co']['5'] = 'Gracias de nuevo por registrarse,'."\n";
$lang['2co']['6'] = ' Staff';
$lang['2co']['7'] = 'Pagar con 2CheckOut';
// END FILE: include/payment/2co.php
####################################
####################################
####################################
// BEGIN FILE: include/payment/check.php
$lang['check'] = array(); 
$lang['check']['1'] = ' Gracias por solicitar una suscripcion de ';
$lang['check']['2'] = 'Por favor siga las instrucciones a continuación, para pagar.';
// END FILE: include/payment/check.php
####################################
####################################
####################################
// BEGIN FILE: /script.php
$lang['script'] = array(); 
$lang['script']['1'] = 'Lo sentimos El tipo de archivo que ha intentado subir(';
$lang['script']['2'] = ') No esta permitido. \nPor favor intentelo de nuevo.';
$lang['script']['3'] = 'Por favor selecciona un archivo para subir.';
$lang['script']['4'] = 'Por favor proporcione una URL válida para subir.';
// END FILE: /script.php
####################################
####################################
####################################
// BEGIN FILE: /download2.php
$lang['download2'] = array(); 
$lang['download2']['1'] = 'Este archivo ha sido protegido con contraseña por el usuario.<br /> 
Por favor introduzca la clave de acceso a la descarga.';
$lang['download2']['2'] = 'Contraseña: ';
$lang['download2']['3'] = 'Enviar';
// END FILE: /download2.php
####################################
####################################
####################################
// BEGIN FILE: /captcha.php
$lang['captcha'] = array(); 
$lang['captcha']['1'] = 'Debes escribir los ';
$lang['captcha']['2'] = ' caracteres</b> y enviar el formulario antes de subir o bajar archivos.';
$lang['captcha']['3'] = '¿No puedes leerlo? ';
$lang['captcha']['4'] = 'Enviar';
$lang['captcha']['5'] = 'Generar una nueva imagen';
// END FILE: /captcha.php
####################################
####################################
####################################
// BEGIN FILE: ./include/open.functions.inc.php
$lang['open'] = array(); 
$lang['open']['1'] = 'Caracteristica';
$lang['open']['2'] = 'Precio';
$lang['open']['3'] = '¡Gratis!';
$lang['open']['4'] = 'Limite de descarga';
$lang['open']['5'] = 'Ilimitado';
$lang['open']['6'] = 'MB por hora';
$lang['open']['7'] = 'Tamaño max. de archivo';
$lang['open']['8'] = 'Ilimitado';
$lang['open']['9'] = 'MB';// MB = MegaByte
$lang['open']['10'] = 'Gestor de descargas ';
$lang['open']['11'] = 'Subir con el navegador ';
$lang['open']['12'] = 'Subir archivos remotos ';
$lang['open']['13'] = 'Subir archivos por flash ';
$lang['open']['14'] = 'Ver directorios ';
$lang['open']['15'] = 'Crear directorios ';
$lang['open']['16'] = 'Administrar sus archivos ';
$lang['open']['17'] = 'Imagen de seguridad antes de descargar';
$lang['open']['18'] = 'Imagen de seguridad en la pagina principal';
$lang['open']['19'] = 'Expira ';
$lang['open']['20'] = ' Dias';
$lang['open']['21'] = ' Nunca expira ';
$lang['open']['22'] = 'Enviar enlaces por email ';
$lang['open']['23'] = 'Velocidad de descarga ';
$lang['open']['24'] = ' KBPS';
$lang['open']['25'] = ' Sin limite';
$lang['open']['26'] = 'Cuentas restantes';
$lang['open']['27'] = 'Ilimitadas';
$lang['open']['28'] = 'Accounts Left';
$lang['open']['29'] = '¡Registrarse!';
$lang['open']['30'] = 'No requiere registro';
$lang['open']['31'] = '  ¡Registrarse!';
$lang['open']['32'] = 'Estos tipos de archivos estan ';
$lang['open']['33'] = 'no ';
$lang['open']['34'] = 'Tipo de archivo';
$lang['open']['35'] = 'Descargas';
$lang['open']['36'] = '¡Descargar ahora!';
$lang['open']['37'] = 'permitidos: ';

// END FILE: include/open.functions.inc.php
####################################
####################################
####################################
// BEGIN FILE: ./include/functions.inc.php
$lang['functions'] = array(); 
$lang['functions']['1'] = 'El archivo no existe';
$lang['functions']['2'] = 'El archivo ha sido borrado';
$lang['functions']['3'] = '¡Archivo encontrado!';
$lang['functions']['4'] = '¡Archivo borrado!';
$lang['functions']['5'] = '¡Archivo borrado!';
$lang['functions']['6'] = '¡Archivo expirado!';
$lang['functions']['7'] = '¡Archivo no encontrado!';
$lang['functions']['8'] = 'Ningun archivo descargado en esta sesion';
$lang['functions']['9'] = '';
// END FILE: ./include/functions.inc.php
####################################
####################################
####################################
// BEGIN FILE: ./download_summary.tpl.php
$lang['download_summary'] = array(); 
$lang['download_summary']['1'] = 'Nombre de archivo';
$lang['download_summary']['2'] = 'Uploader';
$lang['download_summary']['3'] = 'Tamaño';
$lang['download_summary']['4'] = 'Descargas';
$lang['download_summary']['5'] = 'Transferencia permitida';
$lang['download_summary']['6'] = 'MB por hora';
$lang['download_summary']['7'] = 'Descripcion';
$lang['download_summary']['8'] = 'Al descargar un archivo usted está de acuerdo con nuestros ';
$lang['download_summary']['9'] = 'Terminos del servicio';
$lang['download_summary']['10'] = '';
// END FILE: ./download_summary.tpl.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/news.php
$lang['news'] = array(); 
$lang['news']['1'] = 'Publicada en: ';
$lang['news']['2'] = 'Autor: ';
$lang['news']['3'] = '¡Pincha aqui para leer mas!';
$lang['news']['4'] = '';
// END FILE: ./include/kernel/news.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/header.php
$lang['forgotpass'] = array(); 
$lang['forgotpass']['1'] = 'Lo sentimos tu email no aparece en nuestra base de datos. Por favor intentelo de nuevo.';
$lang['forgotpass']['2'] = 'Apreciado ';
$lang['forgotpass']['3'] = 'Usted (o alguien haciéndose pasar por usted) ha restablecido su contraseña en ';
$lang['forgotpass']['4'] = 'Nombre';
$lang['forgotpass']['5'] = 'Nueva contraseña';
$lang['forgotpass']['6'] = 'Por favor apunte la nueva contraseña.';
$lang['forgotpass']['7'] = 'No responda a este mensaje ya que esta dirección no está comprobada';
$lang['forgotpass']['8'] = '¡Gracias!';
$lang['forgotpass']['9'] = 'Staff';
$lang['forgotpass']['10'] = 'Su contraseña ha sido cambiada y enviada a usted por email. <br />
Por favor comprueba tu bandeja de correo no deseado o span si o lo encuentras en tu bandeja de entrada.';
$lang['forgotpass']['11'] = 'Restablecer la contraseña de la cuenta';
$lang['forgotpass']['12'] = 'Contraseña olvidada';
$lang['forgotpass']['13'] = 'Direccion de email: ';
// END FILE: ./include/kernel/header.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/delfile.php
$lang['delfile'] = array(); 
$lang['delfile']['1'] = 'El archivo no ha sido encontrado.';
$lang['delfile']['2'] = 'Redireccionando a la pagina principal.';
$lang['delfile']['3'] = 'El archivo no ha sido encontrado';
$lang['delfile']['4'] = 'El archivo ha sido eliminado correctamente.';
$lang['delfile']['5'] = 'Borrar archivo: ';
$lang['delfile']['6'] = 'Tu archivo no sera eliminado.\nYou are being to the main page.';
$lang['delfile']['7'] = '¿Estás seguro de que quieres eliminar este archivo?\nCuando hagas clic en sí no habra vuelta atrás.';
$lang['delfile']['8'] = ' Si, borrar mi archivo. ';
$lang['delfile']['9'] = ' No, consevar mi archivo. ';
$lang['delfile']['10'] = 'Borrar archivo';
$lang['delfile']['11'] = '';
// END FILE: ./include/kernel/delfile.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/comments.php
$lang['comments'] = array(); 
$lang['comments']['1'] = 'Por favor, espere mientras le enviamos de nuevo a la descarga del archivo. ';
$lang['comments']['2'] = '¡Tu comentario ha sido agragado!';
$lang['comments']['3'] = 'El comentario ha sido ';
$lang['comments']['4'] = 'ocultado';
$lang['comments']['5'] = 'mostrado';
$lang['comments']['6'] = '¡El comentario ha sido eliminado!';
$lang['comments']['7'] = '¡El comentario ha sido editado!';
$lang['comments']['8'] = 'Nombre:';
$lang['comments']['9'] = 'Titulo:';
$lang['comments']['10'] = 'URL Pagina web:';
$lang['comments']['11'] = 'Direccion email:';
$lang['comments']['12'] = 'Comentario:';
$lang['comments']['13'] = 'Editar Comentario';
$lang['comments']['14'] = 'Borrar Formulario';
$lang['comments']['15'] = 'Ninguna acción seleccionada. No podemos procesar la solicitud.';
$lang['comments']['16'] = '';
// END FILE: ./include/kernel/comments.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/userFolders.php
$lang['userFolders'] = array(); 
$lang['userFolders']['1'] = 'Gestion de directorio ';
$lang['userFolders']['2'] = 'Nombre de directorio';
$lang['userFolders']['3'] = 'Codigo de carpeta';
$lang['userFolders']['4'] = 'Acciones';
$lang['userFolders']['5'] = 'Sin Nombre';
$lang['userFolders']['6'] = 'Ver directorio';
$lang['userFolders']['7'] = 'Administrar directorio';
$lang['userFolders']['8'] = 'Borrar directorio';
$lang['userFolders']['9'] = '';
// END FILE: ./include/kernel/userFolders.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/usercp.php
$lang['usercp'] = array(); 
$lang['usercp']['1'] = 'Panel de usuario ';
$lang['usercp']['2'] = '5 subidas mas recientes ';
$lang['usercp']['3'] = 'Configuracion personal';
$lang['usercp']['4'] = 'Ver mas archivos';
$lang['usercp']['5'] = ' 5 directorios mas recientes';
$lang['usercp']['6'] = 'Estadisticas de uso';
$lang['usercp']['7'] = 'Nombre';
$lang['usercp']['8'] = 'Codigo de directorio';
$lang['usercp']['9'] = 'Acciones';
$lang['usercp']['10'] = 'Sin nombre';
$lang['usercp']['11'] = 'Ver todos tus directorios';
$lang['usercp']['12'] = 'Numero de subidas:';
$lang['usercp']['13'] = 'Numero de directorios:';
$lang['usercp']['14'] = 'Puntos totales: ';
$lang['usercp']['15'] = 'Espacio total usado: ';
$lang['usercp']['16'] = 'Ver todos los archivos';
$lang['usercp']['17'] = 'Crear nuevo directorio';
$lang['usercp']['18'] = '';
// END FILE: ./include/kernel/usercp.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/rss.php
$lang['rss'] = array(); 
$lang['rss']['1'] = 'Feeds RSS';
$lang['rss']['2'] = 'Aquí tenemos una colección de feeds RSS.';
$lang['rss']['3'] = 'Top 10 archivos destacados';
$lang['rss']['4'] = 'Top 10 archivos destacados mas recientes';
$lang['rss']['5'] = 'Top 10 archivos menos destacados  ';
$lang['rss']['6'] = '';
// END FILE: ./include/kernel/rss.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/report.php
$lang['report'] = array(); 
$lang['report']['1'] = 'Archivo reportado, Gracias';
$lang['report']['2'] = 'Reportar un archivo';
$lang['report']['3'] = 'Para informar acerca de un archivo que incumple nuestras normas, por favor pegue el enlace de abajo y lo investigaremos.';
$lang['report']['4'] = 'Enlace: ';
$lang['report']['5'] = 'Reportar archivo';
$lang['report']['6'] = '';
// END FILE: ./include/kernel/.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/linkchecker.php
$lang['linkchecker'] = array(); 
$lang['linkchecker']['1'] = 'Compruebe sus enlaces de archivos ';
$lang['linkchecker']['2'] = 'Con esta utilidad usted puede comprovar si loa enlaces son aun validos o han expirado.<br />
Pegue los enlces, uno por cada linea, en el cuadro de texto, despues pulse "Validad Enlaces".';
$lang['linkchecker']['3'] = 'Enlaces validados ';
$lang['linkchecker']['4'] = ' de ';
$lang['linkchecker']['5'] = 'Los enlaces son validos ';
$lang['linkchecker']['6'] = '¡Comprobar mas enlaces!';
$lang['linkchecker']['7'] = 'Validar enlaces';
$lang['linkchecker']['8'] = '¡Comprobar mas enlaces!';
$lang['linkchecker']['9'] = '';
// END FILE: ./include/kernel/linkchecker.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/file_upload.php
$lang['file_upload'] = array(); 
$lang['file_upload']['1'] = 'A este archivo no se puede acceder directamente. ';
$lang['file_upload']['2'] = 'Esconder BB Codes';
$lang['file_upload']['3'] = 'Mostrar BB Codes';
$lang['file_upload']['4'] = 'El archivo que ha subido ya ha sido subido. <br />
Pulse aqui para mas informacion.';
$lang['file_upload']['5'] = '';
// END FILE: ./include/kernel/file_upload.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/files.php
$lang['files'] = array(); 
$lang['files']['1'] = 'Por favor, seleccione una carpeta para añadir los archivos.';
$lang['files']['2'] = 'Añadir a la Carpeta?';
$lang['files']['3'] = 'Añadir';
$lang['files']['4'] = 'Añadir archivos al directorio';
$lang['files']['5'] = '';
// END FILE: ./include/kernel/files.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/.php
$lang['kernelUpload'] = array(); 
$lang['kernelUpload']['1'] = 'Subir archivo';
$lang['kernelUpload']['2'] = 'Apreciado ';
$lang['kernelUpload']['3'] = 'Usted está recibiendo este mensaje porque alguien ha subido un archivo y usted pidió que se le noticiara acerda de ello. ';
$lang['kernelUpload']['4'] = 'Los detalles del archivo estan a continuacion:';
$lang['kernelUpload']['5'] = 'Nombre:';
$lang['kernelUpload']['6'] = 'Descripcion: ';
$lang['kernelUpload']['7'] = 'Contraseña: ';
$lang['kernelUpload']['8'] = 'Enlace de descarga: ';
$lang['kernelUpload']['9'] = 'Tamaño: ';
$lang['kernelUpload']['10'] = '¡Gracias!';
$lang['kernelUpload']['11'] = '- El ';
$lang['kernelUpload']['12'] = 'Equipo ';
$lang['kernelUpload']['13'] = 'Este mensaje se genera automáticamente, si responde no recibira respuesta.';
$lang['']['14'] = '';
$lang['']['15'] = '';
$lang['']['16'] = '';
$lang['']['17'] = '';
$lang['']['18'] = '';
$lang['']['19'] = '';
$lang['']['20'] = '';
$lang['']['21'] = '';
$lang['']['22'] = '';
$lang['']['23'] = '';
$lang['']['24'] = '';
$lang['']['25'] = '';
// END FILE: ./include/kernel/.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/uploadError.php
$lang['uploadError'] = array(); 
$lang['uploadError']['1'] = '¡El archivo subido es demasiado grande!';
$lang['uploadError']['2'] = 'El archivo que ha subido es demasiado grande para nuestra red .';
$lang['uploadError']['3'] = 'Tamaños mas grandes pueden ser subidos si usted ';
$lang['uploadError']['4'] = 'actualiza su cuenta';
$lang['uploadError']['5'] = ' o ';
$lang['uploadError']['6'] = 'ingresa';
$lang['uploadError']['7'] = ' con una existente.';
$lang['uploadError']['8'] = '¡No es posible conectarse al FTP con estos datos!';
$lang['uploadError']['9'] = 'Error de ingreso FTP';
$lang['uploadError']['10'] = 'La información de inicio de sesión FTP que indicó en el enlace de su archivo es incorrecta.';
$lang['uploadError']['11'] = '¡El archivo subido esta prohibido en nuestra red!';
$lang['uploadError']['12'] = 'El archivo que ha subido ha sido prohibido en nuestra red.';
$lang['uploadError']['13'] = 'Hemos recibido quejas de que el archivo que ha subido esta violando nuestra ';
$lang['uploadError']['14'] = 'Ha ocurrido un error desconocido';
$lang['uploadError']['15'] = 'Nuestros sistemas han encontrado un erro que no puede ser solucionado en estos momentos.';
$lang['uploadError']['16'] = 'Nuestro equipo ha sido notificado de la situacion y el error sera solucionado lo mas pronto posible.';
$lang['uploadError']['17'] = '';
// END FILE: ./include/kernel/uploadError.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/.php
$lang[''] = array(); 
$lang['']['1'] = '';
$lang['']['2'] = '';
$lang['']['3'] = '';
$lang['']['4'] = '';
$lang['']['5'] = '';
$lang['']['6'] = '';
$lang['']['7'] = '';
$lang['']['8'] = '';
$lang['']['9'] = '';
$lang['']['10'] = '';
$lang['']['11'] = '';
$lang['']['12'] = '';
$lang['']['13'] = '';
$lang['']['14'] = '';
$lang['']['15'] = '';
$lang['']['16'] = '';
$lang['']['17'] = '';
$lang['']['18'] = '';
$lang['']['19'] = '';
$lang['']['20'] = '';
$lang['']['21'] = '';
$lang['']['22'] = '';
$lang['']['23'] = '';
$lang['']['24'] = '';
$lang['']['25'] = '';
// END FILE: ./include/kernel/.php
// MISC Language ( spans multiple pages)
$lang['misc'] = array(); 
$lang['misc']['1'] = 'Pagina Nº:';
$lang['misc']['2'] = 'Selecciona una pagina';
$lang['misc']['3'] = 'Pagina';
$lang['misc']['4'] = 'Numero de resultados: ';
$lang['misc']['5'] = '';
$lang['misc']['6'] = '';
$lang['misc']['7'] = '';
$lang['misc']['8'] = '';
$lang['misc']['9'] = '';
$lang['misc']['10'] = '';
?>