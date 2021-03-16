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
              <p class="form_label"><label for="l_name">お名前<span class="colon">:</span></label></p>
              <p class="form_input"><input class="narrow" type="text" name="l_name" id="l_name" placeholder="姓"></p>
              <p class="form_input"><input class="narrow" type="text" name="f_name" id="f_name" placeholder="名"></p>
            </div>
            <div class="form">
              <p class="form_label"><label for="email">メールアドレス<span class="colon">:</span></label></p>
              <p class="form_supplemental">半角英数で入力してください。(記入例: ssrs@gmail.com)</p>
              <p class="form_input"><input class="middle" type="text" name="email" id="email" ></p>
            </div>
            <div class="form">
              <p class="form_label"><label for="postal">郵便番号<span class="colon">:</span></label></p>
              <p class="form_supplemental">半角英数で入力してください。(記入例: 0001111 または 000-1111)</p>
              <p class="form_input"><input class="narrow" type="text" name="postal" id="postal" maxlength="8" onKeyUp="AjaxZip3.zip2addr(this,'','address1','address1');"></p>
            </div>
            <div class="form">
              <p class="form_label"><label for="address1">お届け先<span class="colon">:</span></label></p>
              <p class="form_input"><input class="wide" type="text" name="address1" id="address1" placeholder="都道府県・市区町村"></p>
              <p class="form_input"><input class="wide" type="text" name="address2" id="address2" placeholder="番地・町目・建物名・部屋番号など"></p>
            </div>
            <div class="form">
              <p class="form_label"><label for="tel">お電話番号<span class="colon">:</span></label></p>
              <p class="form_supplemental">半角英数で入力してください。(記入例: 000-1111-2222 または 00011112222)</p>
              <p class="form_input"><input class="narrow" type="text" name="tel" id="tel"></p>
            </div>
            <div class="form">
              <p class="form_label"><label for="pass1">パスワード<span class="colon">:</span></label><p>
              <p class="form_supplemental">8文字以上、半角英数で入力してください</p>
              <p class="form_input"><input class="middle" type="password" name="pass1" id="pass1" placeholder="パスワードを入力してください"></p>
              <p class="form_input"><input class="middle" type="password" name="pass2" id="pass2" placeholder="もう一度入力してください"></p>
            </div>
            <div class="form conf">
              <p class="form_label"><label for="conf1">同意事項<span class="colon">:</span></label></p>
              <div class="form_checkbox">
                <p class="checkbox"><input type="checkbox" name="conf1" value="1" id="conf1"></p>
                <p class="text"><a href="terms.php">利用規約</a>および<a href="privacy.php">プライバシーポリシー</a>に同意する。</p>
              </div>
            </div>
            <div class="submit">
              <input type="hidden" name="conf1" value="2">
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