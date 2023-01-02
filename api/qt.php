<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json;charset=utf-8');

set_time_limit ( 60000 );

use \Psr\Http\Message\ResponseInterface as Response; // ไลบราลี้สำหรับจัดการคำร้องขอ
use \Psr\Http\Message\ServerRequestInterface as Request; // ไลบราลี้สำหรับจัดการคำตอบกลับ

require './vendor/autoload.php'; // ดึงไฟ์ autoload.php เข้ามา

$app = new \Slim\App; // สร้าง object หลักของระบบ

$app->post('/qtlist', function (Request $request, Response $response) {
	// สร้าง route ขึ้นมารองรับการเข้าถึง url

	require './connect_sf5.php';

	// $filter_so = ($_REQUEST['so'] == '') ? "" : " AND SO_NO = '" . $_REQUEST['so'] . "' ";
	// $filter_dte_from = ($_REQUEST['dteS'] == '') ? "" : " AND SO_NO_DATE >= TO_DATE('" . $_REQUEST['dteS'] . "','YYYY/MM/DD') ";
	// $filter_dte_to = ($_REQUEST['dteE'] == '') ? "" : " AND SO_NO_DATE <= TO_DATE('" . $_REQUEST['dteE'] . "','YYYY/MM/DD') ";

	$sql = "SELECT B.SO_NO, B.SCHEDULE_ID, B.OU_CODE, B.BATCH_NO, B.STATUS, B.BATCH_ENTRY_DATE, B.TOTAL_ROLL, B.TOTAL_QTY,
                DEMO.GET_LAST_METHOD_ENG@REPLICA1.WORLD(B.OU_CODE,B.BATCH_NO) STEP_BATCH,
                DEMO.status_batch@REPLICA1.WORLD(B.STATUS) STATUS_BATCH
                ,D.ROLL_PASS, D.QTY_PASS, D.BT_ROLL - D.ROLL_PASS AS REJECT_ROLL, D.BT_QTY - D.QTY_PASS AS REJECT_QTY
                , B.OU_CODE || '-'|| B.BATCH_NO AS KEYS, 'QT' AS QT, 'INS' AS INS
                FROM DFIT_BTDATA B, demo.V_SCH_BT_QTY_PASS@REPLICA1.WORLD D
                WHERE B.STATUS <> '9'
                AND SUBSTR( B.SO_NO,1,1) = '5'
                AND B.OU_CODE = D.OU_CODE(+)
                AND B.BATCH_NO = D.BATCH_NO(+)
                ORDER BY B.SO_NO, BATCH_ENTRY_DATE";

	$query = oci_parse($conn_sf5, $sql);

	oci_execute($query);

	$resultArray = array();

    while($dr=oci_fetch_assoc($query)){
        array_push($resultArray,$dr);
    }

	//$BatchData = oci_fetch_array($query, OCI_ASSOC+OCI_RETURN_NULLS);

	// $data = new stdClass();


	oci_close($conn_sf5);

	$response->getBody()->write(json_encode($resultArray)); // สร้างคำตอบกลับ

	return $response; // ส่งคำตอบกลับ
});

$app->post('/qt', function (Request $request, Response $response) {
	// สร้าง route ขึ้นมารองรับการเข้าถึง url

	require './connect_demo.php';

	$ou = $_REQUEST['ou'];
	$batch = $_REQUEST['batch'];

	$sql = "select * from V_QT_BATCH_RESULT where batch_no = '$batch' and  ou_code = '$ou'";

	$query = oci_parse($conn_omnoi, $sql);

	oci_execute($query);

	$BatchResult = oci_fetch_array($query, OCI_ASSOC+OCI_RETURN_NULLS);


	$sql = "select * from V_QT_CUSTOMER_REQ  
			where qt_no_m in (select ref_no from V_QT_BATCH_RESULT where batch_no = '$batch' and  ou_code = '$ou')
			";

	$queryQT = oci_parse($conn_omnoi, $sql);

	oci_execute($queryQT);

	$QT = oci_fetch_array($queryQT, OCI_ASSOC+OCI_RETURN_NULLS);


	$data = new stdClass();
	$data->Result = $BatchResult;
	$data->QT = $QT;

	oci_close($conn_omnoi);

	$response->getBody()->write(json_encode($data)); // สร้างคำตอบกลับ

	return $response; // ส่งคำตอบกลับ
});


