<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
set_time_limit(500000);

require_once("sdk/isdk.php");
include_once '../databaseValues.php';

$conn = @mysql_pconnect($hostName,$dbUserName,$dbPassword) or die("Database Connection Failed<br>". mysql_error());

mysql_select_db($databaseName, $conn) or die('DB not selected');
$app = new iSDK;
if ($app->cfgCon("xi178")) {

    $records = $app->dsQuery("Lead",1,0,array("_PropertyID"=>"935", "StageID"=>"28"),array('Id','ContactId','StageID'));
    if($records){
        foreach($records as $record){
           $app->grpAssign($record["ContactId"],298);
           $app->dsUpdate("Lead",$record["Id"],array("StageID"=>34));
        }
    }
}
/*foreach($records as $record){

mysql_query("INSERT INTO infusionsoft (property_id,contact_id,opportunity_id) VALUES (".$record["_PropertyID"].",".$record["ContactId"].",".$record["Id"].")");

//die();
$returnFields = array('FirstName','LastName');



$results = mysql_query("SELECT * FROM fc_product_address WHERE property_id = ".$record["_PropertyID"]);
if($results){
while($row = mysql_fetch_assoc($results)){

$app->dsUpdate("Lead",$record["Id"],array("OpportunityTitle"=>$contact["FirstName"]." ".$contact["LastName"]." | ".$row["address"]));
}
}

print("1 ");
}
}
die();