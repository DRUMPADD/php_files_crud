<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\UserController;
use App\Models\DepartmentModel;
use App\Http\Middleware\Authenticate;
use App\Models\Department;
use App\Models\FilesModel;
use Illuminate\Support\Facades\DB;
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
Route::get('/usuario', function () {
    $deps = Department::all();
    $user = DB::table('users')->join('departments', 'users.dep_id', '=', 'departments.id')->select('departments.*')->get()->first();
    return view('user.user')->with(['deps' => $deps, 'user_info' => $user]);
})->middleware(Authenticate::class)->name('user');
Route::post('/iniciar_sesion', [UserController::class, 'login'])->name("login_user");
Route::get('/cerrar_sesion', [UserController::class, 'logout'])->name("logout_user");
Route::post('/registrar', [UserController::class, 'register'])->name("signup_user");

Route::post('/agregar_dep', [Controller::class, 'add_department'])->middleware(Authenticate::class)->name("add_dep");
Route::post('/agregar_dep_usuario', [Controller::class, 'add_department_user'])->middleware(Authenticate::class)->name("add_dep_user");


// Files
Route::get('/archivo', [FilesController::class, 'index'])->middleware(Authenticate::class)->name("files");
Route::post('/subir_archivo', [FilesController::class, 'store'])->middleware(Authenticate::class)->name('upload_file');
Route::get('/archivos', [FilesController::class, 'show'])->middleware(Authenticate::class)->name('list_files');
Route::get('/descargar/{file}', [FilesController::class, 'download'])->middleware(Authenticate::class)->name('download_files');
Route::get('/ver_archivo/{id}', [FilesController::class, 'view'])->middleware(Authenticate::class)->name('view_file');
Route::post('/modificar_archivo', [FilesController::class, 'modifyFile'])->middleware(Authenticate::class)->name('update_file');
