<?php

$q = isset($_POST['q']) ? strval($_POST['q']) : '';

include 'conn.php';

$rs = mysql_query("select * from tb_jabatan where id like '%$q%' or nama_jabatan like '%$q%'");
$rows = array();
while($row = mysql_fetch_assoc($rs)){
	$rows[] = $row;
}
echo json_encode($rows);


?>