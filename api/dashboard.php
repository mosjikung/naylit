<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET,POST");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json;charset=utf-8');

use \Psr\Http\Message\ServerRequestInterface as Request; // ไลบราลี้สำหรับจัดการคำร้องขอ
use \Psr\Http\Message\ResponseInterface as Response;// ไลบราลี้สำหรับจัดการคำตอบกลับ

require './vendor/autoload.php'; // ดึงไฟ์ autoload.php เข้ามา

$app = new \Slim\App; // สร้าง object หลักของระบบ


$app->post('/rm_onhand', function (Request $request, Response $response) { // สร้าง route ขึ้นมารองรับการเข้าถึง url

     $startRow = intval($_REQUEST['startRow']);
     $fetchCount = intval($_REQUEST['fetchCount']);
     $filter = trim($_REQUEST['filter']);
     $sortBy = $_REQUEST['sortBy'];
     $descending = $_REQUEST['descending'];
     $orderBy = "";

     $endRow = $startRow + $fetchCount;

     if ( $descending == "true"){
        $orderBy = "DESC";
     }

    $filter_field = '';
    if($filter!=''){
      $filter_field = "and (UPPER(PO_NO) like UPPER('%$filter%')
                        or UPPER(ITEM_CODE) like UPPER('%$filter%'))
          ";
    }

     require './connect_naylit.php'; 

     $sqlAll = "SELECT CEIL(count(*)/10) TOTALPAGE, count(*) TOTALROW  FROM V_PO_RM_NAYLIT_WH M WHERE BALANCE_RM_KG > 0
          $filter_field
     ";

     $queryAll = oci_parse($conn_naylit, $sqlAll); 

     oci_execute($queryAll);

     $data = new stdClass();
       while($dr=oci_fetch_assoc($queryAll)){
            $data->totalpage = intval($dr["TOTALPAGE"]);
            $data->totalrow = intval($dr["TOTALROW"]);
        }
    

     $sql = "
            SELECT M.*
            FROM (
            SELECT M.*, PO_NO ||'-' || PO_LINE AS KEYID, RANK() OVER (ORDER BY $sortBy $orderBy, BILL_NO) MY_RANK
            FROM V_PO_RM_NAYLIT_WH M
            WHERE BALANCE_RM_KG > 0
            $filter_field
            ) M
            WHERE MY_RANK > $startRow AND MY_RANK <= $endRow ";


     $query = oci_parse($conn_naylit, $sql);   
    
      oci_execute($query);
    
    $resultArray = array();

    

       while($dr=oci_fetch_assoc($query)){
        array_push($resultArray,$dr);
      }


      $data->data = $resultArray;

      oci_close($conn_naylit);

      $response->getBody()->write(json_encode($data)); // สร้างคำตอบกลับ 

      return $response; // ส่งคำตอบกลับ
});

$app->post('/rm_move', function (Request $request, Response $response) { // สร้าง route ขึ้นมารองรับการเข้าถึง url

     $startRow = intval($_REQUEST['startRow']);
     $fetchCount = intval($_REQUEST['fetchCount']);
     $filter = trim($_REQUEST['filter']);
     $sortBy = $_REQUEST['sortBy'];
     $descending = $_REQUEST['descending'];
     $orderBy = "";

     $endRow = $startRow + $fetchCount;

     if ( $descending == "true"){
        $orderBy = "DESC";
     }

    $filter_field = '';
    if($filter!=''){
      $filter_field = "and (UPPER(PO_NO) like UPPER('%$filter%')
                        or UPPER(ITEM_CODE) like UPPER('%$filter%'))
          ";
    }

     require './connect_naylit.php'; 

     $sqlAll = "SELECT CEIL(count(*)/10) TOTALPAGE, count(*) TOTALROW  FROM V_PO_RM_NAYLIT_WH M WHERE 1 = 1
          $filter_field
     ";

     $queryAll = oci_parse($conn_naylit, $sqlAll); 

     oci_execute($queryAll);

     $data = new stdClass();
       while($dr=oci_fetch_assoc($queryAll)){
            $data->totalpage = intval($dr["TOTALPAGE"]);
            $data->totalrow = intval($dr["TOTALROW"]);
        }
    

     $sql = "
            SELECT M.*
            FROM (
            SELECT M.*, PO_NO ||'-' || PO_LINE AS KEYID, RANK() OVER (ORDER BY $sortBy $orderBy, BILL_NO) MY_RANK
            FROM V_PO_RM_NAYLIT_WH M
            WHERE 1 = 1
            $filter_field
            ) M
            WHERE MY_RANK > $startRow AND MY_RANK <= $endRow ";


     $query = oci_parse($conn_naylit, $sql);   
    
      oci_execute($query);
    
    $resultArray = array();

    

       while($dr=oci_fetch_assoc($query)){
        array_push($resultArray,$dr);
      }


      $data->data = $resultArray;

      oci_close($conn_naylit);

      $response->getBody()->write(json_encode($data)); // สร้างคำตอบกลับ 

      return $response; // ส่งคำตอบกลับ
});


