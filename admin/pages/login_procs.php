 
<?php
include 'connect.php';
session_start();
 $user=$_POST['user'];
 $pass=$_POST['pass'];
 

 $q=mysql_query("select * from anggota where username='$user' AND password='$pass'");
 $ar=array("admin,user");
 
 if($_POST['submit']){
	 if(empty($user) && empty($pass)){
		 header("location:blank.html");
	 }else if(mysql_num_rows($q)==1){
	  		while($h=mysql_fetch_array($q)){
				$use	=$h['username'];
				$pas	=$h['password'];
				$anggota=$h['idanggota'];
				$id		=$h['iduser'];	
				$nama	=$h['nama'];	
			} 
			if($id=='1'){ 	
			  $_SESSION["user"]		= $use;
			  $_SESSION["pass"]		= $pas;
			  $_SESSION["level"]	= $ar[0];
			  $_SESSION["anggota"]	= $anggota;
			  $_SESSION["id"]		= $id;
			  $_SESSION["nama"]		= $nama;
			  header("location:admin_home.php");

		 }else if($id=='2'){
				    $_SESSION["user"]		= $use;
			  	    $_SESSION["pass"]		= $pas;
				    $_SESSION["anggota"]	= $anggota;
				    $_SESSION["level"]		= $ar[1];
					$_SESSION["id"]			= $id;
					$_SESSION["nama"]		= $nama;
					header("location:notifications.html");
		}
		
 }
  else{
			echo "<script>alert('Email or password is incorrect!'); document.location='../../index.php'</script>";
				//echo" <script language="javascript">alert('password yang anda masukkan salah');</script>";
                 
		 }
 }

