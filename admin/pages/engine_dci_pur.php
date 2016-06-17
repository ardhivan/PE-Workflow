<?php

ob_start();

include "connect.php";

switch ( $_GET['p'] ) {

	default: echo "Halaman tidak ditemukan"; break;

	case "tambah":

	break;

	case "update":
		$id 		= $_POST['id'];
		$type 		= $_POST['type'];
		$dcnno 		= $_POST['dcnno'];
		$title 		= $_POST['title'];
		$partno 	= $_POST['partno'];
		$partname 	= $_POST['partname'];
		$effect 	= $_POST['effect'];
		$model 		= $_POST['model'];
		
		$comment	= $_POST['comment'];
		$dci_stat	= $_POST['dci_stat'];

		
		empty( $type )		? $err[] = "<h5><span class='fa fa-exclamation'></span> Document Type is Empty</h5>" : "";
		empty( $dcnno ) 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Document No is Empty</h5>" : "";
		empty( $title ) 	? $err[] = "<h5><span class='fa fa-exclamation'></span> DCN Title is Empty</h5>" : "";
		empty( $effect ) 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Effective Date is Empty</h5>" : "";
		empty( $model ) 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Model is Empty</h5>" : "";
		empty( $comment ) 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Comment is Empty</h5>" : "";
		empty( $dci_stat ) 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Status is Empty</h5>" : "";
		
		if ( isset( $err ) ) {

			foreach ( $err as $val ) {
				echo $val;
			}

		} else {
		//jika data dci reply sudah ada	
		$sql = $conn->query("SELECT pur_dcnno from dcn_pur WHERE pur_dcnno = '$dcnno'");
		if ( $sql->num_rows > 0 ) {
			
			@$nama_file = $_FILES['file']['name'][$i];
			
			if (empty($_FILES['file']['name'])){
			$conn->query("UPDATE dcn set  pur_stat = '$dci_stat'
												WHERE dcn_no = '$dcnno'");
												
			$conn->query("UPDATE dcn_pur set  pur_comment = '$comment', pur_stat ='$dci_stat'
												WHERE pur_dcnno = '$dcnno'");
												
			$_SESSION['info'] = "Mengubah";
			echo "Sukses";
			}
			else{

			$dir_file = "../.././files/purch/";
			
			for ( $i = 0; $i < count( $_FILES['file']['name']); $i++ ) {

		$nama_file = $_FILES['file']['name'][$i];
		$ext = pathinfo( $nama_file, PATHINFO_EXTENSION );
		$ekstensi = array('jpg','jpeg','png','tif','JPG','pdf','PDF','xls','xlsx'); // Ektensi yg diterima
		 
		//filter ektensi file yang diterima
		if( in_array( $ext, $ekstensi ) ) {
 
				if ( move_uploaded_file( $_FILES['file']['tmp_name'][$i], $dir_file . $nama_file ) ) {
					$conn->query("UPDATE dcn set  pur_stat = '$dci_stat'
												WHERE dcn_no = '$dcnno'");
					$conn->query("UPDATE dcn_pur set  pur_comment = '$comment', pur_stat ='$dci_stat', pur_filename ='$nama_file', 
									pur_file='./files/purch/$nama_file'
												WHERE pur_dcnno = '$dcnno'");
				} else {
					echo "file <b>" . $_FILES['file']['name'][$i] . " </b>Gagal <br />";
				}
		} else {

			echo "Format  " . $_FILES['file']['name'][$i] . "  tidak didukung. <br>";
		}
	}	$_SESSION['info'] = "Mengubah";
			echo "Sukses";		
			}
			
		}else{ //jika data dci reply belum ada	
		
			@$nama_file = $_FILES['file']['name'][$i];
			
			if (empty($_FILES['file']['name'])){
			$conn->query("UPDATE dcn set  pur_stat = '$dci_stat'
												WHERE dcn_no = '$dcnno'");
												
			$conn->query("INSERT INTO dcn_pur VALUES ('','$dcnno','$comment','$dci_stat','','')");
			$_SESSION['info'] = "Menambahkan";
			echo "Sukses";
			}
			else{

			$dir_file = "../.././files/purch/";
			
			for ( $i = 0; $i < count( $_FILES['file']['name']); $i++ ) {

		$nama_file = $_FILES['file']['name'][$i];
		$ext = pathinfo( $nama_file, PATHINFO_EXTENSION );
		$ekstensi = array('jpg','jpeg','png','tif','JPG','pdf','PDF','xls','xlsx'); // Ektensi yg diterima
		 
		//filter ektensi file yang diterima
		if( in_array( $ext, $ekstensi ) ) {
 
				if ( move_uploaded_file( $_FILES['file']['tmp_name'][$i], $dir_file . $nama_file ) ) {
					$conn->query("UPDATE dcn set  pur_stat = '$dci_stat'
												WHERE dcn_no = '$dcnno'");
					$conn->query("INSERT INTO dcn_pur VALUES ('','$dcnno','$comment','$dci_stat','$nama_file','./files/purch/$nama_file')");			
				} else {
					echo "file <b>" . $_FILES['file']['name'][$i] . " </b>Gagal <br />";
				}
		} else {

			echo "Format  " . $_FILES['file']['name'][$i] . "  tidak didukung. <br>";
		}
	}	$_SESSION['info'] = "Mengubah";
			echo "Sukses";		
			}
		}
		}
	break;

	case "hapus" :

		$id = $_GET['id'];

		$conn->query("UPDATE  `dbworkflow`.`dcn` SET  `dcn_stat` =  'HOLD' WHERE dcn_no = '$id'");
		//$conn->query("DELETE FROM dcn WHERE dcn_no = '$id'");
		//$conn->query("DELETE FROM files WHERE file_docno = '$id'");
		$_SESSION['info'] = "Menghapus";
		header("location:admin_home.php?page=view_dcnhold");

	break;
}

ob_end_flush();

?>