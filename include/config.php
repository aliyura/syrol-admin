<?php
define('DB_SERVER','localhost');
define('DB_USER','syrostec_syrolcourse');
define('DB_PASS' ,'Syrol2020@');
define('DB_NAME', 'syrostec_syrol');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
