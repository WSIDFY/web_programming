<?php 
include('../functions.php');    /*funcrtion.php파일 포함*/

if (!isAdmin())         /*현재 사용자가 관리자인지 확인하는 함수*/
{       
        $_SESSION['msg'] = "You must log in first";     /*사용자가 관리자가 아닌 경우 '세션에 메시지 저장'*/
        header('location: ../login.php');               /*사용자가 관리자가 아닌 경우 '로그인 페이지로 이동'*/
}

if (isset($_GET['logout']))     /*'logout'매개변수가 존재한다면 실행(사용자가 로그아웃을 요청했을 때)*/
{
        session_destroy();                      // 세션 파괴
        unset($_SESSION['user']);               // 사용자 정보 제거
        header("location: ../login.php");       // 로그인 페이지로 이동
}
?>

<!DOCTYPE html>
<html>
<head>  <!--HTML 문서의 기본 구조 정의 header-->
        <title>Home</title>     <!--페이지 제목 지정-->
        <link rel="stylesheet" type="text/css" href="../style.css">     <!--'style.css'외부 스타일 시트 링크-->
        <style>
        .header         /*클래스가 header인 요소들에 적용*/
        {
                background: #003366;
        }
        button[name=register_btn]       /*이름이 register_btn인 요소들에 적용*/
        {
                background: #003366;
        }
        </style>
</head>
<body>
        <div class="header">
                <h2>Admin - Home Page</h2>      <!--제목 설정-->
        </div>
        <div class="content">   <!--세션에서 받은 알림 메시지 출력 및 로그인 사용자의 정보 출력 세션을 포함한 content 클래스-->
               
                <!--알림 메시지-->
                <?php if (isset($_SESSION['success'])) : ?>
                        <div class="error success" >    <!--에러 메시지 출력 클래스-->
                                <h3>
                                        <?php 
                                                echo $_SESSION['success'];      /*세션에 'success'키가 설정되었을 때 메시지 출력*/
                                                unset($_SESSION['success']);    /*메시지 출력 후 세션에서 'success'키 제거*/
                                        ?>
                                </h3>
                        </div>
                <?php endif ?>

                <!--로그인한 사용자의 정보-->
                <div class="profile_info">
                        
                        <img src="images/admin.png">       <!--'admin'사용자 프로필 이미지 불러오기-->

                        <div>
                                <?php  if (isset($_SESSION['user'])) : ?>       <!--세션에 'user'키가 설정되어 있을 때 실행-->
                                        <strong><?php echo $_SESSION['user']['username']; ?></strong>   <!--사용자 이름 출력-->

                                        <small>
                                                <i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i>   <!--사용자의 유형 출력-->
                                                <br>
                                                <a href="home.php?logout='1'" style="color: red;">logout</a>    <!--'로그아웃' 링크 출력-->

                       &nbsp; <a href="create_user.php"> + add user</a>         <!--사용자 추가 링크 출력-->
                                        </small>

                                <?php endif ?>
                        </div>
                </div>
        </div>
</body>
</html>