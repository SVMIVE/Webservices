<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Banco extends REST_Controller {
	
	public $estatus = true;
	
	public function __construct() {
		parent::__construct(); //Polimorfismo
		
		$this->load->database(); //Establece la conexión con Sysbase		
	}
	
	function consultar_get( $id = 0){
		$sql = "SELECT id_banco,des_banco,activo,ds_corta,cd_usuario 
				FROM admin_bancos 
				WHERE id_banco='$id'";
		$data = $this->db->query( $sql )->result();
		$this->response($data, REST_Controller::HTTP_OK);
	}
	
	function listar_get(){
		
		$sql = "SELECT id_banco,des_banco,activo,ds_corta,cd_usuario 
				FROM admin_bancos 
				ORDER BY id_banco";
		$data = $this->db->query( $sql )->result();
		$this->response($data, REST_Controller::HTTP_OK);
	}
	
	/**
	 * Insertar Bancos en sybase
	 * 
	 * @param codigo string
	 * @activo boolean sybase: 1 true | 0: false
	 * @usuario string
	 */
	function insertar_post(){
		$input = $this->post();
		    
		$codigo     = $input["codigo"] ;
		$descripcion  = $input["descripcion"];
		$estatus     = $input["estatus"]; //1: verdadero 0: false
		$abreviatura   = $input["abreviatura"];
		$usuario = $input["usuario"];
			
		$sql = 'INSERT INTO dbo.admin_bancos (id_banco,des_banco,activo,ds_corta,cd_usuario) VALUES (\'' . $codigo . '\',
		\'' . $descripcion . '\',' . $estatus . ',\'' . $abreviatura . '\',\'' . $usuario . '\')';
		$this->db->query( $sql ); 
		
		$this->response(['Item created successfully.'], REST_Controller::HTTP_OK);
	}
}
