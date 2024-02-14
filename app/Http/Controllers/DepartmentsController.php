<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DepartmentsController extends Controller
{
    //
    public function show() {
        return Department::all();
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

        $department = new Department();

        $department->nombre = $data["nombre"];
        $department->descripcion = $data["descripcion"];
        $department->save();

        session()->flash('success', 'Departamento creado con éxito');
    }
    public function update(Department $department) {
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
    public function delete(Department $department) {
        return $department->delete();
    }
}
