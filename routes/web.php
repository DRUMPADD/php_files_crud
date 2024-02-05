<?php

use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\UserController;
use App\Models\DepartmentModel;
use App\Http\Middleware\Authenticate;
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

Route::get('/', [UserController::class, 'show'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::post('/login_user', [UserController::class, 'login']);

Route::post('/register_user', [UserController::class, 'register']);

Route::get('/archivos', [FilesController::class, 'show'])->middleware(Authenticate::class)->name('files');
Route::post('/archivo', [FilesController::class, 'create'])->middleware(Authenticate::class)->name('files');
Route::post('/modificar_archivo', [FilesController::class, 'update'])->middleware(Authenticate::class)->name('files');

Route::get('/departamentos', [DepartmentsController::class, 'show']);
Route::post('/departamento', [DepartmentsController::class, 'create']);
Route::post('/actualizar_departamento/{department}', [DepartmentsController::class, 'update'])->middleware(Authenticate::class)->name('department');
Route::get('/eliminar_departamento/{department}', [DepartmentsController::class, 'delete'])->middleware(Authenticate::class)->name('department');