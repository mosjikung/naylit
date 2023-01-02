<?php

include_once "connect_naylit_old.php";

$filter_dte_from = ($_REQUEST['dteS'] == '') ? "" : " AND WH.RECEIVE_DATE >= TO_DATE('" . $_REQUEST['dteS'] . "','YYYY/MM/DD')+0.00000 ";
$filter_dte_to = ($_REQUEST['dteE'] == '') ? "" : " AND WH.RECEIVE_DATE <= TO_DATE('" . $_REQUEST['dteE'] . "','YYYY/MM/DD')+0.99999 ";
$filter_so = ($_REQUEST['so'] == '') ? "" : " AND WH.SO_NO LIKE '" . $_REQUEST['so'] . "%' ";

$sql = "SELECT WH.LOC_NO,TRUNC(WH.RECEIVE_DATE) RECEIVE_DATE, 
WH.SALE_ID,S.SALE_NAME , WH.CUSTOMER_ID  ,WH.CUSTOMER_NAME
,WH.SO_NO,NVL(H.NYF_CUS_PO,'N') PO_NO
,WH.PL_NO,WH.BATCH_NO,WH.ITEM_NYF,WH.ITEM_NYF_DESC
,WH.COLOR_ID,WH.COLOR_DESC,TRUNC(WH.APPOINT_DATE) APPOINT_DATE
,WH.ROLL,WH.WEIGHT,WH.DOZ,WH.YARD
,NVL(FN_MPS_WEEK(WH.BATCH_NO, WH.SO_NO),0) MPS_WEEK
,NVL(H.CUSTOMER_FG,0) FG_WEEK
,DECODE(WH.FABRIC_TYPE,'PURCHASE','PURCHASE','DYEHOUSE') FABRIC_TYPE
,H.BUYYER BUYER,WH.OU_CODE,S.TEAM_NAME
,TO_CHAR(WH.SHIPMENT_DATE,'IW') REC_WW,WH.WIDTH
,WH.WEIGHT_G,WH.FG_TYPE,WH.GRADE,(TRUNC(SYSDATE) - TRUNC(WH.RECEIVE_DATE)) AGEING_DAY
,WH.PL_COLORLAB,NVL(WH.SCHEDULE_ID,1) SCHEDULE_ID
FROM FCCS_BU2.DFWH_WAREHOUSE_VIEW WH, SF5.DFORA_SALE S, SF5.SMIT_SO_HEADER H
WHERE  WH.SO_NO = H.SO_NO(+)
AND WH.SALE_ID = S.SALE_ID(+)
$filter_dte_from
$filter_dte_to
$filter_so";

$query = oci_parse($conn_naylit, $sql);

	oci_execute($query);

	$rows = array();
	$nrows = oci_fetch_all($query, $rows, null, null, OCI_FETCHSTATEMENT_BY_ROW); //row array

	$myObj = new stdClass();
	$myObj->total_row = $nrows;
	$myObj->rows = $rows;

oci_close($conn_naylit);

echo json_encode($myObj);
?>