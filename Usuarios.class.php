<?php
include_once('DbConnection.php');
 
class Usuario extends conexionDb{

    public function __construct(){

        parent::__construct();
    }
    
    public function check_login($usuario, $pasword){

        $sql = "SELECT * FROM usuarios WHERE alias = '$usuario' AND pasword = '$pasword'";
        $query = $this->conexion->query($sql);

        if($query->num_rows > 0){
            $row = $query->fetch_array();
            return $row['id_usuario'];
        }
        else{
            return false;
        }
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
// contador de usuarios
    public function cont_u(){
        
        $contador_u = "SELECT COUNT(*) total FROM usuarios";
        
        $query2 = $this->conexion->query($contador_u);

        if($query2->num_rows > 0){
            $fila = $query2->fetch_array();
            return $fila['total'];
        }
        else{
            return false;
        }
            
             
    }
    // mostrar datos de la tabla de usuarios
    public function mostrarDatos()
		{
		    $query = "SELECT * FROM usuarios";
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

    // Insertar datos a la tabla de usuarios
		public function insertarDatos($post)
		{
			$nombre = $this->conexion->real_escape_string($_POST['nombre']);
			$apellido = $this->conexion->real_escape_string($_POST['apellido']);
			$contr = $this->conexion->real_escape_string($_POST['pasword']);
			$alias = $this->conexion->real_escape_string($_POST['alias']);
            $mail = $this->conexion->real_escape_string($_POST['mail']);
			$sector = $this->conexion->real_escape_string($_POST['sector']);
            $rol = $this->conexion->real_escape_string($_POST['rol']);
			$query="INSERT INTO usuarios(nombre,apellido,mail,alias,rol,sector_id,pasword) VALUES ('$nombre','$apellido','$mail','$alias','$rol','$sector','$contr')";
			$sql = $this->conexion->query($query);
			if ($sql==true) {
			    echo"<script> alert('Se insertaron los datos con exito'); window.location='/GestionThi/gestionthipoo/Lista_Usuarios.php'</script> ";
			}else{
			    echo"<script> alert('Fallo al insertar datos'); </script>";
			}
            
		}
        //borrar usuarios
        public function borrar_usuario($id)
		{
		    $query = "DELETE FROM usuarios WHERE id_usuario = '$id'";
		    $sql = $this->conexion->query($query);
		if ($sql==true) {
			echo"<script> alert('Se borraron los datos con exito'); window.location='/GestionThi/gestionthipoo/Lista_Usuarios.php'</script> ";
		}else{
			echo"<script> alert('Fallo al borrar datos'); </script>";
		    }
		}
        // Saca datos de una sola fila filtrado por id
		public function mostrarFilaPorId($id)
		{
		    $query = "SELECT * FROM usuarios WHERE id_usuario = '$id'";
		    $result = $this->conexion->query($query);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			return $row;
		    }else{
                echo"<script> alert('No se encontro el registro de usuario'); </script>";
		    }
		}

		// actualiza datos en la tabla
		public function actualizarFila($postData)
		
		{   $id = $this->conexion->real_escape_string($_POST['id_usuario']);
			$nombre = $this->conexion->real_escape_string($_POST['nombre']);
			$apellido = $this->conexion->real_escape_string($_POST['apellido']);
			$contr = $this->conexion->real_escape_string($_POST['pasword']);
			$alias = $this->conexion->real_escape_string($_POST['alias']);
            $mail = $this->conexion->real_escape_string($_POST['mail']);
            $rol = $this->conexion->real_escape_string($_POST['rol']);
			
		    
		if (!empty($id) && !empty($postData)) {
			
			$query = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', mail = '$mail', alias = '$alias', rol = '$rol', pasword = '$contr' WHERE id_usuario = '$id'";
			$sql = $this->conexion->query($query);
			if ($sql==true) {
			    echo"<script> alert('Se actualizaron los datos con exito'); window.location='/GestionThi/gestionthipoo/Lista_Usuarios.php'</script> ";
			}else{
			    echo"<script> alert('Fallo al actualizar datos');window.location='/GestionThi/gestionthipoo/Lista_Usuarios.php'</script>  </script>";
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