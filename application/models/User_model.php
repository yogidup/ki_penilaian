<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

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
		
		$this->table_name = 'user';
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
			user.id as id,
			user.nip as nip,
			user.created_at as created_at,
			user.first_name as first_name,
			user.last_name as last_name,
			division.id as division_id,
			division.name as division,
			role.id as role_id,
			role.name as role
		');
		$this->db->from('user');
		$this->db->join('division', 'division.id = user.division_id', 'left');
		$this->db->join('role', 'role.id = user.role_id', 'left');
		$this->db->limit($option['offset'], $option['limit']);
		$query = $this->db->get();
		
		return $query;
	}
	
	public function get_position($condition = NULL, $option = NULL)
	{
		$this->db->select('
			division.id as division_id,
			division.name as division,
			role.id as role_id,
			role.name as role
		');
		if($condition !== NULL)
		{
			$this->db->where($condition);
		}
		$this->db->distinct();
		$this->db->from('user');
		$this->db->join('division', 'division.id = user.division_id', 'left');
		$this->db->join('role', 'role.id = user.role_id', 'left');
		$this->db->group_by(array('division_id', 'role_id'));
		$this->db->limit($option['offset'], $option['limit']);
		$query = $this->db->get();
		
		return $query;
	}
	
	public function select_where($condition = NULL, $option = NULL)
	{
		$this->db->select('
			user.id as id,
			user.nip as nip,
			user.created_at as created_at,
			user.first_name as first_name,
			user.last_name as last_name,
			division.id as division_id,
			division.name as division,
			role.id as role_id,
			role.name as role,
			role.priority as priority
		');
		if($condition !== NULL)
		{
			$this->db->where($condition);
		}
		$this->db->from('user');
		$this->db->join('division', 'division.id = user.division_id', 'left');
		$this->db->join('role', 'role.id = user.role_id', 'left');
		$this->db->limit($option['offset'], $option['limit']);
		$query = $this->db->get();
		
		return $query;
	}
	
	public function insert_data($data)
	{
		if($this->num_rows(array('nip' => $data['nip'])) == FALSE)
		{
			$this->db->insert($this->table_name, $data);
			
			return TRUE;
		}
		
		return FALSE;
	}
	
	public function update_data($data, $condition)
	{
		$check = $this->select_where($condition)->row_array();
		
		if($data['nip'] == $check['nip'])
		{
			$this->db->update($this->table_name, $data, $condition);

			return TRUE;
		}
		elseif($this->num_rows(array('nip' => $data['nip'])) == FALSE)
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
