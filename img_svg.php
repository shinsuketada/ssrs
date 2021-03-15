<?php
require 'define.php';

$FilePath = IMAGES_DIR . $_GET['img'];
$FileName = $_GET['img'];
$file_length = filesize($FilePath);

header('Content-Type: image/svg+xml');
header('Content-Disposition: inline; filename="'.$FileName.'"');
header("Content-Length: " . $file_length);
readfile($FilePath);
?>