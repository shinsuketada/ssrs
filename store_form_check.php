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
    $sfc = new StoreFormCheck();
    $sfc->connectDB();
    $sfc->session();
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
    <script src="js/store_form_check.js"></script>
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
          if($sfc->order == "2") {
            if($sfc->l_name=="" || $sfc->f_name=="" || $sfc->email=="" || $sfc->postal=="" ||  $sfc->address1=="" || $sfc->address2=="" || $sfc->tel=="" || preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/',$sfc->email)==0 || preg_match('/^(([0-9]{3}-[0-9]{4})|([0-9]{7}))$/', $sfc->postal)==0 || preg_match('/^(0{1}\d{1,4}-{0,1}\d{1,4}-{0,1}\d{4})$/',$sfc->tel)==0 || $sfc->pass1 == '' || $sfc->pass2 == ''|| $sfc->pass1 != $sfc->pass2 ) { 
          ?>
            <div id="form_title">
              <h2>お客様情報入力</h2>
            </div>
            <div id="form">
              <form method="post" action="store_form_check.php">
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                <div class="fill_all_message">
                  <p class="message">※ご注文の完了には、全ての項目への入力が必須です</p>
                </div>
                <div class="form">
                  <?php if($sfc->l_name=="" || $sfc->f_name=="") { ?>
                  <p class="form_label"><label for="l_name">お名前<span class="colon">:</span></label></p>
                  <p class="form_supplemental alert">入力が完成されていません。</p>
                  <p class="form_input"><input class="narrow red" type="text" name="l_name" id="l_name" placeholder="姓"></p>
                  <p class="form_input"><input class="narrow red" type="text" name="f_name" id="f_name" placeholder="名"></p>
                  <?php } else { ?>
                  <p class="form_label"><label for="l_name">お名前<span class="colon">:</span></label></p>
                  <p class="form_input"><input class="narrow" type="text" name="l_name" id="l_name" placeholder="姓" value="<?= $sfc->l_name ?>"></p>
                  <p class="form_input"><input class="narrow" type="text" name="f_name" id="f_name" placeholder="名" value="<?= $sfc->f_name ?>"></p>
                  <?php } ?>
                </div>
                <div class="form">
                  <!-- email -->
                  <?php if($sfc->order == "1") { ?>
                  <?php if ($sfc->email=="" || preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/',$sfc->email)==0) { ?>
                  <p class="form_label"><label for="email">メールアドレス<span class="colon">:</span></label></p>
                  <p class="form_supplemental alert">半角英数で正しく入力してください。</p>
                  <p class="form_input"><input class="middle red" type="text" name="email" id="email"></p>
                  <?php } else { ?>
                  <p class="form_label"><label for="email">メールアドレス<span class="colon">:</span></label></p>
                  <p class="form_supplemental">半角英数で入力してください。</p>
                  <p class="form_input"><input class="middle" type="text" name="email" id="email" value="<?php echo $sfc->email; ?>"></p> 
                  <?php } ?>
                  <?php } else { ?>
                  <?php if ($sfc->email=="" || preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/',$sfc->email)==0) { ?>
                  <p class="form_label"><label for="email">メールアドレス<span class="colon">:</span></label></p>
                  <p class="form_supplemental alert">半角英数で正しく入力してください</p>
                  <p class="form_input"><input class="middle red" type="text" name="email" id="email"></p>
                  <?php } elseif ($sfc->email_flag =='1') { ?>
                  <p class="form_label"><label for="email">メールアドレス<span class="colon">:</span></label></p>
                  <p class="form_supplemental alert">既に登録されています。</p>
                  <p class="form_input"><input class="middle red" type="text" name="email" id="email"></p> 
                  <?php } else { ?>
                  <p class="form_label"><label for="email">メールアドレス<span class="colon">:</span></label></p>
                  <p class="form_supplemental">半角英数で入力してください</p>
                  <p class="form_input"><input class="middle" type="text" name="email" id="email" value="<?php echo $sfc->email; ?>"></p> 
                  <?php } ?>
                  <?php } ?>
                </div>
                <div class="form">
                  <?php if($sfc->postal=="" || preg_match('/^(([0-9]{3}-[0-9]{4})|([0-9]{7}))$/', $sfc->postal)==0) { ?>
                  <p class="form_label"><label for="postal">郵便番号<span class="colon">:</span></label></p>
                  <p class="form_supplemental alert">半角英数で正しく入力してください。(記入例: 0001111 または 000-1111)</p>
                  <p class="form_input"><input class="narrow red" type="text" name="postal" id="postal" maxlength="8"></p>
                  <?php } else { ?>
                  <p class="form_label"><label for="postal">郵便番号<span class="colon">:</span></label></p>
                  <p class="form_supplemental">半角英数で入力してください。(記入例: 0001111 または 000-1111)</p>
                  <p class="form_input"><input class="narrow" type="text" name="postal" id="postal" maxlength="8" value="<?php echo $sfc->postal; ?>"></p> 
                  <?php } ?>
                </div>
                <div class="form">
                  <?php if($sfc->address1=="" || $sfc->address2=="") { ?>
                  <p class="form_label"><label for="address1">お届け先<span class="colon">:</span></label></p>
                  <p class="form_supplemental alert">記入が完成されていません。</p>
                  <p class="form_input"><input class="wide red" type="text" name="address1" id="address1" placeholder="都道府県・市区町村"></p>
                  <p class="form_input"><input class="wide red" type="text" name="address2" id="address2" placeholder="番地・町目・建物名・部屋番号など"></p>
                  <?php } else { ?>
                  <p class="form_label"><label for="address1">お届け先<span class="colon">:</span></label></p>
                  <p class="form_input"><input class="wide" type="text" name="address1" id="address1" value="<?php echo $sfc->address1; ?>" placeholder="都道府県・市区町村"></p> 
                  <p class="form_input"><input class="wide" type="text" name="address2" id="address2" value="<?php echo $sfc->address2; ?>" placeholder="番地・町目・建物名・部屋番号など"></p> 
                  <?php } ?>
                </div>
                <div class="form">
                  <?php if($sfc->tel=="" || preg_match('/^(0{1}\d{1,4}-{0,1}\d{1,4}-{0,1}\d{4})$/',$sfc->tel)==0) { ?>
                  <p class="form_label"><label for="tel">お電話番号<span class="colon">:</span></label></p>
                  <p class="form_supplemental alert">半角英数で正しく入力してください。(記入例: 000-1111-2222 または 00011112222)</p>
                  <p class="form_input"><input class="narrow red" type="text" name="tel" id="tel"></p>
                  <?php } else { ?>
                  <p class="form_label"><label for="tel">お電話番号<span class="colon">:</span></label></p>
                  <p class="form_supplemental">半角英数で入力してください。(記入例: 000-1111-2222 または 00011112222)</p>
                  <p class="form_input"><input class="narrow" type="text" name="tel" id="tel" value="<?php echo $sfc->tel; ?>"></p> 
                  <?php } ?>
                </div>
                <?php if( $sfc->pass1 == "" || mb_strlen($sfc->pass1) < 8 || $sfc->pass2=="" || $sfc->pass1 != $sfc->pass2) { ?>
                <div class="form">
                  <p class="form_label"><label for="order">会員登録の有無<span class="colon">:</span></label></p>
                  <div class="form_radio_buttons">
                    <div class="radio_button_container">
                      <p class="radio_button"><input type="radio" name="order" value="2" checked></p>
                      <p class="text"><a href="terms.php">利用規約</a>および<a href="privacy.php">プライバシーポリシー</a>に同意し、会員登録をしてから注文する。</p>
                    </div>
                    <div class="radio_button_container">
                      <p class="radio_button"><input type="radio" name="order" value="1"></p>
                      <p class="text">会員登録をしないで注文する。</p>
                    </div>
                  </div>
                </div>
                <div class="fill_pass_message">
                  <p class="message"><span class="underline">※会員登録をされる方は、以下の項目に入力してください。</span></p>
                </div>
                <div class="form">
                  <p class="form_label"><label for="pass1">パスワード<span class="colon">:</span></label></p>
                  <p class="form_supplemental alert">半角英数、8文字以上で正しく入力してください</p>
                  <input type="hidden" name="pass1" value="" id="pass0">
                  <p class="form_input"><input class="middle red" type="password" name="pass1" id="pass1" placeholder="パスワードを入力してください。"></p>
                  <input type="hidden" name="pass2" value="" id="pass3">
                  <p class="form_input"><input class="middle red" type="password" name="pass2" id="pass2" placeholder="もう一度入力してください。"></p>
                </div>
                <?php } else { ?>
                <div class="form">
                  <p class="form_label"><label for="order">会員登録の有無<span class="colon">:</span></label></p>
                  <div class="form_radio_buttons">
                    <div class="radio_button_container">
                      <p class="radio_button"><input type="radio" name="order" value="2"></p>
                      <p class="text"><a href="terms.php">利用規約</a>および<a href="privacy.php">プライバシーポリシー</a>に同意し、会員登録をしてから注文する。</p>
                    </div>
                    <div class="radio_button_container">
                      <p class="radio_button"><input type="radio" name="order" value="1" checked></p>
                      <p class="text">会員登録をしないで注文する。</p>
                    </div>
                  </div>
                </div>
                <div class="fill_pass_message">
                  <p class="message"><span class="underline">※会員登録をされる方は、以下の項目に入力してください。</span></p>
                </div>
                <div class="form">
                  <p class="form_label"><label for="pass1">パスワード<span class="colon">:</span></label></p>
                  <p class="form_supplemental">半角英数、8文字以上で入力してください</p>
                  <input type="hidden" name="pass1" value="">
                  <p class="form_input"><input class="middle" type="password" name="pass1" id="pass1" value="" placeholder="パスワードを入力してください。"></p>
                  <input type="hidden" name="pass2" value="">
                  <p class="form_input"><input class="middle" type="password" name="pass2" id="pass2" value="" placeholder="もう一度入力してください。"></p>
                  <input type="hidden" name="order" value="<?php $sfc->order ?>">
                  <input type="hidden" name="pass1" value="11111111">
                  <input type="hidden" name="pass2" value="11111111">
                </div>
                <?php } ?>
                <div class="submit">
                  <p class="button"><input type="submit" value="注文する"></p>
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
              <h2>注文内容の確認</h2>
            </div>
            <div id="form">
              <form method="post" action="store_form_done.php">
                <div class="message_to_confirm">
                  <p class="message">以下の内容でご注文を承ります。</p>
                </div>
                <div class="info_container">
                  <p class="info">お名前<span class="colon">:</span><?php echo $sfc->l_name.$sfc->f_name; ?></p>
                  <p class="info">メールアドレス<span class="colon">:</span><?php echo $sfc->email; ?></p>
                  <p class="info">郵便番号<span class="colon">:</span><?php echo $sfc->postal; ?></p>
                  <p class="info">お届け先<span class="colon">:</span><?php echo $sfc->address1.$sfc->address2; ?></p>
                  <p class="info">お電話番号<span class="colon">:</span><?php echo $sfc->tel; ?></p>
                  <?php if($sfc->order=="2") { ?>
                  <p class="info">会員登録<span class="colon">:</span>あり</p>
                  <?php } else {  ?>
                  <p class="info">会員登録<span class="colon">:</span>なし</p>
                  <?php } ?>
                  <div class="products_to_buy">
                    <div class="info_title">
                      <p class="title">ご注文商品一覧<span class="colon">:</span></p>
                    </div>
                    <?php for($i=0;$i<$sfc->max;$i++) { ?>
                    <div class="product_to_buy">
                      <div class="left">
                        <p class="image"><img src="<?php print $sfc->pro_image[$i]; ?>"></p>
                      </div>
                      <div class="right">
                        <p class="name">商品名<span class="colon">:</span><?php print $sfc->pro_name[$i]; ?></p>
                        <p class="quantity">数量<span class="colon">:</span><?php print $_SESSION['num'][$i]; ?></p>
                        <p class="price">価格<span class="colon">:</span><?php print $sfc->pro_price[$i]; ?>円</p>
                      </div>
                    </div>
                    <input type="hidden" name="pro_name<?= $i ?>" value="<?= $sfc->pro_name[$i] ?>">
                    <input type="hidden" name="pro_image<?= $i ?>" value="<?= $sfc->pro_image[$i] ?>">
                    <input type="hidden" name="pro_price<?= $i ?>" value="<?= $sfc->pro_price[$i] ?>">
                    <input type="hidden" name="num<?= $i ?>" value="<?= $_SESSION['num'][$i] ?>">
                    <?php } ?>
                  </div>
                  <p class="info">お支払い金額<span class="colon">:</span><?php echo $_SESSION['total']; ?></p>
                </div>
                <div class="submit">
                  <p class="button"><input type="submit" value="注文を確定する"></p>
                  <p class="button"><input type="submit" formaction="store_form.php" value="お客様情報を修正する"></p>
                  <p class="button"><input type="submit" formaction="store_cartlook.php" value="カートの内容を修正する"></p>
                </div>
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                <input type="hidden" name="l_name" value="<?php echo $sfc->l_name; ?>">
                <input type="hidden" name="f_name" value="<?php echo $sfc->f_name; ?>">
                <input type="hidden" name="email" value="<?php echo $sfc->email; ?>">
                <input type="hidden" name="postal" value="<?php echo $sfc->postal; ?>">
                <input type="hidden" name="address1" value="<?php echo $sfc->address1; ?>">
                <input type="hidden" name="address2" value="<?php echo $sfc->address2; ?>">
                <input type="hidden" name="tel" value="<?php echo $sfc->tel; ?>">
                <input type="hidden" name="order" value="<?php echo $sfc->order; ?>">
                <input type="hidden" name="pass1" value="<?php echo $sfc->pass1; ?>">
                <input type="hidden" name="pass2" value="<?php echo $sfc->pass2; ?>">
              </form> 
            </div>
            <?php } ?>
          <?php
          } else {
            if($sfc->l_name=="" || $sfc->f_name=="" || $sfc->email=="" || $sfc->postal=="" ||  $sfc->address1=="" || $sfc->address2=="" || $sfc->tel=="" || preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/',$sfc->email)==0 || preg_match('/^(([0-9]{3}-[0-9]{4})|([0-9]{7}))$/', $sfc->postal)==0 || preg_match('/^(0{1}\d{1,4}-{0,1}\d{1,4}-{0,1}\d{4})$/',$sfc->tel)==0 ) { 
          ?>
            <div id="form_title">
              <h2>お客様情報入力</h2>
            </div>
            <div id="form">
              <form method="post" action="store_form_check.php">
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                <div class="fill_all_message">
                  <p class="message">※ご注文の完了には、全ての項目への入力が必須です</p>
                </div>
                <div class="form">
                  <?php if($sfc->l_name=="" || $sfc->f_name=="") { ?>
                  <p class="form_label"><label for="l_name">お名前<span class="colon">:</span></label></p>
                  <p class="form_supplemental alert">入力が完成されていません。</p>
                  <p class="form_input"><input class="narrow red" type="text" name="l_name" id="l_name" placeholder="姓"></p>
                  <p class="form_input"><input class="narrow red" type="text" name="f_name" id="f_name" placeholder="名"></p>
                  <?php } else { ?>
                  <p class="form_label"><label for="l_name">お名前<span class="colon">:</span></label></p>
                  <p class="form_input"><input class="narrow" type="text" name="l_name" id="l_name" placeholder="姓" value="<?= $sfc->l_name ?>"></p>
                  <p class="form_input"><input class="narrow" type="text" name="f_name" id="f_name" placeholder="名" value="<?= $sfc->f_name ?>"></p>
                  <?php } ?>
                </div>
                <div class="form">
                  <!-- email -->
                  <?php if($sfc->order == "1") { ?>
                  <?php if ($sfc->email=="" || preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/',$sfc->email)==0) { ?>
                  <p class="form_label"><label for="email">メールアドレス<span class="colon">:</span></label></p>
                  <p class="form_supplemental alert">半角英数で正しく入力してください。</p>
                  <p class="form_input"><input class="middle red" type="text" name="email" id="email"></p>
                  <?php } else { ?>
                  <p class="form_label"><label for="email">メールアドレス<span class="colon">:</span></label></p>
                  <p class="form_supplemental">半角英数で入力してください。</p>
                  <p class="form_input"><input class="middle" type="text" name="email" id="email" value="<?php echo $sfc->email; ?>"></p> 
                  <?php } ?>
                  <?php } else { ?>
                  <?php if ($sfc->email=="" || preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/',$sfc->email)==0) { ?>
                  <p class="form_label"><label for="email">メールアドレス<span class="colon">:</span></label></p>
                  <p class="form_supplemental alert">半角英数で正しく入力してください</p>
                  <p class="form_input"><input class="middle red" type="text" name="email" id="email"></p>
                  <?php } elseif ($sfc->email_flag =='1') { ?>
                  <p class="form_label"><label for="email">メールアドレス<span class="colon">:</span></label></p>
                  <p class="form_supplemental alert">既に登録されています。</p>
                  <p class="form_input"><input class="middle red" type="text" name="email" id="email"></p> 
                  <?php } else { ?>
                  <p class="form_label"><label for="email">メールアドレス<span class="colon">:</span></label></p>
                  <p class="form_supplemental">半角英数で入力してください</p>
                  <p class="form_input"><input class="middle" type="text" name="email" id="email" value="<?php echo $sfc->email; ?>"></p> 
                  <?php } ?>
                  <?php } ?>
                </div>
                <div class="form">
                  <?php if($sfc->postal=="" || preg_match('/^(([0-9]{3}-[0-9]{4})|([0-9]{7}))$/', $sfc->postal)==0) { ?>
                  <p class="form_label"><label for="postal">郵便番号<span class="colon">:</span></label></p>
                  <p class="form_supplemental alert">半角英数で正しく入力してください。(記入例: 0001111 または 000-1111)</p>
                  <p class="form_input"><input class="narrow red" type="text" name="postal" id="postal" maxlength="8"></p>
                  <?php } else { ?>
                  <p class="form_label"><label for="postal">郵便番号<span class="colon">:</span></label></p>
                  <p class="form_supplemental">半角英数で入力してください。(記入例: 0001111 または 000-1111)</p>
                  <p class="form_input"><input class="narrow" type="text" name="postal" id="postal" maxlength="8" value="<?php echo $sfc->postal; ?>"></p> 
                  <?php } ?>
                </div>
                <div class="form">
                  <?php if($sfc->address1=="" || $sfc->address2=="") { ?>
                  <p class="form_label"><label for="address1">お届け先<span class="colon">:</span></label></p>
                  <p class="form_supplemental alert">記入が完成されていません。</p>
                  <p class="form_input"><input class="wide red" type="text" name="address1" id="address1" placeholder="都道府県・市区町村"></p>
                  <p class="form_input"><input class="wide red" type="text" name="address2" id="address2" placeholder="番地・町目・建物名・部屋番号など"></p>
                  <?php } else { ?>
                  <p class="form_label"><label for="address1">お届け先<span class="colon">:</span></label></p>
                  <p class="form_input"><input class="wide" type="text" name="address1" id="address1" value="<?php echo $sfc->address1; ?>" placeholder="都道府県・市区町村"></p> 
                  <p class="form_input"><input class="wide" type="text" name="address2" id="address2" value="<?php echo $sfc->address2; ?>" placeholder="番地・町目・建物名・部屋番号など"></p> 
                  <?php } ?>
                </div>
                <div class="form">
                  <?php if($sfc->tel=="" || preg_match('/^(0{1}\d{1,4}-{0,1}\d{1,4}-{0,1}\d{4})$/',$sfc->tel)==0) { ?>
                  <p class="form_label"><label for="tel">お電話番号<span class="colon">:</span></label></p>
                  <p class="form_supplemental alert">半角英数で正しく入力してください。(記入例: 000-1111-2222 または 00011112222)</p>
                  <p class="form_input"><input class="narrow red" type="text" name="tel" id="tel"></p>
                  <?php } else { ?>
                  <p class="form_label"><label for="tel">お電話番号<span class="colon">:</span></label></p>
                  <p class="form_supplemental">半角英数で入力してください。(記入例: 000-1111-2222 または 00011112222)</p>
                  <p class="form_input"><input class="narrow" type="text" name="tel" id="tel" value="<?php echo $sfc->tel; ?>"></p> 
                  <?php } ?>
                </div>
                <?php if ($sfc->order == "2") {  ?>
                <?php if ( $sfc->pass1 == "" || mb_strlen($sfc->pass1) < 8 || $sfc->pass2=="" || $sfc->pass1 != $sfc->pass2) { ?>
                <div class="form">
                  <p class="form_label"><label for="order">会員登録の有無<span class="colon">:</span></label></p>
                  <div clas="form_radio_buttons">
                    <div class="radio_button_container">
                      <p class="radio_button"><input type="radio" name="order" value="2" checked></p>
                      <p class="text"><a href="terms.php">利用規約</a>および<a href="privacy.php">プライバシーポリシー</a>に同意し、会員登録をしてから注文する。</p>
                    </div>
                    <div class="radio_button_container">
                      <p class="radio_button"><input type="radio" name="order" value="1"></p>
                      <p class="text">会員登録をしないで注文する。</p>
                    </div>
                  </div>
                </div>
                <div class="fill_pass_message">
                  <p class="message"><span class="underline">※会員登録をされる方は、以下の項目を入力してください。</span></p>
                </div>
                <div class="form">
                  <p class="form_label"><label for="pass1">パスワード<span class="colon">:</span></label></p>
                  <p class="form_supplemental alert">半角英数、8文字以上で正しく入力してください</p>
                  <input type="hidden" name="pass1" value="" id="pass0">
                  <p class="form_input"><input class="middle red" type="password" name="pass1" id="pass1" placeholder="パスワードを入力してください。"></p>
                  <input type="hidden" name="pass2" value="" id="pass3">
                  <p class="form_input"><input class="middle red" type="password" name="pass2" id="pass2" placeholder="もう一度入力してください。"></p>
                </div>
                <?php } 
                } else { ?>
                <div class="form">
                  <p class="form_label"><label for="order">会員登録の有無<span class="colon">:</span></label></p>
                  <div class="form_radio_buttons">
                    <div class="radio_button_container">
                      <p class="radio_button"><input type="radio" name="order" value="2"></p>
                      <p class="text"><a href="terms.php">利用規約</a>および<a href="privacy.php">プライバシーポリシー</a>に同意し、会員登録をしてから注文する。</p>
                    </div>
                    <div class="radio_button_container">
                      <p class="radio_button"><input type="radio" name="order" value="1" checked></p>
                      <p class="text">会員登録をしないで注文する。</p>
                    </div>
                  </div>
                </div>
                <div class="fill_pass_message">
                  <p class="message"><span class="underline">※会員登録をされる方は、以下の項目に入力してください。</span></p>
                </div>
                <div class="form">
                  <p class="form_label"><label for="pass1">パスワード<span class="colon">:</span></label></p>
                  <p class="form_supplemental">半角英数、8文字以上で入力してください</p>
                  <input type="hidden" name="pass0" value="">
                  <p class="form_input"><input class="middle" type="password" name="pass1" id="pass1" value="" placeholder="パスワードを入力してください。"></p>
                  <input type="hidden" name="pass2" value="">
                  <p class="form_input"><input class="middle" type="password" name="pass2" id="pass2" value="" placeholder="もう一度入力してください。"></p>
                  <input type="hidden" name="order" value="<?php $sfc->order ?>">
                  <input type="hidden" name="pass1" value="11111111">
                  <input type="hidden" name="pass2" value="11111111">
                </div>
                <?php } ?>
                <div class="submit">
                  <p class="button"><input type="submit" value="注文する"></p>
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
              <h2>注文内容の確認</h2>
            </div>
            <div id="form">
              <form method="post" action="store_form_done.php">
                <div class="message_to_confirm">
                  <p class="message">以下の内容でご注文を承ります。</p>
                </div>
                <div class="info_container">
                  <p class="info">お名前<span class="colon">:</span><?php echo $sfc->l_name.$sfc->f_name; ?></p>
                  <p class="info">メールアドレス<span class="colon">:</span><?php echo $sfc->email; ?></p>
                  <p class="info">郵便番号<span class="colon">:</span><?php echo $sfc->postal; ?></p>
                  <p class="info">お届け先<span class="colon">:</span><?php echo $sfc->address1.$sfc->address2; ?></p>
                  <p class="info">お電話番号<span class="colon">:</span><?php echo $sfc->tel; ?></p>
                  <?php if($sfc->order=="2") { ?>
                  <p class="info">会員登録<span class="colon">:</span>あり</p>
                  <?php } else {  ?>
                  <p class="info">会員登録<span class="colon">:</span>なし</p>
                  <?php } ?>
                  <div class="products_to_buy">
                    <div class="info_title">
                      <p class="title">ご注文商品一覧<span class="colon">:</span></p>
                    </div>
                    <?php for($i=0;$i<$sfc->max;$i++) { ?>
                    <div class="product_to_buy">
                      <div class="left">
                        <p class="image"><img src="<?php print $sfc->pro_image[$i]; ?>"></p>
                      </div>
                      <div class="right">
                        <p class="name">商品名<span class="colon">:</span><?php print $sfc->pro_name[$i]; ?></p>
                        <p class="quantity">数量<span class="colon">:</span><?php print $_SESSION['num'][$i]; ?></p>
                        <p class="price">価格<span class="colon">:</span><?php print $sfc->pro_price[$i]; ?>円</p>
                      </div>
                    </div>
                    <input type="hidden" name="pro_name<?= $i ?>" value="<?= $sfc->pro_name[$i] ?>">
                    <input type="hidden" name="pro_image<?= $i ?>" value="<?= $sfc->pro_image[$i] ?>">
                    <input type="hidden" name="pro_price<?= $i ?>" value="<?= $sfc->pro_price[$i] ?>">
                    <input type="hidden" name="num<?= $i ?>" value="<?= $_SESSION['num'][$i] ?>">
                    <?php } ?>
                  </div>
                  <p class="info">お支払い金額<span class="colon">:</span><?php echo $_SESSION['total']; ?></p>
                </div>
                <div class="submit">
                  <p class="button"><input type="submit" value="注文を確定する"></p>
                  <p class="button"><input type="submit" formaction="store_form.php" value="お客様情報を修正する"></p>
                  <p class="button"><input type="submit" formaction="store_cartlook.php" value="カートの内容を修正する"></p>
                </div>
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                <input type="hidden" name="l_name" value="<?php echo $sfc->l_name; ?>">
                <input type="hidden" name="f_name" value="<?php echo $sfc->f_name; ?>">
                <input type="hidden" name="email" value="<?php echo $sfc->email; ?>">
                <input type="hidden" name="postal" value="<?php echo $sfc->postal; ?>">
                <input type="hidden" name="address1" value="<?php echo $sfc->address1; ?>">
                <input type="hidden" name="address2" value="<?php echo $sfc->address2; ?>">
                <input type="hidden" name="tel" value="<?php echo $sfc->tel; ?>">
                <input type="hidden" name="order" value="<?php echo $sfc->order; ?>">
                <input type="hidden" name="pass1" value="<?php echo $sfc->pass1; ?>">
                <input type="hidden" name="pass2" value="<?php echo $sfc->pass2; ?>">
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
      header('Location: store_cartlook.php');
      exit();
     } ?>
  </body>
</html>