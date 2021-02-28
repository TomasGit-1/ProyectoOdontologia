<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Ejemplo extends Controller
{

  public function  Maestro()
    {
     return view('maestro');
    }
   
    function home()
   {
   	  
   		return view('welcome');
   }
   
    function Insertar(Request $request)
   {
         $request->validate([
         'cedula' => 'required|unique:profesores',
         'telefono' => 'required|unique:personas',
         'sexo'=> 'required|max:1',
         'maestria'=> 'required|numeric'
         ]);


         $aM = substr($_POST['apMat'], 0, 1);    //substring(apM,1,1);
        $nb = substr($_POST['nombres'], 0, 1);  //substring(nom,1,1);
        $d1 = substr($_POST['fechaNac'], 2, 2); //substring(fNac,9,2);
        $d2 = substr($_POST['fechaNac'], 5, 2); //substring(fNac,4,2);
        $d3 = substr($_POST['fechaNac'], 8, 2); //substring(fNac,1,2);
        $aP = substr($_POST['apPat'], 0, 1);    //substring(apP,1,2);7
        $vocal = array_intersect(str_split($_POST['apPat']),array('A','E','I','O','U','a','e','i','o','u'));
        if(sizeof($vocal)>0){
            $vocal=array_shift($vocal);
        }else{
            $vocal="x";
        }
        $rfc= $aP."".$vocal."".$aM."".$nb."".$d1."".$d2."".$d3;
        $validar = DB::select('SELECT rfc FROM Personas WHERE rfc = "'.$rfc.'"');
        if ($validar>0) {
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $aleatorio = substr(str_shuffle($permitted_chars), 0, 4);
            $rfcx= $aP."".$vocal."".$aM."".$nb."".$d1."".$d2."".$d3."".$aleatorio;
            $rfc = strtoupper($rfcx);
            $rf = DB::select('SELECT rfc FROM Personas WHERE rfc = "'.$rfc.'";');
            while($rfc == $rf){
                $aleatorio =substr(str_shuffle($permitted_chars), 0, 4);
                $rfc= $aP."".$vocal."".$aM."".$nb."".$d1."".$d2."".$d3."".$aleatorio;
                $rfc = strtoupper($rfcx);
                $rf = DB::select('SELECT rfc FROM Personas WHERE rfc = "'.$rfc.'";');
            }
        }

         $estatus='Activo';
         $R=DB::select('select cedula from Personas inner join Profesores on Personas.rfc=Profesores.rfc WHERE Profesores.rfc = "'.$rfc.'";');
          DB::insert('INSERT INTO Personas(rfc,apPat,apMat,nombres,telefono,sexo,fechaNac)VALUES(?,?,?,?,?,?,?)',[$rfc,$_POST['apPat'],$_POST['apMat'],$_POST['nombres'],$_POST['telefono'],$_POST['sexo'],$_POST['fechaNac']]);

          DB::insert('INSERT INTO profesores(cedula,rfc,claveMaestria,estatus)VALUES(?,?,?,?)',[$_POST['cedula'],$rfc,$_POST['maestria'],$estatus]);
          return redirect('/Maestro')->with('inserta',' Insertado Correctamente');
        
   }
     function Mostrar()
   {
       $datos = DB::select('select * from Personas inner join Profesores on Personas.rfc=Profesores.rfc');
   	    return view('/tabla',compact('datos'));

   }
      function Actualiza($rfc)
   {
         
              $datos = DB::select('select * from Personas inner join Profesores on Personas.rfc=Profesores.rfc where Personas.rfc="'.$rfc.'"');
             return view('/actualizar',compact('datos'));
   }

   function Eliminar($rfc)
   {
   	   $delete=DB::delete('delete from profesores where rfc="'.$rfc.'"');
       $delete=DB::delete('delete from Personas where rfc="'.$rfc.'"');
      return redirect('/MaestroMostrar');
   }
        function Actualizando($rfc)
   { 
             
             $update =DB::update('update Personas set nombres ="'.$_POST['nombres'].'",apPat ="'.$_POST['apPat'].'",apMat ="'.$_POST['apMat'].'",telefono="'.$_POST['telefono'].'",sexo ="'.$_POST['sexo'].'",fechaNac ="'.$_POST['fechaNac'].'" where rfc ="'.$rfc.'"');

             $update =DB::update('update profesores set cedula ="'.$_POST['cedula'].'",claveMaestria ="'.$_POST['maestria'].'",estatus ="'.$_POST['estatus'].'" where rfc ="'.$rfc.'"');
              return redirect('/MaestroMostrar');
   }
        public function Busca(Request $request)
   {
           $search= $request->get('search');
           $datos=DB::table('personas')
            ->join('profesores','personas.rfc','=','profesores.rfc')
            ->WHERE('nombres','like','%'.$search.'%')
            ->paginate(5);
            return view('/tabla',compact('datos'));
   }
}