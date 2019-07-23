<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aspect extends CI_Controller {

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
		$part['aspect_data'] = $this->aspect_model->select_all()->result_array();
		$data['main_content'] = $this->load->view('salt/aspect/list', $part, TRUE);

		$data['page_info'] = array(
			'site_title' => 'Admin Area',
			'page_title' => '<li><i class="fa fa-star" aria-hidden="true"></i> Aspek Penilaian</li>'
		);
		$data['admin'] = $this->admin;
		$this->load->view('salt/template', $data);
	}
	
	public function create()
	{
		$part['division_data'] = $this->division_model->select_all()->result_array();
		$part['role_data'] = $this->role_model->select_all()->result_array();
		$data['main_content'] = $this->load->view('salt/aspect/create', $part, TRUE);

		$data['page_info'] = array(
			'site_title' => 'Admin Area',
			'page_title' => '<li><i class="fa fa-star" aria-hidden="true"></i> Aspek Penilaian</li>'
		);
		$data['admin'] = $this->admin;
		$this->load->view('salt/template', $data);
	}
	
	public function insert()
	{
		$this->form_validation->set_rules('name', 'Aspek Penilaian', 'required');
		$this->form_validation->set_rules('type', 'Tipe', 'required');
		$this->form_validation->set_rules('weight', 'Bobot', 'required|decimal');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->create();
		}
		else
		{
			$aspect_data = $this->aspect_model->insert_data($this->input->post());
			$this->session->set_flashdata('error_message', '<p style="color: red;">'.$this->input->post('name').' berhasil dimasukan!</p>');
			
			redirect('aspect');
		}
	}
	
	public function edit($id)
	{
		$part['division_data'] = $this->division_model->select_all()->result_array();
		$part['role_data'] = $this->role_model->select_all()->result_array();
		$part['aspect_data'] = $this->aspect_model->select_where(array('aspect.id' => $id))->row_array();
		$data['main_content'] = $this->load->view('salt/aspect/edit', $part, TRUE);

		$data['page_info'] = array(
			'site_title' => 'Admin Area',
			'page_title' => '<li><i class="fa fa-star" aria-hidden="true"></i> Aspek Penilaian</li>'
		);
		$data['admin'] = $this->admin;
		$this->load->view('salt/template', $data);
	}
	
	public function update($id)
	{
		$condition = array(
			'id' => $id
		);

		$this->form_validation->set_rules('name', 'Aspek Penilaian', 'required');
		$this->form_validation->set_rules('type', 'Tipe', 'required');
		$this->form_validation->set_rules('weight', 'Bobot', 'required|decimal');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->edit($id);
		}
		else
		{
			$aspect_data = $this->aspect_model->select_where(array('aspect.id' => $id))->row_array();
			$this->session->set_flashdata('error_message', '<p style="color: red;">'.$aspect_data['name'].' berhasil diperbarui!</p>');

			$this->aspect_model->update_data($this->input->post(), $condition);
			
			redirect('aspect');
		}
	}
	
	public function delete($id)
	{
		$condition = array(
			'id' => $id
		);
		
		$aspect_data = $this->aspect_model->select_where(array('aspect.id' => $id))->row_array();

		if($this->aspect_model->delete_data($condition) == TRUE)
		{
			$this->session->set_flashdata('error_message', '<p style="color: red;">'.$aspect_data['name'].' berhasil dihapus!</p>');

			redirect('aspect');
		}
	}
}
