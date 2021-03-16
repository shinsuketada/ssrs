<?php 
ini_set('display_errors', 0);
//ini_set('display_errors', 1);

function sanitize($before) {
  foreach($before as $key => $value) {
    $after[$key] = htmlspecialchars($value, ENT_QUOTES,'UTF-8');
  }
  return $after;
}	

function pulldown_year() {
  print '<select class="sel" name="year">';
  print '<option value="2020">2020</option>';
  print '<option value="2021">2021</option>';
  print '<option value="2022">2022</option>';
  print '<option value="2023">2019</option>';
  print '</select>';
}

function pulldown_month() {
  print '<select class="sel" name="month">';
  print '<option value="01">01</option>';
  print '<option value="02">02</option>';
  print '<option value="03">03</option>';
  print '<option value="04">04</option>';
  print '<option value="05">05</option>';
  print '<option value="06">06</option>';
  print '<option value="07">07</option>';
  print '<option value="08">08</option>';
  print '<option value="09">09</option>';
  print '<option value="10">10</option>';
  print '<option value="11">11</option>';
  print '<option value="12">12</option>';
  print '</select>';
}

function pulldown_day() {
  print '<select class="sel" name="day">';
  print '<option value="01">01</option>';
  print '<option value="02">02</option>';
  print '<option value="03">03</option>';
  print '<option value="04">04</option>';
  print '<option value="05">05</option>';
  print '<option value="06">06</option>';
  print '<option value="07">07</option>';
  print '<option value="08">08</option>';
  print '<option value="09">09</option>';
  print '<option value="10">10</option>';
  print '<option value="11">11</option>';
  print '<option value="12">12</option>';
  print '<option value="13">13</option>';
  print '<option value="14">14</option>';
  print '<option value="15">15</option>';
  print '<option value="16">16</option>';
  print '<option value="17">17</option>';
  print '<option value="18">18</option>';
  print '<option value="19">19</option>';
  print '<option value="20">20</option>';
  print '<option value="21">21</option>';
  print '<option value="22">22</option>';
  print '<option value="23">23</option>';
  print '<option value="24">24</option>';
  print '<option value="25">25</option>';
  print '<option value="26">26</option>';
  print '<option value="27">27</option>';
  print '<option value="28">28</option>';
  print '<option value="29">29</option>';
  print '<option value="30">30</option>';
  print '<option value="31">31</option>';
  print '</select>';
}

class StoreList {
  public $pro_id;

  public function connectDB() {
    $dsn='';
    $user = '';
    $password = '';
    $dbh=new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);	

    $sql='SELECT pro_id,pro_name,price FROM products WHERE 1';
    $stmt=$dbh->prepare($sql);
    $stmt->execute();
    $rec=$stmt->fetch(PDO::FETCH_ASSOC);
    $this->pro_id=$rec['pro_id'];
    $dbh=null;
  }
}

class StoreProduct {
  public $pro_id;
  public $pro_name;
  public $pro_price;
  public $pro_image_name;
  public $disp_image;

  public function __construct() {
    $get=sanitize($_GET);
    $this->pro_id=$get['pro_id'];
  }

  public function connectDB() {
    $dsn='';
    $user='';
    $password='';
    $dbh=new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql='SELECT pro_name,price,image FROM products WHERE pro_id=?';

    $stmt=$dbh->prepare($sql);
    $data[]=$this->pro_id;
    $stmt->execute($data);
    $rec=$stmt->fetch(PDO::FETCH_ASSOC);
    $this->pro_name=$rec['pro_name'];
    $this->pro_price=$rec['price'];
    $this->pro_image_name=$rec['image'];
    $dbh=null;

    if($this->pro_image_name=='') {
      $this->disp_image='';
    } else {
      $this->disp_image='<img src="img_product.php?img='.$this->pro_image_name.'">';
    }
  }
}

class StoreCartin {
  public $pro_id;

  public function connectDB() {
    $dsn='';
    $user='';
    $password='';
    $dbh=new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql='SELECT pro_id,pro_name,price FROM products WHERE 1';
    $stmt=$dbh->prepare($sql);
    $stmt->execute();
    $rec=$stmt->fetch(PDO::FETCH_ASSOC);
    $this->pro_id=$rec['pro_id'];
    $dbh=null;
  }
}

class StoreCartlook {
  public $cart;
  public $kazu;
  public $max;
  public $total;
  public $pro_name;
  public $pro_price;
  public $pro_image;

  public function __construct () {
		if(isset($_SESSION['cart'])==true) {
			$this->cart = $_SESSION['cart'];
			$this->kazu = $_SESSION['kazu'];
			$this->max = count($this->cart);
			$this->total = 0;
		} else {
			$this->max = 0;
			$this->total = 0;
		}
	}

