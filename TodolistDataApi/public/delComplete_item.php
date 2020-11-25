<?php
header("Content-Type:text/html;charset=utf-8");
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Expose-Headers: *');

//抓取資料
$uuid = $_SERVER['QUERY_STRING'];

//擷取檔案網址
$URL = "https://todolist-data.firebaseio.com/complete_item/{$uuid}.json";

//建立連線
$curl = curl_init();
//設定擷取的URL網址
curl_setopt($curl, CURLOPT_URL, $URL);
//將結果傳回，不出現在畫面上
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//刪除資料
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");

//執行CURL連線
$response = curl_exec($curl);
//關閉CURL連線
curl_close($curl);
