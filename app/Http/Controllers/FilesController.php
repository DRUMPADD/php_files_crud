<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilesRequest;
use App\Models\FilesHistory;
use App\Models\FilesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FilesController extends Controller
{
    //

    /* $ext =File::extension($file);
    if($ext=='pdf'){
        $content_types='application/pdf';
    }else if ($ext=='doc') {
            $content_types='application/msword';  
    }else if ($ext=='docx') {
        $content_types='application/vnd.openxmlformats-officedocument.wordprocessingml.document';  
    }else if ($ext=='xls') {
        $content_types='application/vnd.ms-excel';  
    }else if ($ext=='xlsx') {
        $content_types='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';  
    }else if ($ext=='txt') {
        $content_types='application/octet-stream';  
    }
    public function show() {
        $files = FilesModel::all();
        return view('Index')->with(['files'=> $files]);
    }

    public function checkFileExists(string $filename) {
        $files = DB::table('files')->where('nombre', 'like', "{$filename}%")->get();
        return $files;
    }

    public function create(FilesRequest $request) {
        $validated = $request->file('archivo');

        $urlUploadPath = "upload";

        $fileModel = new FilesModel;
        if(count($this->checkFileExists($validated->getClientOriginalName())) > 0) {
            echo "File already exists";
            return;
        }
        $fileModel->create(['nombre' => $validated->getClientOriginalName(), 'archivo' => $validated->getSize()]);

        if($fileModel) {
            if(count($this->checkFileExists($validated->getClientOriginalName())) > 0) {
                if($validated->move($urlUploadPath, $validated->getClientOriginalName()."-".count($this->checkFileExists($validated->getClientOriginalName())))) {
                    return redirect("/archivos");
                } else {
                    echo "Failed to upload file";
                }
            } else {
                if($validated->move($urlUploadPath, $validated->getClientOriginalName())) {
                    return redirect("/archivos");
                } else {
                    echo "Failed to upload file";
                }
            }
        } else {
            echo "Failed to upload file";
        }
    }

    public function update(int $id_file, FilesRequest $request) {
        $validate = $request->file();
        $fileModel = new FilesModel;
        $fileModel->update(['archivo' => $validate->getSize(), 'nombre' => $validate->getClientOriginalName()], ['id_file' => $id_file]);

        return redirect('/archivos');
    }*/

    public function index() {
        return view('home.files');
    }

    public function uploadFile() {
        return view('home.files');
    }

    public function store(Request $request) {
        $data = new FilesModel();
        $file = $request->file;
        $filename = time().$file->getClientOriginalName();

        $request->file->move('assets/uploads', $filename);
        $data->name = $filename;
        $data->duenio = auth()->id();
        $data->extension = $file->getClientOriginalExtension();
        $data->save();
        $this->add_history(Auth::user(), $data, 1);
        return redirect()->route('list_files');
    }

    private function add_history($user, $file, $option, $filename = null) {
        $history = new FilesHistory();

        $history->file_id = $file->id;
        $history->user_id = $user->id;
        if($option == 1) {
            $history->description = $user->name." ha registrado el archivo ".$file->name;
        } else if ($option == 2) {
            $history->description = $user->name." ha modificado el archivo ".$filename." por ".$file->name;
        } else {
            $history->description = $user->name." ha eliminado el archivo ".$file->name;
        }

        $history->save();
    }

    public function show() {
        $data = FilesModel::all();
        return view('home.showFiles', compact('data'));
    }

    public function download($file) {
        return response()->download(public_path('assets/uploads/'.$file));
    }

    public function view($id) {
        $data = FilesModel::find($id);
        $history = FilesHistory::all()->where('file_id', $id);
        return view('home.viewFile')->with(['data' => $data, 'history' => $history]);
    }

    public function modifyFile(Request $request) {
        $file_name_before = DB::table('files')->where($request->get('id'))->value('name');
        $current_owner = DB::table('files')->where($request->get('id'))->value('duenio');
        $file = $request->file('file');
        $filename = time().$file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();
        $file->move(public_path().'/assets/uploads/', $filename);
        DB::table('files')->where('id', (int) $request->get('file_id'))->update(['name' => $filename, 'extension' => $ext, 'duenio' => $current_owner]);
        $file_info = DB::table('files')->where('id', (int) $request->get('file_id'))->first();
        $this->add_history(Auth::user(), $file_info, 2, $file_name_before);

        return redirect()->route('view_file', [$request->get("file_id")]);
    }
}
