<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role_id') == 1) {
				redirect('administrator');
			} else
			if ($this->session->userdata('role_id') == 2) {
				redirect('mentor');
			} else
			if ($this->session->userdata('role_id') == 3) {
				redirect('dudika');
			} else
			if ($this->session->userdata('role_id') == 4) {
				redirect('partisipant');
			}
		}
		$this->load->library('form_validation');
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
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Kata Sandi', 'required');
		if ($this->form_validation->run() == false) {
			$data['judul'] = 'Halaman Login';
			$this->load->view('auth/login', $data);
		} else {
			$this->_login();
		}
	}
	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$users = $this->db->get_where('users', ['email' => $email])->row_array();
		// var_dump($users);
		// die;

		if ($users) {
			if (password_verify($password, $users['password'])) {
				// var_dump($users);
				// die;
				$data = [
					'email' => $users['email'],
					'role_id' => $users['role_id']
				];
				$this->session->set_userdata($data);
				redirect('partisipant');
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Kata Sandi anda salah</div>');
				redirect('login');
			}
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Mohon Maaf, Email anda tidak teregistrasi</div>');
			redirect('login');
		}
	}
}
