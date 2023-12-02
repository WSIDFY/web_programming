<?php include('functions.php') ?>       <!--'function.php'파일을 포함-->
<!DOCTYPE html>
<html>
<head>
        <title>Registration system PHP and MySQL</title>        <!--페이지 제목 설정-->
        <link rel="stylesheet" href="style.css">                <!--'style.css'적용(스타일 시트 링크)-->

</head>
<body>
<div class="header">
        <h2>Register</h2>       <!--제목 설정-->
</div>
<form method="post" action="register.php">      <!--데이터는 POST방식, 'register.php'로 설정-->

<?php echo display_error(); ?>          <!--오류 메시지 출력-->
        <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" value="<?php echo $username; ?>">    <!--사용자 명 입력 부분-->
        </div>
        <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $email; ?>">         <!--이메일 주소 입력 부분-->
        </div>
        <div class="input-group">
                <label>Password</label>
                <input type="password" name="password_1">               <!--암호 입력 부분(암호가 보이지 않도록 'password'형식 지정-->
        </div>
        <div class="input-group">
                <label>Confirm password</label>
                <input type="password" name="password_2">               <!--암호 재입력 부분(암호가 보이지 않도록 'password'형식 지정-->
        </div>
        <div class="input-group">
                <button type="submit" class="btn" name="register_btn">Register</button>         <!--회원가입 버튼 생성-->
        </div>
        <p>
                Already a member? <a href="login.php">Sign in</a>       <!--이미 회원인 경우 로그인 페이지 링크 제공-->
        </p>
</form>
</body>
</html>