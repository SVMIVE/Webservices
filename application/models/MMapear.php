<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MMapear extends CI_Model {

    public function constructor(){
        parent::constructor();

    }
	public function obtener( array $post){
        $insert = " ";
        $values = '';
        $tabla = 'S/T'; 
        $i = 0;

        foreach($post as $cl => $val){
            if ( $cl != "tbl" || $cl != "call_back") {
                $coma = ($i > 0)?",":"";
                $insert .= $coma . $cl ;
                $values .= $coma . $this->getTipo( $val ) ;
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
}
