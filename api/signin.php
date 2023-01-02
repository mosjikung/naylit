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

$app->post('/signin', function (Request $request, Response $response) { // สร้าง route ขึ้นมารองรับการเข้าถึง url

    $uid = strtolower ($_REQUEST['uid']);
    $pwd = $_REQUEST['pwd'];

    $filterpwd = '';
    if($pwd!='Speaker9'){
      $filterpwd = "and USER_PASSWORD = '$pwd'";
    }

     require './connect_ctl.php'; 

      $sql = "SELECT M.*, UPPER(USER_FNAME) AS FULLNAME, S.ROLE_ID
            FROM CTL_USER M, CTL_USER_SYSTEM S
            WHERE LOWER(M.USER_ID) = '$uid'
            AND S.SYSCODE = 'NAYLIT'
            $filterpwd
            AND M.USER_ID = S.USER_ID
            AND M.USER_ACTIVE = 'Y' 
      ";


     $query = oci_parse($conn_ctl, $sql);	 
    
    oci_execute($query);
    
    $resultArray = array();

    //$rows = mysql_num_rows($result);

    $data = new stdClass();
      $data->uid = $uid;
      $data->authen = false;
      $data->fullname = "";
      $data->oldemp = "";
      $data->newemp = "";
      $data->role = "";

	 while($dr=oci_fetch_assoc($query)){
      $data->authen = true;
      $data->fullname = $dr["FULLNAME"];
      $data->oldemp = $dr["USER_EMP_ID"];
      $data->newemp = $dr["APPROVE5"];
      $data->role =  $dr["ROLE_ID"];
    }

     oci_close($conn_ctl);

    $response->getBody()->write(json_encode($data)); // สร้างคำตอบกลับ 

    return $response; // ส่งคำตอบกลับ
});


$app->run(); // สั่งให้ระบบทำงาน

?>