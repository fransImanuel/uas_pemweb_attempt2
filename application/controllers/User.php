<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            // var_dump($this->session->userdata());
            // die;
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $data['name'] = $data['user']['first_name'];
            // var_dump($data['user'], $data['name']);die;
        } else {
            $data['name'] = '';
        }

        $data['product'] = $this->db->get('item')->result_array();
        // var_dump($data['user']);die;
        $data['category'] = $this->db->get('category')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('user/index', $data);
        $this->load->view('template/footer');
    }

    function fetch()
    {
        $output = '';
        $search = '';
        $filter = '';
        $this->load->model('ajax_model');
        $search = $this->input->post('search');

        $filter = $this->input->post('filter');

        $sort = $this->input->post('sort');
        $data = $this->ajax_model->fetch_data($search, $filter, $sort);
        if ($data->num_rows() > 0) {
            $i = 1;
            foreach ($data->result() as $p) {
                if ($p->item_is_active) {
                    $output .= '
                <div class="col-lg-4 col-sm-6 mb-4 square">
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-toggle="modal" href="#modal-product' . $p->item_id . '">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid img-thumbnail" src="' . base_url('') . 'assets/img/product/' . $p->item_image . '" alt="" />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">' . ucwords($p->item_name) . '</div>
                            <div class="portfolio-caption-subheading text-muted">' . $p->item_short_desc . '</div>
                        </div>
                    </div>
                </div>
                <!-- Modal 1-->
                <div class="portfolio-modal modal fade" id="modal-product' . $p->item_id . '" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="close-modal" data-dismiss="modal"><img src="' . base_url('vendor/agency/') . 'assets/img/close-icon.svg" /></div>
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="modal-body">
                                            <!-- Project Details Go Here-->
                                            <h2 class="text-uppercase">' . ucwords($p->item_name) . '</h2>
                                            <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                            <img class="img-fluid d-block mx-auto" src="' . base_url() . 'assets/img/product/' . $p->item_image . '" alt="" />
                                            <p class="text-muted">' . $p->item_short_desc . '</p>
                                            <p>' . $p->item_long_desc . '</p>
                                            <ul class="list-inline">
                                                <li>Price: Rp. ' . $p->item_price . '</li>
                                                <li>Weight: ' . $p->item_weight . '</li>
                                                <li>Remaining Stock: ' . $p->item_stock . '</li>
                                            </ul>
                                            <button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fas fa-times mr-1"></i>Close Project</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ';
                }
            }
        } else {
            $output .= '
            <tr>
                <td class="text-center">
                    <img class="" style="
                            width: 50%; 
                            display: block;
                            margin-left: auto;" 
                        src="' . base_url() . 'assets/img/misc/no_data.svg" alt="No Data Found">
                    <h4 style="
                            width: 50%; 
                            display: block;
                            margin-left: auto;" >No Product</h4>        
                </td>
            </tr>
            ';
        }

        echo $output;
    }


    public function login()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header');
            $this->load->view('user/login');
            $this->load->view('template/footer');
        } else {
            $this->_checkDataLogin();
        }
    }

    public function _checkDataLogin()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('users', ['email' => $email])->row_array();
        //usernya ada
        if ($user) {
            //cek password
            if (password_verify($password, $user['password'])) {
                $data = [
                    'email' => $user['email'],
                    'role_id' => $user['role_id']
                ];
                $this->session->set_userdata($data);
                // var_dump($this->session);
                // die;
                if ($user['role_id'] == 1) {
                    redirect('admin');
                } else {
                    redirect('user');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Wrong password!</div>');
                redirect('user/login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email is Not Registered!</div>');
            redirect('user/login');
        }
    }

    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'is_unique' => 'This Email Has Already Registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required|alpha');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header');
            $this->load->view('user/registration');
            $this->load->view('template/footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'profile_picture' => 'default.jpg',
                'first_name' => htmlspecialchars($this->input->post('firstname', true)),
                'last_name' => htmlspecialchars($this->input->post('lastname', true)),
                'gender' => $this->input->post('gender'),
                'phone_number' => '',
                'email' => $email,
                'city' => '',
                'post_code' => '',
                'birthday' => $this->input->post('date'),
                'address' => '',
                'is_active' => 0,
                'role_id' => 2,
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT)
            ];

            $this->db->insert('users', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulation! Your Account has been created. Please Log In!</div>');

            redirect('user/login');
        }
    }

    public function logout()
    {
        if (!$this->session->userdata('email')) {
            redirect('user');
        }
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        redirect('user');
    }
}
