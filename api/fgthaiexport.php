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

	$resultArray = array();

       while($dr=oci_fetch_assoc($query)){

         $data = new stdClass();


         $data->{'LOC_NO'}= $dr["LOC_NO"];
         $data->{'FG_FINISH_DATE'}= date("d-M-Y", strtotime($dr["RECEIVE_DATE"])); 
         $data->{'SALE_ID'}= $dr["SALE_ID"];
         $data->{'SALE_NAME'}= $dr["SALE_NAME"];
         $data->{'CUSTOMER_ID'}= $dr["CUSTOMER_ID"];
         $data->{'CUSTOMER_NAME'}= $dr["CUSTOMER_NAME"];
         $data->{'SO_NO'}= $dr["SO_NO"];
         $data->{'PO_NO'}= $dr["PO_NO"];
         $data->{'BATCH_NO'}= $dr["BATCH_NO"];
         $data->{'PL_NO'} = $dr["PL_NO"];
         $data->{'ITEM_CODE'} = $dr["ITEM_NYF"];
         $data->{'ITEM_DESC'} = $dr["ITEM_NYF_DESC"];
         $data->{'COLOR_ID'} = $dr["COLOR_ID"];
         $data->{'COLOR_DESC'} = $dr["COLOR_DESC"];
         $data->{'APPOINT_DATE'} = date("d-M-Y", strtotime($dr["APPOINT_DATE"])); 

         $data->{'ROLL'}=  intval($dr["ROLL"]);
         $data->{'WEIGHT'}= doubleval($dr["WEIGHT"]);
         $data->{'DOZ'}= doubleval($dr["DOZ"]);
         $data->{'YARD'}= doubleval($dr["YARD"]);
         $data->{'MPS_WEEK'}= $dr["MPS_WEEK"];
         $data->{'FG_WEEK'}= $dr["FG_WEEK"];
         $data->{'FABRIC_TYPE'}= $dr["FABRIC_TYPE"];
         $data->{'BUYER'}= $dr["BUYER"];
         $data->{'OU_CODE'} = $dr["OU_CODE"];
         $data->{'TEAM_NAME'} = $dr["TEAM_NAME"];
         $data->{'REC_WW'} = $dr["REC_WW"];
         $data->{'WIDTH'} = $dr["WIDTH"];

         $data->{'WEIGHT_G'}= $dr["WEIGHT_G"];
         $data->{'FG_TYPE'}= $dr["FG_TYPE"];
         $data->{'GRADE'}= $dr["GRADE"];
         $data->{'AGEING_DAY'} = intval($dr["AGEING_DAY"]);
         $data->{'PL_COLORLAB'} = $dr["PL_COLORLAB"];
         $data->{'SCHEDULE_ID'} = $dr["SCHEDULE_ID"];



         array_push($resultArray,$data);
     }



oci_close($conn_naylit);

echo json_encode($resultArray);
?>