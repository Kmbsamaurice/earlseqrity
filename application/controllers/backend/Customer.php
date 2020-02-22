<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Customer extends CI_Controller{
        public function __construct(){
            parent::__construct();
            is_logged_in();
            $this->load->model('backend/Customer_model');
            
        }
        public function index(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $this->load->view('templates/backend/header',$data);
            $this->load->view('templates/backend/sidebar');
            $data['customer'] = $this->Customer_model->get_customers();
            $this ->load->view('backend/customers/customers',$data);
            $this ->load->view('templates/backend/footer');
        }
    }