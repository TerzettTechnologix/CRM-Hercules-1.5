<?php
namespace Controllers;

use MVC\Router;
use Model\Tablon;
use Model\Usuario;
use Model\Grupo;
use Model\Tarea;
use Model\UsuarioTarea;
use Model\Comentario;
use Model\Retro;
use Intervention\Image\ImageManagerStatic as Image;
use Model\RetroAlimentacion;

class AdminController{
    public static function menu(Router $router){
        //Iniciarlizar el session y revisar si es admin
        isAuth(); //Revisa si es admin
        // expira(); //Si despues de 10 minutos no hay actividad la sesion se cierra automaticamnte
        $usuario=new Usuario();
        $usuarios=$usuario->usuariosEmpleado();
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $id=filter_var($id,FILTER_VALIDATE_INT);
        }else{
            $id=4;
        }
        $router->render('admin/menu',[
            'usuarios'=>$usuarios,
            'resultado'=>$id
        ]);
    }
    public static function crear(Router $router){
        //Crear un usuario
        isAuth();
        // expira();
        $usuario=new Usuario;
        $alertas=[];
        if($_SERVER['REQUEST_METHOD']==='POST'){;
            $usuario->sincronizar($_POST); //Crear un objeto con los valores de POST
            
            $correo=$usuario->correo;
            $usuarioCorreo=Usuario::where('correo',$correo);
            $alertas=$usuario->validarNuevaCuenta();
            
            if(!is_null($usuarioCorreo))
            {
                $alertas['error'][]="El usuario que intentas registrar ya existe en el sistema";
            }
            if(empty($alertas)){
                $usuario->hashPassword(); //Se hashea el password del usuario
                $valor=$usuario->tipo; //Dependiendo del rol se le agrega un tipo
                if($valor=="Lider"){
                    $usuario->rol="1";
                }elseif($valor=="Empleado"){
                    $usuario->rol="2";
                }else{
                    $usuario->rol="0";
                }
                //Crear al usuario
                
                $resultado=$usuario->guardar();
                if($resultado){
                    header("Location: /admin/usuarios?id=1");
                }
                
            }
        }
        $router->render('admin/crear-usuario',[
            'usuario'=>$usuario,
            'alertas'=>$alertas
        ]);
    }
    public static function actualizar(Router $router)
    {
        //actualizar a un usuario
        isAuth();
        // expira();
        $alertas=[];
        $id=$_GET['id'];
        $id=filter_var($id,FILTER_VALIDATE_INT);
        if(!$id){
            header("Location: /admin/usuarios");
        }
        $usuario=Usuario::find($id); //Encontrar el usuario que se va a modificar
       
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $usuario->sincronizar($_POST);
            $alertas=$usuario->validarActualizacionCuenta();
            if(empty($alertas)){
                $resultado=$usuario->guardar();
                if($resultado){
                    header("Location: /admin/usuarios?id=2");
                }
            }

        }
        
        $router->render('admin/actualizar-usuario',[
            'usuario'=>$usuario,
            'alertas'=>$alertas
        ]);
    }
    public static function grupo(Router $router)
    {
        //Crear un grupo dentro de un tablon
        isAuth();
        // expira();
        $alertas=[];
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $id=filter_var($id,FILTER_VALIDATE_INT);
        }else{
            $id=4;
        }
        $url=$_GET['url'];
        $url1=$url;
        $tablon=Tablon::where('url',$url);
        $grupo=new Grupo();
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $grupo->sincronizar($_POST);
            $alertas=$grupo->validarGrupo();
            if(empty($alertas))
            {
                $grupo->idTablon=$tablon->id;
                $resultado=$grupo->guardar();
                if($resultado){
                    header("Location: /admin/proyectos/tablon?url=$url1&id=1");
                }
            }
        }
        $router->render('admin/tablon',[
            'tablon'=>$tablon,
            'alertas'=>$alertas,
            'resultado'=>$id
        ]);
       
    }
    public static function eliminar()
    {
        isAuth();
        // expira();
        //eliminar un usuario
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $id=$_GET['id'];
            $id=filter_var($id,FILTER_VALIDATE_INT);
            if(!$id){
                header("Location: /admin/usuarios");
            }
            $usuario=Usuario::find($id);
            $resultado=$usuario->eliminar();
            if($resultado){
                header("Location: /admin/usuarios?id=3");
            }
        }
        
    }
    public static function proyectoseliminar(Router $router)
    {
        isAuth();
        // expira();
        if($_SERVER['REQUEST_METHOD']==='POST')
        {
            $url=$_GET['url'];
            $tablon=Tablon::where('url',$url); //Primero encuentra el tablon que se va a eliminar
            $id=$tablon->id;
            $grupos=Grupo::belogsTo('idTablon',$id); //Te regresa todos los grupos de ese tablon
            $tareas=new Tarea();
            $tareas=$tareas->tareasRecuperar($tablon->id);  //Te regresa todas las tareas de ese tablon
            $usuarioTareas=new UsuarioTarea();        
            $usuarioTareas=$usuarioTareas->usuariosTareas($tablon->id); //Todos los usuario de ese tablon igualmente
            crearPDF($tablon,$grupos,$tareas,$usuarioTareas); //Se manda a llamar la funcion de crear PDF para crear un pdf antes de borrar el tablon
            $resultado=$tablon->eliminar(); //Se borra el tablon
            if($resultado){
                header("Location: /admin/proyectos?id=3");
            } 
        }
    }
    public static function eliminartarea(Router $route)
    {
        isAuth();
        // expira();
        if($_SERVER['REQUEST_METHOD']==='POST')
        {
            $url=$_GET['url'];
            $tarea=Tarea::where('url',$url); //Se obtiene la tarea a eliminar 
            $urlGrupo=$tarea->IdGrupo;
            $grupo=Grupo::where('id',$urlGrupo); //El grupo de la tarea que se va a eliminar 
            $urlTablon=$grupo->idTablon;
            $tablon=Tablon::where('id',$urlTablon); //El tablon de la tarea que se va a eliminar 
            $url=$tablon->url;
            $resultado=$tarea->eliminar(); //Se elimina la tarea
            if($resultado){
                $grupo=Grupo::where('id',$grupo->id); //Se hace una actualizacion del total de tareas que tiene ese grupo, eso se hace para que el uusario vea reflejada la eliminacion en la barra de progreso
                $grupo->total=$grupo->total($grupo->id);
                $grupo->nuevas=$grupo->estado($grupo->id,0);
                $grupo->estancadas=$grupo->estado($grupo->id,1);
                $grupo->proceso=$grupo->estado($grupo->id,2);
                $grupo->listas=$grupo->estado($grupo->id,3);
                $grupo->guardar();
                header("Location: /admin/proyectos/tablon?url=$url&id=3");
            } 
        }
    }
    public static function proyectos(Router $router)
    {
        //Muestra todos los proyectos o tablones que se han creado y permite crear otros
        isAuth();
        // expira();
        //Crear un tablon nuevo
        $alertas=[];
        $tablones=Tablon::allFecha(); //Te trae todos los tablones acomodados por fecha
        $tablon=new Tablon;
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $id=filter_var($id,FILTER_VALIDATE_INT);
        }else{
            $id=4;
        }
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $tablon->sincronizar($_POST);
            $alertas=$tablon->validarTablon();
            $hash=md5(uniqid()); //Crea un url unico para el tablon, esto se hace para evitar que un usuario pueda estar entrando a tablones que no le pertenecen
            $tablon->url=$hash;
            $tablon->lider=$_SESSION['nombre'];
            $tablon->fecha=date('d-m-Y');
            $tablon->idLider=$_SESSION['id'];
            
            if(empty($alertas)){
                $resultado=$tablon->guardar();
                if($resultado){
                    header("Location: /admin/proyectos?id=1");
                } 
            }
        }
        $router->render('admin/proyectos',[
                'alertas'=>$alertas,
                'tablon'=>$tablon,
                'resultado'=>$id,
                'tablones'=>$tablones
        ]);
    }
    public static function tablon(Router $router)
    {
        //Permite acceder al tablon que el usuario selecciona, si existen
        isAuth();
        // expira();
        $alertas=[];
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $id=filter_var($id,FILTER_VALIDATE_INT);
        }else{
            $id=4;
        }
        
        $url=$_GET['url'];
        $tablon=Tablon::where('url',$url);
        $idTablon=$tablon->id;
       
        $grupos=Grupo::belogsTo('idTablon',$idTablon); // Obtienes todos los tablones pertenecientes a un grupo
        
        if(!$url) header ("Location: /admin/proyectos");
        $tablon=Tablon::where('url',$url);
        $usuarios=Usuario::all();
        $tareas=new Tarea();
        $tareas=$tareas->tareasRecuperar($tablon->id);  //Necesario en tablon
        $usuarioTareas=new UsuarioTarea();        
        $usuarioTareas=$usuarioTareas->usuariosTareas($tablon->id);
        foreach($grupos as $grupo)
        {
            $grupo=Grupo::where('id',$grupo->id); //Actualiza la tabla de grupos con todas las tareas que se tienen en ese gurpo por estado
            $grupo->id=$id;
            $grupo->total=$grupo->total($grupo->id);
            $grupo->nuevas=$grupo->estado($grupo->id,0);
            $grupo->estancadas=$grupo->estado($grupo->id,1);
            $grupo->proceso=$grupo->estado($grupo->id,2);
            $grupo->listas=$grupo->estado($grupo->id,3);
            
            $grupo->guardar();
            
            
        }
        
        $router->render('admin/tablon',[
            'tablon'=>$tablon,
            'alertas'=>$alertas,
            'resultado'=>$id,
            'grupos'=>$grupos,
            'usuarios'=>$usuarios,
            'tareas'=>$tareas,
            'usuarioTareas'=>$usuarioTareas,
            
        ]);
    }
    public static function tarea(Router $router)
    {
        //Encargada de la creacion de las tareas por grupo y de mostarlas
        isAuth();
        // expira();
        $alertas=[];
        if(isset($_GET['id'])){
            $idUsuario=$_GET['id'];
            $idUsuario=filter_var($idUsuario,FILTER_VALIDATE_INT);
        }else{
            $idUsuario=4;
        }
        $url=$_GET['url'];
        $url1=$url;
        $tablon=Tablon::where('url',$url);
        $id=$tablon->id;
        $grupos=Grupo::belogsTo('idTablon',$id);
        $usuarios=Usuario::all();
        $tarea=new Tarea();
        if($_SERVER['REQUEST_METHOD']==='POST'){
            if(isset($_POST['nombre'])){ //Si tiene el nombre lo guarda en el objeto de tarea
                $nombre=$_POST['nombre'];
                $tarea->nombre=$nombre;
            }else{
                $nombre='';
            } 
            if(isset($_POST['grupo'])){ //Si tieen el grupo lo guarda en el objeto tarea
                $IdGrupo=$_POST['grupo'];
                $tarea->IdGrupo=$IdGrupo;
                
            }else{
                $IdGrupo='';
            }
            $alertas=$tarea->validarTarea(); //Revisa si todos los otros objetos son correctos
            $tarea->estado='0'; //Pone cualquier nueva tarea en 0 Nueva
            $tarea->fecha=date('d-m-Y');
            $hash=md5(uniqid()); //crea un hash que va a ser el URL de esa tarea
            $tarea->url=$hash;
            if(!isset($_POST['CheckBox']))
            {
                $alertas['error'][]="Debe seleccionar al menos un usuario para la tarea creada";
            }
            
            if(empty($alertas)) //Si no hay errores guarda la tarea y llena la siguiente tabla que es usuariosTareas
            {
                
                $tarea->guardar();
                $tarea=Tarea::where('url',$tarea->url); //Obtiene la tarea
                $idTarea=$tarea->id; //Obtiene el id de la Tarea
                $usuariosSeleccionados=array(); //Crea un array con los usuarios que se han seleccionado en el checkbox
                $usuariosSeleccionados=$_POST['CheckBox']; //Obtienes todos los valores que se encuentran en el checkbox
                $longitud=sizeof($usuariosSeleccionados); //Obtiene el total de usuarios que se encuentran seleccioandos 
                for($i=0;$i<$longitud;$i++) //Hace el recorrido para cada uno de los usuarios  y crea un nuevo objeto de Usuario Tarea donde registra a cada uno con la tarea correspondiente
                {
                    $usuariotarea=new UsuarioTarea();
                    $usuariotarea->IdTarea=$idTarea; //Guarda el id de la tarea
                    $usuariotarea->IdUsuario=$usuariosSeleccionados[$i]; //Guarda el id del usuario
                    $usuariotarea->crearVarios();
                }
                
                    
                
                $usuarios=Usuario::all();
                $tareas=new Tarea();
                $tareas=$tareas->tareasRecuperar($tablon->id);  //Necesario en tablon
                $usuarioTareas=new UsuarioTarea();        
                $usuarioTareas=$usuarioTareas->usuariosTareas($tablon->id);
                    foreach($grupos as $grupo) //Llenar y actualizar la tabla  de grupo
                    {
                        $grupo=Grupo::where('id',$grupo->id);
                        $grupo->total=$grupo->total($grupo->id);
                        $grupo->nuevas=$grupo->estado($grupo->id,0);
                        $grupo->estancadas=$grupo->estado($grupo->id,1);
                        $grupo->proceso=$grupo->estado($grupo->id,2);
                        $grupo->listas=$grupo->estado($grupo->id,3);
                        $grupo->guardar();
                        header("Location: /admin/proyectos/tablon?url=$url1&id=1");
                
                    }
            }
            $tareas=new Tarea();
            $tareas=$tareas->tareasRecuperar($tablon->id);  //Necesario en tablon
            $usuarioTareas=new UsuarioTarea();        
            $usuarioTareas=$usuarioTareas->usuariosTareas($tablon->id);
                     
        }
        $router->render('admin/tablon',[
            'grupos'=>$grupos,
            'tablon'=>$tablon,
            'alertas'=>$alertas,
            'resultado'=>$idUsuario,
            'usuarios'=>$usuarios,
            'tareas'=>$tareas,
            'usuarioTareas'=>$usuarioTareas
            
        ]);
        
    }
    public static function usuario(Router $router)
    {
        //Obtener la informacion del usuario
        isAuth(); 
        // expira();
        $id=$_SESSION['id'];
        $usuario=Usuario::where('id',$id);
        $router->render('admin/usuario',[
            'usuario'=>$usuario
        ]);
    }
    public static function password(Router $router)
    {
        //Cambiar el password de un equipo
        isAuth();
        // expira();
        $alertas=[];
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $id=filter_var($id,FILTER_VALIDATE_INT);
        }else{
            $id=4;
        }
        $idUsuario=$_SESSION['id'];
        $usuario=Usuario::where('id',$idUsuario);
        if($_SERVER['REQUEST_METHOD']==='POST'){
            if(!($_POST['password']==="")){
                $password=$_POST['password'];
            }else{
                $alertas['error'][]="La contraseña es obligatoria";
            }
            if(!($_POST['password1']==="")){
                $password1=$_POST['password1'];
            }else{
                $alertas['error'][]="La confirmacion de contraseña es obligatoria";
            }
            if(empty($alertas))
            {
                //Comprobar que las contraseñas sean iguales
                $resultado=strcasecmp($password,$password1);
                if($resultado===0)
                {
                    $contraseña=password_hash($password,PASSWORD_DEFAULT);
                    $usuario->contraseña=$contraseña;
                    $resultado=$usuario->guardar();
                    if($resultado){
                        header("Location: /admin/password?id=2");
                    }
                }else{
                    $alertas['error'][]="Las contraseñas deben ser iguales";
                } 
            }
        }
        
        $router->render('admin/password',[
            "alertas"=>$alertas,
            "resultado"=>$id
        ]);
    }
    public static function pdf()
    {
        //Crear un pdf donde se observar los grupos, tareas y usuarios del tablon
        isAuth();
        // expira();
        $url=$_GET['url'];
        $tablon=Tablon::where('url',$url);
        $id=$tablon->id;
        $grupos=Grupo::belogsTo('idTablon',$id);
        $tareas=new Tarea();
        $tareas=$tareas->tareasRecuperar($tablon->id);  //Necesario en tablon
        $usuarioTareas=new UsuarioTarea();        
        $usuarioTareas=$usuarioTareas->usuariosTareas($tablon->id);
        
        crearPDF($tablon,$grupos,$tareas,$usuarioTareas);
    }
    public static function filtro(Router $router)
    {
        //Filtra los tablones por el lugar o por una palabra, FORD, BD, INTERNO o una palabra por ejemplo %Proyecto%
        isAuth();
        // expira();
        if(isset($_GET['filtro']))
        {
            
            $filtro=$_GET['filtro'];
            $valor=$filtro;
            $tablones=Tablon::belogsTo('lugar',$filtro); 
        }
        
        if($_SERVER['REQUEST_METHOD']==='POST')
        {
            
            $busqueda=$_POST['busqueda'];
            $tablones=new Tablon();
            $tablones=$tablones->buscarPalabra($busqueda);
        }
        $router->render('admin/proyectosfiltrados',[
            'tablones'=>$tablones
        ]);
    }
    public static function tareas(Router $router)
    {
        //Para mostrar toda la informacion de las tareas y poder modificarlas 
        isAuth();
        // expira();
        $alertas=[];
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $id=filter_var($id,FILTER_VALIDATE_INT);
        }else{
            $id=4;
        }
        $url=$_GET['url'];
        $usuarios=Usuario::all();
        $tarea=Tarea::where('url',$url);
        $usuariostarea=UsuarioTarea::belogsTo('IdTarea',$tarea->id);
        
        // Se deja este modulo aqui pues es el inicio de lo que se tendria que hacer si se quisiera modificar tambien las personas que pertenecen a un tablon
        foreach($usuariostarea as $usuariotarea)
        {
            foreach($usuarios as $usuario)
            {
                if($usuario->id===$usuariotarea->IdUsuario)
                {
                    // debuguear($usuario);
                    $usuario->activo=1;
                }
            }
        }
        
        if($_SERVER['REQUEST_METHOD']==='POST')
        {
            $tarea=Tarea::where('url',$_GET['url']);
            $tarea->sincronizar($_POST);
            $idGrupo=$tarea->IdGrupo;
            $grupo=Grupo::where('id',$idGrupo);
            $resultado=$tarea->guardar();
            $id=$tarea->id;
            $usuariotarea->EliminarRegistro($id);
            $usuariosSeleccionados=array(); //Crea un array con los usuarios que se han seleccionado en el checkbox
            $usuariosSeleccionados=$_POST['CheckBox']; //Obtienes todos los valores que se encuentran en el checkbox
            $longitud=sizeof($usuariosSeleccionados); //Obtiene el total de usuarios que se encuentran seleccioandos 
            for($i=0;$i<$longitud;$i++) //Hace el recorrido para cada uno de los usuarios  y crea un nuevo objeto de Usuario Tarea donde registra a cada uno con la tarea correspondiente
            {
                $usuariotarea=new UsuarioTarea();
                $usuariotarea->IdTarea=$id; //Guarda el id de la tarea
                $usuariotarea->IdUsuario=$usuariosSeleccionados[$i]; //Guarda el id del usuario
                $usuariotarea->crearVarios();
            }
                
            
            if($resultado)  //Vuelve a calcular las tareas del  grupo por si se llego a presentar algun cambio
            {
                
                $grupo=Grupo::where('id',$grupo->id);
                $grupo->total=$grupo->total($grupo->id);
                $grupo->nuevas=$grupo->estado($grupo->id,0);
                $grupo->estancadas=$grupo->estado($grupo->id,1);
                $grupo->proceso=$grupo->estado($grupo->id,2);
                $grupo->listas=$grupo->estado($grupo->id,3);
                $grupo->guardar();
                $url=$grupo->idTablon;
                $tablon=Tablon::where('id',$url);
                $url=$tablon->url;
                header("Location: /admin/proyectos/tablon?url=$url&id=2");
            }

        }
        
        $router->render('admin/tareas-actualizar',[
            
            'tarea'=>$tarea,
            'usuarios'=>$usuarios,
            'usuariostarea'=>$usuariostarea,
            'alertas'=>$alertas,
            'resultado'=>$id,
            // 'UsuariosTareas'=>$usuariosTareaFiltrado
            
        ]);
    }
    public static function comentarios(Router $router)
    {
        //Seccion que permite agreagar comentarios
        
        isAuth();
        // expira();
        $url=($_GET['url']);
        $alertas=[];
        $tarea=Tarea::where('url',$url);
        $IdGrupo=$tarea->IdGrupo;
        $grupo=Grupo::where('id',$IdGrupo);
        $idTablon=$grupo->idTablon;
        $tablon=Tablon::where('id',$idTablon);
        $url=$tablon->url;
        $id=$tarea->id;
       
        if($_SERVER['REQUEST_METHOD']==='POST')
        {
            $comentario=new Comentario();
            if($_FILES['imagen'])
            {
                
                $size=$_FILES['imagen']['size']; //Esto es lo que se puede cambiar para el tamaño 
                $path=$_FILES['imagen']['name'];
                $ext=pathinfo($path,PATHINFO_EXTENSION);
                $imagen=$_FILES['imagen'];
                if(($ext==='jpg') || ($ext==='jpeg') || ($ext==='png'))
                {
                    $nombreImagen=md5(uniqid(rand(),true)). ".jpg"; //Crear un nombre unic
                    //Realizar un resize a la imagen con intervention
                    $image=Image::make($_FILES['imagen']['tmp_name'])->resize(800,600);
                    
                    $comentario->setImagen($nombreImagen);
                    if(!is_dir(CARPETA_IMAGENES)){
                        mkdir(CARPETA_IMAGENES);
                    }
                    $image->save(CARPETA_IMAGENES .'/'.$nombreImagen);
                }
                elseif($ext===""){
                    $comentario->imagen="";
                }else{
                    $alertas['error'][]="Formato de imagen no valido";
                }  
            }
            if($_FILES['archivo'])
            {
                $target_dir = "archivos/";
                $size=$_FILES['archivo']['size']; //Esto es lo que se puede cambiar para el tamaño 
                $path=$_FILES['archivo']['name'];
                $ext=pathinfo($path,PATHINFO_EXTENSION);
                $temp_name = $_FILES['archivo']['tmp_name'];
              
                if(($ext==='xlsx') || ($ext==='doc') || ($ext==='pdf'))
                {
                    if(!is_dir(CARPETA_ARCHIVO)){
                        mkdir(CARPETA_ARCHIVO);
                    }
                    $nombreArchivo=md5(uniqid(rand(),true)).".".$ext; //Crear un nombre unic
                    $path_filename_ext = $target_dir.$nombreArchivo;
                    
                    
                    
                    //Realizar un resize a la imagen con intervention
                    $comentario->setArchivo($nombreArchivo);
                    move_uploaded_file($temp_name,$path_filename_ext);
                }
                elseif($ext===""){
                    $comentario->archivo="";
                }else{
                    $alertas['error'][]="Formato de archivo no valido";
                }
                
            }
            
            if(!($_POST['contenido']==="")){
                
                $comentario->contenido=$_POST['contenido'];
                $comentario->fecha=date('d-m-Y');
                $comentario->IdTarea=$id;
                $comentario->IdUsuario=$_SESSION['id'];
                $comentario->nombre=$_SESSION['nombre'];
            }else{
                $alertas['error'][]="tu comentario esta vacio, vuelve a intentarlo";
            }
            if(empty($alertas))
            {
                //Guardar la imagen en el servidor
                $resultado=$comentario->guardar();
                
                if($resultado)
                {
                    header("Location: /admin/proyectos/tablon?url=$url&id=1");
                }
            }
        }
        $router->render('admin/comentarios',[
            'tarea'=>$tarea,
            'alertas'=>$alertas
            
        ]);
    }
    public static function contenido(Router $router)
    {
        //Permite visualizar los comentarios o archivos que se hayan creado en una tarea en concreto
        isAuth();
        // expira();
        $url=$_GET['url'];
        $tarea=Tarea::where('url',$url);
        $id=$tarea->id;
        $comentarios=Comentario::belogsToOrdenado('IdTarea',$id);
        
        
        $router->render('admin/mostrar',[
            'comentarios'=>$comentarios
            
        ]);
    }
    public static function retro(Router $router)
    {
        //Permite visualizar los comentarios o archivos que se hayan creado en una tarea en concreto
        isAuth();
        // expira();
        $retro=new Retro();
        $retro=Retro::allFecha();
        
        
        
        $router->render('admin/retro',[
            // 'comentarios'=>$comentarios
            'retros'=>$retro
            
        ]);
    }

   
    

    
    
}


?>