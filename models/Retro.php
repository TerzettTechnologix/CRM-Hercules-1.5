<?php


namespace Model;

class Retro extends ActiveRecord{
    protected static $tabla='retroalimentacion';
    protected static $columnasDB=['id','fecha','imagen','contenido','nombre'];
    public $id;
    public $fecha;
    public $imagen;
    public $contenido;
    public $nombre;
    public function __construct($args=[])
    {
        $this->id=$args['id'] ?? null;
        $this->fecha=$args['fecha'] ?? '';
        $this->imagen=$args['imagen'] ?? '';
        $this->contenido=$args['contenido'] ?? '';
        $this->nombre=$args['nombre'] ?? '';
    }
    //Mensajes de validacion para la creacion de una cuenta
    //Subida de archivos
    public function setImagen($imagen)
    {
        //Asignar al aatributo imagen el nombre de la imagen
        if($imagen)
        {
            $this->imagen=$imagen;
        }
        
    }
    public function setArchivo($archivo)
    {
        //Asignar al aatributo imagen el nombre de la imagen
        if($archivo)
        {
            $this->archivo=$archivo;
        }
        
    }
   
}