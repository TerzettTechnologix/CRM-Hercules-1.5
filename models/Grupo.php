<?php


namespace Model;

class Grupo extends ActiveRecord{
    protected static $tabla='grupo';
    protected static $columnasDB=['id','nombre','idTablon','total','nuevas','estancadas','proceso','listas'];
    public $id;
    public $nombre;
    public $idTablon;
    public $total;
    public $nuevas;
    public $estancadas;
    public $proceso;
    public $listas;
    public function __construct($args=[])
    {
        $this->id=$args['id'] ?? null;
        $this->nombre=$args['nombre'] ?? '';
        $this->idTablon=$args['idTablon'] ?? '';
        $this->total=$args['idTablon'] ?? '';
        $this->nuevas=$args['nuevas'] ?? '';
        $this->estancadas=$args['estancadas'] ?? '';
        $this->proceso=$args['proceso'] ?? '';
        $this->listas=$args['listas'] ?? '';
    }
    //Mensajes de validacion para la creacion de una cuenta
    public function validarGrupo(){
        if(!$this->nombre){
            self::$alertas['error'][]="El nombre es obligatorio";
        }
        return self::$alertas;
    }
   
}