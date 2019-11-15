<?php

$idpg = htmlspecialchars($_REQUEST['nama_lengkap']);
$idjb = htmlspecialchars($_REQUEST['nama_jabatan']);
$idst = htmlspecialchars($_REQUEST['unit_kerja']);

include 'conn.php';

$sql = "insert into tb_jadi (pegawai_id,jabatan_id,unit_kerja_id) value ('$idpg','$idjb','$idst')";
	$result = @mysql_query($sql);
	if ($result){
		echo json_encode(array(
			'id' => mysql_insert_id(),
			'idpg' => $idpg,
			
		));
	} else {
		echo json_encode(array('errorMsg'=>'Some errors occured.'));
	}
?>