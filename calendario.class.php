
<?php
include_once('DbConnection.php');
include_once('logs.class.php');
$log=new log_class();
class calendario_class extends conexionDb{

    public function __construct(){

        parent::__construct();
    }

    
    public function detalle($sql){

        $query = $this->conexion->query($sql);
        
        $row = $query->fetch_array();
            
        return $row;       
    }
    // cast
    public function escape_string($value){
        
        return $this->conexion->real_escape_string($value);
    }

    // mostrar datos de la tabla de actividades
    public function mostrarDatos()
		{
		    $query = "SELECT * FROM mes";
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
		    $query = "SELECT * FROM mes WHERE id_Mes = '$id'";
		    $result = $this->conexion->query($query);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			return $row;
		    }else{
                echo"<script> alert('No se encontro el registro'); </script>";
		    }
		}

		// actualiza datos en la tabla
		public function actualizarFila($postData)
		  
		{   $log=new log_class();
			 $id = $this->conexion->real_escape_string($postData['id_Mes']);
            $horas = $this->conexion->real_escape_string($postData['horas']);
			
		if (!empty($id) && !empty($postData)) {
			
			//$query = "UPDATE mes SET horas_Totales = $horas WHERE id_Mes = '$id'";
			$query= "UPDATE `mes` SET `horas_Totales` = '$horas' WHERE `mes`.`id_Mes` = $id";
			
			$sql = $this->conexion->query($query);
			if ($sql==true) {
				$log->insertarLog($_SESSION['user'],"Se modifico hora laborable mes id: ".$id);
			    echo"<script> alert('Se actualizaron los datos con exito'); window.location='/GestionThi/gestionthipoo/Configuracion.php'</script> ";
			}else{
				$log->insertarLog($_SESSION['user'],"fallo al modificar hora laborable");
			    echo"<script> alert('Fallo al actualizar datos');window.location='/GestionThi/gestionthipoo/Configuracion.php'</script>  </script>";
			}
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
			public function buscarIdRepetido($identificador)
					{
						$query = "SELECT identificador FROM actividades WHERE identificador=$identificador ";
		    			$result = $this->conexion->query($query);
						
					if ($result->num_rows > 0) {
						echo " Identificador no disponible";
						//echo"<script> alert('El identificador ingresado ya existe, por favor ingrese uno diferente.'); window.location='/test/crear_proyecto.php'</script> ";
						return true;
						}
						else{

						 
						 return false;
						}
					}
}