	public function connectDB() {
		$dsn='';
		$user='';
		$password='';
		$dbh=new PDO($dsn,$user,$password);
		$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		foreach($this->cart as $key => $val) {
			$sql = 'SELECT pro_name, price, image FROM products WHERE pro_id=?';
			$stmt = $dbh->prepare($sql);
			$data[0] = $val;
			$stmt->execute($data);
			$rec = $stmt->fetch(PDO::FETCH_ASSOC);
			$this->pro_name[] = $rec['pro_name'];
			$this->pro_price[] = $rec['price'];
			if($rec['image'] =='') {
				$this->pro_image[] = '';
			} else {
				$this->pro_image[] = '<img src="img_product.php?img='.$rec['image'].'">';
			}
		}
		$dbh = null;
	}
}

class KazuChange {
  public $l_name;
	public $f_name;
	public $email;
	public $postal;
	public $address1;
	public $address2;
	public $tel;
	public $max;
	public $num;
	public $shokei;
	public $total;

  public function session_mod() {
		if(isset($_SESSION['mod'])==true) {
			$this->l_name=$_SESSION['l_name'];
			$this->f_name=$_SESSION['f_name'];
			$this->email=$_SESSION['email'];
			$this->postal=$_SESSION['postal'];
			$this->address1=$_SESSION['address1'];
			$this->address2=$_SESSION['address2'];
			$this->tel=$_SESSION['tel'];
		}
	}

	public function session() {
		$post=sanitize($_POST);
		$this->max = $post['max'];
		$this->total = $post['total'];
		$_SESSION['total'] = $this->total;
		
		for($i=0;$i<$this->max;$i++) {
			$this->num[$i] = $post['num'.$i];
			$this->shokei[$i] = $post['shokei'.$i];
			$_SESSION['num'][$i] = $this->num[$i];
			$_SESSION['shokei'][$i] = $this->shokei[$i];
		}
	}

  public function delete() {
    for($i=$max; 0<=$i; $i--) {
			if(isset($_POST['delete'.$i])==true) {
				array_splice($cart,$i,1);
				array_splice($kazu,$i,1);
			}
    }
  }
}

class StoreForm {
	public $l_name;
	public $f_name;
	public $email;
	public $postal;
	public $address1;
	public $address2;
	public $tel;
	public $max;
	public $num;
	public $shokei;
	public $total;

	public function session_mod() {
		if(isset($_SESSION['mod'])==true) {
			$this->l_name=$_SESSION['l_name'];
			$this->f_name=$_SESSION['f_name'];
			$this->email=$_SESSION['email'];
			$this->postal=$_SESSION['postal'];
			$this->address1=$_SESSION['address1'];
			$this->address2=$_SESSION['address2'];
			$this->tel=$_SESSION['tel'];
		}
	}

	public function session() {
		$post=sanitize($_POST);
		$this->max = $post['max'];
		$this->total = $post['total'];
		$_SESSION['total'] = $this->total;
		
		for($i=0;$i<$this->max;$i++) {
			$this->num[$i] = $post['num'.$i];
			$this->shokei[$i] = $post['shokei'.$i];
			$_SESSION['num'][$i] = $this->num[$i];
			$_SESSION['shokei'][$i] = $this->shokei[$i];
		}
	}
}


class StoreFormCheck {
	public $l_name;
	public $f_name;
	public $email;
	public $postal;
	public $address1;
	public $address2;
	public $tel;
	public $order;
	public $pass1;
	public $pass2;
	public $pro_price;
	public $pro_image;
	public $kazu;
	public $cart;
	public $max;
	public $total;
	public $mod;
	public $postal_count;
	public $email_flag;
	public $res;

	public function __construct() {
		$post=sanitize($_POST);
		$this->l_name=$post['l_name'];
		$this->f_name=$post['f_name'];
		$this->email=$post['email'];
		$this->postal=$post['postal'];
		$this->address1=$post['address1'];
		$this->address2=$post['address2'];
		$this->tel=$post['tel'];
		$this->order=$post['order'];
		$this->pass1=$post['pass1'];
		$this->pass2=$post['pass2'];
		$this->postal_count=mb_strlen($this->postal);
		$this->cart = $_SESSION['cart'];
		$this->kazu = $_SESSION['kazu'];
		$this->max = count($this->cart);
		$this->total = 0;
		$flag = true;
	}

