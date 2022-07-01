<?php


namespace Model;

class Tablon extends ActiveRecord{
    protected static $tabla='tablon';
    protected static $columnasDB=['id','nombre','lider','descripcion','fecha','idLider','url','lugar'];
    public $id;
    public $nombre;
    public $lider;
    public $descripcion;
    public $fecha;
    public $idLider;
    public $url;
    public $lugar;
    public function __construct($args=[])
    {
        $this->id=$args['id'] ?? null;
        $this->nombre=$args['nombre'] ?? '';
        $this->lider=$args['lider'] ?? '';
        $this->descripcion=$args['descripcion'] ?? '';
        $this->fecha=$args['fecha'] ?? '';
        $this->idLider=$args['idLider'] ?? '';
        $this->url=$args['url'] ?? '';
        $this->lugar=$args['lugar'] ?? '';
    }
    //Mensajes de validacion para la creacion de una cuenta
    public function validarTablon(){
        if(!$this->nombre){
            self::$alertas['error'][]="El nombre es obligatorio";
        }
        if(!$this->descripcion){
            self::$alertas['error'][]="La descripcion obligatoria";
        }
        
        
        return self::$alertas;
    }
   
}