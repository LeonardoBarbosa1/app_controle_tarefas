<?php

use App\Mail\MensagemTesteMail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['verify'=>true]);

Auth::routes();

//Verificação de email
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')
// ->middleware('verified');

Route::get('tarefa/exportacao/{extencao}', "App\Http\Controllers\TarefaController@exportacao" )->name('tarefa.exportacao');
Route::get('tarefa/exportar', "App\Http\Controllers\TarefaController@exportar" )->name('tarefa.exportar');

Route::resource("tarefa", "App\Http\Controllers\TarefaController")->middleware('verified');

Route::get('mensagem-teste', function(){
    return new MensagemTesteMail;
    // Mail::to('leonardobarbosadossantos44@gmail.com')->send(new MensagemTesteMail());
    // return 'Email enviado com sucesso!';
});

Route::fallback(function(){
    return view('erro-url');
});