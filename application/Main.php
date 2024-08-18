<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->database();
	 	$this->load->library('prop');
		$this->load->library('form_validation');
		date_default_timezone_set ( 'Asia/Kolkata' );
		$this->baseURL2 = 'http://'.$_SERVER['HTTP_HOST'].'/krs_admin/';
	}
	
	public function home()
	{
		$data['active'] = 'home'; 	
		$this->load->view('header',$data);
		$this->load->view('home/home');
		$this->load->view('footer');
	}

	public function donate(){

		    ini_set('display_errors', 1);
			$data['active'] = 'donate'; 		
			$this->load->view('header',$data);
			$this->load->view('donate');
			$this->load->view('footer');
	}

	public function about_us()
	{
		$data['active'] = 'about_us'; 		
		$this->load->view('header',$data);
		$this->load->view('menu/about_us');
		$this->load->view('footer');
	}
	public function bearers()
	{
		$query="select * from office_bearers where is_deleted=0";
	    $data['bearers']= $districts = $this->admin_model->unique_result_return_query($query);

		$data['active'] = 'bearers'; 		
		$this->load->view('header',$data);
		$this->load->view('menu/bearers');
		$this->load->view('footer');
	}

	public function programs()
	{
		$data['active'] = 'programs'; 		

		$query="select * from upcoming_events where is_deleted=0 ORDER BY up_event_date_time ASC";
	    $data['upcoming_events']= $districts = $this->admin_model->unique_result_return_query($query);

	    $query="select * from past_events where is_deleted=0 ORDER BY past_event_date_time DESC";
	    $data['past_events']= $districts = $this->admin_model->unique_result_return_query($query);
		
		$this->load->view('header',$data);
		$this->load->view('menu/programs');
		$this->load->view('footer');
	}

	public function media()
	{
		$data['active'] = 'media'; 		
		$this->load->view('header',$data);
		$this->load->view('menu/media');
		$this->load->view('footer');
	}

	public function contact_us()
	{
		$data['active'] = 'contact_us'; 		
		$this->load->view('header',$data);
		$this->load->view('menu/contact_us');
		$this->load->view('footer');
	}

	public function save_member_join(){

		ini_set('display_errors', 1);

			// print_r($_POST);
			// die;


		if($_POST){

		$media = '';
		$interest = '';

		if(!empty($_POST['media'])){
		$media = implode(',',$_POST['media']);

		}

		if(!empty($_POST['interest'])){
		$interest = implode(',',$_POST['interest']);

		}
		$_POST['billing_country'] = $_POST['delivery_country'] = 'India';
		$_POST['billing_state'] = $_POST['delivery_state'] = 'Karnataka';
		$_POST['billing_city'] = $_POST['delivery_city'] =  'Bangalore';
		$_POST['delivery_name'] = $_POST['billing_name'];
		$_POST['delivery_address'] = $_POST['billing_address'];
		$_POST['delivery_tel'] = $_POST['mobile_number'];
		$_POST['merchant_param1'] = $_POST['gender'];
		$_POST['merchant_param2'] = $_POST['age'];
		$_POST['merchant_param3'] = $_POST['dob'];
		$_POST['merchant_param4'] = $_POST['p_f_h_name'];
		$_POST['merchant_param5'] = $_POST['v_const'];
		$_POST['billing_notes'] = $_POST['district'].'/'.$_POST['taluk'].'/'.$media.'/'.$interest;
		
		// echo '<pre>';
		// print_r($_POST);
// die;
		$merchant_data='';
		// $working_key='A7F9C460C4A93A5913ED3C7B3F8A29A6';//Shared by CCAVENUES
		// $access_code='AVTA52IJ23BB32ATBB';//Shared by CCAVENUES
		$data=$this->input->post(array(
		'billing_name'=>'billing_name',
		'billing_address'=>'billing_address',
		'billing_email'=>'billing_email',
		'mobile_number'=>'mobile_number',
		'billing_tel'=>'mobile_number',
		'billing_state'=>'billing_state',
		'billing_country'=>'billing_country',
		'billing_city'=>'billing_city',
		'amount'=>'amount',
		'currency'=>'currency',
		'merchant_id'=>'merchant_id',
		'redirect_url'=>'redirect_url',
		'cancel_url'=>'cancel_url',
		'language'=>'language',
		// 'tid'=>'123654789',
		'order_id'=>'order_id',
		'delivery_country'=>'delivery_country',
		'delivery_state'=>'delivery_state',
		'delivery_city'=>'delivery_city',
		'delivery_name'=>'delivery_name',
		'delivery_address'=>'delivery_address',
		'billing_notes'=>'billing_notes',
		'delivery_tel'=>'delivery_tel',
		'merchant_param1'=>'merchant_param1',
		'merchant_param2'=>'merchant_param2',
		'merchant_param3'=>'merchant_param3',
		'merchant_param4'=>'merchant_param4',
		'merchant_param5'=>'merchant_param5'
		));

// 		print_r($data);
// die;

		$merchant_data='';
		$working_key = 'F67C795C01FACB64EA39FE4A33B70729';//Shared by CCAVENUES
		$access_code = 'AVVL04IK03BH30LVHB';//Shared by CCAVENUES
		foreach ($data as $key => $value){
			$merchant_data.=$key.'='.$value.'&';
	}

		// echo '<pre>';
		// print_r($merchant_data);
		// die;

		$this->load->library('someclass');
		$encrypted_data=$this->someclass->encrypt($merchant_data,$working_key); 
		// die;
		?>

		<form method="post" name="redirect" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
		<?php
		echo "<input type=hidden name=encRequest value=$encrypted_data>";
		echo "<input type=hidden name=access_code value=$access_code>";
		?>
		</form></center><script language='javascript'>document.redirect.submit();</script>
	    <?php
			echo "Payment Works";
			die;
		}

	
	}

	public function join_us()
	{
		$query="select * from districts";
	    $data1['districts']= $districts = $this->admin_model->unique_result_return_query($query);

	    $query="select * from parliament_const_list where is_deleted=0";
	    $data1['parliament_const_list']= $districts = $this->admin_model->unique_result_return_query($query);

	    $query="select * from member_interest where is_deleted=0";
	    $data1['interests']= $interests = $this->admin_model->unique_result_return_query($query);

	  	$query="select * from gender_master where is_deleted=0";
	    $data1['gender']= $gender = $this->admin_model->unique_result_return_query($query);

	  	$query="select * from payment_mode where is_deleted=0";
	    $data1['payment_mode']= $gender = $this->admin_model->unique_result_return_query($query);

	    print_r($data1);
	    die;

		$data['active'] = 'join_us'; 		
		$this->load->view('header',$data);
		$this->load->view('menu/join_us',$data1);
		$this->load->view('footer');
	}


	public function save_donate(){

		error_reporting(-1);
		if($_POST){


			// print_r($_POST);
			// die;
			$date = date('Y-m-d H:i:s');
			$fullname = '';
			$mobile = '';
			$address = '';
			$city = '';
			$email = '';
			$pincode = '';
			$amount = '';

			if(!empty($_POST['firstname'])){
				$fullname = $_POST['firstname'];
			}
			if(!empty($_POST['address'])){
				$address = $_POST['address'];
			}
			if(!empty($_POST['mobile'])){
				$mobile = $_POST['mobile'];
			}
			if(!empty($_POST['city'])){
				$city = $_POST['city'];
			}
			if(!empty($_POST['email'])){
				$email = $_POST['email'];
			}

			if(!empty($_POST['pincode'])){
				$pincode = $_POST['pincode'];
			}

			if(!empty($_POST['amount'])){
				$amount = $_POST['amount'];
			}

			// $donate_date = date('Y-m-d H:i:s');
			// $data1 = array(
			//     'name' => $fullname, 
			//     'address' => $address,
			//     'mobile_no' => $mobile,
			//     'email' => $email,
			//     'amount_paid' => $amount,
			//     'donate_date' => $donate_date
			//     	);

		     // $this->admin_model->unique_insert_query('member_details',$data1);
		     // $return_id= $this->admin_model->unique_insert_id_return_query('member_details',$data1);


		$_POST['billing_country'] = $_POST['delivery_country'] = 'India';
		$_POST['billing_state'] = $_POST['delivery_state'] = 'Karnataka';
		$_POST['billing_city'] = $city;
		$_POST['billing_name'] = $_POST['delivery_name']=  $fullname;
		$_POST['delivery_address'] = $address;
		$_POST['delivery_tel'] =  $_POST['mobile_number'] =    $mobile;
		$_POST['billing_email'] =    $email;
		$_POST['amount'] =    $amount;
		$merchant_data='';

		// $working_key='A7F9C460C4A93A5913ED3C7B3F8A29A6';//Shared by CCAVENUES
		// $access_code='AVTA52IJ23BB32ATBB';//Shared by CCAVENUES

		$data=$this->input->post(array(
		'billing_name'=>'billing_name',
		'billing_address'=>'billing_address',
		'billing_email'=>'billing_email',
		'mobile_number'=>'mobile_number',
		'billing_tel'=>'mobile_number',
		'billing_state'=>'billing_state',
		'billing_country'=>'billing_country',
		'billing_city'=>'billing_city',
		'amount'=>'amount',
		'currency'=>'currency',
		'merchant_id'=>'merchant_id',
		'redirect_url'=>'redirect_url',
		'cancel_url'=>'cancel_url',
		'language'=>'language',
		'order_id'=>'order_id',
		'delivery_country'=>'delivery_country',
		'delivery_state'=>'delivery_state',
		'delivery_city'=>'delivery_city',
		'delivery_name'=>'delivery_name',
		'delivery_address'=>'delivery_address',
		'delivery_tel'=>'delivery_tel'
		));

		$merchant_data='';
		$working_key = 'F67C795C01FACB64EA39FE4A33B70729';//Shared by CCAVENUES
		$access_code = 'AVVL04IK03BH30LVHB';//Shared by CCAVENUES
		foreach ($data as $key => $value){
			$merchant_data.=$key.'='.$value.'&';
	}
		$this->load->library('someclass');
		$encrypted_data=$this->someclass->encrypt($merchant_data,$working_key); 
		// die;
		?>

		<form method="post" name="redirect" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
		<?php
		echo "<input type=hidden name=encRequest value=$encrypted_data>";
		echo "<input type=hidden name=access_code value=$access_code>";
		?>
		</form></center><script language='javascript'>document.redirect.submit();</script>
	    <?php
			echo "Payment Works";
			die;
		}

	
	}


	public function submit_grieviance(){

		
		$name = '';
		$mobile_no = '';
		$email = '';
        $grievance = '';
        $document = '';
        $target_file = '';
        $uploadOk = 1;
        $date = date('Y-m-d H:i:s');


		if($_POST){
			if(!empty($_POST['name'])){
				$name = $_POST['name'];
			}
			if(!empty($_POST['mobile'])){
				$mobile_no = $_POST['mobile'];
			}
			if(!empty($_POST['email'])){
				$email = $_POST['email'];
			}
			
			if(!empty($_POST['message_text'])){
				$grievance = $_POST['message_text'];
			}

			if($_FILES){
				$target_dir = "assets/grievance_document/";
				$target_file = $target_dir . basename($_FILES["document"]["name"]);

				if ($_FILES["document"]["size"] > 500000) {
				$status_error =  "Sorry, your file is too large.";
				$uploadOk = 0;
				}

				// Allow certain file formats

				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
				$status_error =  $status_error;
				// if everything is ok, try to upload file
				} else {
				if (move_uploaded_file($_FILES["document"]["tmp_name"], $target_file)) {
				$status_success =  "The file ". htmlspecialchars( basename( $_FILES["document"]["name"])). " has been uploaded.";
				} else {
				$status =  "Sorry, there was an error uploading your file.";
				}
				}
			
			}

			$data = array(
				'name' =>$name,
				'mobile_no'=>$mobile_no,
				'email'=>$email,
				'grievance'=>$grievance,
				'document'=>$target_file,
				'submit_date'=>$date
			);

			if($uploadOk){
		        $this->admin_model->unique_insert_query('public_grievance',$data);
			 	$this->session->set_flashdata('success', $status_success);

        	 }
		     else{
		     	 $this->session->set_flashdata('error', $status_error);
		     }

		}
		$this->contact_us();

	
	}



}
?>