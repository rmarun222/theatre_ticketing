<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donate_handler extends CI_Controller {


	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->database();
	 // 	$this->load->library('prop');
		// $this->load->library('form_validation');
		date_default_timezone_set ( 'Asia/Kolkata' );
	}

	public function index()
	{

	$this->load->library('someclass');
	$working_key = 'F67C795C01FACB64EA39FE4A33B70729';//Shared by CCAVENUES
	$access_code = 'AVVL04IK03BH30LVHB';//Shared by CCAVENUES
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=$this->someclass->decrypt($encResponse,$working_key);		//Crypto Decryption used as per the specified working key.

	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
	echo "<center>";

	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==3)	$order_status=$information[1];
	}

	if($order_status==="Success")
	{
		echo "<br>Transaction Successfull.";
				
		
	}
	else if($order_status==="Aborted")
	{
		echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
	
	}
	else if($order_status==="Failure")
	{
		echo "<br>Thank you.However,the transaction has been declined.";
	}
	else
	{
		echo "<br>Security Error. Illegal access detected";
	
	}

	echo "<br><br>";
	// echo "DETAILS";
    // $final_data['payment_mode_id'] = '';
    $final_data['transaction_id'] = '';
    $final_data['payment_mode'] = '';
	// echo "<table cellspacing=4 cellpadding=4>";
	for($i = 0; $i < $dataSize; $i++) 
	{

		$information=explode('=',$decryptValues[$i]);
	    	// echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';

	    	// if($information[0] == 'order_id'){
	    	// 	$final_data['order_id'] = $information[1];
	    	// }
	    	if($information[0] == 'tracking_id'){
	    		$final_data['tracking_id'] = $information[1];
	    	}

	    	if($information[0] == 'mer_amount'){
	    		$final_data['amount_paid'] = $information[1];
	    	}
	    	if($information[0] == 'bank_ref_no'){
	    		$final_data['bank_ref_no'] = $information[1];
	    	}
	    	if($information[0] == 'order_status'){
	    		$final_data['payment_status'] = $information[1];
	    	}
	    	// if($information[0] == 'payment_mode'){
	    	// 	$final_data['payment_mode'] = $information[1];
	    	// }
	    	if($information[0] == 'card_name'){
	    		$final_data['card_name'] = $information[1];
	    	}	    	

	    	if($information[0] == 'payment_mode'){
	    		$final_data['payment_mode'] = $information[1];
	    	}

	    	if($information[0] == 'billing_name'){
	    		$final_data['name'] = $information[1];
	    	}
	    	if($information[0] == 'billing_email'){
	    		$final_data['email'] = $information[1];
	    	}
	    	if($information[0] == 'delivery_name'){
	    		$final_data['name'] = $information[1];

	    	}
	    	if($information[0] == 'delivery_address'){
	    		$final_data['address'] = $information[1];
	    	}
	    	if($information[0] == 'delivery_state'){
	    		$final_data['state'] = $information[1];
	    	}if($information[0] == 'delivery_zip'){
	    		$final_data['zip_code'] = $information[1];
	    	}

	    	if($information[0] == 'delivery_city'){
	    		$final_data['city'] = $information[1];
	    	}

	    	if($information[0] == 'delivery_tel'){
	    		$final_data['mobile_no'] = $information[1];
	    	}

	    	if($information[0] == 'trans_date'){
	    		$final_data['date_of_donation'] = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $information[1]))); ;
	    	}
	    	
	}

	// echo '<pre>';
	// print_r($final_data);
    $this->admin_model->unique_insert_query('donation_details',$final_data);

	$string.= 'Thank you for your donation to KRS Party <b>'.strtoupper($final_data['name']).' </b><br><br>';
	// $string = 'Name :'.$final_data['name'].'<br>';
	// $string = 'Address :'.$final_data['address'].'<br>';
	// $string = 'Address :'.$final_data['address'].'<br>';
	$string.= 'Payment Details<br><br>';
	$string.= '<table border="1">';
	$string.= '<tr><td style="text-align: center; vertical-align: middle;" >Tracking ID</td><td style="text-align: center; vertical-align: middle;" >Bank ref no</td><td style="text-align: center; vertical-align: middle;" >Date</td><td style="text-align: center; vertical-align: middle;" >Amount</td></tr>';
	$string.= '<tr><td style="text-align: center; vertical-align: middle;" >'.$final_data['tracking_id'].'</td><td style="text-align: center; vertical-align: middle;" >'.$final_data['bank_ref_no'].'</td><td style="text-align: center; vertical-align: middle;" >'.$final_data['date_of_donation'].'</td><td style="text-align: center; vertical-align: middle;" >'.$final_data['amount_paid'].'</td></tr></table>';
	echo $string;
	die;



	}


}