$app->post('/export_rmstock', function (Request $request, Response $response) { // สร้าง route ขึ้นมารองรับการเข้าถึง url


    require './connect_naylit.php'; 

    $filter = trim($_REQUEST['filter']);

    $filter_field = '';

    if($filter!=''){
      $filter_field = "and (UPPER(PO_NO) like UPPER('%$filter%')
                        or UPPER(ITEM_CODE) like UPPER('%$filter%'))
          ";
    }



    $sql = "SELECT M.*
            FROM V_PO_RM_NAYLIT_WH M
            WHERE BALANCE_RM_KG > 0
            $filter_field
           ";

      $query = oci_parse($conn_naylit, $sql);      
    
     oci_execute($query);

     $resultArray = array();

     while($dr=oci_fetch_assoc($query)){

         $data = new stdClass();


         $data->{'PO No'}= $dr["PO_NO"];
         $data->{'PO Line'}= $dr["PO_LINE"];
         $data->{'PO Date'}= date("d-M-Y", strtotime($dr["PO_DATE"])); 
         $data->{'Itemcode'}= $dr["ITEM_CODE"];
         $data->{'Receive Type'}= $dr["REC_RM_TYPE"];
         $data->{'Invoice No'}= $dr["BILL_NO"];
         $data->{'Yarn Lot'}= $dr["YARN_LOT"];
         $data->{'Locator'}= $dr["LOCATOR_ID"];
         $data->{'Receive KGS'} = doubleval($dr["REC_RM_KG"]);
         $data->{'Reserve KGS'} = doubleval($dr["RESERVE_RM_KG"]);
         $data->{'Issue KGS'} = doubleval($dr["ISSUE_RM_KG"]);
         $data->{'Balance KGS'} = doubleval($dr["BALANCE_RM_KG"]);
         array_push($resultArray,$data);
     }

     oci_close($conn_naylit);

     $response->getBody()->write(json_encode($resultArray)); // สร้างคำตอบกลับ 

     return $response; // ส่งคำตอบกลับ

});

$app->post('/export_rmmove', function (Request $request, Response $response) { // สร้าง route ขึ้นมารองรับการเข้าถึง url


    require './connect_naylit.php'; 

    $filter = trim($_REQUEST['filter']);

    $filter_field = '';

    if($filter!=''){
      $filter_field = "and (UPPER(PO_NO) like UPPER('%$filter%')
                        or UPPER(ITEM_CODE) like UPPER('%$filter%'))
          ";
    }



    $sql = "SELECT M.*
            FROM V_PO_RM_NAYLIT_WH M
            WHERE 1 = 1
            $filter_field
           ";

      $query = oci_parse($conn_naylit, $sql);      
    
     oci_execute($query);

     $resultArray = array();

     while($dr=oci_fetch_assoc($query)){

         $data = new stdClass();


         $data->{'PO No'}= $dr["PO_NO"];
         $data->{'PO Line'}= $dr["PO_LINE"];
         $data->{'PO Date'}= date("d-M-Y", strtotime($dr["PO_DATE"])); 
         $data->{'Itemcode'}= $dr["ITEM_CODE"];
         $data->{'Receive Type'}= $dr["REC_RM_TYPE"];
         $data->{'Invoice No'}= $dr["BILL_NO"];
         $data->{'Yarn Lot'}= $dr["YARN_LOT"];
         $data->{'Locator'}= $dr["LOCATOR_ID"];
         $data->{'Receive KGS'} = doubleval($dr["REC_RM_KG"]);
         $data->{'Reserve KGS'} = doubleval($dr["RESERVE_RM_KG"]);
         $data->{'Issue KGS'} = doubleval($dr["ISSUE_RM_KG"]);
         $data->{'Balance KGS'} = doubleval($dr["BALANCE_RM_KG"]);
         array_push($resultArray,$data);
     }

     oci_close($conn_naylit);

     $response->getBody()->write(json_encode($resultArray)); // สร้างคำตอบกลับ 

     return $response; // ส่งคำตอบกลับ

});

