<?php include_once "db.php";

// echo "<br>";
// echo 'count->' .$Admin->count(['acc'=> $_POST['acc'],'pw'=>$_POST['pw']]); 
// echo "<br>";
// 有意人士帳號輸入: ' OR 1=1;  <=SQL注入

// 過濾表單
// $acc=htmlspecialchars($_POST['acc']);
// $pw=htmlspecialchars($_POST['pw']);


if($Admin->count(['acc'=> $_POST['acc'],'pw'=>$_POST['pw']])>0){
    // 資料庫來的
    // 如果用find會傳回資料，流量會增加，算數字有一筆就登入成功
    // 只是要檢查有沒有登入成功，也可避免資料外洩或被攔截
    $_SESSION['login']=$_POST['acc'];
    // 用count所以是表單來的資料，表單來的比較值觀
    to("../back.php");
    // 登入狀態用session，用php會比較方便自動啟用，db裡已經有seesion_start不用再寫
}else{
to("../index.php?do=login&error=帳號或密碼錯誤");
}
?>