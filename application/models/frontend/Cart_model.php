<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Cart_model extends CI_Model{
        public function productbyid($id){
            $productinfo =$this->db->select('*')
                ->from('products')
                ->where('id',$id)
                ->get()->row();
            return $productinfo;                
        }

    }