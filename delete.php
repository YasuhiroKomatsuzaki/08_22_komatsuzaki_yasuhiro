<?php

include('functions.php');

//入力チェック(受信確認処理追加)
if(
  !isset($_GET["id"]) || $_GET["id"]==""
){
  exit('ParamError');
}

//1. POSTデータ取得
$id   = $_GET["id"];

//2. DB接続します(エラー処理追加)
$pdo = db_con();

//３．データ登録SQL作成
$stmt = $pdo->prepare("DELETE FROM gs_user_table WHERE id =:id");
$stmt->bindValue(':id', $id,PDO::PARAM_INT);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
    error_db_info($stmt);
}else{
  //５．index.phpへリダイレクト
  header("Location: select.php");
  exit;
}
?>
