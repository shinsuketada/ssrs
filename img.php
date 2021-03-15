<?php
require 'define.php';

$FilePath = IMAGES_DIR . $_GET['img'];
$FileName = $_GET['img'];
$type = image_type_to_mime_type(exif_imagetype($FilePath));
$file_length = filesize($FilePath);

header('Content-Type: '.$type);
header('Content-Disposition: inline; filename="'.$FileName.'"');
header("Content-Length: " . $file_length);
readfile($FilePath);
?>