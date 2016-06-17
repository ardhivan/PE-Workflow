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
