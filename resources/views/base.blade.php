<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <title>Document</title>
    <style>
        #menu,
        #content {
            padding-left: 0%;
            padding-right: 0%;
        }
        body, html{
            height: 100%;
        }
        #menu {
            background-color: #F5F5F5;
            height: 87%;
            /* border: 1px solid lightgray; */
        }
        @media screen and (max-width: 730px){
            #menu{
                display: none;
            }
        }
    </style>
</head>

<body>
    {{--  头部  --}}
    @yield('header')

    <!-- 菜单 -->
    @yield('menu')

    {{--  显示内容  --}}
    @yield('content')

</body>

<script src="{{ asset('bootstrap/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script>
    $(function(){
        $("#fileButton").click(function(){
            $("#file").trigger("click");
            $("#file").on("change", function(){
                $("#submit").trigger("click");
                alert('上传成功~');
            })
        })
    })
    function del(){
        var msg = "确认删除该文件？";
        if(confirm(msg)==true){
            return true;
        }
        else{
            return false;
        }
    }
</script>

</html>