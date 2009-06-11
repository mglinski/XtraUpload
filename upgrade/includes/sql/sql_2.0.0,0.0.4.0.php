<?php  if ( ! defined("BASEPATH")) exit("No direct script access allowed");

// 2.0.0 B4 -> 2.0.0 RC1 | Upgrade Commands

// required command, DO NOT CHANGE
$data = array('value' => '2.0.0,0.1.0.0');
$this->db->where('name', '_db_version')->update('config', $data);

