<?php
header("Content-Type:text/html;charset=utf-8");
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Expose-Headers: *');
//抓取資料
$postData = file_get_contents('php://input');
$requests = !empty($postData) ? json_decode($postData, true) : array();

$id = $requests['id'];
$uuid = $requests['uuid'];
$text = $requests['text'];

$data = "{\"" . $uuid . "\":{\"id\":" . $id . ",\"text\":\"" . $text . "\"}}";

//擷取檔案網址
$URL = "https://todolist-data.firebaseio.com/wait_item.json";

//建立連線
$curl = curl_init();
//設定擷取的URL網址
curl_setopt($curl, CURLOPT_URL, $URL);
//將結果傳回，不出現在畫面上
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//新增資料
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//執行CURL連線
$response = curl_exec($curl);
//回傳擷取結果
echo json_encode($response);
//關閉CURL連線
curl_close($curl);
