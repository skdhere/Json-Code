<?php
//error_reporting(1);
function Str_to_remove_square($abc)
{
	$final_str = trim((str_replace(array('[',']',' '),array('','',''), $abc)));
	return $final_str;
}

function Str_num($num1)
{
	$final_num = Str_to_remove_square(substr($num1, 0,strpos($num1, '<br>')));
	return $final_num;
}

function Str_den($den1)
{
	$final_den = Str_to_remove_square(str_replace('<br>', '',strstr($den1, '<br>')));
	return $final_den;
}

$v1 = "3,4,3";
$v2 = "1,3,3";


$param1 = "C:/Users/punit.RIVERBRIDGE/AppData/Local/Programs/Python/Python37-32/python.exe test2.py convertMixedToImproperFraction $v1";
$param2 = "C:/Users/punit.RIVERBRIDGE/AppData/Local/Programs/Python/Python37-32/python.exe test2.py convertMixedToImproperFraction $v2";

$result1 = Str_to_remove_square(shell_exec($param1));
echo "convert mixed to improper fraction (v1): ".$result1."<br>";
$result2 = Str_to_remove_square(shell_exec($param2));
echo "convert mixed to improper fraction (v2): ".$result2."<br>";
$param3 = "C:/Users/punit.RIVERBRIDGE/AppData/Local/Programs/Python/Python37-32/python.exe test2.py computeListOfPrimeFactors $result1";
$param4 = "C:/Users/punit.RIVERBRIDGE/AppData/Local/Programs/Python/Python37-32/python.exe test2.py computeListOfPrimeFactors $result2";
$result3 = shell_exec($param3);
$result3_num = Str_num($result3);
$result3_deno = Str_den($result3);
$result4 = shell_exec($param4);
$result4_num = Str_num($result4);
$result4_deno = Str_den($result4);

$conNUm = $result3_num.",".$result4_num;
$conDen = $result3_deno.",".$result4_deno;
echo "Prime Factor for numerator Variable 1: ".$result3_num."<br>";
echo "Prime Factor for denominator Variable 1: ".$result3_deno."<br>";
echo "Prime Factor for numerator Variable 2: ".$result4_num."<br>";
echo "Prime Factor for denominator Variable 2: ".$result4_deno."<br>";
echo "Concatenation of numerators (v1 & v2) = ".$conNUm."<br>";
echo "Concatenation of numerators (v1 & v2) = ".$conDen."<br>";

$param5 = "C:/Users/punit.RIVERBRIDGE/AppData/Local/Programs/Python/Python37-32/python.exe test2.py cancelCommonFactors $conNUm $conDen";
$result5 = shell_exec($param5);
$result5_num = Str_num($result5);
$result5_deno = Str_den($result5);
echo "Cancel common factors of numerators (v1 & v2) =".$result5_num."<br>"; 
echo "Cancel common factors of denominator (v1 & v2) =".$result5_deno."<br>";  

$param6 = "C:/Users/punit.RIVERBRIDGE/AppData/Local/Programs/Python/Python37-32/python.exe test2.py multiplyFactors $result5_num";
$result6 = Str_to_remove_square(shell_exec($param6));
echo "Multiply factors of numerators (v1 & v2) = ".$result6."<br>";



$param7 = "C:/Users/punit.RIVERBRIDGE/AppData/Local/Programs/Python/Python37-32/python.exe test2.py multiplyFactors $result5_deno";
$result7 = Str_to_remove_square(shell_exec($param7));


echo "Multiply factors of denominator (v1 & v2) = ".$result7."<br>"; 

//var_dump($result7);

$param8 = "C:/Users/punit.RIVERBRIDGE/AppData/Local/Programs/Python/Python37-32/python.exe test2.py convertImproperToMixedFraction $result6 $result7";

$result8 = Str_to_remove_square(shell_exec($param8));

echo $result8;


exit();







?>
