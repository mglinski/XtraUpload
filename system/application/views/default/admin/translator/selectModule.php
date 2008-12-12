<?php

/* Forms */

echo form_open('admin/translator', '', $hidden );
echo '<p>';
echo form_label('Select Your Language Segement', 'langModule');
foreach ( $masterModules as $masterModule ) 
{	
	echo form_radio('langModule', $masterModule).' '.ucwords($masterModule).'<br />';
}
echo '<br />';
echo generateSubmitButton('Next Step', $base_url.'img/icons/forward_16.png', 'green').'<br /></p>';
echo form_close();
?>