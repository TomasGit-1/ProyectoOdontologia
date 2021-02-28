<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/**
 * 
 */
class pruebacontroler extends Controller
{
	
	public function prueba()
	{
		return 'estoy dentro de prueba controller';
		# code...
	}
    public function prueba2(){

     return 'Hello Worl, esta es mi primer mi_primer_ruta. ';
    }

    public function prueba3($nam , $lastname){
        return 'Hola soy '. $nam . $lastname;
    }

	public function  alumno()
    {
	return view('alumno.createform');
    }

    public function tabla(){
        $users = DB::table('personas')
            ->join('alumnos', 'personas.rfc', '=', 'alumnos.rfc')
            ->paginate(5);
        return view('alumno.tablaregistro', ['users'=> $users]);
    }
    public function search(Request $request){
        $search = $request->get('search');
       // $users = DB::table('personas')->WHERE('nombres', 'like','%'.$search.'%')->paginate(5);
      //$users = DB::select('SELECT * FROM  personas  per  INNER JOIN alumnos alu ON per.rfc=alu.rfc WHERE nombres like "'.$search.'"');
        $users = DB::table('personas')
            ->join('alumnos', 'personas.rfc', '=', 'alumnos.rfc')
            ->WHERE('nombres', 'like','%'.$search.'%')
            ->paginate(5);
        return view('alumno.tablaregistro', ['users'=> $users]);

        if(['users'=> $users]>0){
            
            return back()->with('mensaje','Alumno No Encontrado!!');
        }else{
            return back()->with('mensaje','Alumno No Encontrado!!');
        }
    }

