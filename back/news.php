<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli">最新消息資料管理</p>
    <form method="post" action="./api/edit.php">
        <table width="100%" style="text-align: center">
            <tbody>
                <tr class="yel">
                    <td width="80%">最新消息資料內容</td>
                    <td width="10%">顯示</td>
                    <td width="10%">刪除</td>
                </tr>
                <?php
                // 後台:用foreach迴圈將all()全部的資料倒出來
                // 前台:才要加條件sh=1的才要

                // 只撈出當前頁需要的那幾筆 
                // limit=3只要三筆， limit 3,3(第四筆索引三 後的三筆)
                $total = $DB->count();
                $div = 5;
                // 5筆一頁
                $pages = ceil($total / $div);
                $now = $_GET['p'] ?? 1;
                $start = ($now - 1) * $div;
                $rows = $DB->all(" limit $start,$div");
                // $rows=$Ad->all();
                foreach ($rows as $row) {
                ?>
                    <tr>
                        <td>
                            <textarea type="text" name="text[<?= $row['id']; ?>]" style="width:90%"><?= $row['text']; ?></textarea>
                        </td>
                        <td>
                            <input type="checkbox" name="sh[]" value="<?= $row['id']; ?>" <?= ($row['sh'] == 1) ? 'checked' : ''; ?>>
                        </td>
                        <td>
                            <input type="checkbox" name="del[]" value="<?= $row['id']; ?>">
                        </td>

                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <div class="cent">
            <?php
            for ($i = 1; $i <= $pages; $i++) {
                $fontsize=($now==$i)?'22px':'16px';
                echo "<a href='?do=news&p=$i' style='font-size:$fontsize'>&nbsp;$i&nbsp;</a>";
            }
            // 定義一個$fontsiaze變數 $now==$i代表在當前頁可以改變style
            ?>
        </div>

        <table style="margin-top:40px; width:70%;">
            <tbody>
                <tr>
                    <input type="hidden" name="table" value="<?= $do; ?>">
                    <!-- 隱藏欄位的意義???? -->
                    <td width="200px"><input type="button" onclick="op('#cover','#cvr','./modal/<?= $do; ?>.php?table=<?= $do; ?>')" value="新增動態文字廣告"></td>
                    <td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
                </tr>
            </tbody>
        </table>

    </form>
</div>