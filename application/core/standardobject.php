<?php

abstract class StandardObject { 
    
    public function delete() {
        $tabla = strtolower(get_class($this));
        $pid = "{$tabla}_id";
        $sql = "DELETE FROM $tabla WHERE $pid = ?";
        $datos = array($this->$pid);
        db($sql, $datos);
    }

    public function insert() {
        $tabla = strtolower(get_class($this));
        $pid = "{$tabla}_id";
        $propiedades = get_object_vars($this);
        unset($propiedades[$pid]);
        foreach($propiedades as $clave=>$valor) {
            if(is_array($valor)) unset($propiedades[$clave]);
            if(is_object($valor)) {
                $t = strtolower(get_class($valor));
                $p = "{$t}_id";
                $id = $valor->$p;
                $propiedades[$clave] = $id;
            }
        }
    
        $campos = implode(", ", array_keys($propiedades));
        $modificadores = array_pad(array(), count($propiedades), "?");
        $valores = implode(", ", $modificadores);
        $sql = "INSERT INTO $tabla ($campos) VALUES ($valores)";
        $datos = array_values($propiedades);
        $this->$pid = db($sql, $datos);
    }

    public function update() {
        $tabla = strtolower(get_class($this));
        $pid = "{$tabla}_id";
        $propiedades = get_object_vars($this);
        unset($propiedades[$pid]);
        foreach($propiedades as $clave=>$valor) {
            if(is_array($valor)) unset($propiedades[$clave]);
            if(is_object($valor)) {
                $t = strtolower(get_class($valor));
                $p = "{$t}_id";
                $id = $valor->$p;
                $propiedades[$clave] = $id;
            }
        }

        $campos = array_keys($propiedades);
        foreach($campos as &$campo) $campo = "{$campo} = ?";
        $campos = implode(", ", $campos);
        $modificadores = array_pad(array(), count($propiedades), "?");
        $valores = implode(", ", $modificadores);
        $sql = "UPDATE $tabla SET $campos WHERE $pid = ?";
        $datos = array_values($propiedades);
        $datos[] = $this->$pid;
        db($sql, $datos);
    }
    
    function select() {
        $tabla = strtolower(get_class($this));
        $pid = "{$tabla}_id";
        $propiedades = get_object_vars($this);
        unset($propiedades[$pid]);
        foreach($propiedades as $clave=>$valor) {
            if(is_array($valor)) unset($propiedades[$clave]);
        }
        
        $campos = implode(", ", array_keys($propiedades));
        
        $sql = "SELECT $campos FROM $tabla WHERE $pid = ?";
        $datos = array($this->$pid);
        $resultados = db($sql, $datos);
       // print_r($resultados);
        if (isset($resultados[0])) {
            foreach($resultados[0] as $clave=>$valor) $this->$clave = $valor;
        }
        
    }

    function get_one() {  
        self::select();
    }

    function get_id($campo, $valor) {
        $tabla = strtolower(get_class($this));
        $pid = "{$tabla}_id";
        
        $sql = "SELECT $pid FROM $tabla WHERE $campo = ?";
        $datos = array($valor);
        $resultados = db($sql, $datos);

        if (isset($resultados[0])) {
            return $resultados[0][$pid];
        }
        

    }

}

?>