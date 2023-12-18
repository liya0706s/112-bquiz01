<?php include_once "./api/db.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0040)http://127.0.0.1/test/exercise/collage/? -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<title>卓越科技大學校園資訊系統</title>
	<link href="./css/css.css" rel="stylesheet" type="text/css">
	<script src="./js/jquery-1.9.1.min.js"></script>
	<script src="./js/js.js"></script>
</head>

<body>
	<div id="cover" style="display:none; ">
		<div id="coverr">
			<a style="position:absolute; right:3px; top:4px; cursor:pointer; z-index:9999;" onclick="cl('#cover')">X</a>
			<div id="cvr" style="position:absolute; width:99%; height:100%; margin:auto; z-index:9898;"></div>
		</div>
	</div>
	<div id="main">
		<?php
		$title = $Title->find(['sh' => 1]);
		?>
		<a title="<?= $title['text']; ?>" href="index.php">
			<!-- 按下標題都會回到首頁 -->
			<div class="ti" style="background:url('./img/<?= $title['img']; ?>'); background-size:cover;"></div>
			<!--標題-->
		</a>
		<div id="ms">
			<div id="lf" style="float:left;">
				<div id="menuput" class="dbor">
					<!--主選單放此-->
					<span class="t botli">主選單區</span>
					<?php
					// 撈取全部的主選單(menu_id=0)且有顯示的
					$mainmu = $Menu->all(['sh' => 1,'menu_id' => 0]);
					foreach ($mainmu as $main) {
					?>
						<div class="mainmu">
							<a href="<?= $main['href']; ?>" style="color:#000; font-size:13px; text-decoration:none;"><?= $main['text']; ?></a>
							<?php
							// 去數>0代表，至少有一個次選單
							if ($Menu->count(['menu_id' => $main['id']]) > 0) {
								echo "<div class='mw'>";
								$sub = $Menu->all(['menu_id' => $main['id']]);
								foreach ($subs as $sub) {
									echo "<a href='{$sub['href']}'>";
									echo "<div class='mainmu2'>";
									echo $sub['text'];
									echo "</div>";
									echo "</a>";
								}
								echo "</div>";
							}
							?>
						</div>
						
					<?php
					}
					?>
				</div>
				<div class="dbor" style="margin:3px; width:95%; height:20%; line-height:100px;">
					<span class="t">進站總人數 : <?= $Total->find(1)['total']; ?></span>
				</div>
			</div>

			<!-- 中間區塊開始 -->

			<?php
			$do = $_GET['do'] ?? 'main';
			// 如果$do符合isset就是$_GET['do']，否則導入main
			// $do = isset($_GET['do']) ? $_GET['do'] : 'main';
			// 檔案的位置，$do設定為變數，多個頁面自動替換，不用打很長的程式碼
			$file = "./front/{$do}.php";
			// 判斷檔案是否存在(路徑包含檔名)，如果是亂打的會引入main.php
			if (file_exists($file)) {
				include $file;
			} else {
				include "./front/main.php";
			}

			// ??: 這是 null 合併運算符。
			// 如果左運算元存在且不是 null，則返回左運算元的值；否則，返回右運算元的值。
			// 如果 $_GET['do'] 是 null 或未被定義，則 $do 將被設定為 'main'

			// $do = $_GET['do'] ?? 'main';
			// switch ($do) {
			// 	case "login";
			// 		include "./front/login.php";
			// 		break;
			// 	case "news";
			// 		include "./front/news.php";
			// 		break;
			// 		default:
			// 		include "./front/main.php";
			// }
			?>

			<!-- 中間區塊結束 -->

			<div class="di di ad" style="height:540px; width:23%; padding:0px; margin-left:22px; float:left; ">
				<!--右邊-->
				<!-- 2023-12-18  寫判斷，如果登入使用者，返回管理;反之會是管理登入-->
<?php
if(isset($_SESSION['login'])){

?>
				<button style="width:100%; margin-left:auto; margin-right:auto; margin-top:2px; height:50px;" onclick="lo('back.php')">返回管理</button>
<?php
}else{
?>
				
				<button style="width:100%; margin-left:auto; margin-right:auto; margin-top:2px; height:50px;" onclick="lo('?do=login')">管理登入</button>
<?php
}
?>
				<div style="width:89%; height:480px;" class="dbor">
					<span class="t botli">校園映象區</span>

					<div class="cent" onclick="pp(1)"><img src="./icon/up.jpg" alt=""></div>
					<!-- <div id="ssaa1" class="im">
						<img src="" alt="">
					</div> -->
					<?php
					// 有被設定為顯示的才要
					$imgs = $Image->all(['sh' => 1]);

					foreach ($imgs as $idx => $img) {
					?>
						<div id="ssaa<?= $idx; ?>" class="im cent">
							<img src="./img/<?= $img['img']; ?>" style="width:150px;height:103px;border:3px solid orange; margin:3px;">
						</div>
					<?php
					}
					?>
					<div class="cent" onclick="pp(2)"><img src="./icon/dn.jpg" alt=""></div>

					<script>
						var nowpage = 1,
							num = <?= $Image->count(['sh' => 1]); ?>
						// pp function裡面的參數x, (nowpage-1) 要加小括號
						// 如果(現在頁面-1)>0,代表要往上一頁，現在至少是2
						// 邏輯等同於分頁和萬年曆的上個月份 
						// x意思是往前或是往後的判斷值, 如果每次要換頁一次換三張
						// num代表總圖片數量 
						function pp(x) {
							var s, t;
							if (x == 1 && (nowpage - 1) >= 0) {
								nowpage--;
							}
							if (x == 2 && (nowpage + 1) <= num * 1 - 3) {
								nowpage++;
							}
							// nowpage  num   s   t	
							// 1  ->6    9+3   0  0
							// 2  ->	  9     0  2 3 4
							// (2+1)*3=9	9  12  
							$(".im").hide()

							// s 是for 迴圈中的計數器， 它的值在每次迭代中會分別是 0、 1、 2
							// nowpage 是目前的頁碼， 它是一個外部定義的變數。
							// t 是一個臨時變數， 用來存儲計算後的值

							// 迴圈跑三次 0,1,2
							for (s = 0; s <= 2; s++) {
								// s會變動的值,從以上帶進來nowpage是固定的值
								// 0+1 1 #ssaa1
								// 1+1 2 #ssaa2
								// 2+1 3 #ssaa3
								// 字串1加上數字的1 = 11
								// 數字型態1+數字1=2
								// php中 字串1加上數字的1 = 2
								t = s * 1 + nowpage * 1;
								$("#ssaa" + t).show()
							}
						}
						pp(2)
						// 先執行2??
					</script>
				</div>
			</div>
		</div>
		<div style="clear:both;"></div>
		<div style="width:1024px; left:0px; position:relative; background:#FC3; margin-top:4px; height:123px; display:block;">
			<span class="t" style="line-height:123px;"><?= $Bottom->find(1)['bottom']; ?></span>
		</div>
	</div>

</body>

</html>