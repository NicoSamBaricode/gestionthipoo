
<?php
include_once('DbConnection.php');

class Dedicacion_class extends conexionDb
{

	public function __construct()
	{

		parent::__construct();
	}


	public function detalle($sql)
	{

		$query = $this->conexion->query($sql);

		$row = $query->fetch_array();

		return $row;
	}
	// cast
	public function escape_string($value)
	{

		return $this->conexion->real_escape_string($value);
	}

	// mostrar datos de la tabla de dedicacion
	public function mostrarDatos()
	{
		$query = "SELECT * FROM dedicacion";
		$result = $this->conexion->query($query);
		if ($result->num_rows > 0) {
			$data = array();
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		} else {
			echo "Base de datos vacia";
		}
	}
	// mostrar datos de la tabla de dedicacion por id
	public function mostrarDatos_id($id)
	{
		$query = "SELECT * FROM dedicacion WHERE id_dedicacion = '$id'";
		$result = $this->conexion->query($query);
		if ($result->num_rows > 0) {
			$data = array();
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		} else {
			echo "Base de datos vacia";
			return array();
		}
	}
	// mostrar datos relacion agente y dedicacion(join inner)
	public function mostrarDatos_join($id)
	{
		$query = "SELECT * FROM dedicacion WHERE id_agente = '$id'";
		$result = $this->conexion->query($query);
		if ($result->num_rows > 0) {
			$data = array();
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		} else {
			echo "Base de datos vacia";
			return array();
		}
	}

	// Insertar datos a la tabla de dedicacion
	public function insertarDatos($post)
	{

		$id_agente = $this->conexion->real_escape_string($_POST['id_agente']);
		$mes = $this->conexion->real_escape_string($_POST['mes']);
		$anio = $this->conexion->real_escape_string($_POST['anio']);
		$horas = $this->conexion->real_escape_string($_POST['horas']);
		$imputacion = $this->conexion->real_escape_string($_POST['imputacion']);
		$obs = $this->conexion->real_escape_string($_POST['obs']);
		//$timeStamp = $this->conexion->real_escape_string($_POST['tiempo']);

		$query = "INSERT INTO dedicacion(id_agente,mes,anio,horas,imputacion,obs) 
            VALUES ('$id_agente','$mes','$anio','$horas','$imputacion','$obs')";
		$sql = $this->conexion->query($query);
		if ($sql == true) {
			echo "<script> window.location='/GestionThi/gestionthipoo/crear_dedicacion.php'</script> ";
		} else {
			echo "<script> alert('Fallo al insertar datos'); </script>";
		}
	}
	//borrar tarea
	public function borrar_dedic($id)
	{
		$query = "DELETE FROM dedicacion WHERE id_dedicacion = '$id'";
		$sql = $this->conexion->query($query);
		if ($sql == true) {
			echo "<script> alert('Se borraron los datos con exito'); window.location='/GestionThi/gestionthipoo/Lista_dedicacion.php'</script> ";
		} else {
			echo "<script> alert('Fallo al borrar datos'); </script>";
		}
	}

	// Saca datos de una sola fila filtrado por id
	public function mostrarFilaPorId($id)
	{
		$query = "SELECT * FROM dedicacion WHERE id_dedicacion = '$id'";
		$result = $this->conexion->query($query);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();

			return $row;
		} else {
			echo "<script> alert('No se encontro el registro'); </script>";
			return array();
		}
	}

	// actualiza datos en la tabla
	public function actualizarFilaD($postData)

	{
		$id_d = $this->conexion->real_escape_string($_POST['id_dedicacion']);
		$relevadas = $this->conexion->real_escape_string($_POST['horasR']);

		if (!empty($id_d) && !empty($postData)) {

			$query = "UPDATE dedicacion SET horas_relevadas = '$relevadas' WHERE id_dedicacion = '$id_d'";
			$sql = $this->conexion->query($query);
			if ($sql == true) {
				echo "<script> alert('Se actualizo la dedicacion con exito'); window.location='/GestionThi/gestionthipoo/Lista_dedicacion.php'</script> ";
			} else {
				echo "<script> alert('Fallo al actualizar datos');window.location='/GestionThi/gestionthipoo/Lista_dedicacion.php'</script>  </script>";
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
		} else {

			echo "No se encontraron datos";

			return array();
		}
	}

	public function contadorPorAgenteMesAnio($agente, $mes, $anio)
	{

		$suma = "SELECT SUM(horas)total
		FROM dedicacion
		WHERE id_agente =$agente AND mes=$mes
		and anio=$anio;";
        
		$queryp_e = $this->conexion->query($suma);
        
		if ($queryp_e->num_rows > 0) {
			$fila = $queryp_e->fetch_array();
			
			return $fila['total'];
		} else {
			return false;
		}
	}

	public function contadorHorasPorProyecto($id_proyecto){
		$query = "SELECT SUM(horas)total
		FROM dedicacion
		WHERE imputacion =$id_proyecto;";
		$queryp_e = $this->conexion->query($query);
		if ($queryp_e->num_rows > 0) {
			$fila = $queryp_e->fetch_array();
			return $fila['total'];
		} else {
			return false;
		}

	}
}
