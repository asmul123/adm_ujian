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
			redirect('pengawas');
		} else
		if ($this->session->userdata('role_id') == 2) {
			redirect('mentor');
		} else
		if ($this->session->userdata('role_id') == 3) {
			redirect('peserta');
		}
		$this->load->helper('tgl_indo');
		// $this->load->helper('sem_tapel');
		$this->load->library('form_validation');
		$this->load->library('Pdf'); // MEMANGGIL LIBRARY YANG KITA BUAT TADI
		$this->load->model('Admin_model');
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
		$data['pengguna'] = $this->Admin_model->getBioPengawas($this->session->userdata('email'));
		$data['judul'] = 'Halaman Beranda';
		$this->load->view('templates/header', $data);
		$this->load->view('administrator/beranda', $data);
		$this->load->view('templates/footer');
	}
	public function cetakba($id)
	{
		if ($id) {
			$databa = $this->Admin_model->getBAbyID($id);
			$splittgl = explode('-', $databa['tanggal']);
			$jmlpes = $this->Admin_model->getCountPeserta($databa['kelas'], $databa['ruang']);
			$pesertaabsen = explode("#", $databa['absen']);
			$jmlabsen = count($pesertaabsen) - 1;
			for ($i = 0; $i < $jmlabsen+1; $i++) {
				if ($pesertaabsen[$i]<>""){
					if ($pa <> ""){
						$pa = $pa . ", ";
					}
				$pa = $pa . $pesertaabsen[$i];
				}
			}
			$jmlhadir = $jmlpes - $jmlabsen;
			$pdf = new FPDF('P', 'mm', array(210, 330));
			$pdf->SetTitle('Berita Acara PTS ' . $databa['mapel']);
			$pdf->AddPage();
			$pdf->Image(base_url() . 'public/images/kop.png', 12, 10, 185);
			$pdf->SetFont('Arial', 'B', 14);
			$pdf->SetFont('');
			$pdf->Ln(3);
			$pdf->Cell(19);
			$pdf->Cell(185, 2, 'PEMERINTAH DAERAH PROVINSI JAWA BARAT', 0, 1, 'C');
			$pdf->Ln(4);
			$pdf->Cell(19);
			$pdf->SetFont('Arial', 'B', 16);
			$pdf->Cell(185, 2, 'DINAS PENDIDIKAN', 0, 1, 'C');
			$pdf->Ln(5);
			$pdf->Cell(19);
			$pdf->SetFont('Arial', 'B', 18);
			$pdf->Cell(185, 2, 'SMK NEGERI 1 GARUT', 0, 1, 'C');
			$pdf->Ln(4);
			$pdf->Cell(19);
			$pdf->SetFont('Arial', 'B', 10);
			$pdf->SetFont('');
			$pdf->Cell(185, 2, 'Jalan Cimanuk No. 309 A Telp (0262) 233316', 0, 1, 'C');
			$pdf->Ln(2);
			$pdf->Cell(19);
			$pdf->Cell(180, 2, 'Fax: (0262) 233316 Website : smknegeri1garut.sch.id Email : smkn1garut@ymail.com', 0, 1, 'C');
			$pdf->Ln(2);
			$pdf->Cell(19);
			$pdf->Cell(185, 2, 'Tarogong Kidul - Garut 44151', 0, 1, 'C');
			$pdf->Ln();
			$pdf->SetFont('Arial', 'B', 12);
			$pdf->Ln(8);
			$pdf->Cell(185, 2, 'BERITA ACARA PENILAIAN TENGAH SEMESTER GANJIL', 0, 1, 'C');
			$pdf->Ln(3);
			$pdf->Cell(185, 2, 'TAHUN PELAJARAN 2022-2023', 0, 1, 'C');
			$pdf->Ln(10);
			$pdf->Cell(12);
			$pdf->SetFont('Times', '', 12);
			$pdf->MultiCell(170, 7, 'Pada hari ini ' . hari_indo($databa['tanggal']) . ' tanggal ' . terbilang($splittgl[2]) . ' bulan ' . terbilang($splittgl[1]) . ' tahun ' . terbilang($splittgl[0]) . '. Telah dilaksanakan Ujian Sekolah Tahun Pelajaran 2020-2021 mulai dari pukul ' . $databa['mulai'] . ' sampai dengan pukul ' . $databa['sampai'] . ' Pada :', 0, 'J', FALSE);
			$pdf->Ln(5);
			$pdf->Cell(20);
			$pdf->Cell(10, 0, 'Kelas', 0, 1);
			$pdf->Cell(100);
			$pdf->Cell(10, 0, ':', 0, 1);
			$pdf->Cell(102);
			$pdf->Cell(10, 0, $databa['kelas'], 0, 1);
			$pdf->Ln(7);
			$pdf->Cell(20);
			$pdf->Cell(10, 0, 'Ruang', 0, 1);
			$pdf->Cell(100);
			$pdf->Cell(10, 0, ':', 0, 1);
			$pdf->Cell(102);
			$pdf->Cell(10, 0, $databa['ruang'], 0, 1);
			$pdf->Ln(7);
			$pdf->Cell(20);
			$pdf->Cell(10, 0, 'Mata Pelajaran', 0, 1);
			$pdf->Cell(100);
			$pdf->Cell(10, 0, ':', 0, 1);
			$pdf->Cell(102);
			$pdf->Cell(10, 0, $databa['mapel'], 0, 1);
			$pdf->Ln(7);
			$pdf->Cell(20);
			$pdf->Cell(10, 0, 'Jumlah Peserta didik yang seharusnya', 0, 1);
			$pdf->Cell(100);
			$pdf->Cell(10, 0, ':', 0, 1);
			$pdf->Cell(102);
			$pdf->Cell(10, 0, $jmlpes . ' Peserta didik', 0, 1);
			$pdf->Ln(7);
			$pdf->Cell(20);
			$pdf->Cell(10, 0, 'Jumlah Peserta didik yang hadir', 0, 1);
			$pdf->Cell(100);
			$pdf->Cell(10, 0, ':', 0, 1);
			$pdf->Cell(102);
			$pdf->Cell(10, 0, $jmlhadir . ' Peserta didik', 0, 1);
			$pdf->Ln(7);
			$pdf->Cell(20);
			$pdf->Cell(10, 0, 'Jumlah Peserta didik yang tidak hadir', 0, 1);
			$pdf->Cell(100);
			$pdf->Cell(10, 0, ':', 0, 1);
			$pdf->Cell(102);
			$pdf->Cell(10, 0, $jmlabsen . ' Peserta didik', 0, 1);
			$pdf->Ln(7);
			$pdf->Cell(20);
			$pdf->Cell(10, 0, 'Nomor Peserta didik yang tidak hadir', 0, 1);
			$pdf->Cell(100);
			$pdf->Cell(10, 0, ':', 0, 1);
			$pdf->Ln(7);
			$pdf->Cell(20);
			$pdf->MultiCell(150, 10, $pa, 1, 'J', FALSE);
			$pdf->Ln(7);
			$pdf->Cell(20);
			$pdf->Cell(10, 0, 'Catatan selama pelaksanaan ujian', 0, '1');
			$pdf->Cell(100);
			$pdf->Cell(10, 0, ':', 0, 1);
			$pdf->Ln(7);
			$pdf->Cell(20);
			$pdf->MultiCell(150, 10, $databa['catatan'], 1, 'J', FALSE);
			$pdf->Ln(7);
			$pdf->Cell(12);
			$pdf->MultiCell(170, 7, 'Demikian berita acara Pelaksanaan Ujian Sekolah ini dibuat dengan sesungguhnya.', 0, 'J', FALSE);
			$pdf->SetFont('Times', 'B', '12');
			$pdf->SetFont('');
			$pdf->Ln(10);
			$pdf->Cell(115, 6, '', 0, 0, 'C');
			$pdf->Cell(10, 6, 'Garut, ' . tgl_indo($databa['tanggal']), 0, 0, 'L');
			$pdf->Ln();
			$pdf->Cell(115, 6, '', 0, 0, 'C');
			$pdf->Cell(10, 6, 'Pengawas,', 0, 0, 'L');
			$pdf->Ln();
			$pdf->Ln(20);
			$pdf->SetFont('Times', 'BU', '12');
			$pdf->Cell(115, 5, '', 0, 0, 'C');
			$pdf->Cell(10, 5, $databa['nama'], 0, 0, 'L');
			$pdf->Ln();
			$pdf->Cell(115, 5, '', 0, 0, 'C');
			$newY = $pdf->getY();
			$posttd = $newY - 26;
			$dataURI    = $databa['ttd'];
			$dataPieces = explode(',', $dataURI);
			if ($dataPieces[0] == "image/png;base64") {
				$encodedImg = $dataPieces[1];
				$decodedImg = base64_decode($encodedImg);

				//  Check if image was properly decoded
				if ($decodedImg !== false) {
					if (file_put_contents('ttdba.png', $decodedImg) !== false) {
						$pdf->Image('ttdba.png', 115, $posttd, 90);
					}
				}
			}

			$pdf->SetMargins(3, 3, 3);
			$pdf->Output();
		} else {
			redirect('administrator');
		}
	}
	public function cetakdh($id)
	{
		if ($id) {
			$databa = $this->Admin_model->getBAbyID($id);
			$splittgl = explode('-', $databa['tanggal']);
			$jmlpes = $this->Admin_model->getCountPeserta($databa['kelas'], $databa['ruang']);
			$pesertaabsen = explode("#", $databa['absen']);
			$jmlabsen = count($pesertaabsen) - 1;
			for ($i = 0; $i < $jmlabsen+1; $i++) {
				if ($pesertaabsen[$i]<>""){
					if ($pa <> ""){
						$pa = $pa . ", ";
					}
				$pa = $pa . $pesertaabsen[$i];
				}
			}
			$jmlhadir = $jmlpes - $jmlabsen;
			$pdf = new FPDF('P', 'mm', array(210, 330));
			$pdf->SetTitle('Daftar Hadir PTS ' . $databa['ruang']);
			$pdf->AddPage();
			$pdf->Image(base_url() . 'public/images/kop.png', 12, 10, 185);
			$pdf->SetFont('Arial', 'B', 14);
			$pdf->SetFont('');
			$pdf->Ln(3);
			$pdf->Cell(19);
			$pdf->Cell(185, 2, 'PEMERINTAH DAERAH PROVINSI JAWA BARAT', 0, 1, 'C');
			$pdf->Ln(4);
			$pdf->Cell(19);
			$pdf->SetFont('Arial', 'B', 16);
			$pdf->Cell(185, 2, 'DINAS PENDIDIKAN', 0, 1, 'C');
			$pdf->Ln(5);
			$pdf->Cell(19);
			$pdf->SetFont('Arial', 'B', 18);
			$pdf->Cell(185, 2, 'SMK NEGERI 1 GARUT', 0, 1, 'C');
			$pdf->Ln(4);
			$pdf->Cell(19);
			$pdf->SetFont('Arial', 'B', 10);
			$pdf->SetFont('');
			$pdf->Cell(185, 2, 'Jalan Cimanuk No. 309 A Telp (0262) 233316', 0, 1, 'C');
			$pdf->Ln(2);
			$pdf->Cell(19);
			$pdf->Cell(180, 2, 'Fax: (0262) 233316 Website : smknegeri1garut.sch.id Email : smkn1garut@ymail.com', 0, 1, 'C');
			$pdf->Ln(2);
			$pdf->Cell(19);
			$pdf->Cell(185, 2, 'Tarogong Kidul - Garut 44151', 0, 1, 'C');
			$pdf->Ln();
			$pdf->SetFont('Arial', 'B', 12);
			$pdf->Ln(8);
			$pdf->Cell(185, 2, 'DAFTAR HADIR PESERTA PENILAIAN TENGAH SEMESTER GANJIL', 0, 1, 'C');
			$pdf->Ln(3);
			$pdf->Cell(185, 2, 'TAHUN PELAJARAN 2022-2023', 0, 1, 'C');
			$pdf->SetFont('Times', '', 12);
			$pdf->Ln(7);
			$pdf->Cell(60);
			$pdf->Cell(10,0,'Kelas',0,1);
			$pdf->Cell(80);
			$pdf->Cell(10,0,':',0,1);
			$pdf->Cell(82);
			$pdf->Cell(10,0,$databa['kelas'],0,1);
			$pdf->Ln(5);
			$pdf->Cell(60);
			$pdf->Cell(10,0,'Ruang',0,1);
			$pdf->Cell(80);
			$pdf->Cell(10,0,':',0,1);
			$pdf->Cell(82);
			$pdf->Cell(10,0,$databa['ruang'],0,1);
			$pdf->Ln(5);
			$pdf->Cell(60);
			$pdf->Cell(10,0,'Hari',0,1);
			$pdf->Cell(80);
			$pdf->Cell(10,0,':',0,1);
			$pdf->Cell(82);
			$pdf->Cell(10,0,longdate_indo($databa['tanggal']),0,1);
			$pdf->Ln(5);
			$pdf->Cell(60);
			$pdf->Cell(10,0,'Waktu',0,1);
			$pdf->Cell(80);
			$pdf->Cell(10,0,':',0,1);
			$pdf->Cell(82);
			$pdf->Cell(10,0,'Pukul '.$databa['mulai'].' s.d. '.$databa['sampai'],0,1);
			$pdf->Ln(7);    
			$pdf->SetFont('Times','B','12');
			$pdf->Cell(12);
			$pdf->Cell(12,10,'No',1,0,'C');
			$pdf->Cell(37,10,'Nomor Peserta',1,0,'C');
			$pdf->Cell(85,10,'Nama Peserta Didik',1,0,'C');
			$pdf->Cell(35,10,'Tanda Tangan','1',0,'C');
			$pdf->Ln();
			$pdf->SetFont('');
			$padh = $this->Admin_model->getListPeserta($databa['kelas'], $databa['ruang']);
			
			$posttd = 97;
			$no = 0;
			$ttdba = 16;
			foreach ($padh as $pd):
				$no++;
				$pdf->Cell(12);
				$pdf->Cell(12,8,$no.'.',1,0,'C');
				$pdf->Cell(37,8,$pd['nopes'],1,0,'C');
				$pdf->Cell(85,8,$pd['name'],1,0,'L');
				
				$pattd = $this->Admin_model->getTTDPes($databa['id'], $pd['id_peserta']);
				$dataURI    = $pattd['ttd'];
				$dataPieces = explode(',',$dataURI);
				if($dataPieces[0]=="image/png;base64"){
				$encodedImg = $dataPieces[1];
				$decodedImg = base64_decode($encodedImg);

				//  Check if image was properly decoded
				if( $decodedImg!==false )
				{
					$gbr='gbr'.$no.'.png';
				if( file_put_contents($gbr,$decodedImg)!==false )
					{
						$pdf->Image($gbr,154,$posttd,40);
					} 
				}
				}
				$posttd=$posttd+8;
				
				if($no==27 | $no==68){
					$posttd=8;
					$ttdba = 26;
				}
			$pdf->Cell(35,8,'',1,0,'L');
			$pdf->Ln();
			endforeach;
				
			$pdf->SetFont('Times','B','12');
			$pdf->SetFont('');    
			$pdf->Ln(5);
			$pdf->Cell(115,6,'',0,0,'C');
			$pdf->Cell(10,6,'Garut, '.tgl_indo($databa['tanggal']),0,0,'L');
			$pdf->Ln();
			$pdf->Cell(115,6,'',0,0,'C');
			$pdf->Cell(10,6,'Pengawas,',0,0,'L');
			$pdf->Ln();
			$pdf->Ln(20);       
			$pdf->SetFont('Times','BU','12');
			$pdf->Cell(115,5,'',0,0,'C');
			$pdf->Cell(10,5,$databa['nama'],0,0,'L');
			$dataURI    = $databa['ttd'];
				$dataPieces = explode(',',$dataURI);
				if($dataPieces[0]=="image/png;base64"){
				$encodedImg = $dataPieces[1];
				$decodedImg = base64_decode($encodedImg);

				//  Check if image was properly decoded
				if( $decodedImg!==false )
				{
				if( file_put_contents('ttdba.png',$decodedImg)!==false )
					{
						$pdf->Image('ttdba.png',119,$posttd+$ttdba,90);
					} 
				}
			}
			$pdf->SetMargins(4, 4, 4);
			$pdf->Output();
		} else {
			redirect('administrator');
		}
	}
}
