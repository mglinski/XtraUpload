<{if $can_manage}>
<h2 style="font-size:24px" align="center"><{$lang.editimg.4}></h2>

<{if isset($templatelite.get.admin_password)}>
	<form action="<?=makeXuLink('index.php', array('p' => 'folders', 'act' => 'manage'))?>" method="post" onsubmit="process_files(this);if(this.fid.value == ''){alert('<{$lang.files.1}>'); return false;}">
    <input type="hidden" name="admin_password" value="<{$templatelite.get.admin_password}>" />
<{else}>
	<form action="<{$siteurl}>index.php?p=folders&login=" method="post" onsubmit="process_files(this);if(this.fid.value == ''){alert('<{$lang.files.1}>'); return false;}else{this.action += this.fid.value; return true;}">
<{/if}>

  <div style="display:none; visibility:hidden">
    <textarea style="display:none" name="new_files" id="new_files" ></textarea>
  </div>
  
  <br />
  <!--
  <input type="button" onclick="viewFilesFlow('fileManagerFlow')" value="View in kool mode!" />
  <div class="fileManagerFlow" id="fileManagerFlow"></div>
  -->
     <div id="fileManagerTable" class="table" style="width:900px;">
        <div class="tr head" style="height:20px;">
          <div class="th" style="width:340px;"><{$lang.editimg.5}></div>
          <div class="th" style="width:160px;"><{$lang.editimg.6}></div>
          <div class="th" style="width:160px;"><{$lang.editimg.9}></div>
          <div class="th" style="width:150px;float:left; font-weight:bold;">
            <input type="checkbox" onclick="switchCheckboxes()" name="checkbox" id="checkAll" value="" />
            <label for="checkAll"><{$lang.files.2}></label>
            </div>
          <div class="th" style="width: 90px;"><{$lang.editimg.7}></div>
        </div>
        <div class="hr"></div>
        <{section name=x loop=$fileArr}>
        <div class="tr<{ cycle values=" alt-odd, alt-even" }>" style="height:22px;">
          <div class="td" style="width:340px;"><a target="_blank" href='<{$fileArr[x].link}>'><{$fileArr[x].o_filename}></a> </div>
          <div class="td" style="width:160px;"><{$fileArr[x].downloads}></div>
          <div class="td" style="width:160px;"><{$fileArr[x].check_file}></div>
          <div class="td" style="width:150px;">
            <input type="checkbox" name="to_add_<{$fileArr[x].id}>" value="<{$siteurl}>index.php?p=download&hash=<{$fileArr[x].hash}>" id="files_<{$fileArr[x].id}>" />
            <label for="files_<{$fileArr[x].id}>"><{$lang.files.3}></label>
          </div>
          <div class="td" style="width:90px;"><a href='<{$fileArr[x].del}>'>
            <?=get_icon("Cancel","small")?>
            </a></div>
        </div>
        <{/section}> 
       </div>
<{if $can_create_folders}>
   <div align="right">
     Folder: <select name="fid" id="fid1">
       <{section name=x loop=$folderArr}> 
           <{if isset($templatelite.get.fid) && $templatelite.get.fid eq $folderArr[x].fid}>
                <option selected=\"selected\" value='<{$folderArr[x].id}>'><{$folderArr[x].name}></option>
           <{else}>
                <option value='<{$folderArr[x].id}>'><{$folderArr[x].name}></option>
           <{/if}> 
       <{/section}>
     </select> 
     <input type="submit" name="login" value="<{$lang.files.4}>" />
   </div>
<{/if}>
</form>
<div class="pagination" style="width:890px">
    <div class="hr" style="background:#666666; height:1px; width:890px; margin-bottom:4px;margin-top:4px;">
    </div>
    <{if $pageno >= 1  and $pageno ne 0}> 
        <a href="javascript: newPage( <{math equation="x - y" x=$pageno y=1}>, 'pagination1');" class="nextprev" title="Go to Previous Page">« Previous</a> 
    <{else}> 
        <span class="nextprev">« Previous</span>
    <{/if}>
  
    <{section name=it loop=$pageInfo}>
        <{if $pageInfo[it].type eq 'link'}> 
            <a href="javascript: newPage( <{$pageInfo[it].page}>, 'pagination1');"><{math equation="x+y" x=$pageInfo[it].page y=1}></a> 
        <{elseif $pageInfo[it].type eq 'elip'}> 
            <span>….</span> 
        <{elseif $pageInfo[it].type eq 'none'}> 
            <span class="current"><{math equation="x+y" x=$pageInfo[it].page y=1}></span> 
        <{/if}>
    <{/section}>
  
    <{if ($pageno + 1) != $pagecount and $pageno ne 0}> 
        <a href="javascript: newPage( <{math equation="x + y" x=$pageno y=1}>, 'pagination1');" class="nextprev" title="Go to Next Page">Next »</a> 
    <{else}> 
        <span class="nextprev">Next »</span> 
    <{/if}> 
    
    <form id="pagination1" method="post">
    <input type="hidden" id="pageno" value="<{$pageno}>" name="pageno" />
        <div style="float:right"># Per Page: <input size="2" type="text" name="limit" value="<{$limit}>" /><br />
            <input type="submit" value="Get Results"  />
        </div>
    </form>
</div>
<script>
// View Switcher


// Pagination
function newPage(page,id)
{
    var form1 = $('#'+id).get(0); 
    form1.pageno.value = page; 
    form1.submit();
}

// File Submitting
function process_files(form)
{
    $('#new_files').attr('value','');
    $('input',form).each(function() 
    {
        if(this.type == 'checkbox' && this.checked)
        {
            var value = $('#new_files').attr('value');
			if(value == 'undefined')
				value = '';
				
           	var new_val = this.value;
			if(new_val == 'undefined')
				new_val = '';
				
            $('#new_files').attr('value',value+new_val+"\n") ;
        }
    });
	alert($('#new_files').attr('value'));
    return false;
}
</script>
<{else}>
<h4>
  <center>
    <{$lang.editimg.9}>
  </center>
</h4>
<script> function r(){location = '<?=makeXuLink("index.php", "login")?>';} setTimeout('r()',1500);</script>
<{/if}>