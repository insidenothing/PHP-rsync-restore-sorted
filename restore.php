<?php
function cliPause(){
echo "Press enter to continue";
$handle = fopen ("php://stdin","r");
$null = fgets($handle);
echo "\n";
}
echo "Path to sort and restore: ";
$handle = fopen ("php://stdin","r");
$line = fgets($handle);
$path = trim($line);
echo "sorting $path...\n";
ob_start();
$last_line = system('ls '.$path.' -t', $retval);
$buffer = ob_get_clean();
echo "Loaded \n";
$lines = explode("
", $buffer);
$passes = count($lines);
echo "Ready to process $passes files / folders \n";
cliPause();
$line=0;
while($line < $passes){
echo "$lines[$line] \n";
$line++;
}
cliPause();
?>