<?php
echo "Path to sort and restore: ";
$handle = fopen ("php://stdin","r");
$line = fgets($handle);
$path = trim($line);
echo "sorting $path...\n";
ob_start();
$last_line = system('ls '.$path.' -t -l', $retval);
$buffer = ob_get_clean();
echo "Loaded \n";
$lines = explode("
", $buffer);
$passes = count($lines);
echo "Ready to process $passes files / folders \n";

?>