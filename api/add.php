<?php
include_once "db.php";

// 1. 有上傳跟無上傳檔案$_FILES
// 2. $ ->save(['img'=>,'text'=>])
// 改成$->save($_POST)
// 有資料 就有$_POST['text'] 是陣列 分為有無$_FILES['img']

// 建立資料表物件
// 這兩行程式碼將 $_POST['table'] 中的資料表名稱轉換為大寫後，建立一個對應的資料表物件 $DB，同時將資料表名稱保存在 $table 變數中。
$DB = ${ucfirst($_POST['table'])};
$table = $_POST['table'];

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

// 不同table不同變數名稱

if ($table != 'admin') {
    $_POST['sh'] = ($table == 'title') ? 0 : 1;
}
// 只有不是admin資料表才有顯示與否的判斷

unset($_POST['table']);

// unset刪除不必要的 $_POST['table'] 變數：
// 因為它在建立資料表物件後已經用不到了。

$DB->save($_POST);

to("../back.php?do=$table");
