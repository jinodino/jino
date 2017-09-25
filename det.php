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

$det = $_GET['det'];                // 댓글 내용
$log_name = $_GET['login_name'];    // 댓글 작성자
$page = $_GET['honbango'];          // 댓글달 글 번호
$reg_date   = date('Y-m-d H:i:s');

$query = "insert into ".TABLE_NAME." (board_pid, user_id, user_name, contents, reg_date) values";
$query .= "('$page', '$_SESSION[id]' , '$_SESSION[id]', '$det', '$reg_date')";
mysql_query($query);

$query = "select * from " . TABLE_NAME . " where board_pid = '$page' order by reg_date desc";
$result = mysql_query($query);
echo "<tr>
            <td class='col-md-11'>
                <input type='text' class='form-control' id='det' name = 'det' placeholder='댓글을 입력하세요..'>
                <input type=\"button\" name = 'login_name' hidden>
                <input type=\"button\" name = 'honbango' hidden>
            </td>
            <td class='col-md-1'>
                <center>
                    <button type='button' class='btn btn-default' onclick='ajax()'>댓글작성</button>
                </center>
            </td>
        </tr>";
if($result == true){
    $row_num = mysql_num_rows($result);
    for($i = 0 ; $i < $row_num; $i++){
        $result_array = mysql_fetch_array($result);
        $result_content = $result_array['contents'];
        $result_name = $result_array['user_name'];
        $now_time = $result_array['reg_date'];
        echo "<tr>
            <td class='row'>
                <button type = 'button' class='btn btn-link'><h4><kbd>$result_name : $result_content</kbd></h4></button>
                <button type = 'text' class='btn btn-link'>$now_time</button>";
        if($_SESSION['name'] == $result_name) {
            echo"<button type='button' class = 'btn btn-link' value = '$now_time' onclick='detdel(value)'><h4><kbd>&times;</kbd></h4></button>";
        }
        echo "</td>
            <td>
            
            </td>
        </tr>";
    }
};

?>