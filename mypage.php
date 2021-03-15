<?php 
$img_favicon = "IMG-2060.PNG";
$img_home = "home.svg";
$img_signin = "signin.svg";
$img_cart = "cart.svg";
$img_mypage = "mypage.svg";

try{
  session_start();
  $token_byte = openssl_random_pseudo_bytes(16);
  $csrf_token = bin2hex($token_byte);
  $_SESSION['csrf_token'] = $csrf_token;
  require_once('common.php');
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
      <div id="main">
        <?php 
          if(isset($_SESSION['mb_id'])==true) {
            $mypage = new Mypage();
            $mypage->connectDB();
        ?>
        <div id="mypage_title">
          <h2>会員様情報</h2>
        </div>
        <div id="form">
          <form method="post" action="mypage_mod.php">
            <div class="info_container">
              <p class="info">お名前<span class="colon">:</span><?php echo $mypage->l_name.$mypage->f_name; ?></p>
              <p class="info">メールアドレス<span class="colon">:</span><?php echo $mypage->email; ?></p>
              <p class="info">郵便番号<span class="colon">:</span><?php echo $mypage->postal; ?></p>
              <p class="info">お届け先<span class="colon">:</span><?php echo $mypage->address1.$mypage->address2; ?></p>
              <p class="info">お電話番号<span class="colon">:</span><?php echo $mypage->tel; ?></p>
              <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
              <input type="hidden" name="l_name" value="<?php echo $mypage->l_name;?>">
              <input type="hidden" name="f_name" value="<?php echo $mypage->f_name;?>">
              <input type="hidden" name="email" value="<?php echo $mypage->email;?>">
              <input type="hidden" name="postal" value="<?php echo $mypage->postal;?>">
              <input type="hidden" name="address1" value="<?php echo $mypage->address1;?>">
              <input type="hidden" name="address2" value="<?php echo $mypage->address2;?>">
              <input type="hidden" name="tel" value="<?php echo $mypage->tel;?>">
            </div>
            <div class="submit">
              <p class="button"><input type="submit" value="会員様情報を修正する"></p>
              <p class="button"><input type="button" onclick="location.href='member_logout.php'" value="ログアウトする"></p>
            </div>
          </form>
        </div>
        <?php } else {   
          header('Location: index.php');
          exit();
        } ?>
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