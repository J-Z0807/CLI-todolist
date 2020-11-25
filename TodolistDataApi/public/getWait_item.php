<?php
header("Content-Type:text/html;charset=utf-8");
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Expose-Headers: *');

//擷取檔案網址
$URL = "https://todolist-data.firebaseio.com/wait_item.json";

//建立連線
$curl = curl_init();
//設定擷取的URL網址
curl_setopt($curl, CURLOPT_URL, $URL);
//將結果傳回，不出現在畫面上
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//執行CURL連線
$response = curl_exec($curl);

$response = json_decode($response);

//如果有資料才執行
if (!is_null($response)) {
    $jsonData = []; //做key值轉換，否則在前端會有錯誤
    $index = 0;
    foreach ($response as $key => $value) {
        $jsonData[$index]['uuid'] = $key;
        $jsonData[$index]['id'] = $value->id;
        $jsonData[$index]['text'] = $value->text;
        $index++;
    }
    //回傳擷取結果
    echo json_encode($jsonData);
}

//關閉CURL連線
curl_close($curl);
