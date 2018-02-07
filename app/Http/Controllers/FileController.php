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

    private function encode($str){
        if(!isset($str)){
            return;
        }
        // 双重转换，防止空格和加号混淆
        $str = urlencode($str);
        $str = urlencode($str);
        return $str;
    }

    private function decode($str){
        if(!isset($str)){
            return;
        }
        $str = urldecode($str);
        $str = urldecode($str);
        return $str;
    }

    private function judge($name){
        $array = Storage::files('public/homeworkFiles');
        if(in_array(('public/homeworkFiles/'.$name), $array)){
            $name = $this->decode($name);
            $name = '('.date('y/m/d').')'.$name;
            $name = $this->encode($name);
        }
        return $name;
    }

    public function uploadFile(Request $request){
        if($request->isMethod('POST')){
            $file = $request->file('homework');
            if($file->isValid()){
                $name = $file->getClientOriginalName();
                $path = $file->getRealPath();

                // 编码转换
                $name = $this->encode($name);

                // 判断是否有重复文件
                $name = $this->judge($name);
                // return var_dump($name);
                
                // 保存文件
                $file->storeAs('public/homeworkFiles', $name);
                Storage::setVisibility('public/homeworkFiles/'.$name, 'public');
            }
        }
        return redirect('show/all');
    }

    public function showFile($type=''){
        $arr = [];
        $names = [];
        $sizes = [];
        $time = [];
        $file = Storage::files('public/homeworkFiles');
        if($type=='' || $type=='all'){
            foreach($file as $val){
                $fileName = str_after($val, 'homeworkFiles/');
                $names[] = $fileName;
                $sizes[] = $this->exchange(Storage::size($val));
                $time[] = Storage::lastModified($val);
            }
        }
        elseif($type=='text'){
            foreach($file as $val){
                $fileName = str_after($val, 'homeworkFiles/');
                $mime = str_after($fileName, '.');
                if($mime=='txt' || $mime=='doc' || $mime=='docx' || $mime=='xlxs' || $mime=='xls' || $mime=='pdf'){
                    $names[] = $fileName;
                    $sizes[] = $this->exchange(Storage::size($val));
                    $time[] = Storage::lastModified($val);
                }
            }
        }
        elseif($type=='pic'){
            foreach($file as $val){
                $fileName = str_after($val, 'homeworkFiles/');
                $mime = str_after($fileName, '.');
                if($mime=='jpg' || $mime=='jpeg' || $mime=='png' || $mime=='gif'){
                    $names[] = $fileName;
                    $sizes[] = $this->exchange(Storage::size($val));
                    $time[] = Storage::lastModified($val);
                }
            }
        }
        elseif($type=='compress'){
            foreach($file as $val){
                $fileName = str_after($val, 'homeworkFiles/');
                $mime = str_after($fileName, '.');
                if($mime=='zip' || $mime=='rar'){
                    $names[] = $fileName;
                    $sizes[] = $this->exchange(Storage::size($val));
                    $time[] = Storage::lastModified($val);
                }
            }
        }
        elseif($type=='music'){
            foreach($file as $val){
                $fileName = str_after($val, 'homeworkFiles/');
                $mime = str_after($fileName, '.');
                if($mime=='mp3'){
                    $names[] = $fileName;
                    $sizes[] = $this->exchange(Storage::size($val));
                    $time[] = Storage::lastModified($val);
                }
            }
        }
        $arr = [$names, $sizes, $time];
        return view('show', compact('arr'));
    }

    private function exchange($size=0){
        if($size<1024){
            return $size.'B';
        }
        elseif($size<1024*1204){
            return ceil($size/1024).'KB';
        }
        elseif($size<1024*1024*1024){
            return ceil($size/1024/1024).'M';
        }
        else{
            return '6爆了，我居然不知道多大？！';
        }
    }

    public function downloadFile($fileName=''){
        // $fileName = '10.jpg';
        if($fileName==''){
            return 'nothing';
        }
        $fileName = urlencode($fileName);
        return response()->download(storage_path('app/public/homeworkFiles/'.$fileName), urldecode(urldecode($fileName)));
    }

    public function deleteFile($fileName=''){
        if($fileName==''){
            return 'nothing';
        }
        $fileName = urlencode($fileName);
        $result = Storage::delete('public/homeworkFiles/'.$fileName);
        // dd($result);
        return redirect('show/all');
    }
}