	public function connectDB() {
		$dsn='';
		$user='';
		$password='';
		$dbh=new PDO($dsn,$user,$password);
		$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		foreach($this->cart as $key => $val) {
			$sql = 'SELECT pro_name, price, image FROM products WHERE pro_id=?';
			$stmt = $dbh->prepare($sql);
			$data[0] = $val;
			$stmt->execute($data);
			$rec = $stmt->fetch(PDO::FETCH_ASSOC);
			$this->pro_name[] = $rec['pro_name'];
			$this->pro_price[] = $rec['price'];
			if($rec['image'] =='') {
				$this->pro_image[] = '';
			} else {
				$this->pro_image[] = 'img_product.php?img='.$rec['image'];
			}
		}

		$this->email_flag = '0';

		$sql = 'SELECT mb_id FROM members WHERE email=?';
		$stmt = $dbh->prepare($sql);
		$data = array();
		$data[] = $this->email;
		$stmt->execute($data);
		$this->res = $stmt->fetch(PDO::FETCH_ASSOC);
		if($this->res!=false) {
			$this->email_flag = '1';
		}
		$dbh = null;
	}

	public function session() {
		$this->mod = '1';
    $_SESSION['l_name'] = $this->l_name;
    $_SESSION['f_name'] = $this->f_name;
    $_SESSION['email'] = $this->email;
    $_SESSION['postal'] = $this->postal;
    $_SESSION['address1'] = $this->address1;
    $_SESSION['address2'] = $this->address2;
    $_SESSION['tel'] = $this->tel;
    $_SESSION['mod'] = 1;
	}
}

class StoreFormDone {
	public $l_name;
	public $f_name;
	public $email;
	public $postal;
	public $address1;
	public $address2;
	public $tel;
	public $order;
	public $pass1;
	public $cart;
	public $kazu;
	public $max;
	public $price;
	public $kakaku;
	public $total;
	public $body;
	public $pay;
	public $title;
	public $header;
	public $pro_name;
	public $pro_image;
	public $pro_price;
	public $num;
	public $date;

	public function __construct() {
		$post = sanitize($_POST);
		$this->l_name = $post['l_name'];
		$this->f_name = $post['f_name'];
		$this->email = $post['email'];
		$this->postal = $post['postal'];
		$this->address1 = $post['address1'];
		$this->address2 = $post['address2'];
		$this->tel = $post['tel'];
		$this->order = $post['order'];
		$this->pass1 = $post['pass1'];
		$this->cart = $_SESSION['cart'];
		$this->kazu = $_SESSION['kazu'];
		$this->max = count($this->cart);
	}

	public function connectDB() {
		for($i=0;$i<$this->max;$i++) {
			$post = sanitize($_POST);
			$this->pro_name[$i]=$post['pro_name'.$i];
			$this->pro_image[$i]=$post['pro_image'.$i];
			$this->pro_price[$i]=$post['pro_price'.$i];
			$this->num[$i]=$post['num'.$i];
		}

		$dsn = 'mysql:dbname=xs184910_ssrs;host=mysql12009.xserver.jp;charset=utf8';
		$user = 'xs184910_user';
		$password = 'Tadashin310';
		$dbh = new PDO($dsn, $user, $password);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = 'LOCK TABLES sales_customers WRITE, sales_products WRITE, members WRITE';
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
	
		$last_mb_id = 0;

		if ($this->order=='2') {
			$sql = 'INSERT INTO members (password,l_name,f_name,email,postal,address1,address2,tel) VALUES (?,?,?,?,?,?,?,?)';
			$stmt = $dbh->prepare($sql);
			$data[] = password_hash($this->pass1, PASSWORD_DEFAULT);
			$data[] = $this->l_name;
			$data[] = $this->f_name;
			$data[] = $this->email;
			$data[] = $this->postal;
			$data[] = $this->address1;
			$data[] = $this->address2;
			$data[] = $this->tel;
			$stmt->execute($data);

			$sql='SELECT mb_id,l_name,f_name FROM members WHERE email=?';
			$stmt=$dbh->prepare($sql);
			$data = array();
			$data[] = $this->email;
			$stmt->execute($data);
			$rec=$stmt->fetch(PDO::FETCH_ASSOC);
			$_SESSION['mb_login']=1;
			$_SESSION['mb_id']=$rec['mb_id'];
			$_SESSION['name']=$this->l_name;
		}

		$sql = 'SELECT LAST_INSERT_ID()';
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		$last_mb_id=$rec['LAST_INSERT_ID()'];
	
		$sql = 'INSERT INTO sales_customers (mb_id,l_name,f_name,email,postal,address1,address2,tel) VALUES (?,?,?,?,?,?,?,?)';
		$stmt = $dbh->prepare($sql);
		$data = array();
		$data[] = $last_mb_id;
		$data[] = $this->l_name;
		$data[] = $this->f_name;
		$data[] = $this->email;
		$data[] = $this->postal;
		$data[] = $this->address1;
		$data[] = $this->address2;
		$data[] = $this->tel;
		$stmt->execute($data);
	
		$sql = 'SELECT LAST_INSERT_ID()';
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		$last_mb_id = $rec['LAST_INSERT_ID()'];
	
		for($i=0; $i<$this->max; $i++) {
			$sql = 'INSERT INTO sales_products (sc_id, pro_id, price, quantity) VALUES (?,?,?,?)';
			$stmt = $dbh->prepare($sql);
			$data = array();
			$data[] = $last_mb_id;
			$data[] = $this->cart[$i];
			$data[] = $this->pro_price[$i];
			$data[] = $this->num[$i];
			$stmt->execute($data);
		}

		$sql = 'UNLOCK TABLES';
		$stmt = $dbh->prepare($sql);
		$stmt->execute();

		$dbh = null;
	}
	
