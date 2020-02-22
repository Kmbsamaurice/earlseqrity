<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Brand extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('backend/Brand_model');
            is_logged_in();
        }
        public function index(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $this->load->view('templates/backend/header',$data);
            $this->load->view('templates/backend/sidebar');
            $data['brandinfo'] = $this->Brand_model->brandsList();
            $this ->load->view('backend/brands/brands',$data);
            $this ->load->view('templates/backend/footer');
        }
        public function add(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $this->form_validation->set_rules('brand','brand','required|trim|callback_brand_check|is_unique[brands.brand]',[
                'is_unique' =>'This brand already exists.',
            ]);
            if($this->form_validation->run() ==FALSE):
                $this->load->view('templates/backend/header',$data);
                $this->load->view('templates/backend/sidebar');
                $this ->load->view('backend/brands/add-brand',$data);
                $this ->load->view('templates/backend/footer');
            else:
                $brand=$this->input->post('brand');
                $slug = $this->generate_slug($this->input->post('brand'));

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
                    return redirect('admin/brand/add');
                endif;
                $this->Brand_model->save($image,$slug);
                $this->session->set_flashdata('message','<div class="alert alert-success role="alert">
                The brand has been saved successfully.</div>');
                return redirect('admin/brands');
            endif;
        }
        public function edit($slug){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();
            $data['brand'] = $this->Brand_model->get_brands($slug);
            if(empty($data['brand'])):
                return redirect('admin/404');
            endif;

            $this->form_validation->set_rules('brand','Brand','required|trim|callback_brand_check');
        
        if($this->form_validation->run() == false):
            $this->load->view('templates/backend/header',$data);
            $this->load->view('templates/backend/sidebar');
            $this ->load->view('backend/brands/edit-brand',$data);
            $this ->load->view('templates/backend/footer');
        else:    
                $brandid=$this->input->post('brandid');
                $brand=$this->input->post('brand');
                $icon=$this->input->post('userfile');
                $slug = $this->generate_slug($this->input->post('brand'));

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
                        $old_image = $data['brand']['icon'];
                        if($old_image != 'noimage.png'):
                            unlink(FCPATH.'./assets/admin/images/uploads/icons/'.$old_image);
                        endif;
                        $new_image = $this->upload->data('file_name');
                        $this->db->set('icon',$new_image);
                    else:
                        echo $this->upload->display_errors();
                    endif;
                endif;

            $this->db->set('brand',$brand);
            $this->db->set('slug',$slug);
            $this->db->where('brandid',$brandid);

            $this->db->update('brands');
             $mdata=array();
            $mdata['message'] ="The brand has been updated.";

            $this->session->set_userdata($mdata);
            $brandid =$this->input->post('brandid');
            redirect(base_url('admin/brands'));

        endif;
        }
        public function delete($brandid){
            $data = $this->Brand_model->getbrand($brandid);
            $path='./assets/backend/images/uploads/icons/';

             @unlink($path.$data->image);
             if($this->Brand_model->deletebrand($brandid)):
                $this->session->set_flashdata('message','<div class="alert alert-success role="alert">
                The brand has been deleted successfully.</div>');
             redirect('admin/brands');
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
        public function brand_check($str){
            if (!preg_match('/^[a-zA-Z0-9&-. ]*$/',$str)){
                $this->form_validation->set_message('brand_check', 'This brand is invalid.');
            return FALSE;    
                }else{
            return TRUE;    
            }
        }
    }