<?php
    class Pages extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->helper('text');
            $this->load->model('backend/Category_model');
            $this->load->model('backend/Product_model');
            $this->load->model('backend/Order_model');
        }
        public function view($page = 'index'){
            if(!file_exists(APPPATH.'views/frontend/pages/'.$page.'.php')){
                redirect(base_url('404'));
            }
            $data['title'] = ucfirst($page);
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();
            
            $data['category'] = $this->Category_model->getcategories();
            
            $data['catinfo'] =$this->Category_model->category();
            $data['product'] = $this->Product_model->products_List();
            $data['cctv'] = $this->Product_model->cctv_List();
            $data['biometrics'] = $this->Product_model->biometrics();
            $data['alarms'] = $this->Product_model->alarms();
            $data['fire'] = $this->Product_model->fire();
            $data['telephone'] = $this->Product_model->telephone();
            $data['ordered']['order_id'] = $this->Order_model->ordered();
            $this ->load->view('templates/frontend/header',$data);
            $this ->load->view('frontend/pages/'.$page,$data);
            $this ->load->view('templates/frontend/footer');
        }
    } 