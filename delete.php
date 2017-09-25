<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<script>
    function re() {
        alert("글이 삭제 되었습니다.");
        location.assign("login_board.php");
    }
</script>

<body onload="re()">
<?php
/**
 * Created by PhpStorm.
 * User: wdj
 * Date: 2017-09-19
 * Time: 오후 7:13
 */
    define("HOST", "localhost");      // 서버주소
    define("USER", "root");           // 사용자 계정
    define("PASSWORD", "autoset");    // 사용자 비밀번호
    define("DB_NAME", "ycj_test");    // 디비 이름
    define("TABLE_NAME", "son_board");  // 테이블 이름

    // 데이터 베이스 연결
    @$db_con = mysql_connect(HOST, USER, PASSWORD);


    $db_con = mysql_select_db('ycj_test');

    $list = $_GET['delete']; // 글 번호


    $query = "delete from " . TABLE_NAME . " WHERE board_id = '$list'";

    $result = mysql_query($query);
?>
</body>
</html>


