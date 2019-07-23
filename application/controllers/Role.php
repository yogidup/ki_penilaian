<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {

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
		$part['role_data'] = $this->role_model->select_all()->result_array();
		$data['main_content'] = $this->load->view('salt/role/list', $part, TRUE);

		$data['page_info'] = array(
			'site_title' => 'Admin Area',
			'page_title' => '<li><i class="fa fa-briefcase" aria-hidden="true"></i> Jabatan</li>'
		);
		$data['admin'] = $this->admin;
		$this->load->view('salt/template', $data);
	}
	
	public function create()
	{
		$data['main_content'] = $this->load->view('salt/role/create', '', TRUE);

		$data['page_info'] = array(
			'site_title' => 'Admin Area',
			'page_title' => '<li><i class="fa fa-briefcase" aria-hidden="true"></i> Jabatan</li>'
		);
		$data['admin'] = $this->admin;
		$this->load->view('salt/template', $data);
	}
	
	public function insert()
	{
		$role_data = $this->role_model->insert_data($this->input->post());
		$this->session->set_flashdata('error_message', '<p style="color: red;">'.$this->input->post('name').' berhasil dimasukan!</p>');
		
		redirect('role');
	}
	
	public function edit($id)
	{
		$part['role_data'] = $this->role_model->select_where(array('role.id' => $id))->row_array();
		$data['main_content'] = $this->load->view('salt/role/edit', $part, TRUE);

		$data['page_info'] = array(
			'site_title' => 'Admin Area',
			'page_title' => '<li><i class="fa fa-briefcase" aria-hidden="true"></i> Jabatan</li>'
		);
		$data['admin'] = $this->admin;
		$this->load->view('salt/template', $data);
	}
	
	public function update($id)
	{
		$condition = array(
			'id' => $id
		);
		
		$role_data = $this->role_model->select_where(array('role.id' => $id))->row_array();
		$this->session->set_flashdata('error_message', '<p style="color: red;">'.$role_data['name'].' berhasil diperbarui!</p>');

		$this->role_model->update_data($this->input->post(), $condition);
		
		redirect('role');
	}
	
	public function delete($id)
	{
		$condition = array(
			'id' => $id
		);
		
		$role_data = $this->role_model->select_where(array('role.id' => $id))->row_array();

		if($this->role_model->delete_data($condition) == TRUE)
		{
			$this->session->set_flashdata('error_message', '<p style="color: red;">'.$role_data['name'].' berhasil dihapus!</p>');

			redirect('role');
		}
	}
}
