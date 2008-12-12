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
 * XtraUpload Main Links Startup Model
 *
 * @package		XtraUpload
 * @subpackage	Model
 * @category	Model
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/code/models/startup
 */

// ------------------------------------------------------------------------

class Simple_blog extends Model 
{
	// ------------------------------------------------------------------------

    public function Simple_blog()
    {
        // Call the Model constructor
        parent::Model();
		
		$this->xu_api->addAdminMenuLink('/admin/blog/manage', 'Blog', 'img/icons/comments_16.png');
		$this->xu_api->addMainMenuLink('blog', 'Blog', 'img/icons/comments_16.png');
    }
	
	public function install()
	{
		$this->load->dbforge();
		
		// Blog Table
		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'date' => array(
				'type' => 'VARCHAR',
				'constraint' => '20'
			),
			'author' => array(
				'type' => 'VARCHAR',
				'constraint' => '60'
			),
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => '255'
			),
			'body' => array(
				'type' => 'TEXT',
			),
			'approved' => array(
				'type' => 'TINYINT',
				'constraint' => '1',
				'default' => 1
			),
			'comments' => array(
				'type' => 'TINYINT',
				'constraint' => '1',
				'default' => 1
			),
			'category' => array(
				'type' => 'VARCHAR',
				'constraint' => '100'
			),
			'tags' => array(
				'type' => 'VARCHAR',
				'constraint' => '255'
			),
			'archived' => array(
				'type' => 'TINYINT',
				'constraint' => '1',
				'defualt' => 0
			),
			'rand_id' => array(
				'type' => 'VARCHAR',
				'constraint' => '8'
			)
		);
		
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->add_key('rand_id', false);
		$this->dbforge->create_table('blog');
		
		
		// BlogCat Table
		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '100'
			),
			'description' => array(
				'type' =>'TEXT'
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('blogcat');
		
		// BlogComments Table
		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'pid' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE
			),
			'author' => array(
				'type' => 'VARCHAR',
				'constraint' => '60'
			),
			'link' => array(
				'type' => 'VARCHAR',
				'constraint' => '150'
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '200'
			),
			'body' => array(
				'type' => 'TEXT'
			),
			'time' => array(
				'type' => 'VARCHAR',
				'constraint' => '22'
			),
			'status' => array(
				'type' => 'TINYINT',
				'constraint' => '1'
			),
			'approved' => array(
				'type' => 'TINYINT',
				'constraint' => '1',
				'default' => 1
			),
			'ip' => array(
				'type' => 'VARCHAR',
				'constraint' => '15'
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('blogcomments');
		return;
	}
	
	public function uninstall()
	{
		$this->load->dbforge();
		$this->dbforge->drop_table('blog');
		$this->dbforge->drop_table('blogcat');
		$this->dbforge->drop_table('blogcomments');
		return;
	}
}
?>