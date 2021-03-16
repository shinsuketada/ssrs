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
    require_once('common.php');
    $skd = new StoreKantanDone();
    $skd->connectDB();
    $skd->mail();
    $_SESSION['cart']=array();
    $_SESSION['kazu']=array();
    $_SESSION['total']=array();
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
      <?php if(isset($_SESSION['mb_login'])==false) {?>
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
      <?php exit();} ?>
      <div id="main">
        <div id="contents_center">
          <div class="message_container_done">
            <p class="message">ご注文が完了いたしました。</p>
            <div class="message_sub_container">
              <p class="message_sub_1st">ご注文ありがとうございます。</p>
              <p class="message_sub_2nd">ご注文の確認メールをお送りいたしました。</p>
            </div>
          </div>
          <div class="submit">
            <p class="button"><a href="index.php">商品一覧に戻る</a></p>
          </div>
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