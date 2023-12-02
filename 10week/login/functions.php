<?php 
session_start();        /*세션 시작*/

$db = mysqli_connect('localhost', 'root', '', 'multi_login');   // 'mysqli'데이터베이스 연결

// 변수 선언
$username = "";         // 사용자의 이름 저장 변수
$email    = "";         // 사용자의 이메일 저장 변수
$errors   = array();    // 배열 선언(오류를 담는 용도)

// 'register_btn'이 클릭 되었을 때 'register()'함수 호출
if (isset($_POST['register_btn']))      // 'register_btn'이 클릭되었는지 확인
{
        register();                     // 'register()'함수 호출
}

// 사용자 등록 함수
function register()                     // 사용자의 등록을 처리하는 'register' 함수
{
        // 함수 내에서 사용할 변수들을 전역 변수로 선언
        global $db, $errors, $username, $email;         //함수 내에서 사용할 변수들을 전역 변수로 선언

        // 폼에서 모든 입력 값을 받아오고 값을 escape하기 위해 e() 함수를 호출
        
        // 아래에 정의된 e()함수를 사용하여 폼 값들을 escape(폼에서 받아온 사용자 정보의 입력 값 저장)
        $username    =  e($_POST['username']);
        $email       =  e($_POST['email']);
        $password_1  =  e($_POST['password_1']);
        $password_2  =  e($_POST['password_2']);


        // 폼 유효성 검사 : 폼이 올바르게 작성 되었는지 확인(각 입력 필드에 대한 유효성 검사 실행)
        if (empty($username))           //'username'의 값이 비어있는지 확인
        { 
                array_push($errors, "Username is required");                    //'username'의 값이 비어있다면 배열에 추가
        }
        if (empty($email))              //'Email'의 값이 비어있는지 확인
        { 
                array_push($errors, "Email is required");                       //'Email'의 값이 비어있다면 배열에 추가
        }       
        if (empty($password_1))         //'password_1'의 값이 비어있는지 확인
        { 
                array_push($errors, "Password is required");                    //'password_1'의 값이 비어있다면 배열에 추가
        }
        if ($password_1 != $password_2) // 비밀번호가 일치하지 않다면 실행
        {
                array_push($errors, "The two passwords do not match");          // 오류 메시지 출력
        }

        // 폼에 오류가 없다면 사용자 등록 수행
        if (count($errors) == 0) 
        {
                $password = md5($password_1);   //비밀번호를 데이터 베이스에 저장하기 전에 암호화 수행

                if (isset($_POST['user_type'])) // 'user_type'이 설정되어 있을 때 수행
                {
                        $user_type = e($_POST['user_type']);    // 폼에서 받은 'user_type' 값을 escape하여 저장

                        // 데이터베이스에 사용자 정보를 추가하는 쿼리 생성 및 실행
                        $query = "INSERT INTO users (username, email, user_type, password) 
                                          VALUES('$username', '$email', '$user_type', '$password')";
                        mysqli_query($db, $query);

                        $_SESSION['success']  = "New user successfully created!!";      // 세션에 성공했을 때 메시지 출력
                        header('location: home.php');   // 사용자를 'home.php'페이지로 리다이렉션
                }
                else
                {
                        // 'user_type'이 설정되어있지 않다면 'user'로 사용자 정보를 추가하도록 기본 설정
                        $query = "INSERT INTO users (username, email, user_type, password) 
                                          VALUES('$username', '$email', 'user', '$password')";
                        mysqli_query($db, $query);

                        $logged_in_user_id = mysqli_insert_id($db);     // 새로 생성된 사용자의 ID불러오기
                        $_SESSION['user'] = getUserById($logged_in_user_id);    // 사용자 ID를 세션에 저장
                        $_SESSION['success']  = "You are now logged in";        //'success'메시지 세션에 저장
                        header('location: index.php');          //'위의 정보들을 'index.php'페이지로 리다이렉션
                }
        }
}

function getUserById($id)       // 주어진 ID에 해당하는 사용자 정보를 반환하는 함수 선언

{
        global $db;     // 전역 변수로 선언된 데이터베이스 접근
        $query = "SELECT * FROM users WHERE id=" . $id;         // ID를 통해 데이터베이스에서 사용자 정보를 가져오는 쿼리 생성
        $result = mysqli_query($db, $query);    // 쿼리 실행 및 결과값 저장

        $user = mysqli_fetch_assoc($result);    // 결과에서 가져온 사용자 정보를 연관 배열로 가져오기
        return $user;   // 사용자 정보 배열 반환
}

