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

	function get_past_program_event_districts(){

		$event_type = '';

		if($_POST['event_type']){
			$event_type = $_POST['event_type'];
		}

		$query="select distinct d_name_ka,district_id from past_events pe left join districts d on pe.district_id = d.d_id where event_type_id=".$event_type." order by district_id";

	    $data['districts']= $districts = $this->admin_model->unique_result_return_query($query);
	   
			   foreach($districts as $d){?>

              <button class="dist btn btn-info past_pgm_type" d_id="<?php echo $d->district_id ; ?>"  ><?php echo $d->d_name_ka ; ?> </button>

               <?php }  

	}


	function get_past_programs(){
		$event_type = '';
		$district_id = '';

		if($_POST['event_type']){
			$event_type = $_POST['event_type'];
		}
		if($_POST['district_id']){
			$district_id = $_POST['district_id'];
		}

		$query ="select * from past_events where event_type_id =".$event_type." and district_id=".$district_id;
		$past_events = $this->admin_model->unique_result_return_query($query);

		foreach ($past_events as $key => $value){ ?>
		<div style="margin-top: 15px;" class="row row-cols-1 ">
			   <h6><?php echo $value->past_event_title; ?></h6>
			   <h6><?php echo $value->past_event_address; ?></h6>
               <div class="col event feed-facebook">
              <!--   <div class="fb-page" data-href="<?php //echo $value->facebook_link ; ?>" data-tabs="timeline" data-width=""
                data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="true"
                data-show-facepile="true">
                <blockquote cite="<?php //echo $value->facebook_link ; ?>" class="fb-xfbml-parse-ignore"><a
                href="https://www.facebook.com/KRSParty">ಕರಾಸ ಪಕ್ಷದ ಫೇಸ್ಬುಕ್</a></blockquote>
                </div> -->

					<div class="fb-video" data-href="https://fb.watch/aDLtwPgEDM/" data-width="500" data-show-text="false">
						<div class="fb-xfbml-parse-ignore">
							<blockquote cite="https://fb.watch/aDLtwPgEDM/">
							<a href="<?php echo $value->facebook_link ; ?>">ಕರಾಸ ಪಕ್ಷದ ಫೇಸ್ಬುಕ್</a>
							
							</blockquote>
						</div>
					</div>
              </div>  

        </div>
		<?php }

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
	


	public function get_existing_members(){
		$mobile_no = $_POST['mobile_no'];
	    $query="select * from member_details WHERE mobile_no=".$mobile_no." and bank_ref_no<>''";
		$member_details = $this->admin_model->unique_row_return_query($query);
		if(!empty($member_details)){
			echo 1;
		}else{
			echo 0;
		}
	}

}

?>