	public function mail() {
		$this->total = $_SESSION['total'];
		$this->body = '';
		$this->body .= $this->l_name."様 \n\nこの度はご注文ありがとうございました。\n";
		$this->body .= "以下にご注文に関する詳細を記しましたので、ご確認ください。\n";
		$this->body .= "\n";
		$this->body .= "ご注文商品: \n";

		for($i=0; $i<$this->max; $i++) {
			$this->body .= $this->pro_name[$i] .' × '. $this->num[$i];
			if($i !== $this->max-1) {
				$this->body .= "\n";
			}
		}
		
		$this->body .= "\n";
		$this->body .= "--------------------------------- \n";
		$this->body .= "\n";
		$this->body .= "お届け先: \n";
		$this->body .= $this->address1.$this->address2. "\n";
		$this->body .= "-------------------------------- \n";
		$this->body .= "\n";
		$this->body .= "お支払い金額: \n";
		$this->body .= $this->total." \n";
		$this->body .= "※配送料はお支払い金額に含まれます。\n";
		$this->body .= "-------------------------------- \n";
		$this->body .= "\n";
		$this->body .= "お支払期限: \n";
		$this->body .= "ご購入から14日以内に下記口座へ入金頂けますよう、お願い申し上げます。期限内での入金が確認できない場合、ご注文は一旦破棄されます。　\n";
		$this->body .= "--------------------------------- \n";
		$this->body .= "\n";
		$this->body .= "お支払い先: \n";
		$this->body .= "~~銀行 ~~支店 普通口座 ~~ \n";
		$this->body .= "入金いただいてから7日以内に、発送させていただきます。\n";
		$this->body .= "--------------------------------- \n";
		$this->body .= "\n";
		$this->body .= "その他: \n";
		$this->body .= "ご注文の手続きにより申請した内容に変更がある、またはキャンセルを希望する場合は、下記連絡先にご連絡いただけますよう、お願い申し上げます。\n";
		$this->body .= "--------------------------------- \n";
		$this->body .= "\n";
		if($this->order=='2') {
		"会員登録について: \n";
		$this->body .= "-------------------------------- \n";
		$this->body .= "今回の手続きにより、会員登録が完了いたしました。\n";
		$this->body .= "次回からメールアドレスとパスワードでログインしてください。\n";
		$this->body .= "ご注文が簡単にできるようになります。\n";
		$this->body .= "\n";
		}
		$this->body .= "　　　　　　　　　　\n";
		$this->body .= "SSRS | Kashikoi Ulysses Official Store\n";
		$this->body .= "事業者名: 賢いユリシーズ\n";
		$this->body .= "URL: http://???????";
		$this->body .= "\n";
		$this->body .= "Tel: ???-????-????\n";
		$this->body .= "Email: ??? \n";
		$this->body .= "　　　　　　　　　　\n";

		$this->title = '【SSRS】ご注文ありがとうございます。';
		$this->header = 'From:';
		$this->body = html_entity_decode($this->body, ENT_QUOTES, 'UTF-8');
		mb_language('japanesse');
		mb_internal_encoding('UTF-8');
		mb_send_mail($this->email, $this->title, $this->body, $this->header);

		$this->title = '【SSRS】'.$this->l_name.$this->f_name.'様からご注文がありました。';
		$this->header = 'From:';
		$this->body = html_entity_decode($this->body, ENT_QUOTES, 'UTF-8');
		mb_internal_encoding('UTF-8');
		mb_send_mail('', $this->title, $this->body, $this->header);
	}
}

class StoreFormMod {
	public $l_name;
	public $f_name;
  public $email;
  public $postal;
  public $address1;
  public $address2;
  public $tel;
	public $mod;
	
