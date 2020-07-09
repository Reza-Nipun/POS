<?php

class Access_model extends CI_Model {
    //put your code here


    public function insertingData($tbl, $data)
    {
	    $this->db->INSERT($tbl, $data);
        return $this->db->insert_id();
    }

    public function getAllUsers(){
        $sql = "SELECT * FROM `tb_user`";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getShops(){
        $sql = "SELECT * FROM `tb_shop`";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getAllSizes(){
        $sql = "SELECT * FROM `tb_size`";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getProductInfoByCode($product_code){
        $sql = "SELECT t1.*, t2.item_name, t3.size, t4.category_name, t5.brand_name 
                From `tb_product` as t1
                LEFT JOIN 
                `tb_item` as t2
                ON t1.item_id=t2.id
                LEFT JOIN 
                `tb_size` as t3
                ON t1.size_id=t3.id
                LEFT JOIN 
                `tb_category` as t4
                ON t1.size_id=t4.id
                LEFT JOIN 
                `tb_brand` as t5
                ON t1.size_id=t5.id
                WHERE t1.product_code='$product_code' AND t1.invoice_id=0";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function productShopTransfer($prod_code, $shop){
        $sql = "Update tb_product 
                SET shop = '$shop'
                WHERE product_code='$prod_code'";

        $query = $this->db->query($sql);
        return $query;
    }

    public function updateProductVendorReturnStatus($prod_id, $status){
        $sql = "Update tb_product 
                SET is_vendor_returned = $status
                WHERE id=$prod_id";

        $query = $this->db->query($sql);
        return $query;
    }

    public function getInvoiceDetail($where){
        $sql = "SELECT t1.invoice_no, t1.total_price, t1.net_price as total_net_price, 
                t1.sale_date_time, t1.user_id, t1.shop, t1.invoice_edit_date_time, t1.invoice_edited_by, 
                t2.*, t2.id as product_id, t2.discount_percentage, t2.net_price, 
                t2.discount_reference, t3.item_name, t4.size, t5.category_name, t6.brand_name 
                FROM `tb_sale_product` as t1
                INNER JOIN
                `tb_product` as t2
                ON t1.id=t2.invoice_id

                LEFT JOIN 
                `tb_item` as t3
                ON t2.item_id=t3.id
                LEFT JOIN 
                `tb_size` as t4
                ON t2.size_id=t4.id
                LEFT JOIN 
                `tb_category` as t5
                ON t2.category_id=t5.id
                LEFT JOIN 
                `tb_brand` as t6
                ON t2.brand_id=t6.id

                WHERE 1 $where";
        
        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getInvoiceReturn($where){
        $sql = "SELECT t1.return_date_time, t1.discount_percentage as return_discount_percentage, t1.net_price as return_net_price, t2.*, t3.*, t4.item_name, t5.size, t6.category_name, t7.brand_name 
                FROM `tb_return_log` as t1

                LEFT JOIN
                `tb_sale_product` as t2
                ON t1.invoice_id=t2.id

                LEFT JOIN 
                `tb_product` as t3
                ON t1.product_id=t3.id

                LEFT JOIN 
                `tb_item` as t4
                ON t3.item_id=t4.id
                LEFT JOIN 
                `tb_size` as t5
                ON t3.size_id=t5.id
                LEFT JOIN 
                `tb_category` as t6
                ON t3.category_id=t6.id
                LEFT JOIN 
                `tb_brand` as t7
                ON t3.brand_id=t7.id

                WHERE 1 $where";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getShopTransferReport($where){
        $sql = "SELECT t1.*, DATE_FORMAT(t1.transfer_date_time, '%Y-%m-%d') as transfer_date, 
                t2.user_name as transferred_by_user, t3.*, t4.item_name, 
                t5.size, t6.category_name, t7.brand_name 
                
                FROM `tb_product_shop_transfer_log` as t1
                LEFT JOIN
                `tb_user` as t2
                ON t1.transferred_by=t2.id
                LEFT JOIN
                `tb_product` as t3
                ON t1.product_code=t3.product_code
                LEFT JOIN 
                `tb_item` as t4
                ON t3.item_id=t4.id
                LEFT JOIN 
                `tb_size` as t5
                ON t3.size_id=t5.id
                LEFT JOIN 
                `tb_category` as t6
                ON t3.category_id=t6.id
                LEFT JOIN 
                `tb_brand` as t7
                ON t3.brand_id=t7.id
                WHERE 1 $where";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getProfitLossReport($where){
        $sql = "SELECT t1.*, DATE_FORMAT(t1.sale_date_time, '%Y-%m-%d') as sale_date, t2.item_name, 
                t3.size, t4.category_name, t5.brand_name, t6.invoice_no, t7.user_name
                
                FROM 
                
                `tb_product` as t1
                LEFT JOIN 
                `tb_item` as t2
                ON t1.item_id=t2.id
                LEFT JOIN 
                `tb_size` as t3
                ON t1.size_id=t3.id
                LEFT JOIN 
                `tb_category` as t4
                ON t1.category_id=t4.id
                LEFT JOIN 
                `tb_brand` as t5
                ON t1.brand_id=t5.id
                LEFT JOIN 
                `tb_sale_product` as t6
                ON t1.invoice_id=t6.id
                LEFT JOIN
                `tb_user` as t7
                ON t1.sold_by_user_id=t7.id
                WHERE t1.invoice_id != 0 $where";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getInventoryReport($where){
        $sql = "SELECT t1.*, t2.item_name, 
                t3.size, t4.category_name, t5.brand_name, t6.user_name
                
                FROM  
                `tb_product` as t1
                LEFT JOIN 
                `tb_item` as t2
                ON t1.item_id=t2.id
                LEFT JOIN 
                `tb_size` as t3
                ON t1.size_id=t3.id
                LEFT JOIN 
                `tb_category` as t4
                ON t1.category_id=t4.id
                LEFT JOIN 
                `tb_brand` as t5
                ON t1.brand_id=t5.id
                LEFT JOIN
                `tb_user` as t6
                ON t1.created_by=t6.id
                WHERE t1.invoice_id = 0 AND t1.is_vendor_returned = 0 $where";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getSummaryReport($where, $dt_where){
        $sql = "SELECT t1.*, t2.total_sold_qty, t2.total_sold_price, t2.total_sold_net_price, t2.total_sold_purchase_price, 
                t3.total_balance_qty, t3.total_balance_purchase_price, t3.total_balance_sale_price,
                t4.item_name, t5.category_name, t6.brand_name
                FROM 
                
                (SELECT brand_id, category_id, item_id, COUNT(id) as total_purchase_qty, 
                SUM(purchase_price) as total_purchase_price, shop 
                FROM `tb_product` WHERE is_vendor_returned = 0 group by brand_id, category_id, item_id, shop) as t1
                
                LEFT JOIN
                (SELECT brand_id, category_id, item_id, COUNT(id) as total_sold_qty, 
                SUM(purchase_price) as total_sold_purchase_price, SUM(sale_price) as total_sold_price, 
                SUM(net_price) as total_sold_net_price, shop
                FROM `tb_product` WHERE invoice_id != 0 AND is_vendor_returned=0 
                $dt_where
                group by brand_id, category_id, item_id, shop) as t2
                ON t1.brand_id=t2.brand_id AND t1.category_id=t2.category_id 
                AND t1.item_id=t2.item_id AND t1.shop=t2.shop
                
                LEFT JOIN
                (SELECT brand_id, category_id, item_id, COUNT(id) as total_balance_qty, 
                SUM(purchase_price) as total_balance_purchase_price, SUM(sale_price) as total_balance_sale_price, shop
                FROM `tb_product` WHERE invoice_id = 0 AND is_vendor_returned=0 group by brand_id, category_id, item_id, shop) as t3
                ON t1.brand_id=t3.brand_id AND t1.category_id=t3.category_id AND t1.item_id=t3.item_id AND t1.shop=t3.shop 
                
                LEFT JOIN 
                `tb_item` as t4
                ON t1.item_id=t4.id
                
                LEFT JOIN 
                `tb_category` as t5
                ON t1.category_id=t5.id
                
                LEFT JOIN 
                `tb_brand` as t6
                ON t1.brand_id=t6.id
                
                WHERE 1 $where";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getPurchaseReport($where){
        $sql = "SELECT t1.*, t4.item_name, t5.category_name, t6.brand_name
                
                FROM 
                (SELECT purchase_date, brand_id, category_id, item_id, COUNT(id) as total_purchase_qty, 
                SUM(purchase_price) as total_purchase_price, shop 
                FROM `tb_product` WHERE is_vendor_returned = 0 group by purchase_date, brand_id, category_id, item_id, shop) as t1
                                
                LEFT JOIN 
                `tb_item` as t4
                ON t1.item_id=t4.id
                
                LEFT JOIN 
                `tb_category` as t5
                ON t1.category_id=t5.id
                
                LEFT JOIN 
                `tb_brand` as t6
                ON t1.brand_id=t6.id
                
                WHERE 1 $where";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getVendorReturnLogReport($where){
        $sql = "SELECT t1.*, DATE_FORMAT(t1.return_date_time, '%Y-%m-%d') as return_date, t2.item_name, 
                t3.size, t4.category_name, t5.brand_name, t7.user_name
                
                FROM 
                
                `tb_vendor_return` as t1
                LEFT JOIN 
                `tb_item` as t2
                ON t1.item_id=t2.id
                LEFT JOIN 
                `tb_size` as t3
                ON t1.size_id=t3.id
                LEFT JOIN 
                `tb_category` as t4
                ON t1.category_id=t4.id
                LEFT JOIN 
                `tb_brand` as t5
                ON t1.brand_id=t5.id
                LEFT JOIN
                `tb_user` as t7
                ON t1.returned_by=t7.id
                WHERE 1 $where";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getProductInfoByCodeShop($product_code, $where){
        $sql = "SELECT t1.*, t2.item_name, t3.size, t4.category_name, t5.brand_name 
                From `tb_product` as t1
                LEFT JOIN 
                `tb_item` as t2
                ON t1.item_id=t2.id
                LEFT JOIN 
                `tb_size` as t3
                ON t1.size_id=t3.id
                LEFT JOIN 
                `tb_category` as t4
                ON t1.category_id=t4.id
                LEFT JOIN 
                `tb_brand` as t5
                ON t1.brand_id=t5.id
                WHERE t1.product_code='$product_code' AND t1.invoice_id=0 AND t1.is_vendor_returned=0 $where";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getProductInfoById($product_id){
        $sql = "SELECT t1.*, t2.item_name, t3.size, t4.category_name, t5.brand_name 
                From `tb_product` as t1
                LEFT JOIN 
                `tb_item` as t2
                ON t1.item_id=t2.id
                LEFT JOIN 
                `tb_size` as t3
                ON t1.size_id=t3.id
                LEFT JOIN 
                `tb_category` as t4
                ON t1.category_id=t4.id
                LEFT JOIN 
                `tb_brand` as t5
                ON t1.brand_id=t5.id
                WHERE t1.id='$product_id'";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getCountInvoice($date){
        $sql = "SELECT count(id) as count_invoice 
                FROM `tb_sale_product` 
                WHERE sale_date_time LIKE '%$date%'";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function saleDetailByInvoiceId($invoice_id){
        $sql = "SELECT t1.invoice_no, t1.total_price, t1.net_price as total_net_price, 
                t1.sale_date_time, t1.user_id, t1.shop, t1.invoice_edit_date_time, t1.invoice_edited_by,
                t2.*, t3.brand_name, t4.item_name, t5.size 
                FROM `tb_sale_product` as t1
                INNER JOIN
                `tb_product` as t2
                ON t1.id=t2.invoice_id
                LEFT JOIN
                `tb_brand` as t3
                ON t2.brand_id=t3.id
                LEFT JOIN
                `tb_item` as t4
                ON t2.item_id=t4.id
                LEFT JOIN
                `tb_size` as t5
                ON t2.size_id=t5.id
                WHERE t1.id=$invoice_id";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getAllUsersWithoutOtherSuperAdmin($user_id){
        $sql = "SELECT t1.* From `tb_user` as t1 WHERE t1.id=$user_id
                UNION
                SELECT t2.* FROM `tb_user` as t2 WHERE t2.access_level != 1";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getAllCategories(){
        $sql = "SELECT * FROM `tb_category`";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getAllActiveCategories(){
        $sql = "SELECT * FROM `tb_category` WHERE status=1";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getAllBrands(){
        $sql = "SELECT * FROM `tb_brand`";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }
    
    public function getAllActiveBrands(){
        $sql = "SELECT * FROM `tb_brand` WHERE status=1";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getAllProducts($where){
        $sql = "SELECT t1.*, t2.brand_name, t3.category_name, t4.item_name, t5.size, t6.user_name as updated_by_user
                FROM 
                `tb_product` as t1 
                INNER JOIN
                `tb_brand` as t2 ON t1.brand_id=t2.id 
                INNER JOIN
                `tb_category` as t3 ON t1.category_id=t3.id 
                INNER JOIN
                `tb_item` as t4 ON t1.item_id=t4.id 
                LEFT JOIN
                `tb_size` as t5 ON t1.size_id=t5.id 
                LEFT JOIN
                `tb_user` as t6 ON t1.updated_by=t6.id
                WHERE t1.invoice_id=0 AND t1.is_vendor_returned=0 $where";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getLastProductId(){
        $sql = "SELECT *, CAST(product_code AS UNSIGNED) as product_code_casted 
                FROM `tb_product` ORDER BY id DESC LIMIT 1";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getAllItems(){
        $sql = "SELECT * FROM `tb_item`";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getAllActiveItems(){
        $sql = "SELECT * FROM `tb_item` WHERE status=1";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getUserInfo($id){
        $sql = "SELECT * FROM `tb_user` WHERE id='$id'";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getCategoryInfo($id){
        $sql = "SELECT * FROM `tb_category` WHERE id='$id'";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getBrandInfo($id){
        $sql = "SELECT * FROM `tb_brand` WHERE id='$id'";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getItemInfo($id){
        $sql = "SELECT * FROM `tb_item` WHERE id='$id'";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function isUserExist($user_name){
        $sql = "SELECT * FROM `tb_user` WHERE user_name='$user_name'";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function isDefectAvailable($carelabel_tracking_no, $line, $access_points, $defect_part, $defect_code)
    {
        $sql = "SELECT * FROM `tb_defects_tracking` 
                WHERE pc_tracking_no LIKE '%$carelabel_tracking_no%' 
                AND line_id=$line AND qc_point=$access_points 
                AND defect_part LIKE '%$defect_part%' 
                AND defect_code LIKE '%$defect_code%' 
                AND defect_recovered=0";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

	public function update_password($employee_code, $confirm_new_password){
		$emp_master_db = $this->load->database('emp_master', TRUE);

		$sql = "Update tb_employee_master set password = $confirm_new_password
               where employee_code='$employee_code'";

        $query = $this->db->query($sql);
        return $query;
	}

    public function productSaleUpdate($prod_code, $sale_date_time, $invoice_id, $sold_by_user_id, $discount_percentage, $discount_reference, $net_price){
        $sql = "Update tb_product 
                
                SET invoice_id = $invoice_id, 
                sale_date_time='$sale_date_time',
                sold_by_user_id='$sold_by_user_id',
                discount_percentage='$discount_percentage', 
                discount_reference='$discount_reference', 
                net_price='$net_price'
                
                WHERE product_code='$prod_code'";

        $query = $this->db->query($sql);
        return $query;
    }

    public function updateReturnProduct($prod_code, $sale_date_time, $invoice_id, $sold_by_user_id){
        $sql = "Update tb_product 
                
                SET invoice_id = $invoice_id, 
                sale_date_time='$sale_date_time',
                sold_by_user_id='$sold_by_user_id'
                
               WHERE product_code='$prod_code'";

        $query = $this->db->query($sql);
        return $query;
    }

    public function updateInvoiceData($tbl, $invoice_no, $data){
        $this->db->where('invoice_no', $invoice_no);
        $query = $this->db->update($tbl, $data);

        return $query;
    }

    public function updateTbl($tbl, $id, $data)
    {
        $this->db->where('id', $id);
        $query = $this->db->update($tbl, $data);

        return $query;
    }
    
}

?>