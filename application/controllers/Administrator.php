<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('email')) {
			redirect('login');
		}
		if ($this->session->userdata('role_id') == 4) {
			redirect('partisipant');
		} else
		if ($this->session->userdata('role_id') == 2) {
			redirect('mentor');
		} else
		if ($this->session->userdata('role_id') == 3) {
			redirect('dudika');
		}
		$this->load->helper('tgl_indo');
		// $this->load->helper('sem_tapel');
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
		$data['judul'] = 'Halaman Beranda';
		$this->load->view('templates/header', $data);
		$this->load->view('administrator/beranda', $data);
		$this->load->view('templates/footer');
	}
	public function present($task_id)
	{
		$data['task_id'] = $task_id;
		$data['partisipant'] = $this->Partisipant_model->getBioPartisipant($this->session->userdata('email'));
		$data['judul'] = 'Halaman Presensi';
		$this->load->view('administrator/ttd', $data);
	}
	public function savepresent()
	{
		$ttd = $this->input->post('ttd');
		$task_id = $this->input->post('task_id');
		if ($ttd) {
			$data = [
				'task_id' => $task_id,
				'signature' => $ttd,
			];
			$this->db->insert('absenses', $data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Anda Berhasil di Simpan</div>');
			redirect('administrator');
		}
	}
	public function atpadd()
	{
		$data['partisipant'] = $this->Partisipant_model->getBioPartisipant($this->session->userdata('email'));
		if (empty($_FILES['atp']['name'])) {
			$this->form_validation->set_rules('atp', 'Dukumen', 'required');
		}
		if ($this->form_validation->run() == false) {
			$data['judul'] = 'Halaman Tambah Jurnal';
			$this->load->view('templates/header', $data);
			$this->load->view('administrator/beranda', $data);
			$this->load->view('templates/footer');
		} else {
			$this->addatp();
		}
	}
	public function addatp()
	{
		$task_id = $this->input->post('task_id');
		$fileName = basename($_FILES["atp"]["name"]);
		$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
		$allowTypes = array('pdf', 'docx', 'PDF', 'DOCX', 'zip', 'ZIP', 'rar', 'RAR');

		if (empty($_FILES["atp"]["name"])) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">File Harus di Upload</div>');
			redirect('administrator');
		} else if (!in_array($fileType, $allowTypes)) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Type File harus sesuai</div>');
			redirect('administrator');
		} else {
			$namafile = $task_id . '-' . date('YmdHis') . "." . $fileType;
			$target_dir = "./public/files/atp/";
			$target_file = $target_dir . $namafile;
			if (move_uploaded_file($_FILES["atp"]["tmp_name"], $target_file)) {
				$data = [
					'task_id' => $task_id,
					'file' => $namafile,
				];
				$this->db->insert('atps', $data);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Anda Berhasil di Simpan</div>');
				redirect('administrator');
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Upload file Gagal</div>');
				redirect('administrator');
			}
		}
	}
	public function addmodul()
	{
		$task_id = $this->input->post('task_id');
		$fileName = basename($_FILES["modul"]["name"]);
		$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
		$allowTypes = array('pdf', 'docx', 'PDF', 'DOCX', 'zip', 'ZIP', 'rar', 'RAR');

		if (empty($_FILES["modul"]["name"])) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">File Harus di Upload</div>');
			redirect('administrator');
		} else if (!in_array($fileType, $allowTypes)) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Type File harus sesuai</div>');
			redirect('administrator');
		} else {
			$namafile = $task_id . '-' . date('YmdHis') . "." . $fileType;
			$target_dir = "./public/files/modul/";
			$target_file = $target_dir . $namafile;
			if (move_uploaded_file($_FILES["modul"]["tmp_name"], $target_file)) {
				$data = [
					'task_id' => $task_id,
					'file' => $namafile,
				];
				$this->db->insert('moduls', $data);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Anda Berhasil di Simpan</div>');
				redirect('administrator');
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Upload file Gagal</div>');
				redirect('administrator');
			}
		}
	}
	public function delatp()
	{
		$ya = $this->input->post('ya');
		$atp_id = $this->input->post('atp_id');
		$atp = $this->Partisipant_model->getATPByID($atp_id);
		if ($ya) {
			if ($atp_id) {
				$this->db->delete('atps', array('id' => $atp_id));
				unlink('./public/files/atp/' . $atp['file']);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data telah dihapus</div>');
				redirect('administrator');
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">Data tidak tersedia</div>');
				redirect('administrator');
			}
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan konfirmasi hapus</div>');
			redirect('administrator');
		}
	}
	public function delmod()
	{
		$ya = $this->input->post('ya');
		$mod_id = $this->input->post('mod_id');
		$mod = $this->Partisipant_model->getMODByID($mod_id);
		if ($ya) {
			if ($mod_id) {
				$this->db->delete('moduls', array('id' => $mod_id));
				unlink('./public/files/modul/' . $mod['file']);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data telah dihapus</div>');
				redirect('administrator');
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">Data tidak tersedia</div>');
				redirect('administrator');
			}
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan konfirmasi hapus</div>');
			redirect('administrator');
		}
	}
	public function delttd()
	{
		$ya = $this->input->post('ya');
		$ttd_id = $this->input->post('ttd_id');
		if ($ya) {
			if ($ttd_id) {
				$this->db->delete('absenses', array('id' => $ttd_id));
				$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data telah dihapus</div>');
				redirect('administrator');
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">Data tidak tersedia</div>');
				redirect('administrator');
			}
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan konfirmasi hapus</div>');
			redirect('administrator');
		}
	}
}
