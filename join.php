<?php
// 아이디와 비밀번호를 관리하는 DB생성

define("HOST", "localhost");      // 서버주소
define("USER", "root");           // 사용자 계정
define("PASSWORD", "autoset");    // 사용자 비밀번호
define("DB_NAME", "ycj_test");    // 디비 이름
define("TABLE_NAME", "login");  // 테이블 이름

// 데이터 베이스 연결
@$db_con = mysql_connect(HOST, USER, PASSWORD);


$db_con = mysql_select_db('ycj_test');


$user_id = $_GET['id'];
$user_pw = $_GET['pw'];


/*$query  = "create table login (";
$query .= "id varchar(20) not null,";
$query .= "pw varchar(20) not null,";
$query .= "primary key (id))";
$result = mysql_query($query);*/


//로그인 할 때 마다 디비에 저장
$query = "insert into login (id, pw) values ('$user_id', '$user_pw')";
$result = mysql_query($query);


// 아이디가 없을 경우 있을 경우
if($result){
    echo "1";
}else {
    echo "2";

}
?>

