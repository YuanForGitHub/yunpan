@extends('base')

@section('header')
    @include('header')
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
<div id="content" class="col-sm-9 col-md-10">
    @if(empty($arr))
        <div class="alert alert-info" role="alert">没有对应文件</div>
    @else
        <table class="table table-bordered">
            <tr>
                <th>文件名</th>
                <th>大小</th>
                <th>上传时间</th>
                <th>操作</th>
            </tr>
            {{--  @foreach($arr as $val)
                <tr>
                    <td><a href="{{ action('FileController@downloadFile', $val) }}">{{ urldecode($val) }}</a></td>
                    <td><a href="{{ action('FileController@deleteFile', $val) }}" id="delete" onclick="javascript:return del();">删除</a></td>
            @endforeach  --}}
            @for($i=0; $i<sizeof($arr[0]); $i++)
                <tr>
                    <td><a href="{{ action('FileController@downloadFile', $arr[0][$i]) }}">{{ urldecode($arr[0][$i]) }}</a></td>
                    <td>{{ $arr[1][$i] }}
                    <td>{{ date('Y-m-d', $arr[2][$i]) }}
                    <td><a href="{{ action('FileController@deleteFile', $arr[0][$i]) }}" id="delete" onclick="javascript:return del();">删除</a></td>
                </tr>
            @endfor
        </table>
    @endif
</div>
@endsection