$app->post('/back5days', function (Request $request, Response $response) { // สร้าง route ขึ้นมารองรับการเข้าถึง url
    
    require './connect_naylit.php'; 

    $sql = "select distinct TO_CHAR(PROCESS_DATE,'YYYY/MM/DD') PROCESS_DATE
            from FCCS_BU2.V_SCH_WIP_AGEING_NAYLIT
            order by 1";

    $query = oci_parse($conn_naylit, $sql); 

    oci_execute($query);

    $resultArray = array();
    $curdate = "";
    while($dr=oci_fetch_assoc($query)){
        array_push($resultArray,$dr["PROCESS_DATE"]);
        $curdate = $dr["PROCESS_DATE"];
    }

    $data = new stdClass();
    $data->curdate = $curdate;
    $data->dates = $resultArray;

     oci_close($conn_naylit);

    $response->getBody()->write(json_encode($data)); // สร้างคำตอบกลับ 

    return $response; // ส่งคำตอบกลับ
});


$app->post('/wip_summary', function (Request $request, Response $response) { // สร้าง route ขึ้นมารองรับการเข้าถึง url

    require './connect_naylit.php'; 

    $dte = $_REQUEST['dte'];
    
    $sql = "select SO_NO_DATE
,SO_NO
,CUSTOMER_ID
,CUSTOMER_NAME
,CUSTOMER_PO
,END_BUYER
,SALE_ID
,SALE_NAME
,TEAM_NAME
,ITEM_CODE
,ITEM_DESC
,COLOR_CODE
,COLOR_DESC
,PLAN_MPS_ID
,PLAN_FGWEEK_IN_WH
,LOADDYE_WEEK
,PO_RM_PURCHASE
,RM_SHIP_DATE
,RM_SHIP_KG
,OU_CODE
,BATCH_NO
,BATCH_ROLL
,BATCH_KG
,STEP_WIP_AGEING
,BT_STATUS
,AGEING_DAY
,START_AGEING_DATE
,GREY_IN_DATE
,PROD_REC_RM_DATE
,BATCH_CREATE_DATE
,FABRIC_DATE
,JOB_DATE
,BATCH_CLOSE_DATE
,STD_GF_COST_KG
,ACT_GF_COST_KG
,WIP_LOSS_KG
,WIP_LOSS_PERCENT
,BAL_WAIT_FG_REC
,FG_START_REC_DATE
,FG_REC_KG
,FG_SHIP_KG
,FG_LAST_SHIP_DATE
,BAL_WAIT_FG_SHIP
,DYE_SDATE
,DYE_EDATE
,GREY_ACTIVE, MPS_MC_NO, soline_qty
,SUM(CASE WHEN SUBSTR(MPS_WIP_STEP,1,1) = '1' THEN MPS_PLAN_KG ELSE 0 END) STEP01
,SUM(CASE WHEN SUBSTR(MPS_WIP_STEP,1,1) = '2' THEN MPS_PLAN_KG ELSE 0 END) STEP02
,SUM(CASE WHEN SUBSTR(MPS_WIP_STEP,1,1) = '3' THEN MPS_PLAN_KG ELSE 0 END) STEP03
,SUM(CASE WHEN SUBSTR(MPS_WIP_STEP,1,1) = '4' THEN MPS_PLAN_KG ELSE 0 END) STEP04
,SUM(CASE WHEN SUBSTR(MPS_WIP_STEP,1,1) = '5' THEN MPS_PLAN_KG ELSE 0 END) STEP05
,SUM(CASE WHEN SUBSTR(MPS_WIP_STEP,1,1) = '6' THEN MPS_PLAN_KG ELSE 0 END) STEP06
,SUM(CASE WHEN SUBSTR(MPS_WIP_STEP,1,1) = '7' THEN MPS_PLAN_KG ELSE 0 END) STEP07
,SUM(CASE WHEN SUBSTR(MPS_WIP_STEP,1,1) = '8' THEN MPS_PLAN_KG ELSE 0 END) STEP08
,SUM(CASE WHEN SUBSTR(MPS_WIP_STEP,1,1) = '9' THEN MPS_PLAN_KG ELSE 0 END) STEP09
,SUM(MPS_PLAN_KG) TOTAL
FROM FCCS_BU2.V_SCH_WIP_AGEING_NAYLIT
WHERE TRUNC(PROCESS_DATE)= TO_DATE('$dte','YYYY/MM/DD')
GROUP BY SO_NO_DATE
,SO_NO
,CUSTOMER_ID
,CUSTOMER_NAME
,CUSTOMER_PO
,END_BUYER
,SALE_ID
,SALE_NAME
,TEAM_NAME
,ITEM_CODE
,ITEM_DESC
,COLOR_CODE
,COLOR_DESC
,PLAN_MPS_ID
,PLAN_FGWEEK_IN_WH
,LOADDYE_WEEK
,PO_RM_PURCHASE
,RM_SHIP_DATE
,RM_SHIP_KG
,OU_CODE
,BATCH_NO
,BATCH_ROLL
,BATCH_KG
,STEP_WIP_AGEING
,BT_STATUS
,AGEING_DAY
,START_AGEING_DATE
,GREY_IN_DATE
,PROD_REC_RM_DATE
,BATCH_CREATE_DATE
,FABRIC_DATE
,JOB_DATE
,BATCH_CLOSE_DATE
,STD_GF_COST_KG
,ACT_GF_COST_KG
,WIP_LOSS_KG
,WIP_LOSS_PERCENT
,BAL_WAIT_FG_REC
,FG_START_REC_DATE
,FG_REC_KG
,FG_SHIP_KG
,FG_LAST_SHIP_DATE
,BAL_WAIT_FG_SHIP
,DYE_SDATE
,DYE_EDATE
,GREY_ACTIVE, MPS_MC_NO, soline_qty
ORDER BY loaddye_week, plan_fgweek_in_wh, so_no";

    $query = oci_parse($conn_naylit, $sql); 



    oci_execute($query);

    $resultArray = array();
  
    while($dr=oci_fetch_assoc($query)){
        array_push($resultArray,$dr);
    }



$sqlSum = "select 1 as KEYS, SUM(CASE WHEN SUBSTR(MPS_WIP_STEP,1,1) = '1' THEN MPS_PLAN_KG ELSE 0 END) STEP01
,SUM(CASE WHEN SUBSTR(MPS_WIP_STEP,1,1) = '2' THEN MPS_PLAN_KG ELSE 0 END) STEP02
,SUM(CASE WHEN SUBSTR(MPS_WIP_STEP,1,1) = '3' THEN MPS_PLAN_KG ELSE 0 END) STEP03
,SUM(CASE WHEN SUBSTR(MPS_WIP_STEP,1,1) = '4' THEN MPS_PLAN_KG ELSE 0 END) STEP04
,SUM(CASE WHEN SUBSTR(MPS_WIP_STEP,1,1) = '5' THEN MPS_PLAN_KG ELSE 0 END) STEP05
,SUM(CASE WHEN SUBSTR(MPS_WIP_STEP,1,1) = '6' THEN MPS_PLAN_KG ELSE 0 END) STEP06
,SUM(CASE WHEN SUBSTR(MPS_WIP_STEP,1,1) = '7' THEN MPS_PLAN_KG ELSE 0 END) STEP07
,SUM(CASE WHEN SUBSTR(MPS_WIP_STEP,1,1) = '8' THEN MPS_PLAN_KG ELSE 0 END) STEP08
,SUM(CASE WHEN SUBSTR(MPS_WIP_STEP,1,1) = '9' THEN MPS_PLAN_KG ELSE 0 END) STEP09
,SUM(MPS_PLAN_KG) TOTAL
FROM FCCS_BU2.V_SCH_WIP_AGEING_NAYLIT
WHERE TRUNC(PROCESS_DATE)= TO_DATE('$dte','YYYY/MM/DD')";

 $querySum = oci_parse($conn_naylit, $sqlSum); 



     oci_execute($querySum);

      $resultArraySum = array();
  
    while($dr=oci_fetch_assoc($querySum)){
        array_push($resultArraySum,$dr);
    }



      

      $data = new stdClass();
      $data->rows= $resultArray;
      $data->summary = $resultArraySum;

      oci_close($conn_naylit);

      $response->getBody()->write(json_encode($data)); // สร้างคำตอบกลับ 

      return $response; // ส่งคำตอบกลับ
});





