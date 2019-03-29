<?php ob_start(); session_start();


/** json value **/




/*mysql_connect("localhost","root", "") or die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
mysql_select_db("Signature");
$query = mysql_query("insert into signatures(signature) values('".$_SESSION['id']."')");*/

$val = $_POST['inputtext'];

$signName = $_POST['signname'];

//unset($path);



$name =$signName."_signature"; //$_SESSION['id'];
//$val ="Test";
//echo "a";
require_once 'signature-to-image.php';

//$img = sigJsonToImage(file_get_contents('sig-output.json'));
$img = sigJsonToImage($val);

// Save to file
//imagepng($img, 'signature.png');

// Output to browser
header('Content-Type: image/png');

//$save = "img/". $name .".png";
$save = "../Signature/". $name .".png";
imagepng($img,$save);


//echo "success".$name;
echo "success";
// Destroy the image in memory when complete
  imagedestroy($img);
 
  
 
 
?>
