<?php
$phar = new \Phar(__DIR__ . '/prepMail.phar');    


// start buffering. Mandatory to modify stub.
$phar->startBuffering();

// Get the default stub. You can create your own if you have specific needs
$defaultStub = $phar->createDefaultStub('prepMail.php');

// Adding files
$phar->buildFromDirectory(__DIR__, '/\.php$/');
$phar->addFile('prepMail.php');
$phar->buildFromDirectory(__DIR__ . '/vendor');

// Create a custom stub to add the shebang
$stub = "#!/usr/bin/env php \n".$defaultStub;

// Add the stub
$phar->setStub($stub);

$phar->stopBuffering();