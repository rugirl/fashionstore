<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Admin
 */
Class Admin extends CI_Controller
{
	/**
	 * Admin constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('encryption');
		/*to create an encryption_key for config.php
		echo $key = bin2hex($this->encryption->create_key(16));
		*/
		$this->load->model('user_model');
	}

	/**
	 * Default path of admin
	 */
	public function index()
	{
		if ($this->session->userdata('username')) {
			$this->show_listing($this->session->userdata('username'));
		} else {
			redirect('admin/login');
		}
	}

	/**
	 * Admin user login
	 */
	public function login()
	{
		if ($this->session->userdata('username')) {
			$this->show_listing($this->session->userdata('username'));
		} else {
			$this->form_validation->set_rules('username', 'Username', 'required|trim');
			$this->form_validation->set_rules('password', 'Password', 'required|trim');
			if ($this->form_validation->run() == TRUE) {
				$username = $this->input->post('username');
				$login_check = $this->user_model->checkLogin($username, $this->input->post('password'));
				if ($login_check == "") {
					$this->show_listing($username);
				} else {
					$this->session->set_flashdata('message', $login_check);
					$this->load->view('login');
				}

			} else {
				$this->load->view('login');
			}
		}
	}

	/**
	 * @param $username
	 * Shows listing page
	 */
	public function show_listing($username)
	{
		if (isset($username)) {
			redirect('clothes');
		} else {
			$this->index();
		}
	}

	/**
	 * admin logout
	 */
	public function logout()
	{
		$data = $this->session->all_userdata();
		foreach ($data as $row => $rows_value) {
			$this->session->unset_userdata($row);
			$this->session->set_flashdata('message', "You are logged out");
		}
		redirect('/');
	}

	/**
	 * Tem function to save an admin user
	 */
	public function save()
	{
		$encryptedPassword = $this->encryption->encrypt('admin');
		$data['username'] = 'admin';
		$data['password'] = $encryptedPassword;
		$this->user_model->save($data);
	}
}
