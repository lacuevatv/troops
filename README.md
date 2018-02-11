# Troops
(Sitio auto administrable)

## Instalación:
### Front:
* Javascript: archivo: '/assets/js/script.js', se edita la variable baseUrl si esta instalado en otra carpeta
* Archivo '/inc/config.php', se edita el nombre de base de datos y si está instalado en otra carpeta se define en la CONSTANTE Carpeta servidor: '/nombre-carpeta'
* No olvidar subir el archivo oculto .httaccess y si no está instalado en la raís del sitio hay que modificar: RewriteBase y cambiar la / por /nombre-carpeta

### Administrador:
* Primero poner nombre, usuario y password de base de datos
* si cambias el nombre de la carpeta "contenido" también deberías cmabiar la CONSTANTE ahí
* Podés poner la carpeta que quieras, pero en el archivo /inc/config.php deberías editar la CONSTANTE "URLADMINISTRADOR" para ponerle el nombre de la carpeta  
* Más abajo, si querés cambiar el nombre de usuario, en la variable usertype, le podés poner el nombre que quieras, el status no se puede cambiar.  
* Javascript: archivo: '/assets/js/admin-script.js', hay que modificar las primeras variables: 'baseUrl' y 'administradorUrl'  


## Versiones:

* 0.0 - Template Init

## Notas:
La estructura funciona con permalinks y redireccionamiento a través de htaccess.
Todos llegan al index.php y desde ahí se redirecciona a loop.php y single.php. También hay páginas especiales como inicio. En loop.php funcionan todas los loops de todas las categorias y las busquedas. En single van las páginas y entradas individuales.  
En el index la función escanea el url para buscar a donde tiene que ir, depende de si es categoria o si hay otra indicación.  
Las entradas se guardan en la tabla noticias y están divididas en pages y posts. A su vez los post estan divididos en las distintas categorias: 'agenda', 'gestion', 'tramites-servicios', 'telefonos', empleo. Pages son las que no entran en ninguna categoria.  

### Librerias utilizadas

#### PHP version 5.6
* Mobile Detect Master 2.8.26 (Detecta si es movil o pc)
* PHP Mailer - 6.0.1
* phpmyadmin 4.7.2 en versión local para administrar Base de datos mysql

#### Javascript
* jQuery v3.2.1
* jQuery UI 1.12.1
* modernizr-custom

#### MySQL version 5.6


### BACKEND:
* Versión 5.0 mejorado 10/11/2017

#### Módulos:
* Noticias
* Sliders
* Manejo de medios (subir imágenes y archivos)
