<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Actividad extends REST_Controller {
	
	public $estatus = true;
	
	public function __construct() {
		parent::__construct(); //Polimorfismo
		
		$this->load->database(); //Establece la conexión con Sysbase		
	}
	
	function listar_get(){
				
		$sql = "SELECT codigo,actividad,convenio,moneda,a_est_var,min_a_est_var 
				FROM admin_actividad";
		$data = $this->db->query( $sql )->result();
		
		$this->response($data, REST_Controller::HTTP_OK);
	}
	/**
	 * Insertar Actividades en sybase
	 */
	function insertar_post(){
		$input = $this->post();
		    
		$codigo        = $input["codigo"] ;
		$actividad     = $input["actividad"];
		$convenio      = $input["convenio"];
		$moneda        = $input["moneda"];
		$a_est_var     = $input["a_est_var"];
		$min_a_est_var = $input["min_a_est_var"];		
			
		$sql = 'INSERT INTO dbo.admin_actividad (codigo,actividad,convenio,moneda,a_est_var,min_a_est_var) VALUES (\'' . $codigo . '\',
		\'' . $actividad . '\',' . $convenio . ',\'' . $moneda . '\',\'' . $a_est_var . ',\'' . $min_a_est_var . '\')';
		$this->db->query( $sql ); 
		
		$this->response(['Item created successfully.'], REST_Controller::HTTP_OK);
	}
	/**
	* Editar Actividades en sybase
	*/
	function editar_post(){
		$input = $this->post();
		    
		$codigo        = $input["codigo"] ;
		$actividad     = $input["actividad"];
		$convenio      = $input["convenio"];
		$moneda        = $input["moneda"];
		$a_est_var     = $input["a_est_var"];
		$min_a_est_var = $input["min_a_est_var"];		
			
		$sql = 'INSERT INTO dbo.admin_actividad (codigo,actividad,convenio,moneda,a_est_var,min_a_est_var) VALUES (\'' . $codigo . '\',
		\'' . $actividad . '\',' . $convenio . ',\'' . $moneda . '\',\'' . $a_est_var . ',\'' . $min_a_est_var . '\')';
		$this->db->query( $sql ); 
		
		$this->response(['Item created successfully.'], REST_Controller::HTTP_OK);
	}
	//UPDATE dbo.admin_bancos SET des_banco='NO APLICA',activo=1,ds_corta='NA',cd_usuario=NULL WHERE id_banco='000'
	
}
