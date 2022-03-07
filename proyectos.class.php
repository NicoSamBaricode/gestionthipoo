
<?php
include_once('DbConnection.php');

class Proyecto_class extends conexionDb
{
	//SI TIPO = 1 es proyecto, si es 0 es una actividad
	public function __construct()
	{

		parent::__construct();
	}
	//contador general
	public function cont_p()
	{

		$contador_p = "SELECT COUNT(*) totalp FROM proyectos where tipo = '1'";

		$queryp = $this->conexion->query($contador_p);

		if ($queryp->num_rows > 0) {
			$fila = $queryp->fetch_array();
			return $fila['totalp'];
		} else {
			return false;
		}
	}
	public function contadorPorColumna($condicion, $columna)
	{

		$contador = "SELECT COUNT(*) total FROM proyectos WHERE '$columna' = '$condicion' ";

		$queryp = $this->conexion->query($contador);

		if ($queryp->num_rows > 0) {
			$fila = $queryp->fetch_array();
			return $fila['total'];
		} else {
			return false;
		}
	}
	//contador de estados para graficos
	public function cont_p_estado($estado)
	{

		$contador_estado = "SELECT COUNT(*) total FROM proyectos WHERE estado= '$estado' ";

		$queryp_e = $this->conexion->query($contador_estado);

		if ($queryp_e->num_rows > 0) {
			$fila = $queryp_e->fetch_array();
			return $fila['total'];
		} else {
			return false;
		}
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

	// mostrar datos de la tabla de proyectos
	public function mostrarDatos($tipo)
	{
		$query = "SELECT * FROM proyectos where tipo='$tipo'";
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

	// Insertar datos a la tabla de proyectos
	public function insertarDatos($post, $tipo)
	{
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
		$tipo = $this->conexion->real_escape_string($tipo);
		$horas = $this->conexion->real_escape_string($_POST['horas']);
		//busco que no exista el identificador
		$queryident = "SELECT identificador FROM proyectos WHERE identificador=$identificador ";
		$result = $this->conexion->query($queryident);
		if ($result->num_rows > 0) {

			echo "<script> alert('El identificador ingresado ya existe, por favor ingrese uno diferente.'); window.location='/GestionThi/gestionthipoo/crear_proyecto.php'</script> ";
		} else {
			if ($tipo == 1) {
				$query = "INSERT INTO proyectos(identificador,nombre,fecha_inicio,tema,descripcion,sector,responsable,fecha_realizado,observaciones,estado,Tipo,horas_dedicadas) 
						 VALUES ('$identificador','$nombre','$fecha_i','$tema','$descrip','$sector','$resp','$fecha_r','$obs','$estado','$tipo','$horas')";
				$sql = $this->conexion->query($query);
				if ($sql == true) {
					echo "<script> alert('Se creo el proyecto con exito'); window.location='/GestionThi/gestionthipoo/Lista_proyectos.php'</script> ";
				} else {
					echo "<script> alert('Fallo al insertar datos'); </script>";
				}
			}
			if ($tipo == 0) {
				$query = "INSERT INTO proyectos(identificador,nombre,descripcion,Tipo,horas_dedicadas) 
						 VALUES ('$identificador','$nombre','$descrip','$tipo','$horas')";
				$sql = $this->conexion->query($query);
				if ($sql == true) {
					echo "<script> alert('Se creo la Actividad con exito'); window.location='/GestionThi/gestionthipoo/Lista_actividades.php'</script> ";
				} else {
					echo "<script> alert('Fallo al insertar datos'); </script>";
				}
			}
		}
	}
	//borrar usuarios
	public function borrar_proyecto($id)
	{
		$query = "DELETE FROM proyectos WHERE id_proyectos = '$id'";
		$sql = $this->conexion->query($query);
		if ($sql == true) {
			echo "<script> alert('Se borraron los datos con exito'); window.location='/test/Lista_Proyectos.php'</script> ";
		} else {
			echo "<script> alert('Fallo al borrar datos'); </script>";
		}
	}

	// Saca datos de una sola fila filtrado por id
	public function mostrarFilaPorId($id, $tipo)
	{
		if ($tipo == 2) {
			$query = "SELECT * FROM proyectos WHERE id_proyectos = '$id'";
		} else {
			$query = "SELECT * FROM proyectos WHERE id_proyectos = '$id' and tipo = '$tipo'";
		}

		$result = $this->conexion->query($query);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			return $row;
		} else {
			echo "<script> alert('No se encontro el registro'); </script>";
		}
	}

	// actualiza datos en la tabla
	public function actualizarFila($postData, $tipo)

	{
		if ($tipo == 1) {
			$id_p = $this->conexion->real_escape_string($_POST['id_proyectos']);
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
			$horas = $this->conexion->real_escape_string($_POST['horas']);
		}
		if ($tipo == 0) {
			$id_a = $this->conexion->real_escape_string($_POST['id_actividades']);
			$nombre = $this->conexion->real_escape_string($_POST['nombre']);
			$identificador = $this->conexion->real_escape_string($_POST['identificador']);
			$descrip = $this->conexion->real_escape_string($_POST['descrip']);
			$horas = $this->conexion->real_escape_string($_POST['horas']);
			$color = $this->conexion->real_escape_string($_POST['color']);
		}


		if (!empty($id_p) && !empty($postData)) {
			if ($tipo == 1) {
				$query = "UPDATE proyectos SET nombre = '$nombre', identificador = '$identificador', id_proyectos = '$id_p',
             fecha_inicio = '$fecha_i', tema = '$tema', descripcion = '$descrip', sector = '$sector', responsable = '$resp', fecha_realizado = '$fecha_r'
             , observaciones = '$obs', estado = '$estado' WHERE id_proyectos = '$id_p'";
			}
			if ($tipo == 0) {
				$query = "UPDATE proyectos SET nombre = '$nombre', identificador = '$identificador', descripcion = '$descrip', horas_dedicadas = '$horas', color_act = '$color' WHERE id_proyectos = '$id_a'";
			}
			$sql = $this->conexion->query($query);
			if ($sql == true) {
				echo "<script> alert('Se actualizaron los datos con exito'); window.location='/test/Lista_Proyectos.php'</script> ";
			} else {
				echo "<script> alert('Fallo al actualizar datos');window.location='/test/Lista_Proyectos.php'</script>  </script>";
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
	public function buscarIdRepetido($identificador)
	{
		$query = "SELECT identificador FROM proyectos WHERE identificador=$identificador ";
		$result = $this->conexion->query($query);

		if ($result->num_rows > 0) {
			echo " Identificador no disponible";
			//echo"<script> alert('El identificador ingresado ya existe, por favor ingrese uno diferente.'); window.location='/test/crear_proyecto.php'</script> ";
			return true;
		} else {


			return false;
		}
	}
}
