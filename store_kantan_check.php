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
    $skc = new StoreKantanCheck();
    $skc->session();
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
      <?php if(isset($_SESSION['mb_login'])==false) { ?>
        <div id="main">
          <div id="contents_center">
            <div class="message_container">
              <p class="message">ログインされていません。</p>
            </div>
            <div class="submit">
              <p class="button"><a href="member_login.php">ログイン</a></p>
              <p class="button"><a href="index.php">商品一覧へ</a></p>
            </div>
          </div>
        </div>
        <div id="footer">
          <p><span>©</span><span>2021</span><span>Kashikoi</span><span>Ulysses</span></p>
        </div>
      <?php exit(); }
      $skc->connectDB1();
      $skc->connectDB2();
      ?>
      <div id="main">
        <div id="form_title">
          <h2>注文内容の確認</h2>
        </div>
        <div id="form">
          <form method="post" action="store_kantan_done.php">
            <div class="message_to_confirm">
              <p class="message">以下の内容でご注文を承ります。</p>
            </div>
            <div class="info_container">
              <p class="info">お名前<span class="colon">:</span><?php echo $skc->l_name.$skc->f_name; ?></p>
              <p class="info">メールアドレス<span class="colon">:</span><?php echo $skc->email; ?></p>
              <p class="info">郵便番号<span class="colon">:</span><?php echo $skc->postal; ?></p>
              <p class="info">お届け先<span class="colon">:</span><?php echo $skc->address1.$skc->address2; ?></p>
              <p class="info">お電話番号<span class="colon">:</span><?php echo $skc->tel; ?></p>
              <div class="products_to_buy">
                <div class="info_title">
                  <p class="title">ご注文商品一覧<span class="colon">:</span></p>
                </div>
                <?php for($i=0;$i<$skc->max;$i++) { ?>
                <div class="product_to_buy">
                  <div class="left">
                    <p class="image"><img src="<?php print $skc->pro_image[$i]; ?>" alt=""></p>
                  </div>
                  <div class="right">
                    <p class="name">商品名<span class="colon">:</span><?php print $skc->pro_name[$i]; ?></p>
                    <p class="quantity">数量<span class="colon">:</span><?php print $_SESSION['num'][$i]; ?></p>
                    <p class="price">価格<span class="colon">:</span><?php print $skc->pro_price[$i]; ?>円</p>
                  </div>
                </div>
                <input type="hidden" name="pro_name<?= $i ?>" value="<?= $skc->pro_name[$i] ?>">
                <input type="hidden" name="pro_image<?= $i ?>" value="<?= $skc->pro_image[$i] ?>">
                <input type="hidden" name="pro_price<?= $i ?>" value="<?= $skc->pro_price[$i] ?>">
                <input type="hidden" name="num<?= $i ?>" value="<?= $_SESSION['num'][$i] ?>">
                <?php } ?>
              </div>
              <p class="info">お支払い金額<span class="colon">:</span><?php print $_SESSION['total']; ?></p>
            </div>
            <div class="submit">
              <p class="button"><input type="submit" value="注文を確定する"></p>
              <p class="button"><input type="submit" formaction="mypage_mod.php" value="会員様情報を修正する"></p>
              <p class="button"><input type="submit" formaction="store_cartlook.php" value="カートの内容を修正する"></p>
            </div>
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
            <input type="hidden" name="l_name" value="<?php echo $skc->l_name; ?>">
            <input type="hidden" name="f_name" value="<?php echo $skc->f_name; ?>">
            <input type="hidden" name="email" value="<?php echo $skc->email; ?>">
            <input type="hidden" name="postal" value="<?php echo $skc->postal; ?>">
            <input type="hidden" name="address1" value="<?php echo $skc->address1; ?>">
            <input type="hidden" name="address2" value="<?php echo $skc->address2; ?>">
            <input type="hidden" name="tel" value="<?php echo $skc->tel; ?>">
          </form>
        </div>
        <?php } catch(Exception $e) { ?>
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
      header('Location: index.php');
      exit();
     } ?>
  </body>
</html>