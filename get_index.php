<?php 

	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
    $searchid = isset($_POST['searchid']) ? mysql_real_escape_string($_POST['searchid']) : '';
	$offset = ($page-1)*$rows;
	$result = array();

	include 'conn.php';
	$where = "where nama_lengkap like '$searchid%' ";

	$rs = mysql_query("SELECT  count(*) from index_view ". $where);

	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	$rs = mysql_query("select * from index_view " . $where . " limit $offset,$rows");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);

 ?>