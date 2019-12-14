<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Concepto extends REST_Controller {
	
	public $estatus = true;
	
	public function __construct() {
		parent::__construct(); //Polimorfismo
		
		$this->load->database(); //Establece la conexión con Sysbase		
	}	
	function listar_get(){
				
		$sql = "SELECT top 20 cd_concepto,nb_concepto,nu_porcentaje,mn_monto,cd_cuenta,in_iva,in_dcto,activo,cd_servicio,tp_cambio,codigo_old,pc_iva,cd_usuario,mn_monto_bf,tp_cambio_bf,mn_ut,tipo,mn_monto_s,tp_cambio_s 
				FROM admin_conceptos";
		$data = $this->db->query( $sql )->result();
		
		$this->response($data, REST_Controller::HTTP_OK);
	}
	function consultar_post(){
		
		$input = $this->post();
		$servicio = $input["servicio"];
		
		$sql = "SELECT cd_concepto,nb_concepto,nu_porcentaje,mn_monto,cd_cuenta,in_iva,in_dcto,activo,cd_servicio,tp_cambio,codigo_old,pc_iva,cd_usuario,mn_monto_bf,tp_cambio_bf,mn_ut,tipo,mn_monto_s,tp_cambio_s 
				FROM admin_conceptos
				WHERE cd_servicio ='$servicio' AND activo=1";
		$data = $this->db->query( $sql )->result();

		$this->response($data, REST_Controller::HTTP_OK);	
	}
	/*
	** Insertar Conceptos 
	*/
	function insertar_post(){
		$input = $this->post();
		    
		$cd_concepto     = $input["cd_concepto"] ;
		$nb_concepto     = $input["nb_concepto"];
		$nu_porcentaje   = $input["nu_porcentaje"];
		$mn_monto        = $input["mn_monto"];
		$cd_cuenta       = $input["cd_cuenta"];
		$in_iva          = $input["in_iva"];
		$in_dcto         = $input["in_dcto"];
		$activo          = $input["activo"] ;
		$cd_servicio     = $input["cd_servicio"];
		$tp_cambio       = $input["tp_cambio"];
		$codigo_old      = $input["codigo_old"];
		$pc_iva          = $input["pc_iva"];
		$cd_usuario      = $input["cd_usuario"];
		$mn_monto_bf     = $input["mn_monto_bf"];
		$tp_cambio_bf    = $input["tp_cambio_bf"] ;
		$mn_ut           = $input["mn_ut"];
		$tipo            = $input["tipo"];
		$mn_monto_s      = $input["mn_monto_s"];
		$tp_cambio_s     = $input["tp_cambio_s"];			
			
		$sql = 'INSERT INTO dbo.admin_conceptos (cd_concepto,nb_concepto,nu_porcentaje,mn_monto,cd_cuenta,in_iva,in_dcto,activo,cd_servicio,tp_cambio,codigo_old,pc_iva,cd_usuario,mn_monto_bf,tp_cambio_bf,mn_ut,tipo,mn_monto_s,tp_cambio_s) 
		        VALUES (
		        \''.$cd_concepto.'\',\''.$nb_concepto.'\','.$nu_porcentaje.', '.$mn_monto.',\''.$cd_cuenta.'\','.$in_iva.','.$in_dcto.','.$activo.',\''.$cd_servicio.'\',\''.$tp_cambio.'\',\''.$codigo_old.'\','.$pc_iva.',\''.$cd_usuario.'\','.$mn_monto_bf.',\''.$tp_cambio_bf.'\','.$mn_ut.',\''.$tipo.'\','.$mn_monto_s.',\''.$tp_cambio_s.'\')';
		$this->db->query( $sql ); 
		
		$this->response(['Item created successfully.'], REST_Controller::HTTP_OK);
	}
}
