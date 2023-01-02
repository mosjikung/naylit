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

$app->post('/year_array', function (Request $request, Response $response) { // สร้าง route ขึ้นมารองรับการเข้าถึง url
    
	$datasets = array();
	array_push($datasets,'2019');
	array_push($datasets,'2018');



    $response->getBody()->write(json_encode($datasets)); // สร้างคำตอบกลับ 

    return $response; // ส่งคำตอบกลับ
});

$app->post('/year_init', function (Request $request, Response $response) { // สร้าง route ขึ้นมารองรับการเข้าถึง url
    
    require './connect_naylit.php'; 

    $sql = 'select * from web_init';

    $query = oci_parse($conn_naylit, $sql);      
    
    oci_execute($query);

    $info = oci_fetch_array($query, OCI_ASSOC); //Return Object มีหลายบรรทัด จะได้ แค่รายการเดียว

    $response->getBody()->write(json_encode($info)); // สร้างคำตอบกลับ 

    return $response; // ส่งคำตอบกลับ
});



$app->run(); // สั่งให้ระบบทำงาน

?>