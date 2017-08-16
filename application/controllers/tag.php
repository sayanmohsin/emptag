<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag extends CI_Controller {

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
		$data = $this->Init->initPath ('/tag');
		$data += $this->Init->dbCustom();
		$data += $this->session->userdata();
		// log_message('info','sayan ');
		// log_message('info',print_r($data,TRUE));
		if($this->session->userdata('loggedIn'))
		{
			$this->load->view('pages/tagview/taggedview',$data);
		}else{
			$this->load->view('pages/tagview/taggingview',$data);
		}
	}

	// Check for user login process
	public function taggingProcess() {
		$data = $this->Init->initPath ('/admin');
		$data += $this->Init->dbCustom();
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
	// Logout from admin page
	public function logout() {
	$data = $this->Init->initPath ('/admin');
	$data += $this->Init->dbCustom();
	// Destroy session data
	$this->session->sess_destroy();
	redirect(base_url() . 'admin', 'refresh');
	// header('Location: ' . base_url() . 'admin');
	// exit;
	}

}
