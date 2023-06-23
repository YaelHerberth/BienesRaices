<?php

namespace App;

class ActiveRecord
{

    // Base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    // Errores - Validacion
    protected static $errores = [];

    //Definir la conexion a la base de datos
    public static function setDB($database)
    {
        self::$db = $database;
    }



    public function guardar()
    {
        if (!is_null($this->id)) {
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
        $query = "INSERT INTO " . static::$tabla . " ( ";
        $query .=  join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .=  join("', '", array_values($atributos));
        $query .= " ')";

        $resultado = self::$db->query($query);

        // Mensaje de exito o error
        if ($resultado) {
            //Redireccionar al usuario
            header('Location: /BienesRaices/admin/index.php?resultado=1');
        }
    }

    public function actualizar()
    {
        // Sanitizar los datos
        $atributos = $this->sanitizarDatos();

        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key} = '$value'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= "WHERE id = '" . self::$db->escape_string($this->id) . "'";
        $query .= "LIMIT 1  ";

        $resultado = self::$db->query($query);

        if ($resultado) {
            //Redireccionar al usuario
            header('Location: /BienesRaices/admin/index.php?resultado=2');
        }
    }

    // Eliminar un registro

    public function eliminar()
    {

        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if ($resultado) {
            $this->eliminarImagen();
            header('Location: /BienesRaices/admin/index.php?resultado=3');
            // require '/wamp64/www/BienesRaices/admin/index.php';
        }
    }

    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {

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
        if (!is_null($this->id)) {
            $this->eliminarImagen();
        }

        // Asignar al atributo de imagen el nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    //Eliminar imagen
    public function eliminarImagen()
    {
        // Comprobar que existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    // Validacion
    public static function getErrores()
    {
        return static::$errores;
    }

    public function validar()
    {
        static::$errores = [];
        return static::$errores;
    }

    // Lista todas los registros
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Busca los registros segun el id del registro
    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id}";
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
            $array[] = static::crearObjeto($registro);
        }
        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro)
    {
        $objeto = new static;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
