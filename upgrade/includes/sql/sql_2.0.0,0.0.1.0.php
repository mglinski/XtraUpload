<?php  if ( ! defined("BASEPATH")) exit("No direct script access allowed");

// 2.0.0 B1 -> 2.0.0 B2 | Upgrade Commands
$data = array('id' =>  NULL, 'name' => 'show_recent_uploads', 'value' => '1', 'description1' => 'Show Recent Uploads', 'description2' => 'Yes|-|No<br /><br />Show a list of the 5 most recently uploaded files?', 'group' => 0, 'type' => 'yesno', 'invincible' => 1);
$this->db->insert('config', $data);

$data = array('value' => '2.0.0,0.0.2.0');
$this->db->where('name', '_db_version')->update('config', $data);