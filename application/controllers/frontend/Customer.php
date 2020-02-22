<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	class Customer extends CI_Controller
	{
		public function __construct(){
            parent::__construct();
            $this->load->model('backend/Category_model');
            $this->load->model('backend/Order_model');
            $this->load->model('backend/Customer_model');
            $this->load->model('frontend/Wishlist_model');
        }
        public function orders(){
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();
            
            $data['category'] = $this->Category_model->getcategories(); 
            $data['customers'] = $this->Order_model->customer_order();
            if(! $data['customers']):
                $this->session->set_flashdata('message','<div class="alert alert-danger role="alert">
                Please login to view your orders.</div>');
                return redirect('orders/sign-in');
            endif;
          
            $this ->load->view('frontend/orders',$data);
            $this ->load->view('templates/frontend/jsfooter');
        }
        public function login(){
            $this->form_validation->set_rules('email','Email','required|trim|valid_email');
            $this->form_validation->set_rules('password','Password','required|trim');
            $data['category'] = $this->Category_model->getcategories();
            if($this->form_validation->run() == FALSE){
                //$this ->load->view('templates/frontend/header',$data);
                $this ->load->view('frontend/customers/login',$data);
                $this ->load->view('templates/frontend/jsfooter');
            }else{
                //when the validation works out
                $this->_login();
            }
        }
        public function order(){
            $this->form_validation->set_rules('email','Email','required|trim|valid_email');
            $this->form_validation->set_rules('password','Password','required|trim');
            $data['category'] = $this->Category_model->getcategories();
            if($this->form_validation->run() == FALSE){
                //$this ->load->view('templates/frontend/header',$data);
                $this ->load->view('frontend/orders/login',$data);
                $this ->load->view('templates/frontend/jsfooter');
            }else{
                //when the validation works out
                $this->orderLogin();
            }
        }
        public function wishlist(){
            $this->form_validation->set_rules('email','Email','required|trim|valid_email');
            $this->form_validation->set_rules('password','Password','required|trim');
            $data['category'] = $this->Category_model->getcategories();
            if($this->form_validation->run() == FALSE){
                //$this ->load->view('templates/frontend/header',$data);
                $this ->load->view('frontend/wishlist/login',$data);
                $this ->load->view('templates/frontend/jsfooter');
            }else{
                //when the validation works out
                $this->wishlistLogin();
            }
        }
        private function orderLogin(){
            $email=$this->input->post('email');
            $password=$this->input->post('password');

            $customer = $this->db->get_where('customers',['email' =>$email])->row_array();
            if($customer){
                //password verify and check if customer is active
                if($customer['is_active'] == 1){
                    if(password_verify($password,$customer['password'])){
                            $data =[
                                'email' =>$customer['email'],
                                'first_name' =>$customer['first_name'],
                                'last_name' =>$customer['last_name'],
                                'date_created' =>$customer['date_created'],
                                'id' =>$customer['id']
                            ];
                            $this->session->set_userdata($data);
                            redirect('orders');
                    }else{
                        $this->session->set_flashdata('message','<div class="alert alert-danger role="alert">
                        Invalid email or password.</div>');
                        return redirect('sign-in'); 
                    }
                }else{
                    $this->session->set_flashdata('message','<div class="alert alert-danger role="alert">
                    Please activate your account.</div>');
                    return redirect('orders/sign-in');
                }

            }else{
                $this->session->set_flashdata('message','<div class="alert alert-danger role="alert">
                Invalid email or password.</div>');
                return redirect('orders/sign-in');
            }
        }
        private function wishlistLogin(){
            $email=$this->input->post('email');
            $password=$this->input->post('password');

            $customer = $this->db->get_where('customers',['email' =>$email])->row_array();
            if($customer){
                //password verify and check if customer is active
                if($customer['is_active'] == 1){
                    if(password_verify($password,$customer['password'])){
                            $data =[
                                'email' =>$customer['email'],
                                'first_name' =>$customer['first_name'],
                                'last_name' =>$customer['last_name'],
                                'date_created' =>$customer['date_created'],
                                'id' =>$customer['id']
                            ];
                            $this->session->set_userdata($data);
                            redirect('wishlist');
                    }else{
                        $this->session->set_flashdata('message','<div class="alert alert-danger role="alert">
                        Invalid email or password.</div>');
                        return redirect('wishlist/sign-in'); 
                    }
                }else{
                    $this->session->set_flashdata('message','<div class="alert alert-danger role="alert">
                    Please activate your account.</div>');
                    return redirect('wishlist/sign-in');
                }

            }else{
                $this->session->set_flashdata('message','<div class="alert alert-danger role="alert">
                Invalid email or password.</div>');
                return redirect('wishlist/sign-in');
            }
        }
        private function _login(){
            $email=$this->input->post('email');
            $password=$this->input->post('password');

            $customer = $this->db->get_where('customers',['email' =>$email])->row_array();
            if($customer){
                //password verify and check if customer is active
                if($customer['is_active'] == 1){
                    if(password_verify($password,$customer['password'])){
                            $data =[
                                'email' =>$customer['email'],
                                'first_name' =>$customer['first_name'],
                                'last_name' =>$customer['last_name'],
                                'date_created' =>$customer['date_created'],
                                'id' =>$customer['id']
                            ];
                            $content =$this->cart->contents();
                            if(!empty($content)):
                            $this->session->set_userdata($data);    
                        		$this->session->set_flashdata('message','<div class="alert alert-success role="alert">
                                You can now checkout.</div>');
                                redirect('check-out');
                            endif;

                            $this->session->set_userdata($data);
                            redirect('/');
                    }else{
                        $this->session->set_flashdata('message','<div class="alert alert-danger role="alert">
                        Invalid email or password.</div>');
                        return redirect('sign-in'); 
                    }
                }else{
                    $this->session->set_flashdata('message','<div class="alert alert-danger role="alert">
                    Please activate your account.</div>');
                    return redirect('sign-in');
                }

            }else{
                $this->session->set_flashdata('message','<div class="alert alert-danger role="alert">
                Invalid email or password.</div>');
                return redirect('sign-in');
            }
        }
        public function register(){
            $this->form_validation->set_rules('firstname','First name','required|trim|min_length[3]|callback_name_check');
            $this->form_validation->set_rules('lastname','Last name','required|trim|callback_name_check');
            $this->form_validation->set_rules('phone','Phone number','required|callback_phone_check'
            );
            $this->form_validation->set_rules('email','Email Address','required|trim|valid_email|is_unique[customers.email]',[
                'is_unique' =>'This email is already registered.',
            ]);
            $this->form_validation->set_rules('password','Password','required|trim|min_length[8]',
            ['min_length' =>'password should be atleast 8 characters.']);
           
            if($this->form_validation->run() == FALSE){
                $data['category'] = $this->Category_model->getcategories();
                //$this ->load->view('templates/frontend/header',$data);
                $this ->load->view('frontend/customers/register',$data);
                $this ->load->view('templates/frontend/jsfooter');
        }else{
            $email= htmlspecialchars($this->input->post('email'));
            $data = [
                'first_name' =>  htmlspecialchars($this->input->post('firstname')),
                'last_name' =>  htmlspecialchars($this->input->post('lastname')),
                'email' => $email,
                'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
                'phone' => $this->input->post('phone'),
                'image' =>'noimage.png',
                'is_active' =>0,
            ];
            //creating the token to be used to verify the email address
            $token =base64_encode(mt_rand());
            $user_token = [
            'email' => $email,
            'token' => $token,
            'date_created' =>time()
            ];
            
            $this->db->insert('customers',$data);
            $this->db->insert('user_token', $user_token);
            
            $this->_sendEmail($token,'verify');
           
            $this->session->set_flashdata('message','
            <div class="alert alert-success" role="alert">Your account has been created successfully.please verify it by clicking the activation link that has been sent to your email.</div>');
            redirect('sign-up');
            }
                
            }
            public function edit(){
                $data['customer'] = $this->db->get_where('customers',['email'=>
                $this->session->userdata('email')])->row_array();

                $data['user'] = $this->Customer_model->get_customers();
                if (empty($data['user'])) :
                    return redirect('404');
                endif;
                if(!$this->session->userdata('id')){
                    $this->session->set_flashdata('message','<div class="alert alert-danger role="alert">
                    Please login to view your profile.</div>');
                    return redirect('sign-in');
                }
                $this->form_validation->set_rules('firstname','First name','required|trim|min_length[3]|callback_name_check');
                $this->form_validation->set_rules('lastname','Last name','required|trim|callback_name_check');
                $this->form_validation->set_rules('phone','Phone number','required|callback_phone_check'
                );

            if ($this->form_validation->run() == FALSE) :
                $data['category'] = $this->Category_model->getcategories();
                //$this ->load->view('templates/frontend/header',$data);
                $this ->load->view('frontend/customers/profile',$data);
                $this ->load->view('templates/frontend/jsfooter');
            else :
                $id = $this->input->post('id');
                $first_name = $this->input->post('firstname');
                $last_name = $this->input->post('lastname');
                $phone = $this->input->post('phone');

            if ($_FILES['userfile']['name'] != '' || $_FILES['userfile']['size'] != 0) :

                //uploading the image link to the database.
                $config['upload_path'] = './assets/backend/images/uploads/customers/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '2048';
                $config['max_width'] = '9024';
                $config['max_height'] = '9024';
                $config['encrypt_name'] = true;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('userfile')) :
                    $old_image = $data['customer']['image'];
                    if ($old_image != 'noimage.png') :
                        unlink(FCPATH . './assets/backend/images/uploads/customers/' . $old_image);
                    endif;
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                else :
                    $error = array('error' => $this->upload->display_errors());
                endif;
            endif;
            
            $this->db->set('first_name', $first_name);
            $this->db->set('last_name', $last_name);
            $this->db->set('phone', $phone);
            $this->db->where('id', $id);

            $this->db->update('customers');
            $mdata = array();
            $mdata['message'] = "Your profile has been updated successfully.";

            $this->session->set_userdata($mdata);
            $id = $this->input->post('id');
            $this->session->set_flashdata('message', '<div class="alert alert-success role="alert">
            Your profile has been updated successfully.</div>');
            redirect(base_url('profile'));
            endif;
        }
            public function subscription(){
                $this->form_validation->set_rules('email','Email Address','required|trim|valid_email|is_unique[subscriptions.email]',[
                    'is_unique' =>'This email already exists in our subscriptions.<br>Thank you for being part of our team.',
                ]);
                $email= htmlspecialchars($this->input->post('email'));
                if(!isset($email) || empty($email)):
                    redirect('/');
                endif;
                $data['category'] = $this->Category_model->getcategories();
                if($this->form_validation->run() == FALSE){
                    //$this ->load->view('templates/frontend/header',$data);
                    $this ->load->view('frontend/subscribe',$data);
                    $this ->load->view('templates/frontend/jsfooter');
                }else{
                $data = [
                    'email' => $email,
                    'verify' =>0,
                ];

                $token =base64_encode(mt_rand());
                $user_token = [
                        'email' => $email,
                        'token' => $token,
                        'date_created' =>time()
                        ];
                    $this->db->insert('subscriptions',$data);    
                    $this->db->insert('user_token', $user_token);
                    $this->_sendEmail($token,'subscribe');
                    
                $this->session->set_flashdata('message','<div class="alert alert-success role="alert">
                A link has been sent to email address "'.$email.'" .Please check your email to verify your subscription.</div>');
                redirect('subscribe');
            }
        }
            public function forgot(){
                $this->form_validation->set_rules('email','Email Adress','required|trim');
                $data['category'] = $this->Category_model->getcategories();
                if($this->form_validation->run() == FALSE){
                    //$this ->load->view('templates/frontend/header',$data);
                    $this ->load->view('frontend/customers/forgot-password',$data);
                    $this ->load->view('templates/frontend/jsfooter');
                }else{

                $email = $this->input->post('email');
                $user = $this->db->get_where('customers',['email' =>$email,'is_active'=>1])->row_array();
                if($user):
                    $token =base64_encode(mt_rand());
                    $user_token = [
                        'email' => $email,
                        'token' => $token,
                        'date_created' =>time()
                        ];
                    $this->db->insert('user_token', $user_token);
                    $this->_sendEmail($token,'forgot');
                    
                    $this->session->set_flashdata('message','<div class="alert alert-success role="alert">
                    A link has been sent to email address "'.$email.'" .You can reset your password.Please check your email to reset your password.</div>');
                else:
                    $this->session->set_flashdata('message','<div class="alert alert-danger role="alert">
                    The email address '.$email.'
                    doesnot seem to be registered or activated.</div>');
                    return redirect('forgot-password');
                endif;      
            }
        }
        //will activate the unactivated user status..
        public function verify(){
            $email= $this ->input->get('email');
            $token =$this ->input->get('token');
            $user=$this ->db->get_where('customers',['email' =>$email])->row_array();
            
            if($user){
            $user_token=$this ->db->get_where('user_token',['token' =>$token])->row_array();
                if( $user_token){
                    if(time() - $user_token['date_created'] < (60*60*24)){
                       $this->db->set('is_active',1);
                       $this->db->where('email',$email);
                       $this->db->update('customers');
                       
                       $this->db->delete('user_token',['email'=>$email]);
                        $this->session->set_flashdata('message','
                    <div class="alert alert-success" role="alert">'.$email.' has been verified.You can login.</div>
                    ');
                     redirect('sign-in');
                    }else{
                       $this->db->delete('customers',['email'=>$email]);
                       $this->db->delete('user_token',['email'=>$email]);
                       
                       $this->session->set_flashdata('message','
                    <div class="alert alert-danger" role="alert">Token has expired.</div>
                    ');
                    redirect('sign-in');
                    
                    }
                }else{
                $this->session->set_flashdata('message','
                <div class="alert alert-danger" role="alert">Your account activation has failed.</div>
                ');
                redirect('sign-in');
                }
            }else{
                $this->session->set_flashdata('message','
                <div class="alert alert-danger" role="alert">Your account activation has failed.</div>
                ');
                redirect('sign-in');
            }
            
        $this->db->where('customers.id', $id);
        return $this->db->update('customers', $data);
    }
    public function subscribe(){
        $email= $this ->input->get('email');
        $token =$this ->input->get('token');
        $user=$this ->db->get_where('subscriptions',['email' =>$email])->row_array();
        
        if($user){
        $user_token=$this ->db->get_where('user_token',['token' =>$token])->row_array();
            if( $user_token){
                if(time() - $user_token['date_created'] < (60*60*24)){
                   $this->db->set('verify',1);
                   $this->db->where('email',$email);
                   $this->db->update('subscriptions');
                   
                    $this->db->delete('user_token',['email'=>$email]);
                    $this->session->set_flashdata('message','
                <div class="alert alert-success" role="alert">Thanks for subscribing to our newsletter and for your interest in earlcommunications!<br>'.$email.' has been verified.</div>
                ');
                 redirect('subscribe');
                }else{
                   $this->db->delete('user_token',['email'=>$email]);
                   
                   $this->session->set_flashdata('message','
                <div class="alert alert-danger" role="alert">Token has expired.</div>
                ');
                redirect('subscribe');
                
                }
            }else{
            $this->session->set_flashdata('message','
            <div class="alert alert-danger" role="alert">Your subscription email verification has failed.</div>
            ');
            redirect('subscribe');
            }
        }else{
            $this->session->set_flashdata('message','
            <div class="alert alert-danger" role="alert">Your subscription email verification has failed.</div>
            ');
            redirect('subscribe');
        }

    }
        public function resetpassword(){
            $email= $this ->input->get('email');
            $token =$this ->input->get('token');
            $user=$this ->db->get_where('customers',['email' =>$email])->row_array();
                
            if($user){
                $user_token=$this ->db->get_where('user_token',['token' =>$token])->row_array();
                    if( $user_token){
                        $this->session->set_userdata('reset_email',$email);
                        $this->changePassword();
                    }else{
                    $this->session->set_flashdata('message','
                    <div class="alert alert-danger" role="alert">Your password reset has failed.</div>
                    ');
                     redirect('sign-in');
                    }
                }else{
                     $this->session->set_flashdata('message','
                    <div class="alert alert-danger" role="alert">Your password reset has failed.</div>
                    ');
                     redirect('sign-in');
            }    
        }
            
        public function changePassword(){
            if(!$this->session->userdata('reset_email')){
                redirect('sign-in');
            }
            $this->form_validation->set_rules('password','Password','required|trim|min_length[8]',
            ['min_length' =>'password should be atleast 8 characters.']);
            
            if($this->form_validation->run() == FALSE){
                $data['category'] = $this->Category_model->getcategories();
               // $this ->load->view('templates/frontend/header',$data);
                $this ->load->view('frontend/customers/reset-password',$data);
                $this ->load->view('templates/frontend/jsfooter');
              }else{
                  $password = password_hash($this->input->post("password"),PASSWORD_DEFAULT);
                  $email = $this->session->userdata('reset_email');
                  $this->db->set('password',$password);
                  $this->db->where('email',$email);
                  $this->db->update('customers');
                  
                  $this->session->unset_userdata('reset_email');
                   $this->session->set_flashdata('message','
                    <div class="alert alert-success" role="alert">Your password has been reset successfully. You can now login.</div>
                    ');
                     redirect('sign-in');
            }    
        }
        private function _sendEmail($token,$type){
            require_once(APPPATH.'libraries/mailer/mailer_config.php');
            $this->load->library('phpmailer_lib');
            $mail = $this->phpmailer_lib->load();

            $mail->isSMTP();
            $mail->Host     = HOST;
            $mail->SMTPAuth = true;
            $mail->Username = GUSER;
            $mail->Password = GPWD;
            $mail->SMTPSecure = 'ssl';
            $mail->Port     = PORT;
            $mail->setFrom('sales@earlcommunications.com', 'Earl communications');
            $mail->addReplyTo('earlcommunications@gmail.com', 'Earl communications');
            
            if($type == 'verify'):
                $mail->addAddress($this->input->post('email'));
                $mail->Subject = 'Earl communications-Account Activation';
                $mail->isHTML(true);

                $mailContent ='
                    <!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title></title><meta name="viewport" content="width=device-width, initial-scale=1"><meta http-equiv="X-UA-Compatible" content="IE=edge" /><style type="text/css">body,table,td,a{-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}table,td{mso-table-lspace:0pt;mso-table-rspace:0pt}img{-ms-interpolation-mode:bicubic}img{border:0;height:auto;line-height:100%;outline:none;text-decoration:none}table{border-collapse:collapse !important}body{height:100% !important;margin:0 !important;padding:0 !important;width:100% !important}a[x-apple-data-detectors]{color:inherit !important;text-decoration:none !important;font-size:inherit !important;font-family:inherit !important;font-weight:inherit !important;line-height:inherit !important}@media screen and (max-width:600px){h1{font-size:32px !important;line-height:32px !important}}div[style*="margin: 16px 0;"]{margin:0 !important}</style><style type="text/css"></style></head><body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;"><div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> Account verification</div><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td bgcolor="#f4f4f4" align="center"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> <a href="http://m.earlcommunications.com" > <img alt="Logo" src="http://m.earlcommunications.com/assets/frontend/img/earl.png" width="169" height="40" style="display: block; width: 169px; max-width: 169px; min-width: 169px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 18px;" border="0"> </a></td></tr></table></td></tr><tr><td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;"><h1 style="font-size: 28px; font-weight: 400; margin: 0; letter-spacing: 0px;">Verify your account</h1></td></tr></table></td></tr><tr><td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;">We\'re excited to have you get started. First, you need to confirm your account. Just click the button below.</p></td></tr><tr><td bgcolor="#ffffff" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;"><table border="0" cellspacing="0" cellpadding="0"><tr><td align="center" style="border-radius: 3px;" > <a data-click-track-id="37" href=" '.base_url().'verify?email=' . $this->input->post('email') .'&token='.urlencode($token).'" style="margin-top: 36px; -ms-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%; color: #ffffff; font-family: -apple-system, BlinkMacSystemFont, sans-serif; font-size: 12px; font-smoothing: always; font-style: normal; font-weight: 600; letter-spacing: 0.7px; line-height: 48px; mso-line-height-rule: exactly; text-decoration: none; vertical-align: top; width: 220px;background-color:#ED502E; border-radius: 28px; display: block; text-align: center; text-transform: uppercase" target="_blank"> Activate account </a></tr></table></td></tr></table></td></tr><tr><td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;"></p><p style="margin: 0;">You can also reach us via our <a data-click-track-id="1053" href="https://m.earlcommunications.com/contact-us" style="font-weight: 500; color: #EEB31E" target="_blank">Help Center</a>.</p></td></tr><tr><td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;">Cheers, <br>The Earl communications Team</p></td></tr></table></td></tr><tr><td background-color="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#f4f4f4" align="left" style="padding: 30px 30px 30px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;"></td></tr></table></td></tr></table></body></html>
                ';
                $mail->Body = $mailContent;

                if(!$mail->send()):
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Your account activation has failed.</div>');
                    redirect('sign-in');
                else:
                    $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">We\'ve sent an email to ' .$this->input->post('email').'.Open it up to activate your account.</div>');
                      redirect('sign-up');
                endif;

            elseif($type == 'forgot'):
                $mail->addAddress($this->input->post('email'));
                $mail->Subject = 'Earl communications-Password Reset';
                $mail->isHTML(true);
                $mailContent = '
                    <!DOCTYPE html><html><head><title></title><meta name="viewport" content="width=device-width, initial-scale=1"><meta http-equiv="X-UA-Compatible" content="IE=edge" /><style type="text/css">body,table,td,a{-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}table,td{mso-table-lspace:0pt;mso-table-rspace:0pt}img{-ms-interpolation-mode:bicubic}img{border:0;height:auto;line-height:100%;outline:none;text-decoration:none}table{border-collapse:collapse !important}body{height:100% !important;margin:0 !important;padding:0 !important;width:100% !important}a[x-apple-data-detectors]{color:inherit !important;text-decoration:none !important;font-size:inherit !important;font-family:inherit !important;font-weight:inherit !important;line-height:inherit !important}@media screen and (max-width:600px){h1{font-size:32px !important;line-height:32px !important}}div[style*="margin: 16px 0;"]{margin:0 !important}</style><style type="text/css"></style></head><body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;"><div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> Account verification</div><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td bgcolor="#f4f4f4" align="center"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> <a href="http://m.earlcommunications.com" > <img alt="Logo" src="http://m.earlcommunications.com/assets/frontend/img/earl.png" width="169" height="40" style="display: block; width: 169px; max-width: 169px; min-width: 169px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 18px;" border="0"> </a></td></tr></table></td></tr><tr><td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;"><h1 style="font-size: 28px; font-weight: 400; margin: 0; letter-spacing: 0px;">Reset your password</h1></td></tr></table></td></tr><tr><td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;">You are receiving this e-mail because you have requested a password reset on your Earl account. Just click the button below to reset your password.</p></td></tr><tr><td bgcolor="#ffffff" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;"><table border="0" cellspacing="0" cellpadding="0"><tr><td align="center" style="border-radius: 3px;" > <a data-click-track-id="37" href=" '.base_url().'reset-password?email=' . $this->input->post('email') .'&token='.urlencode($token).'" style="margin-top: 36px; -ms-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%; color: #ffffff; font-family: -apple-system, BlinkMacSystemFont, sans-serif; font-size: 12px; font-smoothing: always; font-style: normal; font-weight: 600; letter-spacing: 0.7px; line-height: 48px; mso-line-height-rule: exactly; text-decoration: none; vertical-align: top; width: 220px;background-color:#ED502E; border-radius: 28px; display: block; text-align: center; text-transform: uppercase" target="_blank"> Reset password </a></tr></table></td></tr></table></td></tr><tr><td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;"></p><p style="margin: 0;">You can also reach us via our <a data-click-track-id="1053" href="https://m.earlcommunications.com/contact-us" style="font-weight: 500; color: #EEB31E" target="_blank">Help Center</a>.</p></td></tr><tr><td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;">Cheers, <br>The Earl communications Team</p></td></tr></table></td></tr><tr><td background-color="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#f4f4f4" align="left" style="padding: 30px 30px 30px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;"></td></tr></table></td></tr></table></body></html>

                ';
                $mail->Body = $mailContent;

                if(!$mail->send()):
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Your password reset has failed.</div>');
                    redirect('forgot-password');
                else:
                    $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">We\'ve sent an email to ' .$this->input->post('email').'.Open it up to reset password.</div>');
                    redirect('forgot-password');
                endif;
            elseif($type == 'subscribe'):
                    $mail->addAddress($this->input->post('email'));
                    $mail->Subject = 'Earl communications-Subscription';
                    $mail->isHTML(true);
                    $mailContent = '
                        <!DOCTYPE html><html><head><title></title><meta name="viewport" content="width=device-width, initial-scale=1"><meta http-equiv="X-UA-Compatible" content="IE=edge" /><style type="text/css">body,table,td,a{-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}table,td{mso-table-lspace:0pt;mso-table-rspace:0pt}img{-ms-interpolation-mode:bicubic}img{border:0;height:auto;line-height:100%;outline:none;text-decoration:none}table{border-collapse:collapse !important}body{height:100% !important;margin:0 !important;padding:0 !important;width:100% !important}a[x-apple-data-detectors]{color:inherit !important;text-decoration:none !important;font-size:inherit !important;font-family:inherit !important;font-weight:inherit !important;line-height:inherit !important}@media screen and (max-width:600px){h1{font-size:32px !important;line-height:32px !important}}div[style*="margin: 16px 0;"]{margin:0 !important}</style><style type="text/css"></style></head><body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;"><div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> Account verification</div><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td bgcolor="#f4f4f4" align="center"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> <a href="http://m.earlcommunications.com" > <img alt="Logo" src="http://m.earlcommunications.com/assets/frontend/img/earl.png" width="169" height="40" style="display: block; width: 169px; max-width: 169px; min-width: 169px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 18px;" border="0"> </a></td></tr></table></td></tr><tr><td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;"><h1 style="font-size: 28px; font-weight: 400; margin: 0; letter-spacing: 0px;">Confirm your subscription.</h1></td></tr></table></td></tr><tr><td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;">You are receiving this e-mail because you have subscribed to our newsletter. Just click the button below to confirm your subscription.</p></td></tr><tr><td bgcolor="#ffffff" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;"><table border="0" cellspacing="0" cellpadding="0"><tr><td align="center" style="border-radius: 3px;" > <a data-click-track-id="37" href=" '.base_url().'subscription?email=' . $this->input->post('email') .'&token='.urlencode($token).'" style="margin-top: 36px; -ms-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%; color: #ffffff; font-family: -apple-system, BlinkMacSystemFont, sans-serif; font-size: 12px; font-smoothing: always; font-style: normal; font-weight: 600; letter-spacing: 0.7px; line-height: 48px; mso-line-height-rule: exactly; text-decoration: none; vertical-align: top; width: 220px;background-color:#ED502E; border-radius: 28px; display: block; text-align: center; text-transform: uppercase" target="_blank"> Subscribe </a></tr></table></td></tr></table></td></tr><tr><td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;"></p><p style="margin: 0;">You can also reach us via our <a data-click-track-id="1053" href="https://m.earlcommunications.com/contact-us" style="font-weight: 500; color: #EEB31E" target="_blank">Help Center</a>.</p></td></tr><tr><td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;">Cheers, <br>The Earl communications Team</p></td></tr></table></td></tr><tr><td background-color="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#f4f4f4" align="left" style="padding: 30px 30px 30px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;"></td></tr></table></td></tr></table></body></html>
    
                    ';
                    $mail->Body = $mailContent;
    
                if(!$mail->send()):
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Your subscription attempt has failed.</div>');
                    redirect('subscribe');
                else:
                    $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">We\'ve sent an email to ' .$this->input->post('email').'.Please check your email to verify your subscription.</div>');
                    redirect('subscribe');
                endif;    
            endif;
        }    
        public function phone_check($str){
            if (!preg_match('/^(?:256|\+256|0)?(7(?:(?:[0127589][0-9])|(?:0[0-8])|(4[0-1]))[0-9]{6})$/',$str)){
                $this->form_validation->set_message('phone_check', 'The phone number is invalid.');
                return FALSE;
            }else{
                return TRUE;
            }
        }
        public function name_check($str){
            if (!preg_match('/^[a-zA-Z ]*$/',$str)){
                $this->form_validation->set_message('name_check', 'This name appears to be invalid.');
            return FALSE;    
                }else{
            return TRUE;    
            }
        }
        public function logout(){
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('id');
            //$this->session->set_flashdata('message','<div class="alert alert-danger role="alert">
            //Activate your email address.</div>');
            return redirect('/');
        }     
        
	}