<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

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
	}
	
	public function index()
	{
		$this->load->view('user_login');
	}

	public function validation()
	{
		$condition = array(
			'nip' => $this->input->post('nip'),
			'password' => md5($this->input->post('password'))
		);
		
		if($this->user_model->num_rows($condition) == FALSE)
		{
			$this->session->set_flashdata('error_message', '<p style="color: red;">Silakan periksa kembali detail login Anda</p>');
			
			redirect('login');
		}
		
		$user_data = $this->user_model->select_where($condition)->row_array();
		
		$data = array(
			'user_session' => TRUE,
			'user_id' => $user_data['id']
		);
		
		$this->session->set_userdata($data);
		
		redirect('pepper');
	}
	
	public function end_session()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}