$app->post('/wip', function (Request $request, Response $response) { // สร้าง route ขึ้นมารองรับการเข้าถึง url

     $startRow = intval($_REQUEST['startRow']);
     $fetchCount = intval($_REQUEST['fetchCount']);
     $filter = trim($_REQUEST['filter']);
     $sortBy = $_REQUEST['sortBy'];
     $descending = $_REQUEST['descending'];
     $event = $_REQUEST['event'];
     $param = $_REQUEST['param'];
     $dte = $_REQUEST['dte'];

     $orderBy = "";

     $endRow = $startRow + $fetchCount;

     if ( $descending == "true"){
        $orderBy = "DESC";
     }

    $filter_field = '';
    if($filter!=''){
      $filter_field = "and (UPPER(SO_NO) like UPPER('$filter%')
                        or UPPER(CUSTOMER_NAME) like UPPER('$filter%')
                        or UPPER(END_BUYER) like UPPER('$filter%')
                        or UPPER(ITEM_CODE) like UPPER('%$filter%')
                        or UPPER(COLOR_CODE) like UPPER('%$filter%')
                        or UPPER(PO_RM_PURCHASE) like UPPER('$filter%')
          )";
    }

    $filter_event = '';

    if($event=='LOADWEEK'){
        $filter_event = "AND LOADDYE_WEEK = '$param' ";
    }else if ($event=='FGWEEK'){
        $filter_event = "AND PLAN_FGWEEK_IN_WH = '$param' ";
    }else if ($event=='SO'){
        $filter_event = "AND SO_NO = '$param' ";
    }



     require './connect_naylit.php'; 

     $sqlAll = "SELECT CEIL(count(*)/10) TOTALPAGE, count(*) TOTALROW  FROM V_SCH_WIP_AGEING_NAYLIT M WHERE trunc(process_date)= trunc(sysdate)-1
          $filter_field
          $filter_event
     ";

     $queryAll = oci_parse($conn_naylit, $sqlAll); 

     oci_execute($queryAll);

     $data = new stdClass();
       while($dr=oci_fetch_assoc($queryAll)){
            $data->totalpage = intval($dr["TOTALPAGE"]);
            $data->totalrow = intval($dr["TOTALROW"]);
        }
    

     $sql = "
            SELECT M.*
            FROM (
            SELECT M.*, ROWIDTOCHAR(ROWID)  AS KEYID, RANK() OVER (ORDER BY $sortBy $orderBy, ROWID) MY_RANK
            FROM V_SCH_WIP_AGEING_NAYLIT M
            WHERE trunc(process_date) = TO_DATE('$dte','YYYY/MM/DD')
            $filter_field
            $filter_event
            ) M
            WHERE MY_RANK > $startRow AND MY_RANK <= $endRow ";

             $data->filter = $filter;

     $query = oci_parse($conn_naylit, $sql);   
    
      oci_execute($query);
    
    $resultArray = array();

    

       while($dr=oci_fetch_assoc($query)){
        array_push($resultArray,$dr);
      }


      $data->data = $resultArray;

      oci_close($conn_naylit);

      $response->getBody()->write(json_encode($data)); // สร้างคำตอบกลับ 

      return $response; // ส่งคำตอบกลับ
});


