<?php
$strAccessToken = "Vy4e77ZaBMpKv/WQrGKBNNbmCG0CkO9ucHTPIXPiwrTglX/iWRZG8OwuUDHN5QU9aLU2hP5nSiwyxskB5f+y1dtkjlY6Jm+85rZyM18BgXR+hwEEZZVmBZe+1Vhzib1iAklaKkNJbrjRqaXB7bvvrAdB04t89/1O/w1cDnyilFU=";

$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);
$strUrl = "https://api.line.me/v2/bot/message/reply";
$_userId = $arrJson['events'][0]['source']['userId'];
$_msg = $arrJson['events'][0]['message']['text'];
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";
$filename = 'text.txt';
if (file_exists($filename)) {
$myfile = fopen('text.txt', "w+") or die("Unable to open file!");
fwrite($myfile, $_msg);
fclose($myfile);
} else {
$myfile = fopen('text.txt', "x+") or die("Unable to open file!");
fwrite($myfile, $_msg);
fclose($myfile);
}
if($arrJson['events'][0]['message']['text'] == "สวัสดี"){
$arrPostData = array();
$arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
$arrPostData['messages'][0]['type'] = "text";
$arrPostData['messages'][0]['text'] = "สวัสดี ID ของคุณคือ ".$arrJson['events'][0]['source']['userId'];
}else if($arrJson['events'][0]['message']['text'] == "turnleft"){
$arrPostData = array();
$arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
$arrPostData['messages'][0]['type'] = "text";
$arrPostData['messages'][0]['text'] = "Bot : เลี้ยวซ้าย";
}else if($arrJson['events'][0]['message']['text'] == "turnright"){
$arrPostData = array();
$arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
$arrPostData['messages'][0]['type'] = "text";
$arrPostData['messages'][0]['text'] = "Bot : เลี้ยวขวา";
}else if($arrJson['events'][0]['message']['text'] == "forback"){
$arrPostData = array();
$arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
$arrPostData['messages'][0]['type'] = "text";
$arrPostData['messages'][0]['text'] = "Bot : ถอยหลัง";
}else if($arrJson['events'][0]['message']['text'] == "forward"){
$arrPostData = array();
$arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
$arrPostData['messages'][0]['type'] = "text";
$arrPostData['messages'][0]['text'] = "Bot : ตรงไปข้างหน้า";
}else if($arrJson['events'][0]['message']['text'] == "stop"){
$arrPostData = array();
$arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
$arrPostData['messages'][0]['type'] = "text";
$arrPostData['messages'][0]['text'] = "Bot : หยุด";
}else{
$arrPostData = array();
$arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
$arrPostData['messages'][0]['type'] = "text";
$arrPostData['messages'][0]['text'] = "Bot :ไม่เข้าใจคำสั่ง";
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$strUrl);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close ($ch);
?>
