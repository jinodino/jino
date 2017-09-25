<?php
/**
 * Created by PhpStorm.
 * User: wdj
 * Date: 2017-09-13
 * Time: 오후 12:42
 */
define("HOST", "localhost");      // 서버주소
define("USER", "root");           // 사용자 계정
define("PASSWORD", "autoset");    // 사용자 비밀번호
define("DB_NAME", "ycj_test");    // 디비 이름
define("TABLE_NAME", "son_board");  // 테이블 이름

// 데이터 베이스 연결
@$db_con = mysql_connect(HOST, USER, PASSWORD);


$db_con = mysql_select_db('ycj_test');



$query  = "CREATE TABLE son_board(";
$query .= "board_id int(10) auto_increment not null,";
$query .= "board_pid int(10) not null default 0,";
$query .= "user_id varchar(20) not null,";
$query .= "user_name varchar(20) not null,";
$query .= "subject varchar(50) not null,";
$query .= "contents text not null,";
$query .= "hits int(10) not null default 0,";
$query .= "reg_date datetime not null,";
$query .= "primary key (board_id),";
$query .= "key board_pid (board_pid))";

$db_con = mysql_query($query);



?>