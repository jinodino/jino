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
<!--로그인 후 메인 페이지-->
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<script>
    function logout() {
        alert('로그아웃 되었습니다.');
        location.assign('board.php');
    }

    function page_up() {
        var max = (<?php
            @$view = $_GET['next']; // 페이지 번호
            $query = "select * from son_board where board_pid = 0 order by reg_date";

            $result = mysql_query($query);

            $count = mysql_num_rows($result);

            // 끝값
            $row_count = ceil($count / 5);
            // 페이지 끝값 유지
            if($view >= $row_count){
                $view = $row_count - 1;
            }
            echo $row_count;
            ?>);
        location.assign('login_board.php?next=' + max + '&page_check=' + max);
    }

    function page_down() {
        location.assign('login_board.php?next=' + 1 + '&page_check=' + 3);
        var max = (<?php
            @$view = $_GET['next']; // 페이지 번호
            $query = "select * from son_board where board_pid = 0 order by reg_date";

            $result = mysql_query($query);

            $count = mysql_num_rows($result);

            // 끝값
            $row_count = ceil($count / 5);
            // 페이지 끝값 유지
            if($view >= $row_count){
                $view = $row_count - 1;
            }

            $view = 3;
            echo $row_count;
            ?>);
        //location.assign('login_board.php?next=<?php
        @$view = $_GET['next']; // 페이지 번호
        // 페이지 처음값 유지
        if($view <= 1){
            $view = 2;
        }

        //echo 3;
        ?>
        ');
    }

    function page(value) {
        var pn = value;

        if(pn <= 3){
            pn = 3;
        }else {
            pn = value;
        }

        location.assign('login_board.php?next=' + value + '&page_check=' + pn);
        /*location.assign('login_board.php?next=' + value + '&page_check=' +

                /*if(isset($_GET['next'])){
                    $page_check = $_GET['next'];
                }else {
                    $page_check = 3;
                }
                if($page_check < 3){
                    $page_check = 3;
                }
                echo $page_check;*/

    }
</script>
<style>
    body {
        width: 800px;
        margin: auto;
    }
</style>
<body>
<div><center><h2>진호 게시판</h2></center></div>
<center>
    <div>
        <form>
            <?php
            /**
             * Created by PhpStorm.
             * User: wdj
             * Date: 2017-09-18
             * Time: 오전 5:43
             */
            echo "<a href = '#'>".$_SESSION['name']."</a>".'님이 로그인 되었습니다.';
            ?>
        </form>
        <form action = 'join.html' method='GET'>
            <input class="btn btn-warning" type='button' value='로그아웃' onclick='logout()'>
        </form>
    </div>
</center>
<div class="row">
    <div align="right">
        <form action = 'write.php' method='GET'>
            <input class="btn btn-info" type='submit' value='글 쓰기'>
        </form>
</div>

<!--글 쓰기 목록-->
<table class="table table-hover">
    <tr align="center">
        <td><strong>번호</strong></td>
        <td><strong>제목</strong></td>
        <td><strong>작성자</strong></td>
        <td><strong>조회수</strong></td>
        <td><strong>작성일</strong></td>
    </tr>
    <?php
        // $query = "select * from son_board where board_pid = 0 order by reg_date desc limit $view_count, 5";
        @$view = $_GET['next'];
        if(isset($view)){

        }else {
            @$view = 1;
        }





        @$view_count = (($view - 1) * 5);
        @$query = "select * from son_board where board_pid = 0 order by reg_date desc limit $view_count, 5";
        $result = mysql_query($query);

        if (@$result == true) {
            while ($row = mysql_fetch_array($result)) {
                echo "<tr align='center'>";
                echo "<td> $row[board_id]</td>";
                echo "<td><a href='login_read.php?title=$row[subject]&id=$row[user_name]&date=$row[reg_date]&hit=$row[hits]&list=$row[board_id]'>$row[subject]</a></td>";
                echo "<td> $row[user_name] </td>";
                echo "<td> $row[hits] </td>";
                echo "<td> $row[reg_date] </td>";
                echo "</tr>";
            }
        }
    ?>
</table>

    <!--페이지네이션-->
    <div class="row">
        <center>
            <button type='button' class='btn btn-info btn-sm' onclick='page_down()'><</button>
            <?php
            $query = "select * from son_board where board_pid = 0 order by reg_date";

            $result = mysql_query($query);

            $count = mysql_num_rows($result);

            $row_count = ceil($count / 5);

            if($row_count <= 5){
                $first = 1;
            }else {
                @$pn = $_GET['page_check'];
                if(isset($pn)){
                    // 값에 따라 한칸식 밀려가게 하는것 페이지 네이션
                    $first = $pn - 2;   // 기준점을 두고 처음
                    $last = $pn;
                    $teann = $row_count; // 페이지의 끝부분
                    $row_count = $pn + 2;
                    if($row_count > $teann){
                        $row_count = $teann;
                    }
                    if($last >= $row_count - 2){
                        $last = $row_count - 2;
                        $first = $last - 2;
                    }
                }else {
                    $pn = 3;
                    $first = $pn - 2;   // 기준점을 두고 처음
                    $row_count = 5;
                }
            }


            for($i = $first; $i <= $row_count; $i++){
                if($view == $i){
                    echo "<button type='button' class='btn btn-primary btn-sm active' onclick='page(value)' value='$i'>$i</button>";
                }else {
                    echo "<button type='button' class='btn btn-default btn-sm' onclick='page(value)' value='$i'>$i</button>";
                }

            }

            ?>
            <button type='button' class='btn btn-info btn-sm' onclick='page_up()'>></button>
        </center>
    </div>
<br>
    <!--페이지네이션-->
    <!--검색 기능-->
    <form action = 'kakunin.php' method="GET">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-3" align="right">
            <select class="form-control" cols="3px" name = 'select'>
                <option>선택해주세요</option>
                <option>제목</option>
                <option>내용</option>
                <option>제목+내용</option>
            </select>
        </div>
        <div class="col-md-5">
            <input type="text" class="form-control" placeholder="입력하세요" name = 'text'>
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-default">확인</button>
        </div>
    </div>
    </form>
</body>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: wdj
 * Date: 2017-09-12
 * Time: 오후 3:29
 */
?>
