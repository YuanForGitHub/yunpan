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
                $time = '('.date('Y-m-d').')';
                $name = $time.$file->getClientOriginalName();
                $path = $file->getRealPath();

                $file->storeAs('public/homeworkFiles', $name);
                Storage::setVisibility('public/homeworkFiles/'.$name, 'public');
            }
        }
        return redirect('show/all');
    }

    public function showFile($type=''){
        // $file = Storage::files('public/homeworkFiles');
        // $str = '';
        // foreach($file as $val){
        //     $fileName = str_after($val, 'homeworkFiles/');
        //     $str .= '<a href="download/'.$fileName.'">'.$fileName.'</a>';
        //     $str .= '--'.'<a href="delete/'.$fileName.'">删除</a>';
        //     $str .= '<br>';
        // }
        // return $str;
        $arr = [];
        $file = Storage::files('public/homeworkFiles');
        if($type=='' || $type=='all'){
            foreach($file as $val){
                $fileName = str_after($val, 'homeworkFiles/');
                $arr[] = $fileName;
            }
        }
        elseif($type=='text'){
            foreach($file as $val){
                $fileName = str_after($val, 'homeworkFiles/');
                $mime = str_after($fileName, '.');
                if($mime=='txt' || $mime=='doc' || $mime=='docx' || $mime=='xlxs' || $mime=='xls' || $mime=='pdf'){
                    $arr[] = $fileName;
                }
            }
        }
        elseif($type=='pic'){
            foreach($file as $val){
                $fileName = str_after($val, 'homeworkFiles/');
                $mime = str_after($fileName, '.');
                if($mime=='jpg' || $mime=='jpeg' || $mime=='png' || $mime=='gif'){
                    $arr[] = $fileName;
                }
            }
        }
        elseif($type=='video'){
            foreach($file as $val){
                $fileName = str_after($val, 'homeworkFiles/');
                $mime = str_after($fileName, '.');
                if($mime=='mp4' || $mime=='avi'){
                    $arr[] = $fileName;
                }
            }
        }
        elseif($type=='music'){
            foreach($file as $val){
                $fileName = str_after($val, 'homeworkFiles/');
                $mime = str_after($fileName, '.');
                if($mime=='mp3'){
                    $arr[] = $fileName;
                }
            }
        }
        return view('show', compact('arr'));
    }

    public function downloadFile($fileName=''){
        // $fileName = '10.jpg';
        if($fileName==''){
            return 'nothing';
        }
        return response()->download(storage_path('app/public/homeworkFiles/'.$fileName));
    }

    public function deleteFile($fileName=''){
        if($fileName==''){
            return 'nothing';
        }
        $result = Storage::delete('public/homeworkFiles/'.$fileName);
        // dd($result);
        return redirect('show/all');
    }
}
