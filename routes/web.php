<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CreditTypeModelController;
use App\Http\Controllers\DocumentosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});



// CRUD COMPLETO PARA DOCUMENTOS
Route::get('documentos', [DocumentosController::class, 'index'])->name('documentos.index');
Route::post('documentos/store', [DocumentosController::class, 'store'])->name('documentos.store');
Route::get('documentos/{id}/edit', [DocumentosController::class, 'show'])->name('documentos.edit');
Route::put('documentos/{id}/update', [DocumentosController::class, 'update'])->name('documentos.update');
Route::delete('documentos/{id}/delete', [DocumentosController::class, 'destroy'])->name('documentos.destroy');


// RUTA PARA TIPO DE CREDITO
Route::get('catalogo-tipos-creditos', [CreditTypeModelController::class, 'index'])->name('credit-type.index');
Route::post('/credit-type/store', [CreditTypeModelController::class, 'store'])->name('credit-type.store');
Route::post('/credit-type/{id}/documents', [CreditTypeModelController::class, 'showDocuments']);
Route::put('/credit-type/{id}', [CreditTypeModelController::class, 'update'])->name('creditType.update');
Route::delete('/credit-type/{id}', [CreditTypeModelController::class, 'destroy'])->name('creditType.destroy');



// CRUD CLIENTES 

Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/clientes/store', [ClienteController::class, 'store'])->name('clientes.store');

