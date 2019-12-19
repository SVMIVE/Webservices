<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MMapear extends CI_Model {

    public function constructor(){
        parent::constructor();

    }
	public function obtener( array $post, $n_doc = ''){
        $insert = " ";
        $values = '';
        $tabla = 'S/T'; 
        $i = 0;

        foreach($post as $cl => $val){
            if ( $cl != "tbl" && $cl != "call_back") {
                $coma = ($i > 0)?",":"";
                $insert .= $coma . $cl ;
                $valor = $cl == "nu_documento"?$n_doc: $val;
                $values .= $coma . $this->getTipo( $valor ) ;
                $i++;
            }elseif ($cl == "tbl") {
               $tabla = $val; 
            }elseif ($cl == "call_back"){

            }
            
        }

        $contenido = "INSERT INTO $tabla ( $insert ) VALUES (  $values ) ";

		return $contenido;
    }
    
    public function getTipo( $variable ) {
        $campo = '';
        
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
                 # code...
                break;
            case 'NULL':
                $campo = "'" .  $variable . "'"; 
                 # code...
                break;
            case 'array':
                
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
