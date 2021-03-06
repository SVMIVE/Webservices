<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Documento extends REST_Controller {
	
	public $estatus = true;
	
	public function __construct() {
		parent::__construct(); //Polimorfismo
		$this->load->model("MMapear","Mapear");
		$this->load->database(); //Establece la conexión con Sysbase		
	}
	/**
	 *Listar facturas por pagar Filtrado por cliente
	 */
	function lstdocactivos_get(){
	
		$sql = "SELECT top 200 admin_documentos.nu_documento,admin_documentos.fe_documento,admin_documentos.tp_documento,admin_documentos.nu_seniat,admin_documentos.cd_cliente,
					   admin_personas_juridicas.razon_social,admin_documentos.cd_servicio,admin_servicios.nb_servicio,admin_documentos.st_documento,admin_documentos.fe_desde,
					   admin_documentos.fe_hasta,admin_documentos.ds_observaciones,admin_documentos.pc_iva,admin_documentos.mn_documento_bf,admin_documentos.mn_iva_bf,
					   admin_documentos.baseimponible,admin_documentos.exentos,admin_documentos.oficina,admin_documentos.cd_usuario,admin_documentos.moneda,
					   admin_documentos.mn_documento_dol,admin_documentos.mn_iva_dol,admin_documentos.baseimponible_dol,admin_documentos.exentos_dol,admin_documentos.tasa_cambio,
					   admin_documentos.fecha_aplicacion,admin_documentos.tasa_cambio2,admin_documentos.aplica_cambio2,admin_documentos.fecha_aplicacion2,
					   admin_documentos.mn_documento_eur,admin_documentos.mn_iva_eur,admin_documentos.baseimponible_eur,admin_documentos.exentos_eur
				FROM ((admin_documentos LEFT JOIN admin_personas_juridicas ON admin_documentos.cd_cliente = admin_personas_juridicas.auxiliar_contable)
				LEFT JOIN admin_servicios ON admin_documentos.cd_servicio = admin_servicios.cd_servicio)
				INNER JOIN view_documentos ON admin_documentos.nu_documento = view_documentos.nu_documento
				WHERE (admin_documentos.st_documento='A' OR admin_documentos.st_documento='O') AND YEAR(admin_documentos.fe_documento)>2018 AND MONTH(admin_documentos.fe_documento)=11";				
								
		$data = $this->db->query( $sql )->result();
		$err = array(
			'data' => $data,
			'err' => $this->db->error()
		);
		
		$this->response($err, REST_Controller::HTTP_OK);
	}
	/**
	 *Listar facturas por pagar Filtrado por cliente
	 */
	function consultardocumento_get(){
		$nu_documento="C00016194";
		$sql = "SELECT * 
				FROM admin_documentos
				WHERE nu_documento='".$nu_documento."'";

		/*$sql = "
		DECLARE @corre_sal VARCHAR(10)
		EXEC  dbo.sp_serial_c @corre_sal output
		SELECT @corre_sal";*/
				
		$data = $this->db->query( $sql )->result();
		$this->response($data, REST_Controller::HTTP_OK);
	}
	/**
	 *Listar facturas por pagar Filtrado por cliente
	 */
	function consultardocumentodetalle_get(){
		$nu_documento="C00016194";
		$sql = "SELECT cd_concepto,nu_renglon,nu_cantidad,mn_monto,mn_iva,pc_descuento,mn_descuento,fe_detalle,nu_documento,tp_cambio,cd_cuenta,
					   cd_concepto_old,pc_iva,ds_concepto,mn_descuento_bf,mn_monto_bf,mn_iva_bf,tp_cambio_bf,exentos,NSujeto,NAplica,NS,moneda,mn_monto_dol,
					   mn_iva_dol,tasa_cambio,exentos_dol,aplica_cambio,fecha_aplicacion,mn_monto_s,mn_iva_s,exentos_s,tasa_cambio_s,mn_descuento_dol,mn_monto_eur,
					   mn_iva_eur,exentos_eur,tasa_cambio2,aplica_cambio2,fecha_aplicacion2,nu_documento_link
				FROM admin_detdocumentos
				WHERE nu_documento='".$nu_documento."'";
		$data = $this->db->query( $sql )->result();
		$this->response($data, REST_Controller::HTTP_OK);
	}	
	/**
	 *Listar facturas por pagar Filtrado por cliente
	 */
	function facturasclientestatus_get(){
		$st='A';
		$sql = "SELECT cd_cliente,nu_documento,fe_documento,tp_documento 
				FROM admin_documentos 
				WHERE st_documento='".$st."'";
		$data = $this->db->query( $sql )->result();
		$this->response($data, REST_Controller::HTTP_OK);
	}
	function listarfacturascliente_get(){
		
		$cd_cliente='9242';
		$st='A';
		$sql = "SELECT cd_cliente,nu_documento,fe_documento,tp_documento 
				FROM admin_documentos 
				WHERE st_documento='".$st."' and cd_cliente='.$cd_cliente.'";
		$data = $this->db->query( $sql )->result();
		$this->response($data, REST_Controller::HTTP_OK);
	}
	/*
	**Insertar Clientes en sybase
	*/
		function insertarmaestro_post(){
	
		$this->db->query(  $this->Mapear->obtener($this->post()) ); 
		$this->response(['Item created successfully.'], REST_Controller::HTTP_OK);	
		
		}

		function insertardetalle_post(){
			$input = $this->post();
			$nu_documento   = $input["nu_documento"];         
			$nu_renglon     = $input["nu_renglon"];         
			$cd_concepto    = $input["cd_concepto"];   
			$ds_concepto    = $input["ds_concepto"]; 
			$nu_cantidad    = $input["nu_cantidad"];	
			$mn_monto_bf    = $input["mn_monto_bf"];
			$exentos        = $input["exentos"]; 
			$pc_iva         = $input["pc_iva"];
			$moneda         = $input["moneda"];
			$tp_cambio      = $input["tp_cambio"];     
			$cd_cuenta      = $input["cd_cuenta"];     					   		
				
			$sql = 'INSERT INTO dbo.admin_detdocumentos (nu_documento,nu_renglon,cd_concepto,ds_concepto,nu_cantidad,mn_monto_bf,exentos,pc_iva,moneda,tp_cambio,cd_cuenta)
					 VALUES ( \''.$nu_documento.'\','.$nu_renglon.',\''.$cd_concepto.'\',\''.$ds_concepto.'\','.$nu_cantidad.','.$mn_monto_bf.','.$exentos.','.$pc_iva.',\''.$moneda.'\',\''.$tp_cambio.'\', \''.$cd_cuenta.'\')';
					 
			$this->db->query( $sql ); 
			$this->response(['Item created successfully.'], REST_Controller::HTTP_OK);	
		}

		function updatenuserial_post(){
			$input = $this->post();
			$nu_documento    = $input["nu_documento"];
			$fe_documento    = $input["fe_documento"];
			$nu_seniat       = $input["nu_seniat"];         
			$st_documento    = $input["st_documento"];
			$fe_desde        = $input["fe_desde"]; 
			$fe_hasta        = $input["fe_hasta"];	
			$ds_observaciones= $input["ds_observaciones"];
			$cd_usuario      = $input["cd_usuario"]; 					   		
				
			$sql ='UPDATE dbo.admin_documentos SET fe_documento =\''.$fe_documento.'\',nu_seniat=\''.$nu_seniat.'\',st_documento=\''.$st_documento.'\',fe_desde=\''.$fe_desde.'\',fe_hasta=\''.$fe_hasta.'\',ds_observaciones=\''.$ds_observaciones.'\',cd_usuario=\''.$cd_usuario.'\'
					WHERE nu_documento=\''.$nu_documento.'\'';
			$this->db->query( $sql ); 
			$this->response(['Item created successfully.'], REST_Controller::HTTP_OK);	
		}
}