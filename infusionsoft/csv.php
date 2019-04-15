<?php
/**
 * Created by PhpStorm.
 * User: Mwood
 * Date: 5/4/15
 * Time: 1:12 PM
 */
ini_set("display_errors", 1);

error_reporting(E_ALL);
set_time_limit(50000);

require_once("sdk/isdk.php");

$handle = fopen('../opportunities.csv', 'r');
$final_array = array();
while (($data = fgetcsv($handle)) !== false) {
    $final_array[$data[0]." ".$data[1]]=array("FirstName"=>$data[24],"LastName"=>$data[25],"Phone"=>$data[30],"Email"=>$data[31],"Address"=>$data[1],"City"=>$data[2],"State"=>$data[3],"Zip"=>$data[4]);
}

$app = new iSDK;
if ($app->cfgCon("xi178")) {
    $returnFields = array('Id');
    foreach ($final_array as $new) {
        if ($new["Email"]) {
            $contact = $app->findByEmail((string)$new['Email'], $returnFields);
        }

        if (empty($contact)) {
            $contact_id = $app->addCon(array("Email"=>$new['Email'],"FirstName"=>$new['FirstName'],"LastName"=>$new['LastName'],"Phone1"=>$new['Phone']));
            print("made ".$new['FirstName']." ".$new['LastName']."<br/>");
        } else {
            $contact_id = $contact[0]["Id"];
        }

        $opportunity_id = $app->dsAdd("Lead", array(
            "ContactID"=>$contact_id,
            //28 = reserved
            //34 = swapped
            //32 = cancelled
            //30 = deal completed
            "StageID"=>32,
            "OpportunityTitle"=>$new['FirstName']." ".$new['LastName']." | ".$new['Address'].", ".$new['City'].", ".$new['State']." ".$new['Zip'],
            "_PropertyAddress"=>$new['Address'].", ".$new['City'].", ".$new['State']." ".$new['Zip']
        ));
        print("<br/>Made ".$opportunity_id);
    }
}
/*
//        if(!empty($contact)){
//            $records = $app->dsQuery("Lead",10,0,array("ContactId"=>$contact[0]["Id"]),array('Id','ContactId','_PropertyID'));
//            print_r($records);
//            if(!empty($records)){
//                foreach($records as $record){
//                    $app->dsUpdate("Lead",$record["Id"],array("_Account"=>$value["Account"],"_IRAFunded"=>$value["Fund"]));
//                }
//            }
//        }


        if(empty($contact)){
            $contact_id = $app->addCon(array("FirstName" => $value["FirstName"], "LastName" => $value["LastName"],"_Account"=>$value["Account"],"_AccountFunded"=>$value["Fund"] ));
        } else{
            $app->dsUpdate("Contact",$contact[0]["Id"],array("_Account"=>$value["Account"],"_AccountFunded"=>$value["Fund"]));
        }

        //$contact = $app->findByEmail(array((string)$final_array[0], (string)$final_array[1]), $returnFields);

        //die();



        //if (empty($contact)) {
        //	$contact_id = $app->addCon(array("FirstName" => $final_array[0], "LastName" => $final_array[1], ));
        //} else {
        //	$contact_id = $contact[0]["Id"];
        //}
    }

}

ini_set('auto_detect_line_endings',FALSE);
