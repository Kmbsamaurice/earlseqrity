<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Sale extends CI_Controller{
        public function __construct(){
            parent::__construct();
            is_logged_in();
            $this->load->model('backend/Sale_model');
            
        }
        public function index(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $this->load->view('templates/backend/header',$data);
            $this->load->view('templates/backend/sidebar');
            $data['sale'] = $this->Sale_model->get_consultants();
            $this ->load->view('backend/salesconsultants/sales-consultants',$data);
            $this ->load->view('templates/backend/footer');
        }
    }