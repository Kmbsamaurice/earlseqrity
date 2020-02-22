<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    class Brand_model extends CI_Model{
        public function get_brands($slug = FALSE){
             $this->db->limit(2);
        	if($slug  === FALSE):
        		$query  = $this->db->get('brands');
        		return $query->result_array();
        	endif;
        	$query =  $this->db->get_where('brands',array('slug'=>$slug));
        	return $query->row_array();
        }
        public function product($slug = FALSE){
            $this->db->join('products', 'products.brandid = brands.brandid');
            $this->db->limit(2);
        	if($slug  === FALSE):
        		$query  = $this->db->get('brands');
        		return $query->result_array();
        	endif;
        	$query =  $this->db->get_where('brands',array('brands.slug'=>$slug));
        	return $query->row_array();
        }
        public function newproduct($slug = FALSE){
            $this->db->join('products', 'products.brandid = brands.brandid');
            $this->db->limit(2);
            $this->db->order_by('brands.brandid', 'DESC');
        	if($slug  === FALSE):
        		$query  = $this->db->get('brands');
        		return $query->result_array();
        	endif;
        	$query =  $this->db->get_where('brands',array('brands.slug'=>$slug));
        	return $query->row_array();
        }
        public function all_brands($slug = FALSE){
        	if($slug  === FALSE):
        		$query  = $this->db->get('brands');
        		return $query->result_array();
        	endif;
        	$query =  $this->db->get_where('brands',array('slug'=>$slug));
        	return $query->row_array();
        }
        
        public function new_brands($slug = FALSE){
            $this->db->limit(2);
        	$this->db->order_by('brandid', 'DESC');
        	if($slug  === FALSE):
        		$query  = $this->db->get('brands');
        		return $query->result_array();
        	endif;
        	$query =  $this->db->get_where('brands',array('slug'=>$slug));
        	return $query->row_array();
        }
        public function front_brands($slug = FALSE){
            $this->db->join('products', 'products.brandid = brands.brandid');
            $this->db->limit(2);
            if($slug  === FALSE):
        		$query  = $this->db->get('brands');
        		return $query->result_array();
        	endif;
        	$query =  $this->db->get_where('brands',array('brands.slug'=>$slug));
        	return $query->result_array();
        }
        public function brand($slug){
        	$query =  $this->db->get_where('brands',array('slug'=>$slug));
        	return $query->row_array();
        }
        public function brandsList(){
            $this->db->select(array('b.brandid', 'b.brand', 'b.slug', 'b.icon','b.date_created'));
            $this->db->from('brands b');  
            $this->db->order_by('b.brandid', 'DESC');     
            $query = $this->db->get();
            return $query->result_array();
        }
        public function list(){
            $this->db->select(array('b.brandid', 'b.brand', 'b.icon','b.date_created'));
            $this->db->from('brands b');  
            $this->db->order_by('b.brandid', 'DESC');     
            $query = $this->db->get();
            return $query->result_array();
        }
        public function save($image,$slug){
            $data =array(
                'brand' =>$this->input->post('brand'),
                'slug' =>$slug,
                'icon' =>$image
            );
            return $this->db->insert('brands',$data);
            
        }
        public function brandList(){
            $query = $this->db->get('brands');
            $return =array();
    
            foreach($query->result() as $brand):
                $return[$brand->brandid] = $brand;
                $return[$brand->brandid]->products = $this->getproducts($brand->brandid);
            endforeach;
            return $return;
           
        }
        //get the prodcuts to be able to call them to the brandList method
        public function getproducts($brandid){
            $this->db->where('brandid',$brandid);
            $query=$this->db->get('products');
            return $query->result();
        }
        public function getbrand($brandid){
            $this->db->from('brands');
            $this->db->where('brandid', $brandid);
            $result = $this->db->get('');
            
            if ($result->num_rows() > 0) {
              return $result->row();
            }
        }
        public function deletebrand($brandid){
            $this->db->where('brandid',$brandid);
            $this->db->delete('brands',array('brandid'=>$brandid));
            return TRUE;
        }
            //count the number of brands in the table brands
        public function countbrands(){
            $this->db->from('brands');
            return $count = $this->db->count_all_results();
        }
    }