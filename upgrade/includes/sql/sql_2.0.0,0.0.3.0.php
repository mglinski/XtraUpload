<?php  if ( ! defined("BASEPATH")) exit("No direct script access allowed");

// 2.0.0 B3 -> 2.0.0 B4 | Upgrade Commands



// required command, DO NOT CHANGE
$data = array('value' => '2.0.0,0.0.4.0');
$this->db->where('name', '_db_version')->update('config', $data);