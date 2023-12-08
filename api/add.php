<?php
include_once "db.php";

// 1. 有上傳跟無上傳檔案$_FILES
// 2. $ ->save(['img'=>,'text'=>])
// 改成$->save($_POST)
// 有資料 就有$_POST['text'] 是陣列 分為有無$_FILES['img']

$DB=${ucfirst($_POST['table'])};
$table=$_POST['table'];

if (isset($_FILES['img']['tmp_name'])) {
    move_uploaded_file($_FILES['img']['tmp_name'], "../img/" . $_FILES['img']['name']);
    $_POST['img'] = $_FILES['img']['name'];
}

// 不同table不同變數名稱
// $_POST['table'] 轉成資料表物件，變數刪除用unset

unset($_POST['table']);
$DB->save($_POST);

to("../back.php?do=$table");