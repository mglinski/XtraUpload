<table>
<?php

echo '<tr>';
echo '<td class="translator_table_header">' . ucwords( $slaveLang ) . '</td>';
echo '<td class="translator_table_header">' . ucwords( $langModule ) . '</td>';
echo '</tr>';


?>
</table>
<p>
<?=generateLinkButton('Select Language', site_url('admin/translator'), $base_url.'img/icons/back_16.png').'<br />'?>
</p>