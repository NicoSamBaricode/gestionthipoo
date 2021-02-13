
<?php
include_once('DbConnection.php');
 
class Proyecto_class extends conexionDb{

    public function __construct(){

        parent::__construct();
    }
   //contador general
    public function cont_p(){
        
        $contador_p = "SELECT COUNT(*) totalp FROM proyectos";
        
        $queryp = $this->conexion->query($contador_p);

        if($queryp->num_rows > 0){
            $fila = $queryp->fetch_array();
            return $fila['totalp'];
        }
        else{
            return false;
        }
            
             
    }
    //contador de estados para graficos
    public function cont_p_estado($estado){
        
        $contador_estado = "SELECT COUNT(*) total FROM proyectos WHERE estado= '$estado' ";
        
        $queryp_e = $this->conexion->query($contador_estado);

        if($queryp_e->num_rows > 0){
            $fila = $queryp_e->fetch_array();
            return $fila['total'];
        }
        else{
            return false;
        }
            
             
    }
}