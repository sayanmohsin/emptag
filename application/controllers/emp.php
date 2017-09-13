<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emp extends CI_Controller {

	function __construct () {
			parent::__construct ();
			$this->load->model('user');
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

// Show login page
	public function index() {
		$data = $this->Init->initPath ('/emp');
		$data += $this->session->userdata();
		// log_message('info','sayan ');
		// log_message('info',print_r($data,TRUE));
		if($this->session->userdata('loggedIn'))
		{
			$this->load->view('pages/empview/empdashboardview',$data);
		}else{
			$this->load->view('pages/empview/emploginview',$data);
		}
	}

	// Check for user login process
	public function empLoginProcess() {
		$data = $this->Init->initPath ('/emp');
		// set variables from the form
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		// log_message('info','$username '.$username);
		// log_message('info','$password '.$password);
		$userData = $this->User->checkUser($username, $password);
		// log_message('info',print_r($userData,TRUE));

		if ($userData['authStatus'] == FALSE) {
				echo $userData['authStatus'].","."incorrect username or password";
			exit;
		}elseif ($userData['authStatus'] == TRUE) {
			// set session user datas
			$newdata = array(
				'uid'  => $userData['uid'],
				'name'  => $userData['name'],
				'username'  => $userData['username'],
				'loggedIn' => TRUE
				);

			$this->session->set_userdata($newdata);

			log_message('info',print_r($_SESSION,TRUE));
			log_message('info',print_r($userData,TRUE));
			// user login ok
			// $this->load->view('pages/dashboardview',$data);
			// header('Location: ' . base_url() . '/admin');
			exit;
		}
	}

		// Check for user login process
		public function tagProcess() {
			$data = $this->Init->initPath ('/emp');
			// $newdata = array(
			// 	'uid'  => $userData['uid'],
			// 	'name'  => $userData['name'],
			// 	'username'  => $userData['username'],
			// 	'loggedIn' => TRUE
			// 	);
			// set variables from the form
			$uid = $this->input->post('uid');
			$tagp = $this->input->post('tagp');
			$dateTime = $this->input->post('dateTime');

			// log_message('info','$username '.$username);
			// log_message('info','$password '.$password);
				if($tagp == 0){
					log_message('info','out');
					$processTagOut = $this->User->tagInDb($uid, $dateTime);
				}
				elseif($tagp == 1){	
					log_message('info','in');
					$processTagIn = $this->User->tagInDb($uid, $dateTime);
				}
		}

	// Logout from admin page
	public function logout() {
		$data = $this->Init->initPath ('/emp');
		$data += $this->Init->dbCustom();
		// Destroy session data
		$this->session->sess_destroy();
		redirect(base_url() . 'emp', 'refresh');
		// header('Location: ' . base_url() . 'admin');
		// exit;
	}

}
