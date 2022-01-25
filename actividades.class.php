
<?php
include_once('DbConnection.php');
 
class actividades_class extends conexionDb{

    public function __construct(){

        parent::__construct();
    }
   //contador general
    public function cont_a(){
        
        $contador_p = "SELECT COUNT(*) totalp FROM actividades";
        
        $queryp = $this->conexion->query($contador_p);

        if($queryp->num_rows > 0){
            $fila = $queryp->fetch_array();
            return $fila['totalp'];
        }
        else{
            return false;
        }
            
             
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
		    $query = "SELECT * FROM actividades";
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
		public function arrayGrafico()
		{
		    $query = "SELECT nombre,horas_dedicadas,color_act FROM actividades";
		    $result = $this->conexion->query($query);
		if ($result->num_rows > 0) {
		    $data = array();
		    while ($row = $result->fetch_assoc()) {
		           $data[] = $row;
		    }
			 return  json_encode($data);
		    }else{
			 echo "Base de datos vacia";
		    }
		}
      
    // Insertar datos a la tabla de actividades
		public function insertarDatos($post)
		{
			$nombre = $this->conexion->real_escape_string($_POST['nombre']);			
			$identificador = $this->conexion->real_escape_string($_POST['identificador']);
			$descrip = $this->conexion->real_escape_string($_POST['descrip']);
			$horas = $this->conexion->real_escape_string($_POST['horas']);
			$color = $this->conexion->real_escape_string($_POST['color']);
			//busco que no exista el identificador
			$queryident = "SELECT identificador FROM actividades WHERE identificador=$identificador ";
		    			$result = $this->conexion->query($queryident);
						if ($result->num_rows > 0) {
							
							echo"<script> alert('El identificador ingresado ya existe, por favor ingrese uno diferente.'); window.location='/GestionThi/gestionthipoo/crear_actividades.php'</script> ";
							
							}
							else{
	
							 $query="INSERT INTO actividades(identificador,nombre,descripcion,horas_dedicadas,color_act) 
           							 VALUES ('$identificador','$nombre','$descrip','$horas','$color')";
							$sql = $this->conexion->query($query);
							if ($sql==true) {
						    echo"<script> alert('Se creo la actividad con exito'); window.location='/GestionThi/gestionthipoo/Lista_actividades.php'</script> ";
							}else{
			   				 echo"<script> alert('Fallo al insertar datos'); </script>";
			}
							 
							}
            
            
		}
        //borrar usuarios
        public function borrar_actividad($id)
		{
		    $query = "DELETE FROM actividad WHERE id_actividades = '$id'";
		    $sql = $this->conexion->query($query);
		if ($sql==true) {
			echo"<script> alert('Se borraron los datos con exito'); window.location='/GestionThi/gestionthipoo/Lista_actividades.php'</script> ";
		}else{
			echo"<script> alert('Fallo al borrar datos'); </script>";
		    }
		}

        // Saca datos de una sola fila filtrado por id
		public function mostrarFilaPorId($id)
		{
		    $query = "SELECT * FROM actividades WHERE id_actividades = '$id'";
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
		
		{   $id_a = $this->conexion->real_escape_string($_POST['id_actividades']);
            $nombre = $this->conexion->real_escape_string($_POST['nombre']);
			$identificador = $this->conexion->real_escape_string($_POST['identificador']);
            $descrip = $this->conexion->real_escape_string($_POST['descrip']);
            $horas = $this->conexion->real_escape_string($_POST['horas']);
		    $color = $this->conexion->real_escape_string($_POST['color']);
		if (!empty($id_a) && !empty($postData)) {
			
			$query = "UPDATE actividades SET nombre = '$nombre', identificador = '$identificador', descripcion = '$descrip', horas_dedicadas = '$horas', color_act = '$color' WHERE id_actividades = '$id_a'";
			$sql = $this->conexion->query($query);
			if ($sql==true) {
			    echo"<script> alert('Se actualizaron los datos con exito'); window.location='/GestionThi/gestionthipoo/Lista_actividades.php'</script> ";
			}else{
			    echo"<script> alert('Fallo al actualizar datos');window.location='/GestionThi/gestionthipoo/Lista_actividades.php'</script>  </script>";
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