<?php
$img_favicon = "IMG-2060.PNG";
$img_home = "home.svg";
$img_signin = "signin.svg";
$img_cart = "cart.svg";
$img_mypage = "mypage.svg";

session_start();
session_regenerate_id(true);
if(isset($_POST["csrf_token"]) && $_POST["csrf_token"] === $_SESSION['csrf_token']) {
  
  try{
    $token_byte = openssl_random_pseudo_bytes(16);
    $csrf_token = bin2hex($token_byte);
    $_SESSION['csrf_token'] = $csrf_token;
    require_once('common.php');
    $mmc = new MypageModCheck();
    $mmc->connectDB();
    $mmc->session();
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
    <script src="js/store_form_check.js"></script>
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
        if (isset($_SESSION['mb_id'])==true) {
        if($mmc->l_name=="" || $mmc->f_name=="" ||$mmc->email=="" || $mmc->postal=="" || $mmc->address1=="" || $mmc->address2=="" || $mmc->tel=="" || $mmc->pass1=="" || mb_strlen($mmc->pass1) < 8 || $mmc->pass2=="" || preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/',$mmc->email)==0 || preg_match('/^(([0-9]{3}-[0-9]{4})|([0-9]{7}))$/', $mmc->postal)==0 || preg_match('/^(0{1}\d{1,4}-{0,1}\d{1,4}-{0,1}\d{4})$/',$mmc->tel)==0 ) { 
          $mmc = new MypageModCheck();
          $mmc->connectDB();
          $mmc->session();
        ?>
        <div id="form_title">
          <h2>会員情報修正</h2>
        </div>
        <div id="form">
          <form method="post" action="mypage_mod_check.php">
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
            <div class="fill_all_message">
              <p class="message">※修正の完了には、全ての項目への入力が必須です。</p>
            </div>
            <div class="form">
              <?php if($mmc->l_name=="" || $mmc->f_name=="") { ?>
              <p class="form_label"><label for="l_name">お名前<span class="colon">:</span></label></p>
              <p class="form_supplemental alert">入力が完成されていません。</p>
              <p class="form_input"><input class="narrow red" type="text" name="l_name" id="l_name" placeholder="姓"></p>
              <p class="form_input"><input class="narrow red" type="text" name="f_name" id="f_name" placeholder="名"></p>
              <?php } else { ?>
              <p class="form_label"><label for="l_name">お名前<span class="colon">:</span></label></p>
              <p class="form_input"><input class="narrow" type="text" name="l_name" id="l_name" placeholder="姓" value="<?php echo $mmc->l_name; ?>"></p>
              <p class="form_input"><input class="narrow" type="text" name="f_name" id="f_name" placeholder="名" value="<?php echo $mmc->f_name; ?>"></p>
              <?php } ?>
            </div>
            <div class="form">
              <?php if ($mmc->email=="" || preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/',$mmc->email)==0) { ?>
              <p class="form_label"><label for="email">メールアドレス<span class="colon">:</span></label></p>
              <p class="form_supplemental alert">半角英数で正しく入力してください。</p>
              <p class="form_input"><input class="middle red" type="text" name="email" id="email"></p>
              <?php } else { ?>
              <p class="form_label"><label for="email">メールアドレス<span class="colon">:</span></label></p>
              <p class="form_supplemental">半角英数で入力してください。</p>
              <p class="form_input"><input class="middle" type="text" name="email" id="email" value="<?php echo $mmc->email; ?>"></p> 
              <?php } ?>
            </div>
            <div class="form">
              <?php if($mmc->postal=="" || preg_match('/^(([0-9]{3}-[0-9]{4})|([0-9]{7}))$/', $mmc->postal)==0) { ?>
              <p class="form_label"><label for="postal">郵便番号<span class="colon">:</span></label></p>
              <p class="form_supplemental alert">半角英数で正しく入力してください。(記入例: 0001111 または 000-1111)</p>
              <p class="form_input"><input class="narrow red" type="text" name="postal" id="postal" maxlength="8"></p>
              <?php } else { ?>
              <p class="form_label"><label for="postal">郵便番号<span class="colon">:</span></label></p>
              <p class="form_supplemental">半角英数で入力してください。(記入例: 0001111 または 000-1111)</p>
              <p class="form_input"><input class="narrow" type="text" name="postal" id="postal" maxlength="8" value="<?php echo $mmc->postal; ?>"></p>
              <?php } ?>
            </div>
            <div class="form">
              <?php if($mmc->address1=="" || $mmc->address2=="") { ?>
              <p class="form_label"><label for="address1">お届け先<span class="colon">:</span></label></p>
              <p class="form_supplemental alert">記入が完成されていません。</p>
              <p class="form_input"><input class="wide red" type="text" name="address1" id="address1" placeholder="都道府県・市区町村"></p>
              <p class="form_input"><input class="wide red" type="text" name="address2" id="address2" placeholder="番地・町目・建物名・部屋番号など"></p>
              <?php } else { ?>
              <p class="form_label"><label for="address1">お届け先<span class="colon">:</span></label></p>
              <p class="form_input"><input class="wide" type="text" name="address1" id="address1" value="<?php echo $mmc->address1; ?>" placeholder="都道府県・市区町村"></p> 
              <p class="form_input"><input class="wide" type="text" name="address2" id="address2" value="<?php echo $mmc->address2; ?>" placeholder="番地・町目・建物名・部屋番号など"></p> 
              <?php } ?>
            </div>
            <div class="form">
              <?php if($mmc->tel=="" || preg_match('/^(0{1}\d{1,4}-{0,1}\d{1,4}-{0,1}\d{4})$/',$mmc->tel)==0) { ?>
              <p class="form_label"><label for="tel">お電話番号<span class="colon">:</span></label></p>
              <p class="form_supplemental alert">半角英数で正しく入力してください。(記入例: 000-1111-2222 または 00011112222)</p>
              <p class="form_input"><input class="narrow red" type="text" name="tel" id="tel"></p>
              <?php } else { ?>
              <p class="form_label"><label for="tel">お電話番号<span class="colon">:</span></label></p>
              <p class="form_supplemental">半角英数で入力してください。(記入例: 000-1111-2222 または 00011112222)</p>
              <p class="form_input"><input class="narrow" type="text" name="tel" id="tel" value="<?php echo $mmc->tel; ?>"></p> 
              <?php } ?>
            </div>
            <div class="form">
              <?php if($mmc->pass1=="" || mb_strlen($mmc->pass1) < 8 ||$mmc->pass2=="" || $mmc->pass1 != $mmc->pass2) { ?>
              <p class="form_label"><label for="pass1">パスワード<span class="colon">:</span></label></p>
              <p class="form_supplemental alert">半角英数、8文字以上で正しく入力してください</p>
              <p class="form_input"><input class="middle red" type="password" name="pass1" id="pass1" placeholder="パスワードを入力してください"></p>
              <p class="form_input"><input class="middle red" type="password" name="pass2" id="pass2" placeholder="もう一度入力してください"></p>
              <?php } else {?>
              <input type="hidden" name="pass1" value="<?= $mmc->pass1 ?>">
              <input type="hidden" name="pass2" value="<?= $mmc->pass2 ?>">
              <?php } ?>
            </div>
            <div class="submit">
              <p class="button"><input type="submit" value="修正する" id="btn"></p>
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
        <?php } else { 
           $mmc = new MypageModCheck();
           $mmc->connectDB();
           $mmc->session();
        ?>
        <div id="form_title">
          <h2>会員様情報修正</h2>
        </div>
        <div id="form">
          <form method="post" action="mypage_mod_done.php">
            <div class="message_to_confirm">
              <p class="message">以下の内容に修正いたします。</p>
            </div>
            <div class="info_container">
              <p class="info">お名前<span class="colon">:</span><?php echo $mmc->l_name.$mmc->f_name; ?></p>
              <p class="info">メールアドレス<span class="colon">:</span><?php echo $mmc->email; ?></p>
              <p class="info">郵便番号<span class="colon">:</span><?php echo $mmc->postal; ?></p>
              <p class="info">お届け先<span class="colon">:</span><?php echo $mmc->address1.$mmc->address2; ?></p>
              <p class="info">お電話番号<span class="colon">:</span><?php echo $mmc->tel; ?></p>
            </div>
            <div class="submit">
              <p class="button"><input type="submit" value="修正を完了する" id="btn"></p>
              <p class="button"><input type="button" onclick="history.back()" value="戻る"></p>
            </div>
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
            <input type="hidden" name="l_name" value="<?php echo $mmc->l_name; ?>">
            <input type="hidden" name="f_name" value="<?php echo $mmc->f_name; ?>">
            <input type="hidden" name="email" value="<?php echo $mmc->email; ?>">
            <input type="hidden" name="postal" value="<?php echo $mmc->postal; ?>">
            <input type="hidden" name="address1" value="<?php echo $mmc->address1; ?>">
            <input type="hidden" name="address2" value="<?php echo $mmc->address2; ?>">
            <input type="hidden" name="tel" value="<?php echo $mmc->tel; ?>">
            <input type="hidden" name="pass1" value="<?php echo $mmc->pass1; ?>">
          </form>
        </div>
        <?php } ?>
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
      header('Location: mypage.php');
      exit();
    } ?>
  </body>
</html>