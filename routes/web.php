<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/inicio', function () {
    return view('inicio');
})->middleware(['auth', 'verified'])->name('inicio');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios');
    Route::get('/usuarios/lista', [UserController::class, 'list'])->name('usuarios.list');
    Route::get('/usuarios/{user}', [UserController::class, 'show'])->name('usuarios.show');
    Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');
    Route::put('/usuarios/{user}', [UserController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{user}', [UserController::class, 'destroy'])->name('usuarios.destroy');

    Route::get('/proyectos', [ProyectoController::class, 'index'])->name('proyectos.index');
    Route::get('/proyectos/lista', [ProyectoController::class, 'list'])->name('proyectos.list');
    Route::get('/proyectos/informe', [ProyectoController::class, 'report'])->name('proyectos.report');
    Route::post('/proyectos', [ProyectoController::class, 'store'])->name('proyectos.store');

    Route::get('/proyectos/duracion/{user}', [TareaController::class, 'list'])->name('tareas.list');
    Route::post('/proyectos/nueva_tarea', [TareaController::class, 'store'])->name('tareas.store');
});

require __DIR__ . '/auth.php';
