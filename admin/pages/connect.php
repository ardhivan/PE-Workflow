<?php
$serv = "localhost"; // server database
$use = "root"; // user database
$pas = "yemipe"; // password database, monggo diganti
$conn = mysql_connect($serv,$use,$pas) or die(mysql_error()); // connect to database
$con = mysql_connect($serv,$use,$pas) or die(mysql_error()); // connect to database2
$select_db = mysql_select_db("dbworkflow", $conn) or die(mysql_error()); // select database
$link=mysqli_connect($serv, $use, $pas, "dbworkflow");
date_default_timezone_set('Asia/Jakarta');
?>
<?php

@session_start();

$SETT = array (
	'db_host'	 	=> 'localhost',
	'db_username' 	=> 'root',
	'db_password' 	=> 'yemipe',
	'db_name'		=> 'dbworkflow'
);

$conn = new mysqli($SETT['db_host'], $SETT['db_username'], $SETT['db_password'], $SETT['db_name']);

if ($conn->connect_error){
	echo "Gagal terkoneksi ke database : (".$mysqli->connect_error.")".$mysqli->connect_error;
}
?>