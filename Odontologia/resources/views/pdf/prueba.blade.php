@extends('pdf.tutoMs')
@section('title','PACIENTE PDF')
@section('ver')
@foreach ($datos as $value)  
    <?php $folio=$value->folio;?>
    <?php $rfcPaciente=$value->rfcPaciente;?>
    <?php $claveServicio=$value->claveServicio;?>
    <?php $matricula=$value->matricula;?>
    <?php $cedula=$value->cedula;?>
    <?php $observacion=$value->observacion;?>
    <?php $precio=$value->precio;?>
    <?php $fecha=$value->fecha;?>
    <?php $hora=$value->hora;?>
	<?php
		$anio = substr($fecha,0,4); 
		$filtro = substr($fecha,5);
		$mes = substr($filtro,0,2); 
		$dia = substr($fecha,8); 
        
	?>
@endforeach
<div>
	<div class="form-row">
		<table >
			<tr>
				<th style="text-align: center;">
					<img style="width:20cm;" src="Imagenes/PDF/topimg.png">
					<div style="position:absolute;right:4.8cm;top:.6cm">{{$dia}}</div>
					<div style="position:absolute;right:3.7cm;top:.6cm">{{$mes}}</div>
					<div style="position:absolute;right:2.5cm;top:.6cm">{{$anio}}</div>
					<div style="position:absolute;right:0cm;top:.6cm;">{{$folio}}</div>

				</th>
			</tr>
		</table>	    
    </div>
	<div class="form-row">
		<table>
			<tr>
				<th style="text-align: right;"><label>NOMBRE COMPLETO DEL PACIENTE</label></th>
				<th style="border:gray solid;border-radius:10px;text-align:left;width:15cm;">
					<?php  $datos = DB::select('select * from personas where rfc="'.$rfcPaciente.'"; ');
					?>
					@foreach ($datos as $value)  
						<?php $nombres=$value->nombres;?>
						<?php $apPat=$value->apPat;?>
						<?php $apMat=$value->apMat;?>
					@endforeach
					{{$nombres.' '.$apPat.' '.$apMat}}	
				</th>
			</tr>
		</table>	    
    </div>
    <div class="form-row">
		<table>
			<tr>
				<th style="text-align: right;">&nbsp;<label>NOMBRE COMPLETO DEL ALUMNO</label></th>
				<th style="border:gray solid;border-radius:10px;width:11.4cm;text-align:left; ">
				<?php  $datos = DB::select('select * from alumnos inner join personas on alumnos.rfc=personas.rfc and matricula="'.$matricula.'";');?>
				@foreach ($datos as $value)  
					<?php $nombres=$value->nombres;?>
					<?php $apPat=$value->apPat;?>
					<?php $apMat=$value->apMat;?>
					<?php $semestre=$value->semestre;?>
				@endforeach
				{{$nombres.' '.$apPat.' '.$apMat}}	
				</th>
				<th style="text-align: right;width:2cm"><label>SEMESTRE</label></th>
				<th style="border:gray solid;border-radius:10px;width:1cm;text-align:center; ">{{$semestre}}</th>
			</tr>
		</table>	    
    </div>
    <div class="form-row">
		<table>
			<tr>
				<th style="text-align: right;"><label>NOMBRE COMPLETO DEL PROFESOR</label></th>
				<th style="border:gray solid;border-radius:10px;width:15cm;text-align:left;">
				<?php  $datos = DB::select('select * from profesores inner join personas on profesores.rfc=personas.rfc and cedula="'.$cedula.'";');?>
				@foreach ($datos as $value)  
					<?php $nombres=$value->nombres;?>
					<?php $apPat=$value->apPat;?>
					<?php $apMat=$value->apMat;?>
				@endforeach
				{{$nombres.' '.$apPat.' '.$apMat}}	
				</th>
			</tr>
		</table>	    
    </div>
    <div class="form-row">
		<table>
			<tr>
				<th style="text-align:right; width:4.8cm"><label>TRATAMIENTO(S)</label></th>
				<th style="border:gray solid;border-radius:10px;width:11cm;text-align:left;height:2cm;">
				<?php  $datos = DB::select('select * from catalogoservicios where claveServicio="'.$claveServicio.'";');?>
					@foreach ($datos as $value)  
						<?php $nombreServicio=$value->nombreServicio;?>
						<?php $costo=$value->costo;?>
					@endforeach
					{{$nombreServicio}}
				</th>
				<th style="text-align: right;width:1cm"><label>COSTO</label></th>
				<th style="border:gray solid;border-radius:10px;width:2.2cm;text-align:center;">$ &nbsp; {{$costo}}</th>
			</tr>
		</table>	    
    </div>
    <div class="form-row">
		<table>
			<tr>
				<th style="text-align:right; width:4.8cm"><label>*TIPO DE BRACKETS</label></th>
				<th style="text-align: center;b">
					<img style="width:460px" src="Imagenes/PDF/botom.png">
				</th>
				<th style="text-align: center;">
					<img style="width:108px" src="Imagenes/PDF/botom2.png">
				</th>
			</tr>
		</table>	    
    </div>

</div>
@endsection