	public function __construct() {
		$post=sanitize($_POST);
		$this->l_name=$post['l_name'];
		$this->l_name=$post['f_name'];
		$this->email=$post['email'];
		$this->postal=$post['postal'];
		$this->address1=$post['address1'];
		$this->address2=$post['address2'];
		$this->tel=$post['tel'];
		$this->mod="1";
	}

	public function session() {
		$_SESSION['l_name'] = $this->l_name;
		$_SESSION['f_name'] = $this->f_name;
		$_SESSION['email'] = $this->email;
		$_SESSION['postal'] = $this->postal;
		$_SESSION['address1'] = $this->address1;
		$_SESSION['address2'] = $this->address2;
		$_SESSION['tel'] = $this->tel;
		$_SESSION['mod'] = $this->mod;
		header("Location: store_form.php");
		exit();
	}
}

class StoreKantanCheck {
	public $l_name;
	public $f_name;
	public $email;
	public $postal;
	public $address1;
	public $address2;
	public $tel;
	public $max;
	public $total;
	public $pro_name;
	public $pro_price;
	public $pro_image;
	public $num;
	public $shokei;
	public $cart;
	public $kazu;

	public function __construct() {
		$this->cart = $_SESSION['cart'];
		$this->kazu = $_SESSION['kazu'];
	}

	public function session() {
		$post=sanitize($_POST);
		$this->max = $post['max'];
		$this->total = $post['total'];
		$_SESSION['total'] = $this->total;
		
		for($i=0;$i<$this->max;$i++) {
			$this->num[$i] = $post['num'.$i];
			$this->shokei[$i] = $post['shokei'.$i];
			$_SESSION['num'][$i] = $this->num[$i];
			$_SESSION['shokei'][$i] = $this->shokei[$i];
		}
	}

	public function connectDB1() {
		$dsn='';
		$user='';
		$password='';
		$dbh=new PDO($dsn,$user,$password);
		$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		foreach($this->cart as $key => $val) {
			$sql = 'SELECT pro_name, price, image FROM products WHERE pro_id=?';
			$stmt = $dbh->prepare($sql);
			$data[0] = $val;
			$stmt->execute($data);
			$rec = $stmt->fetch(PDO::FETCH_ASSOC);
			$this->pro_name[] = $rec['pro_name'];
			$this->pro_price[] = $rec['price'];
			if($rec['image'] =='') {
				$this->pro_image[] = '';
			} else {
				$this->pro_image[] = 'img_product.php?img='.$rec['image'];
			}
		}
	}

	public function connectDB2() {
		$mb_id = $_SESSION['mb_id'];
		$dsn = 'mysql:dbname=xs184910_ssrs;host=mysql12009.xserver.jp;charset=utf8';
		$user = 'xs184910_user';
		$password = 'Tadashin310';
		$dbh = new PDO($dsn,$user,$password);
		$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		$sql = 'SELECT l_name,f_name,email,postal,address1,address2,tel FROM members WHERE mb_id=?';
		$stmt=$dbh->prepare($sql);
		$data = array();
		$data[]=$mb_id;
		$stmt->execute($data);
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->l_name = $rec['l_name'];
		$this->f_name = $rec['f_name'];
		$this->email = $rec['email'];
		$this->postal = $rec['postal'];
		$this->address1 = $rec['address1'];
		$this->address2 = $rec['address2'];
		$this->tel = $rec['tel'];

		$dbh = null;
	}
}

class StoreKantanDone {
	public $l_name;
	public $f_name;
	public $email;
	public $postal;
	public $address1;
	public $address2;
	public $tel;
	public $cart;
	public $kazu;
	public $max;
	public $pro_name;
	public $pro_price;
	public $kakaku;
	public $num;
	public $total;
	public $body;
	public $pay;
	public $title;
	public $header;

	public function __construct() {
		$post = sanitize($_POST);
		$this->l_name = $post['l_name'];
		$this->f_name = $post['f_name'];
		$this->email = $post['email'];
		$this->postal = $post['postal'];
		$this->address1 = $post['address1'];
		$this->address2 = $post['address2'];
		$this->tel = $post['tel'];
		$this->cart = $_SESSION['cart'];
		$this->kazu = $_SESSION['kazu'];
		$this->max = count($this->cart);
	}

