<?php 
include_once "db.php";

// 取得資料表名稱
$table = $_POST['table'];

// 建立資料表物件
$DB = ${ucfirst($table)};

// 刪除不必要的 $_POST['table'] 變數
unset($_POST['table']);

// 迴圈處理每一筆資料
foreach ($_POST['id'] as $key => $id) {
    // 判斷是否要刪除該筆資料
    if (isset($_POST['del']) && in_array($id, $_POST['del'])) {
        $DB->del($id);
    } else {
        // 取得資料庫中該筆資料
        $row = $DB->find($id);

        // 更新相應的欄位
        if (isset($row['text'])) {
            $row['text'] = $_POST['text'][$key];
        }

        switch ($table) {
            case "title":
                $row['sh'] = (isset($_POST['sh']) && $_POST['sh'] == $id) ? 1 : 0;
                break;
            case "admin":
                $row['acc'] = $_POST['acc'][$key];
                $row['pw'] = $_POST['pw'][$key];
                break;
            case "menu":
                // 在這裡處理 menu 資料表的邏輯（目前沒有具體的處理，可能需要根據實際需求補充）
                break;
            default:
                $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;
        }

        // 儲存更新後的資料
        $DB->save($row);
    }
}

// 跳轉回管理後台
to("../back.php?do=$table");
