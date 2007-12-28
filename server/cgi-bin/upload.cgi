#!/usr/bin/perl -W
#**********************************************************************************************************************************
#
#   ATTENTION: THIS FILE HEADER MUST REMAIN INTACT. DO NOT DELETE OR MODIFY THIS FILE HEADER.
#
#   Name: upload.cgi
#   Link: http://uber-uploader.sourceforge.net/
#   Revision: 3.7.1
#   Date: 2006/10/07
#   Author: Peter Schmandra  www.webdice.org
#   Description: Upload files to a temp dir based on Session-id, transfer files to upload dir and output results or redirect.
#
#**********************************************************************************************************************************
# 
# 	Modified for use in XtraUpload.
# 	By: Matthew Glinski
#
#**********************************************************************************************************************************
#
#   Credits:
#   I would like to thank the following people who helped create 
#   and improve Uber-Uploader by providing code, ideas, insperation, 
#   bug fixes and valuable feedback. If you feel you should be included 
#   in this list, please post a message in the 'Open Discussion' 
#   forum of the Uber-Uploader project page requesting a contributor credit.
#
#   Art Bogdanov             www.sibsoft.net/xupload.html
#   Bill                     www.rebootconcepts.com
#   Detlev Richter
#   Erik Guilfoyle
#   Feyyaz Oezdemir
#   Jeroen Soeters
#   Kim Steinhaug
#   Nico Hawley-Weld
#   Raditha Dissanyake       www.raditha.com/megaupload/
#   Tolriq
#   Tore B. Krudtaa
#
#   Licence:
#   The contents of this file are subject to the Mozilla Public
#   License Version 1.1 (the "License"); you may not use this file
#   except in compliance with the License. You may obtain a copy of
#   the License at http://www.mozilla.org/MPL/
# 
#   Software distributed under the License is distributed on an "AS
#   IS" basis, WITHOUT WARRANTY OF ANY KIND, either express or
#   implied. See the License for the specific language governing
#   rights and limitations under the License.
#
#**********************************************************************************************************************************

use CGI qw(:cgi);
use CGI::Carp qw/fatalsToBrowser/;

my($get_1_key, $get_1_val) = split(/[&=]/, $ENV{'QUERY_STRING'});

my $tmp_sid = $get_1_val;
$tmp_sid =~ s/[^a-zA-Z0-9]//g;
my $print_issued = 0; 
my $temp_dir_sid = "../temp/" . $tmp_sid;
my $tmp_filename = $temp_dir_sid . "/upload_postdata";	
my $flength_file = $temp_dir_sid . '/flength.size';
umask(0);
$|++;                                                                               
$SIG{HUP} = 'IGNORE';

# Create a temp directory based on Session-id     
if(!-d $temp_dir_sid)
{ 
	mkdir($temp_dir_sid, 0777) or &kak("<font color='red'>ERROR</font>: Can't mkdir $temp_dir_sid: $!", 1, __LINE__); 
}

# Prepare the flength file for writing
open FLENGTH, ">$flength_file" or &kak("<font color='red'>ERROR</font>: Can't open $temp_dir_sid/flength: $!", 1, __LINE__);

# Write total upload size in bytes to flength file
print FLENGTH $ENV{'CONTENT_LENGTH'};
close(FLENGTH);
chmod 0666, $flength_file;
 

# Tell CGI.pm to use our directory based on Session-id
if($TempFile::TMPDIRECTORY)
{ 
	$TempFile::TMPDIRECTORY = $temp_dir_sid; 
}
elsif($CGITempFile::TMPDIRECTORY)
{ 
	$CGITempFile::TMPDIRECTORY = $temp_dir_sid; 
}

my $query = new CGI;

###################################################################################################################
# The upload is complete at this point, so you can now access any post value by $query->param("some_post_value");
###################################################################################################################

my $file_name = $query->param('attached');
my $server = "server=".$query->param('server');
my $description = "description=".$query->param('description');
my $password = "password=".$query->param('password');
my $featured = "featured=".$query->param('featured');
my $email = "email=".$query->param('email');

$file_name =~ s/.*[\/\\](.*)/$1/;

my $fh = $query->upload('attached');
open tmp_fh,">$tmp_filename" or &kak ("can't open temp file(".$tmp_filename."): $!", 1, __LINE__);  
	binmode tmp_fh;

	while(<$fh>) 
	{
	   	print tmp_fh $_;
	}

	close($tmp_fh);
chmod 0777, $tmp_filename;

$urlstring = "&filename=$file_name&";
$urlstring .= "$server&";            
$urlstring .= "sid=$get_1_val&";
$urlstring .= "$description&";
$urlstring .= "$password&";
$urlstring .= "$featured&";
$urlstring .= "$email";


my $url_go = "../index.php?p=upload&bar=yes" . $urlstring;
print "Location: $url_go\n\n";
exit;


######################################################### START SUBROUTINES ###################################################

########################################################################
# Output a message to the screen 
#
# You can use this function to debug your script. 
#
# eg. &kak("The value of blarg is: " . $blarg . "<br>", 1, __LINE__);
# This will print the value of blarg and exit the script.
#
# eg. &kak("The value of blarg is: " . $blarg . "<br>", 0, __LINE__);
# This will print the value of blarg and continue the script.
########################################################################
sub kak
{
	my $msg = shift;
	my $kak_exit = shift;
	my $line  = shift;
	
	if(!$print_issued)
	{
		print "Content-type: text/html\n\n";
		$print_issued = 1; 
	}
	
	print "<!DOCTYPE HTML PUBLIC \"-\/\/W3C\/\/DTD HTML 4.01 Transitional\/\/EN\">\n";
	print "<html>\n";
	print "  <head>\n";
	print "    <title>UBER UPLOADER<\/title>\n";
	print "      <META NAME=\"ROBOTS\" CONTENT=\"NOINDEX\">\n"; 
	print "      <meta http-equiv=\"Pragma\" content=\"no-cache\">\n";
	print "      <meta http-equiv=\"CACHE-CONTROL\" content=\"no-cache\">\n";
	print "      <meta http-equiv=\"expires\" content=\"-1\">\n";
	print "  <\/head>\n";
	print "  <body style=\"background-color: #EEEEEE; color: #000000; font-family: arial, helvetica, sans_serif;\">\n";
	print "    <br>\n";
	print "    <div align='center'>\n";
	print "    $msg\n";
	print "    <br>\n";
	print "    <!-- uber_uploader.pl:kak on line $line -->\n";
	print "    </div>\n";
	print "  </body>\n";
	print "</html>\n";
	
	if($kak_exit){ exit; }
}

#########################################
# Delete a directory and everthing in it
#########################################
sub deldir{
	my $del_dir = shift;
	
	if(-d $del_dir)
	{
		if(opendir(DIRHANDLE, $del_dir)){
			my @file_list = readdir(DIRHANDLE);
			
			closedir(DIRHANDLE);
			
			foreach my $file (@file_list)
			{
				if($file eq "flength.size"){ unlink($del_dir . "/" . $file); }
			}
		}
		else{ warn("Cannont open $del_dir: $!"); }
	}
}