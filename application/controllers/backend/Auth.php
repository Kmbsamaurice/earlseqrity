<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Auth extends CI_Controller{
        public function __construct(){
            parent::__construct();
            //is_logged_in();
            $this->load->helper('text');
           
        }
        public function login(){
	        $this->form_validation->set_rules('email','Email','required|trim|valid_email');
	        $this->form_validation->set_rules('password','Password','required|trim');

	        if($this->form_validation->run() == false):
	        
	        $this ->load->view('backend/login');
	        else:
	           $this->_login();
	        endif;
        }
         private function _login(){
        $email = $this->input->post('email');
        $password =$this->input->post('password');

        $admins =$this->db->get_where('admins',['email' => $email])->row_array();
        if($admins):
            if($admins['is_active'] == 1):
                if(password_verify($password,$admins['password'])):
                    $data =[
                        'email' => $admins['email'],
                        'role_id' =>$admins['role_id'],
                    ];
                    $this->session->set_userdata($data);
                    redirect('admin/index');
                else:
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Wrong Email Password combination.</div>');
                    redirect('admin/login');
                endif;
            else:
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email Address has not been activated.</div>');
                redirect('admin/login');
            endif;
        else:
            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Wrong Email Password combination.</div>');
            redirect('admin/login');
        endif;
    }
    
    public function logout(){
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message','<div class="alert alert-success role="alert">
        You have been logged out!</div>');
        return redirect('admin/login');
    }
    } 