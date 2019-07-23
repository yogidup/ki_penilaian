<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_permission_model extends CI_Model {

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
		
		$this->table_name = 'report_permission';
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
			report_permission.id as id,
			subject_role.name as `subject_role_name`,
			subject_division.name as `subject_division_name`,
			object_role.name as `object_role_name`,
			object_division.name as `object_division_name`,
			report_permission.permission as permission
		');
		$this->db->from('report_permission');
		$this->db->join('role as subject_role', 'report_permission.subject_role_id = subject_role.id', 'left');
		$this->db->join('division as subject_division', 'report_permission.subject_division_id = subject_division.id', 'left');
		$this->db->join('role as object_role', 'report_permission.object_role_id = object_role.id', 'left');
		$this->db->join('division as object_division', 'report_permission.object_division_id = object_division.id', 'left');
		$this->db->limit($option['offset'], $option['limit']);
		$query = $this->db->get();
		
		return $query;
	}
	
	public function select_where($condition = NULL, $option = NULL)
	{
		$this->db->select('
			report_permission.id as id,
			subject_role.name as `subject_role_name`,
			subject_division.name as `subject_division_name`,
			object_role.name as `object_role_name`,
			object_division.name as `object_division_name`,
			report_permission.permission as permission
		');
		if($condition !== NULL)
		{
			$this->db->where($condition);
		}
		$this->db->from('report_permission');
		$this->db->join('role as subject_role', 'report_permission.subject_role_id = subject_role.id', 'left');
		$this->db->join('division as subject_division', 'report_permission.subject_division_id = subject_division.id', 'left');
		$this->db->join('role as object_role', 'report_permission.object_role_id = object_role.id', 'left');
		$this->db->join('division as object_division', 'report_permission.object_division_id = object_division.id', 'left');
		$this->db->limit($option['offset'], $option['limit']);
		$query = $this->db->get();
		
		return $query;
	}
	
	public function get_permission($condition = NULL, $option = NULL)
	{
		$this->db->select('
			subject.id as subject_id,
			subject.first_name as subject_first_name,
			subject.last_name as subject_last_name,
			object.id as object_id,
			object.first_name as object_first_name,
			object.last_name as object_last_name,
			object_role.name as object_role,
			object_division.name as object_division,
			relation.permission
		');
		$where = "`subject`.`division_id` = `relation`.`subject_division_id` 
			AND `object`.`division_id` = `relation`.`object_division_id`";
		$this->db->where($where);
		if($condition !== NULL)
		{
			$this->db->where($condition);
		}
		$this->db->from('report_permission as relation');
		$this->db->join('user as subject', 'subject.role_id = relation.subject_role_id', 'left');
		$this->db->join('user as object', 'object.role_id = relation.object_role_id', 'left');
		$this->db->join('role as object_role', 'object_role.id = object.role_id', 'left');
		$this->db->join('division as object_division', 'object_division.id = object.division_id', 'left');
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
}
