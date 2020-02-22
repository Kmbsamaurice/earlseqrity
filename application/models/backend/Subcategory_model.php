<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Subcategory_model extends CI_Model{
        public function get_subcategories($slug = FALSE){
            $this->db->select('subcategories.*,categories.category');
            $this->db->join('categories', 'subcategories.catid = categories.catid');
            if($slug  === FALSE):
        		$query  = $this->db->get('subcategories');
        		return $query->result_array();
        	endif;
        	$query =  $this->db->get_where('subcategories',array('subcategories.slug'=>$slug));
        	return $query->row_array();
        }
        public function front_subcategories($slug = FALSE){
            $this->db->join('products', 'products.subid = subcategories.subid');
            if($slug  === FALSE):
        		$query  = $this->db->get('subcategories');
        		return $query->result_array();
        	endif;
        	$query =  $this->db->get_where('subcategories',array('subcategories.slug'=>$slug));
        	return $query->result_array();
        }
        public function sub($slug){
        	$query =  $this->db->get_where('subcategories',array('subcategories.slug'=>$slug));
        	return $query->row_array();
        }
        public function subcategoriesList(){
            $this->db->select(array('s.subid', 's.subcategory', 's.slug', 's.catid','s.date_created'));
            $this->db->from('subcategories s');
            $this->db->order_by('s.subid', 'DESC');     
            $query = $this->db->get();
            return $query->result_array();
        }
        public function list($slug = FALSE){
            $this->db->join('categories', 'subcategories.catid = categories.catid');

        	$query =  $this->db->get_where('subcategories',array('subcategories.slug'=>$slug));
        	return $query->row_array();

        }
        public function subcategory(){
            $this->db->select('*');    
            $this->db->from('products');
            $this->db->join('categories', 'products.catid = categories.catid');
            $this->db->join('subcategories', 'products.subid = subcategories.subid');
            $this->db->join('brands', 'products.brandid = brands.brandid');
   
            $query = $this->db->get();
           return $query->row_array();
        }
       public function save($slug){
        $data =array(
            'subcategory' =>$this->input->post('subcategory'),
            'catid' =>$this->input->post('category'),
            'slug' =>$slug,
            
        );
        return $this->db->insert('subcategories',$data);
        
    }
    public function getsubcategory($subid){
        $this->db->from('subcategories');
        $this->db->where('subid', $subid);
        $result = $this->db->get('');
        
        if ($result->num_rows() > 0) {
          return $result->row();
        }
    }
    public function deletesubcategory($subid){
        $this->db->where('subid',$subid);
        $this->db->delete('subcategories',array('subid'=>$subid));
        return TRUE;
    }
       //count the number of subcategories in the table subcategories
       public function countsubcategories(){
           $this->db->from('subcategories');
           return $count = $this->db->count_all_results();
       }
    }