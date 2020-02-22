<?php
    class Cart extends CI_Controller{
    	public function __construct(){
            parent::__construct();
            $this->load->helper('text');
            $this->load->model('backend/Category_model');
            $this->load->model('backend/Subcategory_model');
            $this->load->model('backend/Brand_model');
            $this->load->model('backend/Product_model');
            $this->load->model('frontend/Cart_model');
        }
        public function add(){
			$qty =$this->input->post('quantity');
			$id =$this->input->post('id');
			$productinfo= $this->Cart_model->productbyid($id);

		$data =array(
			'id' =>$productinfo->id,
			'qty' =>$qty,
			'price' =>$productinfo->price,
			'name' =>$productinfo->product,
			'options' =>array('image1' =>$productinfo->image1),
		);
		
		$this->cart->insert($data);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">'.$productinfo->product. ' has been added to cart.</div>');
		return redirect('details/'.$productinfo->slug);
        }
        public function details(){
			$data['customer'] = $this->db->get_where('customers',['email'=>
			$this->session->userdata('email')])->row_array();
			
            $data['pinfo'] = $this->Product_model->products_List();
            $data['catinfo'] =$this->Category_model->categoriesList();
            $data['brandinfo'] =$this->Brand_model->brandsList();
            $data['category'] = $this->Category_model->getcategories();
            
			$this->load->view('frontend/shopping-cart',$data);
			
			$data['category'] ='';
			$data['brand'] ='';
			$data['price'] ='';
			$this->load->view('templates/frontend/jsfooter');
		}
		
		public function updatecart($row_id){
			$qty =$this->input->post('qty');
			$row_id =$this->input->post('rowid');
			$data =array(
				'rowid' =>$row_id,
				'qty' =>$qty
			);
			$this->cart->update($data);
			redirect('cart');
		}
		public function delete($row_id){
			
			$data =array(
				'rowid' =>$row_id,
				'qty' => 0
			);
			$this->cart->update($data);
			redirect('cart');
		}
    }