function e($val)        // 문자열을 escape하는 함수 선언

{
        global $db;     // 전역 변수로 선언된 데이터베이스에 접근
        return mysqli_real_escape_string($db, trim($val));      
        //'mysqli_real_escape_string'함수를 통해 문자열 escape / 'trim'함수를 이용하여 양 끝의 공백을 제거한 값 반환
}

function display_error()        // 오류 메시지 출력 함수
{
        global $errors;         // 전역 변수로 선언된 오류 배열에 접근

        if (count($errors) > 0)         // 오류가 하나 이상 있을 때 실행
        {
                echo '<div class="error">';     // 오류 메시지 출력
                        foreach ($errors as $error)
                        {
                                echo $error .'<br>';    // 오류 메시지에 개행 포함
                        }
                echo '</div>';
        }
        
}       
function isLoggedIn()   // 사용자가 로그인 상태인지 확인하는 함수
{
        if (isset($_SESSION['user']))   // 세션에서 'user' 키가 설정되어 있는지 확인하는 if 문
        {
                return true;    // 'user'세션 키가 있을 때 > 상태 : 사용자 로그인(true 반환)
        }
        else
        {
                return false;   // 'user'세션 키가 없을 때 > 상태 : 사용자 로그아웃(false 반환)
        }
}

if (isset($_GET['logout']))     // 로그아웃 버튼이 클릭되었을 때 실행
{
    session_destroy();          // 세션 파괴
    unset($_SESSION['user']);           // 'user'세션 변수 제거, 로그아웃 상태로 변경   
    header("location: login.php");              // 로그인 페이지로 리다이렉션
}

if (isset($_POST['login_btn']))         // 'login_btn'이 클릭되었을 때 실행하는 if문
{
    login();            // 'login'함수 호출
}

function login()        // 사용자 로그인 처리 함수
{
    global $db, $username, $errors;         // 전역변수로 선언된 '데이터베이스', '사용자 명', '오류 배열'

    $username = e($_POST['username']);          // 폼에서 '사용자 명'가져오기 
    $password = e($_POST['password']);          // 폼에서 '암호'가져오기

    if (empty($username))       // 사용자 명이 비어있는지 확인하는 if문
    {
            array_push($errors, "Username is required");        // 사용자 명이 비어있을 때 오류 배열에 오류 메시지 추가
    }
    if (empty($password))       // 암호가 비어있는지 확인하는 if문
    {
            array_push($errors, "Password is required");        // 암호가 비어있을 때 오류 배열에 오류 메시지 추가
    }

    
    if (count($errors) == 0)    // 오류 배열이 비어있을 때 실행하는 if문
    {
            $password = md5($password);         // 암호를 MD5 해시값으로 암호화

            // '사용자 명'과 암호화된 '비밀번호'가 일치하는 사용자를 데이터베이스에서 조회하는 쿼리 생성
            $query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
            $results = mysqli_query($db, $query);

            if (mysqli_num_rows($results) == 1)         // 조회 결과가 1개인 경우 실행(사용자 존재)
            {
                    // 사용자가 'user'인지'admin'인지 구분
                    $logged_in_user = mysqli_fetch_assoc($results);     // 조회된 사용자 정보를 연관 배열로 가져오기
                   
                    if ($logged_in_user['user_type'] == 'admin')        // 사용자의 유형이 'admin'일때 실행
                    {
                            $_SESSION['user'] = $logged_in_user;        // 세션에 사용자 정보 저장
                            $_SESSION['success']  = "You are now logged in";    // 로그인 성공 메시지 설정
                            header('location: admin/home.php');         //  'admin/home.php'페이지로 리다이렉션
                    }
                    else
                    {
                            $_SESSION['user'] = $logged_in_user;        // 세션에 사용자 정보 저장
                            $_SESSION['success']  = "You are now logged in";    // 로그인 성공 메시지 설정

                            header('location: index.php');      // 'index.php'페이질오 리다이렉션
                    }
            }
            else
            {
                    array_push($errors, "Wrong username/password combination");  // 조회결과가 없는 경우에 오류 메시지 추가    
            }
    }
}

function isAdmin()      // 현재 로그인된 사용자가 관리자(admin) 권한을 가지고 있는지 확인하는 함수 선언
{
        if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' )     // 세션에 사용자 정보가 존재하고 사용자의 유형이 'admin'일때 실행
        {
                return true;    // true 반환
        }
        else    // 관리자 권한이 없을 때 실행
        {
                return false;   // false 반환
        }
}