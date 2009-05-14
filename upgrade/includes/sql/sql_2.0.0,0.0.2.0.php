<?php  if ( ! defined("BASEPATH")) exit("No direct script access allowed");

// 2.0.0 B2 -> 2.0.0 B3 | Upgrade Commands

// adding in new options for user groups
$fields = array(
	'can_search' => array(
		'type' => 'TINYINT',
		'default' => '0',
		'constraint' => 1
	),
	'can_flash_upload' => array(
		'type' => 'TINYINT',
		'default' => '1',
		'constraint' => 1
	),
	'can_url_upload' => array(
		'type' => 'TINYINT',
		'default' => '1',
		'constraint' => 1
	),
	'file_expire' => array(
		'type' => 'INT',
		'default' => '30',
		'constraint' => 11
	)
);
$this->dbforge->add_column('groups', $fields);

// adding in the ability to see all users uploaded and public files
$fields = array(
	'public' => array(
		'type' => 'TINYINT',
		'default' => 0,
		'constraint' => 1
	)
);
$this->dbforge->add_column('users', $fields);

// adding in robust ban support in the DB, frontend to come soon
$fields = array(
	'type' => array(
		'type' => 'VARCHAR',
		'default' => 'file',
		'constraint' => 30
	),
	'ip' => array(
		'type' => 'VARCHAR',
		'default' => '0.0.0.0',
		'constraint' => 15
	),
	'user' => array(
		'type' => 'VARCHAR',
		'default' => 0,
		'constraint' => 150
	),
	'time' => array(
		'type' => 'VARCHAR',
		'default' => 0,
		'constraint' => 22
	)
);
$this->dbforge->add_column('bans', $fields);

// double collumn, droping the redundant one
$this->dbforge->drop_column('files', 'last_download');

// required command, DO NOT CHANGE
$data = array('value' => '2.0.0,0.0.3.0');
$this->db->where('name', '_db_version')->update('config', $data);