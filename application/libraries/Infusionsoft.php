<?php

include(APPPATH.'libraries/ifusionsoft/sdk/isdk.php');
class Infusionsoft{

    private $app;

    function __construct(){
        $this->app = new iSDK;
        $this->app->cfgCon("xi178");
    }
    public function get_contact_id($email){
        $returnFields = array('Id');
        $contact = $this->app->findByEmail($email, $returnFields);
        if($contact){
            return $contact[0]["Id"];
        } else {
            return false;
        }
    }

    public function updates_swapped($opportunityID){
        $result = $this->app->dsUpdate("Lead",$opportunityID,array("StageID"=>34));
        if($result){
            return true;
        } else {
            return false;
        }
    }

    public function updates_cancelled($opportunityID){
        $result = $this->app->dsUpdate("Lead",$opportunityID,array("StageID"=>32));
        if($result){
            return true;
        } else {
            return false;
        }
    }

    public function updates_completed($opportunityID){
        $result = $this->app->dsUpdate("Lead",$opportunityID,array("StageID"=>30));
        if($result){
            return true;
        } else {
            return false;
        }
    }

    public function add_reserved($dataArr){
        $returnFields = array('Id');
        $contact = $this->app->findByEmail((string)$dataArr['email'], $returnFields);

        //Check if contact exists, create if it doesn't
        if (empty($contact)) {
            $contact_id = $this->app->addCon(array("Email"=>$dataArr['email'],"FirstName"=>$dataArr['first_name'],"LastName"=>$dataArr['last_name'],"StreetAddress1"=>$dataArr['address'],"City"=>$dataArr['city'],"State"=>$dataArr['state'],"Phone1"=>$dataArr['phone_no'],"PostalCode"=>$dataArr['postal_code'],"Country"=>$dataArr['country']));
        } else {
            $contact_id = $contact[0]["Id"];
        }

        //Assign reservation tag
        $this->app->grpAssign($contact_id, 156);

        //Assign correct owner if it exists
        if($dataArr['s_firstname']=="Garrett"){
            $owner_id = 1;
        } else if($dataArr['s_firstname']=="Chris"){
            $owner_id = 1456;
        }

        //Create opportunity
        $opportunity_id = $this->app->dsAdd("Lead",array(
            "UserID"=>$owner_id,
            "ContactID"=>$contact_id,
            //28 = reserved
            //34 = swapped
            //32 = cancelled
            //30 = deal completed
            "StageID"=>28,
            "OpportunityTitle"=>$dataArr['first_name']." ".$dataArr['last_name']." | ".$dataArr['prop_address'],
            "_PropertyID"=>"119",
            "_PropertyID"=>$dataArr["property_id"],
            "_UserID0"=>$dataArr["user_id"],
            "_SoldAdminID"=>$dataArr["sold_admin_id"],
            "_PropertyAddress"=>$dataArr["prop_address"],
            "_PropertyPrice"=>"$".number_format($dataArr["prop_price"],2),
            "_PropertyImage"=>"http://beta.gainturnkeyproperty.com/images/product/".$dataArr["image"],
            "_EntityName"=>$dataArr["entity_name"],
            "_ReserveType"=>$dataArr["resrv_type"],
            "_SalesPrice"=>"$".number_format($dataArr["sales_price"],2),
            "_ReservePrice"=>"$".number_format($dataArr["reserv_price"],2),
            "_CashPayment"=>$dataArr["cash_payment"],
            "_CheckPayment"=>$dataArr["check_payment"],
            "_CreditPayment"=>$dataArr["credit_payment"],
            "_DotPayment"=>$dataArr["dot_payment"],
            "_Salescash"=>$dataArr["sales_cash"],
            "_SalesCF"=>$dataArr["sales_cf"],
            "_SalesCS"=>$dataArr["sales_cs"],
            "_SalesFS"=>$dataArr["sales_fs"],
            "_SalesSL"=>$dataArr["sales_sl"],
            "_SalesSLFS"=>$dataArr["sales_sl_fs"],
            "_SalesSDIRA"=>$dataArr["sales_sdira"],
            "_DateAdded"=>$dataArr["dateAdded"],
            "_RentalID"=>$dataArr["rental_id"],
            "_Baths"=>$dataArr["baths"],
            "_Bedrooms"=>$dataArr["bedrooms"],
            "_SquareFeet"=>$dataArr["sq_feet"],
            "_LotSize"=>$dataArr["lot_size"],
            "_MonthlyRent"=>"$".number_format($dataArr["monthly_rent"],2),
            "_Note"=>$dataArr["note"],
            "_PropertyTax"=>"$".number_format($dataArr["property_tax"],2),
            "_CustomerName"=>$dataArr["cust_name"],
            "_AccountNumber"=>$dataArr["account_no"],
            "_ResCode"=>$dataArr["res_code"],
            "_SoldAdminName"=>$dataArr["sold_admin_name"],
            "_ResSource"=>$dataArr["res_source"],
            "_Adjustment"=>$dataArr["adjustment"],
            "_NetPurchasePrice"=>$dataArr["net_purchase_price"],
            "_SFirstName"=>$dataArr["s_firstname"],
            "_SLastName"=>$dataArr["s_lastname"],
            "_SCompanyName"=>$dataArr["s_companyname"],
            "_SAddress"=>$dataArr["s_address"],
            "_SCity"=>$dataArr["s_city"],
            "_SState"=>$dataArr["s_state"],
            "_SZipCode"=>$dataArr["s_zipcode"],
            "_SContact1"=>$dataArr["s_contact1"],
            "_SContact2"=>$dataArr["s_contact2"],
            "_SPhone1"=>$dataArr["s_phone1"],
            "_SPhone2"=>$dataArr["s_phone2"],
            "_SEmail"=>$dataArr["s_email"],
            "_PManager"=>$dataArr["p_manager_name"],
            "_PManagerAddress"=>$dataArr["p_manager_address"],
            "_PManagerCity"=>$dataArr["p_manager_city"],
            "_PManagerState"=>$dataArr["p_manager_state"],
            "_PManagerZipCode"=>$dataArr["p_manager_zipcode"],
            "_PManagerContact1"=>$dataArr["p_manager_contact1"],
            "_PMangerContact2"=>$dataArr["p_manager_contact2"],
            "_PManagerPhone1"=>$dataArr["p_manager_phone1"],
            "_PManagerPhone2"=>$dataArr["p_manager_phone2"],
            "_PManagerEmail"=>$dataArr["p_manager_email"],
            "_PManagerFax"=>$dataArr["p_manager_fax"],
            "_PTenantName"=>$dataArr["p_tenant_name"],
            "_PLeaseTerm"=>$dataArr["p_lease_term"],
            "_PSection8"=>$dataArr["p_section_8"],
            "_PManagerFee"=>$dataArr["p_manager_fee"],
            "_PropertyManagementInfo"=>$dataArr["prop_mgmt_info"],
            "_SourceInfo"=>$dataArr["source_info"],
            "_PRMonthlyRent"=>"$".number_format($dataArr["pr_monthly_rent"],2),
            "_PRAnnualRent"=>"$".number_format($dataArr["pr_annual_rent"],2),
            "_PRHazardInsurance"=>"$".number_format($dataArr["pr_hazard_ins"],2),
            "_PRNetIncome"=>"$".number_format($dataArr["pr_net_income"],2),
            "_PRManagementExspense"=>"$".number_format($dataArr["pr_mgmt_expense"],2),
            "_PRPropertyTax"=>"$".number_format($dataArr["pr_property_tax"],2),
            "_PRUtilities"=>"$".number_format($dataArr["pr_utilities"],2)
        ));

        return array("contact_id"=>$contact_id,"opportunity_id"=>$opportunity_id);
    }
}
