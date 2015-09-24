<?php

class Register_validate  extends CI_Controller {

	function index()
	{
		$this->load->helper(array('register_validate','url'));

		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('Email','Email','required');
		$this->form_validation->set_rules('Password','Password','required');
		$this->form_validation->set_rules('ConfirmPassword','ConfirmPassword','required');
		$this->form_validation->set_rules('rbnTermsAndConditios','Agree','required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->form_validation->set_message('Error validate');
			$this->load->view('register_error_validate');
		}
		else
		{
			$this->load->view('login_view');
		}
	}
}
?>
