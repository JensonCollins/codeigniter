<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Parts_Model extends MY_Model
{
    public $_table_name;
    public $_order_by;
    public $_primary_key;


    public function get_parts_info()
    {
        $this->db->select('tbl_parts.*', false);
        $this->db->from('tbl_parts');
        $this->db->order_by('tbl_parts.id', 'ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    
    public function getRows($params = array()) {
        $this->db->select('tbl_parts.*', false);
        $this->db->from('tbl_parts');

        if (!empty($params['search']['keywords']) && $params['search']['keywords'] != '' && $params['search']['keywords'] != '-') {
             $this->db->where("(PartNo LIKE '%" . $params['search']['keywords'] . "%' OR Description LIKE '%".$params['search']['keywords']."%' OR Price LIKE '%" . $params['search']['keywords'] . "%' "
                        . "OR DrgNo LIKE '%" . $params['search']['keywords'] . "%' OR Material LIKE '%" . $params['search']['keywords'] . "%' OR Treatment LIKE '%" . $params['search']['keywords'] . "%' "
                        . "OR OperationF1 LIKE '%" . $params['search']['keywords'] . "%' OR OperationF2 LIKE '%" . $params['search']['keywords'] . "%' OR OperationF3 LIKE '%" . $params['search']['keywords'] . "%'"
                        . "OR OperationF4 LIKE '%" . $params['search']['keywords'] . "%' OR OperationF5 LIKE '%" . $params['search']['keywords'] . "%' OR OperationF6 LIKE '%" . $params['search']['keywords'] . "%'"
                        . "OR OperationF7 LIKE '%" . $params['search']['keywords'] . "%' OR OperationF8 LIKE '%" . $params['search']['keywords'] . "%' OR OperationF9 LIKE '%" . $params['search']['keywords'] . "%' OR OperationF10 LIKE '%" . $params['search']['keywords'] . "%' OR Issue LIKE '%" . $params['search']['keywords'] . "%' OR Customer LIKE '%" . $params['search']['keywords'] . "%'"
                        . ")");
        }

        if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->order_by('tbl_parts.id', 'ASC');
        $query = $this->db->get();
 //       echo $this->db->last_query();
        return ($query->num_rows() > 0) ? $query->result_array() : FALSE;
    }
}
