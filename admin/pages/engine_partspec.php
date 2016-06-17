<?php

ob_start();

include "connect.php";

switch ( $_GET['p'] ) {

	default: echo "Halaman tidak ditemukan"; break;

	case "tambah":

		$dl 	= $_POST['dl'];
		$wfno 	= $_POST['wfno'];
		$docno 	= $_POST['docno'];
		$partno = $_POST['partno'];
		$partname = $_POST['partname'];
		$supplier = $_POST['supplier'];
		$spesification = $_POST['spesification'];
		$rev 	= $_POST['rev'];
		$model 	= $_POST['model'];
		$issue 	= $_POST['issue'];
		

		empty( $dl ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Receive Date Empty</h5>" : "";
		empty( $wfno ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Workflow No Empty</h5>" : "";
		empty( $docno ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Document No Empty</h5>" : "";
		empty( $partno ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Part No Empty</h5>" : "";
		empty( $partname ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Part Name Empty</h5>" : "";
		empty( $supplier ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Supplier Name Empty</h5>" : "";
		empty( $issue ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Issue Date Empty</h5>" : "";
		empty( $model ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Model is Empty</h5>" : "";

		// Cek apakah NIM belum terdaftar
		$sql = $conn->query("SELECT spec_no from partspec WHERE spec_no = '$docno' ");
		
		if ( $sql->num_rows > 0 ) { $err[] = "<h5><span class='fa fa-exclamation'></span> Part Spec Registered</h5>"; }

		if ( isset( $err ) ) {

			foreach ( $err as $val ) {
				echo $val;
			}

		} else{
		$conn->query("INSERT INTO partspec VALUES ('','$dl','$wfno','$docno','$partno','$partname','$supplier','$spesification','$rev','$model','$issue','','')");
			
			$dir_file = "../.././files/partspec/";
			
			for ( $i = 0; $i < count( $_FILES['file']['name']); $i++ ) {

		$nama_file = $_FILES['file']['name'][$i];
		$ext = pathinfo( $nama_file, PATHINFO_EXTENSION );
		$ekstensi = array('jpg','jpeg','png','tif','JPG','pdf','PDF','xls','xlsx'); // Ektensi yg diterima
		 
		//filter ektensi file yang diterima
		if( in_array( $ext, $ekstensi ) ) {
 
				if ( move_uploaded_file( $_FILES['file']['tmp_name'][$i], $dir_file . $nama_file ) ) {					
					$conn->query("INSERT INTO files VALUES ('','$docno','partspec','$nama_file','./files/partspec/$nama_file')");
					

				} else {
					echo "file <b>" . $_FILES['file']['name'][$i] . " </b>Gagal <br />";
				}
		} else {

			echo "Format  " . $_FILES['file']['name'][$i] . "  tidak didukung. <br>";
				}
	}$_SESSION['info'] = "Menyimpan";
					echo "Sukses";
	
		}

	break;

	case "update":
		$id 	= $_POST['id'];
		$dl 	= $_POST['dl'];
		$wfno 	= $_POST['wfno'];
		$docno 	= $_POST['docno'];
		$partno = $_POST['partno'];
		$partname = $_POST['partname'];
		$supplier = $_POST['supplier'];
		$spesification = $_POST['spesification'];
		$rev 	= $_POST['rev'];
		$model 	= $_POST['model'];
		$issue 	= $_POST['issue'];
		
		empty( $dl ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Receive Date Empty</h5>" : "";
		empty( $wfno ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Workflow No Empty</h5>" : "";
		empty( $docno ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Document No Empty</h5>" : "";
		empty( $partno ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Part No Empty</h5>" : "";
		empty( $partname ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Part Name Empty</h5>" : "";
		empty( $supplier ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Supplier Name Empty</h5>" : "";
		empty( $issue ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Issue Date Empty</h5>" : "";
		empty( $model ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Model is Empty</h5>" : "";
		
		// Cek apakah NIM belum terdaftar
		$sql = $conn->query("SELECT spec_no from partspec WHERE spec_no = '$docno' AND spec_id != '$id' ");
		
		if ( $sql->num_rows > 0 ) { $err[] = "<h5><span class='fa fa-exclamation'></span> Part Spec Registered</h5>"; }

		if ( isset( $err ) ) {

			foreach ( $err as $val ) {
				echo $val;
			}

		} else {
			@$nama_file = $_FILES['file']['name'][$i];
			
			if (empty($_FILES['file']['name'])){
				
			$conn->query("UPDATE partspec set 	spec_dl = '$dl', spec_wfno = '$wfno', spec_no = '$docno', spec_partno = '$partno', spec_partname = '$partname'
												, spec_supplier = '$supplier', spec_spesification = '$spesification', spec_rev = '$rev', spec_model = '$model'
												, spec_issue = '$issue'
												WHERE spec_id = '$id'");
			$_SESSION['info'] = "Mengubah";
			echo "Sukses";
			}
			else{
			$conn->query("UPDATE partspec set 	spec_dl = '$dl', spec_wfno = '$wfno', spec_no = '$docno', spec_partno = '$partno', spec_partname = '$partname'
												, spec_supplier = '$supplier', spec_spesification = '$spesification', spec_rev = '$rev', spec_model = '$model'
												, spec_issue = '$issue'
												WHERE spec_id = '$id'");
			$dir_file = "../.././files/partspec/";
			
			for ( $i = 0; $i < count( $_FILES['file']['name']); $i++ ) {

		$nama_file = $_FILES['file']['name'][$i];
		$ext = pathinfo( $nama_file, PATHINFO_EXTENSION );
		$ekstensi = array('jpg','jpeg','png','tif','JPG','pdf','PDF','xls','xlsx'); // Ektensi yg diterima
		 
		//filter ektensi file yang diterima
		if( in_array( $ext, $ekstensi ) ) {
 
				if ( move_uploaded_file( $_FILES['file']['tmp_name'][$i], $dir_file . $nama_file ) ) {					
					$conn->query("UPDATE files SET file_name='$nama_file', file_path='./files/partspec/$nama_file'
									WHERE file_docno= '$docno'");
			
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

	break;

	case "hapus" :

		$id = $_GET['id'];
		$conn->query("DELETE FROM partspec WHERE spec_no = '$id'");
		$conn->query("DELETE FROM files WHERE file_docno = '$id'");
		$_SESSION['info'] = "Menghapus";
		header("location:admin_home.php?page=view_partspec");

	break;
}

ob_end_flush();

?>