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
use Model\Email;
use Intervention\Image\ImageManagerStatic as Image;
class UsuarioController{
    public static function usuario(Router $router){
        //Iniciarlizar el revisar si es usuario y presentar su perfil
        isUsuario();
        // expira();
        $id=$_SESSION['id'];
        $usuario=Usuario::where('id',$id);
        $router->render('usuario/cuenta',[
            'usuario'=>$usuario
        ]);  
    }
    public static function password(Router $router)
    {
        //Opcion de modificacion de password para el usuario
        isUsuario();
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
                        header("Location: /usuario/password?id=2");
                    }
                }else{
                    $alertas['error'][]="Las contraseñas deben ser iguales";
                } 
            }
        }
        
        $router->render('usuario/password',[
            "alertas"=>$alertas,
            "resultado"=>$id
        ]);
    }
    public static function proyectos(Router $router)
    {
        
        isUsuario();
        // expira();
        //Crear un tablon nuevo
        $alertas=[];
        // debuguear($_SESSION['id']);
        $tablones=Tablon::allFechaUsuario($_SESSION['id']); //Te trae todos los proyectos en orden por fecha
        $tablones=array_unique($tablones,SORT_REGULAR); // Te elimina los resultados repetidos
    
        $router->render('usuario/proyectos',[
                'alertas'=>$alertas,
                'tablones'=>$tablones
        ]);
    }
    public static function filtro(Router $router)
    {
        
        isUsuario();
        // expira();
        if(isset($_GET['filtro']))
        {
            
            $filtro=$_GET['filtro'];
            $valor=$filtro;
            $tablones=Tablon::beongsToUsuario($_SESSION['id'],$valor); 
            $tablones=array_unique($tablones,SORT_REGULAR); //Elimina los repetidos
        }
        
        if($_SERVER['REQUEST_METHOD']==='POST')
        {
            
            $busqueda=$_POST['busqueda'];
            $tablones=new Tablon();
            $tablones=$tablones->buscardorPalabraUsuario($busqueda,$_SESSION['id']);
            
        }
        $router->render('usuario/proyectosfiltrados',[
            'tablones'=>$tablones
        ]);
    }
    public static function tablon(Router $router)
    {
        //Mostar el tablon. Se pueden quitar algunas funciones que no se van a usar para este controller 
       
        isUsuario();
        // expira();
        $url=$_GET['url'];
        if(!$url) header ("Location: /usuario/proyectos");
        $tablon=Tablon::where('url',$url);
        if(is_null($tablon)){
            header("Location: /usuario/proyectos");
        }
        $tablon=new Tablon();
        $tablon=$tablon->traerTabloconURLyIdUsuario($_SESSION['id'],$url);
        
        if(empty($tablon))
        {
            header("Location: /usuario/proyectos");
        }
        $alertas=[];
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $id=filter_var($id,FILTER_VALIDATE_INT);
        }else{
            $id=4;
        }
        
        $tablon=Tablon::where('url',$url);
        
       
        $idTablon=$tablon->id;

        $grupos=Grupo::belogsTo('idTablon',$idTablon);
        $tablon=Tablon::where('url',$url);
        // if($tablon->idLider!==$_SESSION['id']){
        //     header ("Location: /admin/proyectos");
        // }
        $usuarios=Usuario::all();
        $tareas=new Tarea();
        $tareas=$tareas->tareasRecuperar($tablon->id);  //Necesario en tablon
        $usuarioTareas=new UsuarioTarea();        
        $usuarioTareas=$usuarioTareas->usuariosTareas($tablon->id);
        foreach($grupos as $grupo)
        {
            $grupo=Grupo::where('id',$grupo->id);
            $grupo->id=$id;
            $grupo->total=$grupo->total($grupo->id);
            $grupo->nuevas=$grupo->estado($grupo->id,0);
            $grupo->estancadas=$grupo->estado($grupo->id,1);
            $grupo->proceso=$grupo->estado($grupo->id,2);
            $grupo->listas=$grupo->estado($grupo->id,3);
            
            $grupo->guardar();   
        }
        $router->render('usuario/tablon',[
            'tablon'=>$tablon,
            'alertas'=>$alertas,
            'resultado'=>$id,
            'grupos'=>$grupos,
            'usuarios'=>$usuarios,
            'tareas'=>$tareas,
            'usuarioTareas'=>$usuarioTareas,
            
        ]);
    }  
    public static function comentarios(Router $router)
    {
        //Permite al usuario agreagar comentarios
        isUsuario();
        // expira();
        $url=($_GET['url']);
        $alertas=[];
        $tarea=new Tarea();
        // $tarea=$tarea->comprobarSiUsuarioTarea($_SESSION['id'],$url); //Comprueba si el usuario que esta legeado esta en la tarea que intenta comentar, sino lo esta no lo permite agregar comentarios o contenido
        // if(empty($tarea))
        // {
        //     header("Location: /usuario/proyectos/tablon?url=$url");
        // }
        $tarea=Tarea::where('url',$url);
        $IdGrupo=$tarea->IdGrupo;
        $grupo=Grupo::where('id',$IdGrupo);
        $idTablon=$grupo->idTablon;
        $tablon=Tablon::where('id',$idTablon);
        $url=$tablon->url;
        $id=$tarea->id;
       
        if($_SERVER['REQUEST_METHOD']==='POST')
        {
            $comentario=new Comentario(); //Crear el comentario
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
              
                if(($ext==='xlsx') || ($ext==='doc') || ($ext==='pdf') || ($ext==='docx') || ($ext==='pptx'))
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
                $alertas['error'][]="Tu comentario esta vacio, vuelve a intentarlo";
            }
            
            if(empty($alertas))
            {
               
                $resultado=$comentario->guardar();
                if($resultado)
                {
                    header("Location: /usuario/proyectos/tablon?url=$url&id=1");
                }
            }
        }
        $router->render('usuario/comentarios',[
            'tarea'=>$tarea,
            'alertas'=>$alertas
            
        ]);
    }
    public static function contenido(Router $router)
    {
        //Permite al usuario visualizar comentarios o contenido agregado a una tarea
        isUsuario();
        // expira();
        $url=$_GET['url'];
        $tarea=new Tarea();
        // $tarea=$tarea->comprobarSiUsuarioTarea($_SESSION['id'],$url); //Si el usuario no esta en ese tarea que intenta comentar o ver no lo permite acceder a ese vista
        // if(empty($tarea))
        // {
        //     header("Location: /usuario/proyectos/tablon?url=$url");
        // }
        $tarea=Tarea::where('url',$url);
        $id=$tarea->id;
        $comentarios=Comentario::belogsToOrdenado('IdTarea',$id);
        
        $router->render('usuario/mostrar',[
            'comentarios'=>$comentarios
            
        ]);
    }
    public static function retro(Router $router)
    {
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }else{
            $id=4;
        }
        $retroalimentacion=new Retro();
        $alertas=[];
        if($_SERVER['REQUEST_METHOD']==='POST')
        {
           
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
                    
                    $retroalimentacion->setImagen($nombreImagen);
                    if(!is_dir(CARPETA_IMAGENES)){
                        mkdir(CARPETA_IMAGENES);
                    }
                    $image->save(CARPETA_IMAGENES .'/'.$nombreImagen);
                }
                elseif($ext===""){
                    $retroalimentacion->imagen="";
                }else{
                    $alertas['error'][]="Formato de imagen no valido";
                }  
            }
            if(!($_POST['contenido']==="")){
                
                $retroalimentacion->contenido=$_POST['contenido'];
                $retroalimentacion->fecha=date('d-m-Y');
                $retroalimentacion->nombre=$_SESSION['nombre'];
                
            }else{
                $alertas['error'][]="tu comentario esta vacio, vuelve a intentarlo";
            }
            if(empty($alertas))
            {
                //Guardar la imagen en el servidor
                $resultado=$retroalimentacion->guardar();
                
                if($resultado)
                {
                    $Correo="desarrollo.terzett@gmail.com";
                    $email=new Email($Correo,$_SESSION['nombre'],$retroalimentacion->contenido);
                    $email->enviarNotificacion();
                    header("Location: /Ayuda?id=1");
                }
            }
        }
        
        $router->render('usuario/ayuda',[
            'alertas'=>$alertas,
            'resultado'=>$id
        ]);
    }
    
    
    
}


?>