<?php

$Status = trim(exec('/etc/init.d/cron status'));

echo $Status;

if ($Status == "cron is running.") {
	$Status = true;
} else {
	$Status = false;
}

echo $Status;

?>
