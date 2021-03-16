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
        <div id="text">
          <div class="text_title">
            <h2>プライバシーポリシー</h2>
          </div>
          <div class="contents">
            <div class="content">
              <div class="paragraph">
                <p>お客様が、当ウェブサイトを利用する場合または商品の購入をする場合、下記「お客様情報の取扱規定<span class="bracket">（プライバシーポリシー）</span>」を熟読のうえ、内容に同意していただく必要があります。なお、ご同意いただけない場合は、商品の購入ができません。</p>
              </div>
            </div>
            <div class="content">
              <div class="content_title">
                <h3><span class="top_number">1.</span>お客様情報について</h3>
              </div>
              <div class="paragraph">
                <p>お客様情報とは、生存する個人に関する情報であって、当該情報に含まれる氏名、住所、電話番号、その他の記述等により特定の個人を識別することが出来るものを言います。これには他の情報と照合することが出来、それにより特定の個人を識別できる事となるものを含みます。</p>
              </div>
            </div>
            <div class="content">
              <div class="content_title">
                <h3><span class="top_number">2.</span>お客様情報の利用目的について</h3>
              </div>
              <div class="paragraph">
                <p>当方は、<span class="bracket_number">（1）</span>売買取引における当方の債務を履行すること、<span class="bracket_number">（2）</span>売買取引におけるアフターサービスを実施することを目的とし、お客様情報を利用させていただきます。これらの利用目的以外には、下記3に記載する場合または事前にお客様に同意をいただいた場合を除き、利用致しません。</p>
              </div>
            </div>
            <div class="content">
              <div class="content_title">
                <h3><span class="top_number">3.</span>お客様情報の第三者への委託について</h3>
              </div>
              <div class="paragraph">
                <p>当方は、利用目的の達成に必要な範囲内において、お客様情報の全部又は一部を委託する場合があります。</p>
              </div>
            </div>
            <div class="content">
              <div class="content_title">
                <h3><span class="top_number">4.</span>お客様情報の第三者への提供について</h3>
              </div>
              <div class="paragraph">
                <p>当方は、事前にお客様の同意を得ることなしでお客様情報を第三者に提供しません。</p>
              </div>
            </div>
            <div class="content">
              <div class="content_title">
                <h3><span class="top_number">5.</span>お客様情報のお問い合わせについて</h3>
              </div>
              <div class="paragraph">
                <p>当ウェブサイトの特定商取引法に関する表記内にある「事業者の名称および連絡先」までご連絡ください。</p>
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