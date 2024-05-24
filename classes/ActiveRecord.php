<?php

namespace App;

class ActiveRecord {
    // Base de datos
    protected static $db;
    protected static $columnasDB = []; // Identificamos los datos
    protected static $tabla = '';

    // Errores
    protected static $errores = [];

    // Definir la conexion a la base de datos
    public static function setDB($database) {
        self::$db = $database;
    }

    public function guardar() {
        if(!is_null($this->id)) {
            // Actualizar
            $this->actualizar();

        } else {
            // Creando un nuevo registro
            $this->crear();
        }
    }

    public function crear() {

        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        //Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query);

        // Mensaje de exito
        if($resultado) {
            // Redireccion al usuario
            header('Location: /BienesRaices/admin?Resultado=1');
        }
    }

    public function actualizar() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key =>$value){
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);

        if($resultado) {
            // Redireccion al usuario
            header('Location: /BienesRaices/admin?Resultado=2');
        }
    }

    // Eliminar un registro
    public function eliminar() {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado) {
            $this->borrarImagen();
            header('Location: /BienesRaices/admin?Resultado=3');
        }
    }

    // Identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach(self::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }

    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];


        foreach($atributos as $key => $value ) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    // Subida de Archivos
    public function setImagen($imagen) {
        // Elimina la imagen previa
        if(!is_null($this->id)) {
            $this->borrarImagen();
        }

        // Asignar al atributo de imagen el nombre de la imagen
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    // Elimina el archivo
    public function borrarImagen() {
        if(isset($this->id)) {
            // Comprobar si existe el archivos
            $existArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
            if($existArchivo) {
                unlink(CARPETA_IMAGENES . $this->imagen);
            }
        }
    }

    // Validacion
    public static function getErrores() {
        return self::$errores;
    }

    public function validar() {

        //Validaciones
        if(!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }

        if(!$this->precio) {
            self::$errores[] = "El precio es obligatorio";
        }

        if(strlen( $this->descripcion) < 50) {
            self::$errores[] = "La descripcion es obligatoria";
        }

        if(!$this->habitaciones) {
            self::$errores[] = "El numero de habitaciones es obligatorio";
        }

        if(!$this->wc) {
            self::$errores[] = "El numero de baños es obligatorio";
        }

        if(!$this->estacionamiento) {
            self::$errores[] = "El numero de estacionamiento es obligatorio";
        }

        if(!$this->wc) {
            self::$errores[] = "El numero de baños es obligatorio";
        }

        if(!$this->vendedores_id) {
            self::$errores[] = "Elije un vendedor";
        }

        if(!$this->imagen) {
            self::$errores[] = "La imagen es obligatoria";
        }

        return self::$errores;
    }

    // Lista todas las propiedades
    
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Busca un registro por su ID

    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";

        $resultado = self::consultarSQL($query);

        return array_shift( $resultado );
    }

    public static function consultarSQL($query) {
        // Consultar la db

        $resultado = self::$db->query($query);

        // Iterar los resultados

        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = self::crearObjeto($registro);
        }

        // Liberar la memoria

        $resultado->free();

        // Retornar los resultados
        return $array;

    }

    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach( $registro as $key => $value ) {
            if( property_exists( $objeto, $key ) ) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario

    public function sincronizar( $args= [] ) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}