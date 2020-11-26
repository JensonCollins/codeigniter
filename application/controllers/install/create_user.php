<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}


class Create_User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $result = $this->db->select('user_id')->get('tbl_user')->result_array();
        // $installer = mysqli_query('SELECT user_id FROM tbl_user');
        // $item = mysqli_fetch_assoc($installer);

        if(count($result) > 0){
            $this->load->view('install/create_user');
        }else{
            redirect(base_url(), 'refresh');
        }
    }

    public function save_user(){

        $data['name'] = $this->input->post('name');
        $data['user_name'] = $this->input->post('user_name');
        $data['email'] = $this->input->post('email');
        $data['flag'] = 1;
        $data['password'] = $this->hash($this->input->post('password'));

        $this->db->insert('tbl_user', $data);
        unset($_SESSION["install_flag"]);
        redirect(base_url(), 'refresh');

    }
    
    public function hash($string)
    {
        return hash('sha512', $string.config_item('encryption_key'));
    }
}