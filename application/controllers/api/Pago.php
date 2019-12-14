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
	 */
	function insertar_post(){
		$input = $this->post();
		    
		$nu_pago              = $input["nu_pago"] ;
		$fe_pago              = $input["fe_pago"];
		$cd_cliente           = $input["cd_cliente"];
		$mn_pago              = $input["mn_pago"];
		$mn_retencion         = $input["mn_retencion"];
		$cd_usuario           = $input["cd_usuario"] ;
		$fe_anula             = $input["fe_anula"];
		$cd_usuario_anula     = $input["cd_usuario_anula"]; 
		$mn_iva               = $input["mn_iva"];
		$pc_iva               = $input["pc_iva"];
		$mn_facturado         = $input["mn_facturado"] ;
		$pc_retencion         = $input["pc_retencion"];
		$mn_sumdet            = $input["mn_sumdet"]; 
		$st_pago              = $input["st_pago"];
		$ds_observaciones     = $input["ds_observaciones"];
		$st_reversa           = $input["st_reversa"];
		$mn_facturado_bf      = $input["mn_facturado_bf"]; 
		$mn_iva_bf            = $input["mn_iva_bf"];
		$mn_pago_bf           = $input["mn_pago_bf"];
		$mn_retencion_bf      = $input["mn_retencion_bf"];
		$mn_sumdet_bf         = $input["mn_sumdet_bf"];
		$oficina              = $input["oficina"];
		$mn_pago_dol          = $input["mn_pago_dol"]; 
		$moneda               = $input["moneda"];		
		$fe_pago_servidor     = $input["fe_pago_servidor"];
		$mn_pago_s            = $input["mn_pago_s"];		
		$mn_iva_s             = $input["mn_iva_s"];
		$pc_retencion_s       = $input["pc_retencion_s"];
		$mn_sumdet_s          = $input["mn_sumdet_s"];
		$mn_facturado_s       = $input["mn_facturado_s"];
	
		$sql = 'INSERT INTO dbo.admin_pagos (nu_pago,fe_pago,cd_cliente,mn_pago,mn_retencion,cd_usuario,fe_anula,cd_usuario_anula,mn_iva,pc_iva,mn_facturado,pc_retencion,mn_sumdet,
											st_pago,ds_observaciones,st_reversa,mn_facturado_bf,mn_iva_bf,mn_pago_bf,mn_retencion_bf,mn_sumdet_bf,mn_pago_dol,moneda,fe_pago_servidor, 
											mn_pago_s,mn_iva_s,pc_retencion_s,mn_sumdet_s,mn_facturado_s)   
				VALUES(  ' . $nu_pago . '         , \'' . $fe_pago . '\',' . $cd_cliente . ',  ' . $mn_pago . ', ' . $mn_retencion . ' \'' . $cd_usuario . '\', \'' . $fe_anula . '\',
				         ' . $cd_usuario_anula . ', ' . $mn_iva . ', \'' . $pc_iva . '\', ' . $mn_facturado . ', \'' . $pc_retencion . '\', ' . $mn_sumdet . ', \'' . $st_pago . '\',
				       \'' . $ds_observaciones . '\' ,\'' . $st_reversa . '\', ' . $mn_facturado_bf . ', ' . $mn_iva_bf . ', ' . $mn_pago_bf . ', ' . $mn_retencion_bf . ', ' . $mn_sumdet_bf . ',
				       \'' . $oficina . '\',' . $mn_pago_dol . ', \'' . $moneda . '\', \'' . $fe_pago_servidor . '\', ' . $mn_pago_s . ', ' . $mn_iva_s . ', ' . $pc_retencion_s . ', 
				       ' . $mn_sumdet_s . ', ' . $mn_facturado_s . ' )';
		$this->db->query( $sql ); 
		
		$this->response(['Item created successfully.'], REST_Controller::HTTP_OK);
	}
	
	/*{
		"nu_pago":"273727",
		"fe_pago":"2018-10-16 10:55:51.873",
		"cd_cliente":"10527",
		"mn_pago":NULL,
		"mn_retencion":NULL,
		"cd_usuario":"TAQUILLAE",
		"fe_anula":NULL,
		"cd_usuario_anula":NULL,
		"mn_iva":NULL,
		"pc_iva":NULL,
		"mn_facturado":NULL,
		"pc_retencion":NULL,
		"mn_sumdet":NULL,
		"st_pago":1,
		"ds_observaciones":NULL,
		"st_reversa":0,
		"mn_facturado_bf":NULL,
		"mn_iva_bf":NULL,
		"mn_pago_bf":47.82,
		"mn_retencion_bf":NULL,
		"mn_sumdet_bf":NULL,
		"oficina":"3",
		"mn_pago_dol":NULL,
		"moneda":"B",
		"fe_pago_servidor":NULL,
		"mn_pago_s":NULL,
		"mn_iva_s":NULL,
		"pc_retencion_s":NULL,
		"mn_sumdet_s":NULL,
		"mn_facturado_s":NULL
	}*/


}
