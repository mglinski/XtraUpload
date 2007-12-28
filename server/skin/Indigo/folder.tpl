<{if $can_create_folders}>	
    <{if $templatelite.GET.act eq 'create'}>
        <form method=POST action='<?=makeXuLink('index.php', 'p=addfolder')?>'>
            <b><{$lang.folder.4}></b><br>
            <p><{$lang.folder.5}><br />
            <br />
            <{$lang.folder.6}> <input type='text' size="20" name='fname'>
            <br />
            <{$lang.folder.7}> <input type="text" size="20" name="password" id="password" />
            <br />
            <{$lang.folder.41}> <input size='20' type="text" name="admin_password" id="admin_password" />
            <br />
            <input name='Create Folder' type='submit' value="<{$lang.folder.8}>" />
            </p>
        </form>
    <{elseif $templatelite.GET.act eq 'manage'}>
        <{if $fold}>
			<style type="text/css">
            <!--
            .style2 {font-weight: bold; font-size: 24px;}
            -->
            </style>
            <h3 align="center"><{$lang.folder.21}><{$folder}></h3>
            <br />
            <{$msg}>
            <div align="center">
                <form>
                    <input type="button"  onclick="$('#manage_files').css('display','block');$('#add').css('display','none');$('#admin').css('display','none');" value="<{$lang.folder.22}>" />
                    <input type="button"  onclick="$('#add').css('display','block');$('#manage_files').css('display','none');$('#admin').css('display','none');" value="<{$lang.folder.23}>" />
                    <input type="button"  onclick="$('#admin').css('display','block');$('#add').css('display','none');$('#manage_files').css('display','none');" value="<{$lang.folder.24}>" />
                    <input type="button"  onclick="if(confirm('Are You SURE you want to delete this folder?')){document.getElementById('delete').submit()}" value="<{$lang.folder.26}>" />
                </form>
                
                <form method="POST" id='delete' style="display:none">
                    <input type="hidden" name="fid" value="<{$templatelite.POST.fid}>" />
                    <input type="hidden" name="admin_password" value="<{$templatelite.POST.admin_password}>" />
                    <input type="hidden" name="del" value="<{$templatelite.POST.fid}>" />
                </form>
            </div>
            <form method="POST" id='admin'  style="display:none">
                <h3><{$lang.folder.27}></h3>
                <input type="hidden" name="fid" value="<{$templatelite.POST.fid}>" />
                <input type="hidden" name="admin_password" value="<{$templatelite.POST.admin_password}>" />
                <br />
                <{$lang.folder.28}> <input type="text" size="20" name="admin_pass" value="" />
                <br />
                <input name='submit' type='submit' value="<{$lang.folder.32}>" />
            </form>
            <form method="POST" id='add'  style="display:none">
                <h3><{$lang.folder.29}></h3>
                <{if $can_manage}> 
                    <a style="font-size:18px;font-weight:bold;" href="<{$siteurl}>index.php?p=files&fid=<{$templatelite.POST.fid}>&admin_password=<{$templatelite.POST.admin_password}>"> 
                        Add Your Files
                    </a><br /> 
                    <b>OR</b><br />
                <{/if}>
                <input type="hidden" name="fid" value="<{$templatelite.POST.fid}>" />
                <input type="hidden" name="admin_password" value="<{$templatelite.POST.admin_password}>" />
                <{$lang.folder.30}><br />
                <textarea name="new_files" cols="60" rows="10"></textarea>
                <br />
                <input name='submit' type='submit' value="<{$lang.folder.31}>" />
            </form>
            
            <form method="POST" id='manage_files' style="display:">
                <input type="hidden" name="fid" value="<{$templatelite.POST.fid}>" />
                <input type="hidden" name="admin_password" value="<{$templatelite.POST.admin_password}>" />
                <h3 align="center"><{$lang.folder.33}></h3>
                <div id="fileManagerTable" class="table" style="width:900px;">
                
                    <div class="tr head" style="height:20px;">
                        <div class="th" style="width:72px;">
                            <input type="checkbox" onclick="switchCheckboxes()"  id="checkAll" name="checkbox" value="checkbox"/>
                            <label for="checkAll"><{$lang.folder.34}></label>
                        </div>
                    	<div class="th" style="width:549px;"><{$lang.folder.35}></div>
                    </div>
                    
                    <div class="hr"></div>
                    <{section name=x loop=$fileArr}>
                        <div class="tr<{ cycle values=" alt-odd, alt-even" }>" style="height:22px;">
                            <div class="td" style="width:72px;">
                                <input type='checkbox' id='files_<{$fileArr[x].file}>' name='files[]' value='<{$fileArr[x].file}>'>
                                <label for="files_<{$fileArr[x].file}>"><{$lang.folder.34}></label>
                            </div>
                            <div class="td" style="width:549px;"><a href='<{$fileArr[x].link}>'><b><{$fileArr[x].name}></b><a> </div>
                        </div>
                    <{/section}> 
                    
                </div>
                <div class="hr" style="background:#666666; height:1px; width:890px; margin-bottom:4px;margin-top:4px;"></div>
                <div class="pagination" style="width:890px">
                
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
            <input type='submit' name='submit' value='<{$lang.folder.36}>'>
            </form>
			<script>
            // Pagination
            function newPage(page,id)
            {
                var form1 = $('#'+id).get(0); 
                form1.pageno.value = page; 
                form1.submit();
            }
            </script>
        <{else}>
            <h1><{$lang.folder.37}></h1>
            <br />
        <{/if}>
    <{else}>
        <{if isset($templatelite.GET.login) and isset($templatelite.GET.del)}>
            <form method=POST action='<?=makeXuLink('index.php', array('p' => 'folders','act' => 'manage'))?>'>
            <p style="font-size:18px; font-weight:bold"><{$lang.folder.38}></p>
            <p><{$lang.folder.39}></p><br />
            <p><{$lang.folder.40'].$templatelite.GET.login}>
            <input type='hidden' name='fid' value="<{$templatelite.GET.login}>" />
            <br />
            <{$lang.folder.41}>
            <input type="text" name="admin_password" size='20' id="admin_password" <{if isset($templatelite.GET.admin_password)}>value="<{$templatelite.GET.admin_password}>"<{/if}> />
            <input type="hidden" name="del" id="del" value="<{$templatelite.GET.del}>" /> 
            <br />
            <input name='login' type='submit' value="<{$lang.folder.42}>" />
            </form>	
        <{elseif isset($templatelite.GET.login) and isset($templatelite.POST.files)}>
            <form method=POST action='<?=makeXuLink('index.php', array('p' => 'folders','act' => 'manage'))?>'>
            <p style="font-size:18px; font-weight:bold"><{$lang.folder.43}></p>
            <p><{$lang.folder.46}></p>
            <br />
            <p><{$lang.folder.40'].$templatelite.GET.login}>
            <input type='hidden' name='fid' value="<{$templatelite.GET.login}>" />
            {section name=item loop=$templatelite.POST.files}
            <input type='hidden' name='files[]' value=" <{$templatelite.POST.files[item]}>" />
            {/section}
            <br />
            <{$lang.folder.41}> 
            <input type="text" name="admin_password" size='20' id="admin_password" <{if isset($templatelite.GET.admin_password)}>value="<{$templatelite.GET.admin_password}>"<{/if}> /> 
            <br />
            <input name='login' type='submit' value="<{$lang.folder.47}>" />
            </form>	
        <{elseif isset($templatelite.GET.login)}>
            <form method=POST action='<?=makeXuLink('index.php', array('p' => 'folders','act' => 'manage'))?>'>
            <p style="font-size:18px; font-weight:bold">
            <{$lang.folder.45}></p>
            <p><{$lang.folder.46}></p>
            <br />
            <p><{$lang.folder.40'].$templatelite.GET.login}>
            <input type='hidden' name='fid' value="<{$templatelite.GET.login}>" />
            <br />
            <{$lang.folder.41}> 
            <input type="text" size='20' name="admin_password" id="admin_password" 
            <{if isset($templatelite.GET.admin_password)}>
            	value="<{$templatelite.GET.admin_password}>"
            <{/if}> /> 
            <br />
            <input name='login' type='submit' value="<{$lang.folder.48}>" />
            </form>	
        <{elseif isset($templatelite.GET.user)}>
            <form method=POST action='<?=makeXuLink('index.php', array('p' => 'folders','act' => 'manage'))?>'>
            <p style="font-size:18px; font-weight:bold">
            <{$lang.folder.45}></p>
            <p><{$lang.folder.46}></p>
            <br />
            <p><{$lang.folder.40}>
            <input type='text' size='20' name='fid' />
            <br />
            <{$lang.folder.41}> <input type="text" size='20' name="admin_password" id="admin_password" 
            <{if isset($templatelite.GET.admin_password)}>
                value="<{$templatelite.GET.admin_password}>"
            <{/if}> /> <br />
            <input name='login' type='submit' value="<{$lang.folder.48}>" />
            </form>
        <{else}>
            <form method=POST action='<?=makeXuLink('index.php', array('p' => 'folders','act' => 'manage'))?>'>
            <p style="font-size:18px; font-weight:bold"><{$lang.folder.45}></p>
            <p><{$lang.folder.49}></p>
            <br />
            <p><{$lang.folder.40}>
            <input type='text' size='20' name='fid' />
            <br />
            <{$lang.folder.41}> 
            <input type="text" size='20' name="admin_password" id="admin_password" <{if isset($templatelite.GET.admin_password)}>value="<{$templatelite.GET.admin_password}>"<{/if}> /> <br />
            <input name='Create Folder' type='submit' value="<{$lang.folder.48}>" />
            </form>
            <hr />
            <br />
            <form method=POST action='<?=makeXuLink('index.php', array('p' => 'addfolder'))?>'>
            <h3><{$lang.folder.4}></h3>
            <br>
            <p><{$lang.folder.5}><br />
            <br />
            <{$lang.folder.6}>
            <input size='20' type='text' name='fname'>
            <br />
            <{$lang.folder.7}>
            <input size='20' type="text" name="password" id="password" />
            <br />
            <{$lang.folder.41}>
            <input size='20' type="text" name="admin_password" id="admin_password" />
            <br />
            <input type='submit' value="<{$lang.folder.8}>" />
            </p>
            </form>
        <{/if}>
    <{/if}>
<{else}>
    <h3>
        <center>
      	  <{$lang.folder.9}>
        </center>
    </h3>
<{/if}>