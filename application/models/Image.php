<?php 



/**
* 
*/
class Image extends CI_Model
{
	
	
	function add_image($data){
		$query = $this->db->insert('image', $data);
		return $query;
	}
	function get_image($id){
		$this->db->from('image');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}
	function get_all_image($limit){
		$this->db->from('image');
		$this->db->limit($limit);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();

		return $query->result();
	}
	function get_one($id){
		$this->db->from('image');
		$this->db->where('id', $id);
		$query = $this->db->get();

		return $query->row();
	}
	function get_one_post($id){
		$this->db->from('posts');
		$this->db->where('id', $id);
		$query = $this->db->get();

		return $query->row();
	}
	function tambah($data){
		$query = $this->db->insert('posts', $data);
		return $query;
	}
	function get_with_post(){
		$this->db->from('posts');
		$query = $this->db->get();

		return $query->result();
	}

}