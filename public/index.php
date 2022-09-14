<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AdminController;
use Controllers\LoginController;
use Controllers\LiderController;
use Controllers\UsuarioController;

$router = new Router();

//Iniciar sesion
$router->get('/',[LoginController::class,'login']);
$router->post('/',[LoginController::class,'login']);

//Cerrar sesion
$router->get('/logout',[LoginController::class,'logout']);




//Recuperar password desde admin, la contraseña que se pondra por defecto sera 12345
$router->get('/admin/usuario/recuperar',[LoginController::class,'recuperar']);

//Descargar pdf, se le puede dar formato al pdf en la seccion de funciones en la parte de crear PDF
$router->post('/admin/proyectos/tablon/pdf',[AdminController::class,'pdf']);
//Eliminar tablon
$router->post('/admin/proyectos/eliminar',[AdminController::class,'proyectoseliminar']);

//Filtrar resultados, se filtran por BD, FORD E INTERNOS
$router->get('/admin/proyectos/filtro',[AdminController::class,'filtro']);
$router->post('/admin/proyectos/filtro',[AdminController::class,'filtro']);


//Tareas, modficiar una tarea, se la parte del nombre o la parte del titulo
$router->get('/admin/proyectos/tablon/tareas-actualizar',[AdminController::class,'tareas']);
$router->post('/admin/proyectos/tablon/tareas-actualizar',[AdminController::class,'tareas']);


//Admin
//Menu Te dirige a la parte de usuarios, donde el adminstrador puede crear usuarios, modificarlos o eliminarlos
$router->get('/admin/usuarios',[AdminController::class,'menu']);

//Crear usuarios, crear usuarios a traves del formulario
$router->get('/admin/usuarios/crear-usuario',[AdminController::class,'crear']);
$router->post('/admin/usuarios/crear-usuario',[AdminController::class,'crear']);

//Modificar usuarios, modifica cualquier parametro del usuario
$router->get('/admin/usuarios/actualizar-usuario',[AdminController::class,'actualizar']);
$router->post('/admin/usuarios/actualizar-usuario',[AdminController::class,'actualizar']);

//Eliminar Usuarios, eliminar un usuario 
$router->post('/admin/usuarios/eliminar-usuario',[AdminController::class,'eliminar']);

//Comentarios, permite crear comentarios, en las tareas, tambien se podra subir archivos aqui
$router->get('/admin/proyectos/tablon/comentarios',[AdminController::class,'comentarios']);
$router->post('/admin/proyectos/tablon/comentarios',[AdminController::class,'comentarios']);


//Mostrar comentarios y archivos 
$router->get('/admin/proyectos/tablon/contenido',[AdminController::class,'contenido']);
//Proyectos

//
//Eliminar una tarea de un tablon, te permite eliminar una tarea del tablon
$router->post('/admin/proyectos/tablon/eliminar',[AdminController::class,'eliminartarea']);
//Mostrar Proyectos
$router->get('/admin/proyectos',[AdminController::class,'proyectos']);
//Crear proyectos en el trablon 
$router->post('/admin/proyectos',[AdminController::class,'proyectos']);


//Crer grupos de proyectos, crea un grupo para poner tareas dentro de un tablon
$router->post('/admin/proyectos/grupo',[AdminController::class,'grupo']);

//Mostrar el tablon que el usario selecciona
$router->get('/admin/proyectos/tablon',[AdminController::class,'tablon']);


//Crear tareas a grupos
$router->post('/admin/proyectos/tarea',[AdminController::class,'tarea']);

//Mostrar Perfil 
$router->get('/admin/usuario',[AdminController::class,'usuario']);

//Cambiar password, permite al dministrador cambiar su password si asi lo require  
$router->get('/admin/password',[AdminController::class,'password']);
$router->post('/admin/password',[AdminController::class,'password']);

//Comercializadora
$router->get('/admin/propuestas',[AdminController::class,'propuestas']);
$router->get('/admin/propuesta-crear',[AdminController::class,'crearPropuesta']);
$router->post('/admin/api/propuesta-leer',[AdminController::class,'leerPropuesta']);


//Lideres
$router->get('/lider/usuario',[LiderController::class,'usuario']);