$app->post('/export_wip', function (Request $request, Response $response) { // สร้าง route ขึ้นมารองรับการเข้าถึง url


    require './connect_naylit.php'; 

    $filter = trim($_REQUEST['filter']);
    $event = $_REQUEST['event'];
    $param = $_REQUEST['param'];
    $dte = $_REQUEST['dte'];
  

    $filter_field = '';

    if($filter!=''){
      $filter_field = "and (UPPER(SO_NO) like UPPER('$filter%')
                        or UPPER(CUSTOMER_NAME) like UPPER('$filter%')
                        or UPPER(END_BUYER) like UPPER('$filter%')
                        or UPPER(ITEM_CODE) like UPPER('%$filter%')
                        or UPPER(COLOR_CODE) like UPPER('%$filter%')
                        or UPPER(PO_RM_PURCHASE) like UPPER('$filter%')
          )";
    }

    $filter_event = '';

    if($event=='LOADWEEK'){
        $filter_event = "AND LOADDYE_WEEK = '$param' ";
    }else if ($event=='FGWEEK'){
        $filter_event = "AND PLAN_FGWEEK_IN_WH = '$param' ";
    }else if ($event=='SO'){
        $filter_event = "AND SO_NO = '$param' ";
    }



    $sql = "SELECT M.*
            FROM V_SCH_WIP_AGEING_NAYLIT M
            WHERE trunc(process_date) = TO_DATE('$dte','YYYY/MM/DD')
            $filter_field
            $filter_event
           ";

      $query = oci_parse($conn_naylit, $sql);      
    
     oci_execute($query);

     $resultArray = array();

     while($dr=oci_fetch_assoc($query)){

         $data = new stdClass();


            $data->{'SO No'}= $dr["SO_NO"];
            $data->{'SO Line'}= $dr["LINE_ID"];
            $data->{'SO Date'}= date("d-M-Y", strtotime($dr["SO_NO_DATE"])); 
            $data->{'Cus. ID'}= $dr["CUSTOMER_ID"];
            $data->{'Cus. Name'}= $dr["CUSTOMER_NAME"];
            $data->{'Cus. PO'}= $dr["CUSTOMER_PO"];
            $data->{'End Buyer'}= $dr["END_BUYER"];
            $data->{'Sales ID'}= $dr["SALE_ID"];
            $data->{'Sales Name'}= $dr["SALE_NAME"];
            $data->{'Team'}= $dr["TEAM_NAME"];
            $data->{'Itemcode'}= $dr["ITEM_CODE"];
            $data->{'Item Desc.'}= $dr["ITEM_DESC"];
            $data->{'Color Code'}= $dr["COLOR_CODE"];
            $data->{'Color Desc.'}= $dr["COLOR_DESC"];
            $data->{'Plan MPS'}= $dr["PLAN_MPS_ID"];
            $data->{'Plan FG Week'}= $dr["PLAN_FGWEEK_IN_WH"];
            $data->{'Load Week'}= $dr["LOADDYE_WEEK"];
            $data->{'Plan KGS'}= doubleval($dr["MPS_PLAN_KG"]);
            $data->{'PO'}= $dr["PO_RM_PURCHASE"];
            $data->{'RM Ship Date'}= date("d-M-Y", strtotime($dr["RM_SHIP_DATE"])); 
            $data->{'RM Ship KGS'}= doubleval($dr["RM_SHIP_KG"]);
            $data->{'M/C No.'}= $dr["MPS_MC_NO"];
            $data->{'OU'}= $dr["OU_CODE"];
            $data->{'Batch No.'}= $dr["BATCH_NO"];
            $data->{'Batch Rolls'}= doubleval($dr["BATCH_ROLL"]);
            $data->{'Batch KGS'}= doubleval($dr["BATCH_KG"]);
            $data->{'Step WIP Aging'}= $dr["STEP_WIP_AGEING"];
            $data->{'Aging Day'}= doubleval($dr["AGEING_DAY"]);
            $data->{'Aging Start Date'}= date("d-M-Y", strtotime($dr["START_AGEING_DATE"])); 
            $data->{'WIP Loss KGS'}= doubleval($dr["WIP_LOSS_KG"]);
            $data->{'WIP Loss %'}= doubleval($dr["WIP_LOSS_PERCENT"]);
            $data->{'Bal. Wait FG Rec.'}= doubleval($dr["BAL_WAIT_FG_REC"]);
            $data->{'FG Start Rec. Date'}= date("d-M-Y", strtotime($dr["FG_START_REC_DATE"])); 
            $data->{'FG Rec. KGS'}= doubleval($dr["FG_REC_KG"]);
            $data->{'FG Ship KGS'}= doubleval($dr["FG_SHIP_KG"]);
            $data->{'FG Last Ship Date'}= date("d-M-Y", strtotime($dr["FG_LAST_SHIP_DATE"])); 
            $data->{'Bal Wait FG Ship'}= doubleval($dr["BAL_WAIT_FG_SHIP"]);
            $data->{'Order Qty.'}= doubleval($dr["SOLINE_QTY"]);
            $data->{'WIP Status'}= $dr["MPS_WIP_STEP"];


         array_push($resultArray,$data);
     }

     oci_close($conn_naylit);

     $response->getBody()->write(json_encode($resultArray)); // สร้างคำตอบกลับ 

     return $response; // ส่งคำตอบกลับ

});


$app->run(); // สั่งให้ระบบทำงาน

?>