	public function connectDB() {
		for($i=0;$i<$this->max;$i++) {
			$post = sanitize($_POST);
			$this->pro_name[$i]=$post['pro_name'.$i];
			$this->pro_price[$i]=$post['pro_price'.$i];
			$this->num[$i]=$post['num'.$i];
		}

		$dsn = 'mysql:dbname=xs184910_ssrs;host=mysql12009.xserver.jp;charset=utf8';
		$user = 'xs184910_user';
		$password = 'Tadashin310';
		$dbh = new PDO($dsn, $user, $password);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = 'LOCK TABLES sales_customers WRITE, sales_products WRITE, members WRITE';
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		$last_mb_id = 0;

		$sql = 'INSERT INTO sales_customers (mb_id, l_name, f_name, email, postal, address1, address2, tel) VALUES (?,?,?,?,?,?,?,?)';
		$stmt = $dbh->prepare($sql);
		$data = array();
		$data[] = $last_mb_id;
		$data[] = $this->l_name;
		$data[] = $this->f_name;
		$data[] = $this->email;
		$data[] = $this->postal;
		$data[] = $this->address1;
		$data[] = $this->address2;
		$data[] = $this->tel;
		$stmt->execute($data);

		$sql = 'SELECT LAST_INSERT_ID()';
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		$last_mb_id = $rec['LAST_INSERT_ID()'];

		for($i=0; $i<$this->max; $i++) {
			$sql = 'INSERT INTO sales_products (sc_id, pro_id, price, quantity) VALUES (?,?,?,?)';
			$stmt = $dbh->prepare($sql);
			$data = array();
			$data[] = $last_mb_id;
			$data[] = $this->cart[$i];
			$data[] = $this->pro_price[$i];
			$data[] = $this->num[$i];
			$stmt->execute($data);
		}

		$sql = 'UNLOCK TABLES';
		$stmt = $dbh->prepare($sql);
		$stmt->execute();

		$dbh = null;
	}

	public function mail() {
		$this->total = $_SESSION['total'];
		$this->body = '';
		$this->body .= $this->l_name."様 \n\nこの度はご注文ありがとうございました。\n";
		$this->body .= "以下にご注文に関する詳細を記しましたので、ご確認ください。\n";
		$this->body .= "\n";
		$this->body .= "ご注文商品: \n";
		for($i=0; $i<$this->max; $i++) {
			$this->body .= $this->pro_name[$i] .' × '. $this->num[$i];
		}
		$this->body .= "\n";
		$this->body .= "-------------------------------- \n";
		$this->body .= "\n";
		$this->body .= "お届け先: \n";
		$this->body .= $this->address1.$this->address2. "\n";
		$this->body .= "-------------------------------- \n";
		$this->body .= "\n";
		$this->body .= "お支払い金額: \n";
		$this->body .= $this->total." \n";
		$this->body .= "※配送料はお支払い金額に含まれます。\n";
		$this->body .= "-------------------------------- \n";
		$this->body .= "\n";
		$this->body .= "お支払期限: \n";
		$this->body .= "ご購入から14日以内に下記口座へ入金いただきますよう、お願い申し上げます。期限内での入金が確認できない場合、ご注文は一旦破棄されます。\n";
		$this->body .= "-------------------------------- \n";
		$this->body .= "\n";
		$this->body .= "お支払い先: \n";
		$this->body .= "~~銀行 ~~支店 普通口座 ~~ \n";
		$this->body .= "入金いただいてから7日以内に、発送させていただきます。\n";
		$this->body .= "--------------------------------- \n";
		$this->body .= "\n";
		$this->body .= "その他: \n";
		$this->body .= "購入手続きにより申請した内容に変更がある、またはキャンセルを希望する場合は、下記連絡先にご連絡いただけますよう、お願い申し上げます。\n";
		$this->body .= "--------------------------------- \n";
		$this->body .= "\n";
		$this->body .= "SSRS | Kashikoi Ulysses Official Store\n";
		$this->body .= "事業者名: 賢いユリシーズ \n";
		$this->body .= "URL: http://???????\n";
		$this->body .= "Tel: ???-????-????\n";
		$this->body .= "email: ??? \n";
		$this->body .= "　　　　　　　　　　\n";

		$this->title = '【SSRS】ご注文ありがとうございます。';
		$this->header = 'From:';
		$this->body = html_entity_decode($this->body, ENT_QUOTES, 'UTF-8');
		mb_language('Japanese');
		mb_internal_encoding('UTF-8');
		mb_send_mail($this->email, $this->title, $this->body, $this->header);

		$this->title = '【SSRS】'.$this->l_name.$this->f_name.'様からご注文がありました。';
		$this->header = 'From:';
		$this->body = html_entity_decode($this->body, ENT_QUOTES, 'UTF-8');
		mb_language('Japanese');
		mb_internal_encoding('UTF-8');
		mb_send_mail('', $this->title, $this->body, $this->header);
	}
}

