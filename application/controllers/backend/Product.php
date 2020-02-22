<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->helper('text');
        $this->load->model('backend/Product_model');
        $this->load->model('backend/Brand_model');
        $this->load->model('backend/Category_model');
        $this->load->model('backend/Subcategory_model');
        $this->load->library('Ckeditor');
        $this->load->library('Ckfinder');

        $this->ckeditor->basePath = base_url() . 'assets/backend/Ckeditor/';
        $this->ckeditor->config['toolbar'] = array(
            array(
                'Source', '-', 'Bold', 'Italic', 'Underline', '-',
                'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo',
                'Redo', '-', 'NumberedList', 'BulletedList'
            )
        );
        $this->ckeditor->config['language'] = 'it';
        $this->ckeditor->config['width'] = '730px';
        $this->ckeditor->config['height'] = '300px';

        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor, '../../assets/backend/Ckfinder/');
    }
    public function index()
    {
        $data['user'] = $this->db->get_where('admins', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/backend/header', $data);
        $this->load->view('templates/backend/sidebar');
        $data['productinfo'] = $this->Product_model->products_List();
        $this->load->view('backend/products/products', $data);
        $this->load->view('templates/backend/footer');
    }
    public function add()
    {
        $data['user'] = $this->db->get_where('admins', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('product', 'product', 'required|trim|callback_product_check|is_unique[products.product]', [
            'is_unique' => 'This product already exists.',
        ]);
        //$this->form_validation->set_rules('product', 'product','required|trim|is_unique[products.product]', 'callback_product_check');
        $this->form_validation->set_rules('brandid', 'Brand', 'required|trim');
        $this->form_validation->set_rules('catid', 'category', 'required|trim');
        $this->form_validation->set_rules('subid', 'subcategory', 'trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');
        $this->form_validation->set_rules('price', 'price', 'numeric|required|trim|greater_than[1000]',[
            'greater_than' => 'The price should be above ush.1000 .', 
        ]);
        $this->form_validation->set_rules('new_price', 'New price', 'numeric|required|greater_than[1000]',[
            'greater_than' => 'The price should be above ush.1000 .', 
        ]);
        $this->form_validation->set_rules('quantity', 'Quantity', 'numeric|required|greater_than[0]',[
            'greater_than' => 'The quantity should be greater than 0 .', 
        ]);

        if ($this->form_validation->run() == FALSE) :
            $this->load->view('templates/backend/header', $data);
            $this->load->view('templates/backend/sidebar');
            $data['catinfo'] = $this->Category_model->category();
            $data['subinfo'] = $this->Subcategory_model->subcategoriesList();
            $data['brandinfo'] = $this->Brand_model->brandsList();
            $this->load->view('backend/products/add-product', $data);
            $this->load->view('templates/backend/footer');
        else :
            $data['product'] = $this->input->post('product');
            $data['subid'] = $this->input->post('subid');
            $data['catid'] = $this->input->post('catid');
            $data['brandid'] = $this->input->post('brandid');
            $data['price'] = $this->input->post('price');
            $data['new_price'] = $this->input->post('new_price');
            $data['quantity'] = $this->input->post('quantity');
            $data['description'] = $this->input->post('description');
            $slug = $this->generate_slug($this->input->post('product'));

            if (
                $_FILES['userfile']['name'] != '' || $_FILES['userfile1']['name'] != '' || $_FILES['userfile2']['name'] != '' || $_FILES['userfile']['size'] != 0 || $_FILES['userfile1']['size'] != 0
                || $_FILES['userfile2']['size'] != 0
            ) :

                //uploading the image link to the database.
                $config['upload_path'] = './assets/backend/images/uploads/products/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '2048';
                $config['max_width'] = '9024';
                $config['max_height'] = '9024';
                $config['encrypt_name'] = true;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('userfile')) {
                    $error = array('error' => $this->upload->display_errors());
                    $_FILES['userfile']['name'] = 'noimage.png';
                } else {
                    $fileData = $this->upload->data();
                    $data['userfile'] = $fileData['file_name'];
                }
                if (!$this->upload->do_upload('userfile1')) {
                    $error = array('error' => $this->upload->display_errors());
                    $_FILES['userfile1']['name'] = 'noimage.png';
                } else {
                    $fileData = $this->upload->data();
                    $data['userfile1'] = $fileData['file_name'];
                }
                if (!$this->upload->do_upload('userfile2')) {
                    $error = array('error' => $this->upload->display_errors());
                    $_FILES['userfile2']['name'] = 'noimage.png';
                } else {
                    $fileData = $this->upload->data();
                    $data['userfile2'] = $fileData['file_name'];
                } else :
                $this->session->set_flashdata('message', '<div class="alert alert-danger role="alert">
                        Invalid image.please try again.</div>');
                return redirect('admin/product/add');
            endif;

            $this->Product_model->save($data, $slug);
            $this->session->set_flashdata('message', '<div class="alert alert-success role="alert">
                The product has been saved successfully.</div>');
            return redirect('admin/products');
        endif;
    }
    public function edit($slug)
    {
        $data['user'] = $this->db->get_where('admins', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['product'] = $this->Product_model->get_products($slug);
        if (empty($data['product'])) :
            return redirect('admin/404');
        endif;

        $this->form_validation->set_rules('product', 'product', 'required|trim|callback_product_check');
        //$this->form_validation->set_rules('product', 'product','required|trim|is_unique[products.product]', 'callback_product_check');
        $this->form_validation->set_rules('brandid', 'Brand', 'required|trim');
        $this->form_validation->set_rules('catid', 'category', 'required|trim');
        $this->form_validation->set_rules('subid', 'subcategory', 'trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');
        $this->form_validation->set_rules('price', 'price', 'numeric|required|trim|greater_than[1000]',[
            'greater_than' => 'The price should be above ush.1000 .', 
        ]);
        $this->form_validation->set_rules('new_price', 'New price', 'numeric|required|greater_than[1000]',[
            'greater_than' => 'The price should be above ush.1000 .', 
        ]);
        $this->form_validation->set_rules('quantity', 'Quantity', 'numeric|required|greater_than[0]',[
            'greater_than' => 'The quantity should be greater than 0 .', 
        ]);

        if ($this->form_validation->run() == FALSE) :
            $this->load->view('templates/backend/header', $data);
            $this->load->view('templates/backend/sidebar');
            $data['catinfo'] = $this->Category_model->list();
            $data['cat'] = $this->Category_model->get_categories();

            $data['sub'] = $this->Subcategory_model->get_subcategories();

            $data['brandinfo'] = $this->Brand_model->brandsList();
            $data['brand'] = $this->Brand_model->get_brands();
            $this->load->view('backend/products/edit-product', $data);
            $this->load->view('templates/backend/footer');
        else :
            $id = $this->input->post('id');
            $product = $this->input->post('product');
            $subid = $this->input->post('subid');
            $catid = $this->input->post('catid');
            $brandid = $this->input->post('brandid');
            $price = $this->input->post('price');
            $new_price = $this->input->post('new_price');
            $quantity = $this->input->post('quantity');
            $description = $this->input->post('description');
            $slug = $this->generate_slug($this->input->post('product'));

            if (
                $_FILES['userfile']['name'] != '' || $_FILES['userfile1']['name'] != '' || $_FILES['userfile2']['name'] != '' || $_FILES['userfile']['size'] != 0 || $_FILES['userfile1']['size'] != 0
                || $_FILES['userfile2']['size'] != 0
            ) :

                //uploading the image link to the database.
                $config['upload_path'] = './assets/backend/images/uploads/products/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '2048';
                $config['max_width'] = '9024';
                $config['max_height'] = '9024';
                $config['encrypt_name'] = true;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('userfile')) :
                    $old_image = $data['product']['image1'];
                    if ($old_image != 'noimage.png') :
                        unlink(FCPATH . './assets/backend/images/uploads/products/' . $old_image);
                    endif;
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image1', $new_image);
                else :
                    $error = array('error' => $this->upload->display_errors());
                endif;

                if ($this->upload->do_upload('userfile1')) :
                    $old_image1 = $data['product']['image2'];
                    if ($old_image1 != 'noimage.png') :
                        unlink(FCPATH . './assets/backend/images/uploads/products/' . $old_image1);
                    endif;
                    $new_image1 = $this->upload->data('file_name');
                    $this->db->set('image2', $new_image1);
                else :
                    $error = array('error' => $this->upload->display_errors());
                endif;

                if ($this->upload->do_upload('userfile2')) :
                    $old_image2 = $data['product']['image3'];
                    if ($old_image2 != 'noimage.png') :
                        unlink(FCPATH . './assets/backend/images/uploads/products/' . $old_image2);
                    endif;
                    $new_image2 = $this->upload->data('file_name');
                    $this->db->set('image3', $new_image2);
                else :
                    $error = array('error' => $this->upload->display_errors());
                endif;

            endif;
            $this->db->set('product', $product);
            $this->db->set('subid', $subid);
            $this->db->set('catid', $catid);
            $this->db->set('brandid', $brandid);
            $this->db->set('price', $price);
            $this->db->set('new_price', $new_price);
            $this->db->set('quantity', $quantity);
            $this->db->set('description', $description);
            $this->db->set('slug', $slug);
            $this->db->where('id', $id);

            $this->db->update('products');
            $mdata = array();
            $mdata['message'] = "The product has been updated.";

            $this->session->set_userdata($mdata);
            $id = $this->input->post('id');
            $this->session->set_flashdata('message', '<div class="alert alert-success role="alert">
                        The product has been updated successfully.</div>');
            redirect(base_url('admin/products'));
        endif;
    }
    private function upload_image()
    {
        //uploading the image link to the database.
        $config['upload_path'] = './assets/backend/images/uploads/products/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2048';
        $config['max_width'] = '9024';
        $config['max_height'] = '9024';

        $this->load->library('upload', $config);
        $data = array();
        $data['upload_data'] = array();
        $this->upload->do_upload('userfile');
        $data['upload_data'][0] = $this->upload->data();
        $this->upload->do_upload('userfile2');
        $data['upload_data'][1] = $this->upload->data();
        $this->upload->do_upload('userfile3');
        $data['upload_data'][2] = $this->upload->data();

        if ($data['upload_data'] = array()) {
            $data = $this->upload->data();
            $imagePath = "$data[file_name]";
            return $imagePath;
        } else {
            $errors = $this->upload->display_errors();
            $image = 'noimage.png';
            print_r($errors);
        }
    }
    public function delete($id)
    {
        $data = $this->Product_model->getproduct($id);
        $path = './assets/backend/images/uploads/products/';

        @unlink($path . $data->image1);
        @unlink($path . $data->image2);
        @unlink($path . $data->image3);
        if ($this->Product_model->deleteproduct($id)) :
            $this->session->set_flashdata('message', '<div class="alert alert-success role="alert">
                The product has been deleted successfully.</div>');
            redirect('admin/products');
        endif;
    }
    public function generate_slug($slug, $separator = '-')
    {
        $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
        $special_cases = array('&' => 'and', "'" => '');
        $slug = mb_strtolower(trim($slug), 'UTF-8');
        $slug = str_replace(array_keys($special_cases), array_values($special_cases), $slug);
        $slug = preg_replace($accents_regex, '$1', htmlentities($slug, ENT_QUOTES, 'UTF-8'));
        $slug = preg_replace("/[^a-z0-9]/u", "$separator", $slug);
        $slug = preg_replace("/[$separator]+/u", "$separator", $slug);
        return $slug;
    }

    public function product_check($str)
    {
        if (!preg_match('/^[a-zA-Z0-9&-. ]*$/', $str)) {
            $this->form_validation->set_message('product_check', 'This product is invalid.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
