<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_report extends CI_Controller {

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
		
		if($this->session->userdata('user_session') == FALSE)
		{
			redirect('login');
		}
		
		$user_id = $this->session->userdata('user_id');
		$this->user = $this->user_model->select_where(array('user.id' => $user_id))->row_array();
		
		$condition = array(
			'subject.id' => $user_id,
			'relation.permission' => 'edit'
		);
		
		$check = $this->report_permission_model->get_permission($condition)->row_array();
		
		if($check == FALSE)
		{
			redirect('pepper');
		}
	}
	
	public function index()
	{
		$condition = array(
			'subject.id' => $this->user['id'],
			'relation.permission' => 'edit'
		);
		$part['report_data'] = $this->report_permission_model->get_permission($condition)->result_array();
		$data['main_content'] = $this->load->view('pepper/user_report/list', $part, TRUE);

		$data['page_info'] = array(
			'site_title' => 'Member Area',
			'page_title' => '<li><i class="fa fa-magic" aria-hidden="true"></i> Buat Laporan Evaluasi</li>'
		);
		$data['user'] = $this->user;
		$this->load->view('pepper/template', $data);
	}
	
	public function create($id)
	{
		$part['object_data'] = $this->user_model->select_where(array('user.id' => $id))->row_array();
		$part['report_data'] = $this->report_model->select_where(array('employe.id' => $id))->result_array();
		$data['main_content'] = $this->load->view('pepper/user_report/create', $part, TRUE);

		$data['page_info'] = array(
			'site_title' => 'Member Area',
			'page_title' => '<li><i class="fa fa-magic" aria-hidden="true"></i> Buat Laporan Evaluasi</li>'
		);
		$data['user'] = $this->user;
		$this->load->view('pepper/template', $data);
	}
	
	public function insert($id)
	{
		$data = array(
			'evaluator_id' => $this->user['id'],
			'employe_id' => $id,
			'evaluation_period' => $this->input->post('evaluation_period').'-01',
		);
		
		$this->report_model->insert_data($data);

		redirect('user_report/create/'.$id);
	}

	public function delete($id)
	{
		$condition = array(
			'report.id' => $id
		);
		
		$report_data = $this->report_model->select_where($condition)->row_array();
		
		if($this->report_model->delete_data($condition) == TRUE)
		{
			$this->session->set_flashdata('error_message', '<p style="color: red;">Laporan '.$report_data['id'].' berhasil dihapus!</p>');

			redirect('user_report/create/'.$report_data['employe_id']);
		}
	}
	
	public function do_evaluation($id)
	{
		$part['report_data'] = $this->report_model->select_where(array('report.id' => $id))->row_array();
		$part['evaluation_data'] = $this->evaluation_model->select_where(array('report_id' => $id))->result_array();
		$general_aspect_condition = array(
			'aspect.type' => 'umum'
		);
		$part['general_aspect_data'] = $this->aspect_model->select_where($general_aspect_condition)->result_array();
		$special_aspect_condition = array(
			'aspect.type' => 'khusus',
			'aspect.role_id' => $part['report_data']['employe_role'],
			'aspect.division_id' => $part['report_data']['employe_division']
		);
		$part['special_aspect_data'] = $this->aspect_model->select_where($special_aspect_condition)->result_array();
		$part['user_data'] = $this->user;
		$data['main_content'] = $this->load->view('pepper/user_report/do_evaluation', $part, TRUE);

		$data['page_info'] = array(
			'site_title' => 'Member Area',
			'page_title' => '<li><i class="fa fa-magic" aria-hidden="true"></i> Buat Laporan Evaluasi</li>'
		);
		$data['user'] = $this->user;
		$this->load->view('pepper/template', $data);
	}
	
	public function submit_evaluation($id)
	{
		foreach($this->input->post() as $aspect_id => $score)
		{
			$condition= array(
				'report_id' => $id,
				'aspect_id' => $aspect_id
			);
			
			$data= array(
				'report_id' => $id,
				'aspect_id' => $aspect_id,
				'score' => $score
			);
			
			if($this->evaluation_model->num_rows($condition) == 1)
			{
				$this->evaluation_model->update_data($data, $condition);
			}
			elseif($this->evaluation_model->num_rows($condition) == 0)
			{
				$this->evaluation_model->insert_data($data);
			}
			
			
		}
		$report_data = $this->report_model->select_where(array('report.id' => $id))->row_array();
		
		redirect('user_report/create/'.$report_data['employe_id']);
	}
	
	public function waiting_approval()
	{
		$part['report_data'] = $this->report_model->select_where(array('is_approved' => FALSE))->result_array();
		$data['main_content'] = $this->load->view('pepper/user_report/waiting_approval', $part, TRUE);

		$data['page_info'] = array(
			'site_title' => 'Member Area',
			'page_title' => '<li><i class="fa fa-magic" aria-hidden="true"></i> Buat Laporan Evaluasi</li>'
		);
		$data['user'] = $this->user;
		$this->load->view('pepper/template', $data);
	}
	
	public function approve_report($id)
	{
		$condition = array('report.id' => $id);
		$data = array(
			'is_approved' => TRUE,
			'approved_by' => $this->user[id],
			'date_of_approval' => date(DATE_ATOM, time())
		);
		
		$this->report_model->update_data($data, $condition);
		
		redirect('user_report/waiting_approval/');
	}
}
