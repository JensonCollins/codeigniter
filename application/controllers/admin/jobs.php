<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Jobs extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('jobs_model');
        $this->load->model('global_model');
        $this->load->library('pagination');
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

    public function edit_job($order_id = null,$order_part_id = null)
    {

        if ($order_id) {
        	$this->tbl_orders('order_id');
            $data['orders'] = $this->global_model->get_by(array('order_id'=>$order_id), true);

            $this->tbl_order_parts('id');
            $data['order_parts'] = $this->global_model->get_by(array('id'=>$order_part_id), true);

            if(empty($data['orders'])){
                $type = 'error';
                $message = 'There is no Record Found!';
                set_message($type, $message);
                redirect('admin/jobs/manage_job');
            }
        }

        $this->tbl_parts('id');
        $data['parts'] = $this->global_model->get();

        $data['title'] = 'Edit Job';
        $data['editor'] = $this->data;
        $data['subview'] = $this->load->view('admin/jobs/edit_job', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    /*** Save Orders ***/
    public function save_job($id = null)
    {
        $data = $this->jobs_model->array_from_post(array(
            'OrderNo',
            'DateIn',
            'Notes',
            'DueDeliveryDate',
            'Status'
             ));

        $this->tbl_orders('order_id');

        $order_id = $this->global_model->save($data, $id);

        if(empty($id)) {
            $this->global_model->save($id);
        }

    	$order_part_id = $this->input->post('order_part_id', true);

		$parts_id = $this->input->post('sel_parts', true);
		$part_qty = $this->input->post('part_qty', true);
		$mode_payment = $this->input->post('mode_payment', true);
		$job_notes = $this->input->post('job_notes', true);
		$order_price = $this->input->post('order_price', true);

    	if(!empty($order_part_id))
    	{

			$now = date('Y-m-d H:i:s');

			$query = "UPDATE `tbl_order_parts` SET part_id = '$parts_id', quantity = '$part_qty', Notes = '$job_notes', Status = '$mode_payment', OrderPrice = '$order_price', modified = '$now' where id = '$order_part_id' AND order_id = '$id'";

			$this->global_model->run_custom_query($query);
    	}

        $type = 'success';
        $message = 'Order Part Saved Successfully!';
        set_message($type, $message);
        redirect('admin/orders/view_job/'.$id.'/'.$order_part_id);
    }

    /*** Manage orders ***/
    public function manage_job(){
        $data['order_parts'] = $this->jobs_model->getRows(array('limit' => $this->perPage));
        
        $totalRec = $this->jobs_model->record_count();
        $config['target'] = '#itemList';
        $config['base_url'] = base_url() . 'admin/jobs/ajaxPaginationData';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $config['link_func'] = 'searchFilter';
        $this->ajax_pagination->initialize($config);
      	
        $data['title'] = 'Manage Jobs';
        $data['subview'] = $this->load->view('admin/jobs/manage_job', $data, true);
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
        
        $totalRec = count($this->jobs_model->getRows($conditions));
        
        $config['target'] = '#itemList';
        $config['base_url'] = base_url() . 'admin/jobs/ajaxPaginationData';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $config['link_func'] = 'searchFilter';
        $this->ajax_pagination->initialize($config);

        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        $data['order_parts'] = $this->jobs_model->getRows($conditions);
        
        $this->load->view('admin/jobs/manage_job_pagination_table', $data);
    }

    /*** Delete orders ***/
    public function delete_order($id=null)
    {
        $this->jobs_model->_table_name = 'tbl_orders';
        $this->jobs_model->_primary_key = 'order_id';
        $this->jobs_model->delete($id);  // delete by id

        // message for employee
        $type = 'error';
        $message = 'Order Successfully Deleted from System';
        set_message($type, $message);
        redirect('admin/jobs/manage_job');
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

        return $customer->phone;
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
	        $this->message->norecord_found('admin/jobs/manage_job');
	    }

	    $this->tbl_orders('order_id');

		$data['orders'] = $this->global_model->get_by(array('order_id'=>$order_id), true);

		$data['order_parts'] = $this->jobs_model->get_order_parts_info($data['orders']->order_id);

	    if(empty($data['orders'])){
	        $this->message->norecord_found('admin/jobs/manage_job');
	    }

	    $data['title'] = 'View Order';
	    $data['subview'] = $this->load->view('admin/jobs/view_order', $data, true);
	    $this->load->view('admin/_layout_main', $data);
	}

	public function view_job($order_id=null,$order_part_id=null)
	{
	    if(empty($order_id)){
	        //redirect manage invoice
	        $this->message->norecord_found('admin/jobs/manage_job');
	    }

	    $this->tbl_orders('order_id');

		$data['orders'] = $this->global_model->get_by(array('order_id'=>$order_id), true);

	    if(empty($data['orders'])){
	        $this->message->norecord_found('admin/jobs/manage_job');
	    }

		$this->tbl_order_parts('id');

		$data['order_parts'] = $this->global_model->get_by(array('id'=>$order_part_id,'order_id'=>$order_id), true);

	    $data['title'] = 'View Job';
	    $data['subview'] = $this->load->view('admin/jobs/view_job', $data, true);
	    $this->load->view('admin/_layout_main', $data);		
	}

	public function print_job($order_id=null,$order_part_id=null)
	{
	    if(empty($order_id)){
	        //redirect manage invoice
	        $this->message->norecord_found('admin/jobs/manage_job');
	    }

	    $this->tbl_orders('order_id');

		$data['orders'] = $this->global_model->get_by(array('order_id'=>$order_id), true);

	    if(empty($data['orders'])){
	        $this->message->norecord_found('admin/jobs/manage_job');
	    }

		$this->tbl_order_parts('id');

		$data['order_parts'] = $this->global_model->get_by(array('id'=>$order_part_id,'order_id'=>$order_id), true);
	    $data['subview'] = $this->load->view('admin/jobs/print_job', $data);		
	}

	public function view_all_job($order_id=null)
	{
	    if(empty($order_id)){
	        //redirect manage invoice
	        $this->message->norecord_found('admin/jobs/manage_job');
	    }

	    $this->tbl_orders('order_id');

		$data['orders'] = $this->global_model->get_by(array('order_id'=>$order_id), true);

		$this->tbl_order_parts('id');

		$data['order_parts'] = $this->jobs_model->get_order_parts_info($data['orders']->order_id);

	    if(empty($data['orders'])){
	        $this->message->norecord_found('admin/jobs/manage_job');
	    }

	    $data['title'] = 'View All Jobs';
	    $data['subview'] = $this->load->view('admin/jobs/view_all_job', $data, true);
	    $this->load->view('admin/_layout_main', $data);		
	}

	public function print_all_job($order_id=null)
	{
	    if(empty($order_id)){
	        //redirect manage invoice
	        $this->message->norecord_found('admin/jobs/manage_job');
	    }

	    $this->tbl_orders('order_id');

		$data['orders'] = $this->global_model->get_by(array('order_id'=>$order_id), true);

		$this->tbl_order_parts('id');

		$data['order_parts'] = $this->jobs_model->get_order_parts_info($data['orders']->order_id);

	    if(empty($data['orders'])){
	        $this->message->norecord_found('admin/jobs/manage_job');
	    }

	    $data['title'] = 'Print All Jobs';
	    $data['subview'] = $this->load->view('admin/jobs/print_all_job', $data);	
	}

	public function view_route($order_id=null,$order_part_id=null)
	{
	    if(empty($order_id)){
	        //redirect manage invoice
	        $this->message->norecord_found('admin/jobs/manage_job');
	    }

	    $this->tbl_orders('order_id');

		$data['orders'] = $this->global_model->get_by(array('order_id'=>$order_id), true);

		$this->tbl_order_parts('id');
		$data['order_parts'] = $this->global_model->get_by(array('id'=>$order_part_id,'order_id'=>$order_id), true);

	    if(empty($data['orders'])){
	        $this->message->norecord_found('admin/jobs/manage_job');
	    }

	    $data['title'] = 'View Job';
	    $data['subview'] = $this->load->view('admin/jobs/view_route', $data, true);
	    $this->load->view('admin/_layout_main', $data);		
	}

	public function print_route($order_id=null,$order_part_id=null)
	{
	    if(empty($order_id)){
	        //redirect manage invoice
	        $this->message->norecord_found('admin/jobs/manage_job');
	    }

	    $this->tbl_orders('order_id');

		$data['orders'] = $this->global_model->get_by(array('order_id'=>$order_id), true);

		$this->tbl_order_parts('id');
		$data['order_parts'] = $this->global_model->get_by(array('id'=>$order_part_id,'order_id'=>$order_id), true);

	    if(empty($data['orders'])){
	        $this->message->norecord_found('admin/jobs/manage_job');
	    }

	    $data['title'] = 'Print Route';
	    $data['subview'] = $this->load->view('admin/jobs/print_route', $data);
	}

	public function view_all_route($order_id=null)
	{
	    if(empty($order_id)){
	        //redirect manage invoice
	        $this->message->norecord_found('admin/jobs/manage_job');
	    }

	    $this->tbl_orders('order_id');

		$data['orders'] = $this->global_model->get_by(array('order_id'=>$order_id), true);

		$data['order_parts'] = $this->jobs_model->get_order_parts_info($data['orders']->order_id);

	    if(empty($data['orders'])){
	        $this->message->norecord_found('admin/jobs/manage_job');
	    }

	    $data['title'] = 'View Job';
	    $data['subview'] = $this->load->view('admin/jobs/view_all_route', $data, true);
	    $this->load->view('admin/_layout_main', $data);		
	}

	public function print_all_route($order_id=null)
	{
	    if(empty($order_id)){
	        //redirect manage invoice
	        $this->message->norecord_found('admin/jobs/manage_job');
	    }

	    $this->tbl_orders('order_id');

		$data['orders'] = $this->global_model->get_by(array('order_id'=>$order_id), true);

		$data['order_parts'] = $this->jobs_model->get_order_parts_info($data['orders']->order_id);

	    if(empty($data['orders'])){
	        $this->message->norecord_found('admin/jobs/manage_job');
	    }

	    $data['title'] = 'View Job';
	    $data['subview'] = $this->load->view('admin/jobs/print_all_route', $data);		
	}
        
        
//    public function manage_job($id=1){	
//
//		$per_page_arr = array('10', '25', '50', '100');
//
//		$get_q = $_GET;
//
//		$data['per_page'] = isset($_GET['per_page']) && in_array($_GET['per_page'], $per_page_arr)?$_GET['per_page']:"100";
//
//		// PAGINATION
//		$config = array();
//		//$config['suffix']='?'.$_SERVER['QUERY_STRING'];
//        $config["base_url"] = base_url() . "admin/jobs/manage_job";
//
//        $total_row = $this->jobs_model->record_count();
//
//        $config["first_url"] = base_url()."admin/jobs/manage_job/1";
//        $config["total_rows"] = $total_row;
//        $config["per_page"] = $per_page = $data['per_page'];
//        $config["uri_segment"] = $this->uri->total_segments();
//        $config['use_page_numbers'] = TRUE;
//        $config['num_links'] = 10; //$total_row
//        $config['cur_tag_open'] = '&nbsp;<a class="current">';
//        $config['cur_tag_close'] = '</a>';
//        $config['full_tag_open'] = "<ul class='pagination'>";
//		$config['full_tag_close'] ="</ul>";
//		$config['num_tag_open'] = '<li>';
//		$config['num_tag_close'] = '</li>';
//		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
//		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
//		$config['next_tag_open'] = "<li>";
//		$config['next_tagl_close'] = "</li>";
//		$config['prev_tag_open'] = "<li>";
//		$config['prev_tagl_close'] = "</li>";
//		$config['first_link'] = 'First';
//		$config['first_tag_open'] = "<li>";
//		$config['first_tagl_close'] = "</li>";
//		$config['last_link'] = 'Last';
//		$config['last_tag_open'] = "<li>";
//		$config['last_tagl_close'] = "</li>";
//        $this->pagination->initialize($config);
//        //echo $this->uri->segment(5);die;
//        if($this->uri->segment(3)){
//        	$cur_page = $id;
//        	$pagi = array("cur_page"=>($cur_page-1)*$per_page, "per_page"=>$per_page);
//        }
//        else{
//        	$pagi = array("cur_page"=>0, "per_page"=>$per_page);
//        }
//
//        $data["order_parts"] = $result = $this->jobs_model->fetch_data($pagi);
//
//        $str_links = $this->pagination->create_links();
//
//        $data["links"] = $str_links;
//      	
//        $data['title'] = 'Manage Jobs';
//        $data['subview'] = $this->load->view('admin/jobs/manage_job', $data, true);
//        $this->load->view('admin/_layout_main', $data);
//    }
}
