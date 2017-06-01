<?php

require ('classAudioFile.php');

$filelist=array();
$count=0;
$handle=opendir('../../../graphtest/');
while (false !== ($file = readdir($handle)))
{
	if ($file <> "." && $file <> "..")
	{
		if ( (substr(strtoupper($file),strlen($file)-4,4)==".WAV") ||
			(substr(strtoupper($file),strlen($file)-4,4)==".AIF") ||
			(substr(strtoupper($file),strlen($file)-4,4)==".OGG") ||
			(substr(strtoupper($file),strlen($file)-4,4)==".MP3") )
		{
			//print "<a href=\"./graphplotter.php?filename=$file\">$file</a><br>";
			array_push($filelist,'../../../graphtest/'.$file);
			$count++;
		} else {
		}
	}
}

//echo "<pre>";
//print_r($filelist);
for($i=0;$i<$count;$i++){
	$AF = new AudioFile;
	$AF->loadFile($filelist[$i]); // ../ismp/shared/test/Recordings/2828_Robi

	if ($AF->wave_id == "RIFF")
	{
		$AF->visual_width=600;
		$AF->visual_height=500; //../../../graphtest/
		$AF->getVisualization(substr($filelist[$i],0,strlen($filelist[$i])-4).".png");
		//echo "<img src=./".substr($filelist[$i],0,strlen($filelist[$i])-4).".png>";
	}
}

?>