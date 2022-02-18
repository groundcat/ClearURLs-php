<?php

// Turn off all error reporting
error_reporting(0);

// Functions
require_once ("functions.php");

// Initialize URL to the variable
$url = $_POST['url'];

// Test URL
//$url = "https://www.amazon.com/?bbb=123&smid=123&aaa=123&qid=222";
//$url = "aHR0cHM6Ly93d3cuYW1hem9uLmNvbS8/YmJiPTEyMyZzbWlkPTEyMyZhYWE9MTIzJnFpZD0yMjI=";

$cleaned_url = clean_url($url);

// Output cleaned URL
echo "Cleaned URL: <br>\n";
echo "<a href='" . $cleaned_url . "' target='_blank'>" . $cleaned_url . "</a>";
