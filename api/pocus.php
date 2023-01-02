<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json;charset=utf-8');

use \Psr\Http\Message\ResponseInterface as Response; // ไลบราลี้สำหรับจัดการคำร้องขอ
use \Psr\Http\Message\ServerRequestInterface as Request; // ไลบราลี้สำหรับจัดการคำตอบกลับ

require './vendor/autoload.php'; // ดึงไฟ์ autoload.php เข้ามา

$app = new \Slim\App; // สร้าง object หลักของระบบ

$app->post('/listcuspo', function (Request $request, Response $response) {
	// สร้าง route ขึ้นมารองรับการเข้าถึง url

		require './connect_naylit.php';

	$year = $_REQUEST['year'];

	$sql = "SELECT M.*, ROWNUM as KEY FROM V_CUSTOMER_PO_NAYLIT M WHERE EXTRACT(YEAR FROM PO_RECIVED_DATE) = $year";

	$query = oci_parse($conn_naylit, $sql);

	oci_execute($query);

	$resultArray = array();

	while ($dr = oci_fetch_assoc($query)) {
		array_push($resultArray, $dr);
	}

	oci_close($conn_naylit);

	$response->getBody()->write(json_encode($resultArray)); // สร้างคำตอบกลับ

	return $response; // ส่งคำตอบกลับ
});


$app->post('/export', function (Request $request, Response $response) {
	// สร้าง route ขึ้นมารองรับการเข้าถึง url

		require './connect_naylit.php';

	$year = $_REQUEST['year'];

	$sql = "SELECT M.*, ROWNUM as KEY FROM V_CUSTOMER_PO_NAYLIT M  WHERE EXTRACT(YEAR FROM PO_RECIVED_DATE) = $year";

	$query = oci_parse($conn_naylit, $sql);

	oci_execute($query);

	$resultArray = array();

	$row = 1;

	while ($dr = oci_fetch_assoc($query)) {


		 $data = new stdClass();

		$data->{'No'}= $row;
		$data->{'Sourcing Office Name'}= $dr["SOURCEING_OFFICE"];
		$data->{'Factory Customer Name'}= $dr["FACTORY_CUSTOMER_NAME"];
		$data->{'Fabric Disc'}= $dr["FABRIC_DESC"];
		$data->{'PO'}= $dr["PO_NO"];
		$data->{'Sample Type'}= $dr["SAMPLE_TYPE"];
		$data->{'PO Recived Date'}= date("d-M-Y", strtotime($dr["PO_RECIVED_DATE"])); 
		$data->{'Ship/SchDate (Plan Ship)'}= date("d-M-Y", strtotime($dr["PLAN_SHIPDATE"])); 
		$data->{'EX-Fac. Actual Ship'}= date("d-M-Y", strtotime($dr["FACTORY_SHIPDATE"])); 
		$data->{'IM# Cord'}= $dr["IM_CORD"];
		$data->{'Item Naylit'}= $dr["ITEM_NAYLIT"];
		$data->{'Color'}= $dr["COLOR_PO_DESC"];
		$data->{'Color Code'}= $dr["COLOR_CODE"];
		$data->{'Shp/Sch Qty Yard'} = doubleval($dr["ORDER_QTY"]);
		$data->{'Actual Shipped Qty Yard'} = doubleval($dr["SHIP_QTY"]);
		$data->{'FOC Qty Yard'} = doubleval($dr["FOC_QTY"]);
		$data->{'PI No'}= $dr["PI_NO"];
		$data->{'SO No'}= $dr["SO_NO"];
		$data->{'Invoice No'}= $dr["INV_NO"];
		$data->{'Remark'}= $dr["LINE_REMARK"];

		$row++;

         array_push($resultArray,$data);


	}

	oci_close($conn_naylit);

	$response->getBody()->write(json_encode($resultArray)); // สร้างคำตอบกลับ

	return $response; // ส่งคำตอบกลับ
});

$app->run(); // สั่งให้ระบบทำงาน

?>