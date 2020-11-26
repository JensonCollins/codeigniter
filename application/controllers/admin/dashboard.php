<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Dashboard extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dashboard_model');
        $this->load->model('global_model');

    }

    /*** Dashboard ***/
    public function index()
    {

        //total order
        $this->tbl_orders('order_id');
        $data['total_order'] = count($this->global_model->get());

        //total Parts
        $this->tbl_customer('customer_id');
        $data['total_customer'] = count($this->global_model->get());

        //total Parts
        $this->tbl_parts('id');
        $data['total_parts'] = count($this->global_model->get());


        $data['year'] = date('Y');

        $data['title'] = 'Welcome to Bedford Engineering Admin Panel'; // title
        $data['subview'] = $this->load->view('admin/dashboard', $data, true); // sub view
        $this->load->view('admin/_layout_main', $data); // main page
    }

    /*** Login ***/
    public function login()
    {
        $data['title'] = 'Login';
        $this->load->view('admin/login');
    }


}
