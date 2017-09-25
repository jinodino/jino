<?php
/**
 * Created by PhpStorm.
 * User: wdj
 * Date: 2017-09-12
 * Time: 오후 3:40
 */
    // 아이디 값과 비밀번호 값
    $id = $_GET['id'];
    $pw = $_GET['pw'];

    // 아이디와 비밀번호를 관리하는 DB생성
    define("HOST", "localhost");      // 서버주소
    define("USER", "root");           // 사용자 계정
    define("PASSWORD", "autoset");    // 사용자 비밀번호
    define("DB_NAME", "ycj_test");    // 디비 이름
    define("TABLE_NAME", "login");  // 테이블 이름

    // 데이터 베이스 연결
    @mysql_connect(HOST, USER, PASSWORD);

    mysql_select_db(DB_NAME);

    // 로그인 할 때 마다 디비에 저장
    $query   = "select * from " . TABLE_NAME . " where id= '$id'";
    $login_check = false; // 로그인 체크
    if($result = mysql_query($query)){
        $sql_num_rows = mysql_num_rows($result);
        // DB에 아이디가 없을 경우
        if($sql_num_rows == 0){
            echo "<script>alert('아이디와 비밀번호를 확인해주세요')</script>";
            echo "<script>location.assign('login.html');</script>";
        }
        // 아이디가 있는 경우 비밀번호로 유효성 확인
        else {
            $query = "select * from " . TABLE_NAME . " where pw = '$pw'";
            if($result = mysql_query($query)){
                $sql_num_rows = mysql_num_rows($result);
                // 비밀번호가 틀린 경우
                if($sql_num_rows == 0) {
                    echo "<script>alert('비밀번호가 맞지 않습니다.')</script>";
                    echo "<script>location.assign('login.html');</script>";
                }
                // 비밀번호가 맞는 경우
                else {
                    // 세션 시작
                    @session_start();
                    // 로그인 체크 true
                    $login_check = true;
                    $_SESSION['id']   = $id;
                    $_SESSION['pw']   = $pw;
                    $_SESSION['check'] = true;
                    $_SESSION['name'] = $id;
                    echo "<script>alert('로그인 되었습니다.')</script>";
                    echo "<script>location.assign('login_board.php')</script>";
                    }
                }
            }
        }

?>

