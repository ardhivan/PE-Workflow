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
		$wistat 	= $_POST['wistat'];
		$purstat 	= $_POST['purstat'];
		$iqastat 	= $_POST['iqastat'];
		$pcstat 	= $_POST['pcstat'];
		

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
		empty( $wistat ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> WI Status is Empty</h5>" : "";
		empty( $purstat ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> PURCHASING Status is Empty</h5>" : "";
		empty( $iqastat ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> IQA Status is Empty</h5>" : "";
		empty( $pcstat ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> PC Status is Empty</h5>" : "";
		// Cek apakah NIM belum terdaftar
		$sql = $conn->query("SELECT dcn_no from dcn WHERE dcn_no = '$docno' ");
		
		if ( $sql->num_rows > 0 ) { $err[] = "<h5><span class='fa fa-exclamation'></span> DCN is Registered</h5>"; }

		if ( isset( $err ) ) {

			foreach ( $err as $val ) {
				echo $val;
			}

		} else{
		$conn->query("INSERT INTO dcn VALUES ('','$dl','$wfno','$type','$partno','$partname','$supplier','$docno','$title',
													'$spec','$effect','$rev','$model','$section','$issue','Unverified','OPEN','$wistat','$purstat','$iqastat','$pcstat')");
			
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
		$stat 	= $_POST['stat'];
		$wi 	= $_POST['wi'];
		$pur 	= $_POST['pur'];
		$iqa 	= $_POST['iqa'];
		$pc 	= $_POST['pc'];
		

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
		
		// Cek apakah dcn belum terdaftar
		$sql = $conn->query("SELECT dcn_no from dcn WHERE dcn_no = '$docno' AND dcn_id != '$id' ");
		
		if ( $sql->num_rows > 0 ) { $err[] = "<h5><span class='fa fa-exclamation'></span> DCN is Registered</h5>"; }

		if ( isset( $err ) ) {

			foreach ( $err as $val ) {
				echo $val;
			}

		} else {
			@$nama_file = $_FILES['file']['name'][$i];
			
			if (empty($_FILES['file']['name'])){
				
			$conn->query("UPDATE dcn set 	dcn_dl = '$dl', dcn_nowf = '$wfno', dcn_type = '$type', dcn_partno = '$partno', dcn_partname = '$partname'
												, dcn_supplier = '$supplier', dcn_no = '$docno', dcn_title = '$title', dcn_spec = '$spec', dcn_effect = '$effect', dcn_rev = '$rev', dcn_model = '$model'
												, dcn_section = '$section', dcn_issue = '$issue', dcn_stat = '$stat', wi_stat = '$wi', pur_stat = '$pur', iqa_stat = '$iqa', pc_stat = '$pc'
												WHERE dcn_id = '$id'");
			$_SESSION['info'] = "Mengubah";
			echo "Sukses";
			}
			else{
			$conn->query("UPDATE dcn set 	dcn_dl = '$dl', dcn_nowf = '$wfno', dcn_type = '$type', dcn_partno = '$partno', dcn_partname = '$partname'
												, dcn_supplier = '$supplier', dcn_no = '$docno', dcn_title = '$title', dcn_spec = '$spec',
												dcn_effect = '$effect', dcn_rev = '$rev', dcn_model = '$model', dcn_section = '$section', dcn_issue = '$issue', dcn_stat = '$stat', wi_stat = '$wi', pur_stat = '$pur', iqa_stat = '$iqa', pc_stat = '$pc'
												WHERE dcn_id = '$id'");
			$dir_file = "../.././files/dcn/";
			
			for ( $i = 0; $i < count( $_FILES['file']['name']); $i++ ) {

		$nama_file = $_FILES['file']['name'][$i];
		$ext = pathinfo( $nama_file, PATHINFO_EXTENSION );
		$ekstensi = array('jpg','jpeg','png','tif','JPG','pdf','PDF','xls','xlsx'); // Ektensi yg diterima
		 
		//filter ektensi file yang diterima
		if( in_array( $ext, $ekstensi ) ) {
 
				if ( move_uploaded_file( $_FILES['file']['tmp_name'][$i], $dir_file . $nama_file ) ) {					
					$conn->query("UPDATE files SET file_name='$nama_file', file_path='./files/dcn/$nama_file'
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
		$conn->query("DELETE FROM dcn WHERE dcn_no = '$id'");
		$conn->query("DELETE FROM files WHERE file_docno = '$id'");
		$_SESSION['info'] = "Menghapus";
		header("location:admin_home.php?page=view_dcn");

	break;
}

ob_end_flush();

?>