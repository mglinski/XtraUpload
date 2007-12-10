<?
///////////////////////////////////////////
//	XtraUpload File Hosting Software
// (c) XtraFile.com, All rights reserved
//		http://www.xtrafile.com
//#########################################
// THIS IS FREE BUT NOT OPEN SOURCE SOFTWARE
// YOU MUST HAE A VALID LICENSE TO USE THIS
// ALL FILES/IMAGES (c) Xtrafile.com UNLESS
// EXPLICITLY NOTED BY A "LICENSE" FILE
//#########################################
// api.php -> Main System Functions, in API format
// @ENCODED: no
// @AUTHOR: Matthew Glinski
/*****************************************/
// All code is copyright XtraFile.com and
// Matthew Glinski unless noted in that file
///////////////////////////////////////////
$db = '';
class xuApi
{
	var $loadError;
	var $apiError;
	var $config;
	function API($homePath,$loadVars=false)
	{
		if(@include($homepath.'include/functions.inc.php'))
		{
			if($loadVars)
			{
				$this->config = (object)array();
			}
		}
		else
		{
			$this->loadError = true;
		}
	}
	
	function loadVars()
	{
		$sql = "SELECT * FROM `config` ";
		$qr1 = $db->query($sql, "config");	
		while($a = $db->fetch($qr1))
		{
			$name = $a->name;
			$this->config->$name = $a->value;
		}
	}
	
	function defineVars()
	{
		$sql = "SELECT * FROM `config` ";
		$qr1 = $db->query($sql, "config");	
		while($a = $db->fetch($qr1))
		{
			$name = $a->name;
			define($name, $a->value);
		}
	}
	
	function users($act,$hash)
	{
		
	}
	
	function files($act,$hash)
	{
		
	}
	
	function folders($act,$hash)
	{
		
	}
	
	function orders($act,$hash)
	{
		
	}
	
	function parseUpload()
	{
		global $kernel;
		
		if(isset($_POST['file']))
		{
			include 
			$upload = $kernel->upload->set($_POST['file']);
		}
		else
		{
			$upload = $kernel->upload->set();
		}
		
		$ret = $kernel->upload->return;
		if($kernel->upload->error != '')
		{
			$this->apiError = kernel->upload->error;
			return false;
		}
		else
		{
			$kernel->server->update_bandwith($kernel->upload->file_name);
			return $kernel->upload->secid;
		}
	}
	
	function uploadProgressBarHTML()
	{
		global $lang;
	?>
	
<style type="text/css">
<!--
.border 
{
  background: url(<?=$this->config->siteurl?>images/progress-r.gif) repeat-x;
  border-left: 1px solid grey;
  border-right: 1px solid grey;
  width: 600px;
  height: 18px;
}

.p_img 
{
  background: url(<?=$this->config->siteurl?>images/p_bar_n.gif) repeat-x;
  height: 18px;
  width: 0px;
}

-->
</style>
	<table id="pbar" align="center" cellpadding="0" cellspacing="0" border="0" width="870" height="132" style="border:1px solid #000000">
  <tr>
  <tr><td><table width="870" height="132" border="0">
    <tr>
      <td width="1" height="23">&nbsp;</td>
      <td width="859" ><div align="center"><strong><?=$lang['main2']['1']?> <?=addslashes(basename($_POST['file']))?> </strong></div></td>
      </tr>
    
    <tr>
      <td height="85">&nbsp;</td>
      <td><div align="center"><br>
          <strong><?=$lang['main2']['3']?> </strong>: <span id='percent'>0</span>%</div>
        <div align="center">
        <table width="650" height="26" border="0" align="center" cellpadding="1" cellspacing="0" style="border:2px solid #000000">
        <tr>
          <td width="26" height="24"><img src="../images/actions/Import_24x24.png" width="24" height="24" /></td>
          <td width="600"><div class="border"><div class="p_img"></div></div></td>
          <td width="19"><img src="../images/actions/Event (Green)_24x24.png" width="24" height="24" /></td>
        </tr>
      </table></div>
        <div align="center"><span id='trans'><strong><br />
          0</strong></span>KB of <span id='total'><strong>0</strong></span>KB <?=$lang['main2']['6']?> (<span id='speed'><strong>0</strong></span> KBPS) <br />
          <?=$lang['main2']['7']?> <span id='remaining'><strong>00 : 00 : 00</strong></span>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <?=$lang['main2']['9']?> <span id='elapsed'><strong>00 : 00 : 00</strong></span></div></td>
      </tr>
  </table></td>
</tr></table>
  <script>
	function update(u,p,d,a,t,e)
	{
		$('#trans').html(Math.round(u/1024));
		$('#total').html(Math.round(p/1024));
		$('#remaining').html(d);
		$('#elapsed').html(a);
		$('#speed').html(t);
		$('#percent').html(e);
		$(".p_img").animate({width: (e*6)}, 200);
	}
  </script><br />
<?
	}
}
?>