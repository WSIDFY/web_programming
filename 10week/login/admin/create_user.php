<?php include('../functions.php') ?>    <!--스크립트에서 사용되는 함수를 포함한 function.php 파일 포함-->

<!DOCTYPE html>
<html>
<head>  <!--문서 구조 정의-->
        <title>Registration system PHP and MySQL - Create user</title>          <!--페이지 제목 지정-->

        <link rel="stylesheet" type="text/css" href="../style.css">     <!--'style.css'외부 스타일 시트 링크-->
        <style>
                .header         /*클래스가 header인 요소들에 적용*/
                {
                        background: #003366;    /*배경색 지정*/
                }
                button[name=register_btn]       /*이름이 register_btn인 요소들에 적용*/
                {
                        background: #003366;     /*배경색 지정*/
                }
        </style>
</head>

<body>
        <div class="header">    <!--header 클래스-->

                <h2>Admin - create user</h2>    <!--제목 지정-->
        </div>
        
        <form method="post" action="create_user.php">   <!--데이터 방식 : POST, 'create_user.php'페이지로 전송되도록 설정-->

                <?php echo display_error(); ?>          <!--오류 메시지 표시 함수 호출-->

                <div class="input-group">       <!--사용자의 정보를 확인하는 필드를 생성하는 input-group 클래스-->
                        <label>Username</label>
                        <input type="text" name="username" value="<?php echo $username; ?>">    <!--사용자 명 입력(새로운 사용자 명 입력)-->
                </div>
                <div class="input-group">
                        <label>Email</label>
                        <input type="email" name="email" value="<?php echo $email; ?>">         <!--이메일 주소 입력(새로은 이메일 주소 입력)-->
                </div>
                <div class="input-group">       <!--admin, user의 옵션을 포함한 사용자 유형을 선택하는 select를 포함-->
                        <label>User type</label>

                        <select name="user_type" id="user_type" >       <!--사용자 유형 선택 : 'Admin' or 'User'-->
                                <option value=""></option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                        </select>
                </div>
                <div class="input-group">
                        <label>Password</label>
                        <input type="password" name="password_1">       <!--새로운 암호 입력-->
                </div>
                <div class="input-group">
                        <label>Confirm password</label>
                        <input type="password" name="password_2">       <!--암호 확인을 위한 재입력-->
                </div>
                <div class="input-group">
                        <button type="submit" class="btn" name="register_btn"> + Create user</button>   <!--사용자 생성 버튼 생성-->
                </div>
        </form>
</body>
</html>