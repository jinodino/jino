<?php
session_start();


define("HOST", "localhost");      // 서버주소
define("USER", "root");           // 사용자 계정
define("PASSWORD", "autoset");    // 사용자 비밀번호
define("DB_NAME", "ycj_test");    // 디비 이름
define("TABLE_NAME", "son_board");  // 테이블 이름

// 데이터 베이스 연결
@$db_con = mysql_connect(HOST, USER, PASSWORD);


$db_con = mysql_select_db('ycj_test');
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
<form action = 'change_load.php' method="GET">
    <table class="table table-bordered">
        <tr>
            <td colspan="2">
                <center><h1>글 쓰기</h1></center>
            </td>
        </tr>
        <tr>
            <td align="center" colspan="3">
                <mark>
                    <strong>제목 :
                        <?php
                        $change = $_GET['change']; // 글 번호
                        $query = "select subject from son_board where board_id ='$change'";
                        $result = mysql_query($query);
                        if($result == true){
                            $row_num = mysql_num_rows($result);
                            for($i = 0 ; $i < $row_num; $i++){
                                $result_array = mysql_fetch_array($result);
                                echo $result_array['subject'];
                            }
                        }
                        ?>
                    </strong>
                </mark>
                <?php
                    $change = $_GET['change']; // 글 번호
                    echo "<input type = 'hidden' name = 'change' value = '$change'>"
                ?>
            </td>
        </tr>
        <tbody>
        <td>
            <textarea class="form-control" rows="30" name = contents><?php
                $change = $_GET['change']; // 글 번호
                $query = "select contents from son_board where board_id ='$change'";
                $result = mysql_query($query);
                if($result == true){
                    $row_num = mysql_num_rows($result);
                    for($i = 0 ; $i < $row_num; $i++){
                        $result_array = mysql_fetch_array($result);
                        echo $result_array['contents'];
                    }
                }?></textarea>
        </td>
        </tbody>
        <tr>
            <td align="right">
                <button type="button" class="btn btn-warning btn-lg" onclick='returnpage()'>취소하기</button>
                <button type="submit" class="btn btn-primary btn-lg ">수정</button>
            </td>
        </tr>
    </table>
</form>
</body>
</html>

