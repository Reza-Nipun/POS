<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();


class Access extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $user_id = $this->session->userdata('id');
        $user_name = $this->session->userdata('user_name');
        $access_level = $this->session->userdata('access_level');

        if ($user_id == NULL && $user_name == NULL && $access_level == 0 && $access_level == '' && $access_level == NULL) {
            redirect('welcome', 'refresh');
        }
        $this->method_call = &get_instance();
        
    }

    public function index() {
        $data['title'] = 'Dashboard';
        $data['shop'] = $this->session->userdata('shop');
        $data['user_name'] = $this->session->userdata('user_name');
        $data['access_level'] = $this->session->userdata('access_level');

        $data['maincontent'] = $this->load->view('dashboard', $data, true);
        $this->load->view('master', $data);
    }

    public function get_users(){
        $data['title'] = 'Manage Users';
        $user_id = $this->session->userdata('id');
        $data['user_name'] = $this->session->userdata('user_name');
        $data['access_level'] = $this->session->userdata('access_level');

        $data['users'] = $this->access_model->getAllUsersWithoutOtherSuperAdmin($user_id);

        $data['maincontent'] = $this->load->view('user_list', $data, true);
        $this->load->view('master', $data);
    }

    public function add_new_user(){
        $data['title'] = 'Dashboard';
        $data['user_name'] = $this->session->userdata('user_name');
        $data['access_level'] = $this->session->userdata('access_level');

        $data['shops'] = $this->access_model->getShops();

        $data['maincontent'] = $this->load->view('add_new_user', $data, true);
        $this->load->view('master', $data);
    }

    public function add_new_category(){
        $data['title'] = 'Add New Category';
        $data['user_name'] = $this->session->userdata('user_name');
        $data['access_level'] = $this->session->userdata('access_level');

        $data['maincontent'] = $this->load->view('add_new_category', $data, true);
        $this->load->view('master', $data);
    }

    public function add_new_brand(){
        $data['title'] = 'Add New Category';
        $data['user_name'] = $this->session->userdata('user_name');
        $data['access_level'] = $this->session->userdata('access_level');

        $data['maincontent'] = $this->load->view('add_new_brand', $data, true);
        $this->load->view('master', $data);
    }

    public function add_new_item(){
        $data['title'] = 'Add New Item';
        $data['user_name'] = $this->session->userdata('user_name');
        $data['access_level'] = $this->session->userdata('access_level');

        $data['maincontent'] = $this->load->view('add_new_item', $data, true);
        $this->load->view('master', $data);
    }

    public function add_new_product(){
        $data['title'] = 'Add New Product';
        $data['user_name'] = $this->session->userdata('user_name');
        $data['access_level'] = $this->session->userdata('access_level');

        $data['brands'] = $this->access_model->getAllActiveBrands();
        $data['categories'] = $this->access_model->getAllActiveCategories();
        $data['items'] = $this->access_model->getAllActiveItems();
        $data['sizes'] = $this->access_model->getAllSizes();
        $data['shops'] = $this->access_model->getShops();

        $data['maincontent'] = $this->load->view('add_new_product', $data, true);
        $this->load->view('master', $data);
    }

    public function isUserExist(){
        $user_name = $this->input->post('user_name');

        $user_res = $this->access_model->isUserExist($user_name);

        echo json_encode($user_res);
    }

    public function selling_info(){
        $data['title'] = 'Selling Info';
        $data['user_id'] = $this->session->userdata('id');
        $data['user_name'] = $this->session->userdata('user_name');
        $data['access_level'] = $this->session->userdata('access_level');
        
        $data['maincontent'] = $this->load->view('selling_info', $data, true);
        $this->load->view('master', $data);
    }

    public function save_new_user(){
        $user_id = $this->session->userdata('id');
        
        $datex = new DateTime(date('H:i:s'));
        $datex->modify('+21500 seconds');
        $create_date_time=$datex->format('Y-m-d H:i:s');
        $date=$datex->format('Y-m-d');
        
        $data['user_name'] = $this->input->post('user_name');
        $user_name = $data['user_name'];
        
        $data['user_password'] = $this->input->post('password');
        $data['shop'] = $this->input->post('shop');
        $data['email'] = $this->input->post('email');
        $data['address'] = $this->input->post('address');
        $data['phone'] = $this->input->post('phone');
        $data['mobile'] = $this->input->post('mobile');
        $data['access_level'] = $this->input->post('access_level');
        $data['status'] = $this->input->post('status');
        $data['create_date'] = $create_date_time;
        $data['created_by'] = $user_id;

        $user_res = $this->access_model->insertingData('tb_user', $data);

        $data['message'] = "$user_name Successfully Saved!";
        $this->session->set_userdata($data);
        redirect('access/get_users');
    }

    public function save_new_category(){
        $data['category_name'] = $this->input->post('category_name');

        $category_name = $data['category_name'];

        $data['category_description'] = $this->input->post('category_description');
        $data['status'] = $this->input->post('status');

        $user_res = $this->access_model->insertingData('tb_category', $data);

        $data['message'] = "$category_name Successfully Saved!";
        $this->session->set_userdata($data);
        redirect('access/category');
    }

    public function save_new_brand(){
        $data['brand_name'] = $this->input->post('brand_name');

        $brand_name = $data['brand_name'];

        $data['brand_description'] = $this->input->post('brand_description');
        $data['status'] = $this->input->post('status');

        $user_res = $this->access_model->insertingData('tb_brand', $data);

        $data['message'] = "$brand_name Successfully Saved!";
        $this->session->set_userdata($data);
        redirect('access/brand');
    }

    public function save_new_item(){
        $data['item_name'] = $this->input->post('item_name');

        $item_name = $data['item_name'];

        $data['item_description'] = $this->input->post('item_description');
        $data['status'] = $this->input->post('status');

        $user_res = $this->access_model->insertingData('tb_item', $data);

        $data['message'] = "$item_name Successfully Saved!";
        $this->session->set_userdata($data);
        redirect('access/item');
    }

    public function save_new_product(){
        $user_id = $this->session->userdata('id');
        
        $datex = new DateTime(date('H:i:s'));
        $datex->modify('+21500 seconds');
        $create_date_time=$datex->format('Y-m-d H:i:s');
        $date=$datex->format('Y-m-d');

        //$create_date_time = date('Y-m-d H:i:s');

        $shop = $this->input->post('shop');
        $brand_id = $this->input->post('brand');
        $category_id = $this->input->post('category');
        $item_id = $this->input->post('item');
        $size_id = $this->input->post('size');
        $purchase_dt = $this->input->post('purchase_date');
        $purchase_price = $this->input->post('purchase_price');
        $sale_price = $this->input->post('sale_price');
        $quantity = $this->input->post('quantity');
        $status = 1;

//        echo '<pre>';
//        print_r($size);
//        echo '</pre>';
//        die();

        $date=explode("-", $purchase_dt);

        $purchase_date = $date[2].'-'.$date[0].'-'.$date[1];

        $last_product_id_res = $this->access_model->getLastProductId();

        $last_product_id = $last_product_id_res[0]['product_code_casted'];

        $array_product = array();
        $array_item = array();
        $array_size = array();
        $array_price = array();

        for ($i=1; $i <= $quantity; $i++){
            $last_product_id++;
            $product_code = sprintf("%010s", $last_product_id.'.');

            array_push($array_product,"$product_code");

            $data = array(
                'product_code' => $product_code,
                'brand_id' => $brand_id,
                'category_id' => $category_id,
                'item_id' => $item_id,
                'size_id' => $size_id,
                'purchase_date' => $purchase_date,
                'purchase_price' => $purchase_price,
                'sale_price' => $sale_price,
                'shop' => "$shop",
                'status' => $status,
                'created_by' => $user_id,
                'create_date' => $create_date_time
            );

            $this->access_model->insertingData('tb_product', $data);
            $product_info = $this->access_model->getProductInfoByCode($product_code);

            $shop = $product_info[0]['shop'];
            $size = $product_info[0]['size'];
            $item_name = $product_info[0]['item_name'];
            $sale_price = $product_info[0]['sale_price'];

            array_push($array_item, "$item_name");
            array_push($array_price, "$sale_price");
            array_push($array_size,"$size");
        }

        $data1['shop'] = $shop;
        $data1['array_item'] = $array_item;
        $data1['array_size'] = $array_size;
        $data1['array_product'] = $array_product;
        $data1['array_price'] = $array_price;

        $data1['status_command'] = 1; // 1=Product Add Page, 2=Single Sticker Print

//        $data['message'] = "Product Successfully Saved!";
//        $this->session->set_userdata($data);
//        redirect('access/add_new_product');
        
        $this->set_barcode($array_product);

        $data['maincontent'] = $this->load->view('print_sticker', $data1);
    }

    public function getProductInfoByCode(){
        $shop = $this->session->userdata('shop');
        
        $where = '';
        if($shop != ''){
            $where .= " AND t1.shop='$shop'";
        }
        
        $product_code = $this->input->post('product_code');
        
        $product_info = $this->access_model->getProductInfoByCodeShop($product_code, $where);
        $prod_code = $product_info[0]['product_code'];
        
        if($prod_code != ''){
            $prod_id = $product_info[0]['id'];
            $brand_name = $product_info[0]['brand_name'];
            $category_name = $product_info[0]['category_name'];
            $item_name = $product_info[0]['item_name'];
            $size = $product_info[0]['size'];
            $sale_price = $product_info[0]['sale_price'];

            $new_line = '';
            $new_line .= '<tr>';


                $new_line .= '<td class="center"><input type="text" readonly name="product_code[]" value="'.$prod_code.'" /><input type="hidden" name="product_id[]" value="'.$prod_id.'" /></td>';
                $new_line .= '<td class="center">'.$brand_name.'</td>';
                $new_line .= '<td class="center">'.$category_name.'</td>';
                $new_line .= '<td class="center">'.$item_name.'</td>';
                $new_line .= '<td class="center">'.$size.'</td>';
                $new_line .= '<td class="center">'.$sale_price.'<input type="hidden" class="price" name="sale_price[]" value="'.$sale_price.'" readonly /></td>';
                $new_line .= '<td><span class="btn btn-danger" id="remove" onclick="deleteRow(this);">REMOVE</span></td>';


            $new_line .= '</tr>';
            echo $new_line;
        }else{
            echo 'NA';
        }
        
    }

    public function selling_product(){
        $data1['title'] = 'Sale Product';
        $data1['shop'] = $this->session->userdata('shop');
        $data1['user_name'] = $this->session->userdata('user_name');
        $data1['access_level'] = $this->session->userdata('access_level');

        $shop = $data1['shop'];

        $datex = new DateTime(date('H:i:s'));
        $datex->modify('+21500 seconds');
        $date_time=$datex->format('Y-m-d H:i:s');
        $date_time_1=$datex->format('YmdHis');
        $date=$datex->format('Y-m-d');
        $date_1=$datex->format('Ymd');

        $product_id_array = $this->input->post('product_id');
        $product_code_array = $this->input->post('product_code');
        $sale_price = $this->input->post('sale_price');

        $count_invoice_res = $this->access_model->getCountInvoice($date);
        $count_invoice = $count_invoice_res[0]['count_invoice'];
        $count_invoice_inc = $count_invoice+1;
        $invoice_no = $date_1.$count_invoice_inc;

        $data['shop'] = $shop;
        $data['invoice_no'] = $invoice_no;
        $data['total_price'] = $this->input->post('total_price');
        $data['discount_percentage'] = $this->input->post('discount');
        $data['discount_reference'] = $this->input->post('discount_reference');
        $data['net_price'] = $this->input->post('net_price');
        $data['sale_date_time'] = $date_time;
        $user_id = $this->session->userdata('id');
        $data['user_id'] = $user_id;

        $inserted_id = $this->access_model->insertingData('tb_sale_product', $data);

        foreach ($product_id_array as $k => $v){
            $prod_code = $product_code_array[$k];
            $sale_date_time = $date_time;
            $invoice_id = $inserted_id;
            $sold_by_user_id = $user_id;

            $this->access_model->productSaleUpdate($prod_code, $sale_date_time, $invoice_id, $sold_by_user_id);
        }

        $this->print_invoice($inserted_id);
    }

    public function update_invoice(){
        $data1['shop'] = $this->session->userdata('shop');
        $user_id = $this->session->userdata('id');
        $data1['user_name'] = $this->session->userdata('user_name');
        $data1['access_level'] = $this->session->userdata('access_level');

        $shop = $data1['shop'];

        $datex = new DateTime(date('H:i:s'));
        $datex->modify('+21500 seconds');
        $date_time=$datex->format('Y-m-d H:i:s');
        $date_time_1=$datex->format('YmdHis');
        $date=$datex->format('Y-m-d');
        $date_1=$datex->format('Ymd');

        $invoice_id = $this->input->post('invoice_id');
        $invoice_no = $this->input->post('invoice_no');

        $product_id_array = $this->input->post('product_id');
        $product_code_array = $this->input->post('product_code');
        $sale_price = $this->input->post('sale_price');

        $data['total_price'] = $this->input->post('total_price');
        $data['net_price'] = $this->input->post('net_price');
        $data['invoice_edit_date_time'] = $date_time;
        $data['invoice_edited_by'] = $user_id;

        $this->access_model->updateInvoiceData('tb_sale_product', $invoice_no, $data);

        foreach ($product_id_array as $k => $v){
            $prod_code = $product_code_array[$k];
            $sale_date_time = $date_time;
            $sold_by_user_id = $user_id;

            $this->access_model->productSaleUpdate($prod_code, $sale_date_time, $invoice_id, $sold_by_user_id);
        }

        $return_product_id = $this->input->post('return_product_id');
        $return_product = $this->input->post('return_product');

        foreach ($return_product_id as $rp) {
            $data1 = array(
                'invoice_id' => $invoice_id,
                'product_id' => $rp,
                'return_date_time' => $date_time,
                'returned_by' => $user_id
            );

            $this->access_model->insertingData('tb_return_log', $data1);

            $data2 = array(
                'invoice_id' => 0,
                'sale_date_time' => '0000-00-00 00:00:00',
                'sold_by_user_id' => 0
            );
            $this->access_model->updateTbl('tb_product', $rp, $data2);
        }

        $this->print_invoice($invoice_id);
    }

    public function transfer_shop($prod_code, $previous_shop, $shop){
        $datex = new DateTime(date('H:i:s'));
        $datex->modify('+21500 seconds');
        $date_time=$datex->format('Y-m-d H:i:s');
        $date_time_1=$datex->format('YmdHis');
        $date=$datex->format('Y-m-d');
        $date_1=$datex->format('Ymd');

        $this->access_model->productShopTransfer($prod_code, $shop);

        $user_id = $this->session->userdata('id');

        $data = array(
            'product_code' => $prod_code,
            'previous_shop' => $previous_shop,
            'present_shop' => $shop,
            'transferred_by' => $user_id,
            'transfer_date_time' => $date_time
        );

        $this->access_model->insertingData('tb_product_shop_transfer_log', $data);

        $data['message'] = "$prod_code Successfully Transferred To $shop";
        $this->session->set_userdata($data);
        redirect('access/products');
    }

    public function getShopList(){
        $data['shops'] = $this->access_model->getShops();

        $maincontent = $this->load->view('shop_list', $data);
        
        return $maincontent;
    }

    public function print_invoice($invoice_id){
        $user_id = $this->session->userdata('id');
        $data1['shop'] = $this->session->userdata('shop');
        $data1['user_info'] = $this->access_model->getUserInfo($user_id);
        
        $data1['invoice_detail'] = $this->access_model->saleDetailByInvoiceId($invoice_id);

        $data['maincontent'] = $this->load->view('invoice_print', $data1);
    }

    public function print_invoice_again($invoice_id){
        $user_id = $this->session->userdata('id');
        $data1['shop'] = $this->session->userdata('shop');
        $data1['user_info'] = $this->access_model->getUserInfo($user_id);
        
        $data1['invoice_detail'] = $this->access_model->saleDetailByInvoiceId($invoice_id);

        $data['maincontent'] = $this->load->view('invoice_print_again', $data1);
    }

    public function editInvoice($invoice_code, $invoice_id){
        $data1['title'] = 'Edit Invoice';
        $data1['shop'] = $this->session->userdata('shop');
        $data1['user_name'] = $this->session->userdata('user_name');
        $data1['access_level'] = $this->session->userdata('access_level');

        $data1['invoice_id'] = $invoice_id;
        $data1['invoice_code'] = $invoice_code;

        $where = '';
        
        if($invoice_code != ''){
            $where .= " AND t1.invoice_no='$invoice_code'";
        }
        
        $data1['invoice_detail'] = $this->access_model->getInvoiceDetail($where);
        
        $data1['maincontent'] = $this->load->view('edit_invoice', $data1, true);
        $this->load->view('master', $data1);
    }

    public function print_sticker($code){
        $array_product = array();
        $array_item = array();
        $array_size = array();
        $array_price = array();

        array_push($array_product,"$code");

        $product_info = $this->access_model->getProductInfoByCode($code);

        $shop = $product_info[0]['shop'];
        $item_name = $product_info[0]['item_name'];
        $size = $product_info[0]['size'];
        $sale_price = $product_info[0]['sale_price'];


        array_push($array_item, "$item_name");
        array_push($array_size, "$size");
        array_push($array_price, "$sale_price");

        $data1['shop'] = $shop;
        $data1['array_item'] = $array_item;
        $data1['array_size'] = $array_size;
        $data1['array_product'] = $array_product;
        $data1['array_price'] = $array_price;

        $data1['status_command'] = 2; // 1=Product Add Page, 2=Single Sticker Print
        
        $data['maincontent'] = $this->load->view('print_sticker', $data1);
    }

    public function index_test()
	{
		//I'm just using rand() function for data example
		$temp = rand(10000, 99999);
		$this->set_barcode($temp);
	}
	
	private function set_barcode($codes)
	{
		//load library
		$this->load->library('zend');
		//load in folder Zend
		$this->zend->load('Zend/Barcode');
		//generate barcode

        foreach ($codes as $code){
            $barcode_img = Zend_Barcode::draw('code128', 'image', array('text'=>$code), array());

            $store_image = imagepng($barcode_img, FCPATH."barcode/{$code}.png");
        }
	}
        
    public function updateUserStatus($id, $status){
        $data['status'] = $status;
        $data['updated_by'] = $this->session->userdata('id');
        $data['update_date'] = date('Y-m-d H:i:s');

        $user_res = $this->access_model->updateTbl('tb_user', $id, $data);

        redirect('access/get_users');
    }

    public function updateCategoryStatus($id, $status){
        $data['status'] = $status;
        $data['updated_by'] = $this->session->userdata('id');
        $data['update_date'] = date('Y-m-d H:i:s');

        $user_res = $this->access_model->updateTbl('tb_category', $id, $data);

        redirect('access/category');
    }

    public function updateBrandStatus($id, $status){
        $data['status'] = $status;
        $data['updated_by'] = $this->session->userdata('id');
        $data['update_date'] = date('Y-m-d H:i:s');

        $user_res = $this->access_model->updateTbl('tb_brand', $id, $data);

        redirect('access/brand');
    }

    public function updateItemStatus($id, $status){
        $data['status'] = $status;
        $data['updated_by'] = $this->session->userdata('id');
        $data['update_date'] = date('Y-m-d H:i:s');

        $user_res = $this->access_model->updateTbl('tb_item', $id, $data);

        redirect('access/item');
    }

    public function updateProductStatus($id, $status){
        $datex = new DateTime(date('H:i:s'));
        $datex->modify('+21500 seconds');
        $update_date_time=$datex->format('Y-m-d H:i:s');
        $date=$datex->format('Y-m-d');

        $data['status'] = $status;
        $data['updated_by'] = $this->session->userdata('id');
        $data['update_date'] = $update_date_time;

        $user_res = $this->access_model->updateTbl('tb_product', $id, $data);

        redirect('access/products');
    }

    public function editUserInfo($id){
        $data['title'] = 'Edit User Info';
        $data['user_name'] = $this->session->userdata('user_name');
        $data['access_level'] = $this->session->userdata('access_level');

        $data['user_info'] = $this->access_model->getUserInfo($id);
        $data['shops'] = $this->access_model->getShops();

        $data['maincontent'] = $this->load->view('edit_user_info', $data, true);
        $this->load->view('master', $data);
    }

    public function editProduct($id){
        $data['title'] = 'Edit Product';
        $data['user_id'] = $this->session->userdata('id');
        $data['user_name'] = $this->session->userdata('user_name');
        $data['access_level'] = $this->session->userdata('access_level');

        $data['prod_info'] = $this->access_model->getProductInfoById($id);
        $data['shops'] = $this->access_model->getShops();
        
        $data['brands'] = $this->access_model->getAllActiveBrands();
        $data['categories'] = $this->access_model->getAllActiveCategories();
        $data['items'] = $this->access_model->getAllActiveItems();
        $data['sizes'] = $this->access_model->getAllSizes();
        
        $data['maincontent'] = $this->load->view('edit_product', $data, true);
        $this->load->view('master', $data);
    }

    public function getInvoiceDetail(){
        $invoice_code = $this->input->post('invoice_code');
        
        $where = '';
        $where1 = '';

        if($invoice_code != ''){
            $where .= " AND t1.invoice_no='$invoice_code'";
            $where1 .= " AND t2.invoice_no='$invoice_code'";
        }
        
        $data['invoice_detail'] = $this->access_model->getInvoiceDetail($where);
        $data['invoice_return'] = $this->access_model->getInvoiceReturn($where1);

        echo $maincontent = $this->load->view('invoice_detail', $data);
    }

    public function transfer_report(){
        $data['title'] = 'Shop Transfer Report';

        $user_id = $this->session->userdata('id');
        $shop = $this->session->userdata('shop');
        $user_name = $this->session->userdata('user_name');

        $data['user_id'] = $user_id;
        $data['shop'] = $shop;
        $data['user_name'] = $user_name;
        $data['access_level'] = $this->session->userdata('access_level');

        $datex = new DateTime(date('H:i:s'));
        $datex->modify('+21500 seconds');
        $update_date_time=$datex->format('Y-m-d H:i:s');
        $month_year=$datex->format('Y-m');
        $date=$datex->format('Y-m-d');

        $where = '';

        if($shop != ''){
            $where .= " AND t1.previous_shop='$shop'";
        }

        if($month_year != '' && $month_year != '1970-01'){
            $where .= " AND DATE_FORMAT(t1.transfer_date_time, '%Y-%m')='$month_year'";
        }

        $data['shops'] = $this->access_model->getShops();
        $data['trans_report'] = $this->access_model->getShopTransferReport($where);

        $data['maincontent'] = $this->load->view('transfer_report', $data, true);
        $this->load->view('master', $data);
    }

    public function getTransferReport(){
        $shop = $this->input->post('shop');
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');

        $where = '';

        if($shop != ''){
            $where .= " AND t1.previous_shop='$shop'";
        }

        if($from_date != '' && $from_date != '1970-01-01' && $to_date != '' && $to_date != '1970-01-01'){
            $where .= " and DATE_FORMAT(t1.transfer_date_time, '%Y-%m-%d') between '$from_date' and '$to_date' ";
        }
        $data['trans_report'] = $this->access_model->getShopTransferReport($where);

        echo $maincontent = $this->load->view('transfer_report_filter', $data);

    }

    public function getProfitLossReport(){
        $shop = $this->input->post('shop');
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');

        $where = '';

        if($shop != ''){
            $where .= " AND t1.shop='$shop'";
        }

        if($from_date != '' && $from_date != '1970-01-01' && $to_date != '' && $to_date != '1970-01-01'){
            $where .= " and DATE_FORMAT(t1.sale_date_time, '%Y-%m-%d') between '$from_date' and '$to_date' ";
        }
        $data['profit_loss_report'] = $this->access_model->getProfitLossReport($where);

        echo $maincontent = $this->load->view('profit_loss_report_filter', $data);

    }

    public function profit_loss_report(){
        $data['title'] = 'Profit-Loss Report';

        $user_id = $this->session->userdata('id');
        $shop = $this->session->userdata('shop');
        $user_name = $this->session->userdata('user_name');

        $data['user_id'] = $user_id;
        $data['shop'] = $shop;
        $data['user_name'] = $user_name;
        $data['access_level'] = $this->session->userdata('access_level');

        $datex = new DateTime(date('H:i:s'));
        $datex->modify('+21500 seconds');
        $update_date_time=$datex->format('Y-m-d H:i:s');
        $month_year=$datex->format('Y-m');
        $date=$datex->format('Y-m-d');

        $where = '';

        if($shop != ''){
            $where .= " AND t1.shop='$shop'";
        }

        if($month_year != '' && $month_year != '1970-01'){
            $where .= " AND DATE_FORMAT(t1.sale_date_time, '%Y-%m')='$month_year'";
        }

        $data['shops'] = $this->access_model->getShops();
        $data['profit_loss_report'] = $this->access_model->getProfitLossReport($where);

        $data['maincontent'] = $this->load->view('profit_loss_report', $data, true);
        $this->load->view('master', $data);
    }

    public function update_product(){
        $user_id = $this->session->userdata('id');
        $user_name = $this->session->userdata('user_name');

        $datex = new DateTime(date('H:i:s'));
        $datex->modify('+21500 seconds');
        $update_date_time=$datex->format('Y-m-d H:i:s');
        $date=$datex->format('Y-m-d');

        $product_code  = $this->input->post('product_code');
        $prod_id  = $this->input->post('product_id');
        $data['updated_by']  = $user_id;
        $data['update_date']  = $update_date_time;
        $data['purchase_price']  = $this->input->post('purchase_price');
        $data['sale_price']  = $this->input->post('sale_price');

//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';

        $this->access_model->updateTbl('tb_product', $prod_id, $data);

        $data1['message'] = "$product_code Successfully Updated By $user_name .";
        $this->session->set_userdata($data1);

        redirect('access/products');
    }

    public function editCategoryInfo($id){
        $data['title'] = 'Edit Category Info';
        $data['user_name'] = $this->session->userdata('user_name');
        $data['access_level'] = $this->session->userdata('access_level');

        $data['category_info'] = $this->access_model->getCategoryInfo($id);

        $data['maincontent'] = $this->load->view('edit_category_info', $data, true);
        $this->load->view('master', $data);
    }

    public function editBrandInfo($id){
        $data['title'] = 'Edit Category Info';
        $data['user_name'] = $this->session->userdata('user_name');
        $data['access_level'] = $this->session->userdata('access_level');

        $data['brand_info'] = $this->access_model->getBrandInfo($id);

        $data['maincontent'] = $this->load->view('edit_brand_info', $data, true);
        $this->load->view('master', $data);
    }

    public function editItemInfo($id){
        $data['title'] = 'Edit Item Info';
        $data['user_name'] = $this->session->userdata('user_name');
        $data['access_level'] = $this->session->userdata('access_level');

        $data['item_info'] = $this->access_model->getItemInfo($id);

        $data['maincontent'] = $this->load->view('edit_item_info', $data, true);
        $this->load->view('master', $data);
    }

    public function update_user_info(){
        $data1['title'] = 'Manage Users';
        $data1['user_id'] = $this->session->userdata('id');
        $data1['user_name'] = $this->session->userdata('user_name');
        $data1['access_level'] = $this->session->userdata('access_level');

        $id = $this->input->post('id');
        $user_name = $this->input->post('user_name');
        $data['user_password'] = $this->input->post('password');
        $shop = $this->input->post('shop');
        $access_level = $data1['access_level'];
        
        $shop_name='';
        if($shop == '0' ){
            $shop_name = '';
        }
        if($shop != ''){
            $shop_name = $shop;
        }

        $data['shop'] = $shop_name;
        $data['email'] = $this->input->post('email');
        $data['phone'] = $this->input->post('phone');
        $data['mobile'] = $this->input->post('mobile');
        $data['address'] = $this->input->post('address');
//        $data['access_level'] = $this->input->post('access_level');
        $data['status'] = $this->input->post('status');

        $user_res = $this->access_model->updateTbl('tb_user', $id, $data);

        $data1['message'] = "$user_name Successfully Updated!";
        $this->session->set_userdata($data1);

//        $data1['users'] = $this->access_model->getAllUsers();
//
//        $data1['maincontent'] = $this->load->view('user_list', $data1, true);
//        $this->load->view('master', $data1);

        redirect('access/get_users');
    }

    public function update_category_info(){
        $data1['title'] = 'Manage Category Info';
        $data1['user_name'] = $this->session->userdata('user_name');
        $data1['access_level'] = $this->session->userdata('access_level');

        $id = $this->input->post('id');
        $data['category_name'] = $this->input->post('category_name');
        $category_name = $data['category_name'];

        $data['category_description'] = $this->input->post('category_description');
        $data['status'] = $this->input->post('status');

        $user_res = $this->access_model->updateTbl('tb_category', $id, $data);

        $data1['message'] = "$category_name Successfully Updated!";
        $this->session->set_userdata($data1);

        redirect('access/category');
    }

    public function update_brand_info(){
        $data1['title'] = 'Manage Brand Info';
        $data1['user_name'] = $this->session->userdata('user_name');
        $data1['access_level'] = $this->session->userdata('access_level');

        $id = $this->input->post('id');
        $data['brand_name'] = $this->input->post('brand_name');
        $category_name = $data['brand_name'];

        $data['brand_description'] = $this->input->post('brand_description');
        $data['status'] = $this->input->post('status');

        $user_res = $this->access_model->updateTbl('tb_brand', $id, $data);

        $data1['message'] = "$category_name Successfully Updated!";
        $this->session->set_userdata($data1);

        redirect('access/brand');
    }

    public function update_item_info(){
        $data1['title'] = 'Manage Item Info';
        $data1['user_name'] = $this->session->userdata('user_name');
        $data1['access_level'] = $this->session->userdata('access_level');

        $id = $this->input->post('id');
        $data['item_name'] = $this->input->post('item_name');
        $item_name = $data['item_name'];

        $data['item_description'] = $this->input->post('item_description');
        $data['status'] = $this->input->post('status');

        $user_res = $this->access_model->updateTbl('tb_item', $id, $data);

        $data1['message'] = "$item_name Successfully Updated!";
        $this->session->set_userdata($data1);

        redirect('access/item');
    }

    public function brand(){
        $data1['title'] = 'Brand';
        $data1['user_name'] = $this->session->userdata('user_name');
        $data1['access_level'] = $this->session->userdata('access_level');

        $data1['brands'] = $this->access_model->getAllBrands();

        $data1['maincontent'] = $this->load->view('brand_list', $data1, true);
        $this->load->view('master', $data1);
    }

    public function category(){
        $data1['title'] = 'Category';
        $data1['user_name'] = $this->session->userdata('user_name');
        $data1['access_level'] = $this->session->userdata('access_level');

        $data1['categories'] = $this->access_model->getAllCategories();

        $data1['maincontent'] = $this->load->view('category_list', $data1, true);
        $this->load->view('master', $data1);
    }

    public function Item(){
        $data1['title'] = 'Item';
        $data1['user_name'] = $this->session->userdata('user_name');
        $data1['access_level'] = $this->session->userdata('access_level');

        $data1['items'] = $this->access_model->getAllItems();

        $data1['maincontent'] = $this->load->view('item_list', $data1, true);
        $this->load->view('master', $data1);
    }

    public function products(){
        $data1['title'] = 'Products';
        $data1['shop'] = $this->session->userdata('shop');
        $data1['user_name'] = $this->session->userdata('user_name');
        $data1['access_level'] = $this->session->userdata('access_level');

        $where = '';
        if($data1['shop'] != ''){
            $shop = $data1['shop'];
            $where .= " AND t1.shop='$shop'";
        }

        $data1['shops'] = $this->access_model->getShops();
        $data1['products'] = $this->access_model->getAllProducts($where);

        $data1['maincontent'] = $this->load->view('product_list', $data1, true);
        $this->load->view('master', $data1);
    }

    public function searchProductInfo(){
        $data1['user_name'] = $this->session->userdata('user_name');
        $data1['access_level'] = $this->session->userdata('access_level');

        $shop = $this->input->post('shop');
        $product_code = $this->input->post('product_code');

        $where = '';
        if($shop != ''){
            $where .= " AND t1.shop='$shop'";
        }
        if($product_code != ''){
            $where .= " AND t1.product_code='$product_code'";
        }

        $data1['products'] = $this->access_model->getAllProducts($where);

        $data1['maincontent'] = $this->load->view('product_info_filter', $data1);
    }

    public function sale_product(){
        $data1['title'] = 'Sale Product';
        $data1['user_name'] = $this->session->userdata('user_name');
        $data1['access_level'] = $this->session->userdata('access_level');

        $data1['maincontent'] = $this->load->view('sale_product', $data1, true);
        $this->load->view('master', $data1);
    }

    public function logout() {
        $user_name = $this->session->unset_userdata('user_name');
        $access_level = $this->session->unset_userdata('access_level');

        session_destroy();
        $data['message'] = 'Successfully Logged out!';
        $this->session->set_userdata($data);
        redirect('welcome');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */