<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
		$part['user_data'] = $this->user_model->select_all()->result_array();
		$data['main_content'] = $this->load->view('salt/user/list', $part, TRUE);

		$data['page_info'] = array(
			'site_title' => 'Pegawai',
			'page_title' => '<li><i class="fa fa-users" aria-hidden="true"></i> Pegawai</li>'
		);
		$data['admin'] = $this->admin;
		$this->load->view('salt/template', $data);
	}
	
	public function login_as($id)
	{
		$data = array(
			'user_session' => TRUE,
			'user_id' => $id
		);
		
		$this->session->set_userdata($data);
		
		redirect('pepper');
	}
	
	public function create()
	{
		$part['division_data'] = $this->division_model->select_all()->result_array();
		$part['role_data'] = $this->role_model->select_all()->result_array();
		$data['main_content'] = $this->load->view('salt/user/create', $part, TRUE);

		$data['page_info'] = array(
			'site_title' => 'Pegawai',
			'page_title' => '<li><i class="fa fa-users" aria-hidden="true"></i> Pegawai</li>'
		);
		$data['admin'] = $this->admin;
		$this->load->view('salt/template', $data);
	}
	
	public function insert()
	{
		$this->form_validation->set_rules('nip', 'NIP', 'required|is_unique[user.nip]');
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
			
			if($this->user_model->insert_data($data) == FALSE)
			{
				$this->create();
			}
			
			$this->session->set_flashdata('error_message', '<p style="color: red;">'.$data['nip'].' berhasil dimasukan!</p>');

			redirect('user');
		}
	}
	
	public function edit($id)
	{
		$part['division_data'] = $this->division_model->select_all()->result_array();
		$part['role_data'] = $this->role_model->select_all()->result_array();
		$part['user_data'] = $this->user_model->select_where(array('user.id' => $id))->row_array();
		$data['main_content'] = $this->load->view('salt/user/edit', $part, TRUE);

		$data['page_info'] = array(
			'site_title' => 'Pegawai',
			'page_title' => '<li><i class="fa fa-users" aria-hidden="true"></i> Pegawai</li>'
		);
		$data['admin'] = $this->admin;
		$this->load->view('salt/template', $data);
	}
	
	public function update($id)
	{
		$condition = array(
			'user.id' => $id
		);

		$user_data = $this->user_model->select_where($condition)->row_array();

		if($this->input->post('nip') !== $user_data['nip'])
		{
			$this->form_validation->set_rules('nip', 'NIP', 'required|is_unique[user.nip]');
		}
		$this->form_validation->set_rules('first_name', 'Nama Depan', 'required');

		if($this->form_validation->run() == FALSE)
		{
			$this->edit($id);
		}
		else
		{
			if($this->user_model->update_data($this->input->post(), $condition) == FALSE)
			{
				$this->edit($id);
			}

			$this->session->set_flashdata('error_message', '<p style="color: red;">'.$user_data['name'].' berhasil diperbarui!</p>');

			$this->user_model->update_data($this->input->post(), $condition);
			
			redirect('user');
		}
	}
	
	public function edit_password($id)
	{
		$part['user_data'] = $this->user_model->select_where(array('user.id' => $id))->row_array();
		$data['main_content'] = $this->load->view('salt/user/edit_password', $part, TRUE);

		$data['page_info'] = array(
			'site_title' => 'Pegawai',
			'page_title' => '<li><i class="fa fa-users" aria-hidden="true"></i> Pegawai</li>'
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
			'user.id' => $id
		);

		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'required|matches[password]');

		if($this->form_validation->run() == FALSE)
		{
			$this->edit_password($id);
		}
		else
		{
			$this->user_model->update_password($data, $condition);
			$this->session->set_flashdata('error_message', '<p style="color: red;">'.$user_data['name'].' password berhasil diperbarui!</p>');
			
			redirect('user');
		}
	}
	
	public function delete($id)
	{
		$condition = array(
			'user.id' => $id
		);
		
		$user_data = $this->user_model->select_where($condition)->row_array();
		
		if($this->user_model->delete_data($condition) == TRUE)
		{
			$this->session->set_flashdata('error_message', '<p style="color: red;">'.$user_data['username'].' berhasil dihapus!</p>');

			redirect('user');
		}
	}
}
