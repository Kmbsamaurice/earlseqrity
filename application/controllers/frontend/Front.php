<?php
    class Front extends CI_Controller{
    	public function __construct(){
            parent::__construct();
            $this->load->helper('text');
            $this->load->model('backend/Category_model');
            $this->load->model('backend/Subcategory_model');
            $this->load->model('backend/Brand_model');
            $this->load->model('backend/Product_model');
            $this->load->model('frontend/Search_model');
            $this->load->model('frontend/Wishlist_model');
            
            
        }
        public function error404(){
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();

            $data['category'] = $this->Category_model->getcategories();
            $this ->load->view('frontend/404',$data);
            $this ->load->view('templates/frontend/jsfooter');
        }
        public function wishlist(){
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();
            
            $data['category'] = $this->Category_model->getcategories();
            $data['product'] = $this->Wishlist_model->get_lists();
            if(! $data['customer']):
                $this->session->set_flashdata('message','<div class="alert alert-danger role="alert">
                Please login to view your wishlist.</div>');
                 return redirect('wishlist/sign-in');
            endif;
          
            $this ->load->view('frontend/wishlist',$data);
            $this ->load->view('templates/frontend/jsfooter');
        }
        public function addwish(){
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();

            $id =$this->input->post('id');
            $customer_id =$data['customer']['id']; 
            $productinfo= $this->Wishlist_model->productbyid($id);

            $product_id = $productinfo->id;
            if(! $data['customer']):
                $this->session->set_flashdata('message','<div class="alert alert-danger role="alert">
                Please login to view your wishlist.</div>');
                 return redirect('sign-in');
            endif;
            $data =array(
                'product_id' =>$productinfo->id,
                'customer_id' => $customer_id,
            );
            
            if(!$this->Wishlist_model->wish_exists($product_id)):
                $this->db->insert('wishlist',$data);
                $this->session->set_flashdata('message','<div class="alert alert-success role="alert">
                '.$productinfo->product. ' has been added to your wishlist.</div>');
                    return redirect('wishlist');
            else:
                $this->session->set_flashdata('message','<div class="alert alert-danger role="alert">
                '.$productinfo->product. ' has already been added to your wishlist.</div>');
                    return redirect('wishlist');
            endif;        
        }
        public function deletewish($product_id){
            if ($this->Wishlist_model->deleteproduct($product_id)) :
                $this->session->set_flashdata('message', '<div class="alert alert-success role="alert">
                    The product has been deleted successfully.</div>');
                redirect('wishlist');
            endif;
        }
        public function category($slug){
            
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();

            $data['cat'] = $this->Category_model->front_categories($slug);
            if (empty($data['cat'])) :
                return redirect('404');
            endif;
            $data['fetch'] = $this->Category_model->cat($slug);
            $data['category'] = $this->Category_model->getcategories();
            $this ->load->view('frontend/category',$data);
            $this ->load->view('templates/frontend/jsfooter');
        }
        public function subcategory($slug){
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();

            $data['subcategory'] = $this->Subcategory_model->front_subcategories($slug);
            if (empty($data['subcategory'])) :
                return redirect('404');
            endif;
            $data['fetch'] = $this->Subcategory_model->sub($slug);
            $data['category'] = $this->Category_model->getcategories();
            $this ->load->view('frontend/subcategory',$data);
            $this ->load->view('templates/frontend/jsfooter');
        }
        public function brand($slug){
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();

            $data['brand'] = $this->Brand_model->front_brands($slug);
            if (empty($data['brand'])) :
                return redirect('404');
            endif;
            $data['fetch'] = $this->Brand_model->brand($slug);
            $data['category'] = $this->Category_model->getcategories();
            $this ->load->view('frontend/brand',$data);
            $this ->load->view('templates/frontend/jsfooter');
        }
        public function getBrands($offset = 0){
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();

            $config['base_url'] = base_url().'all-brands';
            $config['total_rows'] = $this->db->count_all('brands');
            $config['per_page'] = 2;
            $config['uri_segment'] = 2;
            $config['attributes']=array('class'=>'pagination');
            
            $this->pagination->initialize($config);

           $data['brand'] = $this->Brand_model->all_brands(FALSE,$config['per_page'],$offset);
            if(!$data['brand']):
                return redirect('all-brands');
            endif;
            
            $data['links']  = $this->pagination->create_links();
            //$data['brand'] = $this->Brand_model->get_brands();
            $data['category'] = $this->Category_model->getcategories();
            $this ->load->view('frontend/all-brands',$data);
            $this ->load->view('templates/frontend/jsfooter');
        }
        public function newproducts(){
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();

            $data['brand'] = $this->Brand_model->get_brands();
            $data['category'] = $this->Category_model->getcategories();
            $data['product'] = $this->Product_model->newproducts();
            $this ->load->view('frontend/new-products',$data);
            $this ->load->view('templates/frontend/jsfooter');
        }
         public function brands(){
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();

            $data['brand'] = $this->Brand_model->get_brands();
            $data['product'] = $this->Brand_model->product();
            $data['newproduct'] = $this->Brand_model->newproduct();
            $data['new'] = $this->Brand_model->new_brands();
            $data['category'] = $this->Category_model->getcategories();
            $this ->load->view('frontend/brands',$data);
            $this ->load->view('templates/frontend/jsfooter');
        }
        public function engineers(){
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();

            /*$data['brand'] = $this->Brand_model->front_brands($slug);
            if (empty($data['brand'])) :
                return redirect('404');
            endif;*/
            $data['category'] = $this->Category_model->getcategories();
            $this ->load->view('frontend/engineers',$data);
            $this ->load->view('templates/frontend/jsfooter');
        }
        public function hire(){
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();

            /*$data['brand'] = $this->Brand_model->front_brands($slug);
            if (empty($data['brand'])) :
                return redirect('404');
            endif;
            $data['fetch'] = $this->Brand_model->brand($slug);*/
            $data['category'] = $this->Category_model->getcategories();
            $this ->load->view('frontend/hire-engineer',$data);
            $this ->load->view('templates/frontend/jsfooter');
        }
        public function profile(){
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();

            /*$data['brand'] = $this->Brand_model->front_brands($slug);
            if (empty($data['brand'])) :
                return redirect('404');
            endif;
            $data['fetch'] = $this->Brand_model->brand($slug);*/
            $data['category'] = $this->Category_model->getcategories();
            $this ->load->view('frontend/engineer-profile',$data);
            $this ->load->view('templates/frontend/jsfooter');
        }
         public function orders(){
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();

            /*$data['brand'] = $this->Brand_model->front_brands($slug);
            if (empty($data['brand'])) :
                return redirect('404');
            endif;
            $data['fetch'] = $this->Brand_model->brand($slug);*/
            $data['category'] = $this->Category_model->getcategories();
            $this ->load->view('frontend/my-orders',$data);
            $this ->load->view('templates/frontend/jsfooter');
        }
        public function details($slug){
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();

            $data['product'] = $this->Product_model->get_products($slug);
            if (empty($data['product'])) :
                return redirect('404');
            endif;
            $data['details'] = $this->Wishlist_model->get_lists();
            $data['category'] = $this->Category_model->getcategories();
            $this ->load->view('frontend/product',$data);
            $this ->load->view('templates/frontend/jsfooter');
        }
        public function search(){
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();
                if(!isset($_POST['search_string']) || empty($_POST['search_string'])):
                    redirect('/');
                endif;
            if(isset($_POST['search_string']) || empty($_POST['search_string'])):
                $data['category'] = $this->Category_model->getcategories();
                $search_string = trim($this->input->post('search_string', TRUE));


                $data['search_string'] = $_POST['search_string'];
				$data['result'] = $this->Search_model->search($search_string);
                $data['total'] = $this->Search_model->search_total($search_string);
                
                $this ->load->view('frontend/search',$data);
                $this ->load->view('templates/frontend/jsfooter');
            else :
                $this->session->set_flashdata('message','<div class="alert alert-danger role="alert">
				There were no search results found for '.$search_string.'.</div>');
                redirect(base_url('search'));

            endif ;   
        }
        public function contact(){
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();
            
            $this->form_validation->set_rules('name','Name','required|trim|min_length[3]|callback_name_check');
            //$this->form_validation->set_rules('subject','subject','required|trim');
			$this->form_validation->set_rules('email','Email Adress','required|trim|valid_email');
			$this->form_validation->set_rules('phone','Phone number','required|trim|callback_phone_check');
            $this->form_validation->set_rules('message','Message','required|trim');

            if($this->form_validation->run() == FALSE){
            $this ->load->view('frontend/contact-us',$data);
            $this ->load->view('templates/frontend/jsfooter');

            }else{
                $data = [
                'name' => $this->input->post('name'),
                'subject' => $this->input->post('subject'),
				'email' => $this->input->post('email'),
                'message' => $this->input->post('message'),
                'status' =>0,				
                'phone' => $this->input->post('phone'),
			];
			$this->db->insert('messages',$data);
            $this->session->set_flashdata('message','<div class="alert alert-success role="alert">
				Your message has been sent successfully.we\'ll shall be in touch soon.</div>');
				return redirect('contact-us');
            }
        }
         public function earn(){
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();

            $data['category'] = $this->Category_model->getcategories();
            $this ->load->view('frontend/earn-with-us',$data);
            $this ->load->view('templates/frontend/jsfooter');
        }
       
        public function quotation(){
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();
            
            $this->form_validation->set_rules('name','Name','required|trim|min_length[3]|callback_name_check');
            //$this->form_validation->set_rules('subject','subject','required|trim');
			$this->form_validation->set_rules('email','Email Adress','required|trim|valid_email');
            $this->form_validation->set_rules('phone','Phone number','required|trim|callback_phone_check');
            $this->form_validation->set_rules('project','Project','required|trim|callback_project_check');
            $this->form_validation->set_rules('details','Description','required|trim');

            if($this->form_validation->run() == FALSE){
            $data['category'] = $this->Category_model->getcategories();    
            $this ->load->view('frontend/get-quotation',$data);
            $this ->load->view('templates/frontend/jsfooter');

            }else{
                $data = [
                'name' => $this->input->post('name'),
                'project' => $this->input->post('project'),
				'email' => $this->input->post('email'),
                'details' => $this->input->post('details'),
                'status' =>0,				
                'phone' => $this->input->post('phone'),
			];
			$this->db->insert('quotations',$data);
            $this->session->set_flashdata('message','<div class="alert alert-success role="alert">
				Your quotation has been sent successfully.we\'ll shall be in touch soon.</div>');
				return redirect('get-quotation');
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
        public function name_check($str){
            if (!preg_match('/^[a-zA-Z ]*$/',$str)){
                $this->form_validation->set_message('name_check', 'This name appears to be invalid.');
            return FALSE;    
                }else{
            return TRUE;    
            }
        }
        public function project_check($str){
            if (!preg_match('/^[a-zA-Z0-9&-. ]*$/',$str)){
                $this->form_validation->set_message('project_check', 'The project name appears to be invalid.');
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