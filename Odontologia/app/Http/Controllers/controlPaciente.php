<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\paciente;
use Barryvdh\DomPDF\Facade as PDF;
class controlPaciente extends Controller
{
     function PacienteP(){
          return view('Principal.PacientePrin');
    }
    function pdfPrueb($folio){
        $datos = DB::select('select * from pagos where folio="'.$folio.'"');
        $pdf = \PDF::loadView('pdf.prueba',compact('datos'));
        //return view('pdf.tuto1');
        return $pdf->stream();
    }
    function Paciente(){
            session_start();
             if(!empty($_GET['modificar'])){
                //$datos = DB::select('SELECT * FROM Personas WHERE rfc="'.$_GET['modificar'].'"');
                $datos = DB::select('SELECT * FROM  personas  per  INNER JOIN pacientes pac 
                             ON per.rfc=pac.rfc WHERE per.rfc="'.$_GET['modificar'].'"');
                return view('Paciente.Paciente',compact('datos'));
            }else{
                return view('Paciente.Paciente');
            }
    }
    function Pdf($rfc){
        /*
        $datos = DB::select('SELECT * FROM Personas WHERE rfc = "'.$rfc.'"');
        $pdf = \PDF::loadView('pdfM',compact('datos'));
        return $pdf->stream();*/
        $datos = DB::select('SELECT * FROM  personas  per  INNER JOIN pacientes pac 
                             ON per.rfc=pac.rfc where pac.rfc="'.$rfc.'"');
        $pdf = \PDF::loadView('pdf.pacientePdf',compact('datos'));
        //return view('pdf.tuto1');
        return $pdf->stream();
    }

    function Listar(){
            if(!empty($_GET['nombrePaciente'])){
                $datos = DB::select('SELECT * FROM  personas  per  INNER JOIN pacientes pac 
                                 ON per.rfc=pac.rfc WHERE nombres like "%'.$_GET['nombrePaciente'].'%"');
                return view('Paciente.ListaPaciente',compact('datos')); 
            }else{
               $datos = DB::select('SELECT * FROM  personas  per  INNER JOIN pacientes pac 
                                 ON per.rfc=pac.rfc');
                return view('Paciente.ListaPaciente',compact('datos')); 
            }
        
    }
    function Actualizar(paciente $request){
        $rfcViejo=$_POST['rfcPaciente'];
        $aleatorio1=substr($_POST['rfcPaciente'], 10,13);
        $aM = substr($_POST['apMat'], 0, 1);
        $aM = substr($_POST['apMat'], 0, 1);    //substring(apM,1,1);
        $nb = substr($_POST['nomPaciente'], 0, 1);  //substring(nom,1,1);
        $d1 = substr($_POST['fecPerson'], 2, 2); //substring(fNac,9,2);
        $d2 = substr($_POST['fecPerson'], 5, 2); //substring(fNac,4,2);
        $d3 = substr($_POST['fecPerson'], 8, 2); //substring(fNac,1,2);
        $aP = substr($_POST['apPat'], 0, 1);    //substring(apP,1,2);7
        $vocal = array_intersect(str_split($_POST['apPat']),array('A','E','I','O','U','a','e','i','o','u'));
        if(sizeof($vocal)>0){
            $vocal=array_shift($vocal);
        }else{
            $vocal="x";
        }
        $rfc= $aP."".$vocal."".$aM."".$nb."".$d1."".$d2."".$d3."".$aleatorio1;
        if($rfc!=$rfcViejo){
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
            DB::update('UPDATE Personas set rfc ="'.$rfc.'" where rfc ="'.$rfcViejo.'"');
            DB::update('UPDATE Personas set apPat ="'.$_POST['apPat'].'" where rfc ="'.$rfc.'"');
            DB::update('UPDATE Personas set apMat ="'.$_POST['apMat'].'" where rfc ="'.$rfc.'"');
            DB::update('UPDATE Personas set nombres ="'.$_POST['nomPaciente'].'" where rfc ="'.$rfc.'"');
            DB::update('UPDATE Personas set fechaNac ="'.$_POST['fecPerson'].'" where rfc ="'.$rfc.'"');
            DB::update('UPDATE Personas set telefono ="'.$_POST['telPerson'].'" where rfc ="'.$rfc.'"');
            DB::update('UPDATE Personas set sexo ="'.$_POST['persona'].'" where rfc ="'.$rfc.'"');
        }else{
            DB::update('UPDATE Personas set apPat ="'.$_POST['apPat'].'" where rfc ="'.$_POST['rfcPaciente'].'"');
            DB::update('UPDATE Personas set apMat ="'.$_POST['apMat'].'" where rfc ="'.$_POST['rfcPaciente'].'"');
            DB::update('UPDATE Personas set nombres ="'.$_POST['nomPaciente'].'" where rfc ="'.$_POST['rfcPaciente'].'"');
            DB::update('UPDATE Personas set fechaNac ="'.$_POST['fecPerson'].'" where rfc ="'.$_POST['rfcPaciente'].'"');
            DB::update('UPDATE Personas set telefono ="'.$_POST['telPerson'].'" where rfc ="'.$_POST['rfcPaciente'].'"');
            DB::update('UPDATE Personas set sexo ="'.$_POST['persona'].'" where rfc ="'.$_POST['rfcPaciente'].'"');
        }
        return redirect('/PacienteLista')->with('actualizar','Paciente actualizado correctamente');
        //return $pdf->stream();

    }
    function Insertar(paciente $request){
        $nombre=trim($_POST['nomPaciente']);
        $aM = substr($_POST['apMat'], 0, 1);   
        $nb = substr($nombre,0,1); 
        $d1 = substr($_POST['fecPerson'], 2, 2); 
        $d2 = substr($_POST['fecPerson'], 5, 2);
        $d3 = substr($_POST['fecPerson'], 8, 2); 
        $aP = substr($_POST['apPat'], 0, 1);
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
        DB::insert('INSERT INTO Personas(rfc,apPat, apMat, nombres, telefono, sexo, fechaNac)VALUES (?, ?, ?, ?, ?, ?, ?)', 
            [$rfc, $_POST['apPat'],$_POST['apMat'],$_POST['nomPaciente'],$_POST['telPerson'],$_POST['persona'], $_POST['fecPerson']]); 
        DB::insert('INSERT INTO Pacientes(rfc,estadoCivil,colonia,calle,numeroInt,numeroExt,cp)VALUES(?,?,?,?,?,?,?)',
            [$rfc,"null","null","null",0,0,0]);

        $hora=DB::select('select Time(Now()) as hora');
        $hora=array_column($hora,"hora"); 
        $anio=DB::select('select year(NOW()) as anio'); 
        $anio=array_column($anio,"anio");
        $mes=DB::select('select month(NOW()) as mes'); 
        $mes=array_column($mes,"mes");
        $dia=DB::select('select day(NOW()) as dia');
        $dia=array_column($dia,"dia"); //dd($anio[0]."/".$mes[0]."/".$dia[0]);
        $fecha=$anio[0]."/".$mes[0]."/".$dia[0];

         /*$precio=DB::select('SELECT
       * FROM  catalogoservicios  WHERE
        claveServicio="'.$_POST['opTra'].'"');
        $precio=array_column($precio,'costo');*/ 
        //Checar en donde ira laprimera vez que se agrea 
        /*DB::insert('INSERT INTO
        Pagos(claveServicio,rfcPaciente,fecha,matricula,cedula,hora,observacion,precio,estatus)
        VALUES(?,?,?,?,?,?,?,?,?)', [30,$rfc,$fecha,
        103266,'DF7G2V4H1C',$hora[0],  'Registro de paciente',5,1]);*/

        $tratamiento=DB::select('SELECT * FROM  catalogoservicios WHERE
        claveServicio=8');  
        $precio=array_column($tratamiento,"costo");
        DB::insert('INSERT INTO
        Pagos(claveServicio,rfcPaciente,fecha,hora,observacion,precio,estatus,matricula,cedula)
        VALUES(?,?,?,?,?,?,?,?,?)',[8,$rfc,$fecha,$hora[0],'Registro de paciente',$precio[0],1,$_POST['opAlum'],$_POST['opMaestro']]);

        $folio=DB::select('select * from pagos where fecha="'.$fecha.'" and hora="'.$hora[0].'";');
        $folio=array_column($folio,"folio");

        return redirect('/Paciente')->with('Insertar','El pago se realizo con exito Folio:'.$folio[0]);
    }
}