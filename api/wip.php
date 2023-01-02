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

$app->post('/listso', function (Request $request, Response $response) {
	// สร้าง route ขึ้นมารองรับการเข้าถึง url

	require './connect_naylit.php';

	$filter_so = ($_REQUEST['so'] == '') ? "" : " AND SO_NO = '" . $_REQUEST['so'] . "' ";
	$filter_dte_from = ($_REQUEST['dteS'] == '') ? "" : " AND SO_NO_DATE >= TO_DATE('" . $_REQUEST['dteS'] . "','YYYY/MM/DD') ";
	$filter_dte_to = ($_REQUEST['dteE'] == '') ? "" : " AND SO_NO_DATE <= TO_DATE('" . $_REQUEST['dteE'] . "','YYYY/MM/DD') ";

	$sql = "SELECT SO_NO, TO_CHAR(SO_NO_DATE,'YYYY-MM-DD') SO_NO_DATE, PO_NO, REMARK, NYF_BUYER, CUSTOMER_YEAR, CUSTOMER_FG, SO_PROD_CLOSED
    		,(SELECT SUM(ORDERED_QUANTITY) FROM SF5.SMIT_SO_LINE L WHERE L.SO_NO = C.SO_NO) ORDERED_QUANTITY
			FROM SF5.SMIT_SO_HEADER C
			WHERE EXISTS (SELECT A.* FROM  SF5.DFIT_MC_SCHEDULE A
			WHERE C.SO_NO = A.SO_NO
			AND A.TEAM_NAME = 'T-NAYLIT')
			$filter_so
			$filter_dte_from
			$filter_dte_to
			";

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

$app->post('/sodetail', function (Request $request, Response $response) {
	// สร้าง route ขึ้นมารองรับการเข้าถึง url

	require './connect_naylit.php';

	$filter_so = ($_REQUEST['so'] == '') ? "" : " AND SO_NO = '" . $_REQUEST['so'] . "' ";

	$sql = "SELECT L.*
    ,(SELECT SUM(FABRIC_QUANTITY) FROM  SF5.DFIT_MC_SCHEDULE S WHERE S.SO_NO = L.SO_NO AND S.LINE_ID = L.LINE_ID AND S.NYK_CANCLE_SCH IS NULL) SCHEDULE_QUANTITY
			FROM SF5.SMIT_SO_LINE L
			WHERE 1 = 1
			$filter_so
			";

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

$app->post('/schedule', function (Request $request, Response $response) {
	// สร้าง route ขึ้นมารองรับการเข้าถึง url

	require './connect_sf5.php';

	$so = $_REQUEST['so'];
	$filter_so = ($_REQUEST['so'] == '') ? "" : " AND S.SO_NO = '" . $_REQUEST['so'] . "' ";
	$filter_line = ($_REQUEST['line'] == '') ? "" : " AND S.LINE_ID = '" . $_REQUEST['line'] . "' ";

	//  $sql = "SELECT SCHEDULE_ID, FABRIC_QUANTITY,
	//    TO_CHAR(FABRIC_RECEIVE,'YYYY-MM-DD') FABRIC_RECEIVE,
	//    TO_CHAR(DYE_SCHEDULE,'YYYY-MM-DD') DYE_SCHEDULE,
	//    TO_CHAR(FG_DATE,'YYYY-MM-DD') FG_DATE,
	//    MC_SIZE, MACHINE_NO,
	//    TO_CHAR(DYE_END_DATE,'YYYY-MM-DD') DYE_END_DATE,
	//
	// TO_CHAR(REQUESTED_DATE,'YYYY-MM-DD') REQUESTED_DATE
	// FROM SF5.DFIT_MC_SCHEDULE S
	// WHERE 1 = 1
	// $filter_so
	// $filter_line
	// ";
	//
		// B.nyk_fg_weight as fg_kgs, B.nyk_fg_target as fg_yard
		//,NVL(Y.QTY,0) AS FG_KG, NVL(Y.yard,0) AS FG_YARD

	$sql = "SELECT S.SCHEDULE_ID, S.FABRIC_QUANTITY, S.MACHINE_NO, S.MC_SIZE, S.TEAM_WORK_YEAR, S.TEAM_WORK_WEEK
    ,B.GREY_ACTIVE,B.FABRIC_RECEIVE,B.NYK_REC_DATE,NVL(B.NYK_REC_WEIGHT,0) NYK_REC_WEIGHT ,B.DYE_END_DATE,
    B.NYK_FG_DATE,B.NYK_FG_WEIGHT,B.NYK_FG_NO,B.NYK_SHP_CUST,B.NYK_SHPCUST_DATE,
    (SELECT COUNT(BATCH_NO) FROM DFIT_BTDATA BT WHERE BT.SCHEDULE_ID = S.SCHEDULE_ID and STATUS<>'9') BATCH_CNT
    ,B.nyk_fg_weight as FG_KG, B.nyk_fg_target as FG_YARD
    ,(SELECT MAX(P.PO_NO)
FROM FCCS_BU2.FMIT_PK_HEADER P
WHERE P.SCHEDULE_ID=S.SCHEDULE_ID) PO_RM
            FROM SF5.DFIT_MC_SCHEDULE S, DFIT_MC_SCH_OMNOI B,
            (
            SELECT SCHEDULE_ID, SUM(FABRIC_WEIGHT) QTY,SUM(YARD) YARD
            FROM FCCS_BU2.DFWH_WAREHOUSE
            GROUP BY SCHEDULE_ID
            ) Y
            WHERE S.SCHEDULE_ID = B.SCHEDULE_ID(+)
            AND S.SCHEDULE_ID = Y.SCHEDULE_ID(+)
            AND S.NYK_CANCLE_SCH IS NULL
            AND SUBSTR( S.SO_NO,1,1) = '5'
            $filter_so
            $filter_line";

	//  --      TO_CHAR(FABRIC_RECEIVE,'YYYY-MM-DD') FABRIC_RECEIVE,
	// --      TO_CHAR(DYE_SCHEDULE,'YYYY-MM-DD') DYE_SCHEDULE,
	// --      TO_CHAR(FG_DATE,'YYYY-MM-DD') FG_DATE,
	// --      TO_CHAR(DYE_END_DATE,'YYYY-MM-DD') DYE_END_DATE,
	// --      WORK_WEEK_YEAR, WORK_WEEK_NO,
	// --      TO_CHAR(REQUESTED_DATE,'YYYY-MM-DD') REQUESTED_DATE

	$query = oci_parse($conn_sf5, $sql);

	oci_execute($query);

	$resultArray = array();

	while ($dr = oci_fetch_assoc($query)) {

		$data = new stdClass();

		$data->{'SCHEDULE_ID'} = $dr["SCHEDULE_ID"];
		$data->{'FABRIC_QUANTITY'} = $dr["FABRIC_QUANTITY"];
		$data->{'MACHINE_NO'} = $dr["MACHINE_NO"];
		$data->{'MC_SIZE'} = $dr["MC_SIZE"];
		$data->{'TEAM_WORK_YEAR'} = $dr["TEAM_WORK_YEAR"];
		$data->{'TEAM_WORK_WEEK'} = $dr["TEAM_WORK_WEEK"];
		$data->{'GREY_ACTIVE'} = $dr["GREY_ACTIVE"];
		$data->{'FABRIC_RECEIVE'} = $dr["FABRIC_RECEIVE"];
		$data->{'NYK_REC_DATE'} = $dr["NYK_REC_DATE"];
		$data->{'NYK_REC_WEIGHT'} = $dr["NYK_REC_WEIGHT"];
		$data->{'DYE_END_DATE'} = $dr["DYE_END_DATE"];

		$data->{'NYK_FG_DATE'} = $dr["NYK_FG_DATE"];
		$data->{'NYK_FG_WEIGHT'} = $dr["NYK_FG_WEIGHT"];
		$data->{'NYK_FG_NO'} = $dr["NYK_FG_NO"];
		$data->{'NYK_SHP_CUST'} = $dr["NYK_SHP_CUST"];
		$data->{'NYK_SHPCUST_DATE'} = $dr["NYK_SHPCUST_DATE"];
		$data->{'BATCH_CNT'} = $dr["BATCH_CNT"];
		$data->{'FG_KG'} = $dr["FG_KG"];
		$data->{'FG_YARD'} = $dr["FG_YARD"];

		$data->{'LOSS_KG'} = round(doubleval($dr["NYK_REC_WEIGHT"])-doubleval($dr["FG_KG"]),2);

		if(doubleval($dr["NYK_REC_WEIGHT"])!=0)
		{
			$data->{'LOSS_P'} = round((doubleval($dr["NYK_REC_WEIGHT"])-doubleval($dr["FG_KG"]))/doubleval($dr["NYK_REC_WEIGHT"]),2);
		}else{
			$data->{'LOSS_P'} = 0;
		}
		$data->{'PO_RM'} = $dr["PO_RM"];

		$sch = $dr["SCHEDULE_ID"];

		// $sql = "SELECT B.BATCH_NO, STATUS, BATCH_ENTRY_DATE, TOTAL_ROLL, TOTAL_QTY,
    //             DEMO.GET_LAST_METHOD_ENG@REPLICA1.WORLD(B.OU_CODE,B.BATCH_NO) STEP_BATCH,
    //             DEMO.status_batch@REPLICA1.WORLD(STATUS) STATUS_BATCH
    //             FROM DFIT_BTDATA B
    //             WHERE STATUS <> '9' --CALCEL BATCH
    //             AND SO_NO = '$so'
    //             AND SCHEDULE_ID = '$sch'
    //             ORDER BY BATCH_ENTRY_DATE";

		$sql = "SELECT B.BATCH_NO, B.STATUS, B.BATCH_ENTRY_DATE, B.TOTAL_ROLL, B.TOTAL_QTY,
                DEMO.GET_LAST_METHOD_ENG@REPLICA1.WORLD(B.OU_CODE,B.BATCH_NO) STEP_BATCH,
                DEMO.status_batch@REPLICA1.WORLD(B.STATUS) STATUS_BATCH
                ,D.ROLL_PASS, D.QTY_PASS, D.BT_ROLL - D.ROLL_PASS AS REJECT_ROLL, D.BT_QTY - D.QTY_PASS AS REJECT_QTY
                FROM DFIT_BTDATA B, demo.V_SCH_BT_QTY_PASS@REPLICA1.WORLD D
                WHERE B.STATUS <> '9'
                AND B.SO_NO = '$so'
                AND B.SCHEDULE_ID = '$sch'
                AND B.OU_CODE = D.OU_CODE(+)
                AND B.BATCH_NO = D.BATCH_NO(+)
                ORDER BY BATCH_ENTRY_DATE";

		$queryBatch = oci_parse($conn_sf5, $sql);

		oci_execute($queryBatch);

		$resultArrayBatch = array();

		while ($drB = oci_fetch_assoc($queryBatch)) {
			array_push($resultArrayBatch, $drB);
		}

		$data->Batch = $resultArrayBatch;

		// $data->{'FABRIC_QUANTITY'}= doubleval($dr["FABRIC_QUANTITY"]);
		// $data->{'FABRIC_RECEIVE'}= date("Y-m-d", strtotime($dr["FABRIC_RECEIVE"]));
		// $data->{'DYE_SCHEDULE'}= date("Y-m-d", strtotime($dr["DYE_SCHEDULE"]));
		// $data->{'FG_DATE'}= date("Y-m-d", strtotime($dr["FG_DATE"]));
		// $data->{'DYE_END_DATE'}= date("Y-m-d", strtotime($dr["DYE_END_DATE"]));
		// $data->{'REQUESTED_DATE'}= date("Y-m-d", strtotime($dr["REQUESTED_DATE"]));

		array_push($resultArray, $data);
	}

	oci_close($conn_sf5);

	$response->getBody()->write(json_encode($resultArray)); // สร้างคำตอบกลับ

	return $response; // ส่งคำตอบกลับ
});


$app->post('/wip_export', function (Request $request, Response $response) { // สร้าง route ขึ้นมารองรับการเข้าถึง url


    require './connect_sf5.php'; 


    $filter_so = ($_REQUEST['so'] == '') ? "" : " AND M.SO_NO = '" . $_REQUEST['so'] . "' ";
	$filter_dte_from = ($_REQUEST['dteS'] == '') ? "" : " AND M.SO_NO_DATE >= TO_DATE('" . $_REQUEST['dteS'] . "','YYYY/MM/DD') ";
	$filter_dte_to = ($_REQUEST['dteE'] == '') ? "" : " AND M.SO_NO_DATE <= TO_DATE('" . $_REQUEST['dteE'] . "','YYYY/MM/DD') ";

    $role = $_REQUEST['role'];

//TO_CHAR(C.SO_NO_DATE,'YYYY-MM-DD')

    $sql = "SELECT M.*,
D.*
FROM
(
SELECT C.SO_NO, C.SO_NO_DATE SO_NO_DATE, C.PO_NO, C.REMARK, C.NYF_BUYER, C.CUSTOMER_YEAR, C.CUSTOMER_FG, TO_CHAR(C.SO_PROD_CLOSED,'YYYY-MM-DD') SO_PROD_CLOSED
    		--,(SELECT SUM(ORDERED_QUANTITY) FROM SF5.SMIT_SO_LINE L WHERE L.SO_NO = C.SO_NO) ORDERED_QUANTITY
            ,L.LINE_ID, L.ITEM_CODE, L.ITEM_DESC, L.COLOR_CODE, L.CANCLED_QUANTITY, L.ORDERED_QUANTITY, L.UOM, L.PL_COLORLAB
            ,(SELECT SUM(FABRIC_QUANTITY) FROM  SF5.DFIT_MC_SCHEDULE S WHERE S.SO_NO = L.SO_NO AND S.LINE_ID = L.LINE_ID AND S.NYK_CANCLE_SCH IS NULL) SCHEDULE_QUANTITY
			FROM SF5.SMIT_SO_HEADER C, SF5.SMIT_SO_LINE L
			WHERE C.SO_NO = L.SO_NO
            AND EXISTS (SELECT A.* FROM  SF5.DFIT_MC_SCHEDULE A
			WHERE C.SO_NO = A.SO_NO
			AND A.TEAM_NAME = 'T-NAYLIT')
        ) M,(
        SELECT S.SO_NO, S.LINE_ID , S.SCHEDULE_ID, S.FABRIC_QUANTITY, S.MACHINE_NO, S.MC_SIZE, S.TEAM_WORK_YEAR, S.TEAM_WORK_WEEK
    ,B.GREY_ACTIVE, TO_CHAR(B.FABRIC_RECEIVE,'YYYY-MM-DD') FABRIC_RECEIVE, TO_CHAR(B.NYK_REC_DATE,'YYYY-MM-DD') NYK_REC_DATE,NVL(B.NYK_REC_WEIGHT,0) NYK_REC_WEIGHT , TO_CHAR(B.DYE_END_DATE,'YYYY-MM-DD') DYE_END_DATE,
    TO_CHAR(B.NYK_FG_DATE,'YYYY-MM-DD') NYK_FG_DATE,B.NYK_FG_WEIGHT,B.NYK_FG_NO,B.NYK_SHP_CUST, TO_CHAR(B.NYK_SHPCUST_DATE,'YYYY-MM-DD') NYK_SHPCUST_DATE,
    (SELECT COUNT(BATCH_NO) FROM DFIT_BTDATA BT WHERE BT.SCHEDULE_ID = S.SCHEDULE_ID and STATUS<>'9') BATCH_CNT
    ,NVL(B.nyk_fg_weight,0) AS FG_KG, NVL(B.nyk_fg_target,0) AS FG_YARD
    ,(select max(p.po_no) 
from fccs_bu2.fmit_pk_header p
where p.schedule_id=S.SCHEDULE_ID) po_RM
            FROM SF5.DFIT_MC_SCHEDULE S, DFIT_MC_SCH_OMNOI B

            WHERE S.SCHEDULE_ID = B.SCHEDULE_ID(+)
            
            AND S.NYK_CANCLE_SCH IS NULL
            AND substr( S.SO_NO,1,1) = '5'
        ) D
   WHERE M.SO_NO = D.SO_NO
   AND M.LINE_ID = D.LINE_ID
   $filter_so
   $filter_dte_from
   $filter_dte_to
   ORDER BY M.SO_NO, M.LINE_ID, D.SCHEDULE_ID
					 ";
					 
					  //            ,(
            // SELECT SCHEDULE_ID, SUM(FABRIC_WEIGHT) QTY,SUM(YARD) YARD
            // FROM FCCS_BU2.DFWH_WAREHOUSE
            // GROUP BY SCHEDULE_ID
						// ) Y
						// AND S.SCHEDULE_ID = Y.SCHEDULE_ID(+)

      $query = oci_parse($conn_sf5, $sql);      
    
     oci_execute($query);

     $resultArray = array();

     while($dr=oci_fetch_assoc($query)){

          $data = new stdClass();

          $data->{'SO_NO'}= $dr["SO_NO"];
          $data->{'SO_NO_DATE'}= date("Y-m-d", strtotime($dr["SO_NO_DATE"])); 
          $data->{'PO_NO'}= $dr["PO_NO"];
          $data->{'REMARK'}= $dr["REMARK"];
          $data->{'NYF_BUYER'}= $dr["NYF_BUYER"];
          $data->{'CUSTOMER_YEAR'}= $dr["CUSTOMER_YEAR"];
          $data->{'CUSTOMER_FG'}= $dr["CUSTOMER_FG"];
          //$data->{'SO_PROD_CLOSED'}= date("d-M-Y", strtotime($dr["SO_PROD_CLOSED"])); 
          $data->{'SO_PROD_CLOSED'}= $dr["SO_PROD_CLOSED"]; 
		  $data->{'LINE_ID'}= $dr["LINE_ID"];
		  $data->{'ITEM_CODE'}= $dr["ITEM_CODE"];
		  $data->{'ITEM_DESC'}= $dr["ITEM_DESC"];
		  $data->{'COLOR_CODE'}= $dr["COLOR_CODE"];
		  $data->{'CANCLED_QUANTITY'}= doubleval($dr["CANCLED_QUANTITY"]);
		  $data->{'ORDERED_QUANTITY'}= doubleval($dr["ORDERED_QUANTITY"]);
		  $data->{'UOM'}= $dr["UOM"];
		  $data->{'PL_COLORLAB'}= $dr["PL_COLORLAB"];
		  $data->{'SCHEDULE_QUANTITY'}= doubleval($dr["SCHEDULE_QUANTITY"]);
		  $data->{'SCHEDULE_ID'}= $dr["SCHEDULE_ID"];
		  $data->{'FABRIC_QUANTITY'}= doubleval($dr["FABRIC_QUANTITY"]);
		  $data->{'MACHINE_NO'}= $dr["MACHINE_NO"];
		  $data->{'MC_SIZE'}= doubleval($dr["MC_SIZE"]);
		  $data->{'TEAM_WORK_YEAR'}= intval($dr["TEAM_WORK_YEAR"]);
		  $data->{'TEAM_WORK_WEEK'}= intval($dr["TEAM_WORK_WEEK"]);
		  $data->{'GREY_ACTIVE'}= $dr["GREY_ACTIVE"];
		  // $data->{'FABRIC_RECEIVE'}= date("d-M-Y", strtotime($dr["FABRIC_RECEIVE"])); 
		  // $data->{'NYK_REC_DATE'}= date("d-M-Y", strtotime($dr["NYK_REC_DATE"])); 
		  $data->{'FABRIC_RECEIVE'}= $dr["FABRIC_RECEIVE"]; 
		  $data->{'NYK_REC_DATE'}= $dr["NYK_REC_DATE"]; 

		  $data->{'NYK_REC_WEIGHT'}= doubleval($dr["NYK_REC_WEIGHT"]);
		  $data->{'FG_KG'}= doubleval($dr["FG_KG"]);
		  $data->{'LOSS_KG'} = round(doubleval($dr["NYK_REC_WEIGHT"])-doubleval($dr["FG_KG"]),2);

		  if($role=='ADMIN'){
			  $data->{'LOSS_KG'} = round(doubleval($dr["NYK_REC_WEIGHT"])-doubleval($dr["FG_KG"]),2);
			  if(doubleval($dr["NYK_REC_WEIGHT"])!=0)
			  {
				$data->{'LOSS_P'} = round((doubleval($dr["NYK_REC_WEIGHT"])-doubleval($dr["FG_KG"]))/doubleval($dr["NYK_REC_WEIGHT"]),2);
			  }else{
				$data->{'LOSS_P'} = 0;
			  }
			}
		  $data->{'FG_YARD'}= doubleval($dr["FG_YARD"]);
		  // $data->{'DYE_END_DATE'}= date("d-M-Y", strtotime($dr["DYE_END_DATE"])); 
		  // $data->{'NYK_FG_DATE'}= date("d-M-Y", strtotime($dr["NYK_FG_DATE"])); 
		  $data->{'DYE_END_DATE'}= $dr["DYE_END_DATE"]; 
		  $data->{'NYK_FG_DATE'}= $dr["NYK_FG_DATE"]; 
		  $data->{'NYK_FG_WEIGHT'}= doubleval($dr["NYK_FG_WEIGHT"]);
		  $data->{'NYK_FG_NO'}= $dr["NYK_FG_NO"];
		  $data->{'NYK_SHP_CUST'}= doubleval($dr["NYK_SHP_CUST"]);
		  // $data->{'NYK_SHPCUST_DATE'}= date("d-M-Y", strtotime($dr["NYK_SHPCUST_DATE"])); 
		  $data->{'NYK_SHPCUST_DATE'}= $dr["NYK_SHPCUST_DATE"]; 
		  $data->{'BATCH_CNT'}= intval($dr["BATCH_CNT"]);
		  $data->{'PO_RM'}= $dr["PO_RM"];

      
         array_push($resultArray,$data);
     }

     oci_close($conn_sf5);

     $response->getBody()->write(json_encode($resultArray)); // สร้างคำตอบกลับ 

     return $response; // ส่งคำตอบกลับ

});

$app->run(); // สั่งให้ระบบทำงาน

?>
