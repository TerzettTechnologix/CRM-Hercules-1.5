<?php
namespace Model;
class ActiveRecord {

    // Base DE DATOS
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];

    // Alertas y Mensajes
    protected static $alertas = [];
    
    // Definir la conexión a la BD - includes/database.php
    public static function setDB($database) {
        self::$db = $database;
    }

    public static function setAlerta($tipo, $mensaje) {
        static::$alertas[$tipo][] = $mensaje;
    }

    // Validación
    public static function getAlertas() {
        return static::$alertas;
    }

    public function validar() {
        static::$alertas = [];
        return static::$alertas;
    }
    public function validarORedireccionar(string $url){
        $id=$_GET['id'];
        $id=filter_var($id,FILTER_VALIDATE_INT);
        if(!$id){
            header("Location : ${url}");
        }
        return $id;
    }

    // Consulta SQL para crear un objeto en Memoria
    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // liberar la memoria
        $resultado->free();

        // retornar los resultados
        return $array;
    }
    // Busqueda Where con Columna 
    public static function where($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ${columna} = '${valor}'";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }
    public static function belogsToOrdenado($columna,$valor)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ${columna} = '${valor}' ORDER BY fecha desc";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    public static function belogsTo($columna,$valor)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ${columna} = '${valor}' order by id desc";
        $resultado = self::consultarSQL($query);
        
        return $resultado;
    }
    public static function belogsToAsc($columna,$valor)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ${columna} = '${valor}' order by id asc";
        $resultado = self::consultarSQL($query);
        
        return $resultado;
    }
    public static function belongsToLider($columna,$valor,$lider)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ${columna} = '${valor}' and idLider='${lider}' order by fecha desc";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    public static function beongsToUsuario($id,$lugar)
    {
        $query="SELECT * FROM usuariotarea ua inner join tareas t on ua.IdTarea=t.id  inner join grupo g on t.IdGrupo=g.id 
        inner join tablon ta on ta.id=g.idTablon  where ua.IdUsuario='${id}' and  ta.lugar='${lugar}' order by ta.fecha desc";
        $resultado = self::consultarSQL($query);
        return $resultado;

    }


    // Crea el objeto en memoria que es igual al de la BD
    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach($registro as $key => $value ) {
            if(property_exists( $objeto, $key  )) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    // Identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // Sanitizar los datos antes de guardarlos en la BD
    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value ) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    // Sincroniza BD con Objetos en memoria
    public function sincronizar($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }

    // Registros - CRUD
    public function guardar() {
        $resultado = '';
        
        if(!is_null($this->id)) {
            // actualizar
            $resultado = $this->actualizar();
            
        } else {
            // Creando un nuevo registro
            $resultado = $this->crear();    
        }
        
        return $resultado;
    }

    // Todos los registros
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    public static function usuarioSinAdmin(){
        $query="SELECT * FROM" . " usuario where rol=1 or rol=2 order by numeroempleado";
        $resultado=self::consultarSQL($query);
        return $resultado;
    }
    public static function usuariosEmpleado()
    {
        $query="SELECT * FROM usuario order by numeroempleado";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    public static function allFecha()
    {
        $query="SELECT * FROM"  ." ". static::$tabla ." " ."ORDER BY fecha desc";
        $resultado = self::consultarSQL($query);
        
        return $resultado;

    }

    public static function allFechaLider($id)
    {
        $query="SELECT * FROM"  ." ". static::$tabla ." " ." WHERE idLider=${id} ORDER BY fecha desc";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    public static function allFechaUsuario($id)
    {
        $query="SELECT * FROM usuariotarea ua inner join tareas t on ua.IdTarea=t.id  inner join grupo g on t.IdGrupo=g.id 
        inner join tablon ta on ta.id=g.idTablon  where ua.IdUsuario=${id} order by ta.fecha desc";
        $resultado = self::consultarSQL($query);
        
        return $resultado;
    }
    
    public static function tareasRecuperar($id)
    {
        $query="SELECT * FROM tablon t inner join grupo g on g.idTablon=t.id inner join tareas ta on g.id=ta.IdGrupo  where t.id=${id}";
        $resultado = self::consultarSQL($query);
        
        return $resultado;
        
    }
    public static function total($id)
    {
        $query="SELECT count(*) as total FROM tareas where idGrupo=${id}";
        $resultado = self::consultarSQL($query);
        return $resultado[0]->total;

    }
    public static function estado($id,$valor)
    {
        $query="SELECT count(*) as total FROM tareas where idGrupo=${id} and estado=${valor}";
        $resultado = self::consultarSQL($query);
        
        return $resultado[0]->total;
    }
    public static function usuariocheck($gid,$tid)
    {
        $query="SELECT * FROM tareas t inner join grupo g on g.id=t.IdGrupo inner join usuariotarea ua on ua.IdTarea=t.id  
        inner join usuario u on u.id= ua.IdUsuario where g.id=${gid} and t.id=${tid}";
        $resultado = self::consultarSQL($query);

        return $resultado;
        
    }
    public static function usuariosTareas($id)
    {
        $query="SELECT * FROM tablon t inner join grupo g on g.idTablon=t.id inner join tareas ta on g.id=ta.IdGrupo inner join 
        usuariotarea ut on ut.IdTarea=ta.id inner join usuario u on u.id=ut.IdUsuario where t.id=$id";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Busca un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE id = ${id}";
        // debuguear($query);
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // Obtener Registros con cierta cantidad
    public static function get($limite) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT ${limite}";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // crea un nuevo registro
    public function crear() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('"; 
        $query .= join("', '", array_values($atributos));
        $query .= "') ";
        
        // Resultado de la consulta
        $resultado = self::$db->query($query);
        return [
           'resultado' =>  $resultado,
           'id' => self::$db->insert_id
        ];
    }
    //Buscar una tablon por titulo con el boton search
    public function buscarPalabra($palabra)
    {
        $query="SELECT * FROM tablon where nombre LIKE '%$palabra%' order by id desc ";
        
        $resultado = self::consultarSQL($query);
        return $resultado;
        
    }
    //Buscar una tablon por titulo y el idLider con el boton search
    public function buscarPalabraLider($palabra,$lider)
    {
        $query="SELECT * FROM tablon where nombre LIKE '%$palabra%' and idLider=${lider}";
        
        $resultado = self::consultarSQL($query);
        return $resultado;
        
    }
    public function buscardorPalabraUsuario($palabra,$lider)
    {
        $query="SELECT * FROM usuariotarea ua inner join tareas t on ua.IdTarea=t.id  inner join grupo g on t.IdGrupo=g.id 
        inner join tablon ta on ta.id=g.idTablon  where ua.IdUsuario=${lider} and  ta.nombre LIKE '%$palabra%' order by ta.fecha desc";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    public function traerTabloconURLyIdUsuario($id,$url)
    {
        $query="SELECT * FROM usuario u inner join usuariotarea ua on u.id=ua.IdUsuario  inner join tareas t on t.id=ua.IdTarea 
        inner join grupo g on g.id=t.IdGrupo inner join tablon ta on g.idTablon=ta.id where u.id='${id}' and ta.url='${url}'";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    public function comprobarSiUsuarioTarea($id,$url)
    {
        $query="SELECT * FROM tareas t inner join usuariotarea ta on t.id=ta.IdTarea where t.url='${url}' and ta.IdUsuario='${id}'";
        $resultado = self::consultarSQL($query);
        
        return $resultado;
    }

    public function crearVarios() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('"; 
        $query .= join("', '", array_values($atributos));
        $query .= "') ";
        // Resultado de la consulta
        $resultado = self::$db->query($query);
        return [
           'resultado' =>  $resultado,
           'id' => self::$db->insert_id
        ];
    }
    public function MezclaTablas($grupo)
    {
        $query ="SELECT * FROM tareas t inner join grupo g on t.IdGrupo=g.id where t.IdGrupo=$grupo";
        // Resultado de la consulta
        $resultado = self::consultarSQL($query);
        
        return $resultado;
        
    }

    // Actualizar el registro
    public function actualizar() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        
        // Iterar para ir agregando cada campo de la BD
        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        
        // Consulta SQL
        $query = "UPDATE " . static::$tabla ." SET ";
        $query .=  join(', ', $valores );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 "; 
        // debuguear($query);
        // Actualizar BD
        $resultado = self::$db->query($query);
        return $resultado;
    }

    // Eliminar un Registro por su ID
    public function eliminar() {
        $query = "DELETE FROM "  . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }
    //Eliminar un registro especifico de la base de datos 
    public function EliminarRegistro($id)
    {
        $query="DELETE FROM " . static::$tabla . " WHERE IdTarea= " . "${id}";
        $resultado = self::$db->query($query);
        return $resultado;

    }

}