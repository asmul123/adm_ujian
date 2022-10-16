<?php

class Partisipant_model extends CI_model
{
    public function getTask($parID)
    {
        $this->db->select('*');
        $this->db->from('tasks');
        $this->db->where('partisipant_id', $parID);
        return $this->db->get()->result_array();
    }
    public function getAllTask()
    {
        $this->db->select('*');
        $this->db->from('tasks');
        $this->db->join('partisipants', 'partisipants.partisipant_id = tasks.partisipant_id');
        return $this->db->get()->result_array();
    }
    public function getATP($task_id)
    {
        $this->db->select('*');
        $this->db->from('atps');
        $this->db->where('task_id', $task_id);
        return $this->db->get()->row_array();
    }
    public function getATPByID($atp_id)
    {
        $this->db->select('*');
        $this->db->from('atps');
        $this->db->where('id', $atp_id);
        return $this->db->get()->row_array();
    }
    public function getModul($task_id)
    {
        $this->db->select('*');
        $this->db->from('moduls');
        $this->db->where('task_id', $task_id);
        return $this->db->get()->row_array();
    }
    public function getMODByID($mod_id)
    {
        $this->db->select('*');
        $this->db->from('moduls');
        $this->db->where('id', $mod_id);
        return $this->db->get()->row_array();
    }
    public function getTTD($task_id)
    {
        $this->db->select('*');
        $this->db->from('absenses');
        $this->db->where('task_id', $task_id);
        return $this->db->get()->row_array();
    }
    public function getTTDByPar($par_id)
    {
        $this->db->select('*');
        $this->db->from('absenses');
        $this->db->join('tasks', 'tasks.id = absenses.task_id');
        $this->db->where('tasks.partisipant_id', $par_id);
        return $this->db->get()->row_array();
    }
    public function getBioPartisipant($email)
    {
        $this->db->select('*');
        $this->db->from('partisipants');
        $this->db->join('users', 'users.user_id = partisipants.user_id', 'right');
        $this->db->where('email', $email);
        return $this->db->get()->row_array();
    }
    public function getAllPartisipant()
    {
        $this->db->select('*');
        $this->db->from('partisipants');
        return $this->db->get()->result_array();
    }
}
