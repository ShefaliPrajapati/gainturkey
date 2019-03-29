<?php
$c = curl_init();
$url=$_GET['url'];
curl_setopt($c, CURLOPT_URL, $url);
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($c, CURLOPT_ENCODING, "gzip"); 
$data = curl_exec($c);
curl_close($c);
echo $data;
?>
kjohn