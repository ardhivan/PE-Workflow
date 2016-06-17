<html>
<head>
<title>Upload draw</title>
</head>
<body>
<?php
//KONEKSI.. 
$host='localhost';
$username='root';
$password='yemipe';
$database='dbworkflow';
mysql_connect($host,$username,$password);
mysql_select_db($database);
 
if (isset($_POST['submit'])) {//Script akan berjalan jika di tekan tombol submit..
 
//Script Upload File..
    if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
        echo "<h1>" . "File ". $_FILES['filename']['name'] ." Berhasil di Upload" . "</h1>";
        echo "<h2>Menampilkan Hasil Upload:</h2>";
        readfile($_FILES['filename']['tmp_name']);
    }
 
    //Import uploaded file to Database, Letakan dibawah sini..
    $handle = fopen($_FILES['filename']['tmp_name'], "r"); //Membuka file dan membacanya
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
        $import="INSERT into drawing (draw_id, draw_dl, draw_wfno, draw_code, draw_no, draw_partno, draw_partname, draw_category, draw_dcnno, draw_comment, draw_rev, draw_model, draw_issue, draw_filename, draw_file)

		values(NULL,'$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','-','$data[8]','$data[9]','$data[10]','$data[11]', './files/drawing/$data[11]')"; //data array sesuaikan dengan jumlah kolom pada CSV anda mulai dari “0” bukan “1”
		
		$import2="INSERT into files (file_id, file_docno, file_type, file_name, file_path)
		values(NULL,'$data[3]','drawing','$data[11]','./files/drawing/$data[11]')";
        mysql_query($import) or die(mysql_error()); //Melakukan Import
		mysql_query($import2) or die(mysql_error()); //Melakukan Import
    }
 
    fclose($handle); //Menutup CSV file
    echo "<br><strong>Import data selesai.</strong>";
    
}else { //Jika belum menekan tombol submit, form dibawah akan muncul.. ?>
 
<!-- Form Untuk Upload File CSV-->
<h3>Silahkan masukan file csv yang ingin diupload</h3><br /> 
   <form enctype='multipart/form-data' action='' method='post'>
  
   <div class="form-group" style="width:80%;margin:0 auto;border-radius:5px;background:#eee;padding:10px">
	<label for="file">Cari CSV File Drawing:</label>
						   

    <input type='file' name='filename' size='100'>
	<BR/>
   <input type='submit' name='submit' value='Upload'>

    </div>
	

   </form>
 
<?php } mysql_close(); //Menutup koneksi SQL?>
</body>
</html><br><br><br>