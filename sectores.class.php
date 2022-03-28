<?php
include_once('DbConnection.php');
 
class Sector extends conexionDb{

    public function __construct(){

        parent::__construct();
    }
    
   
     // todo el arreglo completo  
    public function detalle($sql){

        $query = $this->conexion->query($sql);
        
        $row = $query->fetch_array();
            
        return $row;       
    }
    // cast
    public function escape_string($value){
        
        return $this->conexion->real_escape_string($value);
    }

    // mostrar datos de la tabla de usuarios
    public function mostrarDatos()
		{
		    $query = "SELECT * FROM sector";
		    $result = $this->conexion->query($query);
		if ($result->num_rows > 0) {
		    $data = array();
		    while ($row = $result->fetch_assoc()) {
		           $data[] = $row;
		    }
			 return $data;
		    }else{
			 echo "Base de datos vacia";
		    }
		}

    
        // Saca datos de una sola fila filtrado por id
		public function mostrarFilaPorId($id)
		{
		    $query = "SELECT * FROM sector WHERE Sector_id = '$id'";
		    $result = $this->conexion->query($query);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			return $row;
		    }else{
                echo"<script> alert('No se encontro el registro'); </script>";
		    }
		}

		
  		 
					public function mostrarDatosBusqueda($query)
					{
						
						$result = $this->conexion->query($query);
					if ($result->num_rows > 0) {
						$data = array();
						while ($row = $result->fetch_assoc()) {
							   $data[] = $row;
						}
						 return $data;
						}else{

						 echo "No se encontraron datos";
						 
						 return array();
						}
					}
		
}