<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Division extends CI_Controller {

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
		
		if($this->session->userdata('admin_session') == FALSE)
		{
			redirect('login');
		}
		
		$admin_id = $this->session->userdata('admin_id');
		$this->admin = $this->admin_model->select_where(array('id' => $admin_id))->row_array();
	}
	
	public function index()
	{
		$part['division_data'] = $this->division_model->select_all()->result_array();
		$data['main_content'] = $this->load->view('salt/division/list', $part, TRUE);

		$data['page_info'] = array(
			'site_title' => 'Admin Area',
			'page_title' => '<li><i class="fa fa-university" aria-hidden="true"></i> Divisi</li>'
		);
		$data['admin'] = $this->admin;
		$this->load->view('salt/template', $data);
	}
	
	public function create()
	{
		$data['main_content'] = $this->load->view('salt/division/create', '', TRUE);

		$data['page_info'] = array(
			'site_title' => 'Admin Area',
			'page_title' => '<li><i class="fa fa-star" aria-hidden="true"></i> Aspek Penilaian</li>'
		);
		$data['admin'] = $this->admin;
		$this->load->view('salt/template', $data);
	}
	
	public function insert()
	{
		$division_data = $this->division_model->insert_data($this->input->post());
		$this->session->set_flashdata('error_message', '<p style="color: red;">'.$this->input->post('name').' berhasil dimasukan!</p>');
		
		redirect('division');
	}
	
	public function edit($id)
	{
		$part['division_data'] = $this->division_model->select_where(array('division.id' => $id))->row_array();
		$data['main_content'] = $this->load->view('salt/division/edit', $part, TRUE);

		$data['page_info'] = array(
			'site_title' => 'Admin Area',
			'page_title' => '<li><i class="fa fa-university" aria-hidden="true"></i> Divisi</li>'
		);
		$data['admin'] = $this->admin;
		$this->load->view('salt/template', $data);
	}
	
	public function update($id)
	{
		$condition = array(
			'id' => $id
		);
		
		$division_data = $this->division_model->select_where(array('division.id' => $id))->row_array();
		$this->session->set_flashdata('error_message', '<p style="color: red;">'.$division_data['name'].' berhasil diperbarui!</p>');

		$this->division_model->update_data($this->input->post(), $condition);
		
		redirect('division');
	}
	
	public function delete($id)
	{
		$condition = array(
			'id' => $id
		);
		
		$division_data = $this->division_model->select_where(array('division.id' => $id))->row_array();

		if($this->division_model->delete_data($condition) == TRUE)
		{
			$this->session->set_flashdata('error_message', '<p style="color: red;">'.$division_data['name'].' berhasil dihapus!</p>');

			redirect('division');
		}
	}
}
