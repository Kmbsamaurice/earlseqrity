<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Engineer extends CI_Controller{
        public function __construct(){
            parent::__construct();
            is_logged_in();
            $this->load->model('backend/Engineer_model');
            
        }
        public function index(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $this->load->view('templates/backend/header',$data);
            $this->load->view('templates/backend/sidebar');
            $data['engineer'] = $this->Engineer_model->get_engineers();
            $this ->load->view('backend/engineers/engineers',$data);
            $this ->load->view('templates/backend/footer');
        }
    }