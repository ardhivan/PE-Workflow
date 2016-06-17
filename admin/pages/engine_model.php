<?php

ob_start();

include "connect.php";

switch ( $_GET['p'] ) {

	default: echo "Halaman tidak ditemukan"; break;

	case "tambah":

		$name 	= $_POST['name'];
		$division 	= $_POST['division'];
		$stage = $_POST['stage'];
		$nameupper = strtoupper($name);
		

		empty( $name ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Model Name Empty</h5>" : "";
		empty( $division ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span>  Select Division</h5>" : "";
		empty( $stage ) ? $err[] = "<h5><span class='fa fa-exclamation'></span>  Select Stage</h5>" : "";
		

		// Cek apakah NIM belum terdaftar
		$sql = $conn->query("SELECT model_name from model WHERE model_name = '$name' ");
		
		if ( $sql->num_rows > 0 ) { $err[] = "<h5><span class='fa fa-exclamation'></span> Model Registered</h5>"; }

		if ( isset( $err ) ) {

			foreach ( $err as $val ) {
				echo $val;
			}

		} else {

			$conn->query("INSERT INTO model VALUES ('','$nameupper','$division','$stage')");
			$_SESSION['info'] = "Menyimpan";
			echo "Sukses";

		}

	break;

	case "update":

		$id 	= $_POST['id'];
		$name 	= $_POST['name'];
		$division 	= $_POST['division'];
		$stage = $_POST['stage'];
		$nameupper = strtoupper($name);
		
		empty( $name ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Model Name Empty</h5>" : "";
		empty( $division ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span>  Select Division</h5>" : "";
		empty( $stage ) ? $err[] = "<h5><span class='fa fa-exclamation'></span>  Select Stage</h5>" : "";

		// Cek apakah NIM belum terdaftar
		$sql = $conn->query("SELECT model_name from model WHERE model_name = '$name' AND model_id != '$id'");
		
		if ( $sql->num_rows > 0 ) { $err[] = "<h5><span class='fa fa-exclamation'></span> Model Registered</h5>"; }

		if ( isset( $err ) ) {

			foreach ( $err as $val ) {
				echo $val;
			}

		} else {

			$conn->query("UPDATE model set model_name = '$name', model_division = '$division', model_stage = '$stage'
							WHERE model_id = '$id'");
			$_SESSION['info'] = "Mengubah";
			echo "Sukses";

		}

	break;

	case "hapus" :

		$id = $_GET['id'];
		$conn->query("DELETE FROM model WHERE model_name = '$id'");
		$_SESSION['info'] = "Menghapus";
		header("location:admin_home.php?page=view_model");

	break;
}

ob_end_flush();

?>