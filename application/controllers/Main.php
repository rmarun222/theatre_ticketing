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
	 	$this->load->library('cart');
		$this->load->library('form_validation');
		date_default_timezone_set ( 'Asia/Kolkata' );
		$this->baseURL2 = 'http://'.$_SERVER['HTTP_HOST'].'/admin_theatre_ticketing/';
	}
	
	public function home()
	{

		$data['active'] = 'home'; 	
		$query = "select *,td.IsActive TicketActive from ticket_details td left join troup_details trd on trd.TroupID  = td.TroupID left join genre_details gd on gd.GenreID  = td.GenreID left join language_details ld on td.LanguageID  = ld.LanguageID  left join auditorium_details adt on adt.AuditoriumID  = td.AuditoriumID left join state_details std on std.StateID  = adt.StateID left join districts dst on dst.DistrictID  = adt.DistrictID left join city_details cd on cd.CityID   = adt.CityID ";
		$ticket_details =  $this->admin_model->unique_result_return_query($query);
		$data['ticket_details'] = ''; 

		if(!empty($ticket_details)){
		$data['ticket_details'] = json_decode(json_encode($ticket_details), true); 
		}

		$this->load->view('header',$data);
		$this->load->view('home/home');
		$this->load->view('footer');
	
	}	

	public function theatre_details($tid = ''){
		$data['active'] = 'home'; 	
		if(!empty($tid)){
			$query = "select *,td.IsActive TicketActive from ticket_details td left join troup_details trd on trd.TroupID  = td.TroupID left join genre_details gd on gd.GenreID  = td.GenreID left join language_details ld on td.LanguageID  = ld.LanguageID  left join auditorium_details adt on adt.AuditoriumID  = td.AuditoriumID left join state_details std on std.StateID  = adt.StateID left join districts dst on dst.DistrictID  = adt.DistrictID left join city_details cd on cd.CityID   = adt.CityID where TicketID=".$tid;
			$ticket_details =  $this->admin_model->unique_row_return_query($query);
			$data['ticket_details'] = ''; 

			if(!empty($ticket_details)){
			$data['ticket_details'] = json_decode(json_encode($ticket_details), true); 
			}
			$this->load->view('header',$data);
			$this->load->view('home/theatre_details');
			$this->load->view('footer');

		}else{

		}

	
	

	}
	public function book_ticket($tid = ''){
		$data['active'] = 'home'; 	
		if(!empty($tid)){
			$query = "select *,td.IsActive TicketActive from ticket_details td left join troup_details trd on trd.TroupID  = td.TroupID left join genre_details gd on gd.GenreID  = td.GenreID left join language_details ld on td.LanguageID  = ld.LanguageID  left join auditorium_details adt on adt.AuditoriumID  = td.AuditoriumID left join state_details std on std.StateID  = adt.StateID left join districts dst on dst.DistrictID  = adt.DistrictID left join city_details cd on cd.CityID   = adt.CityID where TicketID=".$tid;
			$ticket_details =  $this->admin_model->unique_row_return_query($query);
			$data['ticket_details'] = ''; 

			if(!empty($ticket_details)){
			$data['ticket_details'] = json_decode(json_encode($ticket_details), true); 
			}
			$this->load->view('header',$data);
			$this->load->view('home/book_ticket');
			$this->load->view('footer');

		}else{

		}

	
	

	}
	public function view_all_this_week()
	{
		$data['active'] = 'home'; 	
		$query = "select *,td.IsActive TicketActive from ticket_details td left join troup_details trd on trd.TroupID  = td.TroupID left join genre_details gd on gd.GenreID  = td.GenreID left join language_details ld on td.LanguageID  = ld.LanguageID  left join auditorium_details adt on adt.AuditoriumID  = td.AuditoriumID left join state_details std on std.StateID  = adt.StateID left join districts dst on dst.DistrictID  = adt.DistrictID left join city_details cd on cd.CityID   = adt.CityID ";
		$ticket_details =  $this->admin_model->unique_result_return_query($query);
		$data['ticket_details'] = ''; 

		if(!empty($ticket_details)){
		$data['ticket_details'] = json_decode(json_encode($ticket_details), true); 
		}

		$this->load->view('header',$data);
		$this->load->view('home/view_all_this_week');
		$this->load->view('footer');

	}

	public function about_us()
	{
  //       print_r($this->cart->contents());
		// die;
		$data['active'] = 'home'; 	
		$this->load->view('header',$data);
		$this->load->view('home/about_us');
		$this->load->view('footer');
	
	}

	public function contact_us()
	{
  //       print_r($this->cart->contents());
		// die;
		$data['active'] = 'home'; 	
		$this->load->view('header',$data);
		$this->load->view('home/contact_us');
		$this->load->view('footer');
	
	}

	public function shop_detail()
	{
		$data['active'] = 'home'; 	

		$query="select *,image_path from item left join item_images on item.item_id = item_images.item_id group by item.item_id limit 100";
		$query="select * from item1";
		$items =  $this->admin_model->unique_result_return_query($query);

		$data['items'] = $items; 	
		$this->load->view('header',$data);
		$this->load->view('shop/shop_detail');
		$this->load->view('footer');
	
	}

	public function shopping_cart()
	{
		$data['active'] = 'home'; 	
		$this->load->view('header',$data);
		$this->load->view('shop/shopping_cart');
		$this->load->view('footer');
	
	

	}

    public function checkout(){

		$data['active'] = 'checkout'; 	
		$query="select * from customers where id=1";
	    $data['customer_details']= $this->admin_model->unique_row_return_query($query);
		$this->load->view('header',$data);

    	$this->load->view('shop/checkout',$data);
		$this->load->view('footer');

    }
	public function item_details($item_id='')
	{


		$data['active'] = 'home'; 	
		$data['item_id'] = 'item_id'; 	
		$query="select * from item1 where item_id=".$item_id;
		$item_details =  $this->admin_model->unique_row_return_query($query);
		$data['item_details'] = $item_details;
		$this->load->view('header',$data);
		$this->load->view('shop/item_details');
		$this->load->view('footer');
	}


	public function cart()
	{
		$data['active'] = 'cart'; 	
		$this->load->view('header',$data);
		$this->load->view('home/cart');
		$this->load->view('footer');
	}




	public function bearers()
	{
		$query="select * from office_bearers where is_deleted=0";
	    $data['bearers']= $this->admin_model->unique_result_return_query($query);

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
	public function programs2()
	{
		$data['active'] = 'programs'; 		

		$query="select * from districts";
	    $data['districts']= $districts = $this->admin_model->unique_result_return_query($query);

	    $query="select distinct pe.event_type_id,et.event_type_name from past_events pe left join event_types et   on pe.event_type_id = et.event_type_id where et.is_deleted = 0";
	    $data['event_types']= $districts = $this->admin_model->unique_result_return_query($query);

		$query="select * from upcoming_events where is_deleted=0 ORDER BY up_event_date_time ASC";
	    $data['upcoming_events']= $districts = $this->admin_model->unique_result_return_query($query);

	    $query="select * from past_events where is_deleted=0 ORDER BY past_event_date_time DESC";
	    $data['past_events']= $districts = $this->admin_model->unique_result_return_query($query);
		
		$this->load->view('header',$data);
		$this->load->view('menu/programs2');
		$this->load->view('footer');
	}

	
	public function media()
	{
		$data['active'] = 'media'; 		
		$query="select * from press_releases where is_deleted=0";
	    $data1['press_releases'] = $press_releases = $this->admin_model->unique_result_return_query($query);

	    $query="select * from press_noets where is_deleted=0";
	    $data1['press_notes'] = $press_releases = $this->admin_model->unique_result_return_query($query);

		$this->load->view('header',$data);
		$this->load->view('menu/media',$data1);
		$this->load->view('footer');
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
			$amount = '560090';

			if(!empty($_POST['firstname'])){
				$fullname = $_POST['firstname'];
			}
			if(!empty($_POST['address'])){
				$address = $_POST['address'];
			}
			$address = 'Karnataka';
			if(!empty($_POST['mobile'])){
				$mobile = $_POST['mobile'];
			}

			if(!empty($_POST['city'])){
				$city = $_POST['city'];
			}
			// if(!empty($_POST['email'])){
			// 	$email = $_POST['email'];
			// }

			$email = 'helpline.krsparty@gmail.com';

			if(!empty($_POST['email'])){
			$email = $_POST['email'];
			}

			if(!empty($_POST['amount'])){
				$amount = $_POST['amount'];
			}

			if(!empty($_POST['pincode'])){
				$pincode = $_POST['pincode'];
			}

		$_POST['billing_country'] = $_POST['delivery_country'] = 'India';
		$_POST['billing_state'] = $_POST['delivery_state'] = 'Karnataka';
		$_POST['billing_city'] = $city;
		$_POST['billing_name'] = $_POST['delivery_name']=  $fullname;
		$_POST['delivery_address'] = $address;
		$_POST['delivery_tel'] = $_POST['billing_tel'] =  $_POST['mobile_number'] =    $mobile;
		$_POST['billing_email'] =    $email;
		$_POST['amount'] =    $amount;
		$_POST['billing_zip'] = $pincode;
		$merchant_data='';

		// $working_key='A7F9C460C4A93A5913ED3C7B3F8A29A6';//Shared by CCAVENUES
		// $access_code='AVTA52IJ23BB32ATBB';//Shared by CCAVENUES

		$data=$this->input->post(array(
		'billing_name'=>'billing_name',
		'billing_address'=>'billing_address',
		'billing_email'=>'billing_email',
		'mobile_number'=>'mobile_number',
		'billing_tel'=>'billing_tel',
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
		'delivery_tel'=>'delivery_tel',
		'billing_zip'=>'billing_zip'
		));

		$merchant_data='';
		$working_key = 'A7F9C460C4A93A5913ED3C7B3F8A29A6';//Shared by CCAVENUES
		$access_code = 'AVTA52IJ23BB32ATBB';//Shared by CCAVENUES


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


	public function save_member_join(){

			if($_POST){
			$_POST['amount'] = 1;

			$media = '';
			$interest = '';
			$pincode = '';
			$mobile_number = '';

			if(!empty($_POST['media'])){
			$media = implode(',',$_POST['media']);
			}

			$email = 'helpline.krsparty@gmail.com';

			if(!empty($_POST['billing_email'])){
				$email = $_POST['billing_email'];
			}

			if(!empty($_POST['interest'])){
			$interest = implode(',',$_POST['interest']);
			}
			if(!empty($_POST['mobile_number'])){
			$mobile_number = $_POST['mobile_number'];
			}
			if(!empty($_POST['gender'])){
			$gender = $_POST['gender'];
			}
			if(!empty($_POST['age'])){
			$age = $_POST['age'];		
			}

			if(!empty($_POST['dob'])){
			$dob = $_POST['dob'];		
			}
			if(!empty($_POST['p_f_h_name'])){
			$p_f_h_name = $_POST['p_f_h_name'];		
			}
			if(!empty($_POST['v_const'])){
			$v_const = $_POST['v_const'];		
			}
			if(!empty($_POST['district'])){
			$district = $_POST['district'];		
			}

			if(!empty($_POST['pincode'])){
				$pincode = $_POST['pincode'];
			}


			$_POST['billing_country'] = $billing_country = $_POST['delivery_country'] = 'India';
			$_POST['billing_state'] = $billing_state =  $_POST['delivery_state'] = 'Karnataka';
			$_POST['billing_city'] = $billing_city = $_POST['delivery_city'] =  $_POST['taluk'];
			$_POST['delivery_name'] = $billing_name = $_POST['billing_name'];
			$_POST['delivery_address'] = $_POST['billing_address'];
			$_POST['delivery_tel'] = $_POST['mobile_number'];
			$_POST['billing_tel'] = $_POST['mobile_number'];
			$_POST['merchant_param1'] = $_POST['gender'];
			$_POST['merchant_param2'] = $_POST['age'];
			$_POST['merchant_param3'] = $_POST['dob'];
			$_POST['merchant_param4'] = $_POST['p_f_h_name'];
			$_POST['merchant_param5'] = $media.'/'.$interest;
			$_POST['promo_code'] = $_POST['v_const'];
			// $_POST['billing_notes'] = $_POST['district'].'/'.$media.'/'.$interest;
			$_POST['billing_notes'] = $_POST['district'];
			$_POST['billing_zip'] = $pincode;


			$query="select * from member_details WHERE mobile_no=".$mobile_number." and bank_ref_no<>''";
		    $member_details = $this->admin_model->unique_row_return_query($query);
		    $member_details = '';

		    // print_r($member_details);


		    if(!empty($member_details)){
		    	$status_error='ಸದಸ್ಯತ್ವ ಈಗಾಗಲೇ ಅಸ್ತಿತ್ವದಲ್ಲಿದೆ. ಇನ್ನೊಂದು ಮೊಬೈಲ್ ಸಂಖ್ಯೆಯನ್ನು ಬಳಸಿ';
			    $this->session->set_flashdata('error', $status_error);

			    $this->join_us();
		    	// redirect('Main/join_us');
		    }else{

			if(isset($_POST['reference_number'])){
				$final_data['payment_mode_id'] = '1';
				$final_data['bank_ref_no'] = $_POST['reference_number'];
				$final_data['tracking_id'] = $_POST['reference_number'];
				$final_data['payment_mode'] = 'offline';
				$final_data['transaction_id'] = '1';
				$final_data['trans_date'] = $up_event_date_time = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $_POST['transaction_date'])));
				$final_data['dob'] = $up_event_date_time = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $_POST['dob'])));
				$final_data['amount_paid'] = $_POST['amount'];
				$final_data['payment_status'] = 'success';
				$final_data['card_name'] = $_POST['billing_name'];
				$final_data['name'] = $_POST['billing_name'];
				$final_data['address'] = $_POST['delivery_address'];
				$final_data['state'] = $billing_state;
				$final_data['zip_code'] = $_POST['billing_zip'];
				$final_data['city'] = $_POST['taluk'];
				$final_data['mobile_no'] = $_POST['mobile_number'];
				$final_data['gender'] = $_POST['gender'];
				$final_data['age'] = $_POST['age'];
				$final_data['p_f_h_name'] =$_POST['p_f_h_name'];;
				$final_data['v_const_id'] =$_POST['v_const'];;
				$final_data['date_of_join'] =date('Y-m-d H:i:s');;
				$final_data['media_id'] =$media;;
				$final_data['interest_id'] =$interest;;
				$final_data['district_id'] =$_POST['district'];;
				$final_data['taluk_id'] =$_POST['taluk'];;
				$final_data['email'] =$email;;


				
				// $insert = $this->admin_model->unique_insert_query('member_details',$final_data);
				$insert = $this->admin_model->unique_insert_id_return_query('member_details',$final_data);

				// echo $insert.'<br>';

				if($insert){
				$string = '<div style="margin-left: auto; margin-right: auto;">';
				$string.= '<center> <P>ಕರ್ನಾಟಕದಲ್ಲಿ ಪ್ರಾದೇಶಿಕ, ಪ್ರಾಮಾಣಿಕ, ಜನಪರ ರಾಜಕಾರಣದ ಮೂಲಕ ಜನಸ್ನೇಹಿ ವ್ಯವಸ್ಥೆ ನಿರ್ಮಾಣ ಮಾಡಲು</P> ಕೆ.ಆರ್.ಎಸ್. ಪಕ್ಷದ ಜೊತೆ ಕೈ ಜೋಡಿಸಿರುವುದಕ್ಕಾಗಿ ನಿಮಗೆ ಧನ್ಯವಾದಗಳು. <b> </b><br>
					<br>ನಿಮ್ಮ ಸದಸ್ಯತ್ವ ಸಂಖ್ಯೆ : <b>OL'.$insert.'</b> </center>';	
				$string.= '<br><center><B>ಪಾವತಿ ವಿವರಗಳು</B><br><br>';
				$string.= '<table border="1">';
				$string.= '<tr><TH style="text-align: center; vertical-align: middle;" >ರೆಫರೆನ್ಸ್ ಸಂಖ್ಯೆ</th><TH style="text-align: center; vertical-align: middle;" >ದಿನಾಂಕ</th><TH style="text-align: center; verti
				cal-align: middle;" >ಮೊತ್ತ</th></tr>';
				$string.= '<tr><td style="text-align: center; vertical-align: middle;" >'.$final_data['bank_ref_no'].'</td><td style="text-align: center; vertical-align: middle;" >'.$final_data['date_of_join'].'</td><td style="text-align: center; vertical-align: middle;" >'.$final_data['amount_paid'].'</td></tr></table><br>
					<a href="'.site_url('Main/home').'"><B>ಮುಖ ಪುಟ</B></a>
				    </center></div>';
				echo $string;
				}else{
					echo 'ತಾಂತ್ರಿಕ ಸಮಸ್ಯೆ ಇದೆ. ದಯವಿಟ್ಟು ಸ್ವಲ್ಪ ಸಮಯದ ನಂತರ ಪ್ರಯತ್ನಿಸಿ';
				}
			}
			else{

			$city_name = 'Bangalore';
			$tid = $_POST['taluk'];
			$query="select * from taluks WHERE t_id=".$tid;
			$taluks = $this->admin_model->unique_row_return_query($query);
			if(!empty($taluks)){

			$city_name = $taluks->taluk_name_ka;
			}
			$_POST['billing_city'] = $city_name;
		    

							$final_data['payment_mode_id'] = '1';
				$final_data['bank_ref_no'] = '';
				$final_data['tracking_id'] ='';
				$final_data['payment_mode'] = 'offline';
				$final_data['transaction_id'] = '1';
				$final_data['trans_date'] = '';
				$final_data['dob'] = $up_event_date_time = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $_POST['dob'])));
				$final_data['amount_paid'] = $_POST['amount'];
				$final_data['payment_status'] = 'success';
				$final_data['card_name'] = $_POST['billing_name'];
				$final_data['name'] = $_POST['billing_name'];
				$final_data['address'] = $_POST['delivery_address'];
				$final_data['state'] = $billing_state;
				$final_data['zip_code'] = $_POST['billing_zip'];
				$final_data['city'] = $_POST['taluk'];
				$final_data['mobile_no'] = $_POST['mobile_number'];
				$final_data['gender'] = $_POST['gender'];
				$final_data['age'] = $_POST['age'];
				$final_data['p_f_h_name'] =$_POST['p_f_h_name'];;
				$final_data['v_const_id'] =$_POST['v_const'];;
				$final_data['date_of_join'] =date('Y-m-d H:i:s');;
				$final_data['media_id'] =$media;;
				$final_data['interest_id'] =$interest;;
				$final_data['district_id'] =$_POST['district'];;
				$final_data['taluk_id'] =$_POST['taluk'];;
				$final_data['email'] =$email;;
				// $insert = $this->admin_model->unique_insert_query('member_details',$final_data);
				$insert = $this->admin_model->unique_insert_id_return_query('member_details',$final_data);

					ECHO $insert;
		    DIE;

		    IF((!empty($insert))){
				
			$merchant_data='';
			// $working_key='A7F9C460C4A93A5913ED3C7B3F8A29A6';//Shared by CCAVENUES
			// $access_code='AVTA52IJ23BB32ATBB';//Shared by CCAVENUES
			$data=$this->input->post(array(
			'billing_name'=>'billing_name',
			'billing_address'=>'billing_address',
			'billing_email'=>'billing_email',
			'mobile_number'=>'mobile_number',
			'billing_tel'=>'billing_tel',
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
			'merchant_param5'=>'merchant_param5',
			'promo_code'=>'promo_code',
			'billing_zip'=>'billing_zip'
			));

			$merchant_data='';
			$working_key = 'F67C795C01FACB64EA39FE4A33B70729';//Shared by CCAVENUES
			$access_code = 'AVVL04IK03BH30LVHB';//Shared by CCAVENUES

			// $working_key = 'A7F9C460C4A93A5913ED3C7B3F8A29A6';//Shared by CCAVENUES
			// $access_code = 'AVTA52IJ23BB32ATBB';//Shared by CCAVENUES

			$working_key='A7F9C460C4A93A5913ED3C7B3F8A29A6';//Shared by CCAVENUES
			$working_key='534F6FF5EB674B57965AD0ED21F47581';//Shared LOCALHOST 1044
			$working_key='534F6FF5EB674B57965AD0ED21F47581';//Shared LOCALHOST 1044
			$access_code='AVTA52IJ23BB32ATBB';//Shared by CCAVENUES
			$access_code='AVWT58IK08BL28TWLB';//Shared by CCAVENUES LOCALHOST 1044
			$access_code='AVWT58IK08BL28TWLB';//Shared by CCAVENUES LOCALHOST 1044
	// echo '<pre>';
	// print_r($data);
	// die;
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


		    }

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

	    $query="select * from assembly_constituencies order by assembly_name_english ASC";
	    $data1['assembly_constituencies']= $assembly_constituencies = $this->admin_model->unique_result_return_query($query);

		$data['active'] = 'join_us'; 		
		$this->load->view('header',$data);
		$this->load->view('menu/join_us',$data1);
		$this->load->view('footer');
	}

	public function donate()
	{

		    ini_set('display_errors', 1);
			$data['active'] = 'donate'; 		
			$this->load->view('header',$data);
			$this->load->view('donate');
			$this->load->view('footer');
	
	}


	public function submit_grievance(){
		print_r($_POST);
		die;
	}



    public function practice(){

    	echo '<pre>';
    	$a_chunk  = array(11,22,33,44,55);
    	$a_chunk2  = array(111,222,333,444,555);
    	print_r($a_chunk);

    	$a_chunk_new = array_chunk($a_chunk,4);
    	// print_r($a_chunk_new);
        //array_combine
    	// Creates an array by using the elements from one "keys" array and one "values" array
    	// Message:  array_combine(): Both parameters should have an equal number of elements

    	$combine_arr = array_combine($a_chunk,$a_chunk2);
    	print_r($combine_arr);


    	// array_count_values()	Counts all the values of an array

    	$a_count = array(1,2,3,4,1,2,6,7,8,4);
    	$a = array_count_values($a_count);
    	print_r($a);

    	// array difference
    	// This function compares the values of two (or more) arrays, and return an array that contains the entries from array1 that are not present in array2 or array3, etc.

    	$a_dif1 = array(1,2,3,4,1,6,7,8,4,9);
    	$a_dif2 = array(1,3,4,1,6,7,4);
    	$a_dif3 = array(1,3,1,6,7,4);

    	$a_diff = array_diff($a_dif1,$a_dif2,$a_dif3);
    	print_r($a_diff);



    	// The array_fill() is an inbuilt-function in PHP and is used to fill an array with values. This function basically creates an user-defined array with a given pre-filled value.


    	$start_index = 2; $number_elements = 3;
        $values = "Geeks";
    	$a_fill = array_fill($start_index, $number_elements, $values);
        print_r($a_fill);

        // Fill an array with values, specifying keys:

		$keys=array("a","b","c","d");
		$a1=array_fill_keys($keys,"blue");
		print_r($a1);


		// The array_filter() function iterates over each value in the array, passing them to the user-defined function or the callback function. If the callback function returns true then the current value of the array is returned into the result array otherwise not.



		$array = array(12, 0, 0, 18, 27, 0, 46);
		// print_r(array_filter($array, $this->Even()));


	 //   public function Even($array)
		// {
		// // returns if the input integer is even
		// if($array%2==0)
		// return TRUE;
		// else 
		// return FALSE; 
		// }

		// The array_flip() function flips/exchanges all keys with their associated values in an array.
		// Flip all keys with their associated values in an array:

		$a_flip = array(9,4,4,34,34,344,4,44,4,4,44,4);
		print_r(array_flip($a_flip));


		// array_intersect()
		// Compare the values of two arrays, and return the matches:
		$a_int1 = array(1,2,3,4,1,6,7,8,4,9);
    	$a_int2 = array(1,3,4,1,6,7,4);

    	print_r(array_intersect($a_int1, $a_int2));


    	// array_key_exists()
    	// Check if the key "Volvo" exists in an array:
    	$a=array("Volvo"=>"XC90","BMW"=>"X5");
    	print_r(array_key_exists('Volvo',$a));


    	// array_keys() Function
		

		// Send each value of an array to a function, multiply each value by itself, and return an array with the new values: 
		
		function myfunction($num)
		{
		  return($num*$num);
		}

		$a=array(1,2,3,4,5);
		print_r(array_map("myfunction",$a));   	

		$a1=array("red=>green");
		$a2=array("blue=>yellow");
		print_r(array_merge($a1,$a2));

		// array_multisort()
		// sorts an array elements in ascending order

		$a=array("Dog","Cat","Horse","Bear","Zebra");
		array_multisort($a,SORT_DESC );
		print_r($a);

		$am = array(9,6,2,4,6,2,3,7);
		$am2 = array(1,34,63,9,0,7,8,2);
		echo 'multisort';
		array_multisort($am,$am2);
		print_r($am);


// 		The array_pad() function inserts a specified number of elements, with a specified value, to an array.

// Tip: If you assign a negative size parameter, the function will insert new elements BEFORE the original element

		$a=array("red","green");
		print_r(array_pad($a,5,"blue"));

		// Array ( [0] => red [1] => green [2] => blue [3] => blue [4] => blue )

		// array_pop() : Deletes the last element of the array_chunk(input, size)

		$ap = array(4,6,8);

		$b = array_pop($ap);


		print_r($ap);

		// Array product

		// Returns the product of elements of array

		$ap1 = array(1,2,2,30);

		echo array_product($ap1);

		// array_push()
		// Inserts the elements at the end of the array


		 // array_reverse()
		// Reverses the array element

		// Return an array in the reverse order:

		// preserve	Optional. Specifies if the function should preserve the keys of the array or not. Possible values:

		$a=array("Volvo","XC90",array("BMW","Toyota"));
		$reverse=array_reverse($a);
		$preserve=array_reverse($a,true);

		print_r($a);
		print_r($reverse);
		print_r($preserve);


		// array_search(needle, haystack)
		// The array_search() function search an array for a value and returns the key.
		$a_search = array(1,5,6,7);

		echo array_search(2, $a_search);

        // Array_shift removes the first element of the array

        $a_shift = array(100,3,6,8,9);
        echo '<br>'.array_shift($a_shift);
        
        print_r($a_shift);


        // array slice 
        // returns selected parts of an array.

		$a=array("red","green","blue","yellow","brown");
		print_r(array_slice($a,2));

		// The array_splice() function removes selected elements from an array and replaces it with new elements. The function also returns an array with the removed elements.

		// array sum
		// Return the sum of all the values in the array    
		$a_sum = array(1,5,7,8);
		echo array_sum($a_sum);


		// array unique
		// removes duplicate element from array
		$arr_unique = array(1,2,3,4,5,6,1,2);
		print_r(array_unique($arr_unique));

		// array_unshift
		// Insert the element "blue" to begining of an array:
    }



 
}
?>