<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

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
	}

	function get_taluks(){
		$d_id = '';
		$taluk_list = '';
		if(!empty($_POST['dist_id'])){
			$d_id = $_POST['dist_id'];
			$query="select * from taluks WHERE d_id=".$d_id;
			$taluks = $this->admin_model->unique_result_return_query($query);
			$taluk_list = '<option value="">ತಾಲ್ಲೂಕನ್ನು ಆಯ್ಕೆ ಮಾಡಿ</option>';
			foreach ($taluks as $d) {
				$taluk_list.='<option value="'.$d->t_id.'">'.$d->taluk_name_ka.'</option>';
			}
		}

		echo $taluk_list;
	}
	
}
?>