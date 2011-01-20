<?php
function cliPause(){
echo "Press enter to continue";
$handle = fopen ("php://stdin","r");
$null = fgets($handle);
echo "\n";
}
echo "Sort type, first to transfer: [newest] ";
$handle = fopen ("php://stdin","r");
$line = fgets($handle);
$sort = trim($line);
if($sort == "newest"){
$switch = "-t";
}
if(!$sort){
$sort = "n/a";
}
echo "Path to restore: ";
$handle = fopen ("php://stdin","r");
$line = fgets($handle);
$path = trim($line);
echo "sorting $path by $sort first\n";
ob_start();
$last_line = system('ls '.$path.' '.$switch, $retval);
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