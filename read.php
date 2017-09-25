<?php
/**
 * 글 보기
 */

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
        location.assign('board.php');
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
            <td colspan="3">
                <center><h1>글 보기</h1></center>
            </td>
        </tr>
        <tr>
            <td align="center" colspan="3">
                <mark>
                    <strong>제목 :
                        <?php
                        $title = $_GET['title']; // 글 제목
                        echo $title;
                        ?>
                    </strong>
                </mark>
            </td>
        </tr>
        <tr>
            <td align="center">
                <strong>작성자 :
                    <?php
                    $id    = $_GET['id'];    // 글 작성자
                    echo $id;
                    ?>
                </strong>
            </td>
            <td align="center">
                <strong>조회수 :
                    <?php
                    $hit   = $_GET['hit'];  // 조회수
                    echo $hit;
                    ?>
                </strong>
            </td>
            <td align="center">
                <strong>날짜 :
                    <?php
                    $date  = $_GET['date'];  // 글 작성날
                    echo $date;
                    ?>
                </strong>
            </td>
        </tr>
        <tbody>
        <td colspan="3">
            <?php
            // 여기 글 출력 해야해 진호야 알겠찌
            $list = $_GET['list']; // 글 제목
            $query = "select contents from son_board where board_id ='$list'";
            $result = mysql_query($query);
            if($result == true){
                $row_num = mysql_num_rows($result);
                for($i = 0 ; $i < $row_num; $i++){
                    $result_array = mysql_fetch_array($result);
                    echo "<pre>";
                    echo $result_array['contents'];
                    echo "</pre>";
                }
            }
            ?>
        </td>
        </tbody>
        <tr>
            <td align="right" colspan="3">
                <button type="button" class="btn btn-info btn-lg" onclick='returnpage()'>목록으로</button>
            </td>
        </tr>
    </table>
    <!--댓글 작성란-->
    <table class="table table-striped" id = 'det_table'>
        <?php
        include 'detup.php';
        ?>
    </table>
</form>
</body>
</html>

