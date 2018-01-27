<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    //
    public function index(){
        return view('index');
    }

    public function uploadFile(Request $request){
        if($request->isMethod('POST')){
            $file = $request->file('homework');
            if($file->isValid()){
                $name = $file->getClientOriginalName();
                $path = $file->getRealPath();
               
                $file->storeAs('public/homeworkFiles', $name);
                return 'ok';
            }
        }
    }

    public function showFile(){
        $file = Storage::files('public/homeworkFiles');
        $str = '';
        foreach($file as $val){
            $fileName = str_after($val, 'homeworkFiles/');
            $str .= '<a href="download/'.$fileName.'">'.$fileName.'</a>';
            $str .= '<br>';
        }
        return $str;
    }

    public function downloadFile($fileName="10.jpg"){
        // $fileName = '10.jpg';
        return response()->download(storage_path('app/public/homeworkFiles/'.$fileName));
    }
}
