<?php


namespace Model;

class Usuario extends ActiveRecord{
    protected static $tabla='usuario';
    protected static $columnasDB=['id','nombre','apellidoPaterno','apellidoMaterno','correo',
    'contraseña','puesto','rol','tipo','numeroempleado','activo'];
    public $id;
    public $nombre;
    public $apellidoPaterno;
    public $apellidoMaterno;
    public $correo;
    public $contraseña;
    public $puesto;
    public $rol;
    public $tipo;
    public $numeroempleado;
    public $activo;
    public function __construct($args=[])
    {
        $this->id=$args['id'] ?? null;
        $this->nombre=$args['nombre'] ?? '';
        $this->apellidoPaterno=$args['apellidoPaterno'] ?? '';
        $this->apellidoMaterno=$args['apellidoMaterno'] ?? '';
        $this->correo=$args['correo'] ?? '';
        $this->contraseña=$args['contraseña'] ?? '';
        $this->puesto=$args['puesto'] ?? '';
        $this->rol=$args['rol'] ?? null;
        $this->tipo=$args['tipo'] ?? '';
        $this->numeroempleado=$args['numeroempleado'] ?? '';
        $this->activo=$args['activo'] ?? '';
    }
    //Mensajes de validacion para la creacion de una cuenta
    public function validarNuevaCuenta(){
        if(!$this->nombre){
            self::$alertas['error'][]="El nombre es obligatorio";
        }
        if(!$this->apellidoPaterno){
            self::$alertas['error'][]="El Apellido Paterno es obligatorio";
        }
        if(!$this->apellidoMaterno){
            self::$alertas['error'][]="El Apellido Materno es obligatorio";
        }
        if(!$this->correo){
            self::$alertas['error'][]="El correo es obligatorio";
        }
        if(!$this->contraseña){
            self::$alertas['error'][]="La contraseña es obligatorio";
        }
        if(!$this->puesto){
            self::$alertas['error'][]="El puesto es obligatorio";
        }
        if(!$this->numeroempleado){
            self::$alertas['error'][]="El Numero de Empleado es obligatorio";
        }
        
        return self::$alertas;
    }
    public function validarActualizacionCuenta(){
        if(!$this->nombre){
            self::$alertas['error'][]="El nombre es obligatorio";
        }
        if(!$this->apellidoPaterno){
            self::$alertas['error'][]="El Apellido Paterno es obligatorio";
        }
        if(!$this->apellidoMaterno){
            self::$alertas['error'][]="El Apellido Materno es obligatorio";
        }
        if(!$this->correo){
            self::$alertas['error'][]="El correo es obligatorio";
        }
        if(!$this->puesto){
            self::$alertas['error'][]="El puesto es obligatorio";
        }
        if(!$this->numeroempleado){
            self::$alertas['error'][]="El Numero de Empleado es obligatorio";
        }
        
        return self::$alertas;
    }
    public function validarLogin(){
        if(!$this->correo){
            self::$alertas['error'][]="El correo es obligatorio";
        }
        if(!$this->contraseña){
            self::$alertas['error'][]="La contraseña es obligatoria";
        }
        return self::$alertas;
    }
    public function hashPassword()
    {
        $this->contraseña=password_hash($this->contraseña,PASSWORD_BCRYPT);
    }
    public function comprobarPassword($contraseña)
    {
        $resultado=password_verify($contraseña,$this->contraseña);
        
        if(!$resultado){
            self::$alertas['error'][]="Datos incorrectos, vuelve a intentarlo";
        }
        return $resultado;
    }
    
}