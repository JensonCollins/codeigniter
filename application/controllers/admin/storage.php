<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 *  @author : Rahul Shakya
 *  @support: rahulshakyaphp@gmail.com
 *  date    : 11 June, 2016
 */

class Storage extends Admin_Controller
{   

    var $_store_contents = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('order_model');
        $this->load->model('storage_model');
        $this->load->model('global_model');
        $this->load->library('pagination');
        $this->load->helper('ckeditor');
        $this->load->helper('url');
        $this->load->library('session');

        $this->data['ckeditor'] = array(
            'id' => 'ck_editor',
            'path' => 'asset/js/ckeditor',
            'config' => array(
                'toolbar' => 'Full',
                'width' => '100%',
                'height' => '250px',
            ),
        );
    }


     /*** Add New or Edit Product ***/
    public function new_storage($id=null)
    {
       
        //************* Retrieve Storage ****************//
        $data['storage'] = $this->storage_model->get_all_storage_info();

        if($id) {
            $this->tbl_storage('storage_id');
            $data['storage_info'] = $this->global_model->get_by(array('storage_id' => $id), true);

            if (!empty($data['storage_info'])) {

                //subcategory
                $this->tbl_subcategory('subcategory_id');
                $data['subcategory'] = $this->global_model->get();
                $data['product_category'] = $this->global_model->get_by(array('subcategory_id' => $data['storage_info']->subcategory_id), true);

            } else {
                // redirect with msg storage not found
                $this->message->norecord_found('admin/storage/manage_storage');
            }
        }

        $data['title'] = 'Add New Storage';

        $data['code'] = rand(10000000, 99999);
        $data['code1'] = rand(100000000, 999999);

        $this->tbl_category('category_id');
        $data['category'] = $this->global_model->get();
        $data['subview'] = $this->load->view('admin/storage/new_new_storage', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    /*** Add New or Update Storage Items ***/
    public function save_storage($id = null)
    {
        $storage_info = $this->storage_model->array_from_post(array(
            'product_code',
            'product_name',
            'product_calibre',
            'product_serial',
            'product_quantity',
            'category_id',
            'subcategory_id',
             ));

        $this->storage_model->_table_name = 'tbl_storage';
        $this->storage_model->_primary_key = 'storage_id';

        $storage_id = $this->storage_model->save($storage_info, $id);

        $type = 'success';
        $message = 'Items has been added Successfully!';
        set_message($type, $message);
        redirect('admin/storage/new_storage');
    }

    public function save_order_storage()
    {   
        //print_r($_POST);die;
        $storage_order_info = $this->storage_model->array_from_post(array(
        'storage_item_ids',
        'start_date',
        'end_date',
        'acquisition',
        'customer_name',
        'storage_number',
        'storage_by',
        'status',
        'storage_days',
        'cost_per_day',
        'total_cost',
         ));

        $storage_item_ids_array = unserialize($storage_order_info['storage_item_ids']);

        //print_r($storage_order_info);die;

        $customer_code = explode('-', $storage_order_info['customer_name']);

        $result_cust = $this->order_model->get_customer_details($customer_code['1']);

        $store_order_no = $storage_order_info['storage_number'];
        $store_start_date = $storage_order_info['start_date'];
        $store_end_date = $storage_order_info['end_date'];
        $acquisition = $storage_order_info['acquisition'];
        $store_by = $storage_order_info['storage_by'];
        $store_order_status = $storage_order_info['status'];
        $storage_days = $storage_order_info['storage_days'];
        $cost_per_day = $storage_order_info['cost_per_day'];
        $total_cost = $storage_order_info['total_cost'];

        $cust_id = $result_cust->customer_id;
        $cust_name = $result_cust->customer_name;
        $fc_no = $result_cust->fc_no;
        $address = $result_cust->address;
        $phone = $result_cust->phone;


        $last_store_order_id = $this->storage_model->save_store_order($store_order_no,$acquisition,$cust_id,$cust_name,$fc_no,$address,$phone,$store_start_date,$store_end_date,$store_by,$store_order_status,$storage_days,$cost_per_day,$total_cost);

        if(is_array($storage_item_ids_array))
        {
            foreach($storage_item_ids_array as $storage_items)
            {   
                //print_r($storage_items);die;
                $this->storage_model->save_store_order_details($last_store_order_id,$storage_items->product_code,$storage_items->product_name,$storage_items->product_calibre,$storage_items->product_serial,$storage_items->category_id,$storage_items->subcategory_id,$storage_items->product_quantity);
            }
        }

        //check storage order status, 1=>In Storage, 2=> Collected
        if($store_order_status == '2')
        {
            $invoice_code = rand(10000000, 99999);
            $storage_invoice_no['invoice_no'] = $invoice_code;
            $this->storage_model->save_invoice($storage_invoice_no,$last_store_order_id );

            redirect('admin/storage/store_order_invoice/'.$storage_invoice_no['invoice_no'] );
        }
        else
        {
            redirect('admin/storage/store_view_order/'.$store_order_no);
        }
        //$type = 'success';
        //$message = 'Storage Details Saved Successfully!';
        //set_message($type, $message);
        //redirect('admin/storage/new_storage');
    }

    /*** Manage Storage order***/
    public function manage_storage()
    {

        $data['storage'] = $this->storage_model->get_all_order_storage_info();
        $data['title'] = 'Manage Storage';
        $data['subview'] = $this->load->view('admin/storage/manage_storage', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    /*** View Storage ***/
    public function view_storage($id)
    {
        $data['storage'] = $this->storage_model->get_storage_information_by_id($id);

        $data['title'] = 'View Storage';
        $data['storage_id'] = $id;
        $data['modal_subview'] = $this->load->view('admin/storage/_modal_view_storage', $data, FALSE);
        $this->load->view('admin/_layout_modal_small', $data);
    }


    /*** View Storage Order  ***/
    public function store_view_order($id=null){
        if(empty($id)){
            //redirect manage invoice
            $this->message->norecord_found('admin/storage/manage_storage');
        }

        //get order
        //$this->tbl_store_order('store_order_id');
        $data['order_info']= $this->storage_model->get_by_store_order_no($id);
        //echo "dd";die;
        //order details
        //$this->tbl_store_order_details('store_order_details_id');
        $data['order_details']= $this->storage_model->get_by_store_order_id($data['order_info']->store_order_id);
        //print_r($data['order_details']); die;
        //print_r($data)

        if(empty($data['order_info'])){
            //redirect manage invoice
            $this->message->norecord_found('admin/storage/manage_storage');
        }

        //get invoice
        $data['order'] = $this->storage_model->get_all_storage_info();
        $data['title'] = 'View Store Order';
        $data['subview'] = $this->load->view('admin/storage/store_view_order', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    /*** Storage Order Reconfirmation  ***/
    public function order_re_confirmation()
    {   

        $data['store_order_status'] = $this->input->post('store_order_status', true);
        $store_order_id = $this->input->post('store_order_id', true);
        $store_order_no = $this->input->post('store_order_no', true);

        if($data['store_order_status'] == 2)
        {   
            $this->storage_model->update_status($data,$store_order_id);
            $invoice_code = rand(10000000, 99999);

            $storage_invoice_no['invoice_no'] = $invoice_code;
            $this->storage_model->save_invoice($storage_invoice_no,$store_order_id );

            redirect('admin/storage/store_order_invoice/'.$storage_invoice_no['invoice_no'] );
        }
        else{
            //redirect
            redirect('admin/storage/manage_storage');
        }

    }

    /*** View Order Invoice ***/
    public function store_order_invoice($id=null)
    {

        if(empty($id)){
            //redirect storage manage invoice
            $this->message->norecord_found('admin/storage/store_manage_invoice');
        }

        $data['invoice_info']= $this->storage_model->get_invoice_info($id);

        if(empty($data['invoice_info'])){
            //redirect storage manage invoice
            $this->message->norecord_found('admin/storage/store_manage_invoice');
        }

        $data['order_info']= $this->storage_model->get_store_order_by_id($data['invoice_info']->store_order_id);

        //storage storage order details
        $data['order_details']= $this->storage_model->get_by_store_order_id($data['invoice_info']->store_order_id);

        $data['title'] = 'Storage Order Invoice';
        $data['subview'] = $this->load->view('admin/storage/store_order_invoice', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }    

   /*** PDF storage Invoice Generate  ***/
    public function store_pdf_invoice($id=null)
    {

        //get storage order id
        $data['invoice_info']= $this->storage_model->get_invoice_info($id);

        if(empty($data['invoice_info'])){
            //redirect manage invoice
            $this->message->norecord_found('admin/storage/store_manage_invoice');
        }

        //storage order information
        $data['order_info']= $this->storage_model->get_store_order_by_id($data['invoice_info']->store_order_id);

        //storage storage order details
        $data['order_details']= $this->storage_model->get_by_store_order_id($data['invoice_info']->store_order_id);

        $data['title'] = 'Order Invoice';

        $html = $this->load->view('admin/storage/store_pdf_order_invoice', $data, true);
        $filename = 'INV-'.$id;
        $this->load->library('pdf');
        $pdf = $this->pdf->load();

        $pdf->WriteHTML($html);
        $pdf->Output($filename, 'D');

    }

    public function store_manage_invoice()
    {
        $data['invoice'] = $this->storage_model->get_all_invoice();
        $data['title'] = 'Manage Storage Invoice';
        $data['subview'] = $this->load->view('admin/storage/store_manage_invoice', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }


    /*** add new Storage ***/
    public function add_storage()
    {

        $data['title'] = 'Add Storage Items';

        $data['code'] = rand(10000000, 99999);
        $data['code1'] = rand(1000000, 9999);

        $this->tbl_category('category_id');
        $data['category'] = $this->global_model->get();

        //$data['storage_id'] = $id;
        $data['modal_subview'] = $this->load->view('admin/storage/_modal_add_storage', $data, FALSE);
        $this->load->view('admin/_layout_modal', $data);
    }

    /*** storage action handel ***/
    public function storage_action()
    {
        // 1 = In Storage
        // 2 = Collected
        // 3 = delete

        $action = $this->input->post('action' , true);
        $storage_id = $this->input->post('storage_id' , true);

        if(!empty($storage_id)) {


            if ($action == 1) {
                //active storage
                $this->active_product($storage_id);

            } elseif ($action == 2) {
                //deactivated storage
                $this->deactive_product($storage_id);
            } else {
                //delete storage
                $this->delete_product($storage_id);
            }
        }else{
            $this->message->custom_error_msg('admin/storage/manage_storage', 'You did not select any Product');
        }
    }

    /***  In Storage ***/
    public function active_product($storage_id)
    {
        foreach($storage_id as $v_product_id){
            $id = $v_product_id;
            $data['status'] = 1;
            $this->tbl_storage('status');

            //update
            $this->storage_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/storage/manage_storage', 'Your Storage In Storage Successfully!');
    }

    /*** Storage Collected***/
    public function deactive_product($storage_id)
    {
        foreach($storage_id as $v_product_id){
            $id = $v_product_id;
            $data['status'] = 2;
            $this->tbl_storage('status');

            //update
            $this->storage_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/storage/manage_storage', 'Your Storage Collected Successfully!');
    }

    /*** Delete Storage***/
    public function delete_product($id){
        if(is_array($id))
        {
            foreach($id as $v_id)
            {
                $this->_delete($v_id);
            }
            $this->message->delete_success('admin/storage/new_storage');

        }else
        {
            if (!empty($id)) {

                $this->tbl_storage('storage_id');
                $product = $this->global_model->get_by(array('storage_id'=>$id),true);
                if(!empty($product)){
                    $this->_delete($id);
                    $this->message->delete_success('admin/storage/new_storage');
                }
                redirect('admin/storage/new_storage');

            } else {
                redirect('admin/storage/new_storage');
            }
        }
    }

    /*** Delete Storage***/
    public function delete_storage($id){
        if(is_array($id))
        {
            foreach($id as $v_id)
            {
                $this->_delete($v_id);
            }
            $this->message->delete_success('admin/storage/new_storage');

        }else
        {
            if (!empty($id)) {

                $this->tbl_storage('storage_id');
                $storage = $this->global_model->get_by(array('storage_id'=>$id),true);
                if(!empty($storage)){
                    $this->_delete($id);
                    $this->message->delete_success('admin/storage/new_storage');
                }
                redirect('admin/storage/new_storage');

            } else {
                redirect('admin/storage/new_storage');
            }
        }
    }

    /*** Delete Function ***/
    public function _delete($id){
        //delete from tbl_product
        $this->tbl_storage('storage_id');
        $this->global_model->delete($id);
    }

    public function get_customers(){

        $returnlist = array();
        parse_str($_SERVER['QUERY_STRING'], $params);
        $term = !empty($params['term']) ? $params['term'] : '';

        $this->load->model('storage_model');
        if (!empty($term)){
          $q = strtolower($term);

          $result = $this->storage_model->get_customer($q);
          if(!empty($result)){
            $returnlist = $result;  
          }
          
        }
        
       $this->output->set_content_type('application/json')->set_output(json_encode($returnlist));
    }
}
