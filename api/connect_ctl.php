<?php
	ini_set('display_errors', 1);
	error_reporting(~0);

	$dbstr_ctl ="(DESCRIPTION=
    (ADDRESS=
      (PROTOCOL=TCP)
      (HOST=172.16.6.80)
      (PORT=1521)
    )
    (CONNECT_DATA=
      (SERVER=dedicated)
      (SERVICE_NAME=NYTG)
    )
  )";

	//$conn = oci_connect("WEBCONTROL", "WEBCONTROL", "BISHO.WORLD",'AL32UTF8');
	
	$conn_ctl = oci_connect("WEBCONTROL", "WEBCONTROL", $dbstr_ctl,'UTF8'); //AL32UTF8

  $conn_nyis = oci_connect("NYIS", "NYIS", $dbstr_ctl,'UTF8'); //AL32UTF8

	

?>