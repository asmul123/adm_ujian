<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peserta extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('email')) {
			redirect('login');
		}
		if ($this->session->userdata('role_id') == 1) {
			redirect('administrator');
		} else
		if ($this->session->userdata('role_id') == 2) {
			redirect('mentor');
		} else
		if ($this->session->userdata('role_id') == 4) {
			redirect('pengawas');
		}
		$this->load->helper('tgl_indo');
		// $this->load->helper('sem_tapel');
		$this->load->library('form_validation');
		$this->load->model('Peserta_model');
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
		$data['pengguna'] = $this->Peserta_model->getBioPeserta($this->session->userdata('email'));
		$data['judul'] = 'Halaman Beranda';
		$this->load->view('templates/header', $data);
		$this->load->view('peserta/beranda', $data);
		$this->load->view('templates/footer');
	}

	public function ttddh($ba_id)
	{
		$data['ba_id'] = $ba_id;
		$data['judul'] = 'Halaman Presensi';
		$this->load->view('peserta/ttd', $data);
	}
	public function savedh()
	{
		$peserta = $this->Peserta_model->getBioPeserta($this->session->userdata('email'));
		$ttd = $this->input->post('ttd');
		$ba_id = $this->input->post('ba_id');
		if ($ttd) {
			$data = [
				'id_peserta' => $peserta['id_peserta'],
				'id_ba' => $ba_id,
				'ttd' => $ttd
			];
			$this->db->insert('daftar_hadir', $data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Anda Berhasil di Simpan</div>');
			redirect('peserta');
		}
	}
	public function delttd()
	{
		$ya = $this->input->post('ya');
		$dh_id = $this->input->post('dh_id');
		if ($ya) {
			$this->db->delete('daftar_hadir', array('id' => $dh_id));
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Anda Berhasil di Simpan</div>');
			redirect('peserta');
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan konfirmasi hapus</div>');
			redirect('peserta');
		}
	}
}
