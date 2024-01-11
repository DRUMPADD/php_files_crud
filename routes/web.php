<?php

use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\FilesController;
use App\Models\DepartmentModel;
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
    return view('accounts.login');
});
Route::get('/registro', function () {
    return view('accounts.signup');
});

Route::get('/archivos', [FilesController::class, 'show']);
Route::post('/archivo', [FilesController::class, 'create']);

Route::get('/departamentos', [DepartmentsController::class, 'show']);
Route::post('/departamento', [DepartmentsController::class, 'create']);
Route::post('/actualizar_departamento/{department}', [DepartmentsController::class, 'update']);
Route::get('/eliminar_departamento/{department}', [DepartmentsController::class, 'delete']);