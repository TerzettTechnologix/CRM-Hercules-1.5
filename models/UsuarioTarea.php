<?php


namespace Model;

class UsuarioTarea extends ActiveRecord{
    protected static $tabla='usuariotarea';
    protected static $columnasDB=['id','IdTarea','IdUsuario','nombre','apellidoPaterno'];
    public $id;
    public $IdTarea;
    public $IdUsuario;
    public $nombre;
    public $apellidoPaterno;
    public function __construct($args=[])
    {
        $this->id=$args['id'] ?? null;
        $this->IdTarea=$args['IdTarea'] ?? '';
        $this->IdUsuario=$args['IdUsuario'] ?? '';
        $this->IdUsuario=$args['nombre'] ?? null;
        $this->IdUsuario=$args['apellidoPaterno'] ?? null;
    }
    //Mensajes de validacion para los usurios con tareas
    public function validarUsuario(){
        if(!$this->IdUsuario){
            self::$alertas['error'][]="Debe seleccionar minimo un usuario para la tarea creada";
        }
        return self::$alertas;
    }
    
}