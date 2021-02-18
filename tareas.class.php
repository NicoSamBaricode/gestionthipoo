
<?php
include_once('DbConnection.php');
 
class Tarea_class extends conexionDb{

    public function __construct(){

        parent::__construct();
    }
   //contador general
    public function cont_t(){
        
        $contador_p = "SELECT COUNT(*) totalt FROM tareas";
        
        $queryp = $this->conexion->query($contador_p);

        if($queryp->num_rows > 0){
            $fila = $queryp->fetch_array();
            return $fila['totalt'];
        }
        else{
            return false;
        }
            
             
    }
    //contador de estados para graficos
    public function cont_t_estado($estado){
        
        $contador_estado = "SELECT COUNT(*) total FROM tareas WHERE estado= '$estado' ";
        
        $queryp_e = $this->conexion->query($contador_estado);

        if($queryp_e->num_rows > 0){
            $fila = $queryp_e->fetch_array();
            return $fila['total'];
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

    // mostrar datos de la tabla de tareas
    public function mostrarDatos()
		{
		    $query = "SELECT * FROM tareas";
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
		// mostrar datos de la tabla de tareas por id
		public function mostrarDatos_id($id)
		{
		    $query = "SELECT * FROM tareas WHERE id_proyectos = '$id'";
		    $result = $this->conexion->query($query);
		if ($result->num_rows > 0) {
		    $data = array();
		    while ($row = $result->fetch_assoc()) {
		           $data[] = $row;
		    }
			 return $data;
		    }else{
			 echo "Base de datos vacia";
			 return array();
		    }
		}
		// mostrar datos relacion proyectos y tareas(join inner)
		public function mostrarDatos_join($id)
		{
		    $query = "SELECT * FROM tareas WHERE id_proyectos = '$id'";
		    $result = $this->conexion->query($query);
		if ($result->num_rows > 0) {
		    $data = array();
		    while ($row = $result->fetch_assoc()) {
		           $data[] = $row;
		    }
			 return $data;
		    }else{
			 echo "Base de datos vacia";
			 return array();
		    }
		}

    // Insertar datos a la tabla de tareas
		public function insertarDatos($post)
		{
			$nombre = $this->conexion->real_escape_string($_POST['nombre']);
			$fecha_i = $this->conexion->real_escape_string($_POST['fecha']);
			
			
            $descrip = $this->conexion->real_escape_string($_POST['descrip']);
           
            $resp = $this->conexion->real_escape_string($_POST['resp']);
            $fecha_r = $this->conexion->real_escape_string($_POST['frealizado']);
			
            $estado = $this->conexion->real_escape_string($_POST['estado']);
			$id_proy = $this->conexion->real_escape_string($_POST['proy']);
            $query="INSERT INTO tareas(nombre,descripcion,responsable,f_inicio,f_final,estado,id_proyectos) 
            VALUES ('$nombre','$descrip','$resp','$fecha_i','$fecha_r','$estado','$id_proy')";
			$sql = $this->conexion->query($query);
			if ($sql==true) {
			    echo"<script> alert('Se creo la tarea con exito'); window.location='/test/Lista_Tareas.php'</script> ";
			}else{
			    echo"<script> alert('Fallo al insertar datos'); </script>";
			}
            
		}
        //borrar tarea
        public function borrar_tarea($id)
		{
		    $query = "DELETE FROM tareas WHERE id_tareas = '$id'";
		    $sql = $this->conexion->query($query);
		if ($sql==true) {
			echo"<script> alert('Se borraron los datos con exito'); window.location='/test/Lista_Tareas.php'</script> ";
		}else{
			echo"<script> alert('Fallo al borrar datos'); </script>";
		    }
		}

        // Saca datos de una sola fila filtrado por id
		public function mostrarFilaPorId($id)
		{
		    $query = "SELECT * FROM tareas WHERE id_tareas = '$id'";
		    $result = $this->conexion->query($query);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			return $row;
		    }else{
                echo"<script> alert('No se encontro el registro'); </script>";
				return array();
		    }
		}

		// actualiza datos en la tabla
		public function actualizarFila($postData)
		
		{   $id_p = $this->conexion->real_escape_string($_POST['id_proyectos']);
            $nombre = $this->conexion->real_escape_string($_POST['nombre']);
			$fecha_i = $this->conexion->real_escape_string($_POST['fecha']);
			$identificador = $this->conexion->real_escape_string($_POST['identificador']);
			$tema = $this->conexion->real_escape_string($_POST['tema']);
            $descrip = $this->conexion->real_escape_string($_POST['descrip']);
            $sector = $this->conexion->real_escape_string($_POST['sector']);
            $resp = $this->conexion->real_escape_string($_POST['resp']);
            $fecha_r = $this->conexion->real_escape_string($_POST['frealizado']);
			$obs = $this->conexion->real_escape_string($_POST['obs']);
            $estado = $this->conexion->real_escape_string($_POST['estado']);
			
		    
		if (!empty($id_p) && !empty($postData)) {
			
			$query = "UPDATE proyectos SET nombre = '$nombre', identificador = '$identificador', id_proyectos = '$id_p',
             fecha_inicio = '$fecha_i', tema = '$tema', descripcion = '$descrip', sector = '$sector', responsable = '$resp', fecha_realizado = '$fecha_r'
             , observaciones = '$obs', estado = '$estado' WHERE id_proyectos = '$id_p'";
			$sql = $this->conexion->query($query);
			if ($sql==true) {
			    echo"<script> alert('Se actualizaron los datos con exito'); window.location='/test/Lista_Proyectos.php'</script> ";
			}else{
			    echo"<script> alert('Fallo al actualizar datos');window.location='/test/Lista_Proyectos.php'</script>  </script>";
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


}