<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Propasca_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function get_title($user_id)
	{
		$this->db->select('*');
		$this->db->from('title');
		$this->db->where_in('title.status_ujian_proposal', ['Lulus', 'Lulus ubah judul']);
		$this->db->where('title.mahasiswa', $user_id);
		$this->db->order_by('title.tanggal_pengajuan', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();

		return $query->row();
	}

	public function cek_title($user_id)
	{
		$this->db->select('*');
		$this->db->from('title');
		$this->db->where_in('title.status_ujian_proposal', ['Lulus', 'Lulus ubah judul']);
		$this->db->where('title.mahasiswa', $user_id);
		$this->db->order_by('title.tanggal_pengajuan', 'DESC');
		$query = $this->db->get();

		return $query->num_rows();
	}

	public function insert($data)
	{
		return $this->db->insert('pro_pasca', $data);
	}

	public function cek($title)
	{
		$this->db->select('*');
		$this->db->from('pro_pasca');
		$this->db->join('title','pro_pasca.title_id = title.id','inner');
		$this->db->where('title.id',$title);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_all()
	{
		$this->db->select('*, pro_pasca.id as pasca_id');
		$this->db->from('pro_pasca');
		$this->db->join('title', 'pro_pasca.title_id = title.id', 'inner');
		$this->db->order_by('pro_pasca.id','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function update_title($title_id, $data)
	{
		$this->db->where('id', $title_id);
		$this->db->update('title', $data);
	}
}
