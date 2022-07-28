<?php


namespace Model;

class Tarea extends ActiveRecord{
    protected static $tabla='tareas';
    protected static $columnasDB=['id','nombre','estado','IdGrupo','fecha','fechaFinalizacion','url','totalHrs','porcentaje','hrsRestantes','color'];
    public $id;
    public $nombre;
    public $estado;
    public $IdGrupo;
    public $fechaFinalizacion;
    public $url;
    public $totalHrs;
    public $porcentaje;
    public $hrsRestantes;
    public $color;
    public function __construct($args=[])
    {
        $this->id=$args['id'] ?? null;
        $this->nombre=$args['nombre'] ?? '';
        $this->estado=$args['estado'] ?? '';
        $this->IdGrupo=$args['IdGrupo'] ?? '';
        $this->fecha=$args['fecha'] ?? '';
        $this->fechaFinalizacion=$args['fechaFinalizacion'] ?? '';
        $this->url=$args['url'] ?? '';
        $this->totalHrs=$args['totalHrs'] ?? 0;
        $this->porcentaje=$args['porcentaje'] ?? 0;
        $this->hrsRestantes=$args['hrsRestantes'] ?? 0;
        $this->color=$args['color'] ?? 0;
       
    }
    //Mensajes de validacion para la creacion de una cuenta
    public function validarTarea(){
        if(!$this->nombre){
            self::$alertas['error'][]="El nombre es obligatorio";
        }
        if(!$this->IdGrupo){
            self::$alertas['error'][]="El grupo es obligatorio";
        }
        if(strlen($this->nombre) >= 50){
            self::$alertas['error'][]="El nombre de la tarea no puede ser mayor a 50 caracteres";
        }
        if($this->porcentaje > 100 || $this->porcentaje < 0){
            self::$alertas['error'][]="El porcentaje no puede ser mayor a 100 ni menor a cero";
        }
        return self::$alertas;
    }
    
}