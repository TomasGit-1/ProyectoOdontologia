<?php
Route::get('/PacientePrincipal','controlPaciente@PacienteP');
Route::get('/Paciente','controlPaciente@Paciente');
Route::post('/Paciente/Insertar','controlPaciente@Insertar');
Route::post('/Paciente/Actualizar','controlPaciente@Actualizar');
Route::get('/PacienteLista','controlPaciente@Listar');
Route::get('/PacientePDF','controlPaciente@Pdf');
Route::get('/PDFP/{folio}','controlPaciente@Pdf');

Route::get('/HistoriaClinica','historiaClinica@HistoriaClinica');
Route::get('/UsuarioBuscar','historiaClinica@Buscar');
Route::post('/HistoriaInsertar','historiaClinica@Insertar');
Route::post('/HistoriaActualizar','historiaClinica@Actualizar');
Route::get('/HistoriaVer','historiaClinica@ver');
Route::get('/HistoriaLista','historiaClinica@Listar');
Route::get('/PDF/{rfc}','historiaClinica@Pdf');

Route::get('/','login@Inicio');
Route::post('/IniciarSesion','login@Iniciar');
Route::get('/cerrarSession','login@seTermino');
Route::get('/Pagos','pagos@pagosI');
Route::get('/UsuarioB','pagos@Buscar');
Route::post('/pagosIns','pagos@Insertar');
Route::get('/PagosLista','pagos@Tabla');
Route::get('/PDFPA/{folio}','pagos@Pdf');


Route::get('/prueba/{rfc}','controlPaciente@pdfPrueb');


