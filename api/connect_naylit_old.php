<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json;charset=utf-8');

ini_set('display_errors', 1);
error_reporting(~0);

	$dbstr_sf5 ="(DESCRIPTION=
    (ADDRESS=
      (PROTOCOL=TCP)
      (HOST=172.16.6.74)
      (PORT=1521)
    )
    (CONNECT_DATA=
      (SERVER=dedicated)
      (SERVICE_NAME=NYTG)
    )
  )";

	//$conn = oci_connect("WEBCONTROL", "WEBCONTROL", "BISHO.WORLD",'AL32UTF8');
	
	$conn_naylit = oci_connect("fccs_bu2", "fccs_bu2", $dbstr_sf5,'UTF8'); //AL32UTF8

?>