<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Category_model extends CI_Model{
        public function get_categories($slug = FALSE){
            if($slug  === FALSE):
        		$query  = $this->db->get('categories');
        		return $query->result_array();
        	endif;
        	$query =  $this->db->get_where('categories',array('slug'=>$slug));
        	return $query->row_array();
        }
        public function front_categories($slug = FALSE){
            $this->db->join('products', 'products.catid = categories.catid');
            if($slug  === FALSE):
        		$query  = $this->db->get('categories');
        		return $query->result_array();
        	endif;
        	$query =  $this->db->get_where('categories',array('categories.slug'=>$slug));
        	return $query->result_array();
        }
       
        public function cat($slug){
        	$query =  $this->db->get_where('categories',array('slug'=>$slug));
        	return $query->row_array();
        }
        public function categoriesList(){
            $this->db->select(array('c.catid', 'c.category', 'c.slug', 'c.tagline', 'c.icon','c.date_created'));
            $this->db->from('categories c');
            $this->db->join('subcategories', 'c.catid = subcategories.catid');
            $this->db->order_by('c.catid', 'DESC');     
            $query = $this->db->get();
            return $query->result_array();
        }
        public function category(){
            $this->db->select(array('c.catid', 'c.category', 'c.slug', 'c.tagline', 'c.icon','c.date_created'));
            $this->db->from('categories c');
            $this->db->order_by('c.catid', 'ASC');     
            $query = $this->db->get();
            return $query->result_array();
        }
        public function list(){
            $this->db->select('categories.*');
            $this->db->from('categories');
            $this->db->join('products','products.catid = categories.catid');
            $query = $this->db->get();
            return $query->result_array();
        }
        public function save($image,$slug){
            $data =array(
                'category' =>$this->input->post('category'),
                'tagline' =>$this->input->post('tagline'),
                'slug' =>$slug,
                'icon' =>$image
            );
            return $this->db->insert('categories',$data);
            
        }
        public function getcategories(){
            $query = $this->db->get('categories');
            $return = array();
        
            foreach ($query->result() as $category):
                $return[$category->catid] = $category;
                $return[$category->catid]->subcat = $this->getsubcategories($category->catid); // Get the categories sub categories
            endforeach;
        
            return $return;
        }
        public function getsubcategories($catid){
            $this->db->where('catid', $catid);
            $query = $this->db->get('subcategories');
            return $query->result();
        }
        public function getcategory($catid){
            $this->db->from('categories');
            $this->db->where('catid', $catid);
            $result = $this->db->get('');
            
            if ($result->num_rows() > 0) {
              return $result->row();
            }
        }
        public function deletecategory($catid){
            $this->db->where('catid',$catid);
            $this->db->delete('categories',array('catid'=>$catid));
            return TRUE;
        }
        public function countcategories(){
            $this->db->from('categories');
            return $count = $this->db->count_all_results();
        }
    }