<?php
$system = new Java('java.lang.System');
echo 'Java version='.$system->getProperty('java.version')."<br />\n";
echo 'Java ventor='.$system->getProperty('java.vendor')."<br />\n";
echo 'OS='.$system->getProperty('os.name').' on '.
	$system->getProperty('os.arch')."<br />\n";
$formatter = new Java('java.text.SimpleDateFormat', 'yyyy/MM/dd,EEE,a h:mm:ss ZZZZ');
echo $formatter->format(new Java('java.util.Date'));
?>
