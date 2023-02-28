<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\AtendimentosController;
use App\Http\Controllers\AssistidosController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::controller(AtendimentosController::class)->group(function () {
    Route::get('/atendimentos', 'index')->name('atendimentos'); 
    Route::get('/atendimento', 'create')->name('atendimento.cadastrar');
    Route::get('/atendimento/{id}/editar', 'edit')->name('atendimento.editar');
    Route::get('/atendimento/{id}/detalhes', 'show')->name('atendimento.detalhes');


    Route::get('/atendimento/importar', 'importar')->name('atendimento.importar'); 
    Route::post('/atendimento', 'store')->name('atendimento.salvar'); 
    Route::post('/atendimento/salvar/{type}', 'cadastrar')->name('atendimento.novo.salvar');
});

Route::controller(AssistidosController::class)->group(function () {
    Route::get('/assistidas', 'index')->name('assistidas');   
    Route::get('/relatorios', 'create')->name('relatorios');  
});

require __DIR__.'/auth.php';
