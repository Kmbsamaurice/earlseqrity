<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Logistics extends CI_Controller{
        public function __construct(){
            parent::__construct();
            is_logged_in();
            $this->load->model('backend/Logistics_model');
            
        }
        public function index(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $this->load->view('templates/backend/header',$data);
            $this->load->view('templates/backend/sidebar');
            $data['logistics'] = $this->Logistics_model->get_logistics();
            $this ->load->view('backend/logistics/logistics-service-providers',$data);
            $this ->load->view('templates/backend/footer');
        }
    }