<?php  if ( ! defined("BASEPATH")) exit("No direct script access allowed");

// 2.0.0 B4 -> 2.0.0 RC1 | Upgrade Commands

// Sessions Table
$fields = array(
	'session_id' => array(
		'type' => 'VARCHAR',
		'constraint' => 40
	),
	'ip_address' => array(
		'type' => 'VARCHAR',
		'constraint' => 16,
		'default' => 0,
		'null' => false
	),
	'active' => array(
		'type' => 'TINYINT',
		'unsigned' => TRUE,
		'default' => '0',
		'constraint' => 1
	),
	'user_agent' => array(
		'type' => 'VARCHAR',
		'null' => false,
		'constraint' => 50
	),
	'last_activity' => array(
		'type' => 'INT',
		'unsigned' => TRUE,
		'default' => '0',
		'constraint' => 10
	),
	'user_data' => array(
		'type' => 'TEXT',
		'null' => false
	)
);
$this->dbforge->add_field($fields);
$this->dbforge->add_key('session_id', true);
$this->dbforge->create_table('sessions');

// Admin Menu Shortcuts Table
$fields = array(
	'id' => array(
		'type' => 'INT',
		'constraint' => 11,
		'unsigned' => true,
		'auto_increment' => true
	),
	'title' => array(
		'type' => 'VARCHAR',
		'constraint' => 255,
		'null' => false
	),
	'link' => array(
		'type' => 'TEXT',
		'null' => false
	),
	'order' => array(
		'type' => 'VARCHAR',
		'null' => false,
		'constraint' => 4
	),
	'status' => array(
		'type' => 'TINYINT',
		'null' => false,
		'default' => '0',
		'constraint' => 1
	)
);
$this->dbforge->add_field($fields);
$this->dbforge->add_key('id', true);
$this->dbforge->create_table('admin_menu_shortcuts');

// Login Refrence Table
$fields = array(
	'id' => array(
		'type' => 'INT',
		'constraint' => 11,
		'unsigned' => true,
		'auto_increment' => true
	),
	'date' => array(
		'type' => 'INT',
		'constraint' => 11,
		'unsigned' => true
	),
	'ip' => array(
		'type' => 'VARCHAR',
		'null' => false,
		'constraint' => 15
	),
	'user' => array(
		'type' => 'INT',
		'constraint' => 11,
		'unsigned' => true,
	),
	'user_name' => array(
		'type' => 'VARCHAR',
		'null' => false,
		'default' => '0',
		'constraint' => 200
	),
	'valid' => array(
		'type' => 'TINYINT',
		'null' => false,
		'default' => '0',
		'constraint' => 1
	)
);
$this->dbforge->add_field($fields);
$this->dbforge->add_key('id', true);
$this->dbforge->create_table('login_refrence');


// server stats
$fields = array(
	'num_files' => array(
		'type' => 'INT',
		'constraint' => 11,
		'unsigned' => true
	),
	'free_space' => array(
		'type' => 'VARCHAR',
		'constraint' => 50
	),
	'used_space' => array(
		'type' => 'VARCHAR',
		'constraint' => 50
	),
	'total_space' => array(
		'type' => 'VARCHAR',
		'constraint' => 50
	)
);
$this->dbforge->add_column('servers', $fields);

// tags support
$fields = array(
	'tags' => array(
		'name' => 'tags',
		'type' => 'VARCHAR',
		'constraint' => 200
	)
);
$this->dbforge->add_column('refrence', $fields);

$fields = array(
	'server' => array(
		'name' => 'server',
		'type' => 'VARCHAR',
		'constraint' => 250
	),
);
$this->dbforge->modify_column('files', $fields);

// gives ALTER TABLE table_name CHANGE old_name new_name TEXT

// required command, DO NOT CHANGE
$data = array('value' => '2.0.0,0.1.0.0');
$this->db->where('name', '_db_version')->update('config', $data);

