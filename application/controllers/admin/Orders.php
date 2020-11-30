<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Orders extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('orders_model');
        $this->load->model('global_model');

        $this->load->helper('ckeditor');
        $this->data['ckeditor'] = array(
            'id' => 'ck_editor',
            'path' => 'asset/js/ckeditor',
            'config' => array(
                'toolbar' => 'Full',
                'width' => '100%',
                'height' => '150px',
            ),
        );
        $this->perPage = 15;
        $this->load->library('Ajax_pagination');
    }

    public function add_order($id = null) {
        $this->tbl_orders('order_id');

        if ($id) {
            $data['orders'] = $this->global_model->get_by(array('order_id' => $id), true);

            $data['order_parts'] = $this->orders_model->get_order_parts_info($data['orders']->order_id);

            if (empty($data['orders'])) {
                $type = 'error';
                $message = 'There is no Record Found!';
                set_message($type, $message);
                redirect('admin/orders/manage_order');
            }
        }

        $data['customers'] = $this->orders_model->get_all_customers();

        $this->tbl_parts('id');
        $data['parts'] = $this->global_model->get();

        $data['title'] = 'Add Order';
        $data['editor'] = $this->data;
        $data['subview'] = $this->load->view('admin/orders/add_order', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    /*     * * Save Orders ** */

    public function save_orders($id = null) {
        $data = $this->orders_model->array_from_post(array(
            'OrderNo',
            'DateIn',
            'customer_id',
            'DueDeliveryDate'
        ));

        $this->tbl_orders('order_id');

        $order_id = $this->global_model->save($data, $id);

        if (empty($id)) {
            $this->global_model->save($data, $id);
        }

        if (empty($id)) {
        	$sel_parts = $this->input->post('sel_parts', true);
            if (empty($sel_parts)) {
                $parts_array = '';
            } else {
                $parts_array = $this->input->post('sel_parts', true);
            }

            $input_part_qty = $this->input->post('part_qty', true);
            if (empty($input_part_qty)) {
                $part_qty = '';
            } else {
                $part_qty = $this->input->post('part_qty', true);
            }

            $input_mode_payment = $this->input->post('mode_payment', true);
            if (empty($input_mode_payment)) {
                $mode_payment = '';
            } else {
                $mode_payment = '';
            }

			$input_job_notes = $this->input->post('job_notes', true);
            if (empty($input_job_notes)) {
                $job_notes = '';
            } else {
                $job_notes = '';
            }

			$input_order_price = $this->input->post('order_price', true);
			if (empty($input_order_price)) {
                $order_price = '';
            } else {
                $order_price = $this->input->post('order_price', true);
            }

			$input_map_supplier = $this->input->post('mat_supplier', true);
            if (empty($input_map_supplier)) {
                $mat_supplier = '';
            } else {
                $mat_supplier = $this->input->post('mat_supplier', true);
            }

            $input_mat_cost = $this->input->post('mat_cost', true);
            if (empty($input_mat_cost)) {
                $mat_cost = '';
            } else {
                $mat_cost = $this->input->post('mat_cost', true);
            }
            foreach ($parts_array as $key => $value) {

                $now = date('Y-m-d H:i:s');
                $value = isset($value) ? $value : '';
                $pq = isset($part_qty[$key]) ? $part_qty[$key] : '';
                $order_id = isset($order_id) ? $order_id : '';
                $jn = isset($job_notes[$key]) ? $job_notes[$key] : '';
                $mp = isset($mode_payment[$key]) ? $mode_payment[$key] : '';
                $opr = isset($order_price[$key]) ? $order_price[$key] : '';
                $ms = isset($mat_supplier[$key]) ? $mat_supplier[$key] : '';
                $mc = isset($mat_cost[$key]) ? $mat_cost[$key] : '';
                $query = "INSERT into `tbl_order_parts` (part_id, order_id, quantity, Notes, Status, OrderPrice, created, mat_supplier, mat_cost) values ('$value', '$order_id','$pq', '$jn', '$mp', '$opr', '$now', '$ms', '$mc')";
                //echo $query;die();
                $this->db->query($query);
//echo "LLLLLLLLLL";die();
            }
        } else {
            $order_part_id_array = $this->input->post('order_part_id', true);

            $parts_id = $this->input->post('sel_parts', true);
            $part_qty = $this->input->post('part_qty', true);
//            $mode_payment = '';
//            $job_notes = '';
            $order_price = $this->input->post('order_price', true);
            $mat_supplier = $this->input->post('mat_supplier', true);
            $mat_cost = $this->input->post('mat_cost', true);

            if (!empty($order_part_id_array)) {
                foreach ($order_part_id_array as $key => $value) {
                    if (!isset($job_notes) || empty($job_notes)) {
                        $job_notes[$key] = NULL;
                    } else {
                        $job_notes[$key] = NULL;
                    }
                    if (!isset($job_notes) || empty($mode_payment)) {
                        $mode_payment[$key] = NULL;
                    } else {
                        $mode_payment[$key] = NULL;
                    }
                    $now = date('Y-m-d H:i:s');
                    $query = "UPDATE `tbl_order_parts` SET part_id = '$parts_id[$key]', order_id = '$id', quantity = '$part_qty[$key]', Notes = '$job_notes[$key]', Status = '$mode_payment[$key]', OrderPrice = '$order_price[$key]', mat_supplier = '$mat_supplier[$key]',mat_cost = '$mat_cost[$key]', modified = '$now' where id = '$value'";

                    $this->db->query($query);
                }
            }

            $input_parts_array = $this->input->post('sel_parts2', true);
            if (empty($input_parts_array)) {
                $parts_array = '';
            } else {
                $parts_array = $this->input->post('sel_parts2', true);
            }

            $input_part_qty2 = $this->input->post('part_qty2', true);
            if (empty($input_part_qty2)) {
                $part_qty = '';
            } else {
                $part_qty = $this->input->post('part_qty2', true);
            }

            $input_mode_payment2 = $this->input->post('mode_payment2', true);
            if (empty($input_mode_payment2)) {
                $mode_payment = '';
            } else {
                $mode_payment = '';
            }

			$input_job_notes2 = $this->input->post('job_notes2', true);
            if (empty($input_job_notes2)) {
                $job_notes = '';
            } else {
                $job_notes = '';
            }

            $input_order_price2 = $this->input->post('order_price2', true);
            if (empty($input_order_price2)) {
                $order_price = '';
            } else {
                $order_price = $this->input->post('order_price2', true);
            }

            $input_mat_supplier2 = $this->input->post('mat_supplier2', true);
            if (empty($input_mat_supplier2)) {
                $mat_supplier = '';
            } else {
                $mat_supplier = $this->input->post('mat_supplier2', true);
            }

            $input_mat_cost2 = $this->input->post('mat_cost2', true);
            if (empty($input_mat_cost2)) {
                $mat_cost = '';
            } else {
                $mat_cost = $this->input->post('mat_cost2', true);
            }
            
            if(!$parts_array==""){
                foreach ($parts_array as $key => $value) {
                    $now = date('Y-m-d H:i:s');
                    $value = isset($value) ? $value : '';
                    $pq = isset($part_qty[$key]) ? $part_qty[$key] : '';
                    $order_id = isset($order_id) ? $order_id : '';
                    $jn = isset($job_notes[$key]) ? $job_notes[$key] : '';
                    $mp = isset($mode_payment[$key]) ? $mode_payment[$key] : '';
                    $opr = isset($order_price[$key]) ? $order_price[$key] : '';
                    $ms = isset($mat_supplier[$key]) ? $mat_supplier[$key] : '';
                    $mc = isset($mat_cost[$key]) ? $mat_cost[$key] : '';
                    $query = "INSERT into `tbl_order_parts` (part_id, order_id, quantity, Notes, Status, OrderPrice, created, mat_supplier, mat_cost) values ('$value', '$order_id','$pq', '$jn', '$mp', '$opr', '$now', '$ms', '$mc')";
                    $this->db->query($query);
    //echo "LLLLLLLLLL";die();
                }
            }

        }
        $type = 'success';
        $message = 'Order Saved Successfully!';
        set_message($type, $message);
        redirect('admin/orders/view_order/' . $order_id);
//        redirect('admin/orders/manage_order');
    }

    /*     * * Manage orders ** */

    public function manage_order($customer_id = null) {
        
        $data['orders'] = $this->orders_model->getRows(array('limit' => $this->perPage,'customer_id'=>$customer_id));
        
        $totalRec = count($this->orders_model->get_all_order_info());
        $config['target'] = '#itemList';
        $config['base_url'] = base_url() . 'admin/orders/ajaxPaginationData';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $config['link_func'] = 'searchFilter';
        $this->ajax_pagination->initialize($config);


        $data['title'] = 'Manage Orders';
        $data['subview'] = $this->load->view('admin/orders/manage_order', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
    function ajaxPaginationData() {
        $conditions = array();
        $page = $this->input->post('page');
        if (!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }

        $conditions['search']['keywords'] = $this->input->post('keywords');
        
        $totalRec = count($this->orders_model->getRows($conditions));
        
        $config['target'] = '#itemList';
        $config['base_url'] = base_url() . 'admin/orders/ajaxPaginationData';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $config['link_func'] = 'searchFilter';
        $this->ajax_pagination->initialize($config);

        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        $data['orders'] = $this->orders_model->getRows($conditions);
        
        $this->load->view('admin/orders/manage_order_pagination_table', $data);
    }

    /*     * * Delete orders ** */

    public function delete_order($id = null) {
        $this->orders_model->_table_name = 'tbl_orders';
        $this->orders_model->_primary_key = 'order_id';
        $this->orders_model->delete($id);  // delete by id
        // message for employee
        $type = 'error';
        $message = 'Order Successfully Deleted from System';
        set_message($type, $message);
        redirect('admin/orders/manage_order');
    }

    public function get_customer_name($customer_id) {
        $this->tbl_customer('customer_id');
        $customer = $this->global_model->get($customer_id, true);
        if (!empty($customer->LongName)) {
            $fullname = $customer->LongName;
        } else {
            $fullname = '';
        }

        if (!empty($customer->ShortName)) {
            $fullname = $fullname . " (" . $customer->ShortName . ")";
        } else {
            $fullname = 'N/A';
        }

        return $fullname;
    }
    
    public function get_customer_short_name($customer_id) {
        $this->tbl_customer('customer_id');
        $customer = $this->global_model->get($customer_id, true);
        if (!empty($customer->ShortName)) {
            $shortname = $customer->ShortName;
        } else {
            $shortname = 'N/A';
        }

        return $shortname;
    }

    public function get_customer_phone($customer_id) {
        $this->tbl_customer('customer_id');
        $customer = $this->global_model->get($customer_id, true);

        if (!empty($customer->phone)) {
            return $customer->phone;
        } else {
            return 'N/A';
        }
    }

    public function get_part_info($part_id) {
        $this->tbl_parts('id');
        $parts = $this->global_model->get($part_id, true);

        return $parts;
    }

    /*     * * View Order  ** */

    public function view_order($order_id = null) {

        if (empty($order_id)) {
            //redirect manage invoice
            $this->message->norecord_found('admin/orders/manage_order');
        }

        $this->tbl_orders('order_id');

        $data['orders'] = $this->global_model->get_by(array('order_id' => $order_id), true);

        $data['order_parts'] = $this->orders_model->get_order_parts_info($data['orders']->order_id);

        if (empty($data['orders'])) {
            $this->message->norecord_found('admin/orders/manage_order');
        }

        $data['title'] = 'View Order';
        $data['subview'] = $this->load->view('admin/orders/view_order', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    public function print_order($order_id = null) {

        if (empty($order_id)) {
            //redirect manage invoice
            $this->message->norecord_found('admin/orders/manage_order');
        }

        $this->tbl_orders('order_id');

        $data['orders'] = $this->global_model->get_by(array('order_id' => $order_id), true);

        $data['order_parts'] = $this->orders_model->get_order_parts_info($data['orders']->order_id);

        if (empty($data['orders'])) {
            $this->message->norecord_found('admin/orders/manage_order');
        }

        $data['title'] = 'Print Order';
        $data['subview'] = $this->load->view('admin/orders/print_order', $data);
//        $data['subview'] = $this->load->view('admin/orders/print_order', $data, true);
    }

    public function view_job($order_id = null, $order_part_id = null) {
        if (empty($order_id)) {
            //redirect manage invoice
            $this->message->norecord_found('admin/orders/manage_order');
        }

        $this->tbl_orders('order_id');

        $data['order_id'] = $order_id;
        $data['order_part_id'] = $order_part_id;
        $data['orders'] = $this->global_model->get_by(array('order_id' => $order_id), true);

        if (empty($data['orders'])) {
            $this->message->norecord_found('admin/orders/manage_order');
        }

        $this->tbl_order_parts('id');

        $data['order_parts'] = $this->global_model->get_by(array('id' => $order_part_id, 'order_id' => $order_id), true);

        $data['title'] = 'View Job';
        $data['subview'] = $this->load->view('admin/orders/view_job', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    public function print_job($order_id = null, $order_part_id = null) {
        if (empty($order_id)) {
            //redirect manage invoice
            $this->message->norecord_found('admin/orders/manage_order');
        }

        $this->tbl_orders('order_id');

        $data['orders'] = $this->global_model->get_by(array('order_id' => $order_id), true);

        if (empty($data['orders'])) {
            $this->message->norecord_found('admin/orders/manage_order');
        }

        $this->tbl_order_parts('id');

        $data['order_parts'] = $this->global_model->get_by(array('id' => $order_part_id, 'order_id' => $order_id), true);
        $data['subview'] = $this->load->view('admin/orders/print_job', $data);
    }

    public function view_all_job($order_id = null) {
        if (empty($order_id)) {
            //redirect manage invoice
            $this->message->norecord_found('admin/orders/manage_order');
        }

        $this->tbl_orders('order_id');

        $data['orders'] = $this->global_model->get_by(array('order_id' => $order_id), true);

        $this->tbl_order_parts('id');

        $data['order_parts'] = $this->orders_model->get_order_parts_info($data['orders']->order_id);

        if (empty($data['orders'])) {
            $this->message->norecord_found('admin/orders/manage_order');
        }

        $data['title'] = 'View All Jobs';
        $data['subview'] = $this->load->view('admin/orders/view_all_job', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    public function print_all_job($order_id = null) {
        if (empty($order_id)) {
            //redirect manage invoice
            $this->message->norecord_found('admin/orders/manage_order');
        }

        $this->tbl_orders('order_id');

        $data['orders'] = $this->global_model->get_by(array('order_id' => $order_id), true);

        $this->tbl_order_parts('id');

        $data['order_parts'] = $this->orders_model->get_order_parts_info($data['orders']->order_id);

        if (empty($data['orders'])) {
            $this->message->norecord_found('admin/orders/manage_order');
        }

        $data['title'] = 'Print All Jobs';
        $data['subview'] = $this->load->view('admin/orders/print_all_job', $data);
    }

    public function view_route($order_id = null, $order_part_id = null) {
        if (empty($order_id)) {
            //redirect manage invoice
            $this->message->norecord_found('admin/orders/manage_order');
        }

        $this->tbl_orders('order_id');

        $data['order_id'] = $order_id;
        $data['order_part_id'] = $order_part_id;
        $data['orders'] = $this->global_model->get_by(array('order_id' => $order_id), true);

        $this->tbl_order_parts('id');
        $data['order_parts'] = $this->global_model->get_by(array('id' => $order_part_id, 'order_id' => $order_id), true);

        if (empty($data['orders'])) {
            $this->message->norecord_found('admin/orders/manage_order');
        }

        $data['title'] = 'View Job';
        $data['subview'] = $this->load->view('admin/orders/view_route', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    public function print_route($order_id = null, $order_part_id = null) {
        if (empty($order_id)) {
            //redirect manage invoice
            $this->message->norecord_found('admin/orders/manage_order');
        }

        $this->tbl_orders('order_id');

        $data['orders'] = $this->global_model->get_by(array('order_id' => $order_id), true);

        $this->tbl_order_parts('id');
        $data['order_parts'] = $this->global_model->get_by(array('id' => $order_part_id, 'order_id' => $order_id), true);

        if (empty($data['orders'])) {
            $this->message->norecord_found('admin/orders/manage_order');
        }

        $data['title'] = 'Print Route';
        $data['subview'] = $this->load->view('admin/orders/print_route', $data);
    }

	public function view_t_card($order_id = null, $order_part_id = null) {
		if (empty($order_id)) {
			//redirect manage invoice
			$this->message->norecord_found('admin/orders/manage_order');
		}

		$this->tbl_orders('order_id');

		$data['orders'] = $this->global_model->get_by(array('order_id' => $order_id), true);

		$this->tbl_order_parts('id');
		$data['order_parts'] = $this->global_model->get_by(array('id' => $order_part_id, 'order_id' => $order_id), true);

		if (empty($data['orders'])) {
			$this->message->norecord_found('admin/orders/manage_order');
		}

		$data['title'] = 'Print Route';
		$data['subview'] = $this->load->view('admin/orders/print_route', $data);
	}

	public function print_t_card($order_id = null, $order_part_id = null) {
		if (empty($order_id)) {
			//redirect manage invoice
			$this->message->norecord_found('admin/orders/manage_order');
		}

		$this->tbl_orders('order_id');

		$data['orders'] = $this->global_model->get_by(array('order_id' => $order_id), true);

		$this->tbl_order_parts('id');
		$data['order_parts'] = $this->global_model->get_by(array('id' => $order_part_id, 'order_id' => $order_id), true);

		if (empty($data['orders'])) {
			$this->message->norecord_found('admin/orders/manage_order');
		}

		$data['title'] = 'Print Route';
		$data['subview'] = $this->load->view('admin/orders/print_route', $data);
	}

    public function view_all_route($order_id = null) {
        if (empty($order_id)) {
            //redirect manage invoice
            $this->message->norecord_found('admin/orders/manage_order');
        }

        $this->tbl_orders('order_id');

        $data['orders'] = $this->global_model->get_by(array('order_id' => $order_id), true);

        $data['order_parts'] = $this->orders_model->get_order_parts_info($data['orders']->order_id);

        if (empty($data['orders'])) {
            $this->message->norecord_found('admin/orders/manage_order');
        }

        $data['title'] = 'View Job';
        $data['subview'] = $this->load->view('admin/orders/view_all_route', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    public function print_all_route($order_id = null) {
        if (empty($order_id)) {
            //redirect manage invoice
            $this->message->norecord_found('admin/orders/manage_order');
        }

        $this->tbl_orders('order_id');

        $data['orders'] = $this->global_model->get_by(array('order_id' => $order_id), true);

        $data['order_parts'] = $this->orders_model->get_order_parts_info($data['orders']->order_id);

        if (empty($data['orders'])) {
            $this->message->norecord_found('admin/orders/manage_order');
        }

        $data['title'] = 'View Job';
        $data['subview'] = $this->load->view('admin/orders/print_all_route', $data);
    }

}
