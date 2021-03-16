<?php
$img_favicon = "IMG-2060.PNG";
$img_home = "home.svg";
$img_signin = "signin.svg";
$img_cart = "cart.svg";
$img_mypage = "mypage.svg";

session_start();
if(isset($_POST["csrf_token"]) && $_POST["csrf_token"] === $_SESSION['csrf_token']) {
  try{
    $flag_rec = 0;
    require_once('common.php');
    $mlc = new MemberLoginCheck();
    $mlc->connectDB();
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
        if($mlc->flag_rec=="1") {
          $flag = password_verify($mlc->pass1, $mlc->pass2);
        } else {
          $flag = false;
        }

        if($flag==false) {
        ?>
				<div id="form_login_title">
					<h2>ログイン</h2>
				</div>
				<div id="login_failed_message">
					<p class="message">メールアドレスもしくはパスワードの入力に誤りがあるか、登録されていません。</p>
				</div>
        <div id="form_login">
          <form method="post" action="member_login_check.php">
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
            <div class="form">
              <p class="form_label"><label for="email">Mail<span class="colon">:</span></label></p>
              <p class="form_input"><input class="middle" type="text" name="email" id="email"></p>
            </div>
            <div class="form">
              <p class="form_label"><label for="pass1">Password<span class="colon">:</span></label><p>
              <p class="form_input"><input class="middle" type="password" name="pass1" id="pass1"></p>
            </div>
            <div class="submit">
              <p class="button"><input type="submit" value="ログイン"></p>
            </div>
          </form>
        </div>
        <div id="not_resistered">
          <p class="title"><span class="underline">まだ会員登録されていないお客様へ</span></p>
          <p class="message">会員登録により、毎回お名前やお届け先などを入力することなく、スムーズにお買い物をお楽しみいただけます。</p>
          <p class="link"><a href="member_resist.php">新規会員登録に進む</a></p>
        </div>
        <?php } else {
          $mlc->session();
          header('Location:index.php');
          exit();
        } ?>
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
      header('Location: index.php');
      exit();
    } ?>
  </body>
</html>