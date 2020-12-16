<?php
// var_dump($_POST);
// exit();
$log = $_POST["log"]; // データ受け取り
$deadline = $_POST["deadline"];
$write_data = "{$deadline} , {$log}\n"; // スペース区切りで最後に改行
$file = fopen('data/log.csv', 'a'); // ファイルを開く 引数はa
flock($file, LOCK_EX); // ファイルをロック
fwrite($file, $write_data); // データに書き込み,
flock($file, LOCK_UN); // ロック解除
fclose($file); // ファイルを閉じる
header("Location:log_txt_input.php");// 入力画面に移動
