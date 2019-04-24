<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * This controller contains the functions related to Product management
 * @author Teamtweaks
 *
 */
class Report extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('cookie', 'date', 'form'));
        $this->load->library(array('encrypt', 'form_validation', 'session'));
        $this->load->model('report_model');
    }

    /**
     *
     * This function loads the product list page
     */
    public function index() {
        if ($this->checkLogin('CA') == '') {
            redirect('deals_crm');
        } else {
            $this->load->view('crmadmin/report/create_report', $this->data);
        }
    }

    public function create_report() {
        if ($this->checkLogin('CA') == '') {
            redirect('deals_crm');
        } else {
            $this->data['heading'] = 'Report List';
            $this->data['reportcode'] = $this->report_model->get_all_details(ATTRIBUTE, array('status' => 'Active'));
            $this->data['reportstate'] = $this->report_model->get_all_details(STATE_TAX, array('countryid' => '215', 'status' => 'Active'));
            #echo '<pre>'; print_r($this->data['reportstate']);die;
            #$this->data['productList'] = $this->product_model->view_product_details(' where property_status="UnSold" group by p.id order by p.created desc ');
            $this->data['soldadminName'] = $this->report_model->view_admin_name(' group by sold_admin_name order by id desc');
            $this->load->view('crmadmin/report/create_report', $this->data);
        }
    }

    /**
     *
     * This function loads the selling product list page
     */
    public function display_product_list() {
        //echo $this->checkLogin('CA'); die;
        if ($this->checkLogin('CA') == '') {
            //echo '<pre>'.'hello'; print_r($_POST); die;
            redirect('deals_crm');
        } else {
            $this->data['urlState'] = $urlState = $this->uri->segment(4);

            if ($this->session->userdata('ror_crm_session_admin_type') == 'main') {
                //echo '<pre>'.'hi'; print_r($_POST); die;
                if ($urlState == 'all') {
                    $table = RESERVED_INFO;
                    $whereCnd = array('p.sold_admin_name' => $this->session->userdata('ror_crm_session_admin_name'));
                } elseif ($urlState == 'completed') {
                    $table = RESERVED_INFO;
                    $whereCnd = array('ps.invoice_status' => 'complete', 'p.sold_admin_name' => $this->session->userdata('ror_crm_session_admin_name'));
                } elseif ($urlState == 'cancelled') {
                    $table = CANCELLED;
                    $whereCnd = array();
                } else {
                    $table = RESERVED_INFO;
                    $whereCnd = array('pa.state' => $urlState, 'p.sold_admin_name' => $this->session->userdata('ror_crm_session_admin_name'));
                }
            } else {
                //echo '<pre>'.'bye'; print_r($_POST); die;
                //echo 'siva'; die;
                if ($urlState == 'all') {
                    $table = RESERVED_INFO;
                    $whereCnd = array();
                } elseif ($urlState == 'completed') {
                    $table = RESERVED_INFO;
                    $whereCnd = array('ps.invoice_status' => 'complete');
                } elseif ($urlState == 'cancelled') {
                    $table = CANCELLED;
                    $whereCnd = array();
                } else {
                    $table = RESERVED_INFO;
                    $whereCnd = array('pa.state' => $urlState);
                }
            }
            if ($this->session->userdata('fieldType') != '' && $this->session->userdata('fieldVal') != '') {
                $newCnd = array($this->session->userdata('fieldType') => $this->session->userdata('fieldVal'));
                $admindata = array('fieldType' => '', 'fieldVal' => '');
                $this->session->unset_userdata($admindata);
            }

            //$whereCond = ' and '.$fieldType.' like  "%'.trim(addslashes($fieldVal)).'%"';

            $this->data['heading'] = 'Property List';
            $this->data['productList'] = $this->product_model->view_product_details1($table, $whereCnd, $newCnd);
            //echo "<pre>"; print_r($this->data['productList']->result()); die;
            $this->load->view('crmadmin/product/display_product_list', $this->data);
        }
    }

    public function pdf_report() {
        $this->load->helper(array('Pdf_create'));   //  Load helper
        $data = file_get_contents(site_url('crmadmin/product/display_product_list')); // Pass the url of html report
        create_pdf($data); //Create pdf
    }

    public function createreport() {

        if ($this->checkLogin('CA') == '') {
            redirect('deals_crm');
        } else {
            //echo '<pre>'; print_r($_GET); 
            //die;

            $datefrom = $this->input->get('datefrom');
            $dateto = $this->input->get('dateto');
            $deals = $this->input->get('deals');
            $code = $this->input->get('code');
            $res_source = $this->input->get('reservation_source');
            $state = $this->input->get('state');
            $sales_type = $this->input->get('sales_type');
            $sold_admin_name = $this->input->get('sold_admin');
            $show_property = $this->input->get('show_property');
            $show_purchase = $this->input->get('show_purchase');

            $this->data['deals'] = $deals;

            if ($code != '') {
                $this->db->where("p.res_code", $code);
            }

            if ($res_source != '') {
                $this->db->where("p.res_source", $res_source);
            }

            if ($state != '') {
                $this->db->where("pa.state", $state);
            }

            if ($sales_type != '') {
                $this->db->where("p." . $sales_type . " != ''");
                $this->data['sales_type'] = $sales_type;
            } else {
                //$this->data['sales_type'] = 'sales_sdira';
            }

            if ($sold_admin_name != '') {
                $this->db->where("p.sold_admin_name", $sold_admin_name);
            }
            if ($show_property == 'spa') {
                $this->data['showProperty'] = 'Yes';
            } else {
                $this->data['showProperty'] = 'No';
            }
            if ($show_purchase == 'spp') {
                $this->data['showpurchase'] = 'Yes';
            } else {
                $this->data['showpurchase'] = 'No';
            }

            if ($deals == '1') {
                $table = RESERVED_INFO;
                if ($datefrom != '') {
                    //$this->db->where('p.dateAdded >=', $datefrom.' 00:00:00');
                }

                if ($dateto != '') {
                    //$this->db->where('p.dateAdded <=', $dateto.' 23:59:59'); 
                }
            } elseif ($deals == '2') {
                $table = RESERVED_INFO;
                if ($datefrom != '') {
                    $this->db->where('p.dateAdded >=', $datefrom . ' 00:00:00');
                }

                if ($dateto != '') {
                    $this->db->where('p.dateAdded <=', $dateto . ' 23:59:59');
                }
            } elseif ($deals == '3') {
                $table = RESERVED_INFO;
                if ($datefrom != '') {
                    $this->db->where('ps.completed_date >=', $datefrom . ' 00:00:00');
                }

                if ($dateto != '') {
                    $this->db->where('ps.completed_date <=', $dateto . ' 23:59:59');
                }
                $this->db->where("ps.invoice_status", 'complete');
            } elseif ($deals == '4') {
                if ($datefrom != '') {
                    $this->db->where('p.change_time >=', $datefrom . ' 00:00:00');
                }

                if ($dateto != '') {
                    $this->db->where('p.change_time <=', $dateto . ' 23:59:59');
                }
                $table = CANCELLED;
            } elseif ($deals == '5') {
                if ($datefrom != '') {
                    $this->db->where('p.change_time >=', $datefrom . ' 00:00:00');
                }

                if ($dateto != '') {
                    $this->db->where('p.change_time <=', $dateto . ' 23:59:59');
                }
                $table = SWAPPED;
            } elseif ($deals == '6') {
                $table = RESERVED_INFO;
                if ($datefrom != '') {
                    //$this->db->where('p.dateAdded >=', $datefrom.' 00:00:00');
                }

                if ($dateto != '') {
                    //$this->db->where('p.dateAdded <=', $dateto.' 23:59:59'); 
                }
            }



            $this->data['heading'] = 'Report List';
            //$this->data['productList'] = $this->product_model->view_product_details1($table,$whereCnd,$newCnd);	
            //sa.user_name as sold_admin_name,

            $this->db->select('p.*,
				pa.latitude,pa.longitude,pa.city as cityname,pa.state as statename,pa.post_code,pa.address,
				
				ps.articles_status, ps.loi_status, ps.pa_status, ps.loan_status, ps.doi_status, ps.insurance_status, ps.funded_status, ps.closed_status,		 				ps.hand_off_status, ps.invoice_status, ps.ror_iv_status, ps.gen_iv_status, ps.entity_name as loi_entity_name, ps.reserved_id,ps.completed_date');

            $this->db->from($table . ' as p');
            $this->db->join(PRODUCT_ADDRESS . ' as pa', 'pa.property_id=p.property_id', 'left');
            $this->db->join(CITY . ' as ca', 'ca.id=pa.city', 'left');
            $this->db->join(STATE_TAX . ' as st', 'st.id=pa.state', 'left');
            $this->db->join(USERS . ' as sa', 'sa.id=p.sold_admin_id', 'left');
            $this->db->join(STATUS . ' as ps', 'ps.reserved_id=p.id', 'left');
            if ($deals == '1' || $deals == '2' || $deals == '6') {
                $this->db->where('ps.invoice_status', 'new');
            }

            $this->db->order_by('p.dateAdded', 'desc');
            if ($deals != '4') {
                $this->db->group_by('p.property_id');
            }

            $this->data['productList'] = $productList = $this->db->get();
            //echo '<br>'.$this->db->last_query();
            //echo '<pre>'; print_r($this->data['productList']);die;



            if ($deals == '2' || $deals == '6') {

                if ($datefrom != '') {
                    if ($deals == '6') {
                        $this->db->where('ps.completed_date >=', $datefrom . ' 00:00:00');
                    } else {
                        $this->db->where('p.dateAdded >=', $datefrom . ' 00:00:00');
                    }
                }

                if ($dateto != '') {
                    if ($deals == '6') {
                        $this->db->where('ps.completed_date <=', $dateto . ' 23:59:59');
                    } else {
                        $this->db->where('p.dateAdded <=', $dateto . ' 23:59:59');
                    }
                }

                if ($code != '') {
                    $this->db->where("p.res_code", $code);
                }

                if ($res_source != '') {
                    $this->db->where("p.res_source", $res_source);
                }

                if ($state != '') {
                    $this->db->where("pa.state", $state);
                }

                if ($sales_type != '') {
                    $this->db->where("p." . $sales_type . " != ''");
                    $this->data['sales_type'] = $sales_type;
                } else {
                    //$this->data['sales_type'] = 'sales_sdira';
                }

                if ($sold_admin_name != '') {
                    $this->db->where("p.sold_admin_name", $sold_admin_name);
                }
                if ($show_property == 'spa') {
                    $this->data['showProperty'] = 'Yes';
                } else {
                    $this->data['showProperty'] = 'No';
                }
                if ($show_purchase == 'spp') {
                    $this->data['showpurchase'] = 'Yes';
                } else {
                    $this->data['showpurchase'] = 'No';
                }
                $this->db->select('p.*,
				pa.latitude,pa.longitude,pa.city as cityname,pa.state as statename,pa.post_code,pa.address,
				ps.articles_status, ps.loi_status, ps.pa_status, ps.loan_status, ps.doi_status, ps.insurance_status, ps.funded_status, ps.closed_status,		 				ps.hand_off_status, ps.invoice_status, ps.ror_iv_status, ps.gen_iv_status, ps.entity_name as loi_entity_name, ps.reserved_id,ps.completed_date');

                $this->db->from($table . ' as p');
                $this->db->join(PRODUCT_ADDRESS . ' as pa', 'pa.property_id=p.property_id', 'left');
                $this->db->join(CITY . ' as ca', 'ca.id=pa.city', 'left');
                $this->db->join(STATE_TAX . ' as st', 'st.id=pa.state', 'left');
                $this->db->join(USERS . ' as sa', 'sa.id=p.sold_admin_id', 'left');
                $this->db->join(STATUS . ' as ps', 'ps.reserved_id=p.id', 'left');
                $this->db->where("ps.invoice_status", 'complete');

                $this->db->order_by('p.dateAdded', 'desc');
                $this->db->group_by('p.property_id');
                $this->data['productList1'] = $productList1 = $this->db->get();
                //echo '<br>'.$this->db->last_query();

                if ($datefrom != '') {
                    if ($deals == '6') {
                        $this->db->where('p.change_time >=', $datefrom . ' 00:00:00');
                    } else {
                        $this->db->where('p.dateAdded >=', $datefrom . ' 00:00:00');
                    }
                }

                if ($dateto != '') {
                    if ($deals == '6') {
                        $this->db->where('p.change_time <=', $dateto . ' 23:59:59');
                    } else {
                        $this->db->where('p.dateAdded <=', $dateto . ' 23:59:59');
                    }
                }

                if ($code != '') {
                    $this->db->where("p.res_code", $code);
                }

                if ($res_source != '') {
                    $this->db->where("p.res_source", $res_source);
                }

                if ($state != '') {
                    $this->db->where("pa.state", $state);
                }

                if ($sales_type != '') {
                    $this->db->where("p." . $sales_type . " != ''");
                    $this->data['sales_type'] = $sales_type;
                } else {
                    //$this->data['sales_type'] = 'sales_sdira';
                }

                if ($sold_admin_name != '') {
                    $this->db->where("p.sold_admin_name", $sold_admin_name);
                }
                if ($show_property == 'spa') {
                    $this->data['showProperty'] = 'Yes';
                } else {
                    $this->data['showProperty'] = 'No';
                }
                if ($show_purchase == 'spp') {
                    $this->data['showpurchase'] = 'Yes';
                } else {
                    $this->data['showpurchase'] = 'No';
                }
                $this->db->select('p.*,
				pa.latitude,pa.longitude,pa.city as cityname,pa.state as statename,pa.post_code,pa.address,
				
				ps.articles_status, ps.loi_status, ps.pa_status, ps.loan_status, ps.doi_status, ps.insurance_status, ps.funded_status, ps.closed_status,		 				ps.hand_off_status, ps.invoice_status, ps.ror_iv_status, ps.gen_iv_status, ps.entity_name as loi_entity_name, ps.reserved_id');

                $this->db->from(CANCELLED . ' as p');
                $this->db->join(PRODUCT_ADDRESS . ' as pa', 'pa.property_id=p.property_id', 'left');
                $this->db->join(CITY . ' as ca', 'ca.id=pa.city', 'left');
                $this->db->join(STATE_TAX . ' as st', 'st.id=pa.state', 'left');
                $this->db->join(USERS . ' as sa', 'sa.id=p.sold_admin_id', 'left');
                $this->db->join(STATUS . ' as ps', 'ps.reserved_id=p.id', 'left');

                $this->db->order_by('p.dateAdded', 'desc');
                //$this->db->group_by('p.property_id');
                $this->data['productList2'] = $productList2 = $this->db->get();
                //echo '<br>'.$this->db->last_query(); echo '<pre>'; print_r($productList2->result()); die;

                if ($datefrom != '') {
                    if ($deals == '6') {
                        $this->db->where('p.change_time >=', $datefrom . ' 00:00:00');
                    } else {
                        $this->db->where('p.dateAdded >=', $datefrom . ' 00:00:00');
                    }
                }

                if ($dateto != '') {
                    if ($deals == '6') {
                        $this->db->where('p.change_time <=', $dateto . ' 23:59:59');
                    } else {
                        $this->db->where('p.dateAdded <=', $dateto . ' 23:59:59');
                    }
                }

                if ($code != '') {
                    $this->db->where("p.res_code", $code);
                }

                if ($res_source != '') {
                    $this->db->where("p.res_source", $res_source);
                }

                if ($state != '') {
                    $this->db->where("pa.state", $state);
                }

                if ($sales_type != '') {
                    $this->db->where("p." . $sales_type . " != ''");
                    $this->data['sales_type'] = $sales_type;
                } else {
                    //$this->data['sales_type'] = 'sales_sdira';
                }

                if ($sold_admin_name != '') {
                    $this->db->where("p.sold_admin_name", $sold_admin_name);
                }
                if ($show_property == 'spa') {
                    $this->data['showProperty'] = 'Yes';
                } else {
                    $this->data['showProperty'] = 'No';
                }
                if ($show_purchase == 'spp') {
                    $this->data['showpurchase'] = 'Yes';
                } else {
                    $this->data['showpurchase'] = 'No';
                }
                $this->db->select('p.*,
				pa.latitude,pa.longitude,pa.city as cityname,pa.state as statename,pa.post_code,pa.address,
				
				ps.articles_status, ps.loi_status, ps.pa_status, ps.loan_status, ps.doi_status, ps.insurance_status, ps.funded_status, ps.closed_status,		 				ps.hand_off_status, ps.invoice_status, ps.ror_iv_status, ps.gen_iv_status, ps.entity_name as loi_entity_name, ps.reserved_id');

                $this->db->from(SWAPPED . ' as p');
                $this->db->join(PRODUCT_ADDRESS . ' as pa', 'pa.property_id=p.property_id', 'left');
                $this->db->join(CITY . ' as ca', 'ca.id=pa.city', 'left');
                $this->db->join(STATE_TAX . ' as st', 'st.id=pa.state', 'left');
                $this->db->join(USERS . ' as sa', 'sa.id=p.sold_admin_id', 'left');
                $this->db->join(STATUS . ' as ps', 'ps.reserved_id=p.id', 'left');

                $this->db->order_by('p.dateAdded', 'desc');
                $this->db->group_by('p.property_id');
                $this->data['productList3'] = $productList3 = $this->db->get();
                //echo '<br>'.$this->db->last_query();
            }
            //die;
            //echo '<pre>'; print_r($productList);echo '<pre>'; print_r($productList1);echo '<pre>'; print_r($productList2);echo '<pre>'; print_r($productList3);die;
            //echo $this->db->last_query(); die;

            $this->load->view('crmadmin/report/display_product', $this->data);
        }
    }

    public function printexcel() {

        if ($this->checkLogin('CA') == '') {
            redirect('deals_crm');
        } else {
            // $this->setErrorMessage('error', 'No Data found to export');

             //echo '<pre>'; print_r($_GET); 
            //die;

            $datefrom = $this->input->get('datefrom');
            $dateto = $this->input->get('dateto');
            $deals = $this->input->get('deals');
            $code = $this->input->get('code');
            $res_source = $this->input->get('reservation_source');
            $state = $this->input->get('state');
            $sales_type = $this->input->get('sales_type');
            $sold_admin_name = $this->input->get('sold_admin');
            $show_property = $this->input->get('show_property');
            $show_purchase = $this->input->get('show_purchase');

            $this->data['deals'] = $deals;

            if ($code != '') {
                $this->db->where("p.res_code", $code);
            }

            if ($res_source != '') {
                $this->db->where("p.res_source", $res_source);
            }

            if ($state != '') {
                $this->db->where("pa.state", $state);
            }

            if ($sales_type != '') {
                $this->db->where("p." . $sales_type . " != ''");
                $this->data['sales_type'] = $sales_type;
            } else {
                //$this->data['sales_type'] = 'sales_sdira';
            }

            if ($sold_admin_name != '') {
                $this->db->where("p.sold_admin_name", $sold_admin_name);
            }
            if ($show_property == 'spa') {
                $this->data['showProperty'] = 'Yes';
            } else {
                $this->data['showProperty'] = 'No';
            }
            if ($show_purchase == 'spp') {
                $this->data['showpurchase'] = 'Yes';
            } else {
                $this->data['showpurchase'] = 'No';
            }

            if ($deals == '1') {
                $table = RESERVED_INFO;
                if ($datefrom != '') {
                    //$this->db->where('p.dateAdded >=', $datefrom.' 00:00:00');
                }

                if ($dateto != '') {
                    //$this->db->where('p.dateAdded <=', $dateto.' 23:59:59'); 
                }
            } elseif ($deals == '2') {
                $table = RESERVED_INFO;
                if ($datefrom != '') {
                    $this->db->where('p.dateAdded >=', $datefrom . ' 00:00:00');
                }

                if ($dateto != '') {
                    $this->db->where('p.dateAdded <=', $dateto . ' 23:59:59');
                }
            } elseif ($deals == '3') {
                $table = RESERVED_INFO;
                if ($datefrom != '') {
                    $this->db->where('ps.completed_date >=', $datefrom . ' 00:00:00');
                }

                if ($dateto != '') {
                    $this->db->where('ps.completed_date <=', $dateto . ' 23:59:59');
                }
                $this->db->where("ps.invoice_status", 'complete');
            } elseif ($deals == '4') {
                if ($datefrom != '') {
                    $this->db->where('p.change_time >=', $datefrom . ' 00:00:00');
                }

                if ($dateto != '') {
                    $this->db->where('p.change_time <=', $dateto . ' 23:59:59');
                }
                $table = CANCELLED;
            } elseif ($deals == '5') {
                if ($datefrom != '') {
                    $this->db->where('p.change_time >=', $datefrom . ' 00:00:00');
                }

                if ($dateto != '') {
                    $this->db->where('p.change_time <=', $dateto . ' 23:59:59');
                }
                $table = SWAPPED;
            } elseif ($deals == '6') {
                $table = RESERVED_INFO;
                if ($datefrom != '') {
                    //$this->db->where('p.dateAdded >=', $datefrom.' 00:00:00');
                }

                if ($dateto != '') {
                    //$this->db->where('p.dateAdded <=', $dateto.' 23:59:59'); 
                }
            }



            $this->data['heading'] = 'Report List';
            //$this->data['productList'] = $this->product_model->view_product_details1($table,$whereCnd,$newCnd);   
            //sa.user_name as sold_admin_name,

            $this->db->select('p.*,
                pa.latitude,pa.longitude,pa.city as cityname,pa.state as statename,pa.post_code,pa.address,
                
                ps.articles_status, ps.loi_status, ps.pa_status, ps.loan_status, ps.doi_status, ps.insurance_status, ps.funded_status, ps.closed_status,                        ps.hand_off_status, ps.invoice_status, ps.ror_iv_status, ps.gen_iv_status, ps.entity_name as loi_entity_name, ps.reserved_id,ps.completed_date');

            $this->db->from($table . ' as p');
            $this->db->join(PRODUCT_ADDRESS . ' as pa', 'pa.property_id=p.property_id', 'left');
            $this->db->join(CITY . ' as ca', 'ca.id=pa.city', 'left');
            $this->db->join(STATE_TAX . ' as st', 'st.id=pa.state', 'left');
            $this->db->join(USERS . ' as sa', 'sa.id=p.sold_admin_id', 'left');
            $this->db->join(STATUS . ' as ps', 'ps.reserved_id=p.id', 'left');
            if ($deals == '1' || $deals == '2' || $deals == '6') {
                $this->db->where('ps.invoice_status', 'new');
            }

            $this->db->order_by('p.dateAdded', 'desc');
            if ($deals != '4') {
                $this->db->group_by('p.property_id');
            }

            $this->data['productList'] = $productList = $this->db->get();
            //echo '<br>'.$this->db->last_query();
            //echo '<pre>'; print_r($this->data['productList']);die;
 
            if ($deals == '2' || $deals == '6') {

                if ($datefrom != '') {
                    if ($deals == '6') {
                        $this->db->where('ps.completed_date >=', $datefrom . ' 00:00:00');
                    } else {
                        $this->db->where('p.dateAdded >=', $datefrom . ' 00:00:00');
                    }
                }

                if ($dateto != '') {
                    if ($deals == '6') {
                        $this->db->where('ps.completed_date <=', $dateto . ' 23:59:59');
                    } else {
                        $this->db->where('p.dateAdded <=', $dateto . ' 23:59:59');
                    }
                }

                if ($code != '') {
                    $this->db->where("p.res_code", $code);
                }

                if ($res_source != '') {
                    $this->db->where("p.res_source", $res_source);
                }

                if ($state != '') {
                    $this->db->where("pa.state", $state);
                }

                if ($sales_type != '') {
                    $this->db->where("p." . $sales_type . " != ''");
                    $this->data['sales_type'] = $sales_type;
                } else {
                    //$this->data['sales_type'] = 'sales_sdira';
                }

                if ($sold_admin_name != '') {
                    $this->db->where("p.sold_admin_name", $sold_admin_name);
                }
                if ($show_property == 'spa') {
                    $this->data['showProperty'] = 'Yes';
                } else {
                    $this->data['showProperty'] = 'No';
                }
                if ($show_purchase == 'spp') {
                    $this->data['showpurchase'] = 'Yes';
                } else {
                    $this->data['showpurchase'] = 'No';
                }
                $this->db->select('p.*,
                pa.latitude,pa.longitude,pa.city as cityname,pa.state as statename,pa.post_code,pa.address,
                ps.articles_status, ps.loi_status, ps.pa_status, ps.loan_status, ps.doi_status, ps.insurance_status, ps.funded_status, ps.closed_status,                        ps.hand_off_status, ps.invoice_status, ps.ror_iv_status, ps.gen_iv_status, ps.entity_name as loi_entity_name, ps.reserved_id,ps.completed_date');

                $this->db->from($table . ' as p');
                $this->db->join(PRODUCT_ADDRESS . ' as pa', 'pa.property_id=p.property_id', 'left');
                $this->db->join(CITY . ' as ca', 'ca.id=pa.city', 'left');
                $this->db->join(STATE_TAX . ' as st', 'st.id=pa.state', 'left');
                $this->db->join(USERS . ' as sa', 'sa.id=p.sold_admin_id', 'left');
                $this->db->join(STATUS . ' as ps', 'ps.reserved_id=p.id', 'left');
                $this->db->where("ps.invoice_status", 'complete');

                $this->db->order_by('p.dateAdded', 'desc');
                $this->db->group_by('p.property_id');
                $this->data['productList1'] = $productList1 = $this->db->get();
                //echo '<br>'.$this->db->last_query();

                if ($datefrom != '') {
                    if ($deals == '6') {
                        $this->db->where('p.change_time >=', $datefrom . ' 00:00:00');
                    } else {
                        $this->db->where('p.dateAdded >=', $datefrom . ' 00:00:00');
                    }
                }

                if ($dateto != '') {
                    if ($deals == '6') {
                        $this->db->where('p.change_time <=', $dateto . ' 23:59:59');
                    } else {
                        $this->db->where('p.dateAdded <=', $dateto . ' 23:59:59');
                    }
                }

                if ($code != '') {
                    $this->db->where("p.res_code", $code);
                }

                if ($res_source != '') {
                    $this->db->where("p.res_source", $res_source);
                }

                if ($state != '') {
                    $this->db->where("pa.state", $state);
                }

                if ($sales_type != '') {
                    $this->db->where("p." . $sales_type . " != ''");
                    $this->data['sales_type'] = $sales_type;
                } else {
                    //$this->data['sales_type'] = 'sales_sdira';
                }

                if ($sold_admin_name != '') {
                    $this->db->where("p.sold_admin_name", $sold_admin_name);
                }
                if ($show_property == 'spa') {
                    $this->data['showProperty'] = 'Yes';
                } else {
                    $this->data['showProperty'] = 'No';
                }
                if ($show_purchase == 'spp') {
                    $this->data['showpurchase'] = 'Yes';
                } else {
                    $this->data['showpurchase'] = 'No';
                }
                $this->db->select('p.*,
                pa.latitude,pa.longitude,pa.city as cityname,pa.state as statename,pa.post_code,pa.address,
                
                ps.articles_status, ps.loi_status, ps.pa_status, ps.loan_status, ps.doi_status, ps.insurance_status, ps.funded_status, ps.closed_status,                        ps.hand_off_status, ps.invoice_status, ps.ror_iv_status, ps.gen_iv_status, ps.entity_name as loi_entity_name, ps.reserved_id');

                $this->db->from(CANCELLED . ' as p');
                $this->db->join(PRODUCT_ADDRESS . ' as pa', 'pa.property_id=p.property_id', 'left');
                $this->db->join(CITY . ' as ca', 'ca.id=pa.city', 'left');
                $this->db->join(STATE_TAX . ' as st', 'st.id=pa.state', 'left');
                $this->db->join(USERS . ' as sa', 'sa.id=p.sold_admin_id', 'left');
                $this->db->join(STATUS . ' as ps', 'ps.reserved_id=p.id', 'left');

                $this->db->order_by('p.dateAdded', 'desc');
                //$this->db->group_by('p.property_id');
                $this->data['productList2'] = $productList2 = $this->db->get();
                //echo '<br>'.$this->db->last_query(); echo '<pre>'; print_r($productList2->result()); die;

                if ($datefrom != '') {
                    if ($deals == '6') {
                        $this->db->where('p.change_time >=', $datefrom . ' 00:00:00');
                    } else {
                        $this->db->where('p.dateAdded >=', $datefrom . ' 00:00:00');
                    }
                }

                if ($dateto != '') {
                    if ($deals == '6') {
                        $this->db->where('p.change_time <=', $dateto . ' 23:59:59');
                    } else {
                        $this->db->where('p.dateAdded <=', $dateto . ' 23:59:59');
                    }
                }

                if ($code != '') {
                    $this->db->where("p.res_code", $code);
                }

                if ($res_source != '') {
                    $this->db->where("p.res_source", $res_source);
                }

                if ($state != '') {
                    $this->db->where("pa.state", $state);
                }

                if ($sales_type != '') {
                    $this->db->where("p." . $sales_type . " != ''");
                    $this->data['sales_type'] = $sales_type;
                } else {
                    //$this->data['sales_type'] = 'sales_sdira';
                }

                if ($sold_admin_name != '') {
                    $this->db->where("p.sold_admin_name", $sold_admin_name);
                }
                if ($show_property == 'spa') {
                    $this->data['showProperty'] = 'Yes';
                } else {
                    $this->data['showProperty'] = 'No';
                }
                if ($show_purchase == 'spp') {
                    $this->data['showpurchase'] = 'Yes';
                } else {
                    $this->data['showpurchase'] = 'No';
                }
                $this->db->select('p.*,
                pa.latitude,pa.longitude,pa.city as cityname,pa.state as statename,pa.post_code,pa.address,
                
                ps.articles_status, ps.loi_status, ps.pa_status, ps.loan_status, ps.doi_status, ps.insurance_status, ps.funded_status, ps.closed_status,                        ps.hand_off_status, ps.invoice_status, ps.ror_iv_status, ps.gen_iv_status, ps.entity_name as loi_entity_name, ps.reserved_id');

                $this->db->from(SWAPPED . ' as p');
                $this->db->join(PRODUCT_ADDRESS . ' as pa', 'pa.property_id=p.property_id', 'left');
                $this->db->join(CITY . ' as ca', 'ca.id=pa.city', 'left');
                $this->db->join(STATE_TAX . ' as st', 'st.id=pa.state', 'left');
                $this->db->join(USERS . ' as sa', 'sa.id=p.sold_admin_id', 'left');
                $this->db->join(STATUS . ' as ps', 'ps.reserved_id=p.id', 'left');

                $this->db->order_by('p.dateAdded', 'desc');
                $this->db->group_by('p.property_id');
                $this->data['productList3'] = $productList3 = $this->db->get();
                //echo '<br>'.$this->db->last_query();
            }
            //die;
            // echo '<pre>'; print_r($productList);echo '<pre>'; print_r($productList1);echo '<pre>'; print_r($productList2);echo '<pre>'; print_r($productList3);die;
            // // echo $this->db->last_query(); die;
            $array1 = $productList->result_array();
            $array2 = $productList1->result_array();
            $array3 = $productList2->result_array();
            $array4 = $productList3->result_array();
            $a3 = array_merge($array1,$array2);
            $a4 = array_merge($a3,$array3);
            $a5 = array_merge($a4,$array4);

            $fileName = 'report-'.time().'.xlsx';  
        $this->load->library('excel');
        $this->load->library('Excel');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Entity Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Phone No');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Sales Price');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Reservation Price');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Property Id');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Property Address');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Property Price');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'companyname');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Date Added');
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Baths');
        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Bed Rooms');
        $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Square Feet');
        $objPHPExcel->getActiveSheet()->SetCellValue('P1', 'Lot Size');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'Monthly Rent');
        $objPHPExcel->getActiveSheet()->SetCellValue('R1', 'Note');
        $objPHPExcel->getActiveSheet()->SetCellValue('S1', 'Property Tax');
        $objPHPExcel->getActiveSheet()->SetCellValue('T1', 'Per Monthly Rent');
        $objPHPExcel->getActiveSheet()->SetCellValue('U1', 'Per Annual Rent');
        $objPHPExcel->getActiveSheet()->SetCellValue('V1', 'Per hazard insurance');
        $objPHPExcel->getActiveSheet()->SetCellValue('W1', 'Per Net Income');
        $objPHPExcel->getActiveSheet()->SetCellValue('W1', 'Completed Date');
         // echo '<pre/>';
         // print_r($a5);exit;
        // set Row
        $rowCount = 2;
        foreach ($a5 as $val){
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $val['first_name'] . ' ' .$val['last_name'] );
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $val['entity_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $val['phone_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $val['email']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $val['sales_price']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $val['reserv_price']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $val['property_id']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $val['prop_address']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $val['prop_price']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $val['s_companyname']);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, date('Y-m-d',strtotime($val['dateAdded'])));
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $val['baths']);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $val['bedrooms']);
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $val['sq_feet']);
            $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $val['lot_size']);
            $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $val['monthly_rent']);
            $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $val['note']);
            $objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, '$'.$val['property_tax']);
            $objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowCount, '$'.$val['pr_monthly_rent']);
            $objPHPExcel->getActiveSheet()->SetCellValue('U' . $rowCount, '$'.$val['pr_annual_rent']);
            $objPHPExcel->getActiveSheet()->SetCellValue('V' . $rowCount, '$'.$val['pr_hazard_ins']);
            $objPHPExcel->getActiveSheet()->SetCellValue('W' . $rowCount, '$'.$val['pr_net_income']);
            $objPHPExcel->getActiveSheet()->SetCellValue('W' . $rowCount, date('d-m-Y',strtotime($val['completed_date'])));
            $rowCount++;
        }
    
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName);
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');

        }
    }

    public function netprice() {

        //$table = ;
        //$table = ;
        //$table = ;


        $this->db->select('id,sales_price,adjustment,net_purchase_price');
        $this->db->from(RESERVED_INFO);
        $ReserInfo = $this->db->get();

        foreach ($ReserInfo->result() as $resinfo) {
            if ($resinfo->adjustment != '') {
                $adjmt = $resinfo->adjustment;
            } else {
                $adjmt = 0;
            }
            $netPrice = ($resinfo->sales_price - $adjmt);
            $this->report_model->update_details(RESERVED_INFO, array('net_purchase_price' => $netPrice), array('id' => $resinfo->id));
            echo '<br>' . $this->db->last_query();
        }

        $this->db->select('id,sales_price,adjustment,net_purchase_price');
        $this->db->from(CANCELLED);
        $CanCelInfo = $this->db->get();

        foreach ($CanCelInfo->result() as $Caninfo) {
            if ($Caninfo->adjustment != '') {
                $adjmt = $Caninfo->adjustment;
            } else {
                $adjmt = 0;
            }
            $netPrice = ($Caninfo->sales_price - $adjmt);
            $this->report_model->update_details(CANCELLED, array('net_purchase_price' => $netPrice), array('id' => $Caninfo->id));
            echo '<br>' . $this->db->last_query();
        }

        $this->db->select('id,sales_price,adjustment,net_purchase_price');
        $this->db->from(SWAPPED);
        $SwapInfo = $this->db->get();

        foreach ($SwapInfo->result() as $swpinfo) {
            if ($swpinfo->adjustment != '') {
                $adjmt = $swpinfo->adjustment;
            } else {
                $adjmt = 0;
            }
            $netPrice = ($swpinfo->sales_price - $adjmt);
            $this->report_model->update_details(SWAPPED, array('net_purchase_price' => $netPrice), array('id' => $swpinfo->id));
            echo '<br>' . $this->db->last_query();
        }
    }

}

/* End of file product.php */
/* Location: ./application/controllers/crmadmin/product.php */