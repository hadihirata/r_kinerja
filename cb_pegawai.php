<?php

$q = isset($_POST['q']) ? strval($_POST['q']) : '';

include 'conn.php';

$rs = mysql_query("select * from tb_pegawai where id like '%$q%' or nama_lengkap like '%$q%'");
$rows = array();
while($row = mysql_fetch_assoc($rs)){
	$rows[] = $row;
}
echo json_encode($rows);


?>