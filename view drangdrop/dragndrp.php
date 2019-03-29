    <?php   
      
    require("application/views/admin/product/dragndrop.php");   
    // Gets data from form   
      
    // Opens a connection to a MySQL server   
   
      
     $sql="insert into fc_rental_photos (product_image,status,property_id) values('$mvcfile->FileName','Active','$id')";
  
      mysql_query($sql) or die ( "INSERT error: ".mysql_error() );  
      
    if (!$result)   
    {   
      die('Invalid query: '.mysql_error());   
    }   
      
    ?>   