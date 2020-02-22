<?php
    class Earn extends CI_Controller{
    	public function __construct(){
            parent::__construct();
            $this->load->helper('text');
            $this->load->model('backend/Category_model');
            $this->load->model('backend/Subcategory_model');
            $this->load->model('backend/Brand_model');
            $this->load->model('backend/Product_model');
            $this->load->model('frontend/Search_model');
            
            
        }
        public function engineers(){
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();
            
            $this->form_validation->set_rules('name','Name','required|trim|min_length[3]|callback_name_check');
            $this->form_validation->set_rules('conditions','Terms & conditions','required|trim');
			$this->form_validation->set_rules('email','Email Address','required|trim|valid_email|is_unique[engineers.email]',[
                'is_unique' =>'This email already exists .',
            ]);
			$this->form_validation->set_rules('phone','Phone number','required|trim|callback_phone_check');
            $this->form_validation->set_rules('area','Area of expertise','required|trim');
            $this->form_validation->set_rules('experience','Experience','required|trim');

            if($this->form_validation->run() == FALSE){
            $data['category'] = $this->Category_model->getcategories();
            $this ->load->view('frontend/engineer',$data);
            $this ->load->view('templates/frontend/jsfooter');

            }else{
                $email= htmlspecialchars($this->input->post('email'));
                $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'expertise' => $this->input->post('area'),
                'experience' => $this->input->post('experience'),
                'verify' =>0,
                'status' =>0,
                'tc' => $this->input->post('conditions'),				
                
			];
            
            //creating the token to be used to verify the email address
            $token =base64_encode(mt_rand());
            $user_token = [
            'email' => $email,
            'token' => $token,
            'date_created' =>time()
            ];
            
            $this->db->insert('engineers',$data);
            $this->db->insert('user_token', $user_token);
            
            $this->_sendEmail($token,'engineers');
            $this->session->set_flashdata('message','<div class="alert alert-success role="alert">
				You have been registered successfully as an engineer.please verify your account by clicking on the activation link that has been sent to your email.</div>');
				return redirect('engineer');
            }
        }
        public function sales(){
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();
            
            $this->form_validation->set_rules('name','Name','required|trim|min_length[3]|callback_name_check');
            $this->form_validation->set_rules('conditions','Terms & conditions','required|trim');
			$this->form_validation->set_rules('email','Email Address','required|trim|valid_email|is_unique[sales.email]',[
                'is_unique' =>'This email already exists .',
            ]);
			$this->form_validation->set_rules('phone','Phone number','required|trim|callback_phone_check');

            if($this->form_validation->run() == FALSE){
            $data['category'] = $this->Category_model->getcategories();
            $this ->load->view('frontend/sales-consultant',$data);
            $this ->load->view('templates/frontend/jsfooter');

            }else{
                $email= htmlspecialchars($this->input->post('email'));
                $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'verify' =>0,
                'status' =>0,
                'tc' => $this->input->post('conditions'),				
                
			];
			//creating the token to be used to verify the email address
            $token =base64_encode(mt_rand());
            $user_token = [
            'email' => $email,
            'token' => $token,
            'date_created' =>time()
            ];
            
            $this->db->insert('sales',$data);
            $this->db->insert('user_token', $user_token);
            
            $this->_sendEmail($token,'sales');
            $this->session->set_flashdata('message','<div class="alert alert-success role="alert">
				You have been registered successfully as a sales consultant.please verify your account by clicking on the activation link that has been sent to your email.</div>');
				return redirect('sales-consultant');
            }
        }
        public function sellers(){
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();
            
            $this->form_validation->set_rules('name','Name/Company name','required|trim|min_length[3]');
            $this->form_validation->set_rules('conditions','Terms & conditions','required|trim');
			$this->form_validation->set_rules('email','Email Address','required|trim|valid_email|is_unique[sellers.email]',[
                'is_unique' =>'This email already exists .',
            ]);
            $this->form_validation->set_rules('phone','Phone number','required|trim|callback_phone_check');
            $this->form_validation->set_rules('location','Business Location','required|trim');

            if($this->form_validation->run() == FALSE){
            $data['category'] = $this->Category_model->getcategories();
            $this ->load->view('frontend/seller',$data);
            $this ->load->view('templates/frontend/jsfooter');

            }else{
                $email= htmlspecialchars($this->input->post('email'));
                $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'location' => $this->input->post('location'),
                'verify' =>0,
                'status' =>0,
                'tc' => $this->input->post('conditions'),				
                
			];
			//creating the token to be used to verify the email address
            $token =base64_encode(mt_rand());
            $user_token = [
            'email' => $email,
            'token' => $token,
            'date_created' =>time()
            ];
            
            $this->db->insert('sellers',$data);
            $this->db->insert('user_token', $user_token);
            
            $this->_sendEmail($token,'sellers');
            $this->session->set_flashdata('message','<div class="alert alert-success role="alert">
				You have been registered successfully as a seller.please verify your account by clicking on the activation link that has been sent to your email.</div>');
				return redirect('seller');
            }
        }
        public function logistics(){
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();
            
            $this->form_validation->set_rules('name','Name/Company name','required|trim|min_length[3]');
            $this->form_validation->set_rules('conditions','Terms & conditions','required|trim');
			$this->form_validation->set_rules('email','Email Address','required|trim|valid_email|is_unique[logistics.email]',[
                'is_unique' =>'This email already exists .',
            ]);
            $this->form_validation->set_rules('phone','Phone number','required|trim|callback_phone_check');
            $this->form_validation->set_rules('transport','Transport means','required|trim');

            if($this->form_validation->run() == FALSE){
            $data['category'] = $this->Category_model->getcategories();
            $this ->load->view('frontend/logistics-service-provider',$data);
            $this ->load->view('templates/frontend/jsfooter');

            }else{
                $email= htmlspecialchars($this->input->post('email'));
                $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'transport' => $this->input->post('transport'),
                'verify' =>0,
                'status' =>0,
                'tc' => $this->input->post('conditions'),				
                
			];
			//creating the token to be used to verify the email address
            $token =base64_encode(mt_rand());
            $user_token = [
            'email' => $email,
            'token' => $token,
            'date_created' =>time()
            ];
            
            $this->db->insert('logistics',$data);
            $this->db->insert('user_token', $user_token);
            
            $this->_sendEmail($token,'logistics');
            $this->session->set_flashdata('message','<div class="alert alert-success role="alert">
				You have been registered successfully as a logistics service provider.please verify your account by clicking on the activation link that has been sent to your email.</div>');
				return redirect('logistics-service-provider');
            }
        }
        private function _sendEmail($token,$type){
            require_once APPPATH.'libraries/mailer/mailer_config.php';
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
            
            if($type == 'engineers'):
                $mail->addAddress($this->input->post('email'));
                $mail->Subject = 'Earl communications-Account Activation';
                $mail->isHTML(true);

                $mailContent ='
                    <!DOCTYPE html><html><head><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1"><meta http-equiv="X-UA-Compatible" content="IE=edge" /><style type="text/css">body,table,td,a{-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}table,td{mso-table-lspace:0pt;mso-table-rspace:0pt}img{-ms-interpolation-mode:bicubic}img{border:0;height:auto;line-height:100%;outline:none;text-decoration:none}table{border-collapse:collapse !important}body{height:100% !important;margin:0 !important;padding:0 !important;width:100% !important}a[x-apple-data-detectors]{color:inherit !important;text-decoration:none !important;font-size:inherit !important;font-family:inherit !important;font-weight:inherit !important;line-height:inherit !important}@media screen and (max-width:600px){h1{font-size:32px !important;line-height:32px !important}}div[style*="margin: 16px 0;"]{margin:0 !important}</style><style type="text/css"></style></head><body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;"><div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> Account verification</div><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td bgcolor="#f4f4f4" align="center"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> <a href="http://m.earlcommunications.com" > <img alt="Logo" src="http://m.earlcommunications.com/assets/frontend/img/earl.png" width="169" height="40" style="display: block; width: 169px; max-width: 169px; min-width: 169px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 18px;" border="0"> </a></td></tr></table></td></tr><tr><td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;"><h1 style="font-size: 28px; font-weight: 400; margin: 0; letter-spacing: 0px;">Verify your account</h1></td></tr></table></td></tr><tr><td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;">We\'re excited to have you get started as an engineer. First, you need to confirm your account. Just click the button below.</p></td></tr><tr><td bgcolor="#ffffff" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;"><table border="0" cellspacing="0" cellpadding="0"><tr><td align="center" style="border-radius: 3px;" > <a data-click-track-id="37" href=" '.base_url().'verify-engineer?email=' . $this->input->post('email') .'&token='.urlencode($token).'" style="margin-top: 36px; -ms-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%; color: #ffffff; font-family: -apple-system, BlinkMacSystemFont, sans-serif; font-size: 12px; font-smoothing: always; font-style: normal; font-weight: 600; letter-spacing: 0.7px; line-height: 48px; mso-line-height-rule: exactly; text-decoration: none; vertical-align: top; width: 220px;background-color:#ED502E; border-radius: 28px; display: block; text-align: center; text-transform: uppercase" target="_blank"> Activate account </a></tr></table></td></tr></table></td></tr><tr><td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;"></p><p style="margin: 0;">You can also reach us via our <a data-click-track-id="1053" href="https://m.earlcommunications.com/contact-us" style="font-weight: 500; color: #EEB31E" target="_blank">Help Center</a>.</p></td></tr><tr><td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;">Cheers, <br>The Earl communications Team</p></td></tr></table></td></tr><tr><td background-color="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#f4f4f4" align="left" style="padding: 30px 30px 30px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;"></td></tr></table></td></tr></table></body></html>
                ';
                $mail->Body = $mailContent;

                if(!$mail->send()):
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Your account activation has failed.</div>');
                    redirect('engineer');
                else:
                    $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">We\'ve sent an email to ' .$this->input->post('email').'.Open it up to activate your account.</div>');
                      redirect('engineer');
                endif;

            elseif($type == 'sales'):
                $mail->addAddress($this->input->post('email'));
                $mail->Subject = 'Earl communications-Account Activation';
                $mail->isHTML(true);
                $mailContent ='
                    <!DOCTYPE html><html><head><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1"><meta http-equiv="X-UA-Compatible" content="IE=edge" /><style type="text/css">body,table,td,a{-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}table,td{mso-table-lspace:0pt;mso-table-rspace:0pt}img{-ms-interpolation-mode:bicubic}img{border:0;height:auto;line-height:100%;outline:none;text-decoration:none}table{border-collapse:collapse !important}body{height:100% !important;margin:0 !important;padding:0 !important;width:100% !important}a[x-apple-data-detectors]{color:inherit !important;text-decoration:none !important;font-size:inherit !important;font-family:inherit !important;font-weight:inherit !important;line-height:inherit !important}@media screen and (max-width:600px){h1{font-size:32px !important;line-height:32px !important}}div[style*="margin: 16px 0;"]{margin:0 !important}</style><style type="text/css"></style></head><body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;"><div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> Account verification</div><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td bgcolor="#f4f4f4" align="center"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> <a href="http://m.earlcommunications.com" > <img alt="Logo" src="http://m.earlcommunications.com/assets/frontend/img/earl.png" width="169" height="40" style="display: block; width: 169px; max-width: 169px; min-width: 169px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 18px;" border="0"> </a></td></tr></table></td></tr><tr><td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;"><h1 style="font-size: 28px; font-weight: 400; margin: 0; letter-spacing: 0px;">Verify your account</h1></td></tr></table></td></tr><tr><td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;">We\'re excited to have you get started as a sales consultant. First, you need to confirm your account. Just click the button below.</p></td></tr><tr><td bgcolor="#ffffff" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;"><table border="0" cellspacing="0" cellpadding="0"><tr><td align="center" style="border-radius: 3px;" > <a data-click-track-id="37" href=" '.base_url().'verify-sale?email=' . $this->input->post('email') .'&token='.urlencode($token).'" style="margin-top: 36px; -ms-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%; color: #ffffff; font-family: -apple-system, BlinkMacSystemFont, sans-serif; font-size: 12px; font-smoothing: always; font-style: normal; font-weight: 600; letter-spacing: 0.7px; line-height: 48px; mso-line-height-rule: exactly; text-decoration: none; vertical-align: top; width: 220px;background-color:#ED502E; border-radius: 28px; display: block; text-align: center; text-transform: uppercase" target="_blank"> Activate account </a></tr></table></td></tr></table></td></tr><tr><td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;"></p><p style="margin: 0;">You can also reach us via our <a data-click-track-id="1053" href="https://m.earlcommunications.com/contact-us" style="font-weight: 500; color: #EEB31E" target="_blank">Help Center</a>.</p></td></tr><tr><td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;">Cheers, <br>The Earl communications Team</p></td></tr></table></td></tr><tr><td background-color="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#f4f4f4" align="left" style="padding: 30px 30px 30px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;"></td></tr></table></td></tr></table></body></html>
                ';
                $mail->Body = $mailContent;

                if(!$mail->send()):
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Your account activation has failed.</div>');
                    redirect('sales-consultant');
                else:
                    $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">We\'ve sent an email to ' .$this->input->post('email').'.Open it up to activate your account.</div>');
                    redirect('sales-consultant');
                endif;
            elseif($type == 'sellers'):
                    $mail->addAddress($this->input->post('email'));
                    $mail->Subject = 'Earl communications-Account Activation';
                    $mail->isHTML(true);
                    $mailContent ='
                    <!DOCTYPE html><html><head><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1"><meta http-equiv="X-UA-Compatible" content="IE=edge" /><style type="text/css">body,table,td,a{-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}table,td{mso-table-lspace:0pt;mso-table-rspace:0pt}img{-ms-interpolation-mode:bicubic}img{border:0;height:auto;line-height:100%;outline:none;text-decoration:none}table{border-collapse:collapse !important}body{height:100% !important;margin:0 !important;padding:0 !important;width:100% !important}a[x-apple-data-detectors]{color:inherit !important;text-decoration:none !important;font-size:inherit !important;font-family:inherit !important;font-weight:inherit !important;line-height:inherit !important}@media screen and (max-width:600px){h1{font-size:32px !important;line-height:32px !important}}div[style*="margin: 16px 0;"]{margin:0 !important}</style><style type="text/css"></style></head><body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;"><div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> Account verification</div><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td bgcolor="#f4f4f4" align="center"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> <a href="http://m.earlcommunications.com" > <img alt="Logo" src="http://m.earlcommunications.com/assets/frontend/img/earl.png" width="169" height="40" style="display: block; width: 169px; max-width: 169px; min-width: 169px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 18px;" border="0"> </a></td></tr></table></td></tr><tr><td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;"><h1 style="font-size: 28px; font-weight: 400; margin: 0; letter-spacing: 0px;">Verify your account</h1></td></tr></table></td></tr><tr><td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;">We\'re excited to have you get started as a seller. First, you need to confirm your account. Just click the button below.</p></td></tr><tr><td bgcolor="#ffffff" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;"><table border="0" cellspacing="0" cellpadding="0"><tr><td align="center" style="border-radius: 3px;" > <a data-click-track-id="37" href=" '.base_url().'verify-seller?email=' . $this->input->post('email') .'&token='.urlencode($token).'" style="margin-top: 36px; -ms-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%; color: #ffffff; font-family: -apple-system, BlinkMacSystemFont, sans-serif; font-size: 12px; font-smoothing: always; font-style: normal; font-weight: 600; letter-spacing: 0.7px; line-height: 48px; mso-line-height-rule: exactly; text-decoration: none; vertical-align: top; width: 220px;background-color:#ED502E; border-radius: 28px; display: block; text-align: center; text-transform: uppercase" target="_blank"> Activate account </a></tr></table></td></tr></table></td></tr><tr><td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;"></p><p style="margin: 0;">You can also reach us via our <a data-click-track-id="1053" href="https://m.earlcommunications.com/contact-us" style="font-weight: 500; color: #EEB31E" target="_blank">Help Center</a>.</p></td></tr><tr><td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;">Cheers, <br>The Earl communications Team</p></td></tr></table></td></tr><tr><td background-color="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#f4f4f4" align="left" style="padding: 30px 30px 30px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;"></td></tr></table></td></tr></table></body></html>
                ';
                    $mail->Body = $mailContent;
    
                if(!$mail->send()):
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Your account activation has failed.</div>');
                    redirect('seller');
                else:
                    $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">We\'ve sent an email to ' .$this->input->post('email').'.Please check your email to verify your account.</div>');
                    redirect('seller');
                endif;

                elseif($type == 'logistics'):
                    $mail->addAddress($this->input->post('email'));
                    $mail->Subject = 'Earl communications-Account Activation';
                    $mail->isHTML(true);
                    $mailContent ='
                    <!DOCTYPE html><html><head><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1"><meta http-equiv="X-UA-Compatible" content="IE=edge" /><style type="text/css">body,table,td,a{-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}table,td{mso-table-lspace:0pt;mso-table-rspace:0pt}img{-ms-interpolation-mode:bicubic}img{border:0;height:auto;line-height:100%;outline:none;text-decoration:none}table{border-collapse:collapse !important}body{height:100% !important;margin:0 !important;padding:0 !important;width:100% !important}a[x-apple-data-detectors]{color:inherit !important;text-decoration:none !important;font-size:inherit !important;font-family:inherit !important;font-weight:inherit !important;line-height:inherit !important}@media screen and (max-width:600px){h1{font-size:32px !important;line-height:32px !important}}div[style*="margin: 16px 0;"]{margin:0 !important}</style><style type="text/css"></style></head><body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;"><div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> Account verification</div><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td bgcolor="#f4f4f4" align="center"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> <a href="http://m.earlcommunications.com" > <img alt="Logo" src="http://m.earlcommunications.com/assets/frontend/img/earl.png" width="169" height="40" style="display: block; width: 169px; max-width: 169px; min-width: 169px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 18px;" border="0"> </a></td></tr></table></td></tr><tr><td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;"><h1 style="font-size: 28px; font-weight: 400; margin: 0; letter-spacing: 0px;">Verify your account</h1></td></tr></table></td></tr><tr><td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;">We\'re excited to have you get started as a logistics service provider. First, you need to confirm your account. Just click the button below.</p></td></tr><tr><td bgcolor="#ffffff" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;"><table border="0" cellspacing="0" cellpadding="0"><tr><td align="center" style="border-radius: 3px;" > <a data-click-track-id="37" href=" '.base_url().'verify-logistics?email=' . $this->input->post('email') .'&token='.urlencode($token).'" style="margin-top: 36px; -ms-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%; color: #ffffff; font-family: -apple-system, BlinkMacSystemFont, sans-serif; font-size: 12px; font-smoothing: always; font-style: normal; font-weight: 600; letter-spacing: 0.7px; line-height: 48px; mso-line-height-rule: exactly; text-decoration: none; vertical-align: top; width: 220px;background-color:#ED502E; border-radius: 28px; display: block; text-align: center; text-transform: uppercase" target="_blank"> Activate account </a></tr></table></td></tr></table></td></tr><tr><td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;"></p><p style="margin: 0;">You can also reach us via our <a data-click-track-id="1053" href="https://m.earlcommunications.com/contact-us" style="font-weight: 500; color: #EEB31E" target="_blank">Help Center</a>.</p></td></tr><tr><td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;">Cheers, <br>The Earl communications Team</p></td></tr></table></td></tr><tr><td background-color="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#f4f4f4" align="left" style="padding: 30px 30px 30px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;"></td></tr></table></td></tr></table></body></html>
                ';
                    $mail->Body = $mailContent;
    
                if(!$mail->send()):
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Your account activation has failed.</div>');
                    redirect('logistics-service-provider');
                else:
                    $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">We\'ve sent an email to ' .$this->input->post('email').'.Please check your email to verify your account.</div>');
                    redirect('logistics-service-provider');
                endif;        
            endif;
        }
        public function verifyengineer(){
            $email= $this ->input->get('email');
            $token =$this ->input->get('token');
            $user=$this ->db->get_where('engineers',['email' =>$email])->row_array();
            
            if($user){
            $user_token=$this ->db->get_where('user_token',['token' =>$token])->row_array();
                if( $user_token){
                    if(time() - $user_token['date_created'] < (60*60*24)){
                       $this->db->set('verify',1);
                       $this->db->where('email',$email);
                       $this->db->update('engineers');
                       
                        $this->db->delete('user_token',['email'=>$email]);
                        $this->session->set_flashdata('message','
                    <div class="alert alert-success" role="alert">'.$email.' has been verified.Thank you.</div>
                    ');
                     redirect('engineer');
                    }else{
                       $this->db->delete('user_token',['email'=>$email]);
                       
                       $this->session->set_flashdata('message','
                    <div class="alert alert-danger" role="alert">Token has expired.</div>
                    ');
                    redirect('engineer');
                    
                    }
                }else{
                $this->session->set_flashdata('message','
                <div class="alert alert-danger" role="alert">Your account verification has failed.</div>
                ');
                redirect('engineer');
                }
            }else{
                $this->session->set_flashdata('message','
                <div class="alert alert-danger" role="alert">Your account verification has failed.</div>
                ');
                redirect('engineer');
            }
    
        } 
        public function verifysales(){
            $email= $this ->input->get('email');
            $token =$this ->input->get('token');
            $user=$this ->db->get_where('sales',['email' =>$email])->row_array();
            
            if($user){
            $user_token=$this ->db->get_where('user_token',['token' =>$token])->row_array();
                if( $user_token){
                    if(time() - $user_token['date_created'] < (60*60*24)){
                       $this->db->set('verify',1);
                       $this->db->where('email',$email);
                       $this->db->update('sales');
                       
                        $this->db->delete('user_token',['email'=>$email]);
                        $this->session->set_flashdata('message','
                    <div class="alert alert-success" role="alert">'.$email.' has been verified.Thank you.</div>
                    ');
                     redirect('sales-consultant');
                    }else{
                       $this->db->delete('user_token',['email'=>$email]);
                       
                       $this->session->set_flashdata('message','
                    <div class="alert alert-danger" role="alert">Token has expired.</div>
                    ');
                    redirect('sales-consultant');
                    
                    }
                }else{
                $this->session->set_flashdata('message','
                <div class="alert alert-danger" role="alert">Your account verification has failed.</div>
                ');
                redirect('sales-consultant');
                }
            }else{
                $this->session->set_flashdata('message','
                <div class="alert alert-danger" role="alert">Your account verification has failed.</div>
                ');
                redirect('sales-consultant');
            }
    
        } 
        public function verifyseller(){
            $email= $this ->input->get('email');
            $token =$this ->input->get('token');
            $user=$this ->db->get_where('sellers',['email' =>$email])->row_array();
            
            if($user){
            $user_token=$this ->db->get_where('user_token',['token' =>$token])->row_array();
                if( $user_token){
                    if(time() - $user_token['date_created'] < (60*60*24)){
                       $this->db->set('verify',1);
                       $this->db->where('email',$email);
                       $this->db->update('sellers');
                       
                        $this->db->delete('user_token',['email'=>$email]);
                        $this->session->set_flashdata('message','
                    <div class="alert alert-success" role="alert">'.$email.' has been verified.Thank you.</div>
                    ');
                     redirect('seller');
                    }else{
                       $this->db->delete('user_token',['email'=>$email]);
                       
                       $this->session->set_flashdata('message','
                    <div class="alert alert-danger" role="alert">Token has expired.</div>
                    ');
                    redirect('seller');
                    
                    }
                }else{
                $this->session->set_flashdata('message','
                <div class="alert alert-danger" role="alert">Your account verification has failed.</div>
                ');
                redirect('seller');
                }
            }else{
                $this->session->set_flashdata('message','
                <div class="alert alert-danger" role="alert">Your account verification has failed.</div>
                ');
                redirect('seller');
            }
    
        }
        public function verifylogistics(){
            $email= $this ->input->get('email');
            $token =$this ->input->get('token');
            $user=$this ->db->get_where('logistics',['email' =>$email])->row_array();
            
            if($user){
            $user_token=$this ->db->get_where('user_token',['token' =>$token])->row_array();
                if( $user_token){
                    if(time() - $user_token['date_created'] < (60*60*24)){
                       $this->db->set('verify',1);
                       $this->db->where('email',$email);
                       $this->db->update('logistics');
                       
                        $this->db->delete('user_token',['email'=>$email]);
                        $this->session->set_flashdata('message','
                    <div class="alert alert-success" role="alert">'.$email.' has been verified.Thank you.</div>
                    ');
                     redirect('logistics-service-provider');
                    }else{
                       $this->db->delete('user_token',['email'=>$email]);
                       
                       $this->session->set_flashdata('message','
                    <div class="alert alert-danger" role="alert">Token has expired.</div>
                    ');
                    redirect('logistics-service-provider');
                    
                    }
                }else{
                $this->session->set_flashdata('message','
                <div class="alert alert-danger" role="alert">Your account verification has failed.</div>
                ');
                redirect('logistics-service-provider');
                }
            }else{
                $this->session->set_flashdata('message','
                <div class="alert alert-danger" role="alert">Your account verification has failed.</div>
                ');
                redirect('logistics-service-provider');
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

        public function phone_check($str){
            if (!preg_match('/^(?:256|\+256|0)?(7(?:(?:[0127589][0-9])|(?:0[0-8])|(4[0-1]))[0-9]{6})$/',$str)){
                $this->form_validation->set_message('phone_check', 'The phone number is invalid.');
                return FALSE;
            }else{
                return TRUE;
            }
        }
    }