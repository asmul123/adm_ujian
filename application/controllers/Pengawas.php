<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengawas extends CI_Controller
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
			redirect('panitia');
		} else
		if ($this->session->userdata('role_id') == 3) {
			redirect('peserta');
		}
		$this->load->helper('tgl_indo');
		// $this->load->helper('sem_tapel');
		$this->load->library('form_validation');
		$this->load->model('Pengawas_model');
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
		$data['pengguna'] = $this->Pengawas_model->getBioPengawas($this->session->userdata('email'));
		$data['judul'] = 'Halaman Beranda';
		$this->load->view('templates/header', $data);
		$this->load->view('pengawas/beranda', $data);
		$this->load->view('templates/footer');
	}
	function get_kelas()
	{
		$ruang = $this->input->post('id', TRUE);
		$data = $this->Pengawas_model->getKelasPeserta($ruang);
		echo json_encode($data);
	}

	public function addba()
	{
		$nama = $this->input->post('nama');
		$tgl = $this->input->post('tgl');
		$mulai = $this->input->post('mulai');
		$sampai = $this->input->post('sampai');
		$mapel = $this->input->post('mapel');
		$ruang = $this->input->post('ruang');
		$kelas = $this->input->post('kelas');
		$absen = $this->input->post('absen');
		$count = count($absen);
		$pa = "";
		for ($i = 0; $i < $count; $i++) {
			$pa = $pa . "#" . $absen[$i];
		}
		$catatan = $this->input->post('catatan');
		$pengawas = $this->Pengawas_model->getBioPengawas($this->session->userdata('email'));

		$data = [
			'id_pengawas' => $pengawas['id'],
			'nama' => $nama,
			'tanggal' => $tgl,
			'ruang' => $ruang,
			'kelas' => $kelas,
			'mapel' => $mapel,
			'mulai' => $mulai,
			'sampai' => $sampai,
			'absen' => $pa,
			'catatan' => $catatan
		];
		$this->db->insert('berita_acara', $data);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Anda Berhasil di Simpan</div>');
		redirect('pengawas');
	}
	public function ttdba($ba_id)
	{
		$data['ba_id'] = $ba_id;
		$data['pengawas'] = $this->Pengawas_model->getBioPengawas($this->session->userdata('email'));
		$data['judul'] = 'Halaman Presensi';
		$this->load->view('pengawas/ttd', $data);
	}
	public function saveba()
	{
		$ttd = $this->input->post('ttd');
		$ba_id = $this->input->post('ba_id');
		if ($ttd) {
			$data = [
				'ttd' => $ttd
			];
			$this->db->set($data);
			$this->db->where('id', $ba_id);
			$this->db->update('berita_acara');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Anda Berhasil di Simpan</div>');
			redirect('pengawas');
		}
	}
	public function delttd()
	{
		$ya = $this->input->post('ya');
		$ba_id = $this->input->post('ba_id');
		if ($ya) {
			$data = [
				'ttd' => ''
			];
			$this->db->set($data);
			$this->db->where('id', $ba_id);
			$this->db->update('berita_acara');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Anda Berhasil di Simpan</div>');
			redirect('pengawas');
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan konfirmasi hapus</div>');
			redirect('pengawas');
		}
	}
	public function delba()
	{
		$ya = $this->input->post('ya');
		$ba_id = $this->input->post('ba_id');
		if ($ya) {
			$this->db->delete('berita_acara', array('id' => $ba_id));
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Anda Berhasil di Simpan</div>');
			redirect('pengawas');
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan konfirmasi hapus</div>');
			redirect('pengawas');
		}
	}
}
