<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\historiaC;

use Barryvdh\DomPDF\Facade as PDF;

class historiaClinica extends Controller
{

    function Pdf($rfc){
        $datos = DB::select('SELECT * FROM  personas per   INNER JOIN pacientes pac
                                                    ON per.rfc=pac.rfc INNER JOIN  HistoriaClinica  hc
                                                    ON pac.folio=hc.folio INNER JOIN  Municipios mun
                                                    ON pac.idMunicipio=mun.idMunicipio INNER JOIN TipoSanguineo tp
                                                    ON pac.claveSangui=tp.claveSangui WHERE per.rfc="'.$rfc.'"');
        $pdf = \PDF::loadView('pdf.tuto1',compact('datos'));
        //return view('pdf.tuto1');
        return $pdf->stream();

    }
    
    function HistoriaClinica(){
        if(!empty($_GET['modificar'])){
            //$datos = DB::select('SELECT * FROM Personas WHERE rfc="'.$_GET['modificar'].'"');
            $datos = DB::select('SELECT * FROM  personas per   INNER JOIN pacientes pac
                                                    ON per.rfc=pac.rfc INNER JOIN  HistoriaClinica  hc
                                                    ON pac.folio=hc.folio INNER JOIN  Municipios mun
                                                    ON pac.idMunicipio=mun.idMunicipio INNER JOIN TipoSanguineo tp
                                                    ON pac.claveSangui=tp.claveSangui WHERE per.rfc="'.$_GET['modificar'].'"');
            return view('HistoriaClinica.historiaClinica',compact('datos'));
        }else{
            return view('HistoriaClinica.historiaClinica');
        }
    }
    function ver(){
        if(!empty($_GET['ver'])){
            //$datos = DB::select('SELECT * FROM Personas WHERE rfc="'.$_GET['modificar'].'"');
            $datos = DB::select('SELECT * FROM  personas per   INNER JOIN pacientes pac
                                                    ON per.rfc=pac.rfc INNER JOIN  HistoriaClinica  hc
                                                    ON pac.folio=hc.folio INNER JOIN  Municipios mun
                                                    ON pac.idMunicipio=mun.idMunicipio INNER JOIN TipoSanguineo tp
                                                    ON pac.claveSangui=tp.claveSangui WHERE per.rfc="'.$_GET['ver'].'"');
            return view('HistoriaClinica.verHClinica',compact('datos'));
        }else{
            return view('HistoriaClinica.historiaClinica');
        }
    }
    function Listar(){
        if(!empty($_GET['nombrePaciente'])){
            $datos = DB::select('SELECT * FROM  personas per   INNER JOIN pacientes pac
                                                    ON per.rfc=pac.rfc INNER JOIN  HistoriaClinica  hc
                                                    ON pac.folio=hc.folio INNER JOIN  Municipios mun
                                                    ON pac.idMunicipio=mun.idMunicipio INNER JOIN TipoSanguineo tp
                                                    ON pac.claveSangui=tp.claveSangui WHERE nombres like "%'.$_GET['nombrePaciente'].'%"');
            return view('HistoriaClinica.hcl',compact('datos')); 
        }else{
           $datos = DB::select('SELECT * FROM  personas per   INNER JOIN pacientes pac
                                                    ON per.rfc=pac.rfc INNER JOIN  HistoriaClinica  hc
                                                    ON pac.folio=hc.folio INNER JOIN  Municipios mun
                                                    ON pac.idMunicipio=mun.idMunicipio INNER JOIN TipoSanguineo tp
                                                    ON pac.claveSangui=tp.claveSangui');
            return view('HistoriaClinica.hcl',compact('datos')); 
        }   
    }
    function  Buscar(){
    	if(!empty($_GET['rfcB'])){
            $folio=DB::select('SELECT * FROM  pacientes 
                              WHERE rfc="'.$_GET['rfcB'].'"');
            $folio=array_column($folio,'folio');
            $validar = DB::select('SELECT * FROM  historiaClinica where folio="'.implode($folio).'"');
            if(sizeof($validar)>0){
                return redirect('/HistoriaClinica')->with('existe','Ya existe la historia Clinica');
            }else{
                $datos = DB::select('SELECT * FROM  personas  per  INNER JOIN pacientes pac ON per.rfc=pac.rfc and per.rfc="'.$_GET['rfcB'].'"');
                //$datos = DB::select('SELECT * FROM Personas WHERE rfc="'.$_GET['rfcB'].'"');
                if(sizeof($datos)>0){
                    return view('HistoriaClinica.historiaClinica',compact('datos'));
                }else{
                    return redirect('/HistoriaClinica')->with('error','No se encontro el Paciente');
                }
            } 
    	}else{
    	   return view('HistoriaClinica.historiaClinica');
    	}
         
    }
    function Actualizar(){
        $idSangui=DB::select('SELECT * FROM  tipoSanguineo 
                              WHERE tipoSangui="'.$_POST['tipoSan'].'"');
        $idMuni=DB::select('SELECT * FROM   municipios
                            WHERE NombremUnicipio="'.$_POST['municipo'].'"');
        if(sizeof($idSangui)>0 && sizeof($idMuni)>0){
            $idSangui=array_column($idSangui,'claveSangui');
            $idMuni=array_column($idMuni,'idMunicipio');
            DB::update('UPDATE Pacientes set claveSangui ="'.implode($idSangui).'" where rfc ="'.$_POST['Actualizar'].'"');
            DB::update('UPDATE Pacientes set estadoCivil ="'.$_POST['estadoCivil'].'" where rfc ="'.$_POST['Actualizar'].'"');
            DB::update('UPDATE Pacientes set idMunicipio ="'.implode($idMuni).'" where rfc ="'.$_POST['Actualizar'].'"');
            DB::update('UPDATE Pacientes set colonia ="'.$_POST['colonia'].'" where rfc ="'.$_POST['Actualizar'].'"');
            DB::update('UPDATE Pacientes set calle ="'.$_POST['callePaciente'].'" where rfc ="'.$_POST['Actualizar'].'"');
            DB::update('UPDATE Pacientes set numeroInt ="'.$_POST['numInterior'].'" where rfc ="'.$_POST['Actualizar'].'"');      
            DB::update('UPDATE Pacientes set numeroExt ="'.$_POST['numExterior'].'" where rfc ="'.$_POST['Actualizar'].'"');      
            DB::update('UPDATE Pacientes set cp ="'.$_POST['codigoPost'].'" where rfc ="'.$_POST['Actualizar'].'"');      
            $folio=DB::select('SELECT * FROM  pacientes 
                                  WHERE rfc="'.$_POST['Actualizar'].'"');
            $folio=array_column($folio,'folio');
            $sexo=DB::select('SELECT * FROM  Personas 
                                  WHERE rfc="'.$_POST['Actualizar'].'"');
            $sexo=array_column($sexo,'sexo');
            //Diabetes
            if($_POST['opDiabetes']=="1"){
                $desDiabetes=$_POST['txtDiab'];
            }else{
                $desDiabetes='Ninguna';
            }
            //hpertension
            if($_POST['opHiper']=="1"){
                $hpertension=$_POST['txtHiper'];
            }else{
               
                $hpertension='Ninguna';
            }
            //cardiopatia
            if($_POST['opCardio']=="1"){
                $opCardio=$_POST['txtCard'];
            }else{
                $opCardio='Ninguna';
            }
            //cancer
            if($_POST['opCancer']=="1"){
                $opCancer=$_POST['txtCancer'];
            }else{
                $opCancer='Ninguna';
            }
            //toxicomanias
            if($_POST['opToxi']=="1"){
                $opToxi=$_POST['txtToxi'];
            }else{
                $opToxi='Ninguna';
            }
            if(strlen($_POST['txtOtro'])==0){
            $_POST['txtOtro']='Ninguna';
            }
            if(strlen($_POST['txtEnfer'])==0){
                $_POST['txtEnfer']='Ninguna';
            }
            if(strlen($_POST['txtImmu'])==0){
                $_POST['txtImmu']='Ninguna';
            }
            if(strlen($_POST['txtAlegias'])==0){
                $_POST['txtAlegias']='Ninguna';
            }
            if(strlen($_POST['txtMotivo'])==0){
                $_POST['txtMotivo']='Ninguna';
            }




            if(implode($sexo)=="M"){
                DB::update('UPDATE historiaClinica set diabetes ="'.$_POST['opDiabetes'].'" where folio ="'.implode($folio).'"');
                DB::update('UPDATE historiaClinica set diabetesDescr ="'.$desDiabetes.'" where folio ="'.implode($folio).'"');
                DB::update('UPDATE historiaClinica set hpertension ="'.$_POST['opHiper'].'" where folio ="'.implode($folio).'"');
                DB::update('UPDATE historiaClinica set hpertensionDescr ="'.$hpertension.'" where folio ="'.implode($folio).'"');
                DB::update('UPDATE historiaClinica set cardiopatia ="'.$_POST['opCardio'].'" where folio ="'.implode($folio).'"');
                DB::update('UPDATE historiaClinica set cardiopatiaDescr ="'.$opCardio.'" where folio ="'.implode($folio).'"');   
                DB::update('UPDATE historiaClinica set cancer ="'.$_POST['opCancer'].'" where folio ="'.implode($folio).'"');      
                DB::update('UPDATE historiaClinica set cancerDescr ="'.$opCancer.'" where folio ="'.implode($folio).'"'); 
                DB::update('UPDATE historiaClinica set otros ="'.$_POST['txtOtro'].'" where folio ="'.implode($folio).'"');
                DB::update('UPDATE historiaClinica set toxicomanias ="'.$_POST['opToxi'].'" where folio ="'.implode($folio).'"');
                DB::update('UPDATE historiaClinica set especifique ="'.$opToxi.'" where folio ="'.implode($folio).'"');
                DB::update('UPDATE historiaClinica set cepilladas ="'.$_POST['numCep'].'" where folio ="'.implode($folio).'"');
                DB::update('UPDATE historiaClinica set cepillo ="'.$_POST['cepillo'].'" where folio ="'.implode($folio).'"');
                DB::update('UPDATE historiaClinica set hiloDental ="'.$_POST['hDental'].'" where folio ="'.implode($folio).'"');
                DB::update('UPDATE historiaClinica set enjuague ="'.$_POST['enjuage'].'" where folio ="'.implode($folio).'"');   
                DB::update('UPDATE historiaClinica set enfermedadesA ="'.$_POST['txtEnfer'].'" where folio ="'.implode($folio).'"');   
                DB::update('UPDATE historiaClinica set inmunizaciones ="'.$_POST['txtImmu'].'" where folio ="'.implode($folio).'"');      
                DB::update('UPDATE historiaClinica set alergias ="'.$_POST['txtAlegias'].'" where folio ="'.implode($folio).'"');      
                DB::update('UPDATE historiaClinica set fecha ="'.$_POST['fechaRegla'].'" where folio ="'.implode($folio).'"');     
                DB::update('UPDATE historiaClinica set partos ="'.$_POST['txtParto'].'" where folio ="'.implode($folio).'"');  
                DB::update('UPDATE historiaClinica set abortos ="'.$_POST['txtAborto'].'" where folio ="'.implode($folio).'"');     
                DB::update('UPDATE historiaClinica set cesareas ="'.$_POST['txtCesarea'].'" where folio ="'.implode($folio).'"');     
                DB::update('UPDATE historiaClinica set embarazoActual ="'.$_POST['embActual'].'" where folio ="'.implode($folio).'"');     
                DB::update('UPDATE historiaClinica set motivoVisita ="'.$_POST['txtMotivo'].'" where folio ="'.implode($folio).'"');     
           }else{
                DB::update('UPDATE historiaClinica set diabetes ="'.$_POST['opDiabetes'].'" where folio ="'.implode($folio).'"');
                DB::update('UPDATE historiaClinica set diabetesDescr ="'.$desDiabetes.'" where folio ="'.implode($folio).'"');
                DB::update('UPDATE historiaClinica set hpertension ="'.$_POST['opHiper'].'" where folio ="'.implode($folio).'"');
                DB::update('UPDATE historiaClinica set hpertensionDescr ="'.$hpertension.'" where folio ="'.implode($folio).'"');
                DB::update('UPDATE historiaClinica set cardiopatia ="'.$_POST['opCardio'].'" where folio ="'.implode($folio).'"');
                DB::update('UPDATE historiaClinica set cardiopatiaDescr ="'.$opCardio.'" where folio ="'.implode($folio).'"');   
                DB::update('UPDATE historiaClinica set cancer ="'.$_POST['opCancer'].'" where folio ="'.implode($folio).'"');      
                DB::update('UPDATE historiaClinica set cancerDescr ="'.$opCancer.'" where folio ="'.implode($folio).'"'); 
                DB::update('UPDATE historiaClinica set otros ="'.$_POST['txtOtro'].'" where folio ="'.implode($folio).'"');
                DB::update('UPDATE historiaClinica set toxicomanias ="'.$_POST['opToxi'].'" where folio ="'.implode($folio).'"');
                DB::update('UPDATE historiaClinica set especifique ="'.$opToxi.'" where folio ="'.implode($folio).'"');
                DB::update('UPDATE historiaClinica set cepilladas ="'.$_POST['numCep'].'" where folio ="'.implode($folio).'"');
                DB::update('UPDATE historiaClinica set cepillo ="'.$_POST['cepillo'].'" where folio ="'.implode($folio).'"');
                DB::update('UPDATE historiaClinica set hiloDental ="'.$_POST['hDental'].'" where folio ="'.implode($folio).'"');
                DB::update('UPDATE historiaClinica set enjuague ="'.$_POST['enjuage'].'" where folio ="'.implode($folio).'"');   
                DB::update('UPDATE historiaClinica set enfermedadesA ="'.$_POST['txtEnfer'].'" where folio ="'.implode($folio).'"');   
                DB::update('UPDATE historiaClinica set inmunizaciones ="'.$_POST['txtImmu'].'" where folio ="'.implode($folio).'"');      
                DB::update('UPDATE historiaClinica set alergias ="'.$_POST['txtAlegias'].'" where folio ="'.implode($folio).'"');          
                DB::update('UPDATE historiaClinica set motivoVisita ="'.$_POST['txtMotivo'].'" where folio ="'.implode($folio).'"');  
            }
                return redirect('/HistoriaLista')->with('actualizar','Se actualizo correctamente');
        }else{
            return redirect('/HistoriaLista')->with('error','Intentelo de nuevo');
        }
       


    }
    function Insertar(historiaC $request){
        $idSangui=DB::select('SELECT * FROM  tipoSanguineo 
                              WHERE tipoSangui="'.$_POST['tipoSan'].'"');
        $idMuni=DB::select('SELECT * FROM   municipios
                            WHERE NombremUnicipio="'.$_POST['municipo'].'"');
        if(sizeof($idSangui)>0 && sizeof($idMuni)>0){
             session_start();
        $idSangui=array_column($idSangui,'claveSangui');
        $idMuni=array_column($idMuni,'idMunicipio');
        DB::update('UPDATE Pacientes set claveSangui ="'.implode($idSangui).'" where rfc ="'.$_POST['guardar'].'"');
        DB::update('UPDATE Pacientes set estadoCivil ="'.$_POST['estadoCivil'].'" where rfc ="'.$_POST['guardar'].'"');
        DB::update('UPDATE Pacientes set idMunicipio ="'.implode($idMuni).'" where rfc ="'.$_POST['guardar'].'"');
        DB::update('UPDATE Pacientes set colonia ="'.$_POST['colonia'].'" where rfc ="'.$_POST['guardar'].'"');
        DB::update('UPDATE Pacientes set calle ="'.$_POST['callePaciente'].'" where rfc ="'.$_POST['guardar'].'"');
        DB::update('UPDATE Pacientes set numeroInt ="'.$_POST['numInterior'].'" where rfc ="'.$_POST['guardar'].'"');      
        DB::update('UPDATE Pacientes set numeroExt ="'.$_POST['numExterior'].'" where rfc ="'.$_POST['guardar'].'"');      
        DB::update('UPDATE Pacientes set cp ="'.$_POST['codigoPost'].'" where rfc ="'.$_POST['guardar'].'"');      
        $folio=DB::select('SELECT * FROM  pacientes 
                              WHERE rfc="'.$_POST['guardar'].'"');
        $folio=array_column($folio,'folio');
        $sexo=DB::select('SELECT * FROM  Personas 
                              WHERE rfc="'.$_POST['guardar'].'"');
        $sexo=array_column($sexo,'sexo');

        //Diabetes
        if($_POST['opDiabetes']=="1"){
            $desDiabetes=$_POST['txtDiab'];
        }else{
            $desDiabetes='Ninguna';
        }
        //hpertension
        if($_POST['opHiper']=="1"){
            $hpertension=$_POST['txtHiper'];
        }else{
           
            $hpertension='Ninguna';
        }
        //cardiopatia
        if($_POST['opCardio']=="1"){
            $opCardio=$_POST['txtCard'];
        }else{
            $opCardio='Ninguna';
        }
        //cancer
        if($_POST['opCancer']=="1"){
            $opCancer=$_POST['txtCancer'];
        }else{
            $opCancer='Ninguna';
        }
        //toxicomanias
        if($_POST['opToxi']=="1"){
            $opToxi=$_POST['txtToxi'];
        }else{
            $opToxi='Ninguna';
        }
        if(strlen($_POST['txtOtro'])==0){
            $_POST['txtOtro']='Ninguna';
        }
        if(strlen($_POST['txtEnfer'])==0){
            $_POST['txtEnfer']='Ninguna';
        }
        if(strlen($_POST['txtImmu'])==0){
            $_POST['txtImmu']='Ninguna';
        }
        if(strlen($_POST['txtAlegias'])==0){
            $_POST['txtAlegias']='Ninguna';
        }
        if(strlen($_POST['txtMotivo'])==0){
            $_POST['txtMotivo']='Ninguna';
        }


        if(implode($sexo)=="M"){
        DB::insert('INSERT INTO historiaClinica(folio,diabetes,diabetesDescr,hpertension,hpertensionDescr,
                                                cardiopatia,cardiopatiaDescr,cancer,cancerDescr,otros,
                                                toxicomanias,especifique,cepilladas,cepillo,hiloDental,
                                                enjuague,enfermedadesA,inmunizaciones,alergias,fecha,
                                                partos,abortos,cesareas,embarazoActual,motivoVisita)
                                VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                                [implode($folio),$_POST['opDiabetes'],$desDiabetes,$_POST['opHiper'],$hpertension,
                                 $_POST['opCardio'],$opCardio,$_POST['opCancer'],$opCancer,$_POST['txtOtro'],$_POST['opToxi'],$opToxi,
                                 $_POST['numCep'],$_POST['cepillo'],$_POST['hDental'],$_POST['enjuage'],$_POST['txtEnfer'],$_POST['txtImmu'],
                                 $_POST['txtAlegias'],$_POST['fechaRegla'],$_POST['txtParto'],$_POST['txtAborto'],$_POST['txtCesarea'],$_POST['embActual'],
                                 $_POST['txtMotivo']]);
       }else{
            //Hombre
            DB::insert('INSERT INTO historiaClinica(folio,diabetes,diabetesDescr,hpertension,hpertensionDescr,
                                                    cardiopatia,cardiopatiaDescr,cancer,cancerDescr,otros,
                                                    toxicomanias,especifique,cepilladas,cepillo,hiloDental,
                                                    enjuague,enfermedadesA,inmunizaciones,alergias,motivoVisita)
                                VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                                [implode($folio),$_POST['opDiabetes'],$desDiabetes,$_POST['opHiper'],$hpertension,
                                 $_POST['opCardio'],$opCardio,$_POST['opCancer'],$opCancer,$_POST['txtOtro'],$_POST['opToxi'],
                                 $opToxi,$_POST['numCep'],$_POST['cepillo'],$_POST['hDental'],$_POST['enjuage'],$_POST['txtEnfer'],
                                 $_POST['txtImmu'],$_POST['txtAlegias'],
                                 $_POST['txtMotivo']]);
        }

            return redirect('/HistoriaClinica')->with('insertar','Se guardaron los datos');
        }else{
           return redirect('/HistoriaClinica')->with('error','Intentelo de nuevo');
        }
       
    }
}
/*if(isset($_POST['rfcB'])){
            $datos = DB::select('SELECT * FROM Personas WHERE rfc="'.$_POST['rfcB'].'"');
            return view('historiaClinica');
        }