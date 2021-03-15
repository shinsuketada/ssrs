<?php 
$img_favicon = "IMG-2060.PNG";
$img_home = "home.svg";
$img_signin = "signin.svg";
$img_cart = "cart.svg";
$img_mypage = "mypage.svg";

try {
  session_start();
  $token_byte = openssl_random_pseudo_bytes(16);
  $csrf_token = bin2hex($token_byte);
  $_SESSION['csrf_token'] = $csrf_token;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SSRS || Kashikoi Ulysses Official Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
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
        <div class="flex_item welcome">ようこそ ゲスト様</div>
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
        <div id="text">
          <div class="text_title">
            <h2>特定商取引法に関する表記</h2>
          </div>
          <div class="contents">
            <div class="content">
              <div class="content_title">
                <h3>販売価格について</h3>
              </div>
              <div class="paragraph">
                <p>販売価格は、表示された金額<span class="bracket">（表示価格/消費税込）</span>といたします。なお、配送料は販売価格に含まれます。</p>
              </div>
            </div>
            <div class="content">
              <div class="content_title">
                <h3>代金(対価)の支払期限と方法</h3>
              </div>
              <div class="paragraph">
                <p>販売価格は、表示された金額<span class="bracket">（表示価格/消費税込）</span>といたします。なお、配送料は販売価格に含まれます。</p>
                <p>支払い方法<span class="colon">:</span>銀行振込のみご利用頂けます。</p>
                <p>支払い期限<span class="colon">:</span>商品注文確定から14日以内を支払い期限とします。支払い期限を過ぎますと、注文は一旦破棄されます。</p>
              </div>
            </div>
            <div class="content">
              <div class="content_title">
                <h3>返品についての特約事項</h3>
              </div>
              <div class="paragraph">
                <p>商品に欠陥がある場合を除き、返品には応じません。</p>
              </div>
            </div>
            <div class="content">
              <div class="content_title">
                <h3>役務または商品の引き渡し時期</h3>
              </div>
              <div class="paragraph">
                <p>ご入金いただいてから、7日以内に発送いたします。</p>
              </div>
            </div>
            <div class="content">
              <div class="content_title">
                <h3>事業者の名称および連絡先</h3>
              </div>
              <div class="paragraph">
                <p>事業者名<span class="colon">:</span>賢いユリシーズ</p>
                <p>住所<span class="colon">:</span>???</p>
                <p>TEL<span class="colon">:</span>???</p>
                <p>EMAIL<span class="colon">:</span>???</p>
              </div>
            </div>
          </div>
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
        <form method="post" action="store_form_check.php">
          <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        </form>
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
      