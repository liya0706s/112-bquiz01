<?php include_once "db.php";

$table = $_POST['table'];
$DB = ${ucfirst($table)};
unset($_POST['table']);

if(isset($_POST['id'])){
    foreach($_POST['id']as$id){
        $_POST['text'][$id]='';
    }
}

// mvim沒有text
// $_POST['id']=$text
// 判斷key的內容是不是id
// $_POST['text'][id] 有id在裡面
foreach ($_POST['text'] as $id => $text) {
    if (isset($_POST['del']) && in_array($id, $_POST['del'])) {
        // 勾選刪除的，是text被選中的id 有在迴圈陣列中，要刪除
        $DB->del($id);
    } else {
        $row=$DB->find($id);
        if(isset($row['text'])){
            $row['text']=$text;
        }
        if ($table == 'title') {
            $row['sh'] = (isset($_POST['sh']) && $_POST['sh'] == $id) ? 1 : 0;
        } else {
            $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;
            // 迴圈輪到的id有沒有在 sh的陣列 中
        }
        $DB->save($row);
    }
}

to("../back.php?do=$table");
