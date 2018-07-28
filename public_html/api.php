<?php
date_default_timezone_set('Asia/Singapore');
# Set time date_default_timezone_set

$name = isset($_POST['name']) ? htmlspecialchars($_POST["name"], ENT_QUOTES) :  "employeeA";
$r_eve = "coffee break on 31-Jul";
# ↑ POST送信を処理。三項演算子を用いて、中身が入っていないときは入っていないことを明示的にしている。isset関数は、中身が入っているか判断している

$json_array = array(
    'time' => date("Y-m-d H:i:s"),
    'name' => $name,
    'recommended_event' => $r_eve,
);

header("Content-Type: text/javascript; charset=utf-8");

echo json_encode($json_array);
?>
