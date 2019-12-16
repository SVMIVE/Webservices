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

  function correlativoseried_get(){

		$sql = "SELECT nu_documento FROM admin_control";
		$data = $this->db->query( $sql )->result();
		$this->response($data, REST_Controller::HTTP_OK);
	}

  function correlativoseriee_get(){

		$sql = "SELECT nu_documento_h FROM admin_control";
		$data = $this->db->query( $sql )->result();
		$this->response($data, REST_Controller::HTTP_OK);
	}

  function correlativoseriec_get(){

    $sql = "SELECT nu_documento_c FROM admin_control";
    $data = $this->db->query( $sql )->result();
    $this->response($data, REST_Controller::HTTP_OK);
  }

  function valorut_get(){

    $sql = "SELECT mn_ut FROM admin_control";
    $data = $this->db->query( $sql )->result();
    $this->response($data, REST_Controller::HTTP_OK);
  }

  function valoriva_get(){

    $sql = "SELECT pc_iva FROM admin_control";
    $data = $this->db->query( $sql )->result();
    $this->response($data, REST_Controller::HTTP_OK);
  }

  function correlativorecibopago_get(){

    $sql = "SELECT nu_pago FROM admin_control";
    $data = $this->db->query( $sql )->result();
    $this->response($data, REST_Controller::HTTP_OK);
  }

  function correlativonotadebito_get(){

    $sql = "SELECT nu_documento_ndb FROM admin_control";
    $data = $this->db->query( $sql )->result();
    $this->response($data, REST_Controller::HTTP_OK);
  }
  function correlativonotacredito_get(){

    $sql = "SELECT nu_documento_ncr FROM admin_control";
    $data = $this->db->query( $sql )->result();
    $this->response($data, REST_Controller::HTTP_OK);
  }

  function retencioniva_get(){

    $sql = "SELECT pc_retencion FROM admin_control";
    $data = $this->db->query( $sql )->result();
    $this->response($data, REST_Controller::HTTP_OK);
  }

  function tasadolar_get(){

    $sql = "SELECT tasa_de_cambio_dol FROM admin_control";
    $data = $this->db->query( $sql )->result();
    $this->response($data, REST_Controller::HTTP_OK);
  }

  function fechadolar_get(){

    $sql = "SELECT fecha_aplica_dol FROM admin_control";
    $data = $this->db->query( $sql )->result();
    $this->response($data, REST_Controller::HTTP_OK);
  }

  function valorpetro_get(){

    $sql = "SELECT mn_petro FROM admin_control";
    $data = $this->db->query( $sql )->result();
    $this->response($data, REST_Controller::HTTP_OK);
  }

  function entepetro_get(){

    $sql = "SELECT tasa_de_cambio_ptr FROM admin_control";
    $data = $this->db->query( $sql )->result();
    $this->response($data, REST_Controller::HTTP_OK);
  }

  function fechapetro_get(){

    $sql = "SELECT fecha_aplica_ptr FROM admin_control";
    $data = $this->db->query( $sql )->result();
    $this->response($data, REST_Controller::HTTP_OK);
  }

  function valoreuro_get(){

    $sql = "SELECT mn_euro FROM admin_control";
    $data = $this->db->query( $sql )->result();
    $this->response($data, REST_Controller::HTTP_OK);
  }

  function enteeuro_get(){

    $sql = "SELECT tasa_de_cambio_eur FROM admin_control";
    $data = $this->db->query( $sql )->result();
    $this->response($data, REST_Controller::HTTP_OK);
  }

  function fechaeuro_get(){

    $sql = "SELECT fecha_aplica_eur FROM admin_control";
    $data = $this->db->query( $sql )->result();
    $this->response($data, REST_Controller::HTTP_OK);
  }















}
