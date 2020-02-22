<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class User extends CI_Controller{
        public function __construct(){
            parent::__construct();
            is_logged_in();
            $this->load->helper('text');
            $this->load->model('backend/User_model');
           
        }

        public function index(){
           $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $this->load->view('templates/backend/header',$data);
            $this->load->view('templates/backend/sidebar');
            $this ->load->view('backend/users/profile',$data);
            $this ->load->view('templates/backend/footer');
        }
        public function registration(){
            $data['user'] = $this->db->get_where('admins',['email'=>
                $this->session->userdata('email')])->row_array();
                
            $this->form_validation->set_rules('username','Username','required|trim');
            $this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[admins.email]',
                ['is_unique'=>'This email is already registered.']
            );
            $this->form_validation->set_rules('role_id','Role','required|trim');
            $this->form_validation->set_rules('password','Password','required|trim|min_length[8]|matches[confirm]',
                ['matches'=>'The passwords didnot match'],
                ['min_length'=>'The password should atleast be 8 characters long.']
            );
            $this->form_validation->set_rules('confirm','Confirm password','required|trim|matches[password]',
                ['matches'=>'The passwords didnot match']
            );
    
    
            if($this->form_validation->run() == false):
                $data['user'] = $this->db->get_where('admins',['email'=>
                $this->session->userdata('email')])->row_array();
    
                $this->load->view('templates/backend/header',$data);
                $this->load->view('templates/backend/sidebar');
                $this->load->view('backend/users/register',$data);
                
                $this->load->view('templates/backend/footer');
            else:
                $data=[
                    'username' => htmlspecialchars($this->input->post('username')),
                    'email' => htmlspecialchars($this->input->post('email')),
                    'image' => 'noimage.png',
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'role_id' => $this->input->post('role_id'),
                    'is_active'=>1,
                ];
                $this->db->insert('admins',$data);
                $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">The user has been registered successfully.</div>');
                redirect('admin/register');
            endif;
        }
         public function users(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $this->load->view('templates/backend/header',$data);
            $this->load->view('templates/backend/sidebar');
            $data['userinfo'] = $this->User_model->getusers();
            
            $this ->load->view('backend/users/users',$data);
            
            $this->load->view('templates/backend/footer');

        }
         public function edit(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $this->form_validation->set_rules('username','Username','required|trim');
            if($this->form_validation->run() == false):
                $this->load->view('templates/backend/header',$data);
                $this->load->view('templates/backend/sidebar');
                $this->load->view('backend/users/edit-profile',$data);
                $this ->load->view('templates/backend/footer');
            else:
                $username=$this->input->post('username');
                $email=$this->input->post('email');
                $image=$this->input->post('image');
                
                $div = explode('.',$_FILES['image']['name']);
                $file_ext = strtolower(end($div));
                $upload_image = time().'.'.$file_ext;
                if($upload_image || $_FILES['image']['name'] != '' || $_FILES['image']['size'] != 0):
                    //uploading the image link to the database.
                    $config['upload_path'] ='./assets/backend/images/uploads/admins/';
                    $config['allowed_types'] ='gif|jpg|jpeg|png';
                    $config['max_size'] ='2048';
                    $config['max_width'] ='9024';
                    $config['max_height'] ='9024';
                    $config['file_name'] =$upload_image;

                        $this->load->library('upload',$config);

                        if($this->upload->do_upload('image')):
                            $old_image = $data['user']['image'];
                            if($old_image != 'noimage.png'):
                                unlink(FCPATH.'./assets/backend/images/uploads/admins/'.$old_image);
                            endif;
                            
                            $new_image = $this->upload->data('file_name');
                            $this->db->set('image',$new_image);
                        else:
                            echo $this->upload->display_errors();
                        endif;
                    endif;
                $this->db->set('username',$username);
                $this->db->where('email',$email);

                $this->db->update('admins');
                 $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Your details have been updated successfully.</div>');
                redirect('admin/profile/edit');

            endif; 
        }
    } 