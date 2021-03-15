<?php
require 'define_product.php';

$FilePath = IMAGES_DIR_PRODUCT . $_GET['img'];
$FileName = $_GET['img'];
$file_length = filesize($FilePath);

header('Content-Type: image/jpeg');
header('Content-Disposition: inline; filename="'.$FileName.'"');
header("Content-Length: " . $file_length);
readfile($FilePath);
?>