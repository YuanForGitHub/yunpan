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
                        <form class="hidden" action="{{ url('upload') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="file" name="homework" id="file">
                            <input type="submit" value="上传文件" id="submit">
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>