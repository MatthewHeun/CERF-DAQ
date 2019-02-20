<?php
$db_host = "153.106.112.156";
$db_user = "CERF";
$db_pwd  = "9//R3me%[)4GX38@<=<[M,6?";
$db_name = "users";
$conn = new mysqli($db_host, $db_user, $db_pwd, $db_name);
if ( ! $conn) 
{
	die("Connection failed: " . mysqli_connect_error());
}
?>