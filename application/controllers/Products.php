<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller{
    
    function  __construct(){
        parent::__construct();
        
        // Load cart library
        $this->load->library('cart');
        $this->load->library('session');
        
        // Load product model
        // $this->load->model('product');
        $this->load->model('admin_model');

    }
    
    function index(){
        $data = array();
        
        // Fetch products from the database
        $data['products'] = $this->product->getRows();
        
        // Load the product list view
        $this->load->view('products/index', $data);
    }
    
    function addToCart(){
        
    $msg = 'success';
    $qty        = $_POST['qty'];
    $item_name  = $_POST['item_name'];
    $item_id    = $_POST['item_id'];
    $item_price = $_POST['item_price'];
    $item_image = $_POST['item_image'];
    $total_price = $qty * $item_price;
    $status = "insert";
    $flag = TRUE;
    $dataTmp = $this->cart->contents();


    $data = array(
    'id'    => $item_id,
    'qty'    => $qty,
    'price'    => $item_price,
    'name'    => $item_name,
    'image' => $item_image
    );

        if(!empty($dataTmp)){
        foreach ($dataTmp as $item) {
            if ($item['id'] == $item_id) {
                $rowid = $item['rowid'];
                if(!empty($rowid) && !empty($qty)){
                $data = array(
                'rowid' => $rowid,
                'qty'   => $qty
                );
                $update = $this->cart->update($data);
                }

                $flag = FALSE;
                break;
            }
        }
        }
        if ($flag) {
            $this->cart->insert($data);
        }
        $data1['msg'] = $msg;
        echo json_encode($msg);
    }


    function DeleteFromCart(){
        
    $msg = 'success';
    $item_id    = $_POST['item_id'];
    $dataTmp = $this->cart->contents();
        if(!empty($dataTmp)){
        foreach ($dataTmp as $item) {
            if ($item['id'] == $item_id) {
                $rowid = $item['rowid'];
                $this->cart->remove($rowid);
            }
        }
        }
        $data1['msg'] = $msg;
        echo json_encode($msg);
    }
    
}