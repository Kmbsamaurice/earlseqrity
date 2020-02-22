<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Quotation extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->helper('text');
            $this->load->model('backend/Quotation_model');
            is_logged_in();
        }
        public function index(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $this->load->view('templates/backend/header',$data);
            $this->load->view('templates/backend/sidebar');
            $data['quotation'] = $this->Quotation_model->quotationList();
            $this ->load->view('backend/quotations/quotations',$data);
            $this ->load->view('templates/backend/footer');
        }
        public function delete($id){
            $data = $this->Quotation_model->getquotation($id);
           
             if($this->Quotation_model->deletequotation($id)):
                $this->session->set_flashdata('message','<div class="alert alert-success role="alert">
                The quotation details have been deleted successfully.</div>');
                redirect(base_url('admin/quotations'));
             endif;
        }
    }