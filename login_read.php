<?php
/**
 * 글 보기
 */
    session_start();


    define("HOST", "localhost");      // 서버주소
    define("USER", "root");           // 사용자 계정
    define("PASSWORD", "autoset");    // 사용자 비밀번호
    define("DB_NAME", "ycj_test");    // 디비 이름
    define("TABLE_NAME", "son_board");  // 테이블 이름

    // 데이터 베이스 연결
    @$db_con = mysql_connect(HOST, USER, PASSWORD);


    $db_con = mysql_select_db(DB_NAME);



?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script>
        src="https://code.jquery.com/jquery-3.2.1.js";
        integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=";
        crossorigin="anonymous";
    </script>
</head>
<script>
    function returnpage() {
        location.assign('login_board.php');
    }

    function ajax() {
        var xmlReqObj = new XMLHttpRequest();
        var dettextObj = document.getElementById('det');
        var dettableObj = document.getElementById('det_table');
        var url = 'det.php?det=' + dettextObj.value + '&login_name= + <?php
            echo $_SESSION['name'];
            ?>' + '&honbango=<?php
            $list = $_GET['list']; // 글 번호
            echo $list;
            ?>'; // URL주소 GET형식
        xmlReqObj.onreadystatechange = function () {
            if (xmlReqObj.readyState == 4 && xmlReqObj.status == 200) {
                dettableObj.innerHTML = xmlReqObj.responseText;
            }
        }

        xmlReqObj.open("GET", url, true);
        xmlReqObj.send();
    }

    function detdel(value) {
        var xmlReqObj = new XMLHttpRequest();
        var dettableObj = document.getElementById('det_table');
        var url = 'detdel.php?dettime=' + value  + '&honbango=<?php
                $list = $_GET['list']; // 글 번호
                echo $list;
                ?>'; // URL주소 GET형식
        xmlReqObj.onreadystatechange = function () {
            if (xmlReqObj.readyState == 4 && xmlReqObj.status == 200) {
                dettableObj.innerHTML = xmlReqObj.responseText;
            }
        }

        xmlReqObj.open("GET", url, true);
        xmlReqObj.send();
    }

</script>
<style>
    body {
        width: 800px;
        margin: auto;
    }
</style>
<body>
    <table class="table table-bordered">
        <tr>
            <td colspan="12">
                <center><h1>글 보기</h1></center>
            </td>
        </tr>
        <tr>
            <td align="center" colspan="12">
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
        <td colspan="12">
            <?php
            // 여기 글 출력 해야해 진호야 알겠찌
            $list = $_GET['list']; // 글 번호
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
            <td align="right" colspan="12">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-1">
                        <?php
                        if($id == $_SESSION['id']) {
                            echo "<form action = 'delete.php' method='GET'>";

                            /*수정하기 부분*/
                            $list = $_GET['list']; // 글 번호
                            echo "<button type='submit' class='btn btn-danger' value='$list' name='delete'>삭제</button>
                            
                            </form>";
                        }
                        ?>
                    </div>
                    <div class="col-md-1">
                        <!--<form action = 'change.php' method="GET">
                            //<?php
/*                           /*수정하기 부분*/
                            //$list = $_GET['list']; // 글 번호
                            //echo "<button type='submit' class='btn btn-warning' name='change' value = '$list'>수정</button>";
                            //?>
                        </form>-->

                        <?php
                        if($id == $_SESSION['id']) {
                            echo "<form action = 'change.php' method='GET'>";

                            /*수정하기 부분*/
                            $list = $_GET['list']; // 글 번호
                            echo "<button type='submit' class='btn btn-warning' name='change' value = '$list'>수정</button>
                            
                            </form>";
                        }
                        ?>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-info" onclick='returnpage()'>목록으로</button>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <!--댓글 작성란-->
    <table class="table table-striped" id = 'det_table'>
        <?php
         include 'detup.php';
        ?>
    </table>
</body>
</html>





