<!-- <?php
date_default_timezone_set("Asia/Taipei");
session_start();

class DB {
    // ... (略建構式)

    function all( $where = '', $other = '')
    {
        $sql = "select * from `$this->table` ";
        $sql =$this->sql_all($sql,$where,$other);
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    private function sql_all($sql, $array, $other) {
        if (isset($this->table) && !empty($this->table)) {
            if (is_array($array)) {
                if (!empty($array)) {
                    $tmp = $this->a2s($array);
                    $sql .= " WHERE " . join(" AND ", $tmp);
                }
            } else {
                $sql .= " $array";
            }
            $sql .= $other;
            return $sql;
        }
    }

    // ... (略)
}

// 範例使用：
$db = new DB('example_table');

// 範例 1: 從資料表中擷取所有行
// $sql1 = "SELECT * FROM `$db->table`";
// $query1 = $db->sql_all($sql1, [], '');

// 範例 2: 使用條件擷取資料
// $conditions = ['name' => 'John', 'age' => 25];
// $sql2 = "SELECT * FROM `$db->table`";
// $query2 = $db->sql_all($sql2, $conditions, '');

// 範例 3: 使用條件和其他條件擷取資料
// $conditions = ['name' => 'John', 'age' => 25];
// $otherConditions = 'ORDER BY created_at DESC LIMIT 10';
// $sql3 = "SELECT * FROM `$db->table`";
// $query3 = $db->sql_all($sql3, $conditions, $otherConditions);

// 現在，你可以使用這些 $query 變數來執行相應的資料庫查詢操作 -->
