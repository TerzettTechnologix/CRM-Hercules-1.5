<?php


namespace Model;

class Comentario extends ActiveRecord{
    protected static $tabla='comentarios';
    protected static $columnasDB=['id','contenido','IdTarea','IdUsuario','fecha','nombre','imagen','archivo'];
    public $id;
    public $contenido;
    public $IdTarea;
    public $IdUsuario;
    public $fecha;
    public $nombre;
    public $imagen;
    public $archivo;
    public function __construct($args=[])
    {
        $this->id=$args['id'] ?? null;
        $this->contenido=$args['contenido'] ?? '';
        $this->IdTarea=$args['IdTarea'] ?? '';
        $this->IdUsuario=$args['IdUsuario'] ?? '';
        $this->fecha=$args['fecha'] ?? '';
        $this->nombre=$args['nombre'] ?? '';
        $this->imagen=$args['imagen'] ?? '';
        $this->archivo=$args['archivo'] ?? '';
    }
    //Mensajes de validacion para la creacion de una cuenta
    public function validarGrupo(){
        if(!$this->nombre){
            self::$alertas['error'][]="El nombre es obligatorio";
        }
        return self::$alertas;
    }
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