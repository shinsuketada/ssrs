<?php
$img_favicon = "IMG-2060.PNG";
$img_home = "home.svg";
$img_signin = "signin.svg";
$img_cart = "cart.svg";
$img_mypage = "mypage.svg";

try {
	session_start();
  session_regenerate_id(true);
  $token_byte = openssl_random_pseudo_bytes(16);
  $csrf_token = bin2hex($token_byte);
  $_SESSION['csrf_token'] = $csrf_token;
	require_once('common.php');
	$scl = new StoreCartlook();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SSRS || Kashikoi Ulysses Official Store</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<link rel="icon" href="img_favicon.php?img=<?=$img_favicon ?>">
		<link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/common.css">
    <script src="js/jquery-3.4.1.min.js"></script>
		<script src="js/common.js"></script>
		<script src="js/store_cartlook.js"></script>
	</head>
	<body>
		<div id="wrap">
			<div id="header">
				<?php if(isset($_SESSION['mb_login'])==false) { ?>
				<div class="flex_item wilcome">ようこそ ゲスト様</div>
				<div class="flex_item"><a href="index.php"><img class="icon" src="img_icon.php?img=<?=$img_home ?>" alt="home"></a></div>
				<div class="flex_item"><a href="member_login.php"><img class="icon" src="img_icon.php?img=<?=$img_signin ?>" alt="signin" ></a></div>
				<div class="flex_item"><a href="store_cartlook.php"><img class="icon" src="img_icon.php?img=<?=$img_cart ?>" alt="cart"></a></div>
				<?php } else { ?>
				<div class="flex_item welcome" >ようこそ <?php echo $_SESSION['name']; ?>様</div>
				<div class="flex_item"><a href="index.php"><img class="icon" src="img_icon.php?img=<?=$img_home ?>" alt="home" ></a></div>
				<div class="flex_item"><a href="mypage.php"><img class="icon" src="img_icon.php?img=<?=$img_mypage ?>" alt="mypage"></a></div>
				<div class="flex_item"><a href="store_cartlook.php"><img class="icon" src="img_icon.php?img=<?=$img_cart ?>" alt="cart"></a></div>
				<?php } ?>
			</div>
			<?php if($scl->max==0) { ?>
			<div id="main">
				<div id="contents_center">
					<div class="message_container">
						<p class="message">カートに商品が入っていません。</p>
					</div>
					<div class="submit">
						<p class="button"><a href="index.php">商品一覧に戻る</a></p>
					</div>
				</div>
			</div>
			<div id="footer">
				<p><span>©</span><span>2021</span><span>Kashikoi</span><span>Ulysses</span></p>
			</div>
			<?php
			exit();
			}
			$scl->connectDB();
			?>
			<div id="main">
				<div id="cartlook_title">
					<h2>カートの確認</h2>
				</div>
				<div id="form">
					<form method="post" action="kazu_change.php">
						<input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
						<div class="table_container">
							<table>
								<tr>
									<td class="img">画像</td>
									<td class="name">商品名</td>
									<td class="price">価格</td>
									<td class="num">数量</td>
									<td class="shokei">小計</td>
									<td class="delete">削除</td>
								</tr>
								<?php for($i=0;$i<$scl->max;$i++) { ?>
								<tr class="tr<?php print $i; ?>">
									<td class="img"><?php print $scl->pro_image[$i]; ?></td>
									<td class="name"><?php print $scl->pro_name[$i]; ?></td>
									<td class="price<?php print $i; ?> price"><?php print $scl->pro_price[$i]; ?>円</td>
									<td class="num">
										<input type="number" min="1" max="5" name="num<?php print $i; ?>" value="1" class="num<?php print $i; ?>">
									</td>
									<td class="shokei<?php print $i; ?> shokei"><input type="text" name="shokei<?= $i ?>" value="<?= $scl->pro_price[$i] ?>" readonly></td>
									<td class="delete"><input type="checkbox" name="delete<?php print $i;?>" value="×" class="delete_check"></td>
								</tr>
								<?php $scl->total +=  $scl->pro_price[$i]*$scl->kazu[$i];?>
							<?php } ?>
							</table>
							<p class="total">お支払い金額<span class="colon">:</span><input type="text" name="total" value="<?= $scl->total ?>" readonly></p>
						</div>
						<div class="submit cart">
							<?php if(isset($_SESSION['mb_login'])!=true) { ?>
							<p class="button"><input type="submit" formaction="store_form.php" value="注文する"></p>
							<p class="button"><input type="button" value="商品一覧に戻る" onclick="location.href='index.php'"></p>
							<p class="button"><input type="submit" value="チェックした商品を削除する" class="modify"></p>
							<p class="button"><input type="button" onclick="location.href='clear_cart.php'" value="カートを空にする"></p>
							<?php } else { ?>
							<p class="button"><input class="button" type="submit" formaction="store_kantan_check.php" value="会員かんたん注文に進む"></p>
							<p class="button"><input type="button" value="商品一覧に戻る" onclick="location.href='index.php'"></p>
							<p class="button"><input type="submit" value="チェックした商品を削除する" class="modify"></p>
							<p class="button"><input type="button" onclick="location.href='clear_cart.php'" value="カートを空にする"></p>
							<?php } ?>
						</div>
						<input type="hidden" name="max" value="<?= $scl->max ?>">
					</form>
				</div>
				<?php	} catch(Exception $e) { ?>
					<head>
						<meta charset="utf-8">
						<title>SSRS || Kashikoi Ulysses Official Store</title>
						<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
						<link rel="icon" href="img_favicon.php?img=<?=$img_favicon ?>">
						<link rel="stylesheet" href="css/reset.css">
						<link rel="stylesheet" href="css/common.css">
						<script src="js/jquery-3.4.1.min.js"></script>
						<script src="js/common.js"></script>
					</head>
					<body>
						<div id="wrap">
							<div id="main">
								<div id="error">
									<p class="message">ご迷惑をお掛けし、大変申し訳ございません。</p>
									<p class="message_sub">ただいま障害により、本ページにアクセスすることができません。</p>
									<div class="submit">
										<p class="button"><a href="index.php">商品一覧に戻る</a></p>
									</div>
								</div>
							</div>
							<div id="footer">
								<p><span>©</span><span>2021</span><span>Kashikoi</span><span>Ulysses</span></p>
							</div>
						</div>
					</body>	
					<?php	
					exit();
				}?>
			</div>
			<div id="footer">
				<p><span>©</span><span>2021</span><span>Kashikoi</span><span>Ulysses</span></p>
			</div>
		</div>
	</body>
</html>