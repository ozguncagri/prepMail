<?php

require_once __DIR__ . "/vendor/autoload.php";

if ($argc === 4) {
	$templateFilePath = '';
	$styleFilePath = '';

	if (file_exists($argv[1]) && file_exists($argv[2]) && is_readable($argv[1]) && is_readable($argv[2])) {
		$templateFilePath = $argv[1];
		$styleFilePath = $argv[2];
	} elseif (file_exists(getcwd().'/'.$argv[1]) && file_exists(getcwd().'/'.$argv[2]) && is_readable(getcwd().'/'.$argv[1]) && is_readable(getcwd().'/'.$argv[2])) {
		$templateFilePath = getcwd().'/'.$argv[1];
		$styleFilePath = getcwd().'/'.$argv[2];
	}

	if (!empty($templateFilePath) && !empty($styleFilePath)) {
        //Convert CSS file to inline style elements
		$emogrifier = new \Pelago\Emogrifier(
			file_get_contents($argv[1]),
			file_get_contents($argv[2])
		);
		$temporaryOutput = $emogrifier->emogrify();

		//Remove class attributes from html output
		$classRegex = '/\sclass="[0-9a-zA-Z\s]+"/';
		$temporaryOutput = preg_replace($classRegex, '', $temporaryOutput);

		//Remove id attributes from html output
		$idRegex = '/\sid="[0-9a-zA-Z\s]+"/';
		$temporaryOutput = preg_replace($idRegex, '', $temporaryOutput);

		//Remove css file link tags from html output
		$linkTagRegex = '/<link.*href="(.+\.css)".*>/';
		$temporaryOutput = preg_replace($linkTagRegex, '', $temporaryOutput);

		file_put_contents($argv[3], $temporaryOutput);
	} else {
		echo "Error : One of the input file is missing or not readable!\n";
	}
} else {
	echo "Usage : prepMail <input html file> <input css file> <output html file>\n" .
	"\nExample : prepMail inputTemplate.html inputStyle.css output.html\n";
}