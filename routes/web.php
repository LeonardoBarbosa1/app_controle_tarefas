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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource("tarefa", "App\Http\Controllers\TarefaController");

Route::get('mensagem-teste', function(){
    return new MensagemTesteMail;
    // Mail::to('leonardobarbosadossantos44@gmail.com')->send(new MensagemTesteMail());
    // return 'Email enviado com sucesso!';
});