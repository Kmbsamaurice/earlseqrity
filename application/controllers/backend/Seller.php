<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Seller extends CI_Controller{
        public function __construct(){
            parent::__construct();
            is_logged_in();
            $this->load->model('backend/Seller_model');
            
        }
        public function index(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $this->load->view('templates/backend/header',$data);
            $this->load->view('templates/backend/sidebar');
            $data['seller'] = $this->Seller_model->get_sellers();
            $this ->load->view('backend/sellers/sellers',$data);
            $this ->load->view('templates/backend/footer');
        }
    }