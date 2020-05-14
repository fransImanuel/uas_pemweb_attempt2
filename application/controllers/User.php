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
        if( $this->session->userdata('email') ){
            // var_dump($this->session->userdata());
            // die;
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $data['name'] = $data['user']['first_name'];
            // var_dump($data['user'], $data['name']);die;
        }else{
            $data['name'] = '';
        }

        $data['product'] = $this->db->get('item')->result_array();
        // var_dump($data['user']);die;

        $this->load->view('template/header', $data);
        $this->load->view('user/index');
        $this->load->view('template/footer');
    }
    
    public function login()
    {
        if( $this->session->userdata('email') ){
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

    public function _checkDataLogin(){
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

    public function registration(){
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

    public function logout(){
        if ( !$this->session->userdata('email') ) {
            redirect('user');
        }
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        redirect('user');
    }


}
