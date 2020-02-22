<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends CI_Model {
    public function search($search_string){
        $search_string = '%' . $search_string . '%';
        $sql = "SELECT *
                FROM products 
                INNER JOIN categories ON categories.catid  = products.catid 
                INNER JOIN brands ON brands.brandid = products.brandid
                INNER JOIN subcategories ON subcategories.subid = products.subid
                WHERE products.product like ?
                OR categories.category like ?
                OR brands.brand like ?
                OR subcategories.subcategory like ?
                ORDER BY products.id DESC";
                $query = $this->db->query($sql,array($search_string,$search_string,$search_string,$search_string));
                return $query->result_array();
    }
    public function search_total($search_string){
        $search_string = '%' . $search_string . '%';
        $sql = "SELECT * 
                FROM products p
                JOIN categories c 
                ON p.catid = c.catid
                JOIN brands b 
                ON p.brandid = b.brandid
                WHERE p.product like ? OR p.description like ?
                ORDER BY p.id DESC";
        $query = $this->db->query($sql,array($search_string,$search_string));
        return $query->num_rows();
    }
}