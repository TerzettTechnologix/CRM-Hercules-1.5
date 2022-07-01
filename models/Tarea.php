<?php


namespace Model;

class Tarea extends ActiveRecord{
    protected static $tabla='tareas';
    protected static $columnasDB=['id','nombre','estado','IdGrupo','fecha','url'];
    public $id;
    public $nombre;
    public $estado;
    public $IdGrupo;
    public $url;
    public function __construct($args=[])
    {
        $this->id=$args['id'] ?? null;
        $this->nombre=$args['nombre'] ?? '';
        $this->estado=$args['estado'] ?? '';
        $this->IdGrupo=$args['IdGrupo'] ?? '';
        $this->fecha=$args['fecha'] ?? '';
        $this->url=$args['url'] ?? '';
       
    }
    //Mensajes de validacion para la creacion de una cuenta
    public function validarTarea(){
        if(!$this->nombre){
            self::$alertas['error'][]="El nombre es obligatorio";
        }
        if(!$this->IdGrupo){
            self::$alertas['error'][]="El grupo es obligatorio";
        }
        return self::$alertas;
    }
    
}