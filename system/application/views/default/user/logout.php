<h2><img alt="" class="nb" src="<?=base_url().'img/icons/log_out_32.png'?>" /><?php echo $this->lang->line('user_logout_header')?></h2>

<p><?php echo $this->lang->line('user_logout_1')?></p>
<script type="text/javascript">
function r()
{
	location = '<?=site_url('home');?>';
}
setTimeout('r()',1000);
</script>