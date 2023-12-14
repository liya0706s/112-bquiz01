<?php
include_once "db.php";

// 建立資料表物件
// 這兩行程式碼將 $_POST['table'] 中的資料表名稱轉換為大寫後，
// 建立一個對應的資料表物件 $DB，同時將資料表名稱 保存在 $table 變數中。
$DB = ${ucfirst($_POST['table'])};
$table = $_POST['table'];

// 根據資料表的不同，做一些特定處理
// 這裡是針對 admin 資料表的處理，將 $_POST['pw2'] 刪除。
switch ($table) {
    case "admin":
        unset($_POST['pw2']);
        break;
}

// 處理上傳檔案：  
if (isset($_FILES['img']['tmp_name'])) {
    move_uploaded_file($_FILES['img']['tmp_name'], "../img/" . $_FILES['img']['name']);
    $_POST['img'] = $_FILES['img']['name'];
}

// 如果table不是admin條件下，table是title的話顯示為0，否則顯示為1
if ($table != 'admin') {
    $_POST['sh'] = ($table == 'title') ? 0 : 1;
}

unset($_POST['table']); 

// php移除變數用unset
// unset刪除不必要的 $_POST['table'] 變數：
// 因為它在建立資料表物件後已經用不到了，不用save儲存進資料庫。

$DB->save($_POST);

to("../back.php?do=$table");
