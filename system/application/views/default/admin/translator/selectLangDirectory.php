<?php

/* Forms */

foreach ( $langdirs as $langdir ) {
	
	echo form_open('admin/translator');
	
	//echo form_submit('langDir', $langdir);
	echo form_hidden('langDir', $langdir);
	echo generateSubmitButton(ucwords($langdir), $base_url.'img/icons/forward_16.png', 'green');
	
	echo form_close();
	
}

?>