class MemberResistCheck {
	public $l_name;
	public $f_name;
	public $email;
	public $postal;
	public $address1;
	public $address2;
	public $tel;
	public $pass1;
	public $pass2;
	public $conf1;
	public $postal_count;
	public $email_flag;
	public $res;

	public function __construct() {
		$post=sanitize($_POST);
		$this->l_name=$post['l_name'];
		$this->f_name=$post['f_name'];
		$this->email=$post['email'];
		$this->postal=$post['postal'];
		$this->address1=$post['address1'];
		$this->address2=$post['address2'];
		$this->tel=$post['tel'];
		$this->pass1=$post['pass1'];
		$this->pass2=$post['pass2'];
		$this->conf1=$post['conf1'];
	}

	public function connectDB() {
		$this->email_flag = '0';
		$dsn = 'mysql:dbname=xs184910_ssrs;host=mysql12009.xserver.jp;charset=utf8';
		$user = 'xs184910_user';
		$password = 'Tadashin310';
		$dbh = new PDO($dsn, $user, $password);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = 'SELECT mb_id FROM members WHERE email=?';
		$stmt = $dbh->prepare($sql);
		$data[] = $this->email;
		$stmt->execute($data);
		$this->res = $stmt->fetch(PDO::FETCH_ASSOC);
		if($this->res!=false) {
			$this->email_flag = '1';
		}
		$dbh=null;
	}
}

class MemberResistDone {
	public $l_name;
	public $f_name;
	public $email;
	public $postal;
	public $address1;
	public $address2;
	public $tel;
	public $pass1;
	public $id;
	
	public function __construct() {
		$post=sanitize($_POST);
		$this->l_name = $post['l_name'];
		$this->f_name = $post['f_name'];
		$this->email = $post['email'];
		$this->postal = $post['postal'];
		$this->address1 = $post['address1'];
		$this->address2 = $post['address2'];
		$this->tel = $post['tel'];
		$this->pass1 = $post['pass1'];
	}

	public function connectDB() {
		$dsn = 'mysql:dbname=xs184910_ssrs;host=mysql12009.xserver.jp;charset=utf8';
		$user = 'xs184910_user';
		$password = 'Tadashin310';
		$dbh = new PDO($dsn, $user, $password);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = 'INSERT INTO members (password,l_name,f_name,email,postal,address1,address2,tel) VALUES (?,?,?,?,?,?,?,?)';
		$stmt = $dbh->prepare($sql);
		$data[] = password_hash($this->pass1, PASSWORD_DEFAULT);
		$data[] = $this->l_name;
		$data[] = $this->f_name;
		$data[] = $this->email;
		$data[] = $this->postal;
		$data[] = $this->address1;
		$data[] = $this->address2;
		$data[] = $this->tel;
		$stmt->execute($data);

		$sql='SELECT mb_id, l_name, f_name FROM members WHERE email=?';
		$stmt=$dbh->prepare($sql);
		$data = array();
		$data[] = $this->email;
		$stmt->execute($data);
		$rec=$stmt->fetch(PDO::FETCH_ASSOC);
		$this->id = $rec['mb_id'];
		$dbh=null;
	}

	public function session() {
		$_SESSION['mb_login']=1;
		$_SESSION['mb_id']=$this->id;
		$_SESSION['name']=$this->l_name;
	}
}

class MemberLoginCheck {
	public $l_name;
	public $f_name;
	public $email;
	public $pass1;
	public $pass2;
	public $id;
	public $flag_rec;

	public function connectDB() {
		$post=sanitize($_POST);
		$this->email=$post['email'];
		$this->pass1=$post['pass1'];

		$dsn='';
		$user='';
		$password='';
		$dbh=new PDO($dsn,$user,$password);
		$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		$sql='SELECT mb_id,l_name,f_name, password FROM members WHERE email=?';
		$stmt=$dbh->prepare($sql);
		$data[]=$this->email;
		$stmt->execute($data);
		$rec=$stmt->fetch(PDO::FETCH_ASSOC);
		$this->flag_rec = '1';
		$this->id = $rec['mb_id'];
		$this->l_name = $rec['l_name'];
		$this->f_name = $rec['f_name'];
		$this->pass2 = $rec['password'];
		$dbh=null;
	}

	public function session() {
		$_SESSION['mb_login']=1;
		$_SESSION['mb_id']=$this->id;
		$_SESSION['name']=$this->l_name;
	}

}

class Mypage {
	public $l_name;
	public $f_name;
	public $email;
	public $postal;
	public $address1;
	public $address2;
	public $tel;
	
