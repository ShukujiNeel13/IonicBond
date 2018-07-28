<?php
date_default_timezone_set('Asia/Singapore');
# ↑ タイムゾーンをセット
 
$name = isset($_POST['name']) ? htmlspecialchars($_POST["name"], ENT_QUOTES) :  "no name posted";
$uni = isset($_POST['uni']) ? htmlspecialchars($_POST["uni"], ENT_QUOTES) : "no uni name posted";
# ↑ POST送信を処理。三項演算子を用いて、中身が入っていないときは入っていないことを明示的にしている。isset関数は、中身が入っているか判断している
 
$json_array = array(
    'time' => date("Y-m-d H:i:s"),
    'name' => $name,
    'university' => $uni,
);
# ↑ JSON 形式にする
 
header("Content-Type: text/javascript; charset=utf-8");
# ↑ 半分おまじない。JSONで送りますよという合図
 
echo json_encode($json_array);
# ↑ JSON 形式にエンコードしてechoでPOST送信
?>
