<?php

ob_start();

include "connect.php";

switch ( $_GET['p'] ) {

	default: echo "Halaman tidak ditemukan"; break;

	case "tambah":

		$start 	= $_POST['start'];
		$end 	= $_POST['end'];
		$title = $_POST['title'];
		$stat = $_POST['stat'];
		

		empty( $start )	? $err[] = "<h5><span class='fa fa-exclamation'></span> Start Date Empty</h5>" : "";
		empty( $end )	? $err[] = "<h5><span class='fa fa-exclamation'></span>  End Date Empty</h5>" : "";
		empty( $title )	? $err[] = "<h5><span class='fa fa-exclamation'></span> Title empty</h5>" : "";
		empty( $stat )	? $err[] = "<h5><span class='fa fa-exclamation'></span>  Select Status</h5>" : "";

		// Cek apakah  belum terdaftar
		$sql = $conn->query("SELECT judul from jadwal WHERE judul = '$title' ");
		
		if ( $sql->num_rows > 0 ) { $err[] = "<h5><span class='fa fa-exclamation'></span> Schedule Registered</h5>"; }

		if ( isset( $err ) ) {

			foreach ( $err as $val ) {
				echo $val;
			}

		} else {

			$conn->query("INSERT INTO jadwal VALUES ('','$start','$end','$title','$stat')");
			$_SESSION['info'] = "Menyimpan";
			echo "Sukses";

		}

	break;

	case "update":

		$id 	= $_POST['id'];
		$start 	= $_POST['start'];
		$end 	= $_POST['end'];
		$title = $_POST['title'];
		$stat = $_POST['stat'];
		

		empty( $start ) ? $err[] = "<h5><span class='fa fa-exclamation'></span> Start Date Empty</h5>" : "";
		empty( $end ) 	? $err[] = "<h5><span class='fa fa-exclamation'></span>  End Date Empty</h5>" : "";
		empty( $title)  ? $err[] = "<h5><span class='fa fa-exclamation'></span> Title empty</h5>" : "";
		empty( $stat )  ? $err[] = "<h5><span class='fa fa-exclamation'></span>  Select Status</h5>" : "";

		// Cek apakah  belum terdaftar
		$sql = $conn->query("SELECT judul from jadwal WHERE judul = '$title' AND jadwal_id != '$id'");
		
		if ( $sql->num_rows > 0 ) { $err[] = "<h5><span class='fa fa-exclamation'></span> Schedule Registered</h5>"; }

		if ( isset( $err ) ) {

			foreach ( $err as $val ) {
				echo $val;
			}

		} else {

			$conn->query("UPDATE jadwal set tgl1 = '$start', tgl2 = '$end', judul = '$title', stat = '$stat'
							WHERE jadwal_id = '$id'");
			$_SESSION['info'] = "Mengubah";
			echo "Sukses";

		}

	break;

	case "hapus" :

		$id = $_GET['id'];
		$conn->query("DELETE FROM jadwal WHERE jadwal_id = '$id'");
		$_SESSION['info'] = "Menghapus";
		header("location:admin_home.php?page=schedule");

	break;
}

ob_end_flush();

?>