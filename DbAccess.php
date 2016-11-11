<?php
//db credetials
define('host','localhost');
define('username','root');
define('password','P@ssword321');
define('dbname','test_db');


//connects to the database and returns the connection
function connection(){
	$con = new PDO("mysql:hostname=".host.";dbname=".dbname."", username,password);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "connection successul<br>";
	return $con;
}