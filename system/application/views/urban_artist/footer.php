		
		<!-- main ends -->	
		</div>
		
		<!-- sidebar starts -->
		<div id="sidebar">	
		
			<?php
			if(stristr($this->uri->uri_string(),'/admin'))
			{
				$this->load->view($skin.'/admin/menu');
			}
			else
			{
				$this->load->view($skin.'/menu');
			}
			?>
		
		<!-- sidebar ends -->		
		</div>
		
	<!-- content-wrap ends-->	
	</div>

	<!-- footer starts here -->	
	<div id="footer">
	
		<div id="footer-left">
			<p>
				<?php echo $this->lang->line('global_copyright')?> 2006 - <?=date('Y')?> 
				<a href="http://xtrafile.com">
					<strong>
						<?php echo $this->lang->line('global_xtrafile')?>
					</strong>
				</a> 	
				
				&nbsp;&nbsp;
				
				<?php echo $this->lang->line('global_design')?> 
				<a href="http://styleshout.com">
					styleshout
				</a>
				
				&nbsp;&nbsp;
				
				<?php echo $this->lang->line('global_valid')?> 
				<a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> | <a href="http://validator.w3.org/check/referer">XHTML</a>	
			</p>	
		</div>

		
		<div id="footer-right">
			<p class="align-right">
				<a href="javascript:;" onclick="$('#debug').toggle('fast')"><?php echo $this->lang->line('global_debug')?></a> 
				<span style="color:#FF0000; display:none" id="debug">
					<?php echo $this->lang->line('global_execution')?> <?=$this->benchmark->elapsed_time()?><br />
					<?php echo $this->lang->line('global_memory')?> <?=round(memory_get_usage() / 1024)?>KB
				</span>
			</p>
		</div>
		
	</div>

	<!-- footer ends here -->
	
<!-- wrap ends here -->
</div>
<script type="text/javascript">
$(document).ready(function()
{
	$('input, select').bind('focus', function()
	{
		$(this).animate({backgroundColor:"#FFFFCC"}, "fast");
	});
	$('input, select').bind('blur', function()
	{
		$(this).animate({backgroundColor:"#FFFFFF"}, "fast");
	});
	$("a[@rel='external']").attr('target', '_blank');
	if($.browser.opera)
	{
		$(".pasteButton").remove();
	}
});
</script>
<? $this->load->view('_protected/global_footer');?>
</body>
</html>
