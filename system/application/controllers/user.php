<?php
/**
 * XtraUpload
 *
 * A turn-key open source web 2.0 PHP file uploading package requiring PHP v5
 *
 * @package		XtraUpload
 * @author		Matthew Glinski
 * @copyright	Copyright (c) 2006, XtraFile.com
 * @license		http://xtrafile.com/docs/license
 * @link		http://xtrafile.com
 * @since		Version 2.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * XtraUpload User Page Controller
 *
 * @package		XtraUpload
 * @subpackage	Controllers
 * @category	Controllers
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/user
 */

// ------------------------------------------------------------------------

class User extends Controller 
{
	public function User()
	{
		parent::Controller();	
		
		$this->load->database();
		$this->load->library('validation');
		$this->lang->load('user');
	}
		
	public function index()
	{
		if($this->session->userdata('id'))
		{
			redirect('user/login');
		}
		else
		{
			redirect('user/manage');
		}
	}

	// ------------------------------------------------------------------------
	
	public function forgot()
	{		
		redirect('forgotPassword');
	}
	
	// ------------------------------------------------------------------------
	
	public function compare()
	{		
		$data['group1'] = $this->db->get_where('groups', array('id' => 1))->row();
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('user_compare_header')));
		$this->load->view($this->startup->skin.'/user/compare', $data);
		$this->load->view($this->startup->skin.'/footer');
	}

	// ------------------------------------------------------------------------
	
	public function register()
	{
		if($this->db->get_where('groups', array('id !=' => 2, 'id !=' => 1, 'status' => '1'))->num_rows() == 0)
		{
			$data['errorMessage'] = '';
			$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('user_controller_2')));
			$this->load->view($this->startup->skin.'/user/register/closed', $data);
			$this->load->view($this->startup->skin.'/footer');
			return;
		}
		
		// Blank Error Message
		$data['errorMessage'] = '';
		
		// If user failed CAPTCHA, delete it
		if($this->session->flashdata('captcha'))
		{
			unlink('temp/'.$this->session->flashdata('captcha'));
		}
		
		// Delete old captchas
		$expiration = time()-7200; // Two hour limit
		$this->db->delete('captcha', array("captcha_time <" => $expiration));
			
		$data['captcha'] = $this->_getCaptcha();
		$data['groups'] = $this->db->get_where('groups', array('status' => '1'));
		$data['gates'] = $this->db->get_where('gateways', array('status' => '1'));
			
		$rules['username'] = "trim|required|strtolower|min_length[5]|max_length[12]|xss_clean|callback__username_check";
		$rules['password'] = "trim|required|min_length[4]|matches[passconf]";
		$rules['passconf'] = "trim|required";
		$rules['email'] = "trim|required|valid_email|max_length[255]|matches[emailConf]|callback__email_check";
		$rules['emailConf'] = "trim|required";
		
		//echo serialize(array('email' => 'text'));
		
		$this->validation->set_rules($rules);
		
		$fields['username']		= $this->lang->line('user_controller_3');
		$fields['password']		= $this->lang->line('user_controller_4');
		$fields['passconf']		= $this->lang->line('user_controller_5');
		$fields['email']		= $this->lang->line('user_controller_6');
		$fields['emailConf']	= $this->lang->line('user_controller_7');
	
		$this->validation->set_fields($fields);
		if($this->input->post('posted'))
		{
			$run = $this->validation->run();
			$query = $this->db->get_where('captcha', array('word' => $this->input->post('captcha'), 'ip_address' => $this->input->ip_address(),'captcha_time >' => $expiration,));
			$rows = $query->num_rows();
			
			if(!$rows)
			{
				$run = FALSE;
			}
				
			if (!$run)
			{
				$error = str_replace(array('<p>','</p>'),array('','<br />'),$this->validation->error_string); 
				if(!$rows)
				{
					$error .= $this->lang->line('user_controller_8').'<br />';
				}
				$data['errorMessage'] = '<p><span class="alert"><b>Error(s):'.$this->lang->line('user_controller_9').'</b><br />'.$error.'</p>';
				
				$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('user_controller_10')));
				$this->load->view($this->startup->skin.'/user/register/begin', $data);
				$this->load->view($this->startup->skin.'/footer');
			}
			else
			{
				$this->_registerSubmit();
			}	
		}
		else
		{
			$data['errorMessage'] = '';
			$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('user_controller_10')));
			$this->load->view($this->startup->skin.'/user/register/begin', $data);
			$this->load->view($this->startup->skin.'/footer');
		}
	}

	// ------------------------------------------------------------------------
	
	public function login()
	{
		//$this->output->cache(60);
		$rules['username'] = "trim|required|min_length[5]|max_length[32]|xss_clean|strtolower";
		$rules['password'] = "trim|required|min_length[4]";
		
		$this->validation->set_rules($rules);
		
		$fields['username']	= $this->lang->line('user_controller_3');
		$fields['password']	= $this->lang->line('user_controller_4');
	
		$this->validation->set_fields($fields);
		
		if ($this->validation->run() == FALSE)
		{
			$error = str_replace('p>','li>',$this->validation->error_string); 
			if($this->input->post('submit'))
			{
				$this->load->vars(array('errorMessage' => '<span class="alert"><b>'.$this->lang->line('user_controller_9').'</b><ul>'.$error.'</ul></span>'));
			}
			else
			{
				$this->load->vars(array('errorMessage' => ''));
			}
			$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('user_controller_11')));
			$this->load->view($this->startup->skin.'/user/login');
			$this->load->view($this->startup->skin.'/footer');
		}
		else
		{
			$this->_loginSubmit();
		}
	}
	
	// ------------------------------------------------------------------------
	
	public function pay_cancel()
	{
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('user_controller_12')));
		$this->load->view($this->startup->skin.'/user/register/pay_cancel');
		$this->load->view($this->startup->skin.'/footer');
	}
	
	public function pay_complete()
	{
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('user_controller_13')));
		$this->load->view($this->startup->skin.'/user/register/pay_complete');
		$this->load->view($this->startup->skin.'/footer');
	}
	
	public function pay_new($id='', $gate_id='')
	{
		if(intval($id) == 0 or intval($gate_id) == 0)
		{
			show_404();
		}
		
		$user = $this->db->get_where('users', array('id' => $id))->row();
		if(!$user or $user->status != 0)
		{
			show_404();
		}
		
		$group = $this->db->get_where('groups', array('id' => $user->group))->row();
		if(!$group)
		{
			show_404();
		}
		
		$gate = $this->db->get_where('gateways', array('id' => $gate_id))->row();
		if(!$gate)
		{
			show_404();
		}
		
		// get payment gateway settings
		$gate_conf = unserialize($gate->settings);
		
		// load payment libs
		include_once (APPPATH.'libraries/payment/PaymentGateway.php');
		
		// which payment system to use?
		if($gate->name == 'paypal')
		{
			// Include the paypal library
			include_once (APPPATH.'libraries/payment/Paypal.php');
			
			// Create an instance of the paypal library
			$myPaypal = new Paypal();
			
			// Specify your paypal email
			$myPaypal->addField('business', $gate_conf['email']);
			
			// Specify the currency
			$myPaypal->addField('currency_code', $gate_conf['currency']);
			
			// Specify the url where paypal will send the user on success/failure
			$myPaypal->addField('return', site_url('user/pay_complete'));
			$myPaypal->addField('cancel_return', site_url('user/pay_cancel'));
			
			// Specify the url where paypal will send the IPN
			$myPaypal->addField('notify_url', site_url('payment/ipn/paypal'));
			
			// Specify the product information
			$myPaypal->addField('item_name', $this->startup->site_config['sitename'].' '.$this->lang->line('user_controller_14'));
			$myPaypal->addField('amount', $group->price);
			$myPaypal->addField('item_number',  rand(1,1000).'-'.$user->id);
			
			// Specify any custom value
			$myPaypal->addField('custom', base64_encode(serialize(array('user_id'=>$user->id, 'type'=>'reg'))));
			
			// Enable test mode if needed
			if(defined('XUDEBUG') and XUDEBUG == true)
			{
				$myPaypal->enableTestMode();
			}
			
			// Let's start the train!
			$data['form'] = $myPaypal->submitPayment('If you are not automatically redirected to payment website within 5 seconds,<br /> click \'Make Payment\' below to begin the payment procedure.');
		}
		else if($gate->name == 'authorize')
		{
			// Include the paypal library
			include_once (APPPATH.'libraries/payment/Authorize.php');
			
			// Create an instance of the authorize.net library
			$myAuthorize = new Authorize();
			
			// Specify your authorize.net login and secret
			$myAuthorize->setUserInfo($gate_conf['login'], $gate_conf['secret']);
			
			// Specify the url where authorize.net will send the user on success/failure
			$myAuthorize->addField('x_Receipt_Link_URL', site_url('user/pay_complete'));
			
			// Specify the url where authorize.net will send the IPN
			$myAuthorize->addField('x_Relay_URL', site_url('payment/ipn/authorize'));
			
			// Specify the product information
			$myAuthorize->addField('x_Description', $this->startup->site_config['sitename'].' '.$this->lang->line('user_controller_14'));
			$myAuthorize->addField('x_Amount', $group->price);
			$myAuthorize->addField('x_Invoice_num',  rand(1,1000).'-'.$user->id);
			$myAuthorize->addField('x_Cust_ID', base64_encode(serialize(array('user_id' => $user->id, 'type' => 'reg'))));
			
			// Enable test mode if needed
			if(defined('XUDEBUG') and XUDEBUG == true)
			{
				$myAuthorize->enableTestMode();
			}
			
			// Let's start the train!
			$data['form'] = $myAuthorize->submitPayment('If you are not automatically redirected to payment website within 5 seconds,<br /> click \'Make Payment\' below to begin the payment procedure.');
		}
		else if($gate->name = '2co')
		{
			// Include the paypal library
			include_once (APPPATH.'libraries/payment/TwoCo.php');
			
			// Create an instance of the authorize.net library
			$my2CO = new TwoCo();
			
			// Specify your 2CheckOut vendor id
			$my2CO->addField('sid', $gate_conf['vendor_id']);
			
			// Specify the order information
			$my2CO->addField('cart_order_id', rand(1,1000).'-'.$user->id);
			$my2CO->addField('total', $group->price);
			
			// Specify the url where authorize.net will send the IPN
			$my2CO->addField('x_Receipt_Link_URL', site_url('payment/ipn/two_checkout'));
			$my2CO->addField('tco_currency', $gate_conf['currency']);
			$my2CO->addField('custom', base64_encode(serialize(array('user_id' => $user->id, 'type'=>'reg'))));
			
			// Enable test mode if needed
			if(defined('XUDEBUG') and XUDEBUG == true)
			{
				$my2CO->enableTestMode();
			}
			
			// Let's start the train!
			$data['form'] = $my2CO->submitPayment('If you are not automatically redirected to payment website within 5 seconds,<br /> click \'Make Payment\' below to begin the payment procedure.');
		}
		
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('user_controller_15')));
		$this->load->view($this->startup->skin.'/user/register/pay_new', array('ammount' => $group, 'user' => $id, 'form' => $data['form'] ));
		$this->load->view($this->startup->skin.'/footer');
	}

	// ------------------------------------------------------------------------
	
	public function manage()
	{
		if(!$this->session->userdata('id'))
		{
			redirect('/user/login');
		}
		
		$data['errorMessage'] = '';
		if($this->session->flashdata('errorMessage'))
		{
			$data['errorMessage'] = $this->session->flashdata('errorMessage');
		}
		
		$run = false;
		
		if ($run == FALSE and $this->input->post('username'))
		{
			$error = str_replace(array('<p>','</p>'),array('','<br />'), $this->validation->error_string); 
			$data['errorMessage'] = '<p><span class="alert"><b>'.$this->lang->line('user_controller_9').'</b><br />'.$error.'</span></p>';
			
			$query = $this->db->getwhere('users', array('id' => $this->session->userdata('id')));
			$data['user'] = $query->row();
			$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('user_controller_16')));
			$this->load->view($this->startup->skin.'/user/manage', $data);
			$this->load->view($this->startup->skin.'/footer');
		}
		else if(!$this->input->post('username'))
		{
			$data['errorMessage'] = '';

			$query = $this->db->getwhere('users', array('id' => $this->session->userdata('id')));
			$data['user'] = $query->row();
			
			$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('user_controller_16')));
			$this->load->view($this->startup->skin.'/user/manage', $data);
			$this->load->view($this->startup->skin.'/footer');
		}
		else
		{
			$this->_userUpdate();
		}
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * User->files()
	 *
	 * File management page, logged in users only
	 *
	 * @access	public
	 * @return	none
	 */
	public function files($user)
	{
		$query = $this->db->getwhere('users', array('username' => $user));
		$data['user'] = $query->row();
		
		if($data['user']->public)
		{
			// Load the pagination library
			$this->load->library('pagination');
			
			// Setup some vars
			$data['flashMessage'] = '';
			$perPage = 25;
			
			// Pagination config values
			$config['base_url'] = site_url('user/files/'.$user);
			$config['total_rows'] = $this->files_db->getNumUserfiles($data['user']->id, true);
			$config['per_page'] = $perPage;	
			
			// setup the pagination library
			$this->pagination->initialize($config);
		
			// Get the files object
			$data['files'] = $this->files_db->getFilesByUser($data['user']->id, true, $perPage, $this->uri->segment(3), '', true);
			
			// Create the pagination HTML
			$data['pagination'] = $this->pagination->create_links();
		}
		
		// If there was a message generated previously, load it
		if($this->session->flashdata('msg'))
		{
			$data['flashMessage'] = '<span class="info"><b>'.$this->session->flashdata('msg').'</b></span>';
		}
		
		// Load the static files
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('files_controller_3')));
		$this->load->view($this->startup->skin.'/user/files', $data);
		$this->load->view($this->startup->skin.'/footer');
	}

	// ------------------------------------------------------------------------
	
	public function changePassword()
	{
		if(!$this->session->userdata('id'))
		{
			redirect('/user/login');
		}
		$rules['oldpassword'] = "trim|required|min_length[4]|callback__password_check";
		$rules['newpassword'] = "trim|required|min_length[4]|matches[newpassconf]";
		$rules['newpassconf'] = "trim|required";
		
		$this->validation->set_rules($rules);
		
		$fields['oldpassword']	= $this->lang->line('user_controller_17');
		$fields['newpassword']	= $this->lang->line('user_controller_18');
		$fields['newpassconf']	= $this->lang->line('user_controller_19');
	
		$this->validation->set_fields($fields);
		$run = $this->validation->run();

		if ($run == FALSE and $this->input->post('username'))
		{
			$error = str_replace(array('<p>','</p>'),array('','<br />'), $this->validation->error_string); 
			$this->load->vars(
				array('errorMessage' => '<p><span class="alert"><b>'.$this->lang->line('user_controller_9').'</b><br />'.$error.'</span></p>')
			);
			
			$query = $this->db->getwhere('users', array('id' => $this->session->userdata('id')));
			$user = $query->row();
			
			$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('user_controller_20')));
			$this->load->view($this->startup->skin.'/user/password', $user);
			$this->load->view($this->startup->skin.'/footer');
		}
		else if(!$this->input->post('username'))
		{
			$this->load->vars(
				array('errorMessage' => '')
			);
			$query = $this->db->getwhere('users', array('id' => $this->session->userdata('id')));
			$user = $query->row();
			
			$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('user_controller_20')));
			$this->load->view($this->startup->skin.'/user/password', $user);
			$this->load->view($this->startup->skin.'/footer');
		}
		else
		{
			$this->_passwordUpdate();
		}
	}

	// ------------------------------------------------------------------------
	
	public function forgotPassword()
	{
		$rules['username'] 	= "trim|required|min_length[4]|callback__username_check_forgot";
		$rules['email'] 	= "trim|required|valid_email|callback__email_check_forgot";
		
		$this->validation->set_rules($rules);
		
		$fields['username']	= $this->lang->line('user_controller_3');
		$fields['email']	= $this->lang->line('user_controller_6');
	
		$this->validation->set_fields($fields);
		$run = $this->validation->run();

		$res = $this->_checkUser();
		
		if(!$res)
		{
			$run = false;
		}	

		if ($run == FALSE and $this->input->post('posted'))
		{
			$error = str_replace(array('<p>','</p>'),array('','<br />'), $this->validation->error_string); 
			
			if(!$res)
			{
				$error .= $this->lang->line('user_controller_21');
			}	

			
			$this->load->vars(
				array('errorMessage' => '<p><span class="alert"><b>'.$this->lang->line('user_controller_9').'</b><br />'.$error.'</span></p>')
			);
			
			$query = $this->db->getwhere('users', array('id' => $this->session->userdata('id')));
			$user = $query->row();
			
			$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('user_controller_22')));
			$this->load->view($this->startup->skin.'/user/forgot', $user);
			$this->load->view($this->startup->skin.'/footer');
		}
		else if(!$this->input->post('posted'))
		{
			$this->load->vars(
				array('errorMessage' => '')
			);
			
			$query = $this->db->getwhere('users', array('id' => $this->session->userdata('id')));
			$user = $query->row();
			
			$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('user_controller_22')));
			$this->load->view($this->startup->skin.'/user/forgot', $user);
			$this->load->view($this->startup->skin.'/footer');
		}
		else
		{
			$this->_passwordForgot();
		}
	}

	// ------------------------------------------------------------------------
	
	public function logout()
	{
		$this->users->userLogout();
		redirect('home');
	}

	// ------------------------------------------------------------------------
	
	public function profile($uname)
	{
		$this->load->helper(array('string', 'text'));
		$data['user'] = $this->db->get_where('users', array('username' => $uname))->row();
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('user_controller_23').' '.ucfirst($uname)));
		$this->load->view($this->startup->skin.'/user/profile/view', $data);
		$this->load->view($this->startup->skin.'/footer');
	}

	// ------------------------------------------------------------------------
	
	public function _username_check($str)
	{
		$query = $this->db->getwhere('users',array('username' => $str));
		$num = $query->num_rows();
		if($num == 1)
		{
			$this->validation->set_message('username_check', $this->lang->line('user_controller_24'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	// ------------------------------------------------------------------------
	
	public function _username_check_forgot($str)
	{
		$query = $this->db->getwhere('users',array('username' => $str));
		$num = $query->num_rows();
		if($num == 1)
		{
			return true;
		}
		else
		{
			$this->validation->set_message('username_check_forgot', $this->lang->line('user_controller_25'));
			return false;
		}
	}

	// ------------------------------------------------------------------------
	
	public function _email_check($str)
	{
		$query = $this->db->getwhere('users',array('email' => $str));
		$num = $query->num_rows();
		if($num == 1)
		{
			$this->validation->set_message('email_check', $this->lang->line('user_controller_26'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	// ------------------------------------------------------------------------
	
	public function _email_check_forgot($str)
	{
		$query = $this->db->getwhere('users',array('email' => $str));
		$num = $query->num_rows();
		if($num != 1)
		{
			$this->validation->set_message('email_check_forgot', $this->lang->line('user_controller_27'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	// ------------------------------------------------------------------------
	
	public function _password_check($str)
	{
		$data =  array(
			'username' => $this->session->userdata('username'), 
			'password' => md5($this->config->config['encryption_key'].$str)
		);
		
		$query = $this->db->getwhere('users', $data);
		$num = $query->num_rows();
		if($num != 1)
		{
			$this->validation->set_message('password_check', $this->lang->line('user_controller_28'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	// ------------------------------------------------------------------------
	
	private function _loginSubmit()
	{
		if($this->users->processLogin($this->input->post('username'), $this->input->post('password')))
		{			
			if(stristr($_SERVER['HTTP_REFERER'], 'user/login'))
			{
				redirect('home');
			}
			else
			{
				redirect(substr($_SERVER['HTTP_REFERER'], strlen(site_url())));
			}
			//redirect(substr($_SERVER['HTTP_REFERER'],24));
		}
		else
		{
			$this->load->vars(array('errorMessage' => '<span class="alert">'.$this->lang->line('user_controller_29').'</span>'));
			
			$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('user_controller_11')));
			$this->load->view($this->startup->skin.'/user/login');
			$this->load->view($this->startup->skin.'/footer');
			return false;
		}
	}

	// ------------------------------------------------------------------------
	
	private function _registerSubmit()
	{
		$data = array(  	
			'username' => $this->input->post('username'),
			'password' => md5($this->config->config['encryption_key'].$this->input->post('password')),
			'email' => $this->input->post('email'),
			'group' => $this->input->post('group'),
			'time' => time(),
			'lastLogin' => '',
			'ip' => $this->input->ip_address(),
		);
		
		$group = $this->db->select('price')->get_where('groups', array('id' => $this->input->post('group')))->row();
		
		$forward_pay = false;
		
		if($group->price > 0.00)
		{
			$data['status'] = 0;
			$data['gateway'] = $this->input->post('gate');
			$forward_pay = TRUE;
		}
		else
		{
			$data['status'] = 1;
			$forward_pay = FALSE;
		}
		
		$id = $this->users->newUser($data, $forward_pay);
		
		if($forward_pay == FALSE)
		{
			$this->users->processLogin($this->input->post('username'), $this->input->post('password'));
			$this->load->view($this->startup->skin.'/header', array('headerTitle' =>$this->lang->line('user_controller_10')));
			$this->load->view($this->startup->skin.'/user/register/complete');
			$this->load->view($this->startup->skin.'/footer');
		}
		else
		{
			redirect('user/pay_new/'.$id.'/'.$this->input->post('gate'));
			return false;
		}
	}

	// ------------------------------------------------------------------------
	
	private function _userUpdate()
	{
		if(isset($_FILES['avitar']['name']) and $_FILES['avitar']['name'] != '')
		{
			$this->load->model('imgup');
			$this->imgup->process_user_avitar($this->session->userdata('id'));
		}
		
		$data = array(  	
			// Nothing here yet!
		);
		
		$result = $this->users->userUpdate($data);
		
		if($result)
		{
			$this->session->set_flashdata('errorMessage', '<span class="info">'.$this->lang->line('user_controller_30').'</span>');
			redirect('user/manage');
		}
		else
		{
			$this->session->set_flashdata('errorMessage', '<span class="alert">'.$this->lang->line('user_controller_31').' '.$result.'</span>');
			redirect('user/manage');
		}
	}

	// ------------------------------------------------------------------------
	
	private function _checkUser()
	{		
		$query = $this->db->getwhere('users',array('username' => $this->input->post('username'), 'email' => $this->input->post('email')));
		$num = $query->num_rows();
		if($num != 1)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	// ------------------------------------------------------------------------
	
	private function _passwordUpdate()
	{
		$data = array(  	
			'password' => md5($this->config->config['encryption_key'].$this->input->post('newpassword'))
		);
		
		$result = $this->users->userUpdate($data);
		
		if($result)
		{
			$this->load->vars(array('errorMessage' => '<span class="info">'.$this->lang->line('user_controller_30').'</span>'));
			$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Change Password'));
			$this->load->view($this->startup->skin.'/user/password');
			$this->load->view($this->startup->skin.'/footer');
		}
		else
		{
			$this->load->vars(array('errorMessage' => '<span class="alert">'.$this->lang->line('user_controller_31').' '.$result.'</span>'));
			$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Change Password'));
			$this->load->view($this->startup->skin.'/user/password');
			$this->load->view($this->startup->skin.'/footer');
		}
	}

	// ------------------------------------------------------------------------
	
	private function _passwordForgot()
	{
		$this->load->library('email');
		
		$newPass = $this->functions->genPass(8);
		$newPassMD5 = md5($this->config->config['encryption_key'].$newPass);
		
		$username = $this->input->post('username');

		$result = $this->users->userUpdateForgot($newPassMD5, $username);
				
		$this->email->from($this->startup->site_config['site_email'], $this->startup->site_config['sitename'].' Support');
		$this->email->to( $this->input->post('email'));
		
		$this->email->subject('Password Reset Request');
		$this->email->message($this->lang->line('user_controller_32').' '.$username.',

'.$this->lang->line('user_controller_33').' '.$this->startup->site_config['sitename'].' '.$this->lang->line('user_controller_34').'
'.$this->lang->line('user_controller_35').'

--------------------------
'.$this->lang->line('user_controller_3').': '.$username.'
'.$this->lang->line('user_controller_4').': '.$newPass.'
--------------------------

'.$this->lang->line('user_controller_36').'
'.$this->startup->site_config['sitename'].' '.$this->lang->line('user_controller_37').'

');
		
		$this->email->send();
		
		if($result)
		{
			$this->load->vars(array('errorMessage' => '<span class="info">'.$this->lang->line('user_controller_38').'</span>'));
			$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('user_controller_22')));
			$this->load->view($this->startup->skin.'/user/forgot');
			$this->load->view($this->startup->skin.'/footer');;
		}
		else
		{
			$this->load->vars(array('errorMessage' => '<span class="alert">'.$this->lang->line('user_controller_38').' '.$result.'</span>'));
			$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('user_controller_22')));
			$this->load->view($this->startup->skin.'/user/forgot');
			$this->load->view($this->startup->skin.'/footer');
		}
	}

	// ------------------------------------------------------------------------
	
	private function _getCaptcha()
	{
		$this->load->helper('captcha');
		
		$vals = array(
			'img_path'	=> './temp/',
			'word'		=> $this->users->genPass(5, false),
			'img_width'	=> 140,
			'img_height' => 20,
			'img_url'	=> base_url().'temp/',
			'fonts' => array('MyriadWebPro-Bold.ttf')
		);
		
		$cap = create_captcha($vals);
		
		$data = array(
			'captcha_time'	=> $cap['time'],
			'ip_address'	=> $this->input->ip_address(),
			'word'			=> $cap['word']
		);

		$this->db->insert('captcha', $data);
		$this->session->set_flashdata('captcha', $cap['time'].'.jpg');
		
		return $cap['image'];
	}
}
?>