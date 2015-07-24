<?php
class Blog extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();
	}

	public function get_latest_blog()
	{
		$q = $this->db->query('SELECT * FROM blog ORDER BY id DESC LIMIT 1');
		return $q->row_array();
	}

	public function get_archive($page=1)
	{
		$q = $this->db->query('SELECT * FROM blog ORDER BY date DESC LIMIT 10');
		return $q->result_array();
	}

	public function get_blog($slug)
	{
		$q = $this->db->get_where('blog', array('slug' => $slug));
		return $q->row_array();
	}
}