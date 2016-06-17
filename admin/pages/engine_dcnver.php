<?php

ob_start();

include "connect.php";

switch ( $_GET['p'] ) {

	default: echo "Halaman tidak ditemukan"; break;

	case "tambah":

		$dl 	= $_POST['dl'];
		$wfno 	= $_POST['wfno'];
		$type 	= $_POST['type'];
		$partno = $_POST['partno'];
		$partname = $_POST['partname'];
		$supplier = $_POST['supplier'];
		$docno 	= $_POST['docno'];
		$title 	= $_POST['title'];
		$spec = $_POST['spec'];
		$effect = $_POST['effect'];
		$rev 	= $_POST['rev'];
		$model 	= $_POST['model'];
		$section 	= $_POST['section'];
		$issue 	= $_POST['issue'];
		

		empty( $dl ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Receive Date Empty</h5>" : "";
		empty( $wfno ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Workflow No Empty</h5>" : "";
		empty( $docno ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Document No Empty</h5>" : "";
		empty( $title ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> DCN Title Empty</h5>" : "";
		empty( $partno ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Part No Empty</h5>" : "";
		empty( $partname ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Part Name Empty</h5>" : "";
		empty( $supplier ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Supplier Name Empty</h5>" : "";
		empty( $effect ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Effective Date Empty</h5>" : "";
		empty( $issue ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Issue Date Empty</h5>" : "";
		empty( $section) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Section Empty</h5>" : "";
		empty( $model ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Model is Empty</h5>" : "";

		// Cek apakah NIM belum terdaftar
		$sql = $conn->query("SELECT dcn_no from dcn WHERE dcn_no = '$docno' ");
		
		if ( $sql->num_rows > 0 ) { $err[] = "<h5><span class='fa fa-exclamation'></span> DCN is Registered</h5>"; }

		if ( isset( $err ) ) {

			foreach ( $err as $val ) {
				echo $val;
			}

		} else{
		$conn->query("INSERT INTO dcn VALUES ('','$dl','$wfno','$type','$partno','$partname','$supplier','$docno','$title',
													'$spec','$effect','$rev','$model','$section','$issue','Unverified','OPEN')");
			
			$dir_file = "../.././files/dcn/";
			
			for ( $i = 0; $i < count( $_FILES['file']['name']); $i++ ) {

		$nama_file = $_FILES['file']['name'][$i];
		$ext = pathinfo( $nama_file, PATHINFO_EXTENSION );
		$ekstensi = array('jpg','jpeg','png','tif','JPG','pdf','PDF','xls','xlsx','zip'); // Ektensi yg diterima
		 
		//filter ektensi file yang diterima
		if( in_array( $ext, $ekstensi ) ) {
 
				if ( move_uploaded_file( $_FILES['file']['tmp_name'][$i], $dir_file . $nama_file ) ) {					
					$conn->query("INSERT INTO files VALUES ('','$docno','dcn','$nama_file','./files/dcn/$nama_file')");
					

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
		$type 	= $_POST['type'];
		$dcnno 	= $_POST['dcnno'];
		$title 	= $_POST['title'];
		$spec 	= $_POST['spec'];
		$effect = $_POST['effect'];
		$model 	= $_POST['model'];

		$wi_stat 	= $_POST['wi_stat'];
		$wi_section = $_POST['wi_section'];
		$wi_no 		= $_POST['wi_no'];
		$wi_title 	= $_POST['wi_title'];
		$wi_pic 	= $_POST['wi_pic'];
		$stage 		= $_POST['wi_stage'];
		
		empty( $type )		? $err[] = "<h5><span class='fa fa-exclamation'></span> Document Type is Empty</h5>" : "";
		empty( $dcnno ) 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Document No is Empty</h5>" : "";
		empty( $title ) 	? $err[] = "<h5><span class='fa fa-exclamation'></span> DCN Title is Empty</h5>" : "";
		empty( $effect ) 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Effective Date is Empty</h5>" : "";
		empty( $model ) 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Model is Empty</h5>" : "";
		empty( $wi_stat ) 	? $err[] = "<h5><span class='fa fa-exclamation'></span> Status is Empty</h5>" : "";
		
		if ( isset( $err ) ) {

			foreach ( $err as $val ) {
				echo $val;
			}

		} else {
			
		switch ( $wi_stat ) {	
		case "CLOSE":	
			
			$conn->query("UPDATE wi set wi_status = '$wi_stat', wi_section = '$wi_section', wi_title = '$wi_title', wi_maker = '$wi_pic'
							WHERE wi_docno = '$wi_no'");
							
			$conn->query("UPDATE dcn set dcn_type = '$type', dcn_no = '$dcnno', dcn_title = '$title', dcn_spec = '$spec', dcn_effect = '$effect',
							dcn_model = '$model', dcn_verifstat= 'Verified'
							WHERE dcn_id = '$id'");
							
			// Cek apakah dcn belum terverifikasi
			$sql = $conn->query("SELECT dcn_no from dcn_wi WHERE dcn_no = '$dcnno'");
			
				if ( $sql->num_rows > 0 ) {
					$conn->query("UPDATE dcn_wi set dcn_no = '$dcnno', wi_docno = '$wi_no', stat = '$wi_stat'
							WHERE wi_docno = '$wi_no'");
					}
					else{
						$conn->query("INSERT INTO dcn_wi VALUES ('','$dcnno','$wi_no','$wi_stat')");
						}
				
			$_SESSION['info'] = "Menyimpan";
				echo "Sukses";
			break;
			
		case "OPEN":
		// Cek apakah WI belum terdaftar
		$sql = $conn->query("SELECT wi_docno from wi WHERE wi_docno = '$wi_no'");
		
		if ( $sql->num_rows > 0 ) {
			
			$conn->query("UPDATE wi set wi_status = '$wi_stat', wi_section = '$wi_section', wi_title = '$wi_title', wi_maker = '$wi_pic'
							WHERE wi_docno = '$wi_no'");
			$conn->query("UPDATE dcn set dcn_type = '$type', dcn_no = '$dcnno', dcn_title = '$title', dcn_spec = '$spec', dcn_effect = '$effect',
							dcn_model = '$model', dcn_verifstat= 'Verified'
							WHERE dcn_id = '$id'");		
			
			
			// Cek apakah dcn belum terverifikasi
			$sql = $conn->query("SELECT dcn_no from dcn_wi WHERE dcn_no = '$dcnno'");
				if ( $sql->num_rows > 0 ) {
					$conn->query("UPDATE dcn_wi set dcn_no = '$dcnno', wi_docno = '$wi_no', stat = '$wi_stat'
							WHERE wi_docno = '$wi_no'");
					}
					else{
						$conn->query("INSERT INTO dcn_wi VALUES ('','$dcnno','$wi_no','$wi_stat')");
						}
			
			
			$_SESSION['info'] = "Menyimpan";
			echo "Sukses";
			}
			else{
			$conn->query("INSERT INTO `dbworkflow`.`wi` (`wi_id`, `wi_model`, `wi_section`, `wi_docno`, `wi_title`, `wi_stagestat`, `wi_status`, `wi_issue`, `wi_rev`, `wi_maker`, `wi_filename`, `wi_file`, `wi_filename2`, `wi_file2`, `wi_filename3`, `wi_file3`) VALUES (NULL, '$model', '$wi_section', '$wi_no', '$wi_docno', '$stage', '$wi_stat', '-', '-', '$wi_pic', NULL, NULL, NULL, NULL, NULL, NULL)");
			
			$conn->query("UPDATE dcn set dcn_type = '$type', dcn_no = '$dcnno', dcn_title = '$title', dcn_spec = '$spec', dcn_effect = '$effect',
							dcn_model = '$model', dcn_verifstat= 'Verified'
							WHERE dcn_id = '$id'");		
							
			// Cek apakah dcn belum terverifikasi
			$sql = $conn->query("SELECT dcn_no from dcn_wi WHERE dcn_no = '$dcnno'");
				if ( $sql->num_rows > 0 ) {
					$conn->query("UPDATE dcn_wi set dcn_no = '$dcnno', wi_docno = '$wi_no', stat = '$wi_stat'
							WHERE wi_docno = '$wi_no'");
					}
					else{
						$conn->query("INSERT INTO dcn_wi VALUES ('','$dcnno','$wi_no','$wi_stat')");
						}
			
			
			$_SESSION['info'] = "Menyimpan";
			echo "Sukses";
			}
			
			break;
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