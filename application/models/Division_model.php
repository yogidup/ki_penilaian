<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Division_model extends CI_Model {

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
		
		$this->table_name = 'division';
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
		$this->db->select('
			division.id as id,
			division.name as name,
			division.description as description,
			COUNT(user.id) as total_personnel
		');
		$this->db->from('division');
		$this->db->join('user', 'user.division_id = division.id', 'left');
		$this->db->group_by('division.id');
		$this->db->limit($option['offset'], $option['limit']);
		$query = $this->db->get();
		
		return $query;
	}
	
	public function select_where($condition = NULL, $option = NULL)
	{
		$this->db->select('
			division.id as id,
			division.name as name,
			division.description as description,
			COUNT(user.id) as total_personnel
		');
		if($condition !== NULL)
		{
			$this->db->where($condition);
		}
		$this->db->from('division');
		$this->db->join('user', 'user.division_id = division.id', 'left');
		$this->db->group_by('division.id');
		$this->db->limit($option['offset'], $option['limit']);
		$query = $this->db->get();
		
		return $query;
	}
	
	public function insert_data($data)
	{
		$this->db->insert($this->table_name, $data);
		
		return TRUE;
	}
	
	public function update_data($data, $condition)
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
