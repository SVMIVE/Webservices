<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Servicio extends REST_Controller {
	
	public $estatus = true;
	
	public function __construct() {
		parent::__construct(); //Polimorfismo
		
		$this->load->database(); //Establece la conexión con Sysbase		
	}
	
	function consultar_get( $cod = 0){
		$sql = "SELECT cd_servicio,nb_servicio
				FROM admin_servicios 
				WHERE cd_servicio='$cod'";
		$data = $this->db->query( $sql )->result();
		$this->response($data, REST_Controller::HTTP_OK);
	}
	function listar_get(){
		
		$sql ="SELECT cd_servicio,nb_servicio FROM admin_servicios";	
		$data = $this->db->query( $sql )->result();
		$this->response($data, REST_Controller::HTTP_OK);
	}
	
	/**
	 * Insertar Servicio en sybase
	 * 
	 * @param codigo string
	 * @activo boolean sybase: 1 true | 0: false
	 * @usuario string
	 */
	function insertar_post(){
		$input = $this->post();
		    
		$codigo        = $input["cd_servicio"] ;
		$nb_servicio   = $input["nb_servicio"];
			
		$sql = 'INSERT INTO dbo.admin_servicios (cd_servicio,nb_servicio) VALUES (\'' . $codigo . '\',
		\'' . $nb_servicio . '\')';
		$this->db->query( $sql ); 
		
		$this->response(['Item created successfully.'], REST_Controller::HTTP_OK);
	}
}
