<?php
/*
XtraUpload - File Hosting Software
Copyright (C) 2006-2007  Matthew Glinski and XtraFile.com
Link: http://www.xtrafile.com
-----------------------------------------------------------------
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program(LICENSE.txt); if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/include("./init.php");


if($_GET['edit'])
{
	if($_POST['submit'] == 'Submit Changes')
	{
			$db->query("UPDATE users SET
			username = '".addslashes($_POST['username'])."',
			`password` = '".md5($_POST['spassword'])."',
			`first_name` = '".addslashes($_POST['sfirst_name'])."',
			`last_name` = '".addslashes($_POST['slast_name'])."',
			`street` = '".addslashes($_POST['sstreet'])."',
			`city` = '".addslashes($_POST['scity'])."',
			`state` = '".addslashes($_POST['sstate'])."',
			`zip` = '".addslashes($_POST['szip'])."',
			`country` = '".addslashes($_POST['scountry'])."',
			`email` = '".addslashes($_POST['semail'])."',
			`telephone` = '".addslashes($_POST['stelephone'])."',
			`group` = '".addslashes($_POST['group'])."'
			WHERE uid='".addslashes($_GET['user'])."'");
			echo "<center><font color='#009900' size='5'> <b>Account Settings Changed</b></font></center><br /><br />";
			log_action('User Edited', 'user:edit', 'User('.$_POST['username'].') Was updated.', 'ok', 'admin/user.php');
	}

	$c = $db->query("select * from users where uid='".intval($_GET['user'])."' LIMIT 1");
	$d = $db->fetch($c,'obj');
	$cusername = $d->username;
	$cpassword = $d->password;
	$cfirst_name = $d->first_name;
	$clast_name = $d->last_name;
	$cstreet = $d->street;
	$ccity = $d->city;
	$czip = $d->zip;
	$cstate = $d->state;
	$ccountry = $d->country;
	$cemail = $d->email;
	$ctelephone = $d->telephone;
	$clast_paid = $d->last_paid;
	$csignup_date = $d->signup_date; 
	$cgroup = $d->group;
	
	?>
<style type="text/css">
<!--
.style1 {font-weight: bold}
.style2 {color: #009900}
-->
</style>

<div align="center" class="style2"><a href="user.php"><strong>Return to Hours List </strong></a><br />
  <br />
</div>
<form method='post'>
		
<table height="21%" align="center">
  <tr align=center>
	  <td height="6%" colspan=2 class="style1">Edit the Happy Hours settings and click the submit button below to save your changes.</td>
  </tr>
  <tr>
    <td width="237" height="24" align=right class="style1">Hour Name:</td>
    <td width="386" class="style1"><input name="username" value="<?=$hname?>" type="text" /></td>
  </tr>
  <tr>
    <td height="24" align=right class="style1">Times Active: </td>
    <td class="style1">from:
      
       <select name="select">
<option value="0" selected="selected">0</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
              </select>
       Hour, 
	   <select name="select3">
         <option value="0" selected="selected">0</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
		<option value="32">32</option>
		<option value="33">33</option>
		<option value="34">34</option>
		<option value="35">35</option>
		<option value="36">36</option>
		<option value="37">37</option>
		<option value="38">38</option>
		<option value="39">39</option>
		<option value="40">40</option>
		<option value="41">41</option>
		<option value="42">42</option>
		<option value="43">43</option>
		<option value="44">44</option>
		<option value="45">45</option>
		<option value="46">46</option>
		<option value="47">47</option>
		<option value="48">48</option>
		<option value="49">49</option>
		<option value="50">50</option>
		<option value="51">51</option>
		<option value="52">52</option>
		<option value="53">53</option>
		<option value="54">54</option>
		<option value="55">55</option>
		<option value="56">56</option>
		<option value="57">57</option>
		<option value="58">58</option>
		<option value="59">59</option>
              </select>
       Second<br />
      to:      
      <select name="select2">
         <option value="1" selected="selected">1</option>
         <option value="2">2</option>
         <option value="3">3</option>
         <option value="4">4</option>
         <option value="5">5</option>
         <option value="6">6</option>
         <option value="7">7</option>
         <option value="8">8</option>
         <option value="9">9</option>
         <option value="10">10</option>
         <option value="11">11</option>
         <option value="12">12</option>
         <option value="13">13</option>
         <option value="14">14</option>
         <option value="15">15</option>
         <option value="16">16</option>
         <option value="17">17</option>
         <option value="18">18</option>
         <option value="19">19</option>
         <option value="20">20</option>
         <option value="21">21</option>
         <option value="22">22</option>
         <option value="23">23</option>
              </select>
Hour,
<select name="select3">
<option value="0" selected="selected">0</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
		<option value="32">32</option>
		<option value="33">33</option>
		<option value="34">34</option>
		<option value="35">35</option>
		<option value="36">36</option>
		<option value="37">37</option>
		<option value="38">38</option>
		<option value="39">39</option>
		<option value="40">40</option>
		<option value="41">41</option>
		<option value="42">42</option>
		<option value="43">43</option>
		<option value="44">44</option>
		<option value="45">45</option>
		<option value="46">46</option>
		<option value="47">47</option>
		<option value="48">48</option>
		<option value="49">49</option>
		<option value="50">50</option>
		<option value="51">51</option>
		<option value="52">52</option>
		<option value="53">53</option>
		<option value="54">54</option>
		<option value="55">55</option>
		<option value="56">56</option>
		<option value="57">57</option>
		<option value="58">58</option>
		<option value="59">59</option>
</select>
Second</td>
  </tr>
  <tr>
    <td height="24" align="right" class="style1">Days Active:</td>
    <td class="style1">from:
      <select name="day_from">
        <option value="1" selected="selected">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
      </select>      
      &nbsp;<a href="javascript:;" onclick="$('#day_from').datePicker();"><img border="0" src="../images/actions/Calendar_16x16.png" /></a> <br />
      to:
      <select name="day_to">
        <option value="1" selected="selected">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
      </select>      &nbsp;<a href="javascript:;" onclick="$('#day_from').datePicker();"><img border="0" src="../images/actions/Calendar_16x16.png" /></a> </td>
  </tr>
  <tr>
    <td height="24" align="right" class="style1">Months Active:</td>
    <td class="style1">from:
      <select name="month_from">
        <option value="1" selected="selected">January</option>
        <option value="2">February</option>
        <option value="3">March</option>
        <option value="4">April</option>
        <option value="5">May</option>
        <option value="6">June</option>
        <option value="7">July</option>
        <option value="8">August</option>
        <option value="9">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
            </select>      &nbsp;<a href="javascript:;" onclick="$('#day_from').datePicker();"><img border="0" src="../images/actions/Calendar_16x16.png" /></a> <br />
      to:
      <select name="month_to">
        <option value="1" selected="selected">January</option>
        <option value="2">February</option>
        <option value="3">March</option>
        <option value="4">April</option>
        <option value="5">May</option>
        <option value="6">June</option>
        <option value="7">July</option>
        <option value="8">August</option>
        <option value="9">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
            </select>      &nbsp;<a href="javascript:;" onclick="$('#day_from').datePicker();"><img border="0" src="../images/actions/Calendar_16x16.png" /></a> </td>
  </tr>
  <tr>
    <td height="24" align="right" class="style1">Years Active:</td>
    <td class="style1"><p>from:
      <select name="year_from">
        <option value="2006" selected="selected">2006</option>
		<option value="2007">2007</option>
		<option value="2008">2008</option>
		<option value="2009">2009</option>
		<option value="2010">2010</option>
		<option value="2011">2011</option>
		<option value="2012">2012</option>
		<option value="2013">2013</option>
		<option value="2014">2014</option>
		<option value="2015">2015</option>
		<option value="2016">2016</option>
		<option value="2017">2017</option>
		<option value="2018">2018</option>
		<option value="2019">2019</option>
		<option value="2020">2020</option>
            </select>      
      &nbsp;<a href="javascript:;" onclick="$('#day_from').datePicker();"><img border="0" src="../images/actions/Calendar_16x16.png" /></a> <br />
      to:
      <select name="year_to">
        <option value="2006" selected="selected">2006</option>
		<option value="2007">2007</option>
		<option value="2008">2008</option>
		<option value="2009">2009</option>
		<option value="2010">2010</option>
		<option value="2011">2011</option>
		<option value="2012">2012</option>
		<option value="2013">2013</option>
		<option value="2014">2014</option>
		<option value="2015">2015</option>
		<option value="2016">2016</option>
		<option value="2017">2017</option>
		<option value="2018">2018</option>
		<option value="2019">2019</option>
		<option value="2020">2020</option>
            </select>      
      &nbsp;<a href="javascript:;" onclick="$('#day_from').datePicker();"><img border="0" src="../images/actions/Calendar_16x16.png" /></a></p>      </td>
  </tr>
  <tr>
    <td height="24" align="right" class="style1">Function:</td>
    <td class="style1"><p>
      <textarea name="textarea" cols="50" rows="5"></textarea>
    </p>      </td>
  </tr>
  <tr>
    <td height="24" align=right class="style1">User Group: </td>
    <td class="style1">
	<select name="group">
	<? $ff = $db->query("SELECT * FROM groups WHERE id != '1'");
	while($gr = $db->fetch($ff,'obj'))
	{
	?>
	  <option value="<?=$gr->id?>" <? if($gr->id == $cgroup){?>selected="selected"<? }?> ><?=$gr->name?></option>
	<? }?>
    </select>    </td>
  </tr>
  <tr>
    <td height="21"> </td><td class="style1">&nbsp;</td>
  </tr>
  </table>
<div align="center"><span class="style1">
  <input name=submit type=submit class="style1" value='Submit Changes' />
  </span></div>
</form><?
}
else
{

	$step = $_REQUEST['step'];
	$uid = $_REQUEST['uid'];

	if (!$step){$step = 1;}
	switch($step){
		case "4":// delete users
			$db->query("DELETE FROM users WHERE uid=$uid");
			log_action('User Deleted', 'user:delete', 'A User Was Deleted', 'ok', 'admin/user.php');
		break;
		
		
		default:// user index
		
		break;
	}
?>
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
.style3 {font-size: 18px}
-->
</style>
<center><? @include("menu.php");?></center>
<div align="center" class="style1">Happy Hours  Management<br />
</div>
<div align="center">
<a href="javascript:;" onclick="$('#a1').show('slow');$('#h_1').hide('slow');">Manage Current Happy Hour</a> | 
<a href="javascript:;" onclick="$('#a1').hide('slow');$('#h_1').show('slow');">Add new Happy Hour</a> </div>
<p>&nbsp;</p>
<div id='h_1' style="display:none">
<form action="" method="post">
<table height="21%" align="center">
  <tr align=center>
	  <td height="6%" colspan=2 class="style1">Add New HappyHour </td>
  </tr>
  <tr>
    <td width="237" height="24" align=right class="style1">Name:</td>
    <td width="386" class="style1"><input name="username" type="text" /></td>
  </tr>
  <tr>
    <td height="24" align=right class="style1">Times Active: </td>
    <td class="style1">from:
      
       <select name="select">
<option value="0" selected="selected">0</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
        </select>
       :
       <select name="select3">
         <option value="0" selected="selected">0</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
		<option value="32">32</option>
		<option value="33">33</option>
		<option value="34">34</option>
		<option value="35">35</option>
		<option value="36">36</option>
		<option value="37">37</option>
		<option value="38">38</option>
		<option value="39">39</option>
		<option value="40">40</option>
		<option value="41">41</option>
		<option value="42">42</option>
		<option value="43">43</option>
		<option value="44">44</option>
		<option value="45">45</option>
		<option value="46">46</option>
		<option value="47">47</option>
		<option value="48">48</option>
		<option value="49">49</option>
		<option value="50">50</option>
		<option value="51">51</option>
		<option value="52">52</option>
		<option value="53">53</option>
		<option value="54">54</option>
		<option value="55">55</option>
		<option value="56">56</option>
		<option value="57">57</option>
		<option value="58">58</option>
		<option value="59">59</option>
        </select>
       <br />
      to:      
      <select name="select2">
         <option value="1" selected="selected">1</option>
         <option value="2">2</option>
         <option value="3">3</option>
         <option value="4">4</option>
         <option value="5">5</option>
         <option value="6">6</option>
         <option value="7">7</option>
         <option value="8">8</option>
         <option value="9">9</option>
         <option value="10">10</option>
         <option value="11">11</option>
         <option value="12">12</option>
         <option value="13">13</option>
         <option value="14">14</option>
         <option value="15">15</option>
         <option value="16">16</option>
         <option value="17">17</option>
         <option value="18">18</option>
         <option value="19">19</option>
         <option value="20">20</option>
         <option value="21">21</option>
         <option value="22">22</option>
         <option value="23">23</option>
        </select>
      :
      <select name="select3">
<option value="0" selected="selected">0</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
		<option value="32">32</option>
		<option value="33">33</option>
		<option value="34">34</option>
		<option value="35">35</option>
		<option value="36">36</option>
		<option value="37">37</option>
		<option value="38">38</option>
		<option value="39">39</option>
		<option value="40">40</option>
		<option value="41">41</option>
		<option value="42">42</option>
		<option value="43">43</option>
		<option value="44">44</option>
		<option value="45">45</option>
		<option value="46">46</option>
		<option value="47">47</option>
		<option value="48">48</option>
		<option value="49">49</option>
		<option value="50">50</option>
		<option value="51">51</option>
		<option value="52">52</option>
		<option value="53">53</option>
		<option value="54">54</option>
		<option value="55">55</option>
		<option value="56">56</option>
		<option value="57">57</option>
		<option value="58">58</option>
		<option value="59">59</option>
</select></td>
  </tr>
  <tr>
    <td height="24" align="right" class="style1">Days Active:</td>
    <td class="style1">from:
      <select name="day_from">
        <option value="1" selected="selected">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
      </select>      
      &nbsp;<a href="javascript:;" onclick="$('#day_from').datePicker();"></a> <br />
      to:
      <select name="day_to">
        <option value="1" selected="selected">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
      </select>      &nbsp;<a href="javascript:;" onclick="$('#day_from').datePicker();"></a> </td>
  </tr>
  <tr>
    <td height="24" align="right" class="style1">Months Active:</td>
    <td class="style1">from:
      <select name="month_from">
        <option value="1" selected="selected">January</option>
        <option value="2">February</option>
        <option value="3">March</option>
        <option value="4">April</option>
        <option value="5">May</option>
        <option value="6">June</option>
        <option value="7">July</option>
        <option value="8">August</option>
        <option value="9">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
        </select>      &nbsp;<a href="javascript:;" onclick="$('#day_from').datePicker();"></a> <br />
      to:
      <select name="month_to">
        <option value="1" selected="selected">January</option>
        <option value="2">February</option>
        <option value="3">March</option>
        <option value="4">April</option>
        <option value="5">May</option>
        <option value="6">June</option>
        <option value="7">July</option>
        <option value="8">August</option>
        <option value="9">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
        </select>      &nbsp;<a href="javascript:;" onclick="$('#day_from').datePicker();"></a> </td>
  </tr>
  <tr>
    <td height="24" align="right" class="style1">Years Active:</td>
    <td class="style1"><p>from:
      <select name="year_from">
        <option value="2006" selected="selected">2006</option>
		<option value="2007">2007</option>
		<option value="2008">2008</option>
		<option value="2009">2009</option>
		<option value="2010">2010</option>
		<option value="2011">2011</option>
		<option value="2012">2012</option>
		<option value="2013">2013</option>
		<option value="2014">2014</option>
		<option value="2015">2015</option>
		<option value="2016">2016</option>
		<option value="2017">2017</option>
		<option value="2018">2018</option>
		<option value="2019">2019</option>
		<option value="2020">2020</option>
          </select>      
      &nbsp;<a href="javascript:;" onclick="$('#day_from').datePicker();"></a> <br />
      to:
      <select name="year_to">
        <option value="2006" selected="selected">2006</option>
		<option value="2007">2007</option>
		<option value="2008">2008</option>
		<option value="2009">2009</option>
		<option value="2010">2010</option>
		<option value="2011">2011</option>
		<option value="2012">2012</option>
		<option value="2013">2013</option>
		<option value="2014">2014</option>
		<option value="2015">2015</option>
		<option value="2016">2016</option>
		<option value="2017">2017</option>
		<option value="2018">2018</option>
		<option value="2019">2019</option>
		<option value="2020">2020</option>
          </select>      
      &nbsp;<a href="javascript:;" onclick="$('#day_from').datePicker();"></a></p>      </td>
  </tr>
  <tr>
    <td height="24" align="right" class="style1">Function:</td>
    <td class="style1"><p>
      <textarea name="textarea" cols="50" rows="5"></textarea>
    </p>      </td>
  </tr>
  <tr>
    <td height="21"> </td><td class="style1">&nbsp;</td>
  </tr>
  </table>
  <div align="center"><input type="submit" name="submit" value="Add Happyhour" /></div>
  </form>
</div>
<TABLE width='803' border='1' align="center" cellPadding='6' cellSpacing='0' bordercolor="#000000" id="a1" STYLE="display:">
<tr>
	<th width="23%" align=center class='a1'><strong>Name</font></strong></td>
	<th width="36%" align=center class='a1'>Time Start 
	<th width="23%" align=center class='a1'>Time End
	<th width="18%" align=center class='a1'><strong>Action</font></strong></td>
</tr>
<?
	$sql = "SELECT * FROM users";
	$result = mysql_query($sql) or die( mysql_error() );
	if ($result){
		while( $row = mysql_fetch_object($result) ){
		
		if($row->isadmin == "1"){
		$a1 = "0";
		$isadmin = "Is Admin";
		}else{
		$a1 = "1";
		$isadmin = "Is not Admin";
		}
		
		if($row->status == "1"){
		$a2 =  "0";
		$status = "Deactivate";
		}else{
		$a2 = "1";
		$status = "Activate";
		
		}
?>
			<tr>
				<TD height="25" class='a1'>
			    <div align="center"><?=$row->username?></div></td>
				<TD class='a1'><div align="center">
				  <div align="center">
				    <? if(empty($row->email)){echo 'None Registered With Account';}else{echo $row->email;}?>
			      </div>
				</div></td>
				<TD class='a1'><div align="center"><? $fet = $db->fetch($db->query("SELECT * FROM groups WHERE id='".$row->group."'"),'obj'); echo $fet->name;?></div></td>
				<TD class='a1'>
				  <div align="center"><table border="0"><tr><td width="50">
				    <div align="center"><a href="<?=$PHP_SELF?>?edit=1&user=<?=$row->uid?>"><img src="../images/actions/User (Edit)_32x32.png" border="0" /></a> </div></td>
				  <td width="50"> <div align="center"><a onclick="return confirm('Are you sure you wish to delete this admin?');" href="<?=$PHP_SELF?>?step=4&uid=<?=$row->uid?>"> <img src="../images/actions/User (Remove)_32x32.png" border="0" /></a> </div></td>
				  </tr></table>			  </div>				</td>
			</tr>
<?
		}
	}
?>
</table>
<?
}
require_once("./admin/footer.php");
?>