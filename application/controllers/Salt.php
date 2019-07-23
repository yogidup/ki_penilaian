<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salt extends CI_Controller {

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
		$data['page_info'] = array(
			'site_title' => 'Admin Area',
			'page_title' => '<li><i class="fa fa-home" aria-hidden="true"></i> Home</li>'
		);
		$data['admin'] = $this->admin;
		$data['main_content'] = $this->load->view('salt/dashboard', '', TRUE);
		$this->load->view('salt/template', $data);
	}
}
