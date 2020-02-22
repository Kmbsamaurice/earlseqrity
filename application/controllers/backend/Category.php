<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Category extends CI_Controller{
        public function __construct(){
            parent::__construct();
            is_logged_in();
            $this->load->model('backend/Category_model');
            
        }
        public function index(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $this->load->view('templates/backend/header',$data);
            $this->load->view('templates/backend/sidebar');
            $data['catinfo'] = $this->Category_model->get_categories();
            $this ->load->view('backend/categories/categories',$data);
            $this ->load->view('templates/backend/footer');
        }
        public function add(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $this->form_validation->set_rules('category','category','required|trim|callback_category_check|is_unique[categories.category]',[
                'is_unique' =>'This category already exists.',
            ]);
            $this->form_validation->set_rules('tagline','tagline','required|trim|callback_tagline_check');
            if($this->form_validation->run() ==FALSE):
                $this->load->view('templates/backend/header',$data);
                $this->load->view('templates/backend/sidebar');
                $this ->load->view('backend/categories/add-category',$data);
                $this ->load->view('templates/backend/footer');
            else:
                $category=$this->input->post('category');
                $tagline=$this->input->post('tagline');
                $slug = $this->generate_slug($this->input->post('category'));

                $div = explode('.',$_FILES['userfile']['name']);
                $file_ext = strtolower(end($div));
                $image = time().'.'.$file_ext;

                if( $image ||$_FILES['userfile']['name'] != '' || $_FILES['userfile']['size'] != 0):
                    
                //uploading the image link to the database.
                $config['upload_path'] ='./assets/backend/images/uploads/icons/';
                $config['allowed_types'] ='gif|jpg|jpeg|png';
                $config['max_size'] ='2048';
                $config['max_width'] ='9024';
                $config['max_height'] ='9024';
                $config['file_name'] =$image;
    
                $this->load->library('upload',$config);
                if(!$this->upload->do_upload()){
                    $errors =array('error' =>$this->upload->display_errors());
                    $image ='noimage.png';        
                }else{
                    $data =array('upload_data' =>$this->upload->data());
                    $image = $image;
    
                }
                else:
                    $this->session->set_flashdata('message','<div class="alert alert-danger role="alert">
                    Invalid image.please try again.</div>');
                    return redirect('admin/category/add');
                endif;
                $this->Category_model->save($image,$slug);
                $this->session->set_flashdata('message','<div class="alert alert-success role="alert">
                The category has been saved successfully.</div>');
                return redirect('admin/categories');
            endif;
        }
        public function edit($slug){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();
            $data['category'] = $this->Category_model->get_categories($slug);
            if(empty($data['category'])):
                return redirect('admin/404');
            endif;

            $this->form_validation->set_rules('category','category','required|trim|callback_category_check');
            $this->form_validation->set_rules('tagline','tagline','required|trim|callback_tagline_check');
        
        if($this->form_validation->run() == false):
            $this->load->view('templates/backend/header',$data);
            $this->load->view('templates/backend/sidebar');
            $this ->load->view('backend/categories/edit-category',$data);
            $this ->load->view('templates/backend/footer');
        else:    
                $catid=$this->input->post('catid');
                $category=$this->input->post('category');
                $tagline=$this->input->post('tagline');
                $icon=$this->input->post('userfile');
                $slug = $this->generate_slug($this->input->post('category'));

                $div = explode('.',$_FILES['userfile']['name']);
                $file_ext = strtolower(end($div));
                $upload_image = time().'.'.$file_ext;
                if($upload_image || $_FILES['userfile']['name'] != '' || $_FILES['userfile']['size'] != 0):
                    
                //uploading the image link to the database.
                $config['upload_path'] ='./assets/backend/images/uploads/icons/';
                $config['allowed_types'] ='gif|jpg|jpeg|png';
                $config['max_size'] ='2048';
                $config['max_width'] ='9024';
                $config['max_height'] ='9024';
                $config['file_name'] =$upload_image;
           
                    $this->load->library('upload',$config);

                    if($this->upload->do_upload('userfile')):
                        $old_image = $data['category']['icon'];
                        if($old_image != 'noimage.png'):
                            unlink(FCPATH.'./assets/backend/images/uploads/icons/'.$old_image);
                        endif;
                        $new_image = $this->upload->data('file_name');
                        $this->db->set('icon',$new_image);
                    else:
                        echo $this->upload->display_errors();
                    endif;
                endif;

            $this->db->set('category',$category);
            $this->db->set('tagline',$tagline);
            $this->db->set('slug',$slug);
            $this->db->where('catid',$catid);

            $this->db->update('categories');
             $mdata=array();
            $mdata['message'] ="The category has been updated.";

            $this->session->set_userdata($mdata);
            $catid =$this->input->post('catid');
            $this->session->set_flashdata('message','<div class="alert alert-success role="alert">
                The category has been updated successfully.</div>');
            redirect(base_url('admin/categories'));

        endif;
        }
        public function delete($catid){
            $data = $this->Category_model->getcategory($catid);
            $path='./assets/backend/images/uploads/icons/';

             @unlink($path.$data->icon);
             if($this->Category_model->deletecategory($catid)):
                $this->session->set_flashdata('message','<div class="alert alert-success role="alert">
                The category has been deleted successfully.</div>');
             redirect('admin/categories');
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
        
        public function tagline_check($str){
            if (!preg_match('/^[a-zA-Z0-9&-. ]*$/',$str)){
                $this->form_validation->set_message('tagline_check', 'This tagline is invalid.');
            return FALSE;    
                }else{
            return TRUE;    
            }
        }
        public function category_check($str){
            if (!preg_match('/^[a-zA-Z0-9&-. ]*$/',$str)){
                $this->form_validation->set_message('category_check', 'This category is invalid.');
            return FALSE;    
                }else{
            return TRUE;    
            }
        }
    }