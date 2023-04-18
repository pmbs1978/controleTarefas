<?php

use Illuminate\Support\Facades\Route;
use App\Mail\MensagemTesteMail;

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
    return view('bem-vindo');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
// Route::resource('tarefa', 'App\Http\Controllers\TarefaController')->middleware('auth');
Route::get('tarefa/exportar', [App\Http\Controllers\TarefaController::class, 'exportar'])->name('tarefa.exportar')->middleware('verified');
// importante tem de estar antes de resouce
Route::resource('tarefa', 'App\Http\Controllers\TarefaController')->middleware('verified');
Route::resource('account', 'App\Http\Controllers\AccountController')->middleware('verified');


Route::get('mensagem-teste', function(){
    return new MensagemTesteMail();
    // Mail::to('pedro.miguel.bs@gmail.com')->send(new MensagemTesteMail());
    // return 'Mensagem enviada com sucesso';
});

