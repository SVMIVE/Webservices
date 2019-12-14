<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Cliente extends REST_Controller {
	
	public $estatus = true;
	
	public function __construct() {
		parent::__construct(); //Polimorfismo
		
		$this->load->database(); //Establece la conexión con Sysbase		
	}

	function listar_get(){	
		$sql = "SELECT top 50  auxiliar_contable, cedula_rif,nit,razon_social,auxiliar_contable, email
				FROM admin_personas_juridicas 
				ORDER BY razon_social desc ";
		$data = $this->db->query( $sql )->result();

		$this->response($data, REST_Controller::HTTP_OK);
	}
	function consultar_post(){
		
		$input = $this->post();
		$crit = $input["crit"];
		
		$sql = "SELECT top 20 * FROM admin_personas_juridicas
				WHERE auxiliar_contable LIKE '%'+'$crit' OR razon_social LIKE '$crit'+'%' OR auxiliar_contable LIKE '%'+'$crit' OR razon_social LIKE '%'+'$crit'";
		$data = $this->db->query( $sql )->result();

		$this->response($data, REST_Controller::HTTP_OK);
	}
	function razonsocial_post(){
		
		$input = $this->post();
		$auxcontable = $input["auxcontable"];
		
		$sql = "SELECT * FROM admin_personas_juridicas
				WHERE auxiliar_contable ='$auxcontable'";
		$data = $this->db->query( $sql )->result();

		$this->response($data, REST_Controller::HTTP_OK);
	}
	/**
	 *Listar totales Clientes por actividad 
	 */
	function lstactividad_get(){
		
		$sql = "SELECT CODIGO,ACTIVIDAD,
					CASE WHEN SUM(ACTIVOS)=NULL THEN 0 ELSE SUM(ACTIVOS) END AS ACTIVOS,
					CASE WHEN SUM(INACTIVOS)=NULL THEN 0 ELSE SUM(INACTIVOS) END AS INACTIVOS
				FROM dbo.view_tot_cli_act_ina_n01 
				GROUP BY CODIGO,ACTIVIDAD";
		$data = $this->db->query( $sql )->result();
		
		
		$this->response($data, REST_Controller::HTTP_OK);
	}
	/**
	 *Listar totales de facturas por actividad (Agrupados)
	 */
	function lstmaestrofacturacliente_get(){
		
		$sql = "SELECT * 
				FROM dbo.VIEW_CLI_TOT_DOC_FACTURADOS";
		$data = $this->db->query( $sql )->result();
		$this->response($data, REST_Controller::HTTP_OK);
	}
	/**
	 *Listar facturas por actividad y por clientes
	 */
	function lstdetallefacturacliente_get(){
		
		$sql = "SELECT * 
				FROM dbo.VIEW_CLI_DOC_FACTURADOS";
		$data = $this->db->query( $sql )->result();
		$this->response($data, REST_Controller::HTTP_OK);
	}	
	/**
	* Insertar Clientes en sybase
	*/
	function insertar_post(){
		$input = $this->post();
		//var_dump($input);
		$cedula_rif        = $input["rif"];         
		$nit               = $input["nit"];         
		$nombre            = $input["nombre"];      
		$razon_social      = $input["razonsocial"]; 
		$auxiliar_contable = $input["codigo"];      
		$tipo_cliente      = $input["tipocliente"]; 
		$Activo            = $input["estatus"];     
		$presidente        = "Erles";               
		$origen            = "SEDE";                
		$dec_ajusta        = 0.00;                  
		$porc_ing_bruto    = 0.00;                  
		$oficina           = "2";                   
		$fecha_registro    = $input["fechainiciocontrato"];       
		$dec_ing_bruto     = $input["ingresosbrutos"];            
		$FechaModificacion = $input["fechamodificacioncontrato"]; 
		$telefono_1        = $input["telefono"];                  
		$email             = $input["email"];                     
		$CodigoPostal      = $input["codigopostal"];              
		$dir_estado        = $input["direccionfiscal"];           	                              
		$formapago         = $input["formapago"];                 
		$lote              = $input["lote"];                      
		$actividad_empresa = $input["actividad"];                		
		$cd_usuario        = $input["Usuario"];		              					   		
			
		$sql = 'INSERT INTO dbo.admin_personas_juridicas (cedula_rif,nit,razon_social,auxiliar_contable,actividad_empresa,presidente,porc_ing_bruto,origen,dec_ing_bruto,dec_ajusta,activo,cd_usuario,fecha_registro,oficina,tipo_cliente,dir_estado,telefono_1,email)
		 		VALUES (\''.$cedula_rif.'\',\''.$nit.'\',\''.$razon_social.'\',\''.$auxiliar_contable.'\',\''.$actividad_empresa.'\',\''.$presidente.'\','.$porc_ing_bruto.',\''.$origen.'\','.$dec_ing_bruto.','.$dec_ajusta.', '.$Activo.',\''.$cd_usuario.'\',\''.$fecha_registro.'\',\''.$oficina.'\',\''.$tipo_cliente.'\',\''.$dir_estado.'\',\''.$telefono_1.'\',\''.$email.'\')';
		 		
		$this->db->query( $sql ); 
		$this->response(['Item created successfully.'], REST_Controller::HTTP_OK);	
		
		/**{ PRUEBA OBJETO
		"rif":"J-66654541-4",
		"nit":"0",
		"nombre":"PRUEBA-PRUEBA C.A.",
		"razonsocial":"PRUEBA-PRUEBA C.A.",
		"codigo":"77982091",
		"tipocliente":"Fijo",
		"estatus":0,
		"fechainiciocontrato":"2017-05-27",
		"ingresosbrutos":0,
		"fechamodificacioncontrato":"2017-05-27",
		"telefono":"02123514427",
		"email":"EMAIL@",
		"codigopostal":"1162",
		"direccionfiscal":"CTRA CHARALLAVE LOCAL ZONA DE HANGARES Nro VE-33 SECTOR ALTOS DE CURUMO. CHARALLAVE",
		"formapago":"C",
		"lote":0,
		"actividad":"999",
		"Usuario":"ESALAZAR"
		}**/
		
	}
	/**
	* Actualizar Clientes en sybase
	
	function editar_post(){
		$input = $this->post();
		    	
		$auxiliar_contable = $input["Codigo"];
		$nit               = $input["Nit"]; 
		$razon_social      = $input["RazonSocial"];
		$cedula_rif        = $input["Rif"];
		$actividad_empresa = $input["Actividad"];
		$presidente        = "Erles"; 
		$porc_ing_bruto    = 0.00;
		$origen            = "SEDE";		
		$dec_ing_bruto     = $input["Declarar"];
		$dec_ajusta        = 0; 		
		$Activo            = $input["Estatus"];		
		$cd_usuario        = $input["Usuario"];		
		$fecha_registro    = $input["FechaInicio"];
		$oficina           = "2"; 		
		$tipo_cliente      = $input["Tipo"];	
		$dir_estado        = $input["Direccion"];	
		$telefono_1        = $input["Telefono"];
		$email             = $input["Email"];	
		$FechaModificacion = $input["FechaModificacion"];
		$CodigoPostal      = $input["CodigoPostal"];	
		

		$sql = 'UPDATE dbo.admin_personas_juridicas 
		
		
		SET nit='.$nit.',
		    razon_social=\'' . $razon_social . '\',
		    aux_contable=\'' . $aux_contable . '\' 
		
		
		
		WHERE auxiliar_contable=\'' . $auxiliar_contable . '\'';
		$this->db->query( $sql ); 
		
		$this->response(['Item created successfully.'], REST_Controller::HTTP_OK);
	}*/
		

}
