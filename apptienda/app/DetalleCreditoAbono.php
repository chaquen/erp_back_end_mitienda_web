<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleCreditoAbono extends Model
{
    //
    private $TABLA="detalle_credito_abonos";

    public function consultar_todos(){
    	$datos=DB::table($this->TABLA)
    		->get();
    	return array("mensaje"=>"Elementos consultados",
    				"respuesta"=>true,
    				"datos"=>$datos);	

    }
   //$campo=array('campo1','signo_comparacion','campo2')
    public function consultar_por_campo($campo=array(),$operador,$campo2){
        if($operador=="AND"){
            $datos=DB::table($this->TABLA)
                    ->where($campo)
                    ->get();
                 if(count($datos)>0){
                    return array("mensaje"=>"Elementos consultados",
                            "respuesta"=>true,
                            "datos"=>$datos);   
                 }else{
                    return array("mensaje"=>"Elementos NO encontrados",
                            "respuesta"=>false,
                            "datos"=>$datos);
                 }  
        }else if($operador=="OR"){
           
            $datos=DB::table($this->TABLA)
            ->where($campo)
            ->orwhere($campo2)
            ->get();
         if(count($datos)>0){
            return array("mensaje"=>"Elementos consultados",
                    "respuesta"=>true,
                    "datos"=>$datos);   
         }else{
            return array("mensaje"=>"Elementos NO encontrados",
                    "respuesta"=>false,
                    "datos"=>$datos);
         }
        }
           
        
    }
    //$campo=array('campo1'=>'valor1','campo2'=>'valor2','campo3'=>'valor3')
    public function insertar($campos=array()){
    	$id=DB::table($this->TABLA)
    		->insertGetId($campos);
    	return array("mensaje"=>"Elemento insertado",
    				"respuesta"=>true,
    				"id"=>$id);			
    }
    //$campo=array('campo1'=>'valor1','campo2'=>'valor2','campo3'=>'valor3')
    //$filtro=array('campo1','signo_comparacion','campo2')
    public function editar($campos,$filtro){
    	DB::table($this->TABLA)
    		->where($filtro)
    		->update($campos);
    	return array("mensaje"=>"Elemento editado",
    				"respuesta"=>true,
    				"id"=>$id);
    }

    public function cambio_estado($filtro,$estado){
    	$datos=DB::table($this->TABLA)
    		->where($filtro)
    		->get();
    	if(count($datos)>0){
    		
    			DB::table($this->TABLA)
    			->where("id",'=',$datos[0]->id)
    			->update("estado_credito",$estado);	
    			return array("mensaje"=>"Elemento deshabilitado",
    				"respuesta"=>true);
    		
    		
    	}else{
    		return array("mensaje"=>"Elemento no existe",
    				"respuesta"=>false);
    	}
    }
}
