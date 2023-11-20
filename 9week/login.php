<!DOCTYPE html>
<html lang="en">

<head>
    <title>계정 정보</title>
</head>

<body>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")     // 폼에서 이메일과 패스워드 가져오기
{
    $email = $_POST["email"];
    $password = $_POST["password"];

    // 입력된 이메일과 패스워드 출력
    echo "<h2>계정 정보</h2>";
    echo "<p>이메일 : " . htmlspecialchars($email) . "</p>";
    echo "<p>패스워드 : " . htmlspecialchars($password) . "</p>";
} 
else     // 폼이 제출되지 않았을 때 오류 메시지 출력
{
    echo "<p>Error: Form not submitted.</p>";
}

?>

</body>
</html>
