<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
set_time_limit(50000);

require_once("sdk/isdk.php");
include_once '../databaseValues.php';
$app = new iSDK;
if ($app->cfgCon("xi178")) {
    $conn = @mysql_pconnect($hostName,$dbUserName,$dbPassword) or die("Database Connection Failed<br>". mysql_error());

    mysql_select_db($databaseName, $conn) or die('DB not selected');
    print('yo');
    $results = mysql_query("SELECT property_id FROM fc_property_reserved_info WHERE id = 1533");
    if($results){
        while($row = mysql_fetch_assoc($results)){
            $app = new iSDK;
            if ($app->cfgCon("xi178")) {
                $records = $app->dsQuery("Lead",1,0,array("_PropertyID"=>$row["property_id"], "StageID"=>"28"),array('Id','ContactId'));
                if($records){
                    foreach($records as $record){
                        $app->grpRemove($record["ContactId"],292);
                        $app->grpAssign($record["ContactId"],294);
                        $app->dsUpdate("Lead",$record["Id"],array("StageID"=>30));
                    }
                }
            }
        }
    }
    die();

    //$results = mysql_query("SELECT * FROM fc_property_swapped");

    //$results = mysql_query("SELECT * FROM fc_property_reserved_info as p LEFT JOIN popup_status as ps ON ps.reserved_id=p.id WHERE ps.invoice_status = 'complete'");

    //$results = mysql_query("SELECT * FROM fc_property_reserved_info as p LEFT JOIN popup_status as ps ON ps.reserved_id=p.id WHERE ps.invoice_status = 'new'");

    //$results = mysql_query("SELECT * FROM fc_property_reserved_info");
    //$results = mysql_query("SELECT res.* FROM popup_status as ps LEFT JOIN fc_property_reserved_info as res ON res.id = ps.reserved_id where invoice_status='complete' ");
    $count = 1;
    if($results){

        while($row = mysql_fetch_assoc($results)){
            $returnFields = array('Id');
            $contact = $app->findByEmail((string)$row['email'], $returnFields);

            if (empty($contact)) {
                $contact_id = $app->addCon(array("Email"=>$row['email'],"FirstName"=>$row['first_name'],"LastName"=>$row['last_name'],"StreetAddress1"=>$row['address'],"City"=>$row['city'],"State"=>$row['state'],"Phone1"=>$row['phone_no'],"PostalCode"=>$row['postal_code'],"Country"=>$row['country']));
                print("made ".$row['first_name']." ".$row['last_name']."<br/>");
            } else {
                $contact_id = $contact[0]["Id"];
            }
            //292=reserved
            //294=completed
            //296=cancelled
            //298=swapped

            $app->grpAssign($contact_id,298);
//            $results2 = mysql_query("SELECT * FROM infusionsoft WHERE property_id = ".$row["property_id"]);
//            if($results2){
//                while($is_info = mysql_fetch_assoc($results2)){
//              $app->dsUpdate("Lead",$is_info["opportunity_id"],array("StageID"=>34));
//}
//}

            $count++;

            // for updating existing records
            //           $records = $app->dsQuery("Lead",1000,0,array("Id"=>"%"),array('Id','ContactId','_PropertyID'));
            //print_r($records);
            //           die();
            //         foreach($records as $record){
            //               //print("INSERT INTO infusionsoft (property_id',contact_id,opportunity_id) VALUES (".$record["_PropertyID"].",".$record["ContactId"].",".$record["Id"].")");
                           //die();


//156
//Garrett - 1
//Chris - 1456

            $opportunity_id = $app->dsAdd("Lead",array(
                "ContactID"=>$contact_id,
                //28 = reserved
                //34 = swapped
                //32 = cancelled
                //30 = deal completed
                "StageID"=>34,
                "OpportunityTitle"=>$row['first_name']." ".$row['last_name']." | ".$row['prop_address'],
                "_PropertyID"=>$row["property_id"],
                "_UserID0"=>$row["user_id"],
                "_SoldAdminID"=>$row["sold_admin_id"],
                "_PropertyAddress"=>$row["prop_address"],
                "_PropertyPrice"=>"$".number_format((int)$row["prop_price"],2),
                "_PropertyImage"=>"http://www.returnonrentals.com/images/product/".$row["image"],
                "_EntityName"=>$row["entity_name"],
                "_ReserveType"=>$row["resrv_type"],
                "_SalesPrice"=>"$".number_format($row["sales_price"],2),
                "_ReservePrice"=>"$".number_format($row["reserv_price"],2),
                "_CashPayment"=>$row["cash_payment"],
                "_CheckPayment"=>$row["check_payment"],
                "_CreditPayment"=>$row["credit_payment"],
                "_DotPayment"=>$row["dot_payment"],
                "_Salescash"=>$row["sales_cash"],
                "_SalesCF"=>$row["sales_cf"],
                "_SalesCS"=>$row["sales_cs"],
                "_SalesFS"=>$row["sales_fs"],
                "_SalesSL"=>$row["sales_sl"],
                "_SalesSLFS"=>$row["sales_sl_fs"],
                "_SalesSDIRA"=>$row["sales_sdira"],
                "_DateAdded"=>$row["dateAdded"],
                "_RentalID"=>$row["rental_id"],
                "_Baths"=>$row["baths"],
                "_Bedrooms"=>$row["bedrooms"],
                "_SquareFeet"=>$row["sq_feet"],
                "_LotSize"=>$row["lot_size"],
                "_MonthlyRent"=>"$".number_format($row["monthly_rent"],2),
                "_Note"=>$row["note"],
                "_PropertyTax"=>"$".number_format($row["property_tax"],2),
                "_CustomerName"=>$row["cust_name"],
                "_AccountNumber"=>$row["account_no"],
                "_ResCode"=>$row["res_code"],
                "_SoldAdminName"=>$row["sold_admin_name"],
                "_ResSource"=>$row["res_source"],
                "_Adjustment"=>$row["adjustment"],
                "_NetPurchasePrice"=>$row["net_purchase_price"],
                "_SFirstName"=>$row["s_firstname"],
                "_SLastName"=>$row["s_lastname"],
                "_SCompanyName"=>$row["s_companyname"],
                "_SAddress"=>$row["s_address"],
                "_SCity"=>$row["s_city"],
                "_SState"=>$row["s_state"],
                "_SZipCode"=>$row["s_zipcode"],
                "_SContact1"=>$row["s_contact1"],
                "_SContact2"=>$row["s_contact2"],
                "_SPhone1"=>$row["s_phone1"],
                "_SPhone2"=>$row["s_phone2"],
                "_SEmail"=>$row["s_email"],
                "_PManager"=>$row["p_manager_name"],
                "_PManagerAddress"=>$row["p_manager_address"],
                "_PManagerCity"=>$row["p_manager_city"],
                "_PManagerState"=>$row["p_manager_state"],
                "_PManagerZipCode"=>$row["p_manager_zipcode"],
                "_PManagerContact1"=>$row["p_manager_contact1"],
                "_PMangerContact2"=>$row["p_manager_contact2"],
                "_PManagerPhone1"=>$row["p_manager_phone1"],
                "_PManagerPhone2"=>$row["p_manager_phone2"],
                "_PManagerEmail"=>$row["p_manager_email"],
                "_PManagerFax"=>$row["p_manager_fax"],
                "_PTenantName"=>$row["p_tenant_name"],
                "_PLeaseTerm"=>$row["p_lease_term"],
                "_PSection8"=>$row["p_section_8"],
                "_PManagerFee"=>$row["p_manager_fee"],
                "_PropertyManagementInfo"=>$row["prop_mgmt_info"],
                "_SourceInfo"=>$row["source_info"],
                "_PRMonthlyRent"=>"$".number_format($row["pr_monthly_rent"],2),
                "_PRAnnualRent"=>"$".number_format($row["pr_annual_rent"],2),
                "_PRHazardInsurance"=>"$".number_format($row["pr_hazard_ins"],2),
                "_PRNetIncome"=>"$".number_format($row["pr_net_income"],2),
                "_PRManagementExspense"=>"$".number_format($row["pr_mgmt_expense"],2),
                "_PRPropertyTax"=>"$".number_format($row["pr_property_tax"],2),
                "_PRUtilities"=>"$".number_format($row["pr_utilities"],2)
            ));
            print($opportunity_id."<br/>");

            mysql_query("INSERT INTO infusionsoft (property_id',contact_id,opportunity_id) VALUES (".$row["property_id"].",".$contact_id.",".$opportunity_id.")");

      }
    }
}

?>