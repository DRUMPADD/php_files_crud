<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function add_department(Request $request) {
        $dep = new Department();

        $dep->name = $request->input('department');

        $dep->save();

        return redirect()->to('/usuario');
    }
    
    public function add_department_user(Request $request) {
        $user = DB::table('users');

        $user->where('email', auth()->user()->email)->update(['dep_id' => $request->get('dep')]);

        return redirect()->to('/usuario');
    }
}
