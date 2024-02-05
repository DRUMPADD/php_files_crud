<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilesRequest;
use App\Models\FilesModel;
use Illuminate\Http\Request;
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
    }*/
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
    }
}
