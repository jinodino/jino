<?php
    /*여기 검색어 찾기 해야함 스위치 문 써가지고 읏샤읏샤*/
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

<html>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Title</title>
    <link href='css/bootstrap.min.css' rel='stylesheet'>
</head>
<script>
    function page_up() {
        var max = <?php
            @$select = $_GET['select'];
            @$findtext   = $_GET['text'];

            @$view = $_GET['next'];
            if(isset($view)){

            }else {
                @$view = 1;
            }
            @$view_count = (($view - 1) * 5);
            switch ($select){
                case '제목':
                    $query  = "select * from ". TABLE_NAME ." where subject like '%$findtext%' AND board_pid = 0 order by reg_date";
                    //$result = mysql_query($query);

                    break;
                case '내용':
                    $query  = "select * from ". TABLE_NAME ." where contents like '%$findtext%' AND board_pid = 0 order by reg_date";
                    //$result = mysql_query($query);

                    break;
                case '제목+내용':
                    $query  = "select * from son_board where contents like '%$findtext%' OR subject like '%$findtext%' AND board_pid = 0 order by reg_date";
                    //$result = mysql_query($query);

                    break;
                case '선택해주세요':
                    echo "<script>alert('카테고리를 선택하세요')</script>";

                    if($check == FALSE){
                        echo "<script>location.assign('board.php')</script>";
                    }else{

                        echo "<script>location.assign('login_board.php')</script>";
                    }
                    break;
                default:
                    $query  = "select * from son_board where contents like '%$findtext%' OR subject like '%$findtext%' AND board_pid = 0 order by reg_date";
                    break;
            }
            $result = mysql_query($query);

            $count = mysql_num_rows($result);

            $row_count = ceil($count / 5);

            echo $row_count;
        ?>;



        location.assign('kakunin.php?select=<?php
            $select = $_GET['select'];
            echo $select;
            ?>&text=<?php
                @$findtext   = $_GET['text'];
                echo $findtext;
                ?>&next=' + max + '&page_check=' + max);



    }

    function page_down() {

        location.assign('kakunin.php?select=<?php
                $select = $_GET['select'];
                echo $select;
                ?>&text=<?php
                @$findtext   = $_GET['text'];
                echo $findtext;
                ?>&next=' + 1 + '&page_check=' + 1);
    }

    function page(value) {
        var pn = value;

        if(pn <= 3){
        pn = 3;
        }else {
        pn = value;
        }

        location.assign('kakunin.php?select=<?php
            $select = $_GET['select'];
            echo $select;
            ?>&text=<?php
            @$findtext   = $_GET['text'];
            echo $findtext;
            ?>&next=' + value + '&page_check=' + pn);
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

<?php






    // 확인 부분에서는 로그인 유무에 따라 분리해줘야한다
    // 그래야지 한 페이지 안에서 다 끝낼 수 있기 때문

    // 로그인 유무 변수
    $check = isset($_SESSION['id']) ? $_SESSION['id'] : FALSE;

    //echo $check;

    // 옵션 선택 변수
    $select = $_GET['select'];
    @$findtext   = $_GET['text'];

    @$view = $_GET['next'];
    if(isset($view)){

    }else {
        @$view = 1;
    }





    @$view_count = (($view - 1) * 5);

    switch ($select){
        case '제목':
            $query  = "select * from ". TABLE_NAME ." where subject like '%$findtext%' AND board_pid = 0 order by reg_date desc limit $view_count, 5";
            $result = mysql_query($query);

            break;
        case '내용':
            $query  = "select * from ". TABLE_NAME ." where contents like '%$findtext%' AND board_pid = 0 order by reg_date desc limit $view_count, 5";
            $result = mysql_query($query);

            break;
        case '제목+내용':
            $query  = "select * from son_board where contents like '%$findtext%' OR subject like '%$findtext%' AND board_pid = 0 order by reg_date desc limit $view_count, 5";
            $result = mysql_query($query);

            break;
        case '선택해주세요':
            echo "<script>alert('카테고리를 선택하세요')</script>";

            if($check == FALSE){
                echo "<script>location.assign('board.php')</script>";
            }else{

                echo "<script>location.assign('login_board.php')</script>";
            }
            break;
        default:
            $query  = "select * from son_board where contents like '%$findtext%' OR subject like '%$findtext%' AND board_pid = 0 order by reg_date desc limit $view_count, 5";
            $result = mysql_query($query);
            break;
    }

    if($check == FALSE){
                echo "
        <style>
                body {
                    width : 800px;
                margin : auto;
            }
        </style>
        <script>
            function returntoboard() {
              location.assign('board.php');
            }
        </script>
        <body>
        <div><center><h2>진호 게시판</h2></center></div>
            <center>
                <div class='row'>
                    <div class='col-md-1'></div>
                    <div class='col-md-1'></div>
                    <div class='col-md-1'></div>
                    <div class='col-md-1'></div>
                    <div class='col-md-1'></div>
                    <div class='col-md-1'></div>
                    <div class='col-md-1'></div>
                    <div class='col-md-1'></div>
                    <div class='col-md-1'></div>
                    <div class='col-md-1'>
                    <form action = 'login.html' method='GET'>
                        <input class='btn btn-default' type='submit' value='로그인'>
                    </form>
                    </div>
                    <div class='col-md-1'>
                    <button class='btn btn-info' onclick='returntoboard()'>돌아가기</button>
                    </div>
                </div>
                
                <table class='table table-striped'>
                    <tr align='center'>
                        <td><strong>번호</strong></td>
                        <td><strong>제목</strong></td>
                        <td><strong>작성자</strong></td>
                        <td><strong>조회수</strong></td>
                        <td><strong>작성일</strong></td>
                    </tr>";

                    if($result == true) {
                        while ($row = mysql_fetch_array($result)) {
                            echo "<tr align='center'>";
                            echo "<td>$row[board_id]</td>";
                            echo "<td><a href='read.php?title=$row[subject]&id=$row[user_name]&date=$row[reg_date]&hit=$row[hits]&list=$row[board_id]'>$row[subject]</a></td>";
                            echo "<td>$row[user_name] </td>";
                            echo "<td>$row[hits] </td>";
                            echo "<td>$row[reg_date] </td>";
                            echo "</tr>";
                        }
                    }
    }else {
        echo "
            <script>
                function logout() {
                    alert('로그아웃 되었습니다.');
                    location.assign('board.php');
                }
                
        
                function returntoboard() {
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
            <div><center><h2>진호 게시판</h2></center></div>
            <center>
                <div>
                    <form>";

        echo "<a href = '#'>".$_SESSION['name']."</a>님이 로그인 되었습니다.";

        echo "</form>
            <form action = 'join.html' method='GET'>
                <input class='btn btn-warning' type='button' value='로그아웃' onclick='logout()'>
            </form>
            </div>
            </center>
            <div class='row'>
                    <div class='col-md-1'></div>
                    <div class='col-md-1'></div>
                    <div class='col-md-1'></div>
                    <div class='col-md-1'></div>
                    <div class='col-md-1'></div>
                    <div class='col-md-1'></div>
                    <div class='col-md-1'></div>
                    <div class='col-md-1'></div>
                    <div class='col-md-1'></div>
                    <div class='col-md-1'>
                    <form action = 'write.php' method='GET'>
                        <input class='btn btn-success' type='submit' value='글쓰기'>
                    </form> 
                     
                    </div>

                    <div class='col-md-1'>
                    <button class='btn btn-info' onclick='returntoboard()'>돌아가기</button>
                    </div>
                <!--글 쓰기 목록-->
                <table class='table table-striped'>
                    <tr align='center'>
                        <td><strong>번호</strong></td>
                        <td><strong>제목</strong></td>
                        <td><strong>작성자</strong></td>
                        <td><strong>조회수</strong></td>
                        <td><strong>작성일</strong></td>
                    </tr>";

        if($result == true) {
            while ($row = mysql_fetch_array($result)) {
                echo "<tr align='center'>";
                echo "<td>$row[board_id]</td>";
                echo "<td><a href='login_read.php?title=$row[subject]&id=$row[user_name]&date=$row[reg_date]&hit=$row[hits]&list=$row[board_id]'>$row[subject]</a></td>";
                echo "<td>$row[user_name] </td>";
                echo "<td>$row[hits] </td>";
                echo "<td>$row[reg_date] </td>";
                echo "</tr>";
            }
        }
    }

?>
</table>
<div class="row">
    <center>
        <button type='button' class='btn btn-info btn-sm' onclick='page_down()'><</button>
        <?php

        @$select = $_GET['select'];
        @$findtext   = $_GET['text'];
        @$view = $_GET['next'];
        if(isset($view)){

        }else {
            @$view = 1;
        }
        switch ($select){
            case '제목':
                $query  = "select * from ". TABLE_NAME ." where subject like '%$findtext%' AND board_pid = 0 order by reg_date";
                break;
            case '내용':
                $query  = "select * from ". TABLE_NAME ." where contents like '%$findtext%' AND board_pid = 0 order by reg_date";
                break;
            case '제목+내용':
                $query  = "select * from son_board where contents like '%$findtext%' OR subject like '%$findtext%' AND board_pid = 0 order by reg_date";
                break;
            case '선택해주세요':
                echo "<script>alert('카테고리를 선택하세요')</script>";

                if($check == FALSE){
                    echo "<script>location.assign('board.php')</script>";
                }else{

                    echo "<script>location.assign('login_board.php')</script>";
                }
                break;
            default:
                $query  = "select * from son_board where contents like '%$findtext%' OR subject like '%$findtext%' AND board_pid = 0 order by reg_date";
                break;
        }

        $result = mysql_query($query);

        $count = mysql_num_rows($result);

        $row_count = ceil($count / 5);
        @$pn = $_GET['page_check'];
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


