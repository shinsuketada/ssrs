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
            <h2>利用規約</h2>
          </div>
          <div class="contents">
            <div class="content">
              <div class="content_title">
                <h3><span class="chapter_number">第1章</span>総則</h3>
              </div>
              <div class="article">
                <div class="article_title">
                  <h4><span class="article_number">第1条</span>【主体・目的】</h4>
                </div>
                <div class="general_rule_container">
                  <div class="description">
                    <div class="general_rule">
                      <p class="party">本規約<span class="colon">:</span></p>
                      <p class="explanation">ストア利用規約</p>
                    </div>
                  </div>
                  <div class="description">
                    <div class="general_rule">
                      <p class="party">当方<span class="colon">:</span></p>
                      <p class="explanation">本サービスを利用して開設したオンラインストア運営者</p>
                    </div>
                  </div>
                  <div class="description">
                    <div class="general_rule">
                      <p class="party">本サービス<span class="colon">:</span></p>
                      <p class="explanation">当方がインターネットを通じて提供する通信販売サービス</p>
                    </div>
                  </div>
                  <div class="description">
                    <div class="general_rule">
                      <p class="party">購入者<span class="colon">:</span></p>
                      <p class="explanation">当方が定める手続きに従い、本規約およびプライバシーポリシーの内容を全て了解・承認した</p>
                    </div>
                  </div>
                  <div class="description">
                    <div class="general_rule">
                      <p class="party">利用者<span class="colon">:</span></p>
                      <p class="explanation">本規約およびプライバシーポリシーの内容を全て了解・承認した上で、当方が本サービスで提供するロゴ、映像、プログラム、アイディア、情報等 (以下、「コンテンツ」) を検索、閲覧または利用する者の総称</p></p>
                    </div>
                  </div>
                </div>
                <div class="article">
                  <div class="article_title">
                    <h4><span class="article_number">第2条</span>【本規約の適用】</h4>
                  </div>
                  <div class="description">
                    <p>当方がインターネットを通じ提供する本サービスを利用者が利用するにあたり、本規約を定めます。利用者は、本サービスの利用開始の時点で本規約の内容を承諾したものとみなします。</p>
                  </div>
                </div>
                <div class="article">
                  <div class="article_title">
                    <h4><span class="article_number">第3条</span>【本規約の変更】</h4>
                  </div>
                  <div class="description">
                    <p>当方は、利用者または購入者に事前に通知することなく、本規約の全部または一部を任意に変更することができ、また本規約を補充する規約を新たに定めることができるものとします。本規約の変更・追加は、本サービスを提供するサイト条に掲載した時点から効力を発するものとし、効力発生後に提供される本サービスは、変更・追加後の規約によるものとされます。</p>
                    <p>当方は、本規約の変更・追加により利用者または購入者に生じた一切の損害について、直接損害か間接損害か否か、予見できたか否かを問わず、一切の責任を負わないものとします。</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="content">
              <div class="content_title">
                <h3><span class="chapter_number">第2章</span>商品の購入等</h3>
              </div>
              <div class="article">
                <div class="article_title">
                  <h4><span class="article_number">第4条</span>【商品の購入】</h4>
                </div>
                <div class="description">
                  <p>利用者は本サービスを利用して当方から商品を購入することができます。</p>
                  <p>利用者は、商品の購入を希望する場合、当方が別途定める手続きに従って、商品の購入を申し込むものとします。</p>
                  <p>当該申込に伴い、利用者が入力・登録した配達先・注文内容等を確認の上で注文する旨のボタンをクリックし、その後、当方から注文内容を確認する旨のメールが当該利用者に到達した時点で、利用者と当方との間に当該商品に関する売買契約が成立するものとします。</p>
                  <p>前項の規定に拘わらず、本サービス利用に関して不正行為または不適当な行為があった場合、当方は売買契約について取消し、解除その他の適切な措置を取ることができるものとします。</p>
                  <p>未成年の利用者は、適格な法定代理人の事前の同意を得なければ、本サービスを利用して商品の購入をすることができません。</p>
                </div>
              </div>
              <div class="article">
                <div class="article_title">
                  <h4><span class="article_number">第5条</span>【登録情報の変更】</h4>
                </div>
                <div class="description">
                  <p>購入者は、購入時に入力した氏名、住所その他当方に届け出た事項の全部または一部に変更があった場合には速やかに当方に連絡するものとします。変更登録がなされなかったことにより生じた損害について、当方は一切の責任を負いません。また、変更登録がなされた場合でも、変更登録前にすでに手続がなされた取引は変更登録前の情報にもとづいておこなわれるものとします。</p>
                </div>
              </div>
              <div class="article">
                <div class="article_title">
                  <h4><span class="article_number">第6条</span>【支払い方法】</h4>
                </div>
                <div class="description">
                  <p>商品の支払い金額は、サイト上に表示されている商品の販売価格と、消費税、配送料、手数料の合計額となります。</p>
                  <p>本サービスによって購入された商品の支払いに関しては、購入者本人名義の銀行振込による支払いに限るものとします。</p>
                </div>
              </div>
              <div class="article">
                <div class="article_title">
                  <h4><span class="article_number">第7条</span>【商品の返品】</h4>
                </div>
                <div class="description">
                  <p>当方は、購入者からの商品の返品について、サイト上に掲載される【特定商取引法に関する表記】内にある「返品についての特約事項」に従い対応するものとします。</p>
                </div>
              </div>
            </div>
            <div class="content">
              <div class="content_title">
                <h3><span class="chapter_number">第3章</span>個人情報の取扱い</h3>
              </div>
              <div class="article">
                <div class="article_title">
                  <h4><span class="article_number">第8条</span>【個人情報の取扱い】</h4>
                </div>
                <div class="description">
                  <p>当方は、本規約および当方が別途定める<a href="privacy.php">プライバシーポリシー</a>に従い、個人情報を取り扱います。</p>
                </div>
              </div>
            </div>
            <div class="content">
              <div class="content_title">
                <h3><span class="chapter_number">第4章</span>利用上の責務</h3>
              </div>
              <div class="article">
                <div class="article_title">
                  <h4><span class="article_number">第9条</span>【禁止事項】</h4>
                </div>
                <div class="description">
                  <p>本サービスの利用に際して、利用者または購入者に対し次の各号の行為を行うことを禁止します。</p>
                </div>
                <div class="list">
                  <ul>
                    <li>他の利用者、第三者若しくは当方迷惑、不利益若しくは損害を与える行為、またはそれらのおそれのある行為</li>
                    <li>第三者または当方の著作権等の知的財産権、肖像権、人格権、プライバシー権、パブリシティ権その他の権利を侵害する行為またはそれらのおそれのある行為</li>
                    <li>公序良俗に反する行為その他法令に違反する行為またはそれらのおそれのある行為</li>
                    <li>本サービスを通じて入手したコンテンツを利用者または購入者が私的使用の範囲外で使用する行為</li>
                    <li>他の利用者、または他の利用者以外の第三者を介して、本サービスを通じて入手したコンテンツを複製、販売、出版、頒布、公開する行為およびこれらに類似する行為</li>
                    <li>本サービスおよびその他当方が提供するサービスの運営を妨げる行為</li>
                    <li>当方の信用を毀損・失墜させる等の当方が不適当であると合理的に判断する行為</li>
                    <li>その他、当方が不適切と判断する行為</li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="content">
              <div class="content_title">
                <h3><span class="chapter_number">第5章</span>免責事項</h3>
              </div>
              <div class="article">
                <div class="article_title">
                  <h4><span class="article_number">第10条</span>【免責事項】</h4>
                </div>
                <div class="description">
                  <p>利用者または購入者が本規約等に違反したことによって第三者に生じた損害については、当方は一切責任を負いません。</p>
                  <p>本サービスの内容および、利用者または購入者が本サービスを通じて得る情報等について、その完全性、正確性、確実性、有用性等いかなる保証も行いません。</p>
                  <p>商品の本サービスに開示・掲載されているコンテンツに虚偽または誤解を招くような内容が存在したとしても、これにより利用者または購入者が直接的または間接的に被った一切の損害、損失、不利益等について、当方は一切責任を負いません。</p>
                  <p>本サービスを通じて販売される商品につき、その品質、材質、機能、性能、他の商品との適合性その他の欠陥、及びこれらが原因となり生じた損害、損失、不利益等については、当方は一切責任を負いません。</p>
                  <p>当方は、購入者が商品の受取を怠り若しくは拒んだ場合、長期不在により商品の受取りが不能の場合又は配送先不明の場合、その他購入者の都合により商品を受け取ることができない場合に関しては、購入者が登録する連絡先に連絡すること及び商品購入の際に指定された配達先に商品を持参等することにより、商品の引渡債務を履行し、当該債務から免責されるものとします。</p>
                </div>
              </div>
            </div>
            <div class="content">
              <div class="content_title">
                <h3><span class="chapter_number">第6章</span>雑則</h3>
              </div>
              <div class="article">
                <div class="article_title">
                  <h4><span class="article_number">第11条</span>【著作権、知的財産権】</h4>
                </div>
                <div class="description">
                  <p>本サービスを通じて提供されるコンテンツは、当方または正当な権利を有する第三者に専属的に帰属するものとします。本条の規定に違反して、利用者または購入者と第三者との間で問題が生じた場合、当該利用者または購入者は自己の責任と費用においてかかる問題を解決するとともに、当方に何らの損害、損失または不利益等を与えないものとします。</p>
                </div>
              </div>
              <div class="article">
                <div class="article_title">
                  <h4><span class="article_number">第12条</span>【準拠法】</h4>
                </div>
                <div class="description">
                  <p>本規約に関する準拠法は、全て日本国の法令が適用されるものとします。</p>
                </div>
              </div>
              <div class="article">
                <div class="article_title">
                  <h4><span class="article_number">第13条</span>【協議および管轄裁判所】</h4>
                </div>
                <div class="description">
                  <p>本規約の解釈を巡って疑義が生じた場合、当方は合理的な範囲でその解釈を決定できるものとします。本規約に関する全ての紛争については、当方の所在地を管轄する裁判所を第1審の専属的合意管轄裁判所とすることを予め合意します。</p>
                </div>
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
  </body>
</html>