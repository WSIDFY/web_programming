<?php

echo"=============================< 7-week >=========================<br>";
function printNextNumber($a) 
{
    if ($a % 2 == 1) 
    {
        // $a가 홀수일때 실행
        $nextNumber = $a + 1;
        echo "입력된 숫자 $a 는 홀수이므로, 다음 짝수는 $nextNumber 입니다. /";
    } 
    else
    {
        // $a가 짝수일때 실행
        echo "입력된 숫자 $a 는 짝수입니다. / ";
    }
}

// 함수 테스트
$a = 7; 
printNextNumber($a);

function calculateFactorial($n) 
{
    $result = 1;
    
    while ($n > 1) 
    {
        $result *= $n;
        $n--;
    }
    
    return $result;
}

$number = 5; // 팩토리얼을 계산할 숫자 지정
$factorialResult = calculateFactorial($number);

echo "팩토리얼($number)은 $factorialResult 입니다. / ";

//삼항 연산자를 사용한 php 코드
$value = 12;
$result = ($value % 2 == 1) ? "odd" : "even";
echo $result;

echo"<br>========================< 8-week >=============================<br>";

$n = 5; // 순서대로 출력할 알파벳의 마지막 값을 입력

for ($i = 0; $i <= $n; $i++)    // 마지막 알파벳까지 순서대로 증가하는 반복문
{
    for ($j = 0; $j < $i; $j++) 
    {
        echo chr(65 + $j) . " ";
    }
    echo "<br>";
}

for ($i = $n - 1; $i > 0; $i--)     // 처음 알파벳 까지 순서대로 감소하는 반복문

{
    for ($j = 0; $j < $i; $j++) 
    {
        echo chr(65 + $j) . " ";
    }
    echo "<br>";
}

echo"<br>------------------------------------------------------------------------------------<br>";

function resort(&$arr) 
{
    rsort($arr);        // 내림차순으로 배열 정렬
}

$testArray = array(1,6,4,8,7,9,3,2);  // 테스트 배열 데이터

resort($testArray);   // 내림차순으로 배열 정렬

echo "내림차순으로 배열 정렬 : ";
print_r($testArray);  // 정렬된 배열 출력

echo"<br>------------------------------------------------------------------------------------<br>";

$filename = 'exam.txt'; // 파일 경로 검색

if (file_exists($filename))     // 존재하는 파일인지 확인

{
    $content = file_get_contents($filename);       // 파일 읽기

    $line = count(explode("\n", $content));        // 줄 수 계산
    $word = str_word_count($content);              // 단어 수 계산
    $char = strlen($content);                      // 글자 수 계산

    // 결과 출력
    echo "줄 수: $line<br>";
    echo "단어 수: $word<br>";
    echo "글자 수: $char";
}

echo"<br>-------------------------------------------------------------------------------------<br>";

// 연상(연관) 배열 방식으로 배열 생성
$myarray = array('Kim'  => 'Seoul', 'LEE'  => array('Busan', 'Daegu'), 'Choi' => 'Inchon', 
                'Park' => array('Suwon', 'Daejon'), 'Jung' => array('Kwangju', 'Chunchon', 'Wonju'));

unset($myarray['Choi']);   // 배열 데이터 중 Choi 데이터 삭제

foreach ($myarray as $name => $city)   // 배열 내용 출력
{
    echo "$name: ";
    
    if (is_array($city))        // 도시가 배열이면 각 도시를 출력
    {
        echo implode(', ', $city);
    } 
    else 
    {
        echo $city;
    }

    echo "<br>";
}

echo"--------------------------------------------------------------------------------------<br>";

$filename = 'client.txt'; // 파일 경로

if (file_exists($filename))     // 파일이 존재하는지 확인

{
    $file = fopen($filename, 'r');      // 파일 열기

    while (!feof($file))        // 파일 읽기

    {
        $line = fgets($file);

        $fields = explode("\t", $line);     // 탭으로 분리

        // 데이터 출력
        $name = $fields[0];
        $age = $fields[1];
        $gender = $fields[2];
        $email = $fields[3];

        if ($age >= 30)             // 나이가 30세 이상인 경우에만 출력 실행
        {
            echo "이름: $name, 나이: $age, 성별: $gender, 이메일: $email<br>";
        }
    }
    fclose($file);      // 파일 닫기
} 

?>