<?php

class Conectar{


    public static function conexion(){
    
        try {
            $conexion=new PDO('mysql:host=db; dbname=credicontrol', 'root', 'test');
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->exec("SET CHARACTER SET UTF8");
            return $conexion;
        } catch (Exception $e) {

            die("Error ". $e->getMessage());
            echo "Linea del Error". $e->getLine();
            
        }
    }
}

?>

