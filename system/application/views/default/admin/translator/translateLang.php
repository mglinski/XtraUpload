<?php

echo form_open('admin/translator', '', $hidden );

?>

<table> 

<?php

echo '<tr>';
echo '<td class="translator_table_header">' . 'Key' . '</td>';
echo '<td class="translator_table_header">' . ucwords( $masterLang ) . '</td>';
echo '<td class="translator_table_header">' . ucwords( $slaveLang ) . '</td>';
echo '</tr>';

foreach ( $moduleData as $key => $line ) {
	echo '<tr valign="top">';
	echo '<td>' . $key . '</td>';
	echo '<td>' . htmlspecialchars( $line[ 'master' ] ) . '</td>';
	
	$data = array(
	  'name'        => $postUniquifier . $key,
	  'value'       => $line[ 'slave' ],
	  'size'        => '40',
	  'style'		=> 'margin-top:12px;'
	);
	echo '<td>' . form_input( $data );

	if ( strlen( $line[ 'error' ] ) > 0 ) {
		echo '<br /><span class="translator_error">' . $line[ 'error' ] . '</span>';
	}

	if ( strlen( $line[ 'note' ] ) > 0 ) {
		echo '<br /><span class="translator_note">' . $line[ 'note' ] . '</span>';
	}

	echo '</td>';
	echo '</tr>';
}

?>

</table>

<?php

echo form_hidden('SaveLang', 'Save' );

echo generateSubmitButton('Save Changes', $base_url.'img/icons/save_16.png').'<br /></p>';


echo form_close();
	
?>