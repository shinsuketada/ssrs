<?php
$img_favicon = "IMG-2060.PNG";
$img_home = "home.svg";
$img_signin = "signin.svg";
$img_cart = "cart.svg";
$img_mypage = "mypage.svg";

session_start();
if(isset($_POST["csrf_token"]) && $_POST["csrf_token"] === $_SESSION['csrf_token']) {
  $token_byte = openssl_random_pseudo_bytes(16);
  $csrf_token = bin2hex($token_byte);
  $_SESSION['csrf_token'] = $csrf_token;
  try{
    require_once('common.php');
    $mrc = new MemberResistCheck();
    $mrc->connectDB();
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
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
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
        <?php if($mrc->l_name=="" || $mrc->f_name=="" || $mrc->email=="" || $mrc->postal=="" || $mrc->address1=="" || $mrc->address2=="" ||$mrc->tel=="" || $mrc->pass1=="" || mb_strlen($mrc->pass1) < 8 || $mrc->pass2=="" || preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/',$mrc->email)==0 || preg_match('/^(([0-9]{3}-[0-9]{4})|([0-9]{7}))$/', $mrc->postal)==0 || preg_match('/^(0{1}\d{1,4}-{0,1}\d{1,4}-{0,1}\d{4})$/',$mrc->tel)==0 || $mrc->email_flag == '1') { ?>
        <div id="form_title">
          <h2>新規会員登録</h2>
        </div>
        <div id="form">
          <form method="post" action="member_resist_check.php">
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
            <div class="fill_all_message">
              <p class="message">※ご登録の完了には、全ての項目への入力が必須です。</p>
            </div>
            <div class="form">
              <?php if($mrc->l_name=="" || $mrc->f_name=="") { ?>
              <p class="form_label"><label for="l_name">お名前<span class="colon">:</span></label></p>
              <p class="form_supplemental alert">入力が完成されていません。</p>
              <p class="form_input"><input type="text" class="narrow red" name="l_name" id="l_name" placeholder="姓"></p>
              <p class="form_input"><input type="text" class="narrow red" name="f_name" id="f_name" placeholder="名"></p>
              <?php } else { ?>
              <p class="form_label"><label for="l_name">お名前<span class="colon">:</span></label></p>
              <p class="form_input"><input type="text" class="narrow" name="l_name" id="l_name" placeholder="姓" value="<?= $mrc->l_name ?>"></p>
              <p class="form_input"><input type="text" class="narrow" name="f_name" id="f_name" placeholder="名" value="<?= $mrc->f_name ?>"></p>
              <?php } ?>
            </div>
            <div class="form">
              <?php if ($mrc->email=="" || preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/',$mrc->email)==0) { ?>
              <p class="form_label"><label for="email">メールアドレス<span class="colon">:</span></label></p>
              <p class="form_supplemental alert">半角英数で正しく入力してください。</p>
              <p class="form_input"><input class="middle red" type="text" name="email" id="email"></p>
              <?php } elseif ($mrc->email_flag=='1') { ?>
              <p class="form_label"><label for="email">メールアドレス<span class="colon">:</span></label></p>
              <p class="form_supplemental alert">既に登録されています。</p>
              <p class="form_input"><input class="middle red" type="text" name="email" id="email"></p> 
              <?php } else { ?>
                <p class="form_label"><label for="email">メールアドレス:</label></p>
                <p class="form_supplemental">半角英数で入力してください。</p>
                <p class="form_input"><input type="text" class="middle" name="email" id="email" value="<?php echo $mrc->email; ?>"></p> 
              <?php } ?>
            </div>
            <div class="form">
              <?php if($mrc->postal=="" || preg_match('/^(([0-9]{3}-[0-9]{4})|([0-9]{7}))$/', $mrc->postal)==0) { ?>
              <p class="form_label"><label for="postal">郵便番号<span class="colon">:</span></label></p>
              <p class="form_supplemental alert">半角英数で正しく入力してください。(記入例: 0001111 または 000-1111)</p>
              <p class="form_input"><input class="narrow red" type="text" name="postal" id="postal" maxlength="8"></p>
              <?php } else { ?>
              <p class="form_label"><label for="postal">郵便番号<span class="colon">:</span></label></p>
              <p class="form_supplemental">半角英数で入力してください。(記入例: 0001111 または 000-1111)</p>
              <p class="form_input"><input class="narrow" type="text" name="postal" id="postal" maxlength="8" value="<?= $mrc->postal ?>"></p> 
              <?php } ?>
            </div>
            <div class="form">
              <?php if($mrc->address1=="" || $mrc->address2=="") { ?>
              <p class="form_label"><label for="address1">お届け先<span class="colon">:</span></label></p>
              <p class="form_supplemental alert">記入が完成されていません。</p>
              <p class="form_input"><input class="wide red" type="text" name="address1" id="address1" placeholder="都道府県・市区町村"></p>
              <p class="form_input"><input class="wide red" type="text" name="address2" id="address2" placeholder="番地・町目・建物名・部屋番号など"></p>
            <?php } else { ?>
              <p class="form_label"><label for="address1">お届け先<span class="colon">:</span></label></p>
              <p class="form_input"><input class="wide" type="text" name="address1" id="address1" value="<?php echo $mrc->address1; ?>" placeholder="都道府県・市区町村"></p>
              <p class="form_input"><input class="wide" type="text" name="address2" id="address2" value="<?php echo $mrc->address2; ?>" placeholder="番地・町目・建物名・部屋番号など"></p>
              <?php } ?>
            </div>
            <div class="form">
              <?php if($mrc->tel=="" || preg_match('/^(0{1}\d{1,4}-{0,1}\d{1,4}-{0,1}\d{4})$/',$mrc->tel)==0) { ?>
              <p class="form_label"><label for="tel">お電話番号<span class="colon">:</span></label></p>
              <p class="form_supplemental alert">半角英数で正しく入力してください。(記入例: 000-1111-2222 または 00011112222)</p>
              <p class="form_input"><input class="narrow red" type="text" name="tel" id="tel"></p>
              <?php } else { ?>
              <p class="form_label"><label for="tel">お電話番号<span class="colon">:</span></label></p>
              <p class="form_supplemental">半角英数で入力してください。(記入例: 000-1111-2222 または 00011112222)</p>
              <p class="form_input"><input class="narrow" type="text" name="tel" id="tel" value="<?php echo $mrc->tel; ?>"></p> 
              <?php } ?>
            </div>
            <div class="form">
              <?php if($mrc->pass1=="" || $mrc->pass2=="" || mb_strlen($mrc->pass1) < 8 || $mrc->pass1 != $mrc->pass2) { ?>
              <p class="form_label"><label for="pass1">パスワード<span class="colon">:</span></label></p>
              <p class="form_supplemental alert">8文字以上、半角英数で正しく入力してください。</p>
              <p class="form_input"><input class="middle red" type="password" name="pass1" id="pass1" placeholder="パスワードを入力してください"></p>
              <p class="form_input"><input class="middle red" type="password" name="pass2" id="pass2" placeholder="もう一度入力してください"></p>
              <?php } else { ?>
              <p class="form_label"><label for="pass1">パスワード<span class="colon">:</span></label></p>
              <p class="form_supplemental">8文字以上、半角英数で入力してください</p>
              <p class="form_input"><input class="middle" type="password" name="pass1" id="pass1" value="<?php echo $mrc->pass1; ?>" placeholder="パスワードを入力してください"></p>
              <p class="form_input"><input class="middle" type="password" name="pass2" id="pass2" value="<?php echo $mrc->pass2; ?>" placeholder="もう一度入力してください"></p>
              <?php }?>
            </div>
            <div class="form conf">
              <?php if($mrc->conf1!="1") { ?>
              <p class="form_label"><label for="conf1">同意事項<span class="colon">:</span></label></p>
              <p class="form_supplemental alert">同意が確認できませんでした。</p>
              <div class="form_checkbox">
                <p class="checkbox"><input type="checkbox" name="conf1" value="1" id="conf1"></p>
                <p class="text"><a href="terms.php">利用規約</a>および<a href="privacy.php">プライバシーポリシー</a>に同意する。</p>
              </div>
              <?php } else { ?>
              <p class="form_label"><label for="conf1">同意事項<span class="colon">:</span></label></p>
              <div class="form_checkbox">
                <p class="checkbox"><input type="checkbox" name="conf1" value="1" id="conf1" checked="checked"></p>
                <p class="text"><a href="terms.php">利用規約</a>および<a href="privacy.php">プライバシーポリシー</a>に同意する。</p>
              </div>
              <?php } ?>
            </div>
            <div class="submit">
              <input type="hidden" name="conf1" value="2" id="conf1">
              <p class="button"><input type="submit" value="会員登録"></p>
              <p class="button"><input type="button" onclick="history.back()" value="戻る"></p>
            </div>
          </form>
        </div>
        <div id="link">
          <p class="anchor">
            <a href="act.php">特定商取引法に関する表記</a>
            <span class="slash">/</span>
            <a href="terms.php">利用規約</a>
            <span class="slash">/</span>
            <a href="privacy.php">プライバシーポリシー</a>
          </p>
        </div>
        <?php } else { ?>
        <div id="form_title">
          <h2>登録情報確認</h2>
        </div>
        <div id="form">
          <form method="post" action="member_resist_done.php">
            <div class="message_to_confirm">
              <p class="message">以下の情報で会員登録を行います。</p>
            </div>
            <div class="info_container">
              <p class="info">お名前<span class="colon">:</span><?= $mrc->l_name.$mrc->f_name ?></p>
              <p class="info">メールアドレス<span class="colon">:</span><?= $mrc->email ?></p>
              <p class="info">郵便番号<span class="colon">:</span><?= $mrc->postal ?></p>
              <p class="info">お届け先<span class="colon">:</span><?= $mrc->address1.$mrc->address2 ?></p>
              <p class="info">電話番号<span class="colon">:</span><?= $mrc->tel ?></p>
            </div>
            <div class="submit">
              <input type="hidden" name="conf1" value="2">
              <p class="button"><input type="submit" value="登録を完了する"></p>
              <p class="button"><input type="submit" formaction="member_resist.php" value="修正する"></p>
            </div>
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
            <input type="hidden" name="l_name" value="<?= $mrc->l_name ?>">
            <input type="hidden" name="f_name" value="<?= $mrc->f_name ?>">
            <input type="hidden" name="email" value="<?= $mrc->email ?>">
            <input type="hidden" name="postal" value="<?= $mrc->postal; ?>">
            <input type="hidden" name="address1" value="<?= $mrc->address1 ?>">
            <input type="hidden" name="address2" value="<?= $mrc->address2 ?>">
            <input type="hidden" name="tel" value="<?php echo $mrc->tel; ?>">
            <input type="hidden" name="pass1" value="<?php echo $mrc->pass1; ?>">
            <input type="hidden" name="pass2" value="<?php echo $mrc->pass2; ?>">
          </form>
        </div>
        <?php } ?>
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
    <?php } else { 
      header('Location: member_resist.php');
      exit();
	  } ?>
  </body>
</html>