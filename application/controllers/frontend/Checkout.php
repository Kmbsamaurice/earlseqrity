<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	class Checkout extends CI_Controller
	{
		public function __construct(){
			parent::__construct();
			$this->load->helper('text');
            $this->load->model('frontend/Checkout_model');
            $this->load->model('backend/Order_model');
            $this->load->model('backend/Category_model');

        }
        public function shippingdetails(){
            $this->form_validation->set_rules('firstname','First name','required|trim|min_length[3]');
            $this->form_validation->set_rules('lastname','Last name','required|trim');
            $this->form_validation->set_rules('address','Address','required|trim');
            $this->form_validation->set_rules('phone','Phone number','required|callback_phone_check'
            );
            $this->form_validation->set_rules('email','Email Address','required|trim|valid_email');

            $email=$this->input->post('email');
            $data['category'] = $this->Category_model->getcategories(); 
            
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();

            if($this->form_validation->run() == FALSE):
                $this ->load->view('frontend/checkout/check-out',$data);
                $this ->load->view('templates/frontend/jsfooter');
                
            else:
            $data = [
                'first_name' => $this->input->post('firstname'),
                'last_name' => $this->input->post('lastname'),
                'address' => $this->input->post('address'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
            ];
            $shipping_id =$this->Checkout_model->save($data);

            $sdata= array();
            $sdata['shipping_id'] = $shipping_id;
            $this->session->set_userdata($sdata);
            
            $this->session->set_flashdata('message','<div class="alert alert-success role="alert">
             Please choose a payment method to complete your order.</div>');
            return redirect('payment');
            endif;
        }
        public function payment(){
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();
            $data['category'] = $this->Category_model->getcategories(); 

            $this ->load->view('frontend/checkout/payment',$data);
            $this ->load->view('templates/frontend/jsfooter');
        }
        public function paymentdetails(){
            
            $data= array();
            $data['payment_method'] = $this->input->post('payment_method');
            if(!empty( $data['payment_method'])):
                $payment_id =$this->Checkout_model->savepayment($data);

                $sdata= array();
                $sdata['payment_id'] = $payment_id;
                $this->session->set_userdata($sdata);

                $odata= array();
                $odata['customer_id'] =$this->session->userdata('id');
                $odata['shipping_id'] =$this->session->userdata('shipping_id');
                $odata['payment_id'] =$this->session->userdata('payment_id');
                $odata['order_total'] =$this->session->userdata('total');

                $order_id =$this->Checkout_model->saveorder($odata);
                $contents = $this->cart->contents();

                /*$this->session->unset_userdata('id');
                $this->session->unset_userdata('shipping_id');
                $this->session->unset_userdata('payment_id');*/

                $order_data =array();
                    foreach($contents as $row):
                        $order_data['order_id'] = $order_id;
                        $order_data['product_id'] =$row['id'];
                        $order_data['product'] =$row['name'];
                        $order_data['price'] =$row['price'];
                        $order_data['sold_quantity'] =$row['qty'];
                        $order_details_id = $this->Checkout_model->saveorderdetails($order_data);
                    endforeach;
                $this->cart->destroy();
                $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
                Your Order has been sent successfully.We shall contact you soon with the delivery details.</div>');
                return redirect('confirm-order/'.$order_id);    
            else:
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                    Please choose a payment method.</div>');
                    return redirect('payment');
            endif;
        }
        public function confirmorder($order_id){
            $data['customer'] = $this->db->get_where('customers',['email'=>
            $this->session->userdata('email')])->row_array();
            
            $data['category'] = $this->Category_model->getcategories();
            $this ->load->view('templates/frontend/header',$data);
            $order = $this->Order_model->orderdetails_id($order_id);
            if (empty( $order)) :
                return redirect('cart');
            endif;

            $data['order_details'] =$this->Order_model->orderdetails_id($order_id);
            $data['customer'] = $this->Order_model->customerdetails_id($order->customer_id);
            $data['shipping'] = $this->Order_model->shippingdetails_id($order->shipping_id);
            $data['ordered'] = $this->Order_model->orderdetailsby_id($order->order_id);

            $this ->load->view('frontend/checkout/confirm-order',$data);
            $this ->load->view('templates/frontend/footer');
        }
        public function phone_check($str){
            if (!preg_match('/^(?:256|\+256|0)?(7(?:(?:[0127589][0-9])|(?:0[0-8])|(4[0-1]))[0-9]{6})$/',$str)){
                $this->form_validation->set_message('phone_check', 'The phone number is invalid.');
                return FALSE;
            }else{
                return TRUE;
            }
        }
        public function c_check($str)
        {
        if (!preg_match('/^[a-zA-Z0-9&-. ]*$/', $str)) {
            $this->form_validation->set_message('c_check', 'This address is invalid.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    }