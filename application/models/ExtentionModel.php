<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class  ExtentionModel extends CI_Model{
	public function getExtentions($table,$fields,$condition=null)
	{
		$this->db->select($fields);
		$this->db->from($table);
		if(!empty($condition)){
            $this->db->where($condition);
		}
		
		$query=$this->db->get();

		return $query->result();

	
		
	}
	public function save($table,$data)
	{
	   $this->db->insert($table,$data);
	   $id = $this->db->insert_id();
	   $this->db->select("document.id,document.name,document.type,extention.name as extention,document.file");
	   $this->db->from($table);
	   $this->db->join('extention', 'extention.id = document.extenstion_id');
	   $this->db->where('document.id',$id);
	   $query=$this->db->get();
	   return $query->result();

	}

	
}
