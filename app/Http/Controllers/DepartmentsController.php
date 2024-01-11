<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DepartmentModel;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DepartmentsController extends Controller
{
    //
    public function show() {
        return DepartmentModel::all();
    }
    public function create() {
        try {
            $this->validate(request(), [
                'nombre' => ['required'],
            ]);
        }catch(ValidationException $e) {
            return 'El nombre es requerido.';
        }

        $data = request()->all();

        $department = new DepartmentModel();

        $department->nombre = $data["nombre"];
        $department->descripcion = $data["descripcion"];
        $department->save();

        session()->flash('success', 'Departamento creado con éxito');
    }
    public function update(DepartmentModel $department) {
        try {
            $this->validate(request(), [
                'nombre' => ['required'],
            ]);
        }catch(ValidationException $e) {
            return 'El nombre es requerido.';
        }

        $data = request()->all();

        $department->nombre = $data["nombre"];
        $department->descripcion = $data["descripcion"];
        $department->save();

        session()->flash('success', 'Departamento creado con éxito');

        return redirect()->to('/archivos');
    }
    public function delete(DepartmentModel $department) {
        return $department->delete();
    }
}
