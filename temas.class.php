
<?php

include_once('DbConnection.php');

class Temas_class extends conexionDb
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
		$query = "SELECT * FROM temas order by nombre";
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
	// mostrar datos de la tabla de temas por id
	public function mostrarDatos_id($id)
	{
		$query = "SELECT * FROM temas WHERE id_tema = '$id'";
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


		$nombre = $this->conexion->real_escape_string($_POST['nombre']);


		$query = "INSERT INTO temas(nombre) 
            VALUES ('$nombre')";
		$sql = $this->conexion->query($query);
		if ($sql == true) {

			echo "<script>  window.location='/GestionThi/gestionthipoo/crear_tema.php'</script> ";
		} else {
			echo "<script> alert('Fallo al insertar datos'); </script>";
		}
	}
	//borrar tarea
	public function borrar_tema($id)
	{
		$query = "DELETE FROM temas WHERE id_tema = '$id'";
		$sql = $this->conexion->query($query);
		if ($sql == true) {
			echo "<script> confirmBorrar();alert('Se borraron los datos con exito'); window.location='/GestionThi/gestionthipoo/crear_tema.php'</script> ";
		} else {
			echo "<script> alert('Fallo al borrar datos'); </script>";
		}
	}

	// Saca datos de una sola fila filtrado por id
	public function mostrarFilaPorId($id)
	{
		$query = "SELECT * FROM temas WHERE id_tema = '$id'";
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
	public function actualizarFila($postData)

	{
		$id = $this->conexion->real_escape_string($_POST['id_tema']);
		$nombre = $this->conexion->real_escape_string($_POST['nombre']);

		if (!empty($id) && !empty($postData)) {

			$query = "UPDATE temas SET nombre = '$nombre' WHERE id_tema = '$id'";

			$sql = $this->conexion->query($query);
			if ($sql == true) {
				echo "<script> alert('Se actualizo el tema con exito'); window.location='/GestionThi/gestionthipoo/crear_tema.php'</script> ";
			} else {
				echo "<script> alert('Fallo al actualizar datos');window.location='/GestionThi/gestionthipoo/crear_tema.php'</script>  </script>";
			}
		}
	}
}
