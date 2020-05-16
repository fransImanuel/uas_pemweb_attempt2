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

    public function index()
    {
        $data['title'] = "Admin | Dashboard";

        //query buat data statistik
        $this->db->select('category.category_name, SUM(history_item.item_quantity) as sum');
        $this->db->join('item', 'item.item_id = history_item.item_id');
        $this->db->join('category', 'item.item_category = category.category_id');
        $this->db->group_by("category_name");
        $statQuery = $this->db->get('history_item')->result_object();
        $data['product'] = json_encode($statQuery);

        // $data['product'] = $this->db->get('history_item')->result_array();

        // var_dump(json_decode($data['product']));die;


        $this->load->view('admin_template/header', $data);
        $this->load->view('admin_template/sidebar');
        $this->load->view('admin/index', $data);
        $this->load->view('admin_template/footer', $data);
    }

    public function chart()
    {
        $this->load->view('admin_template/header');
        $this->load->view('admin_template/sidebar');
        $this->load->view('admin/chart');
        $this->load->view('admin_template/footer');
    }

    function fetch()
    {
        $output = '';
        $query = '';
        $this->load->model('ajax_model');
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }
        $data = $this->ajax_model->fetch_data($query);
        $output .= '
        <table class="table table-hover">
                        <thead class="thead-dark ">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Available</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
        ';
        if ($data->num_rows() > 0) {
            $i = 1;
            foreach ($data->result() as $p) {
                if ($p->item_is_active == 1) {
                    $available = 'available';
                    $color = 'btn-danger';
                    $logo = 'fa-ban';
                } else {
                    $available = 'not available';
                    $color = 'btn-success';
                    $logo = 'fa-eye';
                }

                $output .= '
                <tr>
                                     <th scope="row">' . $i++ . '</th>
                                     <td>' . $p->item_name . '</td>
                                     <td>' . $p->category_name . '</td>
                                     <td>' . $available . '</td>
                                     <td>
                                         <!-- Button trigger modal -->
                                         <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#details' . $p->item_id . '">
                                             <i class="fas fa-fw fa-info-circle"></i>
                                         </button>
                                         <a href="' . base_url('admin/editProduct/') . $p->item_id . '" class="btn btn-primary"><i class="fas fa-fw fa-edit text-light"></i></a>
                                         <button type="button" class="btn ' . $color . '" data-toggle="modal" data-target="#delete' . $p->item_id . '">
                                             <i class="fas fa-fw ' . $logo . '"></i>
                                         </button>
                                     </td>
                                     <!-- Modal Details -->
                                     <div class="modal fade " id="details' . $p->item_id . '" tabindex="-1" role="dialog" aria-labelledby="details' . $p->item_id . 'Label">
                                         <div class="modal-dialog modal-xl">
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     <h5 class="modal-title" id="details' . $p->item_id . 'Label">' . $p->item_name . '</h5>
                                                     <button type="button" class="close" data-dismiss="modal">
                                                         <span>&times;</span>
                                                     </button>
                                                 </div>
                                                 <div class="modal-body">
                                                     <div class="container">
                                                         <div class="row">
                                                             <div class="col col-md">
                                                                 <img src="' . base_url() . 'assets/img/product/' . $p->item_image . '" class="img-fluid" alt="">
                                                             </div>
                                                             <div class="col col-md text-center">
                                                                 <h1>' . $p->item_name . '</h1>
                                                                 <h3 class="mt">Category : ' . $p->category_name . '</h3>
                                                                 <p class="mb-0">' . $p->item_short_desc . '</p>
                                                                 <p class="blockquote-footer">' . $p->item_long_desc . '</p>
                                                                 <div class="container">
                                                                     <div class="row blockquote">
                                                                         <div class="col-sm">
                                                                             Rp. ' . $p->item_price . '
                                                                         </div>
                                                                         <div class="col-sm">
                                                                             Stock : ' . $p->item_stock . '
                                                                         </div>
                                                                         <div class="col-sm">
                                                                             Weight : ' . $p->item_weight . '
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="modal-footer">
                                                         <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>

                                     <!-- Modal Delete -->
                                     <div class="modal fade " id="delete' . $p->item_id . '" tabindex="-1" role="dialog" aria-labelledby="delete' . $p->item_id . 'Label">
                                         <div class="modal-dialog modal-xl">
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     <h5 class="modal-title" id="delete' . $p->item_id . 'Label">' . $p->item_name . '</h5>
                                                     <button type="button" class="close" data-dismiss="modal">
                                                         <span>&times;</span>
                                                     </button>
                                                 </div>
                                                 <div class="modal-body">
                                                     <div class="container">
                                                         <div class="row">
                                                             <div class="col-md">
                                                                 <img src="' . base_url() . 'assets/img/product/' . $p->item_image . '" class="img-fluid" alt="">
                                                             </div>
                                                             <div class="col col-md text-center">
                                                                 <h1 class="text-danger">Are you Sure Want to Delete??</h1>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="modal-footer">
                                                         <button type="button" class="btn btn-primary " data-dismiss="modal" onclick="deleteProduct(' . $p->item_id . ',' . $p->item_is_active . ')">Change Avaibility</button>
                                                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>


                                 </tr>
                ';
            }
        } else {
            $output .= '
            <tr>
                <td colspan="5">No data found</td>
            </tr>
            ';
        }
        $output .= '</table>';
        echo $output;
    }

    public function create()
    {

        $data['title'] = 'Admin | Add Product ';
        $data['category'] = $this->db->get('category')->result_array();
        // var_dump($data['category']);die;

        $this->form_validation->set_rules('productname', 'Email', 'required|trim');

        if (empty($_FILES['productimage']['name'])) {
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
            $this->load->view('admin_template/header', $data);
            $this->load->view('admin_template/sidebar');
            $this->load->view('admin/create', $data);
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

    public function productlist()
    {

        $data['title'] = 'Admin | List Product ';
        $data['category'] = $this->db->get('category')->result_array();

        $this->db->select('item.item_id, item.item_name, item.item_image, item.item_price, item.item_stock, item.item_weight, item.item_short_desc, item.item_long_desc, item.item_is_active , category.category_name');
        $this->db->join('category', 'category.category_id = item.item_category');
        $data['product'] = $this->db->get_where('item', ['item_is_active' => 1])->result_object();
        // var_dump($data['product']);die;

        $this->load->view('admin_template/header', $data);
        $this->load->view('admin_template/sidebar');
        $this->load->view('admin/productlist', $data);
        $this->load->view('admin_template/footer');
    }

    public function deleteProduct()
    {
        $id_product = $this->input->post('id');
        $is_active = $this->input->post('is_active');
        // var_dump($id_product);   

        if ($is_active == 1) {
            $data = [
                'item_is_active' => 0
            ];
        } else if ($is_active == 0) {
            $data = [
                'item_is_active' => 1
            ];
        }

        $this->db->where('item_id', $id_product);
        $this->db->update('item', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Product Avaibility Changed!</div>');
    }

    public function editProduct()
    {

        $data['id'] = $this->uri->segment(3);

        $this->db->select('item.item_id, item.item_name, item.item_image, item.item_price, item.item_stock, item.item_weight, item.item_short_desc, item.item_long_desc, item.item_is_active , item.item_Category, category.category_name');
        $this->db->join('category', 'category.category_id = item.item_category');
        $data['product'] = $this->db->get_where('item', ['item_id' => $data['id']])->row_array();
        $data['category'] = $this->db->get('category')->result_array();
        $data['title'] = "Admin | Edit Products";

        $this->form_validation->set_rules('productname', 'Email', 'required|trim');
        $this->form_validation->set_rules('productprice', 'Product Price', 'required|trim|numeric');
        $this->form_validation->set_rules('productstock', 'Stock', 'required|trim|numeric');
        $this->form_validation->set_rules('productweight', 'Weight', 'required|trim|numeric');
        $this->form_validation->set_rules('shortproductdesc', 'Short Product Description', 'required|trim|max_length[255]');
        $this->form_validation->set_rules('category', 'Cateogry', 'required|trim|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin_template/header', $data);
            $this->load->view('admin_template/sidebar');
            $this->load->view('admin/edit', $data);
            $this->load->view('admin_template/footer');
        } else {
            $config['upload_path'] = './assets/img/product/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size']     = '2048';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // var_dump($this->upload->do_upload('productimage'));die;

            if ($this->upload->do_upload('productimage')) {
                $new_image = $this->upload->data('file_name');

                $edit_data = [
                    'item_name' => $this->input->post('productname'),
                    'item_image' => $new_image,
                    'item_price' => $this->input->post('productprice'),
                    'item_stock' => $this->input->post('productstock'),
                    'item_weight' => $this->input->post('productweight'),
                    'item_long_desc' => $this->input->post('longproductdesc'),
                    'item_short_desc' => $this->input->post('shortproductdesc'),
                    'item_category' => $this->input->post('category')
                ];
                $this->db->where('item_id', $data['id']);
                $this->db->update('item', $edit_data);
            } else {
                // var_dump($data['id']);die;
                $edit_data = [
                    'item_name' => $this->input->post('productname'),
                    'item_price' => $this->input->post('productprice'),
                    'item_stock' => $this->input->post('productstock'),
                    'item_weight' => $this->input->post('productweight'),
                    'item_long_desc' => $this->input->post('longproductdesc'),
                    'item_short_desc' => $this->input->post('shortproductdesc'),
                    'item_category' => $this->input->post('category')
                ];
                // var_dump($data);
                // die;
                $this->db->where('item_id', $data['id']);
                $this->db->update('item', $edit_data);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Your Product has been Updated!</div>');
            redirect('admin/productlist');
        }
    }

    public function userlist()
    {

        $data['title'] = "Admin | User List";
        $data['users'] = $this->db->get('users')->result_array();
        // var_dump($date);die;
        $this->load->view('admin_template/header', $data);
        $this->load->view('admin_template/sidebar');
        $this->load->view('admin/userlist', $data);
        $this->load->view('admin_template/footer');
    }
}
