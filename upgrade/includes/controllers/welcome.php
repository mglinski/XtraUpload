<?php
class Home extends Controller {

	function Home()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->view('header');
		$this->load->view('home');
		$this->load->view('footer');
	}
	
	function step_1()
	{
		if($this->_copyConfigFiles())
		{
			$this->load->view('header');
			$this->load->view('upgrade/step1');
			$this->load->view('footer');
		}
		else
		{
			$this->session->set_flashdata('msg', 'Upgrade config files cannot be written to. Please check permissions');
			redirect('/home');
		}
	}
	
	function step_2()
	{
		$this->_runUpgrade();
		
		$this->load->view('header');
		$this->load->view('upgrade/step2');
		$this->load->view('footer');
	}
	
	function _copyConfigFiles()
	{
		include('path_config.php');
		if(file_exists())
		{
			return false;
		}
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */