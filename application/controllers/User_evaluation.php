<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_evaluation extends CI_Controller {

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
	}
	
	public function index()
	{
		$condition = array(
			'report.employe_id' => $this->user['id'],
		);
		
		if($this->user['priority'] == 1)
		{
			$part['report_data'] = $this->report_model->select_where(array('report.is_approved' => '1'))->result_array();			
		}
		else
		{
			$part['report_data'] = $this->report_model->select_where($condition)->result_array();
		}
		$data['main_content'] = $this->load->view('pepper/user_evaluation/list', $part, TRUE);

		$data['page_info'] = array(
			'site_title' => 'Member Area',
			'page_title' => '<li><i class="fa fa-newspaper" aria-hidden="true"></i> Lihat Evaluasi Saya</li>'
		);
		$data['user'] = $this->user;
		$this->load->view('pepper/template', $data);
	}

	public function detail($id)
	{
		$condition = array(
			'report.id' => $id,
		);
		$part['user_data'] = $this->user;
		$part['report_data'] = $this->report_model->select_where($condition)->row_array();
		$part['general_evaluation_data'] = $this->evaluation_model->select_where(array('report_id' => $id, 'aspect.type ' => 'umum'))->result_array();
		$part['general_total_score'] = $this->evaluation_model->get_total_score(array('report_id' => $id, 'aspect.type ' => 'umum'))->row_array();
		$part['special_evaluation_data'] = $this->evaluation_model->select_where(array('report_id' => $id, 'aspect.type ' => 'khusus'))->result_array();
		$part['special_total_score'] = $this->evaluation_model->get_total_score(array('report_id' => $id, 'aspect.type ' => 'khusus'))->row_array();
		$part['total_score'] = $this->evaluation_model->get_total_score(array('report_id' => $id))->row_array();
		$data['main_content'] = $this->load->view('pepper/user_evaluation/detail', $part, TRUE);

		$data['page_info'] = array(
			'site_title' => 'Member Area',
			'page_title' => '<li><i class="fa fa-newspaper" aria-hidden="true"></i> Lihat Evaluasi Saya</li>'
		);
		$data['user'] = $this->user;
		$this->load->view('pepper/template', $data);
	}
}
