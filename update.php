<?php
include('functions.php');
//1.POSTでParamを取得

//入力チェック(受信確認処理追加)
if(
    !isset($_POST["name"]) || $_POST["name"]=="" ||
    !isset($_POST["lid"]) || $_POST["lid"]=="" ||
    !isset($_POST["lpw"]) || $_POST["lpw"]==""||
    !isset($_POST["kanri_flg"]) || $_POST["kanri_flg"]==""||
    !isset($_POST["life_flg"]) || $_POST["life_flg"]==""||
    !isset($_POST["id"]) || $_POST["id"]==""
  ){
    exit('ParamError');
  }

  $name   = $_POST["name"];
  $lid  = $_POST["lid"];
  $lpw = $_POST["lpw"];
  $kanri_flg = $_POST["kanri_flg"];
  $life_flg = $_POST["life_flg"];
  $id = $_POST["id"];

//2.DB接続など
$pdo=db_con();

//3.UPDATE gs_user_table SET ....; で更新(bindValue)
//　基本的にinsert.phpの処理の流れです。
$update = $pdo->prepare("UPDATE gs_user_table SET name=:name,lid=:lid,lpw=:lpw WHERE id=:id");
$update->bindValue(':name',$name,PDO::PARAM_STR);
$update->bindValue(':lid',$lid,PDO::PARAM_STR);
$update->bindValue(':lpw',$lpw,PDO::PARAM_STR);
$update->bindValue(':kanri_flg',$kanri_flg,PDO::PARAM_STR);
$update->bindValue(':life_flg',$life_flg,PDO::PARAM_STR);
$update->bindValue(':id',$id,PDO::PARAM_INT);
$status = $update->execute();

//４．データ登録処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    error_db_info($stmt);
  }else{
    //５．index.phpへリダイレクト
    header("Location: select.php");
    exit;
  }

?>
