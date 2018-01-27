<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Document</title>
    <style>
        #menu,
        #content {
            padding-left: 0%;
            padding-right: 0%;
        }

        #menu {
            background-color: #F5F5F5;
            /* border: 1px solid lightgray; */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="col-md-4 pull-left">
                <ul class="nav navbar-nav">
                    <li>
                        <a style="color:white;" href="#">网络部网盘</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-1 pull-right">
                <ul class="nav navbar-nav">
                    <li>
                        <a id="fileButton" class="btn btn-default" href="#">上传文件</a>
                        <form class="hidden" action="upload" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="file" name="homework" id="file">
                            <input type="submit" value="上传文件" id="submit">
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- 菜单 -->
    <div id="menu" class="sidebar col-sm-3 col-md-2">
        <ul class="nav nav-sidebar">
            <li class="active">
                <a href="">全部</a>
            </li>
            <li>
                <a href="">文本</a>
            </li>
            <li>
                <a href="">图片</a>
            </li>
            <li>
                <a href="">视频</a>
            </li>
            <li>
                <a href="">音乐</a>
            </li>
        </ul>
    </div>
    <div id="content" class="col-sm-9 col-md-10">
        <table class="table table-bordered">
            <tr>
                <th>文件名</th>
                <th>操作</th>
            </tr>
            <tr>
                <td>10.jpg</td>
                <td>删除</td>
            </tr>
        </table>
    </div>
</body>

<script src="bootstrap/js/jquery-3.2.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script>
    $(function(){
        $("#fileButton").click(function(){
            $("#file").trigger("click");
            $("#file").on("change", function(){
                $("#submit").trigger("click");
            })
        })
    })
</script>

</html>