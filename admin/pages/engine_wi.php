<?php

ob_start();

include "connect.php";

switch ( $_GET['p'] ) {

	default: echo "Halaman tidak ditemukan"; break;

	case "tambah":
	
		$model 	 = $_POST['model'];
		$section = $_POST['section'];
		$docno 	 = $_POST['docno'];
		$title 	 = $_POST['title'];
		$stage 	 = $_POST['stage'];
		$status	 = $_POST['status'];
		$issue = $_POST['issue'];
		$rev 	 = $_POST['rev'];
		$maker = $_POST['maker'];


		empty( $model ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Model Name is Empty</h5>" : "";
		empty( $section ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Section is Empty</h5>" : "";
		empty( $docno ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> WI No is Empty</h5>" : "";
		empty( $title ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> WI Title is Empty</h5>" : "";
		empty( $stage ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Production is Stage Empty</h5>" : "";
		empty( $status) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> WI Status is Empty</h5>" : "";
		empty( $issue ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> WI Issue is Empty</h5>" : "";
		
		empty( $maker ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> WI Maker is Empty</h5>" : "";

		
		

		if ( isset( $err ) ) {

			foreach ( $err as $val ) {
				echo $val;
			}

		} else {
			
			@$lokasi_filewi= $_FILES['wi']['tmp_name'];
			@$nama_filewi= $_FILES['wi']['name'];
			@$uploaddir_wi="../.././files/wi/$nama_filewi";
			$dir_wi = "./files/wi/$nama_filewi";
			
			@$lokasi_filedcc= $_FILES['dcc']['tmp_name'];
			@$nama_filedcc= $_FILES['dcc']['name'];
			@$uploaddir_dcc="../.././files/wi/$nama_filedcc";
			$dir_dcc = "./files/wi/$nama_filedcc";
			
			@$lokasi_filemasterlist= $_FILES['masterlist']['tmp_name'];
			@$nama_filemasterlist= $_FILES['masterlist']['name'];
			@$uploaddir_masterlist="../.././files/wi/$nama_filemasterlist";
			$dir_masterlist = "./files/wi/$nama_filemasterlist";
			
			if (empty($lokasi_filewi or $lokasi_filedcc or $lokasi_filemasterlist)){
				
			$conn->query("INSERT INTO wi VALUES ('','$model','$section','$docno','$title','$stage','$status','$issue','$rev','$maker','','','','','','')");
			$_SESSION['info'] = "Menyimpan";
			echo "Sukses";
			
			}else {
			move_uploaded_file($lokasi_filewi,"$uploaddir_wi");
			move_uploaded_file($lokasi_filedcc,"$uploaddir_dcc");
			move_uploaded_file($lokasi_filemasterlist,"$uploaddir_masterlist");	
			$conn->query("INSERT INTO wi VALUES ('','$model','$section','$docno','$title','$stage','$status','$issue','$rev','$maker','$nama_filewi','$dir_wi','$nama_filedcc','$dir_dcc','$nama_filemasterlist','$dir_masterlist')");
			$_SESSION['info'] = "Menyimpan";
			echo "Sukses";
			}
		}

	break;

	case "update":

		$id 	= $_POST['id'];
		$model 	 = $_POST['model'];
		$section = $_POST['section'];
		$docno 	 = $_POST['docno'];
		$title 	 = $_POST['title'];
		$stage 	 = $_POST['stage'];
		$status	 = $_POST['status'];
		$issue	 = $_POST['issue'];
		$rev	 = $_POST['rev'];
		$maker	 = $_POST['maker'];
		
		empty( $model ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Model Name is Empty</h5>" : "";
		empty( $section ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Section is Empty</h5>" : "";
		empty( $docno ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> WI No is Empty</h5>" : "";
		empty( $title ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> WI Title is Empty</h5>" : "";
		empty( $stage ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> Production is Stage Empty</h5>" : "";
		empty( $status ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> WI Status is Empty</h5>" : "";
		empty( $issue ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> WI Issue is Empty</h5>" : "";
		
		empty( $maker ) 	 ? $err[] = "<h5><span class='fa fa-exclamation'></span> WI Maker is Empty</h5>" : "";

		

		if ( isset( $err ) ) {

			foreach ( $err as $val ) {
				echo $val;
			}

		} else {
			@$lokasi_filewi= $_FILES['editwi']['tmp_name'];
			@$nama_filewi= $_FILES['editwi']['name'];
			$uploaddir_wi="../.././files/wi/$nama_filewi";
			$dir_wi = "./files/wi/$nama_filewi";
			
			@$lokasi_filedcc= $_FILES['editdcc']['tmp_name'];
			@$nama_filedcc= $_FILES['editdcc']['name'];
			$uploaddir_dcc="../.././files/wi/$nama_filedcc";
			$dir_dcc = "./files/wi/$nama_filedcc";
			
			@$lokasi_filemasterlist= $_FILES['masterlist']['tmp_name'];
			@$nama_filemasterlist= $_FILES['masterlist']['name'];
			@$uploaddir_masterlist="../.././files/wi/$nama_filemasterlist";
			$dir_masterlist = "./files/wi/$nama_filemasterlist";
			
			//kalo file tidak dirubah
			if (empty($lokasi_filewi or $lokasi_filedcc or $lokasi_filemasterlist)){
				$conn->query("UPDATE wi SET wi_model = '$model', wi_section = '$section', wi_docno = '$docno', wi_title = '$title', wi_stagestat = '$stage', wi_status = '$status', wi_issue = '$issue', wi_rev = '$rev', wi_maker = '$maker'
							WHERE wi_id = '$id'");
				$_SESSION['info'] = "Mengubah";
				echo "Sukses";
			} else{ //kalo file dirubah
				move_uploaded_file($lokasi_filewi,"$uploaddir_wi");
				move_uploaded_file($lokasi_filedcc,"$uploaddir_dcc");
				move_uploaded_file($lokasi_filemasterlist,"$uploaddir_masterlist");	
				$conn->query("UPDATE wi SET wi_model = '$model', wi_section = '$section', wi_docno = '$docno', wi_title = '$title', wi_stagestat = '$stage', wi_status = '$status', wi_issue = '$issue', wi_rev = '$rev', wi_maker = '$maker', wi_filename = '$nama_filewi', wi_file = '$dir_wi', wi_filename2 = '$nama_filedcc', wi_file2 = '$dir_dcc', wi_filename3 = '$nama_filemasterlist', wi_file3 = '$dir_masterlist'
				WHERE wi_id = '$id'");
			$_SESSION['info'] = "Mengubah";
			echo "Sukses";
			}
		}

	break;

	case "hapus" :

		$id = $_GET['id'];
		$conn->query("DELETE FROM wi WHERE wi_docno = '$id'");
		$_SESSION['info'] = "Menghapus";
		header("location:admin_home.php?page=view_wi");

	break;
}

ob_end_flush();

?>