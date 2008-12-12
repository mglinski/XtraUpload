<?
// Bans Table
		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'md5' => array(
				'type' => 'VARCHAR',
				'constraint' => '32'
			),
			'name' => array(
				'type' =>'TEXT'
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->add_key('md5', false);
		$this->dbforge->create_table('bans');
		
		
		// Captcha Table
		$fields = array(
			'captcha_id' => array(
				'type' => 'BIGINT',
				'constraint' => 13,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'captcha_time' => array(
				'type' => 'TEXT'
			),
			'ip_address' => array(
				'type' => 'VARCHAR',
				'constraint' => 15,
				'default' => '0'
			),
			'word' => array(
				'type' => 'VARCHAR',
				'constraint' => 20,
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('captcha_id', true);
		$this->dbforge->add_key('word', false);
		$this->dbforge->create_table('captcha');
		
		
		// Config Table
		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 64
			),
			'value' => array(
				'type' => 'VARCHAR',
				'constraint' => 255
			),
			'description1' => array(
				'type' => 'TEXT'
			),
			'description2' => array(
				'type' => 'TEXT'
			),
			'group' => array(
				'type' => 'VARCHAR',
				'constraint' => 32,
				'default' => '0'
			),
			'type' => array(
				'type' => 'VARCHAR',
				'constraint' => 12
			),
			'invincible' => array(
				'type' => 'TINYINT',
				'constraint' => 1,
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('config');
		
		// INSERT initnal data
		$data = array('id' => NULL,'name' => 'sitename','value' => 'XtraUpload v2','description1' => 'Site Name:','description2' => '(Site Name)','group' => 'Main Settings','type' => 'text','invincible' => 1);
		$this->db->insert('config', $data);
		
		$data = array('id' => NULL,'name' => 'slogan','value' => 'Preview','description1' => 'Your Site Slogan','description2' => '','group' => 'Main Settings','type' => 'text','invincible' => 1);
		$this->db->insert('config', $data);
		
		$data = array( 'id' =>  NULL, 'name' => 'site_email', 'value' => 'admin@localhost', 'description1' => 'Site EMail', 'description2' => 'Email address used to send emails', 'group' => 'Main Settings', 'type' => 'text', 'invincible' => 1);
		$this->db->insert('config', $data);
		
		$data = array( 'id' =>  NULL, 'name' => 'title_separator', 'value' => '-', 'description1' => 'Title Separator', 'description2' => '', 'group' => 'Main Settings', 'type' => 'text', 'invincible' => 1);
		$this->db->insert('config', $data);
		
		$data = array('id' =>  NULL, 'name' => 'no_php_images', 'value' => '0', 'description1' => 'Use Static Image Links', 'description2' => 'Yes|-|No<br /><br />Use actual filesystem URLs to serve image thumbnails and direct images. Will save memory and server cycles on large sites.', 'group' => 'Main Settings', 'type' => 'yesno', 'invincible' => 1);
		$this->db->insert('config', $data);
		
		$data = array('id' =>  NULL, 'name' => 'allow_version_check', 'value' => '1', 'description1' => 'Allow Version Check', 'description2' => 'Yes|-|No<br /><br />Allow XtraUpload to call home to check for new versions and security updates?', 'group' => 0, 'type' => 'yesno', 'invincible' => 1);
		$this->db->insert('config', $data);
		
		$data = array('id' =>  NULL, 'name' => 'home_info_msg', 'value' => NULL, 'description1' => 'Home Page Message', 'description2' => 'Message to display to all your users on the home page. Like an announcement', 'group' => 0, 'type' => 'box', 'invincible' => 1);
		$this->db->insert('config', $data);
		
		$data = array('id' =>  NULL, 'name' => 'show_preview', 'value' => '1', 'description1' => 'Show File Preview', 'description2' => 'Show a preview of some file types on download(mp3, wmv, mov) and an embed code.', 'group' => 0, 'type' => 'yesno', 'invincible' => 1);
		$this->db->insert('config', $data);
		
		// counters Table
		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'downloads' => array(
				'type' => 'VARCHAR',
				'constraint' => 8
			),
			'bandwidth' => array(
				'type' => 'VARCHAR',
				'constraint' => 8
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('counters');
		
		
		// dlinks Table
		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'fid' => array(
				'type' => 'VARCHAR',
				'constraint' => 16
			),
			'time' => array(
				'type' => 'VARCHAR',
				'constraint' => 22
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 255
			),
			'ip' => array(
				'type' => 'VARCHAR',
				'constraint' => 15
			),
			'stream' => array(
				'type' => 'TINYINT',
				'constraint' => 1
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('dlinks');
		
		
		// dlsessions Table
		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'fid' => array(
				'type' => 'VARCHAR',
				'constraint' => 16
			),
			'ip' => array(
				'type' => 'VARCHAR',
				'constraint' => 15
			),
			'user' => array(
				'type' => 'INT',
				'constraint' => 11
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->add_key('fid');
		$this->dbforge->add_key('ip');
		$this->dbforge->create_table('dlsessions');
		
		// Downloads Table
		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'file_id' => array(
				'type' => 'VARCHAR',
				'constraint' => 16
			),
			'user' => array(
				'type' => 'VARCHAR',
				'constraint' => 20
			),
			'ip' => array(
				'type' => 'VARCHAR',
				'constraint' => 15
			),
			'size' => array(
				'type' => 'VARCHAR',
				'constraint' => 50
			),
			'sent' => array(
				'type' => 'VARCHAR',
				'constraint' => 50
			),
			'time' => array(
				'type' => 'VARCHAR',
				'constraint' => 25
			)
		);
		
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->add_key('file_id');
		$this->dbforge->add_key('user');
		$this->dbforge->add_key('ip');
		$this->dbforge->create_table('downloads');
		
		
		
		// Extend Table
		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'file_name' => array(
				'type' => 'VARCHAR',
				'constraint' => 100
			),
			'data' => array(
				'type' => 'TEXT'
			),
			'date' => array(
				'type' => 'VARCHAR',
				'constraint' => 22
			),
			'uid' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE
			),
			'active' => array(
				'type' => 'TINYINT',
				'constraint' => 1
			)
		);
		
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->add_key('file_name');
		$this->dbforge->create_table('extend');
		
		
		// Files Table
		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'filename' => array(
				'type' => 'TEXT'
			),
			'size' => array(
				'type' => 'INT',
				'constraint' => 11
			),
			'md5' => array(
				'type' => 'VARCHAR',
				'constraint' => 32
			),
			'status' => array(
				'type' => 'TINYINT',
				'constraint' => 4
			),
			'type' => array(
				'type' => 'VARCHAR',
				'constraint' => 10
			),
			'prefix' => array(
				'type' => 'VARCHAR',
				'constraint' => 2
			),
			'is_image' => array(
				'type' => 'TINYINT',
				'constraint' => 1
			),
			'thumb' => array(
				'type' => 'TEXT'
			),
			'last_download' => array(
				'type' => 'VARCHAR',
				'constraint' => 30
			),
			'server' => array(
				'type' => 'VARCHAR',
				'constraint' => 255
			),
			'mirror' => array(
				'type' => 'TINYINT',
				'constraint' => 1
			),
			'server' => array(
				'type' => 'TEXT'
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->add_key('prefix');
		$this->dbforge->add_key('md5');
		$this->dbforge->create_table('files');
		
		// Folder Table
		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'f_id' => array(
				'type' => 'VARCHAR',
				'constraint' => 15
			),
			'name' => array(
				'type' => 'TEXT'
			),
			'descr' => array(
				'type' => 'TEXT'
			),
			'pass' => array(
				'type' => 'VARCHAR',
				'constraint' => 150,
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->add_key('f_id', false);
		$this->dbforge->create_table('folder');
		
		
		
		// Folder Table
		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'g_id' => array(
				'type' => 'VARCHAR',
				'constraint' => 15
			),
			'name' => array(
				'type' => 'TEXT'
			),
			'descr' => array(
				'type' => 'TEXT'
			),
			'pass' => array(
				'type' => 'VARCHAR',
				'constraint' => 150,
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->add_key('g_id', false);
		$this->dbforge->create_table('gallery');
		
		
		// g_items Table
		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'gid' => array(
				'type' => 'VARCHAR',
				'constraint' => 8
			),
			'thumb' => array(
				'type' => 'TEXT'
			),
			'direct' => array(
				'type' => 'TEXT'
			),
			'fid' => array(
				'type' => 'VARCHAR',
				'constraint' => 16
			),
			'view' => array(
				'type' => 'TEXT'
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->add_key('gid', false);
		$this->dbforge->create_table('g_items');
		
		
		
		// groups Table
		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 100
			),
			'status' => array(
				'type' => 'TINYINT',
				'constraint' => 1
			),
			'descr' => array(
				'type' => 'TEXT'
			),
			'price' => array(
				'type' => 'VARCHAR',
				'constraint' => 8
			),
			'repeat_billing' => array(
				'type' => 'VARCHAR',
				'constraint' => 5
			),
			'speed_limit' => array(
				'type' => 'VARCHAR',
				'constraint' => 10
			),
			'upload_size_limit' => array(
				'type' => 'VARCHAR',
				'constraint' => 15
			),
			'wait_time' => array(
				'type' => 'VARCHAR',
				'constraint' => 10
			),
			'files_types' => array(
				'type' => 'TEXT'
			),
			'file_types_allow_deny' => array(
				'type' => 'TINYINT',
				'constraint' => 1
			),
			'download_captcha' => array(
				'type' => 'TINYINT',
				'constraint' => 1
			),
			'auto_download' => array(
				'type' => 'TINYINT',
				'constraint' => 1
			),
			'upload_num_limit' => array(
				'type' => 'INT',
				'constraint' => 11
			),
			'storage_limit' => array(
				'type' => 'VARCHAR',
				'constraint' => 50
			),
			'admin' => array(
				'type' => 'TINYINT',
				'constraint' => 1,
				'default' => '0'
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('groups');
		
		// Insert Free Group
		$data = array(
			'id' => '1',
			'name' => 'Free',
			'status' => 1,
			'price' => 0,
			'descr' => 'Free Users',
			'admin' => 0,
			'speed_limit' => '250',
			'upload_size_limit' => '100',
			'wait_time' => '10',
			'files_types' => 'exe|php|sh|bat|cgi|pl',
			'file_types_allow_deny' => 0,
			'download_captcha' => 1,
			'auto_download' => 0,
			'upload_num_limit' => 10
		);
		$this->db->insert('groups', $data);
		
		// Insert Admin Group
		$data = array(
			'id' => '2',
			'name' => 'Admins',
			'status' => 0,
			'price' => 0,
			'descr' => 'Administrators',
			'admin' => 1,
			'speed_limit' => '2500',
			'upload_size_limit' => '500',
			'wait_time' => '1',
			'files_types' => '',
			'file_types_allow_deny' => 0,
			'download_captcha' => 0,
			'auto_download' => 1,
			'upload_num_limit' => 500
		);
		$this->db->insert('groups', $data);
		
		
		// f_items Table
		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'folder_id' => array(
				'type' => 'VARCHAR',
				'constraint' => 8
			),
			'file_id' => array(
				'type' => 'VARCHAR',
				'constraint' => 16
			),
			'view' => array(
				'type' => 'TEXT'
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->add_key('folder_id', false);
		$this->dbforge->create_table('f_items');
		
		
		// progress Table
		$fields = array(
		'id' => array(
			 'type' => 'INT',
			 'constraint' => 11,
			 'unsigned' => TRUE,
			 'auto_increment' => TRUE
		),
		'progress' => array(
			'type' => 'BIGINT',
			'constraint' => 1
		),
		'curr_time' => array(
			 'type' => 'TEXT'
		),
		'total' => array(
			'type' => 'VARCHAR',
			'constraint' => 50
		),
		'start_time' => array(
			 'type' => 'TEXT'
		),
		
		'fid' => array(
			 'type' => 'VARCHAR',
			'constraint' => 16
		)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->add_key('fid', false);
		$this->dbforge->create_table('progress');
		
		
		// Refrence Table
		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => '11', 
				'unsigned' => true, 
				'auto_increment' => true
			),
			'file_id' => array(
				'type' => 'VARCHAR',
				'constraint' => '16'
			),
			'descr' => array(
				'type' => 'TEXT'
			),
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => '32'
			),
			'o_filename' => array(
				'type' => 'TEXT'
			),
			'secid' => array(
				'type' => 'VARCHAR',
				'constraint' => '32'
			),
			'status' => array(
				'type' => 'TINYINT',
				'constraint' => '32'
			),
			'ip' => array(
				'type' => 'VARCHAR',
				'constraint' => '15'
			),
			'link_name' => array(
				'type' => 'TEXT'
			),
			'feature' => array(
				'type' => 'TINYINT',
				'constraint' => '32'
			),
			'user' => array(
				'type' => 'INT',
				'constraint' => '11'
			),
			'type' => array(
				'type' => 'VARCHAR',
				'constraint' => '10'
			),
			'time' => array(
				'type' => 'VARCHAR',
				'constraint' => '20'
			),
			'pass' => array(
				'type' => 'VARCHAR',
				'constraint' => '32'
			),
			'rate_num' => array(
				'type' => 'INT',
				'constraint' => '32'
			),
			'rate_total' => array(
				'type' => 'INT',
				'constraint' => '11'
			),
			'is_image' => array(
				'type' => 'TINYINT',
				'constraint' => '32'
			),
			'link_id' => array(
				'type' => 'VARCHAR',
				'constraint' => '16'
			),
			'downloads' => array(
				'type' => 'INT',
				'constraint' => '11'
			),
			'featured' => array(
				'type' => 'TINYINT',
				'constraint' => '32'
			),
			'remote' => array(
				'type' => 'TINYINT',
				'constraint' => '1',
				'default' => '0'
			),
			'last_download' => array(
				'type' => 'VARCHAR',
				'constraint' => '22'
			),
			'direct_bw' => array(
				'type' => 'VARCHAR',
				'constraint' => '50'
			),
			'direct' => array(
				'type' => 'TINYINT',
				'constraint' => '1',
				'default' => '0'
			)
		);
		
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->add_key('feature');
		$this->dbforge->add_key('file_id');
		$this->dbforge->create_table('refrence');
		
		
		// Servers Table
		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
				'auto_increment' => true
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 150
			),
			'url' => array(
				'type' => 'VARCHAR',
				'constraint' => 255
			),
			'status' => array(
				'type' => 'INT',
				'default' => '0',
				'constraint' => 4
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('servers');
		
		$data = array('id' => NULL, 'name' => 'main', 'url' => $this->input->post('url'), 'status' => 1);
		$this->db->insert('servers', $data);
		
		
		// Skins Table
		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
				'auto_increment' => true
			),
			'name' => array(
				'type' => 'TEXT',
			),
			'active' => array(
				'type' => 'TINYINT',
				'unsigned' => TRUE,
				'default' => '0',
				'constraint' => 1
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('skin');
		
		$data = array('id' => NULL, 'name' => 'default', 'active' => 1);
		$this->db->insert('skin', $data);
		
		$data = array('id' => NULL, 'name' => 'vector_lover', 'active' => 0);
		$this->db->insert('skin', $data);
		
		$data = array('id' => NULL, 'name' => 'urban_artist', 'active' => 0);
		$this->db->insert('skin', $data);
		
		$data = array('id' => NULL, 'name' => 'tech_junkie', 'active' => 0);
		$this->db->insert('skin', $data);
		
		$data = array('id' => NULL, 'name' => 'citrus_island', 'active' => 0);
		$this->db->insert('skin', $data);
		
		$data = array('id' => NULL, 'name' => 'style_vantage_orange', 'active' => 0);
		$this->db->insert('skin', $data);
		
		$data = array('id' => NULL, 'name' => 'style_vantage_blue', 'active' => 0);
		$this->db->insert('skin', $data);
		
		$data = array('id' => NULL, 'name' => 'style_vantage_green', 'active' => 0);
		$this->db->insert('skin', $data);
		
		
		// Sessions Table
		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'username' => array(
				'type' => 'VARCHAR',
				'constraint' => 16
			),
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => 32
			),
			'time' => array(
				'type' => 'INT',
				'constraint' => 11
			),
			'lastLogin' => array(
				'type' => 'INT',
				'constraint' => 11
			),
			'status' => array(
				'type' => 'INT',
				'constraint' => 11
			),
			'ip' => array(
				'type' => 'VARCHAR',
				'constraint' => 15
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => 255
			),
			'group' => array(
				'type' => 'TINYINT',
				'constraint' => 4
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->add_key('email');
		$this->dbforge->add_key('group');
		$this->dbforge->create_table('users');
		
		// Insert Admin User
		$data = array(
			'id' => NULL,
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('enc').$this->input->post('password')),
			'time' => time(),
			'lastLogin' => 0,
			'status' => 1,
			'ip' => $this->input->ip_address(),
			'email' => $this->input->post('email'),
			'group' => 2
		);
		$this->db->insert('users', $data);