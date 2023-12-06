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
// 如果 $array 不是陣列，直接將其添加到 SQL 查詢中：
// } else {
//     $sql .= " $array";
// }

// 當 $array 不是陣列時，
// 直接將其添加到 SQL 查詢中的情況是為了處理一些額外的條件。
// 同樣，這是一個範例：
// 創建 DB 實例
$db = new DB('users');

// 定義額外的條件
$additionalCondition = "AND `status`='active'";

// 執行 SQL 查詢
// $sql = "SELECT * FROM `$db->table`";
// $query = $db->sql_all($sql, $additionalCondition, '');

// 輸出 SQL 查詢
echo $query;
// 最後的 $query 將包含這個額外條件，類似於：
// SELECT * FROM `users` AND `status`='active'

// 分割線

// $sql .= $other;
// 如果有其他需要添加到 SQL 查詢的條件，也可以透過 $other 參數來實現。這裡是一個範例：

// 創建 DB 實例
$db = new DB('products');

// 定義額外的條件
$additionalCondition = "AND `stock` > 0";

// 定義其他條件，例如排序
$orderByCondition = "ORDER BY `price` DESC";

// 執行 SQL 查詢
// $sql = "SELECT * FROM `$db->table`";
// $query = $db->sql_all($sql, $additionalCondition, $orderByCondition);

// 輸出 SQL 查詢
echo $query;

// 在這個例子中，$additionalCondition 是一個字串，
// 代表額外的條件，而 $orderByCondition 代表排序的條件。
// 這兩個條件都會被添加到 SQL 查詢中，
// 最後的 $query 將包含這些條件，類似於：

// SELECT * FROM `products` AND `stock` > 0 ORDER BY `price` DESC
