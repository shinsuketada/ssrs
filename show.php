<?php 
  $user = '';
  $password = '';
  $host = '';
  $dbname = '';
  $dsn = "mysql:dbname={$dbname};host={$host};charset=utf8";
  $pdo = new PDO($dsn,$user,$password);
  $cat = htmlspecialchars($_GET['cat_id'], ENT_QUOTES, 'UTF-8');

  $sql = 'SELECT pro_id, pro_name, price, image FROM products WHERE cat_id = :cat_id';
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':cat_id', $cat, PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $json = json_encode($row);
  echo $json;
?>