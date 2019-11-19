<?php

$q = isset($_POST['q']) ? strval($_POST['q']) : '';
$id=$_GET['id'];
include 'conn.php';

$rs = mysql_query("select * from tb_pegawai where id like '%$q%' or nama_lengkap like '%$q%'");

$items = array();
	while($row = mysql_fetch_object($rs)){

		if ($row->id == $id) {
			$row->selected = true;
		}

		array_push($items, $row);
	}
$result = $items;
echo json_encode ($result);


?>