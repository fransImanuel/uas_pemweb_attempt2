<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        if( !$this->session->userdata('email') ){
            redirect('user');
        }
        // var_dump($this->session->userdata('email'));die;
    }

    public function index(){

        // var_dump($this->uri->segment('1'));die;
        $data['section'] = $this->uri->segment('1');
        if ($this->session->userdata('email')) {
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $data['name'] = $data['user']['first_name'];
        } else {
            $data['name'] = '';
        }
        $this->load->view('template/header_2');
        $this->load->view('user/cart');
        $this->load->view('template/footer');
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
                'Weight' => $queryDb['item_weight'],
                'Image' => $queryDb['item_image']),
                'idDb' => $queryDb['item_id']
        );

        $this->cart->insert($data);
        
    }

    public function updatecart(){
        $dataProduct = $this->input->post();
        $numberOfProducts = $this->input->post('numberOfProducts');
        for($i=0 ; $i < intval($numberOfProducts); $i++){

            //buat ngecek ke database jumlah barang yg di beli sama stok yg ada
            $query = $this->db->get_where('item' , ['item_id' => $dataProduct[$i]['itemid'] ])->result_array();
            if( intval($dataProduct[$i]['qty']) > intval($query[0]['item_stock']) ){
                $this->session->set_flashdata('keterangan', $query[0]['item_name']);
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Insufficient Stock For Certain Product</div>');
                redirect('product');
            }            
            $data = array(
                "rowid" => $dataProduct[$i]['rowid'],
                "qty" => $dataProduct[$i]['qty']
            );
        $this->cart->update($data);
        }
        redirect('product');
    }

    public function removeproduct(){
        $row_id = $this->uri->segment(3);
        $this->cart->remove($row_id);
        redirect('product');
    }

    public function checkout(){
        //transaction
        $dataSession = $this->session->userdata('email');
        $transaction_id = rand(100, 999);
        $user_id = $this->db->get_where('users', ['email' => $dataSession ] )->row_array();
        $total_price = $this->cart->total();
        $transaction_date = date("Y-m-d");

        $total_weight = 0;
        $temp = 0;
        foreach($this->cart->contents() as $items){
            foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value){
                if($option_name == 'Weight'){
                    $temp = $option_value * $items['qty'];
                    $total_weight += $temp;
                }
            }
        }

        //input ke history
        // $data = [
        //     'user_id' => $user_id,
        //     'total_price' => $total_price,
        //     'total_weight' => $total_weight,
        //     'transaction_date' => $transaction_date
        // ];
        // $this->db->insert('history', $data);

        $history_id = $this->db->get_where('history', [ 'history_id' => $user_id ]);

        //input ke history_item
        foreach ($this->cart->contents() as $items) {
            $history_item_id = $items['rowid'];
            var_dump($history_item_id);die;
            $item_id = $items['idDb'];
            $item_quantity = $items['qty'];
            $price = $items['subtotal'];
            $weight = $items['options']['Weight'];
        
        }die;
        $data = [

        ];
    }
    
    

}