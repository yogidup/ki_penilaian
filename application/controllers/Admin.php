<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
		$part['admin_data'] = $this->admin_model->select_all()->result_array();
		$data['main_content'] = $this->load->view('salt/admin/list', $part, TRUE);

		$data['page_info'] = array(
			'site_title' => 'Admin Area',
			'page_title' => '<li><i class="fa fa-users" aria-hidden="true"></i> Admin</li>'
		);
		$data['admin'] = $this->admin;
		$this->load->view('salt/template', $data);
	}
	
	public function create()
	{
		$data['main_content'] = $this->load->view('salt/admin/create', '', TRUE);

		$data['page_info'] = array(
			'site_title' => 'Admin Area',
			'page_title' => '<li><i class="fa fa-users" aria-hidden="true"></i> Admin</li>'
		);
		$data['admin'] = $this->admin;
		$this->load->view('salt/template', $data);
	}
	
	public function insert()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[admin.username]');
		$this->form_validation->set_rules('first_name', 'Nama Depan', 'required');
		$this->form_validation->set_rules('last_name', 'Nama Belakang', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->create();
		}
		else
		{
			$data = $this->input->post();
			$data['password'] = md5($data['password']);
			
			if($this->admin_model->insert_data($data) == FALSE)
			{
				$this->create();
			}
			
			$this->session->set_flashdata('error_message', '<p style="color: red;">'.$data['username'].' berhasil dimasukan!</p>');

			redirect('admin');
		}
	}
	
	public function edit($id)
	{
		$part['admin_data'] = $this->admin_model->select_where(array('id' => $id))->row_array();
		$data['main_content'] = $this->load->view('salt/admin/edit', $part, TRUE);

		$data['page_info'] = array(
			'site_title' => 'Admin Area',
			'page_title' => '<li><i class="fa fa-users" aria-hidden="true"></i> Admin</li>'
		);
		$data['admin'] = $this->admin;
		$this->load->view('salt/template', $data);
	}
	
	public function update($id)
	{
		$condition = array(
			'id' => $id
		);

		$admin_data = $this->admin_model->select_where($condition)->row_array();

		if($this->input->post('username') !== $admin_data['username'])
		{
			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[admin.username]');
		}
		
		$this->form_validation->set_rules('first_name', 'Nama Depan', 'required');
		$this->form_validation->set_rules('last_name', 'Nama Belakang', 'required');

		if($this->form_validation->run() == FALSE)
		{
			$this->edit($id);
		}
		else
		{
			if($this->admin_model->update_data($this->input->post(), $condition) == FALSE)
			{
				$this->edit($id);
			}

			$this->session->set_flashdata('error_message', '<p style="color: red;">'.$admin_data['name'].' berhasil diperbarui!</p>');

			$this->admin_model->update_data($this->input->post(), $condition);
			
			redirect('admin');
		}
	}
	
	public function edit_password($id)
	{
		$part['admin_data'] = $this->admin_model->select_where(array('id' => $id))->row_array();
		$data['main_content'] = $this->load->view('salt/admin/edit_password', $part, TRUE);

		$data['page_info'] = array(
			'site_title' => 'Admin Area',
			'page_title' => '<li><i class="fa fa-users" aria-hidden="true"></i> Admin</li>'
		);
		$data['admin'] = $this->admin;
		$this->load->view('salt/template', $data);
	}
	
	public function update_password($id)
	{
		$data = array(
			'password' => md5($this->input->post('password'))
		);
		
		$condition = array(
			'id' => $id
		);

		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'required|matches[password]');

		if($this->form_validation->run() == FALSE)
		{
			$this->edit_password($id);
		}
		else
		{
			$this->admin_model->update_password($data, $condition);
			$this->session->set_flashdata('error_message', '<p style="color: red;">'.$admin_data['name'].' password berhasil diperbarui!</p>');
			
			redirect('admin');
		}
	}
	
	public function delete($id)
	{
		$condition = array(
			'id' => $id
		);
		
		$admin_data = $this->admin_model->select_where($condition)->row_array();
		
		if($this->admin_model->delete_data($condition) == TRUE)
		{
			$this->session->set_flashdata('error_message', '<p style="color: red;">'.$admin_data['username'].' berhasil dihapus!</p>');

			redirect('admin');
		}
	}
}
