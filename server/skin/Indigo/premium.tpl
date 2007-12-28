<div class="table" style="width:<{math equation="x+(180*y)+(1*y)+1" x=260 y=$colNum}>px;">
  <{section name=x loop=$accArr}>
    <div class="tr<{ cycle values=" alt-odd, alt-even" }>" style="height:22px;" >
      <div class="th" style="width:260px;" align="left">&nbsp;&nbsp;<{$accArr[x].lang}></div>
      <{section name=y loop=$retArr[x]}>
      	<div class="th" style="width:180px;"><{$retArr[x][y].val}></div>
      <{/section}>
    </div>
  <{/section}>
  
  <div class="tr" style="height:28px;">
   <div class="td" style="width:260px;font-weight:bold" align="left">&nbsp;</div>
  	<{section name=z loop=$endArr}>
       <div class="td" style="width:180px;">
         <{if $endArr[z].av}>
            <form method="post" action="<?=makeXuLink('index.php','p=join')?>">
                <input name="group" type="hidden" value="<{$endArr[z].id}>" />
                <input name="Submit" class="button signup" type="submit" id="submit" value="<{$lang.open.31}> " />
            </form>
         <{else}>
           <span class="button nosignup">&nbsp;<{$lang.open.30}>&nbsp;</span>
         <{/if}>
       </div>
    <{/section}>
  </div>
</div>