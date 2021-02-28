<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
class pagos extends Controller
{
   function pagosI(){
        return view('Pagos.pagoForm');
   }
   function Tabla(){
        if(!empty($_GET['folio'])){
                $datos = DB::select('SELECT * FROM  pagos WHERE folio like "%'.$_GET['folio'].'%"');
                return view('Pagos.ListaPagos',compact('datos')); 
            }else{
               $datos=DB::SELECT('select * from pagos');
                return view('Pagos.ListaPagos',compact('datos'));
            }
   }
   function Pdf($folio){
        $datos = DB::select('select * from pagos where folio="'.$folio.'"');
        $pdf = \PDF::loadView('pdf.prueba',compact('datos'));
        //return view('pdf.tuto1');
        return $pdf->stream();
    }
   function  Buscar(){
        if(!empty($_GET['rfcB'])){
            $datos = DB::select('SELECT * FROM  pacientes   
                                 INNER JOIN personas 
                                 on pacientes.rfc=personas.rfc  and pacientes.rfc="'.$_GET['rfcB'].'"');
            if(sizeof($datos)>0){
                return view('Pagos.pagoForm',compact('datos'));
            }else{
                return redirect('/Pagos')->with('error','No se encontro el Paciente');
             }
        }else{
            return view('Pagos.pagoForm');
        }
    }
    function Insertar(){
        if(strlen($_POST['observacion'])==0){
                $_POST['observacion']='Ninguna';
        }
        $hora=DB::select('select Time(Now()) as hora');
        $hora=array_column($hora,"hora");
        $anio=DB::select('select year(NOW()) as anio');
        $anio=array_column($anio,"anio");
        $mes=DB::select('select month(NOW()) as mes');
        $mes=array_column($mes,"mes");
        $dia=DB::select('select day(NOW()) as dia');
        $dia=array_column($dia,"dia");
        //dd($anio[0]."/".$mes[0]."/".$dia[0]);
        $fecha=$anio[0]."/".$mes[0]."/".$dia[0];
        $precio=DB::select('SELECT * FROM  catalogoservicios 
                              WHERE claveServicio="'.$_POST['opTra'].'"');
        $precio=array_column($precio,'costo');
        DB::insert('INSERT INTO Pagos(claveServicio,rfcPaciente,fecha,matricula,cedula,hora,observacion,precio,estatus)
                                VALUES(?,?,?,?,?,?,?,?,?)',
                                      [$_POST['opTra'],$_POST['rfcB'],$fecha,
                                       $_POST['opAlum'],$_POST['opMaestro'],$hora[0], 
                                       $_POST['observacion'],$precio[0],1]);

        $folio=DB::select('select * from pagos where fecha="'.$fecha.'" and hora="'.$hora[0].'";');
        $folio=array_column($folio,"folio");

        return redirect('/Pagos')->with('Insertar','El pago se realizo con exito Folio:'.$folio[0]);

   }
}
