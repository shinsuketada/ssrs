<?php
require 'define_favicon.php';

$FilePath = IMAGES_DIR_FAVICON . $_GET['img'];
$FileName = $_GET['img'];
$file_length = filesize($FilePath);

header('Content-Type: image/png');
header('Content-Disposition: inline; filename="'.$FileName.'"');
header("Content-Length: " . $file_length);
readfile($FilePath);
?>