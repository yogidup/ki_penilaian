<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission extends CI_Controller {

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
		$part['position_data'] = $this->user_model->get_position()->result_array();
		$data['main_content'] = $this->load->view('salt/permission/list', $part, TRUE);

		$data['page_info'] = array(
			'site_title' => 'Admin Area',
			'page_title' => '<li><i class="fa fa-gavel" aria-hidden="true"></i> Perizinan</li>'
		);
		$data['admin'] = $this->admin;
		$this->load->view('salt/template', $data);
	}
	
	public function edit($role_id, $division_id)
	{
		$part['subject_role_data'] = $this->role_model->select_where(array('role_id' => $role_id))->row_array();
		$part['subject_division_data'] = $this->division_model->select_where(array('division_id' => $division_id))->row_array();
		$part['position_data'] = $this->user_model->get_position()->result_array();
		$data['main_content'] = $this->load->view('salt/permission/edit', $part, TRUE);

		$data['page_info'] = array(
			'site_title' => 'Admin Area',
			'page_title' => '<li><i class="fa fa-gavel" aria-hidden="true"></i> Perizinan</li>'
		);
		$data['admin'] = $this->admin;
		$this->load->view('salt/template', $data);
	}
	
	public function update($id)
	{
		foreach ($this->input->post() as $key => $value)
		{
			$new_key = explode('|', $key);
			$condition = array(
				'subject_role_id' => $new_key[0],
				'subject_division_id' => $new_key[1],
				'object_role_id' => $new_key[2],
				'object_division_id' => $new_key[3]
			);
			
			$data = array(
				'subject_role_id' => $new_key[0],
				'subject_division_id' => $new_key[1],
				'object_role_id' => $new_key[2],
				'object_division_id' => $new_key[3],
				'permission' => $value
			);
			
			if($this->report_permission_model->num_rows($condition) == 1)
			{
				$this->report_permission_model->update_data($data, $condition);
			}
			elseif ($this->report_permission_model->num_rows($condition) == 0)
			{
				$this->report_permission_model->insert_data($data);
			}
		}

		$this->session->set_flashdata('error_message', '<p style="color: red;">Perizinan berhasil diperbarui!</p>');
		
		redirect('permission');
	}	
}
