<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Order extends CI_Controller{
        public function __construct(){
            parent::__construct();
            is_logged_in();
            $this->load->model('backend/Order_model');
            $this->load->helper('text');
           
        }

        public function index(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();
            $data['orders'] = $this->Order_model->orders();

            $this->load->view('templates/backend/header',$data);
            $this->load->view('templates/backend/sidebar');
            $this->load->view('backend/orders/orders',$data);
            
            $this->load->view('templates/backend/footer');
        }
        public function view($order_id){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $order = $this->Order_model->orderdetails_id($order_id);
            if (empty( $order)) :
                return redirect('admin/404');
            endif;

            $data['order_details'] =$this->Order_model->orderdetails_id($order_id);
            $data['customer'] = $this->Order_model->customerdetails_id($order->customer_id);
            $data['shipping'] = $this->Order_model->shippingdetails_id($order->shipping_id);
            $data['ordered'] = $this->Order_model->orderdetailsby_id($order->order_id);

            $this->load->view('templates/backend/header',$data);
            $this->load->view('templates/backend/sidebar');
            $this->load->view('backend/orders/view',$data);
            
            $this->load->view('templates/backend/footer');
        }
        public function confirm($order_id){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $order = $this->Order_model->orderdetails_id($order_id);
            if (empty( $order)) :
                return redirect('admin/404');
            endif;

            $data['order_details'] =$this->Order_model->orderdetails_id($order_id);
            $data['customer'] = $this->Order_model->customerdetails_id($order->customer_id);
            $data['shipping'] = $this->Order_model->shippingdetails_id($order->shipping_id);
            $data['ordered'] = $this->Order_model->orderdetailsby_id($order->order_id);

            $this->load->view('templates/backend/header',$data);
            $this->load->view('templates/backend/sidebar');
            $this->load->view('backend/orders/confirm-order',$data);
            
            $this->load->view('templates/backend/footer');
        }
        public function payment($order_id){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $order = $this->Order_model->orderdetails_id($order_id);
            if (empty( $order)) :
                return redirect('admin/404');
            endif;

            $data['order_details'] =$this->Order_model->orderdetails_id($order_id);
            $data['customer'] = $this->Order_model->customerdetails_id($order->customer_id);
            $data['shipping'] = $this->Order_model->shippingdetails_id($order->shipping_id);
            $data['ordered'] = $this->Order_model->orderdetailsby_id($order->order_id);

            $this->load->view('templates/backend/header',$data);
            $this->load->view('templates/backend/sidebar');
            $this->load->view('backend/orders/confirm-payment',$data);
            
            $this->load->view('templates/backend/footer');
        }
        public function received($order_id){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $order = $this->Order_model->orderdetails_id($order_id);
            if (empty( $order)) :
                return redirect('admin/404');
            endif;    
                $this->db->set('order_status','CONFIRMED');
                $this->db->where('order_id',$order_id);
                $this->db->update('orders');

                $this->_sendEmail('received',$order_id);
           
        }
        public function paid($order_id){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $order = $this->Order_model->orderdetails_id($order_id);
            
            if (empty( $order)) :
                return redirect('admin/404');
            endif;
              
                $this->db->set('payment_status','PAID');
                $this->db->where('payment_id',$order->payment_id);
                $this->db->update('payment');

                $this->_sendEmail('paid',$order_id);    
            
        }
        private function _sendEmail($type,$order_id){
            $order = $this->Order_model->orderdetails_id($order_id);
            $shipping = $this->Order_model->shippingdetails_id($order->shipping_id);
            $address=$shipping->email;
        
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
            
            if($type == 'received'):
                $mail->addAddress($address);
                $mail->Subject = 'Earl communications-Order Received';
                $mail->isHTML(true);

                $mailContent ='
                    <!DOCTYPE html><html><head><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1"><meta http-equiv="X-UA-Compatible" content="IE=edge" /><style type="text/css">body,table,td,a{-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}table,td{mso-table-lspace:0pt;mso-table-rspace:0pt}img{-ms-interpolation-mode:bicubic}img{border:0;height:auto;line-height:100%;outline:none;text-decoration:none}table{border-collapse:collapse !important}body{height:100% !important;margin:0 !important;padding:0 !important;width:100% !important}a[x-apple-data-detectors]{color:inherit !important;text-decoration:none !important;font-size:inherit !important;font-family:inherit !important;font-weight:inherit !important;line-height:inherit !important}@media screen and (max-width:600px){h1{font-size:32px !important;line-height:32px !important}}div[style*="margin: 16px 0;"]{margin:0 !important}</style><style type="text/css"></style></head><body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;"><div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> Account verification</div><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td bgcolor="#f4f4f4" align="center"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> <a href="http://m.earlcommunications.com" > <img alt="Logo" src="http://m.earlcommunications.com/assets/frontend/img/earl.png" width="169" height="40" style="display: block; width: 169px; max-width: 169px; min-width: 169px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 18px;" border="0"> </a></td></tr></table></td></tr><tr><td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;"><h1 style="font-size: 28px; font-weight: 400; margin: 0; letter-spacing: 0px;">Order Confirmation</h1></td></tr></table></td></tr><tr><td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;">Thank you for shopping with earl seqrity. Your order has been confirmed.</p></td></tr><tr><td bgcolor="#ffffff" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;"><table border="0" cellspacing="0" cellpadding="0"><tr><td align="center" style="border-radius: 3px;" ></tr></table></td></tr></table></td></tr><tr><td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;"></p><p style="margin: 0;">You can also reach us via our <a data-click-track-id="1053" href="https://m.earlcommunications.com/contact-us" style="font-weight: 500; color: #EEB31E" target="_blank">Help Center</a>.</p></td></tr><tr><td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;">Cheers, <br>The Earl communications Team</p></td></tr></table></td></tr><tr><td background-color="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#f4f4f4" align="left" style="padding: 30px 30px 30px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;"></td></tr></table></td></tr></table></body></html>
                ';
                $mail->Body = $mailContent;

                if(!$mail->send()):
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email has failed to send.'.$mail->ErrorInfo.'</div>');
                    redirect('admin/orders');
                else:
                    $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">An email has been sent to ' .$address.' confirming order.</div>');
                      redirect('admin/orders');
                endif;

            
                elseif($type == 'paid'):
                    $mail->addAddress($address);
                    $mail->Subject = 'Earl communications-Payment Received';
                    $mail->isHTML(true);
                    $mailContent ='
                    <!DOCTYPE html><html><head><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1"><meta http-equiv="X-UA-Compatible" content="IE=edge" /><style type="text/css">body,table,td,a{-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}table,td{mso-table-lspace:0pt;mso-table-rspace:0pt}img{-ms-interpolation-mode:bicubic}img{border:0;height:auto;line-height:100%;outline:none;text-decoration:none}table{border-collapse:collapse !important}body{height:100% !important;margin:0 !important;padding:0 !important;width:100% !important}a[x-apple-data-detectors]{color:inherit !important;text-decoration:none !important;font-size:inherit !important;font-family:inherit !important;font-weight:inherit !important;line-height:inherit !important}@media screen and (max-width:600px){h1{font-size:32px !important;line-height:32px !important}}div[style*="margin: 16px 0;"]{margin:0 !important}</style><style type="text/css"></style></head><body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;"><div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> Account verification</div><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td bgcolor="#f4f4f4" align="center"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> <a href="http://m.earlcommunications.com" > <img alt="Logo" src="http://m.earlcommunications.com/assets/frontend/img/earl.png" width="169" height="40" style="display: block; width: 169px; max-width: 169px; min-width: 169px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 18px;" border="0"> </a></td></tr></table></td></tr><tr><td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;"><h1 style="font-size: 28px; font-weight: 400; margin: 0; letter-spacing: 0px;">Payment Confirmation</h1></td></tr></table></td></tr><tr><td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;">Thank you for shopping with earl seqrity. Your payment has been confirmed.</p></td></tr><tr><td bgcolor="#ffffff" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;"><table border="0" cellspacing="0" cellpadding="0"><tr><td align="center" style="border-radius: 3px;" ></tr></table></td></tr></table></td></tr><tr><td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;"></p><p style="margin: 0;">You can also reach us via our <a data-click-track-id="1053" href="https://m.earlcommunications.com/contact-us" style="font-weight: 500; color: #EEB31E" target="_blank">Help Center</a>.</p></td></tr><tr><td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;"><p style="margin: 0;">Cheers, <br>The Earl communications Team</p></td></tr></table></td></tr><tr><td background-color="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#f4f4f4" align="left" style="padding: 30px 30px 30px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;"></td></tr></table></td></tr></table></body></html>
                ';
                    $mail->Body = $mailContent;
    
                    if(!$mail->send()):
                        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email has failed to send.</div>');
                        redirect('admin/orders');
                    else:
                        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">An email has been sent  to ' .$address.' confirming payment.</div>');
                        redirect('admin/orders');
                    endif;
            endif;
            
        }  
    }