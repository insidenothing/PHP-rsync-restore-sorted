<?php
echo "Path to sort and restore: ";
$handle = fopen ("php://stdin","r");
$line = fgets($handle);
$path = trim($line);
echo "sorting $path...\n";
$last_line = system('ls '.$path.' -t -l', $retval);
echo "Done \n";
//$last_line;
//$retval;
?>