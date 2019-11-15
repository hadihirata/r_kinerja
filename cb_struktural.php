<?php

$q = isset($_POST['q']) ? strval($_POST['q']) : '';

include 'conn.php';

$rs = mysql_query("select * from tb_struktural where id like '%$q%' or unit_kerja like '%$q%'");
$rows = array();
while($row = mysql_fetch_assoc($rs)){
	$rows[] = $row;
}
echo json_encode($rows);


?>