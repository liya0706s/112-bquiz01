<div class="di" style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
    <!-- marquee start -->
    <?php include "./front/marquee.php" ?>
    <div style="height:32px; display:block;"></div>
    <!--正中央-->
    <!-- 原本script的地方 -->
    <div style="width:100%; padding:2px; height:290px;">
        <div id="mwww" loop="true" style="width:100%; height:100%;">
            <div style="width:99%; height:100%; position:relative;" class="cent">
                沒有資料
            </div>
        </div>
    </div>
    <!-- 加入script -->
    <script>
        var lin = new Array();
        <?php
        // 有被設為顯示的撈出來，放入空陣列
        // 要把陣列轉成字串寫在js上
        $lins = $Mvim->all(['sh' => 1]);
        foreach ($lins as $lin) {
            echo "lin.push('{$lin['img']}');";
        }
        ?>

        var now = 0;
        // 先執行一次
        ww();
        // 至少要是2判斷才成立
        // setInterval 3秒鐘後執行ww()一次,每隔三秒執行下一個ww()
        if (lin.length > 1) {
            setInterval("ww()", 3000);
            now = 1;
        }

        // id=mwww 沒有資料的範圍js 會被嵌入
        // 下方要呼叫function name 這裡是ww()方法
        function ww() {
            $("#mwww").html("<embed loop=true src='./img/" + lin[now] + "' style='width:99%; height:100%;'></embed>")
            //$("#mwww").attr("src",lin[now])
            // now是數值才可以++
            now++;
            // lin陣列的長度，元素的數量
            // 大於等於是包含自己
            // now+1 大於總個數之後，就會把數字歸零
            if (now >= lin.length)
                now = 0;
        }
    </script>

    <div style="width:95%; padding:2px; height:190px; margin-top:10px; padding:5px 10px 5px 10px; border:#0C3 dashed 3px; position:relative;">
        <span class="t botli">最新消息區
            <?php
            if ($News->count(['sh' => 1]) > 5) {
                echo "<a href='?do=news' style='float:right'>More...</a>";
            }
            ?>
        </span>
        <ul class="ssaa" style="list-style-type:circle;">
            <?php
            // limit前面要空白 sql語法有間隔 limit 5 只有前五筆
            $news = $News->all(['sh' => 1], ' limit 5');
            foreach ($news as $n) {
                echo "<li>";
                echo mb_substr($n['text'], 0, 20);

                echo "<div class='all' style='display:none'>";
                echo $n['text'];
                echo "</div>";
                
                echo "...</li>";
                
            }
            ?>

        </ul>
        <!-- div容器會在下方 指稱id 的發生效用 -->
        <div id="altt" style="position: absolute; width: 350px; min-height: 100px; background-color: rgb(255, 255, 204); top: 50px; left: 130px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;">
            <!-- html("<pre>" + $(this).children(".all").html() + "</pre>")-->
        </div>
        <script>
            // hover事件的時候，會有function()
            $(".ssaa li").hover(
                function() {
                    // html這個方法 pre標籤放到altt的div容器裡面
                    // jQuery $(this)這個 hover事件發生當下的(會變的) 
                    // hover過來所有的li的children下一層div裡面有class=all 顯示全部的內容
                    // all()括號沒有參數:抓全部, 所以html()沒有參數是要這容器的全部內容
                    $("#altt").html("<pre>" + $(this).children(".all").html() + "</pre>")
                    $("#altt").show()
                }
            )
            $(".ssaa li").mouseout(
                function() {
                    $("#altt").hide()
                }
            )
        </script>
    </div>
</div>