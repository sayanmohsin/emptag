<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mainctrl extends CI_Controller {

		function __construct () {
				parent::__construct ();
		}
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
	public function index()
	{
		$data = $this->Init->initPath ('/mainctrl');
		$data += $this->Init->dbCustom();
		$this->load->view('pages/mainview',$data);
		//$this->user();
	}
	public function timeSlot($q)
	{
		$data = $this->Init->initPath ('/mainctrl');
		$data += $this->Init->dbCustom();
		$con = $data["con"];
		$course = $q;
		$hint = $this->Data->timeSlotFetch($con,$course);
		echo $hint;
		//$this->user();
	}
	public function calculateFees($course,$time,$date,$length,$coupon){

		$data = $this->Init->initPath ('/Home');
		$data += $this->Init->dbCustom();
		$con = $data["con"];
		// log_message('info','couponFirst '.$coupon);
		if ($coupon == "0") {
			# code...
			$coupon_code = "0";
			// log_message('info','coupon_code1 '.$coupon_code);
		}
		else{
			# code...
			$coupon_code = $coupon;
			// log_message('info','coupon_code2 '.$coupon_code);
		}


		// log_message('info','course '.$course);
		//
		// log_message('info','time '.$time);
		// log_message('info','date '.$date);
		// log_message('info','length '.$length);
		// log_message('info','coupon '.$coupon);

		switch($time){
		    case 1: $table = "fees_morning";
		        break;
		    case 2: $table = "fees_afternoon";
		        break;
		    case 3: $table = "fees_evening";
		        break;
		    default: $table = "fees_hours";
		        break;
		}

		$reg_fees = $this->Data->regFees($con);

		$feesDat = $this->Data->feesDat($con,$table,$course);
		$fees_row_count = $feesDat["fees_row_count"];
		$fees_row = $feesDat["fees_row"];

		$finalFees = $this->Data->totalFees($con,$table,$course,$length,$reg_fees,$fees_row_count,$fees_row);
		$fees = $finalFees["fees"];
		$total_fees = $finalFees["total_fees"];

		if($coupon_code != "0"){
			$discount = $this->Data->discountRate($con,$coupon_code,$total_fees);
		}else{
			$discount["rate"] = 0;
			$discount["status"] = "";
		}

		$discountRate = $discount["rate"];
		$discountStatus = $discount["status"];

		$total_fees -=$discountRate;


    echo $fees.",".$reg_fees.",".$total_fees.",".$discountStatus.",".$discountRate;
	}
		// public function review($course,$time,$date,$length,$courseFees,$regFees,$totalFees,$discountRate){
		// 	$data = $this->Init->initPath ('/Home');
		// 	$data += $this->Init->dbCustom();
		//
		// 	log_message('info','$course '.$course);
		// 	log_message('info','$time '.$time);
		// 	log_message('info','$date '.$date);
		// 	log_message('info','$length '.$length);
		// 	log_message('info','$courseFees '.$courseFees);
		// 	log_message('info','$regFees '.$regFees);
		// 	log_message('info','$totalFees '.$totalFees);
		// 	log_message('info','$discountRate '.$discountRate);
		//
		// 	$option = array(
    //     'course' => $course,
    //     'time' => $time,
		// 		'date' => $date,
    //     'length' => $length,
		// 		'courseFees' => $courseFees,
    //     'regFees' => $regFees,
		// 		'totalFees' => $totalFees,
    //     'discountRate' => $discountRate
		// 	);
		// 	$data['option']= $option;
		// 	log_message('info',print_r($option,TRUE));
		// 	log_message('info',print_r($data,TRUE));
		// 	$this->load->view('pages/cofirmview', $data);
		// }
		public function review(){
			$data = $this->Init->initPath ('/Home');
			$data += $this->Init->dbCustom();
			$data += $this->Init->commonVariables();

			$course = $this->input->post('course');
			$courseAct = $this->input->post('courseAct');
			$time = $this->input->post('time');
			$timeAct = $this->input->post('timeAct');
			$date = $this->input->post('date');
			$dateAct = $this->input->post('dateAct');
			$length = $this->input->post('length');
			$lengthAct = $this->input->post('lengthAct');
			$courseFees = $this->input->post('courseFees');
			$regFees = $this->input->post('regFees');
			$totalFees = $this->input->post('totalFees');
			$discountRate = $this->input->post('discountRate');

			// log_message('info','$course '.$course);
			// log_message('info','$time '.$time);
			// log_message('info','$date '.$date);
			// log_message('info','$length '.$length);
			// log_message('info','$courseFees '.$courseFees);
			// log_message('info','$regFees '.$regFees);
			// log_message('info','$totalFees '.$totalFees);
			// log_message('info','$discountRate '.$discountRate);

			$option = array(
				'course' => $course,
				'courseAct' => $courseAct,
				'time' => $time,
				'timeAct' => $timeAct,
				'date' => $date,
				'dateAct' => $dateAct,
				'length' => $length,
				'lengthAct' => $lengthAct,
				'courseFees' => $courseFees,
				'regFees' => $regFees,
				'totalFees' => $totalFees,
				'discountRate' => $discountRate
			);
			$data['option']= $option;
			// log_message('info',print_r($option,TRUE));
			// log_message('info',print_r($data,TRUE));
			// $this->reviewpage($data);
			$this->load->view('pages/confirmview',$data);
		}
		// public function reviewpage($data){
		// 	$this->load->view('pages/confirmview',$data);
		// }
		public function saveContinueCtrl(){
			$data = $this->Init->initPath ('/admin');
			$data += $this->Init->dbCustom();

			$response                         = array();
			$response['status']               = false;
			$response['message']              = "Invalid request";

			$bookData['name'] = $this->input->post('name');
			$bookData['email'] = $this->input->post('email');
			$bookData['dob'] = $this->input->post('dob');
			$bookData['gender'] = $this->input->post('gender');
			$bookData['nationality'] = $this->input->post('nationality');
			$bookData['passportNationality'] = $this->input->post('passportNationality');
			$bookData['addressline1'] = $this->input->post('addressline1');
			$bookData['addressline2'] = $this->input->post('addressline2');
			$bookData['zipcode'] = $this->input->post('zipcode');
			$bookData['city'] = $this->input->post('city');
			$bookData['country'] = $this->input->post('country');
			$bookData['region'] = $this->input->post('region');
			// log_message('info',print_r($bookData,TRUE));

			$bookDataStatus = $this->Data->saveBookDataDB ($bookData);

			if ($bookDataStatus == true){

			//Email Sending
			$msgHeader = "Hello,<br>".$bookData['name']."<br><br>";
			$msgContent = "We are pleased to inform you that your submission has been accepted with the following details.<br><br>";
			$msgDetails = "<b>Name:</b> " . $bookData['name'] . "<br><b>Email:</b> " . $bookData['email'] . "<br><b>Date of Birth:</b> " . $bookData['dob'] . "<br>
			<b>Gender:</b> " . $bookData['gender'] . "<br><b>Nationality:</b> " . $bookData['nationality'] . "<br><b>Passport Nationality:</b> " . $bookData['passportNationality'] .
			"<br><br><b><u>Address</u></b><br><b>Address Line 1:</b> " . $bookData['addressline1'] . "<br><b>Address Line 2:</b> " . $bookData['addressline2'] .
			"<br><b>Zip Code:</b> " . $bookData['zipcode'] . "<br><b>City:</b> " . $bookData['city'] . "<br><b>Country:</b> " . $bookData['country'] .
			"<br><b>Region:</b> " . $bookData['region'] . "<br><br>";
			$msgFooter = "With Regards<br>UKCE";

			$message = $msgHeader . $msgContent . $msgDetails . $msgFooter ; log_message('info','$message '.$message);

			$from = '';

			$list = array('sayan@regentglobal.org', "sreekumar@regentglobal.org");

			//$to = 'sayan_mohsin@yahoo.com';

			$to = $list;
			$subject = "Booking Confirmation";
			// $message =$msgContent;
			$emailData = array();
			$emailData['from']  = $from;
			$emailData['to']  = $to;
			$emailData['subject']  = $subject;
			$emailData['message']  = $message;


			$emailStatus = $this->Notice->sendEmail($emailData);
			log_message('info','$emailStatus '.$emailStatus);
			if ($emailStatus == TRUE)
			{
				log_message('info','SUCESS '.$emailStatus);
				//mail sent
			// $this->session->set_flashdata('flash','<div class="alert alert-success text-center">Your mail has been sent successfully!</div>');
			// $data['title'] = "Contact Us";
			// $this->load->view('Contact_view', $data);
			}

			else if($emailStatus == FALSE)
			{
				log_message('info','ERROR '.$emailStatus);
				//error
			// $this->session->set_flashdata('flash','<div class="alert alert-danger text-center">There is error in sending mail! Please try again later</div>');
			// $data['title'] = "Contact Us";
			// $this->load->view('Contact_view', $data);
			}

		}
			if ($bookDataStatus){
				$response['status']  = true;
				$response['message'] = "Booking Save Status Follows";
				$response['data']    = NULL;
				echo json_encode ($response);
				// echo $message;
				// echo json_encode ($PromoListData);
				return 1;
			}
		}
}
