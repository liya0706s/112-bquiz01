<?php include_once "db.php";

$table = $_POST['table'];
$DB = ${ucfirst($table)};
unset($_POST['table']);

foreach ($_POST['text'] as $id => $text) {
    if (isset($_POST['del']) && in_array($id, $_POST['del'])) {
        // 有勾選刪除，有在迴圈陣列中，要刪除
        $DB->del($id);
    } else {
        // 顯示與否，或是要不要更新
        $row = $DB->find($id);
        // post文字資料取代撈出來的資料
        $row['text'] = $text;
        // 存在sh變數，有沒有等於目前id
        $row['sh'] = (isset($_POST['sh']) && $_POST['sh']==$id)?1:0;
        $DB->save($row);
    }
}

to("../back.php?do=$table");