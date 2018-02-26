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
        .pages{
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

    {{--  翻页按钮  --}}
    <div class="text-center">
        <div class="btn-group pages" role="group"  data-toggle="buttons">
        </div>
    </div>

</body>

<script src="{{ asset('bootstrap/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script>
    $(function(){
        var $tr = $("tr");
        var per = 10; //每页数目
        var total = $("table").children().children().length-1;
        createBtn();
        turnPage();
        uploadFile();

        function uploadFile(){
            $("#fileButton").click(function(){
                $("#file").trigger("click");
                $("#file").on("change", function(){
                    $("#submit").trigger("click");
                    alert('准备上传，请稍等（完成后页面会自动刷新）');
                })
            })
        }
        function createBtn(){
            var len = Math.ceil(total/per);
            for(var i=1; i<=len; i++){
                var text = '<label class="btn btn-default"><input type="radio" name="options">'+i+'</label>';
                $(".pages").append(text);
            }
            hidePage();
            showPage(0);
            $(".pages .btn").eq(0).addClass("active");
        }
        function hidePage(){
            // $tr.css("display", "none");
            $tr.hide();
        }
        function showPage(start){
            var start = arguments[0] ? arguments[0]:1;
            var end = start*per;
            // $tr.eq(0).css("display", "table-row");
            $tr.eq(0).show();

            start = (start-1)*per+1;
            end = ((total-end)>=0) ? end:total;
            for(var i=start; i<=end; i++){
                $tr.eq(i).show();
            }
        }
        function turnPage(){
            $(".pages .btn").click(function(){
                var page = $(this).index()+1;
                hidePage();
                showPage(page);
            })
        }
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