<?php
require_once("mysqlminang.php");
$p=new Mysqlminang("dbworkflow","localhost","root","yemipe");
$sql="Select * from jadwal";
foreach($p->GetAllRows($sql) as $row)

{
	$type=$row->stat;

	switch ($type) {
    case "close":
        $class='gray';
        break;
    case "open":
        $class='#3399FF';
        break;
	}
	$data[]=array(
				'title'=>$row->judul,
				'start'=>$row->tgl1,
				'end'=>$row->tgl2,
				'allDay'=>true,
				'backgroundColor'=>$class
				);
				
}

	echo json_encode($data);
?>



