<?php

    define("HOST", "localhost");      // 서버주소
    define("USER", "root");           // 사용자 계정
    define("PASSWORD", "autoset");    // 사용자 비밀번호
    define("DB_NAME", "ycj_test");    // 디비 이름
    define("TABLE_NAME", "son_board");  // 테이블 이름

    // 데이터 베이스 연결
    @$db_con = mysql_connect(HOST, USER, PASSWORD);


    $db_con = mysql_select_db('ycj_test');

    $contents = $_GET['contents'];  // 글 내용
    $change = $_GET['change'];    // 글 번호


    $query = "update " . TABLE_NAME . " set contents ='$contents' where board_id='$change'";


    mysql_query($query);

    echo "<script>
                alert('글이 수정되었습니다.');
                location.assign('login_board.php')
        </script>";
?>