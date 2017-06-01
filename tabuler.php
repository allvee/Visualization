<?php

// ************************************************************************
// Program:   test.php
// Version:   0.5.1
// Date:      17/04/2003
// Author:    michael kamleitner (mika@ssw.co.at)
// WWW:	      http://www.entropy.at/forum.php?action=thread&t_id=15 
//            (suggestions, bug-reports & general shouts are welcome)
// Desc:      this test-script lists all audio-files (.wav, .aif, .mp3, .ogg)
//            which reside in the ./ directory. If a file is selected,
//            it is loaded and its audio-attributes are displayed.
// Copyright: copyright 2003 michael kamleitner
//
//            This file is part of classAudioFile.
//
//            classAudioFile is free software; you can redistribute it and/or modify
//            it under the terms of the GNU General Public License as published by
//            the Free Software Foundation; either version 2 of the License, or
//            (at your option) any later version.
//
//            classAudioFile is distributed in the hope that it will be useful,
//            but WITHOUT ANY WARRANTY; without even the implied warranty of
//            MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//            GNU General Public License for more details.
//
//            You should have received a copy of the GNU General Public License
//            along with classAudioFile; if not, write to the Free Software
//            Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
//
// ************************************************************************
	
	require ('classAudioFile.php');
$file=isset($_REQUEST['filename']);
	print "<html><head>";	
	print "<link rel=\"stylesheet\" type=\"text/css\" href=\"./global.css\">";
   	print "<META HTTP-EQUIV=\"Pragma\" CONTENT=\"no-cache\">";
	print "<META HTTP-EQUIV=\"Expires\" CONTENT=\"-1\">";
	print "</head><body>";

	print "<table border=1>";
	print "<tr><td valign=top>";


	$handle=opendir('./');
	while (false !== ($file = readdir($handle))) 
	{ 
    		if ($file <> "." && $file <> "..")
    		{
	    		if ( (substr(strtoupper($file),strlen($file)-4,4)==".WAV") ||
	    		     (substr(strtoupper($file),strlen($file)-4,4)==".AIF") ||
	    		     (substr(strtoupper($file),strlen($file)-4,4)==".OGG") ||
	    		     (substr(strtoupper($file),strlen($file)-4,4)==".MP3") )
	    		{
	    		     	print "<a href=\"./tabuler.php?filename=$file\">$file</a><br>";
	    		} else {
	    		}
	    	}
	}
	
	print "</td><td valign=top>";

	if ($_REQUEST['filename'] <> "")
	{	
		$AF = new AudioFile;
		$AF->loadFile($_REQUEST['filename']);
		$AF->printSampleInfo();
		if ($AF->wave_id == "RIFF")
		{
			$AF->visual_width=600;
			$AF->visual_height=500;
			$AF->getVisualization(substr($_REQUEST['filename'],0,strlen($_REQUEST['filename'])-4).".png");
			print "</td><td><img src=./".substr($_REQUEST['filename'],0,strlen($_REQUEST['filename'])-4).".png>";
		}
	}
	print "</td></tr></table></body></html>";
?>