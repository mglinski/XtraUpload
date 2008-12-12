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
 * XtraUpload Captcha API Controller
 *
 * @package		XtraUpload
 * @subpackage	Controllers - API
 * @category	Controllers
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/files
 */

// ------------------------------------------------------------------------

class Captcha extends Controller 
{
	public function Captcha()
	{
		parent::Controller();	
	}
	
	public function get($old)
	{
		if($this->session->flashdata('captcha'))
		{
			$oldCaptcha = str_replace('.jpg', '', $this->session->flashdata('captcha'));
			$this->db->delete('captcha', array('captcha_time' => $oldCaptcha));
			//echo $oldCaptcha."<br />";
			@unlink('temp/'.$oldCaptcha.'.jpg');
		}
		
		$captcha = $this->_getCaptcha();
		echo $captcha;
	}
	
	private function _getCaptcha()
	{
		$this->load->helper('captcha');
		
		$vals = array(
			'img_path'	=> './temp/',
			'word'		=> $this->users->genPass(3, false),
			'img_width'	=> 70,
			'img_height' => 20,
			'img_url'	=> base_url().'temp/',
			'fonts' => array('MyriadWebPro-Bold.ttf')
		);
		
		$cap = create_captcha($vals);
		
		if(!$cap)
			echo '||';
		
		$data = array(
			'captcha_time'	=> $cap['time'],
			'ip_address'	=> $this->input->ip_address(),
			'word'			=> $cap['word']
		);

		$this->db->insert('captcha', $data);
		$this->session->set_flashdata('captcha', floatval($cap['time']).'.jpg');
		
		return $cap['image'];
	}
}
?>