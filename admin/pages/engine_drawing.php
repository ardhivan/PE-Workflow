<?php

ob_start();

include "connect.php";

switch ( $_GET['p'] ) {

	default: echo "Halaman tidak ditemukan"; break;

	case "tambah":

		$dl 	= $_POST['dl'];
		$wfno 	= $_POST['wfno'];
		$code 	= $_POST['code'];
		$docno 	= $_POST['docno'];
		$partno = $_POST['partno'];
		$partname = $_POST['partname'];
		$type = $_POST['type'];
		$dcnno = $_POST['dcnno'];
		$comment = $_POST['comment'];
		$rev 	= $_POST['rev'];
		$issue 	= $_POST['issue'];
		$model 	= $_POST['model'];
		

		empty( $dl ) 	 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Receive Date Empty</h5>" : "";
		empty( $wfno ) 	 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Workflow No Empty</h5>" : "";
		empty( $code ) 	 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Code Empty</h5>" : "";
		empty( $docno ) 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Document No Empty</h5>" : "";
		empty( $partno ) 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Part No Empty</h5>" : "";
		empty( $partname ) 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Part Name Empty</h5>" : "";
		empty( $type ) 	 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Doc Type Empty</h5>" : "";
		empty( $dcnno ) 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Dcnno Empty</h5>" : "";
		empty( $issue ) 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Issue Date Empty</h5>" : "";
		empty( $issue ) 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Issue Date Empty</h5>" : "";
		empty( $model ) 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Model is Empty</h5>" : "";

		// Cek apakah NIM belum terdaftar
		$sql = $conn->query("SELECT draw_no from drawing WHERE draw_no = '$docno' ");
		
		if ( $sql->num_rows > 0 ) { $err[] = "<h5><span class='fa fa-exclamation'></span> Drawing is Registered</h5>"; }

		if ( isset( $err ) ) {

			foreach ( $err as $val ) {
				echo $val;
			}

		} else{
		//$conn->query("INSERT INTO drawing VALUES ('','$dl','$wfno','$docno','$partno','$partname','$type','$dcnno,'$comment','$rev','$model','$issue','','')");
		$conn->query("INSERT INTO `dbworkflow`.`drawing` (`draw_id`, `draw_dl`, `draw_wfno`, `draw_code`, `draw_no`, `draw_partno`, `draw_partname`, `draw_category`, `draw_dcnno`, `draw_comment`, `draw_rev`, `draw_model`, `draw_issue`, `draw_filename`, `draw_file`) 
		VALUES (NULL, '$dl', '$wfno', '$code', '$docno', '$partno', '$partname', '$type', '$dcnno', '$comment', '$rev', '$model', '$issue', NULL, NULL)");
		
			$dir_file = "../.././files/drawing/";
			
			for ( $i = 0; $i < count( $_FILES['file']['name']); $i++ ) {

		$nama_file = $_FILES['file']['name'][$i];
		$ext = pathinfo( $nama_file, PATHINFO_EXTENSION );
		$ekstensi = array('jpg','jpeg','png','tif','JPG','pdf','PDF','doc','docx','xls','xlsx','zip','ai','rar','cad','sldprt','SLDPRT','SLDDRW','step','STEP'); // Ektensi yg diterima
		 
		//filter ektensi file yang diterima
		if( in_array( $ext, $ekstensi ) ) {
 
				if ( move_uploaded_file( $_FILES['file']['tmp_name'][$i], $dir_file . $nama_file ) ) {					
					$conn->query("INSERT INTO files VALUES ('','$docno','drawing','$nama_file','./files/drawing/$nama_file')");
					

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
		$code 	= $_POST['code'];
		$docno 	= $_POST['docno'];
		$partno = $_POST['partno'];
		$partname = $_POST['partname'];
		$type = $_POST['type'];
		$dcnno = $_POST['dcnno'];
		$comment = $_POST['comment'];
		$rev 	= $_POST['rev'];
		$model 	= $_POST['model'];
		$issue 	= $_POST['issue'];
		

		empty( $dl ) 	 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Receive Date Empty</h5>" : "";
		empty( $wfno ) 	 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Workflow No Empty</h5>" : "";
		empty( $code ) 	 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Code Empty</h5>" : "";
		empty( $docno ) 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Document No Empty</h5>" : "";
		empty( $partno ) 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Part No Empty</h5>" : "";
		empty( $partname ) 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Part Name Empty</h5>" : "";
		empty( $type ) 	 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Doc Type Empty</h5>" : "";
		empty( $dcnno ) 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Dcnno Empty</h5>" : "";
		empty( $issue ) 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Issue Date Empty</h5>" : "";
		empty( $model ) 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Model is Empty</h5>" : "";
		
		// Cek apakah NIM belum terdaftar
		$sql = $conn->query("SELECT draw_no from drawing WHERE draw_no = '$docno' AND draw_id != '$id' ");
		
		if ( $sql->num_rows > 0 ) { $err[] = "<h5><span class='fa fa-exclamation'></span> Drawing is Registered</h5>"; }

		if ( isset( $err ) ) {

			foreach ( $err as $val ) {
				echo $val;
			}

		} else {
			@$nama_file = $_FILES['file']['name'][$i];
			
			if (empty($_FILES['file']['name'])){
				
			$conn->query("UPDATE drawing set 	draw_dl = '$dl', draw_wfno = '$wfno', draw_code = '$code', draw_no = '$docno', draw_partno = '$partno',
			draw_partname = '$partname', draw_category = '$type', draw_dcnno = '$dcnno', draw_comment = '$comment', draw_rev = '$rev', draw_model = '$model', draw_issue = '$issue'
												WHERE draw_id = '$id'");
			$_SESSION['info'] = "Mengubah";
			echo "Sukses";
			}
			else{
			$conn->query("UPDATE drawing set 	draw_dl = '$dl', draw_wfno = '$wfno', draw_code = '$code', draw_no = '$docno', draw_partno = '$partno',
			draw_partname = '$partname', draw_category = '$type', draw_dcnno = '$dcnno', draw_comment = '$comment', draw_rev = '$rev', draw_model = '$model', draw_issue = '$issue'
						WHERE draw_id = '$id'");
						
			$dir_file = "../.././files/drawing/";
			
			for ( $i = 0; $i < count( $_FILES['file']['name']); $i++ ) {

		$nama_file = $_FILES['file']['name'][$i];
		$ext = pathinfo( $nama_file, PATHINFO_EXTENSION );
		$ekstensi = array('jpg','jpeg','png','tif','JPG','pdf','PDF','doc','docx','xls','xlsx','zip','ai','rar','cad','sldprt','SLDPRT','SLDDRW','STEP'); // Ektensi yg diterima
		 
		//filter ektensi file yang diterima
		if( in_array( $ext, $ekstensi ) ) {
 
				if ( move_uploaded_file( $_FILES['file']['tmp_name'][$i], $dir_file . $nama_file ) ) {					
					$conn->query("UPDATE files SET file_name='$nama_file', file_path='./files/drawing/$nama_file'
									WHERE file_docno= '$docno'");
			
				} else {
					echo "file <b>" . $_FILES['file']['name'][$i] . " </b>Gagal <br />";
				}
		} else {

			echo "Format  " . $_FILES['file']['name'][$i] . "  tidak didukung. <br>";
		}
	}		$_SESSION['info'] = "Mengubah";
			echo "Sukses";
			} 
		}

	break;

	case "hapus" :

		$id = $_GET['id'];
		$conn->query("DELETE FROM drawing WHERE draw_no = '$id'");
		$conn->query("DELETE FROM files WHERE file_docno = '$id'");
		$_SESSION['info'] = "Menghapus";
		header("location:admin_home.php?page=view_drawing");

	break;
}

ob_end_flush();

?>