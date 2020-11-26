<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Orders extends Admin_Controller
{
    public function __construct()
    {
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

    }

    public function add_order($id = null)
    {
        $this->tbl_orders('order_id');

        if ($id) {
            $data['orders'] = $this->global_model->get_by(array('order_id'=>$id), true);

            $data['order_parts'] = $this->orders_model->get_order_parts_info($data['orders']->order_id);

            if(empty($data['orders'])){
                $type = 'error';
                $message = 'There is no Record Found!';
                set_message($type, $message);
                redirect('admin/orders/manage_order');
            }
        }

        $this->tbl_customer('customer_id');
        $data['customers'] = $this->global_model->get();

        $this->tbl_parts('id');
        $data['parts'] = $this->global_model->get();

        $data['title'] = 'Add Order';
        $data['editor'] = $this->data;
        $data['subview'] = $this->load->view('admin/orders/add_order', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    /*** Save Orders ***/
    public function save_orders($id = null)
    {
        $data = $this->orders_model->array_from_post(array(
            'OrderNo',
            'DateIn',
            'customer_id',
            'DueDeliveryDate'
             ));

        $this->tbl_orders('order_id');

        $order_id = $this->global_model->save($data, $id);

        if(empty($id)) {
            $this->global_model->save($id);
        }

        if(empty($id)) {
			if(empty($this->input->post('sel_parts', true)))
			{
			$parts_array = '';
			}
			else
			{
			$parts_array = $this->input->post('sel_parts', true);
			}

			if(empty($this->input->post('part_qty', true)))
			{
			$part_qty = '';
			}
			else
			{
			$part_qty = $this->input->post('part_qty', true);
			}

			if(empty($this->input->post('mode_payment', true)))
			{
			$mode_payment = '';
			}
			else
			{
			$mode_payment = '';
			}


			if(empty($this->input->post('job_notes', true)))
			{
			$job_notes = '';
			}
			else
			{
			$job_notes = '';
			}

			if(empty($this->input->post('order_price', true)))
			{
			$order_price = '';
			}
			else
			{
			$order_price = $this->input->post('order_price', true);
			}

			foreach($parts_array as $key=>$value){

			$now = date('Y-m-d H:i:s');

			$query = "INSERT into `tbl_order_parts` (part_id, order_id, quantity, Notes, Status, OrderPrice, created) values ('$value', '$order_id','$part_qty[$key]', '$job_notes[$key]', '$mode_payment[$key]', '$order_price[$key]', '$now')";

			$this->global_model->run_custom_query($query);

			}
        }
        else
        {	
        	$order_part_id_array = $this->input->post('order_part_id', true);

			$parts_id = $this->input->post('sel_parts', true);
			$part_qty = $this->input->post('part_qty', true);
			$mode_payment = '';
			$job_notes = '';
			$order_price = $this->input->post('order_price', true);

        	if(!empty($order_part_id_array))
        	{
        		foreach($order_part_id_array as $key=>$value){

        			$now = date('Y-m-d H:i:s');

        			$query = "UPDATE `tbl_order_parts` SET part_id = '$parts_id[$key]', order_id = '$id', quantity = '$part_qty[$key]', Notes = '$job_notes[$key]', Status = '$mode_payment[$key]', OrderPrice = '$order_price[$key]', modified = '$now' where id = '$value'";

        			$this->global_model->run_custom_query($query);
        		}
        	}
        }
        $type = 'success';
        $message = 'Order Saved Successfully!';
        set_message($type, $message);
        redirect('admin/orders/manage_order');
    }

    /*** Manage orders ***/
    public function manage_order($customer_id = null)
    {	

        if(empty($customer_id)) {
        	$data['orders'] = $this->orders_model->get_all_order_info();
        }
        else
        {	
        	$this->tbl_orders('order_id');
        	$data['orders'] = $this->global_model->get_by(array('customer_id'=>$customer_id), false);
        }

      
        $data['title'] = 'Manage Orders';
        $data['subview'] = $this->load->view('admin/orders/manage_order', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    /*** Delete orders ***/
    public function delete_order($id=null)
    {
        $this->orders_model->_table_name = 'tbl_orders';
        $this->orders_model->_primary_key = 'order_id';
        $this->orders_model->delete($id);  // delete by id

        // message for employee
        $type = 'error';
        $message = 'Order Successfully Deleted from System';
        set_message($type, $message);
        redirect('admin/orders/manage_order');
    }

    public function get_customer_name($customer_id)
    {
    	$this->tbl_customer('customer_id');
        $customer = $this->global_model->get($customer_id,true);
		if(!empty($customer->LongName))
		{
			$fullname = $customer->LongName;
		}
		else
		{
			$fullname = '';
		}

		if(!empty($customer->ShortName))
		{
			$fullname = $fullname." (".$customer->ShortName.")";
		}
		else
		{
			$fullname = 'N/A';
		}

        return $fullname;
    }

    public function get_customer_phone($customer_id)
    {
    	$this->tbl_customer('customer_id');
        $customer = $this->global_model->get($customer_id,true);

        if(!empty($customer->phone))
        {
        	return $customer->phone;
        }
        else
        {
        	return 'N/A';
        }
        
    }

    public function get_part_info($part_id)
    {
    	$this->tbl_parts('id');
        $parts = $this->global_model->get($part_id,true);

        return $parts;
    }

	/*** View Order  ***/
	public function view_order($order_id=null){

	    if(empty($order_id)){
	        //redirect manage invoice
	        $this->message->norecord_found('admin/orders/manage_order');
	    }

	    $this->tbl_orders('order_id');

		$data['orders'] = $this->global_model->get_by(array('order_id'=>$order_id), true);

		$data['order_parts'] = $this->orders_model->get_order_parts_info($data['orders']->order_id);

	    if(empty($data['orders'])){
	        $this->message->norecord_found('admin/orders/manage_order');
	    }

	    $data['title'] = 'View Order';
	    $data['subview'] = $this->load->view('admin/orders/view_order', $data, true);
	    $this->load->view('admin/_layout_main', $data);
	}

	public function view_job($order_id=null,$order_part_id=null)
	{
	    if(empty($order_id)){
	        //redirect manage invoice
	        $this->message->norecord_found('admin/orders/manage_order');
	    }

	    $this->tbl_orders('order_id');

		$data['orders'] = $this->global_model->get_by(array('order_id'=>$order_id), true);

	    if(empty($data['orders'])){
	        $this->message->norecord_found('admin/orders/manage_order');
	    }

		$this->tbl_order_parts('id');

		$data['order_parts'] = $this->global_model->get_by(array('id'=>$order_part_id,'order_id'=>$order_id), true);

	    $data['title'] = 'View Job';
	    $data['subview'] = $this->load->view('admin/orders/view_job', $data, true);
	    $this->load->view('admin/_layout_main', $data);		
	}

	public function print_job($order_id=null,$order_part_id=null)
	{
	    if(empty($order_id)){
	        //redirect manage invoice
	        $this->message->norecord_found('admin/orders/manage_order');
	    }

	    $this->tbl_orders('order_id');

		$data['orders'] = $this->global_model->get_by(array('order_id'=>$order_id), true);

	    if(empty($data['orders'])){
	        $this->message->norecord_found('admin/orders/manage_order');
	    }

		$this->tbl_order_parts('id');

		$data['order_parts'] = $this->global_model->get_by(array('id'=>$order_part_id,'order_id'=>$order_id), true);
	    $data['subview'] = $this->load->view('admin/orders/print_job', $data);		
	}

	public function view_all_job($order_id=null)
	{
	    if(empty($order_id)){
	        //redirect manage invoice
	        $this->message->norecord_found('admin/orders/manage_order');
	    }

	    $this->tbl_orders('order_id');

		$data['orders'] = $this->global_model->get_by(array('order_id'=>$order_id), true);

		$this->tbl_order_parts('id');

		$data['order_parts'] = $this->orders_model->get_order_parts_info($data['orders']->order_id);

	    if(empty($data['orders'])){
	        $this->message->norecord_found('admin/orders/manage_order');
	    }

	    $data['title'] = 'View All Jobs';
	    $data['subview'] = $this->load->view('admin/orders/view_all_job', $data, true);
	    $this->load->view('admin/_layout_main', $data);		
	}

	public function print_all_job($order_id=null)
	{
	    if(empty($order_id)){
	        //redirect manage invoice
	        $this->message->norecord_found('admin/orders/manage_order');
	    }

	    $this->tbl_orders('order_id');

		$data['orders'] = $this->global_model->get_by(array('order_id'=>$order_id), true);

		$this->tbl_order_parts('id');

		$data['order_parts'] = $this->orders_model->get_order_parts_info($data['orders']->order_id);

	    if(empty($data['orders'])){
	        $this->message->norecord_found('admin/orders/manage_order');
	    }

	    $data['title'] = 'Print All Jobs';
	    $data['subview'] = $this->load->view('admin/orders/print_all_job', $data);	
	}

	public function view_route($order_id=null,$order_part_id=null)
	{
	    if(empty($order_id)){
	        //redirect manage invoice
	        $this->message->norecord_found('admin/orders/manage_order');
	    }

	    $this->tbl_orders('order_id');

		$data['orders'] = $this->global_model->get_by(array('order_id'=>$order_id), true);

		$this->tbl_order_parts('id');
		$data['order_parts'] = $this->global_model->get_by(array('id'=>$order_part_id,'order_id'=>$order_id), true);

	    if(empty($data['orders'])){
	        $this->message->norecord_found('admin/orders/manage_order');
	    }

	    $data['title'] = 'View Job';
	    $data['subview'] = $this->load->view('admin/orders/view_route', $data, true);
	    $this->load->view('admin/_layout_main', $data);		
	}

	public function print_route($order_id=null,$order_part_id=null)
	{
	    if(empty($order_id)){
	        //redirect manage invoice
	        $this->message->norecord_found('admin/orders/manage_order');
	    }

	    $this->tbl_orders('order_id');

		$data['orders'] = $this->global_model->get_by(array('order_id'=>$order_id), true);

		$this->tbl_order_parts('id');
		$data['order_parts'] = $this->global_model->get_by(array('id'=>$order_part_id,'order_id'=>$order_id), true);

	    if(empty($data['orders'])){
	        $this->message->norecord_found('admin/orders/manage_order');
	    }

	    $data['title'] = 'Print Route';
	    $data['subview'] = $this->load->view('admin/orders/print_route', $data);
	}

	public function view_all_route($order_id=null)
	{
	    if(empty($order_id)){
	        //redirect manage invoice
	        $this->message->norecord_found('admin/orders/manage_order');
	    }

	    $this->tbl_orders('order_id');

		$data['orders'] = $this->global_model->get_by(array('order_id'=>$order_id), true);

		$data['order_parts'] = $this->orders_model->get_order_parts_info($data['orders']->order_id);

	    if(empty($data['orders'])){
	        $this->message->norecord_found('admin/orders/manage_order');
	    }

	    $data['title'] = 'View Job';
	    $data['subview'] = $this->load->view('admin/orders/view_all_route', $data, true);
	    $this->load->view('admin/_layout_main', $data);		
	}

	public function print_all_route($order_id=null)
	{
	    if(empty($order_id)){
	        //redirect manage invoice
	        $this->message->norecord_found('admin/orders/manage_order');
	    }

	    $this->tbl_orders('order_id');

		$data['orders'] = $this->global_model->get_by(array('order_id'=>$order_id), true);

		$data['order_parts'] = $this->orders_model->get_order_parts_info($data['orders']->order_id);

	    if(empty($data['orders'])){
	        $this->message->norecord_found('admin/orders/manage_order');
	    }

	    $data['title'] = 'View Job';
	    $data['subview'] = $this->load->view('admin/orders/print_all_route', $data);		
	}
}
