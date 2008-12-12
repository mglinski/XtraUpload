<?php

echo form_open('admin/translator', '', $hidden );

?>

<table>

<?php

echo '<tr>';
echo '<td class="translator_table_header">' . 'Key' . '</td>';
echo '<td class="translator_table_header"><b>' . ucwords( $masterLang ) . '</td>';
echo '<td class="translator_table_header">' . ucwords( $slaveLang ) . '</td>';
echo '</tr>';

foreach ( $moduleData as $key => $line ) {
	echo '<tr>';
	echo '<td>' . $key . '</td>';
	echo '<td>' . htmlspecialchars( $line['master'] ) . '</td>';
	echo '<td>' . htmlspecialchars( $line['slave'] ) . '</td>';
	echo '</tr>';
}

?>

</table>

<?php

echo form_hidden('ConfirmSaveLang', 'Confirm' );

echo generateSubmitButton('Confirm Changes', $base_url.'img/icons/ok_16.png', 'green').'<br /></p>';


echo form_close();
	
?>