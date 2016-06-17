<html>
<head>
<title>Upload WI</title>
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
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $import="INSERT into wi (wi_id, wi_model, wi_section, wi_docno, wi_title, wi_stagestat, wi_status, wi_issuetp, wi_revtp, wi_makertp, wi_issuemp, wi_revmp, wi_makermp, wi_filename, wi_file, wi_file2)

		values(NULL, '$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','./files/wi/$data[12]','./files/wi/$data[13]')"; //data array sesuaikan dengan jumlah kolom pada CSV anda mulai dari “0” bukan “1”
        mysql_query($import) or die(mysql_error()); //Melakukan Import
    }
 
    fclose($handle); //Menutup CSV file
    echo "<br><strong>Import data selesai.</strong>";
    
}else { //Jika belum menekan tombol submit, form dibawah akan muncul.. ?>
 
<!-- Form Untuk Upload File CSV-->
<h3>Silahkan masukan file csv yang ingin diupload</h3><br /> 
   <form enctype='multipart/form-data' action='' method='post'>
  
   <div class="form-group" style="width:80%;margin:0 auto;border-radius:5px;background:#eee;padding:10px">
	<label for="file">Cari CSV File WI:</label>
						   

    <input type='file' name='filename' size='100'>
	<BR/>
   <input type='submit' name='submit' value='Upload'>

    </div>
	

   </form>
 
<?php } mysql_close(); //Menutup koneksi SQL?>
</body>
</html><br><br><br>