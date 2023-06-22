<?php

namespace App;

use ReflectionFunctionAbstract;

class Propiedad
{

    // Base de datos
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

    // Errores - Validacion
    protected static $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    //Definir la conexion a la base de datos
    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d') ?? '';
        $this->vendedorId = $args['vendedorId'] ?? 1;
    }

    public function guardar(){
        if(isset($this->id)) {
            // Actualizar
            $this->actualizar();
        } else {
            // Creando un nuevo registro
            $this->crear();
        }
    }

    public function crear()
    {
        // Sanitizar los datos
        $atributos = $this->sanitizarDatos();

        // Join sirve para aplanar arreglos osea que los datos se vean en una misma linea, toma 2 parametros, el primero es el separador, es decir como es que se va a separar y el segundo parametro son los datos,
        // array_keys te muestra las llaves del arreglo, es decir el titulo que guarda la informacion

        //Insertar en la base de datos
        $query = "INSERT INTO propiedades( ";
        $query .=  join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .=  join("', '", array_values($atributos));
        $query .= " ')";

        $resultado = self::$db->query($query);

        return $resultado;
    }

    public function actualizar(){
        // Sanitizar los datos
        $atributos = $this->sanitizarDatos();

        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "{$key} = '$value'";
        }

        $query = "UPDATE propiedades SET ";
        $query .= join(', ', $valores);
        $query .= "WHERE id = '" . self::$db->escape_string($this->id) . "'";
        $query .= "LIMIT 1  ";

        $resultado = self::$db->query($query);

        if ($resultado) {
            //Redireccionar al usuario
            header('Location: /BienesRaices/admin/index.php?resultado=2');
        }

    }

    public function atributos()
    {
        $atributos = [];
        foreach (self::$columnasDB as $columna) {

            if ($columna === 'id') continue; // Continue en un if: Si se cumple la condicion deja de ejecutar el if
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarDatos()
    {
        $atributos = $this->atributos();
        $sanitizando = [];


        foreach ($atributos as $key => $value) {
            $sanitizando[$key] = self::$db->escape_string($value);
        }
        return $sanitizando;
    }

    //Subida de archivos
    public function setImagen($imagen)
    {
        // Elimina la imagen previa
        if(isset($this->id)){
            // Comprobar que existe el archivo
            $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
            if($existeArchivo){
                unlink(CARPETA_IMAGENES . $this->imagen);
            }
        }

        // Asignar al atributo de imagen el nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    // Validacion
    public static function getErrores()
    {
        return self::$errores;
    }

    public function validar()
    {
        if (!$this->titulo) {
            self::$errores[] = 'Debes añadir un titulo';
        }
        if (!$this->precio) {
            self::$errores[] = 'Debes añadir un precio';
        }
        if (strlen($this->descripcion) < 50) {
            self::$errores[] = 'Debes añadir una descripcion y debe tener al menos 50 caracteres';
        }
        if (!$this->habitaciones) {
            self::$errores[] = 'Debes añadir el numero de habitaciones';
        }
        if (!$this->wc) {
            self::$errores[] = 'Debes añadir el numero de baños';
        }
        if (!$this->estacionamiento) {
            self::$errores[] = 'Debes añadir el numero de estacionamientos';
        }
        if (!$this->vendedorId) {
            self::$errores[] = 'Debes elegir un vendedor';
        }

        if (!$this->imagen) {
            self::$errores[] = 'La imagen es obligatoria';
        }

        return self::$errores;
    }

    // Lista todas los registros
    public static function all()
    {
        $query = "SELECT * FROM propiedades";
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Busca los registros segun el id del registro
    public static function find($id)
    {
        $query = "SELECT * FROM propiedades WHERE id = {$id}";
        $resultado = self::consultarSQL($query);

        // Array_shift manda el primer elemento de un arreglo

        return array_shift($resultado);
    }

    public static function consultarSQL($query)
    {
        // Consultar en la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = self::crearObjeto($registro);
        }
        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro)
    {
        $objeto = new self;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = []){
        foreach($args as $key => $value){
            if(property_exists($this, $key) && !is_null($value) ){
                $this->$key = $value;
            }
        }
    }
}
