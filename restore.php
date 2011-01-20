<?php
echo "Are you sure you want to do this?  Type 'yes' to continue: ";
$handle = fopen ("php://stdin","r");
$line = fgets($handle);
$path = trim($line);
echo "Using $path...\n";
$last_line = system('ls '.$path.' -t -l', $retval);
echo '
</pre>
<hr />Last line of the output: ' . $last_line . '
<hr />Return value: ' . $retval;
?>