<?php
/*
* Site : http:www.smarttutorials.net
* Author :muni
*
*/

define('BASE_PATH','http://localhost/new_quiz/');
define('DB_HOST', 'localhost');
define('DB_NAME', 'nudgecopy');
define('DB_USER','root');
define('DB_PASSWORD','');
 
$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD, DB_NAME) or die("Failed to connect to MySQL: " . mysql_error());
//$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

?>

 


