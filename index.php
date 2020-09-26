<?php
include_once('valid_braces.php');

$valid_braces = new valid_braces();

/***
Unit tests from the example
"(){}[]"   =>  True
"([{}])"   =>  True
"(}"       =>  False
"[(])"     =>  False
"[({})](]" =>  False
//***/

$input_string = "(){}[]"; //=>  True
$test_result = $valid_braces->valid_braces($input_string);
echo "=>  True";
var_dump ($test_result);

$input_string = "([{}])"; //=>  True
$test_result = $valid_braces->valid_braces($input_string);
echo "=>  True";
var_dump ($test_result);

$input_string = "(}"; //=>  False
$test_result = $valid_braces->valid_braces($input_string);
echo "=>  False";
var_dump ($test_result);

$input_string = "[(])"; //=>  False
$test_result = $valid_braces->valid_braces($input_string);
echo "=>  False";
var_dump ($test_result);

$input_string = "[({})](]"; //=>  False
$test_result = $valid_braces->valid_braces($input_string);
echo "=>  False";
var_dump ($test_result);

$input_string = "[({}])](]"; //=>  False
$test_result = $valid_braces->valid_braces($input_string);
echo "=>  False";
var_dump ($test_result);

$input_string = "({})[({})]"; //=>  True
$test_result = $valid_braces->valid_braces($input_string);
echo "=>  True";
var_dump ($test_result);

$input_string = "(({{[[]]}}))"; //=>  True
$test_result = $valid_braces->valid_braces($input_string);
echo "=>  True";
var_dump ($test_result);

?>
