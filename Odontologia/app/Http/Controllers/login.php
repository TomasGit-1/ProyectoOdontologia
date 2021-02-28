<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class login extends Controller
{
    function inicio(){
   		return view('Login.login');
    }
     function Iniciar(){
     	$Usuario = DB::select('SELECT * FROM  Usuarios  where usuario="'.$_POST['USER'].'"');
     	if(sizeof($Usuario)>0){
     		$Usuario = DB::select('SELECT * FROM  Usuarios  where usuario="'.$_POST['USER'].'"');
     		$pass=array_column($Usuario,'pass');//Obtenemos la contraseña del usuario
     		if(implode($pass)==$_POST['PASS']){
				    $Usuario=array_column($Usuario,'usuario');
    				if(implode($Usuario)=="admin"){
              return view('alumno.menu');
    				}elseif (implode($Usuario)=="caja") {
               // session_start();
    					  return redirect('/PacientePrincipal');
    				}else{
    					return view('HistoriaClinica.historiaClinica');
    				}
     		}else{
     			return redirect('/')->with('error','Contraseña incorrecta');
     		}		

     	}else{
   			return redirect('/')->with('error','Usuario incorrecto');
   		}
    }
    
    function seTermino(){
      return redirect('/');
    }
}
