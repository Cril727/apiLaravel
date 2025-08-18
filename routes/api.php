<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\PrestamosController;
use App\Http\Controllers\ParticipacionesController;
use App\Http\Controllers\ActividadController;  
use App\Http\Controllers\AsociadoController;
use App\Models\Asociado;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Routes Asociados
Route::get('listarAsociados',[AsociadoController::class, 'index']);
Route::post('crearAsociado',[AsociadoController::class, 'store']);
Route::get('asociado/{id}',[AsociadoController::class, 'show']);
Route::put('actualizarAsociado/{id}',[AsociadoController::class, 'update']);
Route::delete('eliminarAsociado/{id}',[AsociadoController::class, 'destroy']);


//Routes Prestamos
Route::get('listarPrestamos',[PrestamosController::class, 'index']);
Route::post('crearPrestamo',[PrestamosController::class, 'store']);
Route::get('prestamo/{id}',[PrestamosController::class, 'show']);   
Route::put('actualizarPrestamo/{id}',[PrestamosController::class, 'update']);
Route::delete('eliminarPrestamo/{id}',[PrestamosController::class, 'destroy']);


//Routes Pagos
Route::get('listarPagos',[PagosController::class, 'index']);
Route::post('crearPago',[PagosController::class, 'store']);
Route::get('pago/{id}',[PagosController::class, 'show']);
Route::put('actualizarPago/{id}',[PagosController::class, 'update']);
Route::delete('eliminarPago/{id}',[PagosController::class, 'destroy']); 


//Routes Actividades
Route::get('listarActividades',[ActividadController::class, 'index']);
Route::post('crearActividad',[ActividadController::class, 'store']);
Route::get('actividad/{id}',[ActividadController::class, 'show']);
Route::put('actualizarActividad/{id}',[ActividadController::class, 'update']);
Route::delete('eliminarActividad/{id}',[ActividadController::class, 'destroy']);


//Routes Participaciones
Route::get('listarParticipaciones',[ParticipacionesController::class, 'index']);
Route::post('crearParticipacion',[ParticipacionesController::class, 'store']);
Route::get('participacion/{id}',[ParticipacionesController::class, 'show']);
Route::put('actualizarParticipacion/{id}',[ParticipacionesController::class, 'update']);
Route::delete('eliminarParticipacion/{id}',[ParticipacionesController::class,'destroy']);