$app->post('/inspec', function (Request $request, Response $response) {
	// สร้าง route ขึ้นมารองรับการเข้าถึง url

	require './connect_demo.php';

	$ou = $_REQUEST['ou'];
	$batch = $_REQUEST['batch'];

	$sql = "SELECT DISTINCT CUSTOMER_NAME, SO_NO, LINE_ID, OU_BATCH, TOTAL_ROLL, TOTAL_QTY, EMP_NAME, COLOR, ITEM, ITEM_DESC, STD_YARD_POINT, C_WIDTH, WEIGHT_G, INS_MC, INS_NO, INSPECTION_DATE
			FROM  V_INSPEC_REP_WEB
			WHERE BATCH = '$batch'
			AND  OU = '$ou'";

	$query = oci_parse($conn_omnoi, $sql);   
    
    oci_execute($query);

    $data = new stdClass();
    
    $resultHead = array();

	   while($dr=oci_fetch_assoc($query)){

	   	$data->{'CUSTOMER_NAME'} = $dr["CUSTOMER_NAME"];
		$data->{'SO_NO'} = $dr["SO_NO"];
		$data->{'LINE_ID'} = $dr["LINE_ID"];
		$data->{'OU_BATCH'} = $dr["OU_BATCH"];
		$data->{'TOTAL_ROLL'} = $dr["TOTAL_ROLL"];
		$data->{'TOTAL_QTY'} = $dr["TOTAL_QTY"];
		$data->{'EMP_NAME'} = $dr["EMP_NAME"];
		$data->{'COLOR'} = $dr["COLOR"];
		$data->{'ITEM'} = $dr["ITEM"];
		$data->{'ITEM_DESC'} = $dr["ITEM_DESC"];
		$data->{'STD_YARD_POINT'} = $dr["STD_YARD_POINT"];
		$data->{'C_WIDTH'} = $dr["C_WIDTH"];
		$data->{'WEIGHT_G'} = $dr["WEIGHT_G"];
		$data->{'INS_MC'} = $dr["INS_MC"];
		$data->{'INS_NO'} = $dr["INS_NO"];
		$data->{'INSPECTION_DATE'} = $dr["INSPECTION_DATE"];
        // array_push($resultHead,$dr);
      }


	$sql = "SELECT M.*,
DECODE(NVL(GR_CODE_01,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_02,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_03,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_04,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_05,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_06,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_07,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_08,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_09,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_10,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_11,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_12,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_13,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_14,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_15,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_16,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_17,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_18,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_19,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_20,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_21,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_22,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_23,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_24,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_25,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_26,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_27,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_28,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_29,'ZZ'),'ZZ',0,1)
+DECODE(NVL(GR_CODE_30,'ZZ'),'ZZ',0,1) AS SUM_GR_CODE
,DEF_POINT_01+DEF_POINT_02+DEF_POINT_03+DEF_POINT_04+DEF_POINT_05
+DEF_POINT_06+DEF_POINT_07+DEF_POINT_08+DEF_POINT_09+DEF_POINT_10
+DEF_POINT_11+DEF_POINT_12+DEF_POINT_13+DEF_POINT_14+DEF_POINT_15
+DEF_POINT_16+DEF_POINT_17+DEF_POINT_18+DEF_POINT_19+DEF_POINT_20
+DEF_POINT_21+DEF_POINT_22+DEF_POINT_23+DEF_POINT_24+DEF_POINT_25
+DEF_POINT_26+DEF_POINT_27+DEF_POINT_28+DEF_POINT_29+DEF_POINT_30  AS SUM_DEF_POINT
,NVL(LENGTH,0) - NVL(TOTAL_DEFECT_YARD,0) AS TOTAL_LENGTH
			FROM  V_INSPEC_REP_WEB M
			WHERE BATCH = '$batch'
			AND  OU = '$ou'
			ORDER BY ROLL_NO";

	$query = oci_parse($conn_omnoi, $sql);   

	oci_execute($query);

    $resultDetail = array();

     $i = 1;
     $row = 1;

     $arrayPage = array();

	while($dr=oci_fetch_assoc($query)){

		$data1 = new stdClass();
		$data1->row = $row;
		$data1->i = $i;

		array_push($arrayPage,$dr);
	

		 if($row==4){
		 	array_push($resultDetail,$arrayPage);
		 	$row=0;
		 	$arrayPage = array();
		 }

		 $row++;
		 $i++;
	}

	if($row!=4){
		array_push($resultDetail,$arrayPage);
	}

	$data->lines = $resultDetail;


	$sql = "select *
from v_inspec_rep_web_total
WHERE BATCH_NO = '$batch'
AND  OU_CODE = '$ou'
ORDER BY 3";

$query2 = oci_parse($conn_omnoi, $sql);   

	oci_execute($query2);

    $resultTotal = array();

while($dr=oci_fetch_assoc($query2)){
	array_push($resultTotal,$dr);
}

	$data->total = $resultTotal;

	oci_close($conn_omnoi);

	$response->getBody()->write(json_encode($data)); // สร้างคำตอบกลับ

	return $response; // ส่งคำตอบกลับ
});


$app->run(); // สั่งให้ระบบทำงาน

?>