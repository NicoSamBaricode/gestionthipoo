<?php
class conexionDb{

    private $host = 'localhost';
    private $usuario = 'root';
    private $password = '';
    private $database = 'gestion';
    
    protected $conexion;
    
    public function __construct(){

        if (!isset($this->conexion)) {
            
            $this->conexion = new mysqli($this->host, $this->usuario, $this->password, $this->database);
            
            if (!$this->conexion) {
                echo 'Error al conectar a la base de datos';
                exit;
            }            
        }    
        
        return $this->conexion;
    }
}
?>