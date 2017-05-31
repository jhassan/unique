<?php
	// Create User Activity Log
	function activity_log($user_id, $activity_type)
	{
		global $conn;
		$date_time = date("Y-m-d H:i:s");
		$sql_log = "INSERT INTO tbllog (user_id, computer_name , activity_type, date_time)
				VALUES ('".(int)$user_id."', '".$_SERVER["REMOTE_ADDR"]."', '".$activity_type."', '".$date_time."')";
		mysqli_query($conn, $sql_log);
	}

	// Activity Log
	//activity_log($rstRow["user_id"], $rstRow["user_name"]." Logined");
?>