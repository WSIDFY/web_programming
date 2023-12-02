<?php include('functions.php') ?>       /<!--'functions.php'파일을 포함-->

<!DOCTYPE html>
<html>
<head>
        <title>Registration system PHP and MySQL</title>        <!--제목 설정-->
        <link rel="stylesheet" type="text/css" href="style.css">        <!--'stytle.css'파일을 불러와 적용(스타일 시트 링크)-->
</head>
<body>
        <div class="header">
                <h2>Login</h2>  <!--페이지 제목-->
        </div>
        <form method="post" action="login.php">         <!--로그인 폼의 데이터 전송 방식 : 'POST', 액션 : 'login.php'로 설정-->

                <?php echo display_error(); ?>          <!--오류 메시지 출력 함수 호출-->

                <div class="input-group">
                        <label>Username</label>
                        <input type="text" name="username" >    <!--사용자 명 입력 필드-->
                </div>
                <div class="input-group">
                        <label>Password</label>
                        <input type="password" name="password">         <!--암호 입력 필드-->
                </div>
                <div class="input-group">
                        <button type="submit" class="btn" name="login_btn">Login</button>       <!--로그인 버튼 생성-->
                </div>
                <p>
                        Not yet a member? <a href="register.php">Sign up</a>            <!--회원이 아닌 경우 회원가입 링크 제공-->
                </p>
        </form>
</body>
</html>