	public function connectDB() {
		$mb_id = $_SESSION['mb_id'];
		$dsn = 'mysql:dbname=xs184910_ssrs;host=mysql12009.xserver.jp;charset=utf8';
		$user = 'xs184910_user';
		$password = 'Tadashin310';
		$dbh = new PDO($dsn,$user,$password);
		$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		
		$sql = 'SELECT l_name,f_name,email,postal,address1,address2,tel FROM members WHERE mb_id=?';
		$stmt=$dbh->prepare($sql);
		$data[]=$mb_id;
		$stmt->execute($data);
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		$dbh = null;
		$this->l_name = $rec['l_name'];
		$this->f_name = $rec['f_name'];
		$this->email = $rec['email'];
		$this->postal = $rec['postal'];
		$this->address1 = $rec['address1'];
		$this->address2 = $rec['address2'];
		$this->tel = $rec['tel'];
	}
}

class MypageMod {
	public $l_name;
	public $f_name;
	public $email;
	public $postal;
	public $address1;
	public $address2;
	public $tel;
	
	public function connectDB() {
		$mb_id = $_SESSION['mb_id'];
		$dsn = 'mysql:dbname=xs184910_ssrs;host=mysql12009.xserver.jp;charset=utf8';
		$user = 'xs184910_user';
		$password = 'Tadashin310';
		$dbh = new PDO($dsn,$user,$password);
		$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		
		$sql = 'SELECT l_name,f_name,email,postal,address1,address2,tel FROM members WHERE mb_id=?';
		$stmt=$dbh->prepare($sql);
		$data[]=$mb_id;
		$stmt->execute($data);
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->l_name = $rec['l_name'];
		$this->f_name = $rec['f_name'];
		$this->email = $rec['email'];
		$this->postal = $rec['postal'];
		$this->address1 = $rec['address1'];
		$this->address2 = $rec['address2'];
		$this->tel = $rec['tel'];
		$dbh = null;
	}
}

class MypageModCheck {
	public $l_name;
	public $f_name;
	public $email;
	public $postal;
	public $address1;
	public $address2;
	public $tel;
	public $pass1;
	public $pass2;
	public $id;
	public $res;
	
	public function __construct() {
		$post=sanitize($_POST);
		$this->l_name=$post['l_name'];
		$this->f_name=$post['f_name'];
		$this->email=$post['email'];
		$this->postal=$post['postal'];
		$this->address1=$post['address1'];
		$this->address2=$post['address2'];
		$this->tel=$post['tel'];
		$this->pass1=$post['pass1'];
		$this->pass2=$post['pass2'];
	}

	public function connectDB() {
		$dsn='';
		$user='';
		$password='';
		$dbh=new PDO($dsn,$user,$password);
		$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		
		$sql='SELECT mb_id,l_name,f_name,password FROM members WHERE email=?';
		$stmt=$dbh->prepare($sql);
		$data[]=$this->email;
		$stmt->execute($data);
		$rec=$stmt->fetch(PDO::FETCH_ASSOC);
		$this->id = $rec['mb_id'];
		$this->l_name = $rec['l_name'];
		$this->f_name = $rec['f_name'];
		$dbh=null;
	}
	
	public function session() {
		$_SESSION['mb_login']=1;
		$_SESSION['mb_id']=$this->id;
		$_SESSION['name']=$this->l_name;
	}
}

class MypageModDone {
	public $l_name;
	public $f_name;
	public $email;
	public $postal;
	public $address1;
	public $address2;
	public $tel;
	public $pass1;
	public $mb_id;
			
	public function __construct() {	
		$this->mb_id = $_SESSION['mb_id'];
		$post = sanitize($_POST);
		$this->l_name = $post['l_name'];
		$this->f_name = $post['f_name'];
		$this->email = $post['email'];
		$this->postal = $post['postal'];
		$this->address1 = $post['address1'];
		$this->address2 = $post['address2'];
		$this->tel = $post['tel'];
		$this->pass1 = $post['pass1'];
	}

	public function connectDB() {
		$dsn='';
		$user='';
		$password='';
		$dbh=new PDO($dsn,$user,$password);
		$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			
		$sql='UPDATE members SET l_name=?,f_name=?,email=?,password=?,postal=?,address1=?,address2=?,tel=? WHERE mb_id=?';
		$stmt=$dbh->prepare($sql);
		$data[]=$this->l_name;
		$data[]=$this->f_name;
		$data[]=$this->email;
		$data[]=$this->pass1;
		$data[]=$this->postal;
		$data[]=$this->address1;
		$data[]=$this->address2;
		$data[]=$this->tel;
		$data[]=$this->mb_id;
		$stmt->execute($data);
		$dbh=null;
	}		
}

?>
