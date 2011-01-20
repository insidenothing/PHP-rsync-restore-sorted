<?php
function sec2hms($sec, $padHours = false){
    $hms = "";
    $hours = intval(intval($sec) / 3600); 
    $hms .= ($padHours) 
          ? str_pad($hours, 2, "0", STR_PAD_LEFT). ":"
          : $hours. ":";
    $minutes = intval(($sec / 60) % 60); 
    $hms .= str_pad($minutes, 2, "0", STR_PAD_LEFT). ":";
    $seconds = intval($sec % 60); 
    $hms .= str_pad($seconds, 2, "0", STR_PAD_LEFT);
    return $hms;
  }

function prepSpaces($str){
$str = str_replace(' ','\ ',$str);
return $str;
}
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

echo "Ready to process $passes in $path by $sort to $remote at $server as $user, it will take ".sec2hms($passes)." \n";
cliPause();
echo "ARE YOU SURE YOU WANT TO START THE RSYNC NOW? \n";
cliPause();
$line=0;
while($line < $passes){
if (is_dir($path.'/'.$lines[$line])){ 
$src = $path.'/'.$lines[$line].'/'; 
$dest = $user.'@'.$server.':'.$remote.'/'.$lines[$line].'/';
sleep(1);
$command = 'rsync -avz --progress "'.$src.'" "'.prepSpaces($dest).'"';
$type = "folder";
}else{
$src = $path.'/'.$lines[$line]; 
$dest = $user.'@'.$server.':'.$remote.'/'.$lines[$line];
$command = 'rsync -avz --progress "'.$src.'" "'.prepSpaces($dest).'"';
$type = "file";
}
echo "$type: $command \n\n";
$output = system($command.' >> /logs/restore.progress.log &', $error);
$remaining = $line-$spaces;
echo "\n Time Remaining: ".sec2hms($remaining)." \n";
$line++;
}
echo "Restore Complete \n";
cliPause();
?>