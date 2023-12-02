<?php 
        include('functions.php');       // 'function.php' 파일을 포함

        if (!isLoggedIn())      // 사용자가 로그인 되지 않은 경우 실행
        {
            $_SESSION['msg'] = "You must log in first";         // 세션에 메시지 설정
            header('location: login.php');              // 로그인 페이지로 리다이렉션
        }
?>

<!DOCTYPE html>
<html>
<head>
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="style.css">        <!--스타일 시트 링크-->
</head>
<body>
        <div class="header">
                <h2>Home Page</h2>
        </div>
        <div class="content">
                <!-- 알림 메시지 -->
                <?php 
                if (isset($_SESSION['success'])) :   // 세션에 성공 메시지가 있을 때 실행
                ?>
                        <div class="error success" >
                                <h3>
                                        <?php 
                                                echo $_SESSION['success'];      // 세션에 저장된 성공 메시지 출력
                                                unset($_SESSION['success']);    // 세션의 성공 메시지 제거
                                        ?>
                                </h3>
                        </div>
                <?php endif ?>
                <!-- 로그인된 사용자의 정보 -->
                <div class="profile_info">
                        <img src="images/user.png"  >   <!--사용자의 이미지 표시-->
                        
                        <div>
                                <?php  
                                if (isset($_SESSION['user'])) : // 세션에 사용자가 있을 때 실행
                                ?>
                                        <strong><?php echo $_SESSION['user']['username']; ?></strong>   <!--사용자 명, 유형 출력-->

                                        <small>
                                                <i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
                                                <br>
                                                <a href="index.php?logout='1'" style="color: red;">logout</a>   <!--로그아웃 링크 제공-->
                                        </small>

                                <?php endif ?>
                        </div>
                </div>
        </div>
</body>
</html>