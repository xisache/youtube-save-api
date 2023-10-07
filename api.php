<?php

header('Content-Type: application/json; charset=utf-8');

function info($q){
    $url = "https://yt1s.com/api/ajaxSearch/index";
    $ch = curl_init();
    $data = array("q" => $q, "vt" => "home");
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}

function convert($vid, $k){
    $url = "https://yt1s.com/api/ajaxConvert/convert";
    $ch = curl_init();
    $data = array("vid" => $vid, "k" => $k);
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}

if(!isset($_GET['method'])) {
    echo json_encode(array("status" => 'error', "mess" => "Method not entered"));
    exit();
}

$method = $_GET['method'];
if($method == 'info'){
    try {
        $url = $_GET['url'];
        echo json_encode(info($url));
    }catch(Exception $e) {
        echo json_encode(array("status" => 'error', "mess" => $e->getMessage()));
    }
}
elseif($method == "convert"){
    try {
        $vid = $_GET['vid'];
        $k = str_replace(" ", "+", $_GET['k']); # GET so'rovda + yo'qolib qolishi inobatga olinib
        echo json_encode(convert($vid, $k));
    }catch(Exception $e) {
        echo json_encode(array("status" => 'error', "mess" => $e->getMessage()));
    }
}else{
    echo json_encode(array("status" => 'error', "mess" => "There is no such method"));
    exit();
}                

?>