<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\TableController;
use App\Http\Controllers\Site\FormController;
use App\Http\Controllers\Site\UserController;
use App\Http\Controllers\Site\IniController;
use App\Http\Controllers\Site\ProcessosController;
use App\Http\Controllers\Site\PasswordExpiryController;
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

Route::namespace('Site')->group(function() {

    Route::get('/', [IniController::class, 'index'])->name('auth.login')->middleware('auth');//rota da página inicial

    // Rotas da tabela
    Route::get('table', [TableController::class, 'index'])->name('site.table')->middleware('auth');//rota da página da tabela
    Route::get('site/table/search', [TableController::class, 'search'])->name('site.table.search')->middleware('auth');//rota da tabela após pesquisa
    Route::put('/table/{id}/update', [TableController::class, 'update'])->name('site.table.update')->middleware('auth');
    Route::delete('/table/{collab}', [TableController::class, 'destroy'])->name('site.table.destroy')->middleware('auth');
    Route::put('/table/{id}/edit-page', [TableController::class, 'edit'])->name('site.table.edit')->middleware('auth');
    Route::get('/table/{id}/show', [TableController::class, 'show'])->name('site.table.show')->middleware('auth');

    // Rotas dos processo/index
    Route::get('processos', [ProcessosController::class, 'index'])->name('processos')->middleware('auth');
    Route::post('processos', [ProcessosController::class, 'processoForm'])->name('processos.post')->middleware('auth');
    Route::get('processos/{collaboratorId}/form', [ProcessosController::class, 'showProcessoForm'])->name('processos.form')->middleware('auth');
    Route::put('processos/{id}/update', [ProcessosController::class, 'update'])->name('site.processos.update')->middleware('auth');
    Route::put('/table/{id}/list', [ProcessosController::class, 'listProcessos'])->name('site.processos.list')->middleware('auth');
    Route::put('/processos/{id}/{pid}/edit', [ProcessosController::class, 'edit'])->name('site.processos.edit')->middleware('auth');
    Route::delete('/processos/{id}', [ProcessosController::class, 'destroy'])->name('site.processos.destroy')->middleware('auth');
    Route::get('/processos/search/{collab_id?}', [ProcessosController::class, 'search'])->name('site.processos.search')->middleware('auth');

    // Rotas do formulario
    Route::get('formulario', [FormController::class, 'index'])->name('site.formulario')->middleware('auth');//rota da página de formulário
    Route::post('formulario', [FormController::class, 'formulario'])->name('site.formulario.post')->middleware('auth');
    Route::get('formulario', [FormController::class, 'exibirFormulario'])->name('site.formulario')->middleware('auth');
    //método do formulário
    
    // Rotas do usuário
    Route::get('usuarios', [UserController::class, 'index'])->name('site.usuarios')->middleware('auth');
    Route::get('/usuarios/search', [UserController::class, 'search'])->name('site.usuarios.search')->middleware('auth');
    Route::delete('/usuarios/{users}', [UserController::class, 'destroy'])->name('site.usuarios.destroy')->middleware('auth');
    Route::put('/usuarios/{id}/edit', [UserController::class, 'edit'])->name('site.usuarios.edit')->middleware('auth');
    Route::put('/usuarios/{id}/update', [UserController::class, 'update'])->name('site.usuarios.update')->middleware('auth');

    //Rota dashboard
    Route::get('/dashboard', [TableController::class, 'dash'])->name('dashboard')->middleware('auth');
    Route::post('/login', [PasswordExpiryController::class, 'store'])->name('login');
    Route::get('/reset-password/{token}/{email}', [PasswordExpiryController::class, 'showResetForm'])->name('password.reset');
});


// Route::get('/dashboard', [ContadorRegistrosController::class, 'index'])->name('site.dashboard')->middleware('auth');

// Rotas de login e logout do livewire
// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('site.dashboard');
// });

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->middleware('auth')->name('logout');
