<?php
	$DB_Server = "localhost";
	$DB_Username ="root";
	$DB_Password = "";
	$DB_DBName = "unique2_unique786";
	//define(TO,'jawadjee0519@gmail.com');

	$conn = mysqli_connect($DB_Server,$DB_Username,$DB_Password,$DB_DBName);
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
	
	$strPath = "";
	$dTimeOffset = -36000;		// offset time 10 hrs reverse

	// login script relative path -- security is not checked on this page
	$strLoginScriptPath = "/index.php";

	// User Type
	$arrUserType[1] = "Admin";
	$arrUserType[0] = "Client";
	$arrUserType[2] = "Staff";

	// Mode
	$arrIssue[] = "Issue";
	$arrIssue[] = "Refund";
	$arrIssue[] = "Reissue";
	$arrIssue[] = "Void";

	// Bank Name

	// Bank Name

	//$arrBank[] = "BOP";

	$arrBank[] = "Habib Bank Limited";

	$arrBank[] = "Standard Chartered Bank";

	$arrBank[] = "Allied Bank Limited";

	//$arrBank[] = "MCB";

	$arrBank[] = "United Bank Limited";

	$arrBank[] = "Summit Bank";

	$arrBank[] = "Bank Al Falah";

	$arrBank[] = "Al Habib Bank";

	$arrBank[] = "Faisal Bank";

	$arrBank[] = "Cash";

	// Relation

	$arrRelation[] = "Mother";

	$arrRelation[] = "Father";

	$arrRelation[] = "Husband";

	$arrRelation[] = "Wife";

	$arrRelation[] = "Son";

	$arrRelation[] = "Daughter";

	$arrRelation[] = "Sister";

	$arrRelation[] = "Brother";
	// Sex

	$arrSex[] = "Male";

	$arrSex[] = "FeMale";

	// Visa Type

	$arrVisaType[] = "Umrah";

	$arrVisaType[] = "Dubai Visa";

	// Ticket Status
	$arrTicketStatus[] = "Prossess";
	$arrTicketStatus[] = "Ticketed";
	$arrTicketStatus[] = "Void";
	$arrTicketStatus[] = "Refund";
	$arrTicketStatus[] = "PNR Expired";
	$arrTicketStatus[] = "Reissued";
	$arrTicketStatus[] = "Rejected";
	$arrTicketStatus[] = "Link Down";
	$arrTicketStatus[] = "In Prossess";
	$arrTicketStatus[] = "Limit Exceeded";
	$arrTicketStatus[] = "Flight Check-in";

	// Payment Status
	$arrPaymentStatus[] = "In Prossess";
	$arrPaymentStatus[] = "Aproved";
	$arrPaymentStatus[] = "Rejected";
	$arrPaymentStatus[] = "Prossesdehir";
	// <option value="1">Prossess</option>
 //    <option value="2">Ticketed</option>
 //  <option value="3">Void</option>
 //  <option value="4">Refund</option>
 //  <option value="5">PNR Expired</option>
 //  <option value="6">Reissued</option>
 //  <option value="7">Rejected</option>
 //  <option value="8">Link Down</option>
 //  <option value="9" selected="selected">In Prossess</option>
 //  <option value="10">Limit Exceeded</option>
 //  <option value="11">Flight Check-in</option>

?>