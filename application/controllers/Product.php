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
        $this->session->set_userdata('checkout', 0);
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
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Insufficient Stock For Certain Product <strong>'. ucwords($query[0]['item_name']) .'</strong> </div>');
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
        if(empty($this->cart->contents())){
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                You Dont Have Any Item too Buy</div>');
            redirect('product');
        }
        $hist_id = rand(1000, 9999);

        //transaction
        $dataSession = $this->session->userdata('email');
        // $transaction_id = rand(100, 999);
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

        //ngurangin jumlah produk yang ada di database sesuai dengan qty yg dibeli

        // var_dump($user_id);die;
        // input ke history
        $data = [
            'history_id' => $hist_id,
            'user_id' => $user_id['user_id'],
            'total_price' => $total_price,
            'total_weight' => $total_weight,
            'transaction_date' => $transaction_date,
            'delivery_address' => '',
            'delivery_post' => ''
        ];
        $this->db->insert('history', $data);

        //input ke history_item
        foreach ($this->cart->contents() as $items) {
            $history_item_id = $items['rowid'];
            $history_id = $hist_id;
            // var_dump($history_item_id);die;
            $item_id = $items['idDb'];
            $item_quantity = $items['qty'];
            $price = $items['subtotal'];
            $weight = $items['options']['Weight'];
            
            $data2 = [
                'history_item_id' => $history_item_id,
                'history_id' => $hist_id,
                'item_id' => $item_id,
                'item_quantity' => $item_quantity,
                'price' => $price,
                'weight' => $weight
            ];
            $this->db->insert('history_item', $data2);
            
            //buat update stock            
            $dataItem = $this->db->get_where('item', [ 'item_id' => $item_id ])->row_array();
            $minusQty = $dataItem['item_stock']-$item_quantity;

            

            $this->db->where('item_id', $item_id);
            $this->db->update('item', ['item_stock' => $minusQty] );
            
        }

        

        $this->session->set_userdata('checkout', 1);
        redirect('product/checkoutView');
    }

    public function checkoutView(){
        if($this->session->userdata('checkout') != 1){
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                No Item for Checkout</div>');
            redirect('product');
        }

        $this->cart->destroy();
        $this->load->view('template/header_2');
        $this->load->view('user/checkout');
        $this->load->view('template/footer');
    }

    public function transactionHistory(){
        if($this->session->userdata('user_id') != $this->uri->segment(3)){
            redirect('user');
        }
        $data['transaction'] = $this->db->get_where('history', ['user_id' => $this->uri->segment(3) ])->result_array();

        // var_dump($data['transaction']);die;
        $i = 0;
        foreach($data['transaction'] as $d){
            $this->db->select('history_item.* , item.item_name, item.item_category, category.category_name ');
            $this->db->join('item', 'history_item.item_id = item.item_id');
            $this->db->join('category', 'item.item_category = category.category_id');
            $data['transaction'][$i]['details'.$i] = $this->db->get_where('history_item', [ 'history_id' => $d['history_id'] ])->result_array();
            $i++;
        }
        // var_dump($data['transaction'][0]['details0'][0]);die;
        

        $this->load->view('template/header_2');
        $this->load->view('user/transactionHistory', $data);
        $this->load->view('template/footer');
    }
    
}