<?php  if ( ! defined("BASEPATH")) exit("No direct script access allowed");

// 2.0.0 B2 -> 2.0.0 B3 | Upgrade Commands



// required command, DO NOT CHANGE
$data = array('value' => '2.0.0,0.0.3.0');
$this->db->where('name', '_db_version')->update('config', $data);