    public function crear(Request $request){
      //  return $request->all();
      /*  $personaNueva = DB::select('INSERT INTO personas(rfc, apPat, apMat,nombres, telefono, sexo, fechaNac) VALUES(rfc,apPat,apMat,nombres,telefono,sexo,fechaNac)');
        $personaNuev->rfc  = $request->rfc;
        $personaNue->apPat = $request->apPat;
        $personaNu->apMat = $request->apMat;
        $personaN->nombres = $request->nombres;
        $persona->telefono = $request->telefono;
        $persona->sexo = $request->sexo;
        $person->fechaNac = $request->fechaNac;

       /* $alumnoNuevo = DB::select('INSERT INTO alumnos( matricula, claveMaestria, rfc, estatus, semestre)
                                VALUES (matricula, claveMaestria, rfc, estatus, semestre)');
        $alumnoNuevo->matricula = $request->matricula;
        $alumnoNuevo->claveMaestria = $request->claveMaestria;
        $alumnoNuevo->rfc = $request->rfc;
        $alumnoNuevo->estatus = $request->estatus;
        $alumnoNuevo->semestre = $request->semestre;*/
        //para validar los campos
        /*$request->validate([
            'apPat' => 'required','apMat' => 'required','nombres' => 'required','telefono' => 'required','sexo' => 'required','fechaNac' => 'required','matricula' => 'required','claveMaestria' => 'required','rfc' => 'required','estatus' => 'required','semestre' => 'required'
        ]);*/
        $request->validate([
            'nombres' => 'required|regex:/^[\pL\s\-]+$/u',
            'apPat' => 'required|regex:/^[\pL\s\-]+$/u',
            'matricula' => 'required|unique:alumnos',
            'apMat' => 'regex:/^[\pL\s\-]+$/u'
        ]);
        
        $aP = substr($_POST['apPat'],0,2);
        $aM = substr($_POST['apMat'],0,1);
        $nb = substr($_POST['nombres'],0,1);
        $d1 = substr($_POST['fechaNac'],2,2);
        $d2 = substr($_POST['fechaNac'],5,2);
        $d3 = substr($_POST['fechaNac'],8,2);
        $rfc = $aP."".$aM."".$nb."".$d1."".$d2."".$d3;
        $validar = DB::select('SELECT rfc FROM personas WHERE rfc = "'.$rfc.'"');
        if ($validar > 0) {
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $aleatorio = substr(str_shuffle($permitted_chars),0, 4);
            $rfcx = $aP."".$aM."".$nb."".$d1."".$d2."".$d3."".$aleatorio; 
            $rfc = strtoupper($rfcx);
            $rf = DB::select('SELECT rfc FROM personas WHERE rfc = "'.$rfc.'";');
            while ($rfc == $rf) {
                $aleatorio = substr(str_shuffle($permitted_chars),0,4);
                $rfcx = $aP."".$aM."".$nb."".$d1."".$d2."".$d3."".$aleatorio;
                $rfc = strtoupper($rfcx);
                $rf = DB::select('SELECT rfc FROM personas WHERE rfc = "'.$rfc.'";');
            }
        }
         DB::select('INSERT INTO personas(rfc, apPat, apMat,nombres, telefono, sexo, fechaNac)VALUES(?,?,?,?,?,?,?)',[$rfc,$_POST['apPat'],$_POST['apMat'],$_POST['nombres'],$_POST['telefono'],$_POST['sexo'],$_POST['fechaNac']]);

         DB::select('INSERT INTO alumnos( matricula, claveMaestria, rfc, estatus, semestre)
                                VALUES (?,?,?,?,?)',[$_POST['matricula'],$_POST['claveMaestria'],$rfc,$_POST['estatus'],$_POST['semestre']]);
        //$personaNueva->save();
        //return redirect('alumnos')->with('mensaje','Alumno Agregado!!');

       return back()->with('mensaje','Alumno Agregado!!');

    }

    public function editar($rfc){

        $users = DB::select('SELECT * FROM personas WHERE rfc = "'.$rfc.'"');
        $valor = DB::select('SELECT * FROM alumnos WHERE rfc = "'.$rfc.'"');
        return view('alumno.editar', compact('valor','users'));
    }

    public function update(Request $request,$rfc){
        /*$aP = substr($_POST['apPat'],0,2);
        $aM = substr($_POST['apMat'],0,1);
        $nb = substr($_POST['nombres'],0,1);
        $d1 = substr($_POST['fechaNac'],2,2);
        $d2 = substr($_POST['fechaNac'],5,2);
        $d3 = substr($_POST['fechaNac'],8,2);
        $rfc = $aP."".$aM."".$nb."".$d1."".$d2."".$d3;
        $validar = DB::select('SELECT rfc FROM personas WHERE rfc = "'.$rfc.'"');
        if ($validar > 0) {
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $aleatorio = substr(str_shuffle($permitted_chars),0, 4);
            $rfcx = $aP."".$aM."".$nb."".$d1."".$d2."".$d3."".$aleatorio; 
            $rfc = strtoupper($rfcx);
            $rf = DB::select('SELECT rfc FROM personas WHERE rfc = "'.$rfc.'";');
            while ($rfc == $rf) {
                $aleatorio = substr(str_shuffle($permitted_chars),0,4);
                $rfcx = $aP."".$aM."".$nb."".$d1."".$d2."".$d3."".$aleatorio;
                $rfc = strtoupper($rfcx);
                $rf = DB::select('SELECT rfc FROM personas WHERE rfc = "'.$rfc.'";');
            }
        }*/
        $request->validate([
            'nombres' => 'required|regex:/^[\pL\s\-]+$/u',
            'apPat' => 'required|regex:/^[\pL\s\-]+$/u',
            'apMat' => 'regex:/^[\pL\s\-]+$/u'
        ]);
        DB::select('UPDATE personas SET apPat ="'.$_POST['apPat'].'",apMat = "'.$_POST['apMat'].'",nombres = "'.$_POST['nombres'].'",telefono = "'.$_POST['telefono'].'",sexo = "'.$_POST['sexo'].'",fechaNac = "'.$_POST['fechaNac'].'" WHERE rfc="'.$rfc.'"');
        DB::select('UPDATE alumnos set matricula = "'.$_POST['matricula'].'",claveMaestria = "'.$_POST['claveMaestria'].'", estatus = "'.$_POST['estatus'].'", semestre = "'.$_POST['semestre'].'" WHERE rfc="'.$rfc.'"');

       return back()->with('mensaje','Alumno Actualizado!!');
    }

    public function eliminar($rfc){

        // DB::select('DELETE  FROM personas WHERE rfc = "'.$rfc.'"');
         DB::select('DELETE  FROM alumnos WHERE rfc = "'.$rfc.'"');
         DB::select('DELETE  FROM personas WHERE rfc = "'.$rfc.'"');

        //$users->delete();
        //$valor->delete();
        return back()->with('mensaje','Alumno Eliminado!!');
    }
}
