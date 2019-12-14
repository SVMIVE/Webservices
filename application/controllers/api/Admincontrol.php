<?php
  
require APPPATH . 'libraries/REST_Controller.php';
     
class AdminControl extends REST_Controller {
	
	public $estatus = true;
	
	public function __construct() {
		parent::__construct(); //Polimorfismo
		
		$this->load->database(); //Establece la conexión con Sysbase		
	}
	function listar_get(){
		
		$sql = "SELECT pc_iva,ta_dollar,fecha_aplica_dol,mn_petro,fecha_aplica_ptr,mn_euro,fecha_aplica_eur 
			    FROM view_dashboard";
		$data = $this->db->query( $sql )->result();
		$this->response($data, REST_Controller::HTTP_OK);
	}
		

}
