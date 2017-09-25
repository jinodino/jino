<?php
/**
 * Created by PhpStorm.
 * User: wdj
 * Date: 2017-09-18
 * Time: 오전 9:21
 */
    session_start();


    define("HOST", "localhost");      // 서버주소
    define("USER", "root");           // 사용자 계정
    define("PASSWORD", "autoset");    // 사용자 비밀번호
    define("DB_NAME", "ycj_test");    // 디비 이름
    define("TABLE_NAME", "son_board");  // 테이블 이름

    // 데이터 베이스 연결
    @$db_con = mysql_connect(HOST, USER, PASSWORD);

    $db_con = mysql_select_db('ycj_test');


    $user_id   = $_SESSION['id'];               // 유저 아이디
    $user_name = $_SESSION['name'];             // 유저 네임
    $title     = $_GET['title'];                // 제목
    $contents = $_GET['contents'];              // 글 내용
    $reg_date   = date('Y-m-d H:i:s');    // 시간

    $real_contents = htmlspecialchars($contents);
    $query = "insert into ".TABLE_NAME." (user_id, user_name, subject, contents, reg_date) values";
    $query .= "('$user_id', '$user_name', '$title', '$real_contents', '$reg_date')";

    mysql_query($query);

    echo "<script>location.assign('login_board.php')</script>";

    ?>
