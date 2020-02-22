<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_model extends CI_Model
{
    public function get_products($slug = FALSE)
    {
        $this->db->select('products.*,brands.brand,subcategories.subcategory,categories.category');
        $this->db->join('categories', 'products.catid = categories.catid');
        $this->db->join('subcategories', 'products.subid = subcategories.subid');
        $this->db->join('brands', 'products.brandid = brands.brandid');
        if ($slug  === FALSE) :
            $query  = $this->db->get('products');
            return $query->result_array();
        endif;
        $query =  $this->db->get_where('products', array('products.slug' => $slug));
        return $query->row_array();
    }
    // get product List from the table products for the frontend and backend table
    public function productsList()
    {
        $this->db->select(array(
            'p.id', 'p.catid', 'p.subid', 'p.brandid', 'p.product', 'p.price', 'p.new_price', 'p.quantity', 'p.description', 'p.status', 'p.slug', 'p.image1', 'p.image2', 'p.image3'
        ));
        $this->db->from('products p');
        $this->db->order_by('p.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function productList()
    {
        $this->db->select('products.*,subcategories.subid');
        $this->db->from('products');
        $this->db->join('subcategories', 'products.subid = subcategories.subid');
        $this->db->order_by('products.subid', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function save($data, $slug)
    {
        $data = array(
            'catid' => $this->input->post('catid'),
            'subid' => $this->input->post('subid'),
            'brandid' => $this->input->post('brandid'),
            'product' => $this->input->post('product'),
            'price' => $this->input->post('price'),
            'new_price' => $this->input->post('new_price'),
            'quantity' => $this->input->post('quantity'),
            'description' => $this->input->post('description'),
            'status' => 1,
            'slug' => $slug,
            'image1' => $data['userfile'],
            'image2' => $data['userfile1'],
            'image3' => $data['userfile2'],
        );
        return $this->db->insert('products', $data);
    }
    public function getproduct($id)
    {
        $this->db->from('products');
        $this->db->where('id', $id);
        $result = $this->db->get('');

        if ($result->num_rows() > 0) {
            return $result->row();
        }
    }

    public function deleteproduct($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('products', array('id' => $id));
        return TRUE;
    }
    //count the number of products in the table products
    public function countproducts()
    {
        $this->db->from('products');
        return $count = $this->db->count_all_results();
    }
    // for display products from the table products
    public function products_List()
    {
        $this->db->select('products.*,categories.category,subcategories.subcategory,brands.brand');
        $this->db->from('products');
        $this->db->join('categories', 'products.catid = categories.catid');
        $this->db->join('subcategories', 'products.subid = subcategories.subid');
        $this->db->join('brands', 'products.brandid = brands.brandid');
        $query = $this->db->get();
        return $query->result_array();
    }
    // for display newproducts from the table products
    public function newproducts()
    {
        $this->db->select('products.*,categories.category,subcategories.subcategory,brands.brand');
        $this->db->from('products');
        $this->db->join('categories', 'products.catid = categories.catid');
        $this->db->join('subcategories', 'products.subid = subcategories.subid');
        $this->db->join('brands', 'products.brandid = brands.brandid');
        $this->db->limit(10);
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    // for display cctv from the table products
    public function cctv_List()
    {
        $this->db->select('products.*,categories.category,subcategories.subcategory,brands.brand');
        $this->db->from('products');
        $this->db->join('categories', 'products.catid = categories.catid');
        $this->db->join('subcategories', 'products.subid = subcategories.subid');
        $this->db->join('brands', 'products.brandid = brands.brandid');
        $this->db->where('products.catid',2);
        $query = $this->db->get();
        return $query->result_array();
    }
    // for display biometrics from the table products
    public function biometrics()
    {
        $this->db->select('products.*,categories.category,subcategories.subcategory,brands.brand');
        $this->db->from('products');
        $this->db->join('categories', 'products.catid = categories.catid');
        $this->db->join('subcategories', 'products.subid = subcategories.subid');
        $this->db->join('brands', 'products.brandid = brands.brandid');
        $this->db->where('products.catid',5);
        $query = $this->db->get();
        return $query->result_array();
    }
    // for display alarm systems from the table products
    public function alarms()
    {
        $this->db->select('products.*,categories.category,subcategories.subcategory,brands.brand');
        $this->db->from('products');
        $this->db->join('categories', 'products.catid = categories.catid');
        $this->db->join('subcategories', 'products.subid = subcategories.subid');
        $this->db->join('brands', 'products.brandid = brands.brandid');
        $this->db->where('products.catid',4);
        $query = $this->db->get();
        return $query->result_array();
    }
        // for display fire from the table products
    public function fire()
    {
        $this->db->select('products.*,categories.category,subcategories.subcategory,brands.brand');
        $this->db->from('products');
        $this->db->join('categories', 'products.catid = categories.catid');
        $this->db->join('subcategories', 'products.subid = subcategories.subid');
        $this->db->join('brands', 'products.brandid = brands.brandid');
        $this->db->where('products.catid',3);
        $query = $this->db->get();
        return $query->result_array();
    }
    
       public function telephone()
    {
        $this->db->select('products.*,categories.category,subcategories.subcategory,brands.brand');
        $this->db->from('products');
        $this->db->join('categories', 'products.catid = categories.catid');
        $this->db->join('subcategories', 'products.subid = subcategories.subid');
        $this->db->join('brands', 'products.brandid = brands.brandid');
        $this->db->where('products.catid',7);
        $query = $this->db->get();
        return $query->result_array();
    }
}
