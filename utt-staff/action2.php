<?php
	include_once("config.php");
	$action = $_POST['action'];

	switch ($action) {
		// Check Unread Tickets
		case 'CheckedUnreadTickets':
			$Where = "is_active = 0";
	 		$count = RecCount("tblissuerefund", $Where);
	 		echo $count;
	 	break;

	 	// Checked Unread Payments
	 	case 'CheckedUnreadPayments':
			$Where = "is_active = 0";
	 		$count = RecCount("tblepayment", $Where);
	 		echo $count;
		break;

		// Checked Unread Visa
		case 'CheckedUnreadVisa':
			$Where = "is_active = 0";
	 		$count = RecCount("tblumrah", $Where);
	 		echo $count;
		break;

		// Checked Unread Request
		case 'CheckedUnreadRequest':
			$Where = "is_active = 0";
	 		$count = RecCount("tblgrouprequest", $Where);
	 		echo $count;
		break;
	}

	// find the number of records in a table

	//

	// strTable:		name of table to count records in.

	// strCriteria:		select criteria,

	//					if this is not passed, returns the number of all

	//					rows in the table

	// returns:			number of rows in the table

	//

	function RecCount($strTable, $strCriteria = "")

	{		
		global $conn;
		if(empty($strCriteria))

			$strQuery = "select count(*) as cnt from $strTable;";

		else

			$strQuery = "select count(*) as cnt from $strTable where $strCriteria;";

	

		$nResult = mysqli_query($conn, $strQuery);

		$rstRow = mysqli_fetch_array($nResult);

		return $rstRow["cnt"];

	}
?>