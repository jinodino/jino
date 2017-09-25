<?php
    session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script
            src="https://code.jquery.com/jquery-3.2.1.js"
            integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
            crossorigin="anonymous">

    </script>
</head>
<script>
    function returnpage() {
        location.assign('login_board.php');
    }
</script>
<style>
    body {
        width: 800px;
        margin: auto;
    }
</style>
<body>
<form action = 'write_load.php' method="GET">
<table class="table table-bordered">
    <tr>
        <td colspan="2">
            <center><h1>글 쓰기</h1></center>
        </td>
    </tr>
    <tr>
        <td>
            <label for="title" class="col-sm-1 control-label">제목</label>
            <div class="col-sm-11">
                <input type="text" class="form-control" id="title" placeholder="제목을 입력해주세요" name = 'title'>
            </div>
        </td>
    </tr>
    <tbody>
        <td>
            <textarea class="form-control" rows="30" name = contents>

            </textarea>
        </td>
    </tbody>
    <tr>
        <td align="right">
            <button type="button" class="btn btn-warning btn-lg" onclick='returnpage()'>취소하기</button>
            <button type="submit" class="btn btn-primary  btn-lg ">작성하기</button>
        </td>
    </tr>
</table>
</form>
</body>
</html>
