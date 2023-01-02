<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json;charset=utf-8');

	ini_set('display_errors', 1);
	error_reporting(~0);

	$serverName = "172.16.9.20";
	$userName = "adminNYTG";
	$userPassword = "Spe@ker1981";
    $dbName = "nytg_center";

    $conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
	

	$uid = strtoupper($_REQUEST['uid']);
	$syscode = $_REQUEST['syscode'];
	$key = $_REQUEST['key'];



	$sql = "SELECT *
			FROM trn_signin m
			WHERE userid = '$uid'
			AND genkey = '$key'
			AND syscode = '$syscode'
			AND signin_date = DATE(NOW())";

	$query = mysqli_query($conn,$sql);
	if (!$query) {
	      exit();
	}

	$data = new stdClass();
	$data->authen = false;

	while($dr = mysqli_fetch_array($query, MYSQLI_ASSOC))
	{
	      $data->authen = true;
	}


	mysqli_close($conn);
		
	echo json_encode($data);

?>