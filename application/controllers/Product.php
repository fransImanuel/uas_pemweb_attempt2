<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->load->view('user/cart');
    }

    public function addtocart(){
        $itemid = $this->input->post('itemId');
        $queryDb = $this->db->get_where('item', ['item_id' => $itemid])->row_array();
        $data = array(
            'id'      => $queryDb['item_id'],
            'qty'     => 1,
            'price'   => $queryDb['item_price'],
            'name'    => $queryDb['item_name'],
            'options' => array(
                'Weight' => $queryDb['item_name'],
                'Image' => $queryDb['item_image'])
        );

        $this->cart->insert($data);
        
    }

    public function displaytocart(){

    }

    public function updatecart(){

    }

    public function removeproduct(){
        $row_id = $this->uri->segment(3);
        // var_dump($row_id);die;
        // var_dump($this->cart->contents());die;
        $this->cart->remove($row_id);
    }

    

}