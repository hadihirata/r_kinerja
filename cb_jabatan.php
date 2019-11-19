<?php

$q = isset($_POST['q']) ? strval($_POST['q']) : '';
$id=$_GET['id'];
include 'conn.php';

$rs = mysql_query("select * from tb_jabatan where id like '%$q%' or nama_jabatan like '%$q%'");
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