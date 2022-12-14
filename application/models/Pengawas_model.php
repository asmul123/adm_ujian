<?php

class Pengawas_model extends CI_model
{
    public function getBioPengawas($email)
    {
        $this->db->select('*');
        $this->db->from('pengawas');
        $this->db->join('users', 'users.user_id = pengawas.user_id', 'right');
        $this->db->where('email', $email);
        return $this->db->get()->row_array();
    }
    public function getBAPengawas($pengID)
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->where('id_pengawas', $pengID);
        return $this->db->get()->result_array();
    }
    public function getCountPeserta($kelas, $ruang)
    {
        $this->db->select('*');
        $this->db->from('peserta');
        $this->db->where('kelas', $kelas);
        $this->db->where('ruang', $ruang);
        return $this->db->get()->num_rows();
    }
    public function getPresentPeserta($idba)
    {
        $this->db->select('*');
        $this->db->from('daftar_hadir');
        $this->db->where('id_ba', $idba);
        return $this->db->get()->num_rows();
    }
    public function getRuangPeserta()
    {
        $this->db->select('*');
        $this->db->from('peserta');
        $this->db->group_by('ruang');
        return $this->db->get()->result_array();
    }
    public function getKelasPeserta()
    {
        $this->db->select('*');
        $this->db->from('peserta');
        $this->db->group_by('kelas');
        return $this->db->get()->result_array();
    }
    public function getPesertabyKelas($kelas)
    {
        $this->db->select('*');
        $this->db->from('peserta');
        $this->db->where('kelas', $kelas);
        return $this->db->get()->result();
    }
    public function getPeserta()
    {
        $this->db->select('name,nopes');
        $this->db->from('peserta');
        return $this->db->get()->result_array();
    }
}
