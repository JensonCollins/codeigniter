<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 *  @author : Rahul Shakya
 *  @support: rahulshakyaphp@gmail.com
 *  date    : 11 June, 2016
 */

class Storage_Model extends MY_Model
{
    public $_table_name;
    public $_order_by;
    public $_primary_key;

    public function get_all_storage_info()
    {	
        $this->db->select('tbl_storage.*', false);
        $this->db->select('tbl_subcategory.subcategory_name', false);
        $this->db->select('tbl_category.category_name', false);
        $this->db->from('tbl_storage');

        $this->db->where("tbl_storage.product_code NOT IN (select tbl_store_order_details.product_code FROM tbl_store_order_details) ");

        $this->db->join('tbl_subcategory', 'tbl_subcategory.subcategory_id  =  tbl_storage.subcategory_id ', 'left');
        $this->db->join('tbl_category', 'tbl_category.category_id  =  tbl_storage.category_id ', 'left');
        $this->db->order_by('tbl_storage.storage_id', ' DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_all_order_storage_info()
    {   
        $this->db->select('tbl_storage_invoice.*, tbl_store_order.*', false);
        $this->db->from('tbl_store_order');
        $this->db->join('tbl_storage_invoice', 'tbl_storage_invoice.store_order_id  =  tbl_store_order.store_order_id ', 'left');
        $this->db->order_by('tbl_store_order.store_order_id', ' DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_storage_information_by_id($id)
    {
        $this->db->select('tbl_storage.*', false);
        $this->db->select('tbl_subcategory.subcategory_name', false);
        $this->db->select('tbl_category.category_name', false);
        $this->db->from('tbl_storage');
        $this->db->where('tbl_storage.storage_id', $id);
        $this->db->join('tbl_subcategory', 'tbl_subcategory.subcategory_id  =  tbl_storage.subcategory_id ', 'left');
        $this->db->join('tbl_category', 'tbl_category.category_id  =  tbl_storage.category_id ', 'left');
        $this->db->order_by('tbl_storage.storage_id', ' DESC');
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function get_customer($q){
    $this->db->select('*');
    $this->db->like('customer_name', $q);
    $query = $this->db->get('tbl_customer');
    //echo $this->db->last_query();die;
    if($query->num_rows > 0){
      foreach ($query->result_array() as $row){
        $cust = $row['customer_name'] . "-" .$row['fc_no'] ;
        $row_set[] = htmlentities(stripslashes($cust)); //build an array
        }
     return $row_set;//for;at the array into json data
        }
    }

    public function save_store_order($store_order_no,$acquisition, $cust_id,$cust_name,$fc_no,$address,$phone,$store_start_date,$store_end_date,$store_by,$store_order_status,$storage_days,$cost_per_day,$total_cost)
    {
		$store_order_no = $this->db->escape($store_order_no);
        $acquisition = $this->db->escape($acquisition);
		$cust_id = $this->db->escape($cust_id);
		$cust_name = $this->db->escape($cust_name);
		$fc_no = $this->db->escape($fc_no);
		$address = $this->db->escape($address);
		$phone = $this->db->escape($phone);
		$store_start_date = $this->db->escape($store_start_date);
		$store_end_date = $this->db->escape($store_end_date);
		$store_by = $this->db->escape($store_by);
		$store_order_status = $this->db->escape($store_order_status);
        $storage_days = $this->db->escape($storage_days);
        $cost_per_day = $this->db->escape($cost_per_day);
        $total_cost = $this->db->escape($total_cost);

		$sql = "INSERT INTO tbl_store_order (store_order_no,acquisition,customer_id,customer_name,fc_no,address,phone,store_start_date,store_end_date,store_by,store_order_status,storage_days,cost_per_day,total_cost) " .
		"VALUES ({$store_order_no},{$acquisition},{$cust_id},{$cust_name},{$fc_no},{$address},{$phone},{$store_start_date},{$store_end_date},{$store_by},{$store_order_status},{$storage_days},{$cost_per_day},{$total_cost})";

		$this->db->query($sql);		

		$id = $this->db->insert_id();

		return $id;
    }

    public function save_store_order_details($last_store_order_id,$product_code,$product_name,$product_calibre,$product_serial,$category_id,$subcategory_id,$product_quantity)
    {  
		$last_store_order_id = $this->db->escape($last_store_order_id);
		$product_code = $this->db->escape($product_code);
		$product_name = $this->db->escape($product_name);
		$product_calibre = $this->db->escape($product_calibre);
        $product_serial = $this->db->escape($product_serial);
		$category_id = $this->db->escape($category_id);
		$subcategory_id = $this->db->escape($subcategory_id);
		$product_quantity = $this->db->escape($product_quantity);

		$sql = "INSERT INTO tbl_store_order_details (store_order_id,product_code,product_name,product_calibre,product_serial,category_id,subcategory_id,product_quantity) " .
		"VALUES ({$last_store_order_id}, {$product_code}, {$product_name}, {$product_calibre}, {$product_serial}, {$category_id}, {$subcategory_id}, {$product_quantity})";

		$this->db->query($sql);

		return true;	    	
    }

    public function get_by_store_order_no($no)
    {
        $this->db->select('tbl_store_order.*', false);
        $this->db->from('tbl_store_order');
        $this->db->where('tbl_store_order.store_order_no', $no);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function get_store_order_by_id($store_order_id)
    {
        $this->db->select('tbl_store_order.*', false);
        $this->db->from('tbl_store_order');
        $this->db->where('tbl_store_order.store_order_id', $store_order_id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function get_by_store_order_id($store_order_id)
    {   

        $sql = "SELECT * FROM tbl_store_order_details WHERE store_order_id =".$store_order_id;

        $query_result = $this->db->query($sql);

        $result = $query_result->result_array();

        return $result;

    }

    public function update_status($data,$store_order_id)
    {   

        $sql = "UPDATE tbl_store_order SET store_order_status = '".$data['store_order_status']."' WHERE store_order_id =".$store_order_id;

        $this->db->query($sql);

        return true;

    }

    public function save_invoice($storage_invoice_no,$store_order_id)
    {   
        $store_invoice_no = $storage_invoice_no['invoice_no'];

        $sql = "INSERT INTO tbl_storage_invoice (storage_invoice_no,store_order_id) " .
        "VALUES ({$store_invoice_no}, {$store_order_id})";

        $this->db->query($sql);

        return true;
    }

    public function get_invoice_info($invoice_no)
    {
        $this->db->select('tbl_storage_invoice.*', false);
        $this->db->from('tbl_storage_invoice');
        $this->db->where('tbl_storage_invoice.storage_invoice_no', $invoice_no);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;        
    }
    
    public function get_all_invoice()
    {
        $this->db->select('tbl_storage_invoice.*, tbl_store_order.*', false);
        $this->db->from('tbl_storage_invoice');
        $this->db->join('tbl_store_order', 'tbl_store_order.store_order_id  =  tbl_storage_invoice.store_order_id ', 'left');
        $this->db->order_by('storage_invoice_id', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
}
