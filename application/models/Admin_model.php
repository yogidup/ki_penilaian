<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		
		$this->table_name = 'admin';
	}

	public function num_rows($condition = NULL)
	{
		if($condition !== NULL)
		{
			$this->db->where($condition);
		}
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}
	
	public function select_all($option = NULL)
	{
		$this->db->select();
		$this->db->from($this->table_name);
		$this->db->limit($option['offset'], $option['limit']);
		$query = $this->db->get();
		
		return $query;
	}
	
	public function select_where($condition = NULL, $option = NULL)
	{
		$this->db->select();
		if($condition !== NULL)
		{
			$this->db->where($condition);
		}
		$this->db->from($this->table_name);
		$this->db->limit($option['offset'], $option['limit']);
		$query = $this->db->get();
		
		return $query;
	}
	
	public function insert_data($data)
	{
		if($this->num_rows(array('username' => $data['username'])) == FALSE)
		{
			$this->db->insert($this->table_name, $data);
			
			return TRUE;
		}
		
		return FALSE;
	}
	
	public function update_data($data, $condition)
	{
		$check = $this->select_where($condition)->row_array();
		
		if($data['username'] == $check['username'])
		{
			$this->db->update($this->table_name, $data, $condition);

			return TRUE;
		}
		elseif($this->num_rows(array('username' => $data['username'])) == FALSE)
		{
			$this->db->update($this->table_name, $data, $condition);

			return TRUE;
		}
		
		return FALSE;
	}
	
	public function update_password($data, $condition)
	{
			$this->db->update($this->table_name, $data, $condition);

			return TRUE;
	}
	
	public function delete_data($condition)
	{
		if($this->num_rows($condition) == TRUE)
		{
			$this->db->delete($this->table_name, $condition);
			
			return TRUE;
		}

		return FALSE;
	}
}
