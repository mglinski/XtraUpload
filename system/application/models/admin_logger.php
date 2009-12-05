<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
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
 * XtraUpload Admin Access Model
 *
 * @package		XtraUpload
 * @subpackage	Model
 * @category	Model
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/files
 */

// ------------------------------------------------------------------------

class Admin_logger extends Model 
{
	// ------------------------------------------------------------------------

    public function Admin_logger()
    {
        // Call the Model constructor
        parent::Model();
    }
    
    
    function addLog($valid=0)
    {
    	$data['user'] = $this->session->userdata('id');
    	$data['user_name'] = $this->session->userdata('username');
    	$data['ip'] = $this->input->ip_address();
    	$data['date'] = time();
		$data['valid'] = $valid;
    	
    	$this->db->insert('login_refrence', $data);
    }
    
    function getLogs($limit=100, $offset=0, $select='')
	{
		$this->db->order_by("date", "desc"); 
		if($select != '')
		{
			$this->db->select($select);
		}

		$query = $this->db->get('login_refrence', $limit, $offset);
		return $query;	
	}
}
?>