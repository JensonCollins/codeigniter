<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Jobs_model extends MY_Model
{
    public $_table_name;
    public $_order_by;
    public $_primary_key;


    public function get_order_parts_info($order_id)
    {
        $this->db->select('tbl_order_parts.*');
        $this->db->from('tbl_order_parts');
        $this->db->join('tbl_orders', 'tbl_orders.order_id  =  tbl_order_parts.order_id ', 'left');
        $this->db->where('tbl_order_parts.order_id', $order_id);
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
    
    public function getRows($params = array()) {

//        $this->db->select('tbl_orders.*,tbl_customer.*', false);
        $this->db->select('tbl_orders.*,tbl_customer.*,tbl_orders.order_id AS order_id, tbl_order_parts.id AS job_no, tbl_orders.customer_id AS customer,tbl_customer.LongName as customer_name, tbl_parts.PartNo AS part_no, tbl_orders.Status AS STATUS', false);
        $this->db->from('tbl_order_parts');
        $this->db->join('tbl_orders', 'tbl_orders.order_id  =  tbl_order_parts.order_id ', 'left');
        $this->db->join('tbl_customer', 'tbl_customer.customer_id  =  tbl_orders.customer_id ', 'left');
        $this->db->join('tbl_parts', 'tbl_parts.id  =  tbl_order_parts.part_id ', 'left');
//        if (!empty($params['customer_id']) && $params['customer_id'] != NULL) {
//            $this->db->where('tbl_orders.customer_id',$params['customer_id']);
//            
//            if (!empty($params['search']['keywords']) && $params['search']['keywords'] != '' && $params['search']['keywords'] != '-') {
//                 $this->db->where("(OrderNo LIKE '%" . $params['search']['keywords'] . "%' OR DateIn LIKE '%".$params['search']['keywords']."%' OR DueDeliveryDate LIKE '%" . $params['search']['keywords'] . "%' "
//                            . "OR Status LIKE '%" . $params['search']['keywords'] . "%' OR tbl_customer.ShortName LIKE '%" . $params['search']['keywords'] . "%' OR tbl_customer.LongName LIKE '%" . $params['search']['keywords'] . "%' "
//                            . ")");
//            }
//        }else{
            if (!empty($params['search']['keywords']) && $params['search']['keywords'] != '' && $params['search']['keywords'] != NULL) {
                 $this->db->where("(tbl_order_parts.id LIKE '%" . $params['search']['keywords'] . "%' OR tbl_parts.PartNo LIKE '%".$params['search']['keywords'] . "%' "
                            . "OR tbl_orders.Status LIKE '%" . $params['search']['keywords'] . "%' OR tbl_customer.ShortName LIKE '%" . $params['search']['keywords'] . "%' OR tbl_customer.LongName LIKE '%" . $params['search']['keywords'] . "%' "
                            . ")");
            }
//        }

        if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->order_by('tbl_order_parts.id', 'ASC');
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result_array() : FALSE;
    }

    public function record_count() {

            $query = "SELECT tbl_order_parts.id AS job_no, tbl_orders.customer_id AS customer, tbl_parts.PartNo AS part_no, tbl_orders.Status AS STATUS FROM `tbl_order_parts` LEFT JOIN tbl_orders ON tbl_orders.order_id = tbl_order_parts.order_id LEFT JOIN tbl_parts ON tbl_parts.id = tbl_order_parts.part_id";

            if ($this->db->query($query)->num_rows() > 0) {
                    return $this->db->query($query)->num_rows();
            }
            else
            {
                    return 0;
            }
    }


    public function fetch_data($pagination=array()) {

            $query = "SELECT tbl_orders.order_id AS order_id, tbl_order_parts.id AS job_no, tbl_orders.customer_id AS customer, tbl_parts.PartNo AS part_no, tbl_orders.Status AS STATUS FROM `tbl_order_parts` LEFT JOIN tbl_orders ON tbl_orders.order_id = tbl_order_parts.order_id LEFT JOIN tbl_parts ON tbl_parts.id = tbl_order_parts.part_id  ORDER BY tbl_order_parts.id DESC"." limit ".$pagination['cur_page'].",".$pagination['per_page'];


            $query_result = $this->db->query($query);

            return $query_result->result();
    }

}
