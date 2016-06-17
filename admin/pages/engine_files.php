<?php

ob_start();

include "connect.php";

switch ( $_GET['p'] ) {

	default: echo "Halaman tidak ditemukan"; break;

	case "tambah":

		$docno		= $_POST['docno'];
		$filetype 	= $_POST['filetype'];


		empty( $docno ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Document No Empty</h5>" : "";
		empty( $filetype ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Document Type Empty</h5>" : "";
	
		// Cek apakah belum terdaftar
		//$sql = $conn->query("SELECT file_name from files WHERE file_name = '$nama_file' ");
		
		//if ( $sql->num_rows > 0 ) { $err[] = "<h5><span class='fa fa-exclamation'></span> File Is Already on Server</h5>"; }

		if ( isset( $err ) ) {

			foreach ( $err as $val ) {
				echo $val;
			}

		} else{		
			$dir_file = "../.././files/$filetype/";
			
			for ( $i = 0; $i < count( $_FILES['file']['name']); $i++ ) {

		$nama_file = $_FILES['file']['name'][$i];
		$ext = pathinfo( $nama_file, PATHINFO_EXTENSION );
		$ekstensi = array('jpg','jpeg','png','tif','JPG','pdf','PDF','doc','docx','xls','xlsx','zip','ai','rar','cad','sldprt','SLDPRT','slddrw','SLDDRW','step','STEP'); // Ektensi yg diterima
		 
		//filter ektensi file yang diterima
		if( in_array( $ext, $ekstensi ) ) {
 
				if ( move_uploaded_file( $_FILES['file']['tmp_name'][$i], $dir_file . $nama_file ) ) {					
					$conn->query("INSERT INTO files VALUES ('','$docno','$filetype','$nama_file','./files/$filetype/$nama_file')");
					

				} else {
					echo "file <b>" . $_FILES['file']['name'][$i] . " </b>Gagal <br />";
				}
		} else {

			echo "Format  " . $_FILES['file']['name'][$i] . "  tidak didukung. <br>";
				}
	} $_SESSION['info'] = "Menyimpan";
					echo "Sukses";
	
		}

	break;

	case "update":
		$id 		= $_POST['id'];
		$docno		= $_POST['docno'];
		$filetype 	= $_POST['filetype'];


		empty( $docno ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Document No Empty</h5>" : "";
		empty( $filetype ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Document Type Empty</h5>" : "";
		
		// Cek apakah NIM belum terdaftar
		//$sql = $conn->query("SELECT spec_no from partspec WHERE spec_no = '$docno' AND spec_id != '$id' ");
		
		//if ( $sql->num_rows > 0 ) { $err[] = "<h5><span class='fa fa-exclamation'></span> Part Spec Registered</h5>"; }

		if ( isset( $err ) ) {

			foreach ( $err as $val ) {
				echo $val;
			}

		} else {
			@$nama_file = $_FILES['file']['name'][$i];
			//kalo file gak diganti
			if (empty($_FILES['file']['name'])){
				
			$conn->query("UPDATE files set 	file_docno = '$docno', file_type = '$filetype'
												WHERE file_id = '$id'");
			$_SESSION['info'] = "Mengubah";
			echo "Sukses";
			}
			//kalo file diganti
			else{
			$dir_file = "../.././files/$filetype/";
			
			for ( $i = 0; $i < count( $_FILES['file']['name']); $i++ ) {

		$nama_file = $_FILES['file']['name'][$i];
		$ext = pathinfo( $nama_file, PATHINFO_EXTENSION );
		$ekstensi = array('jpg','jpeg','png','tif','JPG','pdf','PDF','doc','docx','xls','xlsx','zip','ai','rar','cad','sldprt','SLDPRT','slddrw','SLDDRW','step ','STEP'); // Ektensi yg diterima
		 
		//filter ektensi file yang diterima
		if( in_array( $ext, $ekstensi ) ) {
 
				if ( move_uploaded_file( $_FILES['file']['tmp_name'][$i], $dir_file . $nama_file ) ) {					
					$conn->query("UPDATE files SET file_docno = '$docno', file_type = '$filetype', file_name='$nama_file', file_path='./files/$filetype/$nama_file'
									WHERE file_id= '$id'");
			$_SESSION['info'] = "Mengubah";
			echo "Sukses";
				} else {
					echo "file <b>" . $_FILES['file']['name'][$i] . " </b>Gagal <br />";
				}
		} else {
			echo "Format  " . $_FILES['file']['name'][$i] . "  tidak didukung. <br>";
		}
	}	$_SESSION['info'] = "Menyimpan";			
			} 
		}

	break;

	case "hapus" :

		$id = $_GET['id'];
		$conn->query("DELETE FROM files WHERE file_id = '$id'");
		$_SESSION['info'] = "Menghapus";
		header("location:admin_home.php?page=files");

	break;
}

ob_end_flush();

?>