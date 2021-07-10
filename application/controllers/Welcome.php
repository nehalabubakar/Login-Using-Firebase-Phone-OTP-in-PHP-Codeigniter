<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

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

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Database_queries');
	}

	public function index()
	{
		$this->load->view('common/header');
		$this->load->view('login');
		$this->load->view('common/footer');
	}

	public function create_account_view()
	{
		$this->load->view('common/header');
		$this->load->view('create-account');
		$this->load->view('common/footer');
	}

	public function create_account()
	{
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone Number', 'trim|required');

		if ($this->form_validation->run()) {
			$new_user_details = array(
				'name'		=>	$this->input->post('name'),
				'email'		=>	$this->input->post('email'),
				'password'	=>	$this->encryption->encrypt($this->input->post('password')),
				'phone'		=>	$this->input->post('phone'),
			);

			$user_created = $this->Database_queries->create_user($new_user_details);

			if ($user_created === true || $user_created === 1) {
				$data['message'] = 'Account Created Successfully';
				$data['class'] = 'alert-success';
			} else {
				$data['message'] = $user_created;
				$data['class'] = 'alert-danger';
			}
		} else {
			$errors = $this->form_validation->error_array();
			$errorKeys = array_keys($errors);
			$data['message'] = $errors[$errorKeys[0]];
			$data['class'] = 'alert-danger';
		}

		echo json_encode($data);
	}

	public function login()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run()) {
			$login_details = array(
				'email'		=>	$this->input->post('email'),
				'password'	=>	$this->input->post('password'),
			);

			$can_login = $this->Database_queries->login($login_details);
			if ($can_login === true || $can_login === 1) {
				$user_session = array(
					'email'		=>	$this->input->post('email'),
				);
				$this->session->set_userdata($user_session);
				$data['message'] = 'Login Successful';
				$data['class'] = 'alert-success';
			} else {
				$data['message'] = $can_login;
				$data['class'] = 'alert-danger';
			}
		} else {
			$errors = $this->form_validation->error_array();
			$errorKeys = array_keys($errors);
			$data['message'] = $errors[$errorKeys[0]];
			$data['class'] = 'alert-danger';
		}

		echo json_encode($data);
	}

	public function login_using_phone_view()
	{
		$this->load->view('common/header');
		$this->load->view('login-using-phone-number');
		$this->load->view('common/footer');
	}

	public function login_using_phone()
	{
		$this->form_validation->set_rules('phone', 'Phone Number', 'trim|required');
		$this->form_validation->set_rules('otp', 'OTP', 'trim');

		if ($this->form_validation->run()) {
			$request_otp = $this->Database_queries->check_user_phone_number_for_OTP($this->input->post('phone'));
			if ($request_otp === true || $request_otp === 1) {
				$data['message'] = 'Sending OTP ...';
				$data['class'] = 'alert-success';
			} else {
				$data['message'] = $request_otp;
				$data['class'] = 'alert-danger';
			}
		} else {
			$errors = $this->form_validation->error_array();
			$errorKeys = array_keys($errors);
			$data['message'] = $errors[$errorKeys[0]];
			$data['class'] = 'alert-danger';
		}

		echo json_encode($data);
	}
}
