<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Subscription extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('backend/Subscription_model');
            is_logged_in();
        }
        public function index(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $this->load->view('templates/backend/header',$data);
            $this->load->view('templates/backend/sidebar');
            $data['subinfo'] = $this->Subscription_model->subscriptionList();
            $this ->load->view('backend/subscriptions/subscriptions',$data);
            $this ->load->view('templates/backend/footer');
        }
    }