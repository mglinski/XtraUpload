<?php

/* Forms */
echo form_open('admin/translator', '', $hidden );
echo '<p>';
echo form_label('Select Your Language', 'slaveLang');
foreach ( $languages as $language ) 
{
	//echo form_hidden('slaveLang', $language);
	echo form_radio('slaveLang', $language).' '.ucwords($language).'<br />';
}
echo '<br />';
echo generateSubmitButton('Next Step', $base_url.'img/icons/forward_16.png', 'green').'<br /></p>';
echo form_close();
?>
