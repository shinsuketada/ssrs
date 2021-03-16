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
        <?php if (isset($_SESSION['mb_id'])==true) {?>
        <div id="contents_center">
          <div class="message_container">
            <p class="message">修正が完了しました。</p>
          </div>
          <form method="post" action="mypage.php">
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
            <input type="hidden" name="l_name" value="<?= $mmd->l_name ?>">
            <input type="hidden" name="f_name" value="<?= $mmd->f_name ?>">
            <input type="hidden" name="email" value="<?= $mmd->email ?>">
            <input type="hidden" name="postal" value="<?= $mmd->postal ?>">
            <input type="hidden" name="address1" value="<?= $mmd->address1 ?>">
            <input type="hidden" name="address2" value="<?= $mmd->address2 ?>">
            <input type="hidden" name="tel" value="<?= $mmd->tel ?>">
            <div id="form_mod_done">
              <div class="submit_mod_done">
                <p class="button"><input type="submit" value="マイページにアクセスする"></p>
                <p class="button"><input type="submit" onclick="location.href='index.php'" value="商品一覧に戻る"></p>
              </div>
            </div>
          </form>
        </div>
        <?php } else { ?>
          <div id="contents_center">
            <div class="message_container">
              <p class="message">マイページにアクセスするには、ログインが必要です。</p>
            </div>
            <div class="submit">
              <p class="button"><a href="mypage.php">ログインフォームへ</a></p>
              <p class="button"><a href="index.php">商品一覧に戻る</a></p>
            </div>
          </div>
        <?php } ?>
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
      header('Location: mypage.php');
      exit();
    } ?>
  </body>
</html>