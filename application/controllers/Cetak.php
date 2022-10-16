<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Cetak extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('tgl_indo');
        $this->load->library('Pdf'); // MEMANGGIL LIBRARY YANG KITA BUAT TADI
        $this->load->model('Partisipant_model');
    }
    function index()
    {
        $tgl = $this->input->post('tgl');
        if ($tgl) {
            $pdf = new FPDF('P', 'mm', array(210, 330));
            $pdf->SetTitle('Daftar Hadir IHT ' . longdate_indo($tgl));
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
            $pdf->Cell(185, 2, 'DAFTAR HADIR IN HOUSE TRAINING', 0, 1, 'C');
            $pdf->Ln(3);
            $pdf->Cell(185, 2, 'TAHUN PELAJARAN 2022-2023', 0, 1, 'C');
            $pdf->Ln(7);
            $pdf->SetFont('');
            $pdf->Cell(12);
            $pdf->Cell(24, 14,  longdate_indo($tgl), 0, 0, 'L');
            $pdf->Ln(12);
            $pdf->SetFont('Times', 'B', '12');
            $pdf->Cell(12);
            $pdf->Cell(12, 14, 'No', 1, 0, 'C');
            $pdf->Cell(95, 14, 'Nama Peserta', 1, 0, 'C');
            $pdf->Cell(25, 14, 'Jabatan', 1, 0, 'C');
            $pdf->Cell(35, 14, 'Tanda Tangan', 'RT', 0, 'C');
            $pdf->Ln();
            $pdf->SetFont('');
            $partisipants = $this->Partisipant_model->getAllPartisipant();
            $posttd = 0;
            $no = 0;
            foreach ($partisipants as $par) {
                $pdf->Cell(12);
                $pdf->Cell(12, 10, ++$no . '.', 1, 0, 'C');
                $pdf->Cell(95, 10, $par['name'], 1, 0, 'L');
                $pdf->Cell(25, 10, '', 1, 0, 'C');
                $datattd = $this->Partisipant_model->getTTDByPar($par['partisipant_id']);
                if ($datattd) {
                    $dataURI    = $datattd['signature'];
                    $dataPieces = explode(',', $dataURI);
                    if ($dataPieces[0] == "image/png;base64") {
                        $encodedImg = $dataPieces[1];
                        $decodedImg = base64_decode($encodedImg);

                        //  Check if image was properly decoded
                        if ($decodedImg !== false) {
                            $gbr = 'gbr' . $no . '.png';
                            if (file_put_contents($gbr, $decodedImg) !== false) {
                                if ($gbr) {
                                    $pdf->Image($gbr, 152, $posttd, 50);
                                }
                            }
                        }
                        unlink($gbr);
                    }
                }
                $posttd = $posttd + 10;
                if ($no == 21 | $no == 50) {
                    $posttd = 10;
                }
                $pdf->Cell(35, 10, '', 1, 0, 'R');
                $pdf->Ln();
            }
            $pdf->SetMargins(4, 4, 4);
            $pdf->Output();
        } else {
            redirect('administrator');
        }
    }
}
