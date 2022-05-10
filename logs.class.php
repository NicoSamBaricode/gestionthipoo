
<?php
include_once('DbConnection.php');

class log_class extends conexionDb
{

	public function __construct()
	{

		parent::__construct();
	}


	public function escape_string($value)
	{

		return $this->conexion->real_escape_string($value);
	}


	// Insertar datos a la tabla de logs
	public function insertarLog($var1, $mensaje)
	{
		// $usuario = $this->conexion->real_escape_string($var1);
		// $accion = $this->conexion->real_escape_string($mensaje);
		$usuario=$var1;
		$accion=$mensaje;


		$query = "INSERT INTO logs (Usuario,Accion) 
           							 VALUES ('$usuario','$accion')";
		$sql = $this->conexion->query($query);
		if ($sql == true) {
			
		} else {
			echo "<script> console.log('error al guardar log'); </script>";
		}
	}

	 // mostrar datos de la tabla de logs
	 public function mostrarDatos()
	 {
		 $query = "SELECT usuarios.alias, Accion,TimeStamp FROM `logs` LEFT JOIN usuarios on Usuario=id_usuario order by TimeStamp desc";
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
	
}
