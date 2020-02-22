<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Message extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->helper('text');
            $this->load->model('backend/Message_model');
            is_logged_in();
        }
        public function index(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $this->load->view('templates/backend/header',$data);
            $this->load->view('templates/backend/sidebar');
            $data['message'] = $this->Message_model->messageList();
            $this ->load->view('backend/messages/messages',$data);
            $this ->load->view('templates/backend/footer');
        }
        public function delete($id){
            $data = $this->Message_model->getmessage($id);
           
             if($this->Message_model->deletemessage($id)):
                $this->session->set_flashdata('message','<div class="alert alert-success role="alert">
                The details have been deleted successfully.</div>');
                redirect(base_url('admin/messages'));
             endif;
        }
    }