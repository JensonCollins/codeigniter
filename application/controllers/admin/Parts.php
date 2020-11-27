<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Parts extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('parts_model');
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

    public function add_parts($id = null)
    {
        $this->tbl_parts('id');

        if ($id) {
            $data['parts'] = $this->global_model->get_by(array('id'=>$id), true);
            if(empty($data['parts'])){
                $type = 'error';
                $message = 'There is no Record Found!';
                set_message($type, $message);
                redirect('admin/parts/manage_parts');
            }
        }

        $data['title'] = 'Add Parts';  // title page
        $data['editor'] = $this->data;
        $data['subview'] = $this->load->view('admin/parts/add_parts', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    /*** Save Customer ***/
    public function save_parts($id = null)
    {
        $data = $this->parts_model->array_from_post(array(
            'PartNo',
            'Description',
            'Price',
            'Customer',
            'Material',
            'MatDescription',
            'Treatment',
            'TreatmentCost',
            'OperationF1',
            'OperationF2',
            'OperationF3',
            'OperationF4',
            'OperationF5',
            'OperationF6',
            'OperationF7',
            'OperationF8',
            'OperationF9',
            'OperationF10',
            'Issue',
            'Notes'
             ));

        $this->tbl_parts('id');
        $id = $this->global_model->save($data, $id);

        if(empty($id)) {
            $this->global_model->save($id);
        }

        $type = 'success';
        $message = 'Parts Information Saved Successfully!';
        set_message($type, $message);
        redirect('admin/parts/view_part/'.$id);
    }

    /*** Manage parts ***/
    public function manage_parts()
    {
        $data['title'] = 'Manage Parts';
        
        $data['parts'] = $this->parts_model->getRows(array('limit' => $this->perPage));
        
        $totalRec = count($this->parts_model->get_parts_info());
        $config['target'] = '#itemList';
        $config['base_url'] = base_url() . 'admin/parts/ajaxPaginationData';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $config['link_func'] = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        $data['subview'] = $this->load->view('admin/parts/manage_parts', $data, true);
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
        
        $totalRec = count($this->parts_model->getRows($conditions));
        
        $config['target'] = '#itemList';
        $config['base_url'] = base_url() . 'admin/parts/ajaxPaginationData';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $config['link_func'] = 'searchFilter';
        $this->ajax_pagination->initialize($config);

        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        $data['parts'] = $this->parts_model->getRows($conditions);
        
        $this->load->view('admin/parts/manage_parts_pagination_table', $data);
    }
    
    
    public function delete_part($id=null)
    {
        $this->parts_model->_table_name = 'tbl_parts';
        $this->parts_model->_primary_key = 'id';
        $this->parts_model->delete($id);  // delete by id

        // message for employee
        $type = 'error';
        $message = 'Part Successfully Deleted from System';
        set_message($type, $message);
        redirect('admin/parts/manage_parts');
    }

    public function view_part($part_id = null)
    {
	    if(empty($part_id)){
	        $this->message->norecord_found('admin/parts/manage_parts');
	    }

	    $this->tbl_parts('id');

		$data['parts'] = $this->global_model->get_by(array('id'=>$part_id), true);

	    if(empty($data['parts'])){
	        $this->message->norecord_found('admin/parts/manage_parts');
	    }

	    $data['title'] = 'View Part';
	    $data['subview'] = $this->load->view('admin/parts/view_part', $data, true);
	    $this->load->view('admin/_layout_main', $data);
    }

    public function view_history($part_id = null)
    {
        if(empty($part_id)){
            $this->message->norecord_found('admin/parts/manage_parts');
        }

        $this->tbl_parts('id');

        $data['parts'] = $this->global_model->get_by(array('id'=>$part_id), true);

        if(empty($data['parts'])){
            $this->message->norecord_found('admin/parts/manage_parts');
        }

		$this->tbl_order_parts('id');
		$data['order_parts'] = $this->global_model->get_by(array('part_id'=>$part_id));

        $data['title'] = 'View Part History';
        $data['subview'] = $this->load->view('admin/parts/view_history', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    public function get_order_info($order_id)
    {	
    	$this->tbl_orders('order_id');
		$orders = $this->global_model->get_by(array('order_id'=>$order_id), true);

		return $orders;
	}
}
