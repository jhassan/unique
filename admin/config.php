<?php
	$DB_Server = "localhost";
	$DB_Username ="root";
	$DB_Password = "";
	$DB_DBName = "unique2_unique786";
	//define(TO,'jawadjee0519@gmail.com');
	
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
	$arrIssue[] = "Split";

	// Bank Name

	$arrBank[] = "BOP";

	$arrBank[] = "HBL";

	$arrBank[] = "SCB";

	$arrBank[] = "ABL";

	$arrBank[] = "MCB";

	$arrBank[] = "UBL";

	$arrBank[] = "Summit";

	$arrBank[] = "Bank Al Falah";

	$arrBank[] = "Al Habib Bank";

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

?>