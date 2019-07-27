<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

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
		
		$this->table_name = 'report';
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
			report.id as id,
			DATE(report.created_at) as created_at,
			DATE_FORMAT(report.evaluation_period, "%b %Y") as evaluation_period,
			report.is_approved as is_approved,
			DATE(report.date_of_approval) as approval_date,
			employe.id as employe_id,
			concat(employe.first_name, " ", IFNULL(employe.last_name, "")) as employe_name,
			employe.role_id as employe_role,
			employe.division_id as employe_division,
			evaluator.id as evaluator_id,
			concat(evaluator.first_name, " ", IFNULL(evaluator.last_name, "")) as evaluator_name,
			approved_by.id as approved_by_id,
			concat(approved_by.first_name, " ", IFNULL(approved_by.last_name, "")) as approved_by
		');
		$this->db->from('report');
		$this->db->join('user as evaluator', 'evaluator.id = report.evaluator_id', 'left');
		$this->db->join('user as employe', 'employe.id = report.employe_id', 'left');
		$this->db->join('user as approved_by', 'approved_by.id = report.approved_by', 'left');
		$this->db->order_by('report.evaluation_period', 'DESC');
		$this->db->limit($option['offset'], $option['limit']);
		$query = $this->db->get();
		
		return $query;
	}
	
	public function select_where($condition = NULL, $option = NULL)
	{
		$this->db->select('
			report.id as id,
			DATE(report.created_at) as created_at,
			DATE_FORMAT(report.evaluation_period, "%b %Y") as evaluation_period,
			report.is_approved as is_approved,
			DATE(report.date_of_approval) as approval_date,
			employe.id as employe_id,
			concat(employe.first_name, " ", IFNULL(employe.last_name, "")) as employe_name,
			employe.role_id as employe_role,
			employe.division_id as employe_division,
			evaluator.id as evaluator_id,
			concat(evaluator.first_name, " ", IFNULL(evaluator.last_name, "")) as evaluator_name,
			approved_by.id as approved_by_id,
			concat(approved_by.first_name, " ", IFNULL(approved_by.last_name, "")) as approved_by
		');
		if($condition !== NULL)
		{
			$this->db->where($condition);
		}
		$this->db->from('report');
		$this->db->join('user as evaluator', 'evaluator.id = report.evaluator_id', 'left');
		$this->db->join('user as employe', 'employe.id = report.employe_id', 'left');
		$this->db->join('user as approved_by', 'approved_by.id = report.approved_by', 'left');
		$this->db->order_by('report.id', 'DESC');
		$this->db->limit($option['offset'], $option['limit']);
		$query = $this->db->get();
		
		return $query;
	}
	
	public function chart_select_where($condition = NULL, $option = NULL)
	{
		$this->db->select('
			DATE_FORMAT(report.evaluation_period, "%b %Y") as evaluation_period,
			(
				select
					round(sum(b.weight * a.score), 2)
				from evaluation a
					left join aspect b on b.id = a.aspect_id
				where 1
					and a.report_id = report.id
			) as total_score
		');
		if($condition !== NULL)
		{
			$this->db->where($condition);
		}
		$this->db->from('report');
		$this->db->join('user as evaluator', 'evaluator.id = report.evaluator_id', 'left');
		$this->db->join('user as employe', 'employe.id = report.employe_id', 'left');
		$this->db->join('user as approved_by', 'approved_by.id = report.approved_by', 'left');
		$this->db->order_by('report.evaluation_period', 'ASC');
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
