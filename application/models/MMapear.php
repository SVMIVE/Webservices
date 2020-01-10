<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MMapear extends CI_Model {

    public $n_doc = NULL;

    public function constructor(){
        parent::constructor();

    }
	public function obtener( array $post){
        $insert = " ";
        $values = '';
        $tabla = 'S/T'; 
        $i = 0;
        $one = '';

        foreach($post as $cl => $val){
            if ( $cl != "tbl" && $cl != "call_back") {

                if ( ! is_array($val) ){
                    $coma = ($i > 0)?",":"";
                    $insert .= $coma . $cl ;
                    $valor = $cl == "nu_documento"?$this->n_doc: $val;
    
                    $values .= $coma . $this->getTipo( $valor );
                    $i++;
                }else{
                    for($j=0; $j < count($val); $j++){
                        $one .=  "; " . $this->obtener( $val[ $j ] );
                    }
                    
                }       

            }elseif ($cl == "tbl") {
               $tabla = $val; 
            }
            
        }

        $contenido = "INSERT INTO $tabla ( $insert ) VALUES ( $values )";

		return $contenido .  $one;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function updategenerico( array $post){
        $update = " ";
        $values = '';
        $tabla = 'S/T'; 
        $i = 0;
        $one = '';

        foreach($post as $cl => $val){
            if ( $cl != "tbl" && $cl != "call_back") {

                if ( ! is_array($val) ){
                    $coma = ($i > 0)?",":"";
                    $update .= $coma . $cl ;
                    $valor = $cl == "nu_documento"?$this->n_doc: $val;
    
                    $values .= $coma . $this->getTipo( $valor );
                    $i++;
                }else{
                    for($j=0; $j < count($val); $j++){
                        $one .=  "; " . $this->obtener( $val[ $j ] );
                    }
                    
                }       

            }elseif ($cl == "tbl") {
               $tabla = $val; 
            }
            
        }

        $contenido = "UPDATE $tabla SET ( $update  =  $values )";

		return $contenido .  $one;
    }
 ///////////////////////////////////////////////////////////////////////////////////////////////////   
    public function getTipo( $variable ) {
        $campo = array();
        
        switch (gettype($variable)) {
            case 'integer':
                $campo = $variable;
                break;
            case 'double':
                 # code...
                 $campo = $variable;
                break;
            case 'string':
                $campo = "'" .  $variable . "'"; 
                $elementos = explode("(", $variable);
                if(count($elementos)>1) $campo = $variable;
                 # code...
                break;
            case 'NULL':
                $campo = "'" .  $variable . "'"; 
                 # code...
                break;
            case 'array':
                $campo = $this->obtener($variable);
                break;
            case 'object':
                
                break;
            default:
                # code...
                break;
        }
        return $campo;
    }
    
    public function AutoIncremento($serie = "C"){   
        $sql = "EXEC sp_busca_corr_c" ;
        $data = $this->db->query( $sql );       
        $sql = "SELECT top 1 documento  FROM admin_correlativos where tipo='$serie' ORDER BY documento DESC" ;
        $data = $this->db->query( $sql )->result();
        return $data;
      }
      
    public function AutoIncrementSeniat($serie = "C"){
        $sql = "EXEC sp_busca_seniat_c" ;
        $data = $this->db->query( $sql );       
        $sql = "SELECT top 1 seniat  FROM admin_seniat WHERE tipo='$serie' ORDER BY seniat DESC";
        $data = $this->db->query( $sql )->result();
    
        return $data;
      }
}