//Cambiar password, permite al lider cambiar su password
$router->get('/lider/password',[LiderController::class,'password']);
$router->post('/lider/password',[LiderController::class,'password']);


//Tablon
//Mostrar Proyectos, mostrar los tablones o proyectos que el lider a creado o que le han puesto
$router->get('/lider/proyectos',[LiderController::class,'proyectos']);
$router->post('/lider/proyectos',[LiderController::class,'proyectos']);

//Filtrar resultados, filtrar los proyectos por BD, FORD O INTERNOS
$router->get('/lider/proyectos/filtro',[LiderController::class,'filtro']);
$router->post('/lider/proyectos/filtro',[LiderController::class,'filtro']);

//Proyectos Tablon
//Mostrar todos los grupos pertenecientes al tablon creado
$router->get('/lider/proyectos/tablon',[LiderController::class,'tablon']);

//Crear pdf, se puede modificar sus estilos
$router->post('/lider/proyectos/tablon/pdf',[LiderController::class,'pdf']);

//Eliminar tablon permite al lider eliminar un tablon seleccionado, cuando se elimina lo manda hacia una nueva ventana que le permite descargar su pdf
$router->post('/lider/proyectos/eliminar',[LiderController::class,'proyectoseliminar']);

//Crear un grupo, crea un grupo dentro del tablon seleccionado
$router->post('/lider/proyectos/grupo',[LiderController::class,'grupo']);

//Crear tareas a grupos, crea un conjunto de tareas al grupo
$router->post('/lider/proyectos/tarea',[LiderController::class,'tarea']);

//Actualizar una tarea
//Tareas Permite al lider cambiar el estado de una tarea, en proceso, nueva, lista, estancada.
$router->get('/lider/proyectos/tablon/tareas-actualizar',[LiderController::class,'tareasActualizar']);
$router->post('/lider/proyectos/tablon/tareas-actualizar',[LiderController::class,'tareasActualizar']);


//Borrar tarea, permite al lider eliminar una tarea
$router->post('/lider/proyectos/tablon/eliminar',[LiderController::class,'eliminartarea']);

//Comentarios, permite agregar un comentario a una tarea
$router->get('/lider/proyectos/tablon/comentarios',[LiderController::class,'comentarios']);
$router->post('/lider/proyectos/tablon/comentarios',[LiderController::class,'comentarios']);


//Mostrar comentarios y archivos, muestra los archivos o comentarios que ha creado
$router->get('/lider/proyectos/tablon/contenido',[LiderController::class,'contenido']);

//Comentar y descargar manual.
$router->get('/Ayuda',[LiderController::class,'retro']);
$router->post('/Ayuda',[LiderController::class,'retro']);

//Usuarios
$router->get('/usuario/usuario',[UsuarioController::class,'usuario']);

//Modificar contraseña, permite al cliente modificar su contraseña
$router->get('/usuario/password',[UsuarioController::class,'password']);
$router->post('/usuario/password',[UsuarioController::class,'password']);

//Mostrar tablones en los que el usuario es partiipe con tareas
$router->get('/usuario/proyectos',[UsuarioController::class,'proyectos']);
$router->post('/usuario/proyectos',[UsuarioController::class,'proyectos']);

//Filtrar los proyectos por BD,FORD,INTERNO
$router->get('/usuario/proyectos/filtro',[UsuarioController::class,'filtro']);
$router->post('/usuario/proyectos/filtro',[UsuarioController::class,'filtro']);

//Mostrar el tablon que el usuario selecciona
$router->get('/usuario/proyectos/tablon',[UsuarioController::class,'tablon']);

//Agregar comentarios, permite al usuario agregar un comentario sobre la tarea que le tenga asigna o subir algun archivo
$router->get('/usuario/proyectos/tablon/comentarios',[UsuarioController::class,'comentarios']);
$router->post('/usuario/proyectos/tablon/comentarios',[UsuarioController::class,'comentarios']);

//Mostrar comentarios y archivos 
$router->get('/usuario/proyectos/tablon/contenido',[UsuarioController::class,'contenido']);

//Comentar y descargar manual.
$router->get('/Retro',[AdminController::class,'retro']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();