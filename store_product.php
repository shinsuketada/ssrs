<?php
$img_favicon = "IMG-2060.PNG";
$img_home = "home.svg";
$img_signin = "signin.svg";
$img_cart = "cart.svg";
$img_mypage = "mypage.svg";

try{
  session_start();
  session_regenerate_id(true);
  require_once('common.php');
  $sp = new StoreProduct();
  $sp->connectDB();
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
        <div id="product_title">
          <h2>商品情報</h2>
        </div>
        <div id="product">
          <div class="product_container">
            <div class="left">
              <p class="img"><?php print $sp->disp_image; ?></p>
            </div>
            <div class="right">
            <p class="name">
              <?php print $sp->pro_name; ?>
            </p>
            <p class="price">
              <?php
              if ($sp->pro_price!=0) {
                echo $sp->pro_price."円";
              } else {
                echo "name your price";
              }
              ?>
            </p>
            <div class="submit">
              <p class="button"><a href="<?php echo 'store_cartin.php?pro_id='.$sp->pro_id;?>">カートに入れる</a></p>
              <form>
                <p class="button"><input type="button" onclick="history.back()" value="戻る"></p>
              </form>
            </div>
          </div>
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
  </body>
</html>