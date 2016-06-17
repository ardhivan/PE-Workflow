<html>
<head>
<title>Upload Files</title>
</head>
<body>
<?php
//KONEKSI.. 
include "connect.php";
 
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
        $import="INSERT into files (file_id, file_docno, file_type, file_name, file_path)

		values(NULL,'$data[0]','$data[1]', '$data[2]', './files/$data[1]/$data[2]')"; //data array sesuaikan dengan jumlah kolom pada CSV anda mulai dari “0” bukan “1”
        mysql_query($import) or die(mysql_error()); //Melakukan Import
    }
 
    fclose($handle); //Menutup CSV file
    echo "<br><strong>Import data selesai.</strong>";
    
}else { //Jika belum menekan tombol submit, form dibawah akan muncul.. ?>
 
<!-- Form Untuk Upload File CSV-->
   Silahkan masukan file csv yang ingin diupload<br /> 
   <form enctype='multipart/form-data' action='' method='post'>
    Cari CSV File anda:<br />
    <input type='file' name='filename' size='100'>
   <input type='submit' name='submit' value='Upload'></form>
 
<?php } mysql_close(); //Menutup koneksi SQL?>
</body>
</html><br><br><br>