<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        if (!$this->session->userdata('email')) {
            redirect('user');
        } else {
            $email = $this->session->userdata('email');
            $data = $this->db->get_where('users', ['email' => $email])->row_array();
            // var_dump($data);die;
            if ($data['role_id'] != 1) {
                redirect('user');
            }
        }
    }

    public function index(){
        
        $this->load->view('admin_template/header');
        $this->load->view('admin_template/sidebar');
        $this->load->view('admin/index');
        $this->load->view('admin_template/footer');
    }

    public function chart(){
        $this->load->view('admin_template/header');
        $this->load->view('admin_template/sidebar');
        $this->load->view('admin/chart');
        $this->load->view('admin_template/footer');
    }
    
    public function create(){

        $data['title'] = 'Admin | Create Product ';
        $data['category'] = $this->db->get('category')->result_array();
        // var_dump($data['category']);die;

        $this->form_validation->set_rules('productname', 'Email', 'required|trim');
        if( empty($_FILES['productimage']['name']) ){
            $this->form_validation->set_rules('productimage', 'Product Image', 'required');
        }
        $this->form_validation->set_rules('productprice', 'Product Price', 'required|trim|numeric');
        $this->form_validation->set_rules('productstock', 'Stock', 'required|trim|numeric');
        $this->form_validation->set_rules('productweight', 'Weight', 'required|trim|numeric');
        $this->form_validation->set_rules('shortproductdesc', 'Short Product Description', 'required|trim|max_length[255]');
        $this->form_validation->set_rules('longproductdesc', 'Detail Product Description', 'required|trim');
        $this->form_validation->set_rules('category', 'Cateogry', 'required|trim|numeric');
        // var_dump($_FILES);
        // die;

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin_template/header' ,$data);
            $this->load->view('admin_template/sidebar');
            $this->load->view('admin/create',$data);
            $this->load->view('admin_template/footer');
        } else {
            // var_dump($_FILES);die;

            $config['upload_path'] = './assets/img/product/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size']     = '2048';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // var_dump($this->upload->do_upload('productimage'));die;
            
            if ($this->upload->do_upload('productimage')) {
                $new_image = $this->upload->data('file_name');

                $data = [
                    'item_name' => $this->input->post('productname'),
                    'item_image' => $new_image,
                    'item_price' => $this->input->post('productprice'),
                    'item_stock' => $this->input->post('productstock'),
                    'item_weight' => $this->input->post('productweight'),
                    'item_long_desc' => $this->input->post('longproductdesc'),
                    'item_short_desc' => $this->input->post('shortproductdesc'),
                    'item_category' => $this->input->post('category')
                ];
                $this->db->insert('item', $data);
            } else {
                echo $this->upload->display_errors();
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Your Product has been added!</div>');
            redirect('admin/create');
        }


    }
}
