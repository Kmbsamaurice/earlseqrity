<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Subcategory extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('backend/Subcategory_model');
            $this->load->model('backend/Category_model');
            is_logged_in();
        }
        public function index(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $this->load->view('templates/backend/header',$data);
            $this->load->view('templates/backend/sidebar');
            $data['subinfo'] = $this->Subcategory_model->get_subcategories();
            $data['catinfo'] = $this->Category_model->categoriesList();
            $this ->load->view('backend/subcategories/subcategories',$data);
            $this ->load->view('templates/backend/footer');
        }
        public function add(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $this->form_validation->set_rules('subcategory','subcategory','required|trim|callback_subcategory_check|is_unique[subcategories.subcategory]',[
                'is_unique' =>'This subcategory already exists.',
            ]);
            $this->form_validation->set_rules('category','category','trim|required',[
                'required' =>'choose a category.',
            ]);
            if($this->form_validation->run() ==FALSE):
                $this->load->view('templates/backend/header',$data);
                $this->load->view('templates/backend/sidebar');
                $data['catinfo'] = $this->Category_model->get_categories();
                $data['cat'] = $this->Subcategory_model->subcategoriesList();
                $this ->load->view('backend/subcategories/add-subcategory',$data);
                $this ->load->view('templates/backend/footer');
            else:
                $subcategory=$this->input->post('subcategory');
                $slug = $this->generate_slug($this->input->post('subcategory'));

                $this->Subcategory_model->save($slug);
                $this->session->set_flashdata('message','<div class="alert alert-success role="alert">
                The subcategory has been saved successfully.</div>');
                return redirect('admin/subcategories');
            endif;
        }
        public function edit($slug){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();
            $data['subcategory'] = $this->Subcategory_model->get_subcategories($slug);
            if(empty($data['subcategory'])):
                return redirect('admin/404');
            endif;

            $this->form_validation->set_rules('subcategory','subcategory','required|trim|callback_subcategory_check');
            $this->form_validation->set_rules('catid','category','trim|required',[
                'required' =>'choose a category.',
            ]);
         
        if($this->form_validation->run() == false):
            $this->load->view('templates/backend/header',$data);
            $this->load->view('templates/backend/sidebar');
            
            $data['catinfo'] = $this->Subcategory_model->list($slug);
            $data['sub'] = $this->Category_model->get_categories();
            $this ->load->view('backend/subcategories/edit-subcategory',$data);
            $this ->load->view('templates/backend/footer');
        else:
            $subid=$this->input->post('subid');    
            $catid=$this->input->post('catid');
            $subcategory=$this->input->post('subcategory');
            $slug = $this->generate_slug($this->input->post('subcategory'));   
            
            $this->db->set('subcategory',$subcategory);
            $this->db->set('catid',$catid);
            $this->db->set('slug',$slug);
            $this->db->where('subid',$subid);

            $this->db->update('subcategories');
             $mdata=array();
            $mdata['message'] ="The subcategory has been updated.";

            $this->session->set_userdata($mdata);
            $subid =$this->input->post('subid');
            $this->session->set_flashdata('message','<div class="alert alert-success role="alert">
                The subcategory has been updated successfully.</div>');
            redirect(base_url('admin/subcategories'));

        endif;
        }
        public function delete($subid){
            $data = $this->Subcategory_model->getsubcategory($subid);
           
             if($this->Subcategory_model->deletesubcategory($subid)):
                $this->session->set_flashdata('message','<div class="alert alert-success role="alert">
                The subcategory has been deleted successfully.</div>');
                redirect(base_url('admin/subcategories'));
             endif;
        }
        public function generate_slug($slug, $separator = '-'){
            $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
            $special_cases = array( '&' => 'and', "'" => '');
            $slug = mb_strtolower( trim( $slug ), 'UTF-8' );
            $slug = str_replace( array_keys($special_cases), array_values( $special_cases), $slug );
            $slug = preg_replace( $accents_regex, '$1', htmlentities( $slug, ENT_QUOTES, 'UTF-8' ) );
            $slug = preg_replace("/[^a-z0-9]/u", "$separator", $slug);
            $slug = preg_replace("/[$separator]+/u", "$separator", $slug);
            return $slug;
        }
        public function subcategory_check($str){
            if (!preg_match('/^[a-zA-Z0-9&-. ]*$/',$str)){
                $this->form_validation->set_message('subcategory_check', 'This subcategory is invalid.');
            return FALSE;    
                }else{
            return TRUE;    
            }
        }
    }