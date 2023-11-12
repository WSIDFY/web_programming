<?php

function printNextNumber($a) 
{
    if ($a % 2 == 1) 
    {
        // $a가 홀수일때 실행
        $nextNumber = $a + 1;
        echo "입력된 숫자 $a 는 홀수이므로, 다음 짝수는 $nextNumber 입니다.";
    } 
    else
    {
        // $a가 짝수일때 실행
        echo "입력된 숫자 $a 는 짝수입니다.\n";
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

echo "팩토리얼($number)은 $factorialResult 입니다.\n";

//삼항 연산자를 사용한 php 코드
$value = 12;
$result = ($value % 2 == 1) ? "odd" : "even";
echo $result;

?>
