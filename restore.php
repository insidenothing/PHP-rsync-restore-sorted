<?php
function cliPause(){
echo "Press enter to continue";
$handle = fopen ("php://stdin","r");
$null = fgets($handle);
echo "\n";
}
echo "Sort type, first to transfer [newest]: ";
$handle = fopen ("php://stdin","r");
$line = fgets($handle);
$sort = trim($line);
if($sort == "newest"){
$switch = "-t";
}
if(!$sort){
$sort = "n/a";
}
echo "Path to restore from: ";
$handle = fopen ("php://stdin","r");
$line = fgets($handle);
$path = trim($line);

echo "Remote server username: ";
$handle = fopen ("php://stdin","r");
$line = fgets($handle);
$user = trim($line);

echo "Remote Server Name or IP: ";
$handle = fopen ("php://stdin","r");
$line = fgets($handle);
$server = trim($line);

echo "Path to restore to: ";
$handle = fopen ("php://stdin","r");
$line = fgets($handle);
$remote = trim($line);

echo "sorting $path by $sort first\n";
ob_start();
$last_line = system('ls '.$path.' '.$switch, $retval);
$buffer = ob_get_clean();
echo "Loaded \n";
$lines = explode("
", $buffer);
$passes = count($lines);
echo "Ready to process $passes in $path by $sort to $remote at $server by $user \n";
cliPause();
echo "ARE YOU SURE YOU WANT TO START THE RSYNC NOW? \n";
cliPause();
$line=0;
while($line < $passes){
if (is_dir($path.'/'.$lines[$line])){ 
$src = $path.'/'.$lines[$line].'/'; 
$dest = $user.'@'.$server.':'.$remote.'/'.$lines[$line].'/';
$command = 'rsync -avz --progress \''.$src.'\' \''.$dest.'\'';
$type = "folder";
}else{
$src = $path.'/'.$lines[$line]; 
$dest = $user.'@'.$server.':'.$remote.'/'.$lines[$line];
$command = 'rsync -avz --progress \''.$src.'\' \''.$dest.'\'';
$type = "file";
}
echo "$type: $command \n\n";
//$output = system($command, $error);
$line++;
}
cliPause();
?>