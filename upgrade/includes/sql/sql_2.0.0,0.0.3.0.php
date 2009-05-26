<?php  if ( ! defined("BASEPATH")) exit("No direct script access allowed");

// 2.0.0 B3 -> 2.0.0 B4 | Upgrade Commands

// Gateways Table
$fields = array(
	'id' => array(
		'type' => 'INT', 
		'constraint' => 11, 
		'unsigned' => TRUE, 
		'auto_increment' => TRUE
	), 
	'name' => array(
		'type' => 'VARCHAR', 
		'constraint' => 150
	), 
	'status' => array(
		'type' => 'TINYINT', 
		'constraint' => 1
	), 
	'config' => array(
		'type' => 'TEXT'
	), 
	'settings' => array(
		'type' => 'TEXT'
	), 
	'slug' => array(
		'type' => 'VARCHAR', 
		'constraint' => 20, 
		'default' => '0'
	), 
	'default' => array(
		'type' => 'TINYINT', 
		'constraint' => 1
	), 
	'display_name' => array(
		'type' => 'TEXT', 
		'constraint' => 1,
	)
);
$this->dbforge->add_field($fields);
$this->dbforge->add_key('id', true);
$this->dbforge->create_table('gateways');

$data = array('id' => 1, 'name' => 'paypal', 'status' => 1, 'config' => 'a:2:{s:5:"email";s:4:"text";s:8:"currency";s:4:"text";}', 'settings' => 'a:2:{s:5:"email";s:20:"PAYPAL_EMAIL_ADDRESS";s:8:"currency";s:3:"USD";}', 'slug' => 'paypal', 'default' => 1, 'display_name' => 'PayPal'
 );
$this->db->insert('gateways', $data);

$data = array('id' => 2, 'name' => 'authorize', 'status' => 1, 'config' => 'a:2:{s:5:"login";s:4:"text";s:6:"secret";s:4:"text";}', 'settings' => 'a:2:{s:5:"login";s:8:"LOGIN_ID";s:6:"secret";s:11:"SECRET_CODE";}', 'slug' => 'auth', 'default' => 0, 'display_name' => 'Authorize.net'
 );
$this->db->insert('gateways', $data);

$data = array('id' => 3, 'name' => '2co', 'status' => 1, 'config' => 'a:2:{s:9:"vendor_id";s:4:"text";s:8:"currency";s:4:"text";}', 'settings' => 'a:2:{s:9:"vendor_id";s:9:"VENDOR_ID";s:8:"currency";s:3:"USD";}', 'slug' => 'twoco', 'default' => 0, 'display_name' => '2CheckOut'
 );
$this->db->insert('gateways', $data);

// Transactions Table
$fields = array(
	'id' => array(
		'type' => 'INT', 
		'constraint' => 11, 
		'unsigned' => TRUE, 
		'auto_increment' => TRUE
	), 
	'time' => array(
		'type' => 'VARCHAR', 
		'constraint' => 20
	), 
	 
	'config' => array(
		'type' => 'TEXT'
	), 
	'settings' => array(
		'type' => 'TEXT'
	),
	'gateway' => array(
		'type' => 'VARCHAR', 
		'constraint' => 20
	), 
	'status' => array(
		'type' => 'TINYINT', 
		'constraint' => 1
	),
	'ammount' => array(
		'type' => 'VARCHAR', 
		'constraint' => 10
	), 
	'user' => array(
		'type' => 'INT', 
		'constraint' => 11,
		'unsigned' => TRUE
	)
);
$this->dbforge->add_field($fields);
$this->dbforge->add_key('id', true);
$this->dbforge->create_table('transactions');

// Adding in gatewat method store for users
$fields = array(
	'gateway' => array(
		'type' => 'INT',
		'default' => 0,
		'unsigned' => TRUE,
		'constraint' => 11
	)
);
$this->dbforge->add_column('users', $fields);

// Update config for new Settings Crap
$this->db->where('group', 'Main Settings')->update('config', array('group' => 0));

// upload_failures Table
$fields = array(
	'id' => array(
		'type' => 'INT',
		'constraint' => 11,
		'unsigned' => TRUE,
		'auto_increment' => TRUE
	),
	'secid' => array(
		'type' => 'VARCHAR',
		'constraint' => 32
	),
	'date' => array(
		'type' => 'INT',
		'constraint' => 16,
	),
	'reason' => array(
		'type' => 'VARCHAR',
		'constraint' => 50,
	)
);
$this->dbforge->add_field($fields);
$this->dbforge->add_key('id', true);
$this->dbforge->add_key('date', false);
$this->dbforge->add_key('secid', false);
$this->dbforge->create_table('upload_failures');

// required command, DO NOT CHANGE
$data = array('value' => '2.0.0,0.0.4.0');
$this->db->where('name', '_db_version')->update('config', $data);

