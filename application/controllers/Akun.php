<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('email')) {
			redirect('login');
		}
		$this->load->library('form_validation');
		$this->load->model('Partisipant_model');
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
		$data['partisipant'] = $this->Partisipant_model->getBioPartisipant($this->session->userdata('email'));
		$this->form_validation->set_rules('oldpassword', 'Password Lama', 'required|trim');
		$this->form_validation->set_rules('newpassword', 'Passowrd Baru', 'required|trim');
		$this->form_validation->set_rules('newpassword2', 'Konfirmasi Passoword Baru', 'required|trim|matches[newpassword]');
		if ($this->form_validation->run() == false) {
			$data['judul'] = 'Halaman Akun';
			$this->load->view('templates/header', $data);
			$this->load->view('auth/akun', $data);
			$this->load->view('templates/footer');
		} else {
			$this->_update();
		}
	}
	private function _update()
	{
		$email = $this->session->userdata('email');
		$oldpassword = $this->input->post('oldpassword');
		$newpassword = $this->input->post('newpassword');

		$users = $this->db->get_where('users', ['email' => $email])->row_array();
		// var_dump($users);
		// die;

		if ($users) {
			if (password_verify($oldpassword, $users['password'])) {
				// var_dump($users);
				// die;
				$data = [
					'password' => password_hash($newpassword, PASSWORD_DEFAULT)
				];
				$this->db->set($data);
				$this->db->where('user_id', $users['user_id']);
				$this->db->update('users');
				$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Password Baru Berhasil di Simpan</div>');
				redirect('akun');
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Password Lama tidak Sesuai</div>');
				redirect('akun');
			}
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Mohon Maaf, Email anda tidak teregistrasi</div>');
			redirect('login');
		}
	}
}
