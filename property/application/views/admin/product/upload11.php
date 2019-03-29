<?php require_once "uploader/phpuploader/include_phpuploader.php" 

?>   
<html>   
<body>   
<?php   
//Gets the GUID of the file based on uploader name   
$fileguid=@$_POST["myuploader"];   
if($fileguid)   
{   
    //get the uploaded file based on GUID   
    $mvcfile=$uploader->GetUploadedFile($fileguid);   
    if($mvcfile)   
    {   
        //Gets the name of the file.   
        echo($mvcfile->FileName);   
        //Gets the temp file path.   
        echo($mvcfile->FilePath);   
        //Gets the size of the file.   
        echo($mvcfile->FileSize);    
           
        //Copys the uploaded file to a new location.   
        $mvcfile->CopyTo("./images/city");   
        //Moves the uploaded file to a new location.   
      //  $mvcfile->MoveTo("/uploads");   
        //Deletes this instance.   
		 $sql="insert into fc_rental_photos (product_image,status,property_id) values('$mvcfile->FileName','Active','$id')";
  
      mysql_query($sql) or die ( "INSERT error: ".mysql_error() );
        $mvcfile->Delete();   
    }   
}   
?>  
</body>   
</html>  