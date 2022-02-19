<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>URL Cleaner</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h1>URL Cleaner</h1>

<?php

// Turn off all error reporting
error_reporting(0);

// Functions
require_once ("functions.php");

// Initialize URL to the variable
$url = $_POST['url'];
$cleaned_url = clean_url($url);

// Output cleaned URL
echo "<p><strong>Original URL: </strong></p>";
echo "<p>" . $url . "</p>";
echo "<p><strong>Cleaned URL: </strong></p>";
echo "<p><a href='" . $cleaned_url . "' target='_blank'>" . $cleaned_url . "</a></p>";

?>

</body>
</html>
