<?php
//	echo "Datatime.php called<br>";
	function datetime()
	{
		date_default_timezone_set("Africa/Lagos");
		$datetime = strftime("%b-%d-%G %T %p %z", time());
		return $datetime;
	}

?>
