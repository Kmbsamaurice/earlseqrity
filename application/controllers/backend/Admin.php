<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Admin extends CI_Controller{
        public function __construct(){
            parent::__construct();
            is_logged_in();
            $this->load->model('backend/Order_model');
            $this->load->model('backend/Message_model');
            $this->load->model('backend/Subscription_model');
            $this->load->model('backend/Customer_model');
            $this->load->helper('text');
           
        }

        public function index(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();
            $data['orders'] = $this->Order_model->orders();

            $this->load->view('templates/backend/header',$data);
            $this->load->view('templates/backend/sidebar');

            $data['messages'] = $this->Message_model->countmessages();
            $data['customers'] = $this->Customer_model->countcustomers();
            $data['orderscount'] = $this->Order_model->countorders();
            $data['subscriptions'] = $this->Subscription_model->countsubscriptions();

            $this->load->view('backend/index',$data);
            
            $this->load->view('templates/backend/footer');
        }
        public function error404(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $this->load->view('templates/backend/header',$data);
            $this->load->view('templates/backend/sidebar');
            $this->load->view('backend/404',$data);
            
            $this->load->view('templates/backend/footer');
        }
    } 