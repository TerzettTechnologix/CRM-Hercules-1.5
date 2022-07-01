<?php
namespace Controllers;
use MVC\Router;
use Model\Usuario;

class LoginController{
    public static function login(Router $router){
        $alertas=[];
        if($_SESSION){
            session_destroy();
        }
        $auth=new Usuario();
        if($_SERVER['REQUEST_METHOD']==="POST"){
           $auth=new Usuario($_POST);
           $alertas=$auth->validarLogin();
           if(empty($alertas)){
               //Comprobar que exista el usuario
               $usuario=Usuario::where('correo',$auth->correo);
               if($usuario){
                   //Si el usuario existe, se verifica que su contraseña sea correcta
                   if($usuario->comprobarPassword($auth->contraseña)){
                        //Se agregan un conjunto de datos a la variable global seccion que van a permitir usar estos datos posteriormente
                       $_SESSION['id']=$usuario->id;
                       $_SESSION['nombre']=$usuario->nombre." ".$usuario->apellidoPaterno. " ".$usuario->apellidoMaterno;
                       $_SESSION['rol']=$usuario->rol;
                       $_SESSION['correo']=$usuario->correo;
                       $_SESSION['login']=true;
                       $_SESSION['ultimoAcceso']=date("Y-n-j H:i:s");
                       
                       //Redireccionamientp, dependiento del rol que tenga la persona que esta accesando
                       if($usuario->rol==="0"){
                            //Si es cero, se va a mandar a admin
                           session_start();
                           header('Location: /admin/usuarios');
                       }else if($usuario->rol==="1"){
                            //Si es uno, se va a mandar a empleado
                            session_start();
                            header('Location: /lider/usuario');
                       }else{
                            //Si es dos, se va a mandar a empleado
                            session_start();
                            header('Location: /usuario/usuario');
                       }
                   }
                    
               }else{
                //Si el usuario no existe te manda un notificacion de error
                   Usuario::setAlerta('error','Usuario no encontrado');
               }
           }
          
        }
        $alertas=Usuario::getAlertas();
        $router->render('auth/login',[
            'alertas'=>$alertas,
            'auth'=>$auth
        ]);
    }
    public static function logout(){
        //Al finalizar la sesion se borran los datos de la session para que el usuario tenga que volver a logearse
        session_start();
        $_SESSION=[];
        header('Location: /');
    }
    public static function recuperar(){
        //Parte que se encarga de restablecer la contraseña del usuario si el asi lo desea
        $id=$_GET['id'];
        $id=filter_var($id,FILTER_VALIDATE_INT);
        if(!$id){
            header("Location: /admin/usuarios");
        }
        $usuario=Usuario::find($id);
        $contraseña=password_hash("12345",PASSWORD_DEFAULT);
        $usuario->contraseña=$contraseña;
        $resultado=$usuario->guardar();
        if($resultado){
            header("Location: /admin/usuarios?id=2");
        }
    }
    
}


?>