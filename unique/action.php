<?php
	session_start();

	ob_start();
	date_default_timezone_set('Asia/Karachi');
	//include_once('admin/config.php');

	include_once('functions.php');	$action = $_REQUEST['action'];

	$nUserId = $_SESSION["nUserId"];

	$strDate = date("Y-m-d");

	// Upload Images

	$folderName = "uploads/";
	switch($action)

	{

		// Create User

		case "AddUser":

			$All_air_lines = "";

			if(!empty($_POST['user_permissions'])) 

			{

				foreach($_POST['user_permissions'] as $check) 

				{

					$All_air_lines .= $check.","; 

				}

			}

			if(!empty($_POST['nUserID']))

			{

				if(empty($_POST['user_password']))

				{

					$Where = "user_id = '".$_POST['nUserID']."'";

					$nRecUser = GetRecord('tbluser', $Where);

					$_POST['user_password'] = $nRecUser['user_password'];

				}

				else

				$_POST['user_password'] = md5($_POST['user_password']);

			}

			else

			$_POST['user_password'] = md5($_POST['user_password']);

			///var_dump($_POST['user_password']); die;

			$arr = array(

						'user_name' => $_POST['user_name'],

						'user_login' => $_POST['user_login'],

						'user_password' => $_POST['user_password'],

						'user_status' => $_POST['user_status'],

						'user_email' => $_POST['user_email'], 

						'user_permissions' => rtrim($All_air_lines,","), 

						'user_type' => $_POST['user_type']);

			if(empty($_POST['nUserID']))

			{ 

				$nLastID = InsertRec("tbluser", $arr);

			}

			else

			{

				$nLastID = UpdateRec('tbluser', "user_id = '".$_POST['nUserID']."'",$arr);

			}

			header("Location: view_users");

		break;

		

		// Add Air Lines AddAirLines

		case "AddAirLines":

			$ID = $_POST['ID'];

			$arr = array("air_line_name" => $_POST['air_line_name'],

						"air_line_code" => $_POST['air_line_code']);

			if(empty($ID))

			{ 

				$nLastId = InsertRec("tblairlines", $arr);

			}

			else

			{

				UpdateRec('tblairlines', "air_line_id = '$ID'",$arr);

			}

			// Update Permissions for admin

			$SQL = "SELECT * FROM tblairlines ORDER BY air_line_name";			

			 $result = MySQLQuery($SQL);

			 while($row = mysql_fetch_array($result)) {

				 $All_air_lines .= $row['air_line_id'].","; 

			 }

			$arrAirLine = array(

						'user_permissions' => rtrim($All_air_lines,","));

			$nLastID = UpdateRec('tbluser', "user_id = '1'",$arrAirLine);			

			header("Location: view_air_lines");

		break;

		

		// Delete Air Lines

		case "DeleteAirLines":

			$DelID = $_REQUEST['DelID'];

			$Where = " air_line_id = '".$DelID."' ";

			$nRec = DeleteRec('tblairlines', $Where);

			echo "Record Deleted Successfully!";

		break;

		

		// Delete Users

		case "DeleteUsers":

			$DelID = $_REQUEST['DelID'];

			$arrAirLine = array(

						'user_status' => '0');

			$nLastID = UpdateRec('tbluser', "user_id = '".(int)$DelID."'",$arrAirLine);

			echo "Record Deleted Successfully!";

		break;

		//Group Request
		case 'GroupRequest':
		if($_POST['one_way_or_return'] == 1)
		{
			$_POST['date_of_return'] = "";
		}
			$arr = array("no_of_pax" => $_POST['no_of_pax'],
						"sector" => $_POST['sector'],
						"preferd_airline" => $_POST['preferd_airline'],
						"one_way_or_return" => $_POST['one_way_or_return'],
						"date_of_deparcher" => $_POST['date_of_deparcher'],
						"date_of_return" => $_POST['date_of_return'],
						"user_id" => $_SESSION["client_id"],
						"date" => date("Y-m-d H:i:s")
						);

			$nLastId = InsertRec("tblgrouprequest", $arr);
			header("Location: group_request?msg=sent");
		break;

		// Issue OR Refund

		case "IssueOrRefund":
			$date = date("Y-m-d");
			$today_invoice_id = TodayInvoiceId($date,"tblissuerefund");
			$arr = array("pax_name" => $_POST['pax_name'],
						"sector" => $_POST['sector'],
						//"amount" => RemoveComma($_POST['amount']),
						"pnr" => $_POST['pnr'],
						"air_line_id" => $_POST['air_line_id'],
						"air_line_code" => $_POST['air_line_code'],
						"mode_type" => $_POST['mode_type'],
						"user_id" => $_SESSION["client_id"],
						'today_invoice_id' => $today_invoice_id,
						"date" => date("Y-m-d H:i:s")
						);

			$nLastId = InsertRec("tblissuerefund", $arr);
			// Log data
			activity_log($_SESSION["client_id"],4, 0, "PNR: ".$_POST['pnr']);
			header("Location: issue_or_refund?msg=sent");

			// if($str == "sent")
			// 	header("Location: issue_or_refund?msg=sent");
			// else
			// 	header("Location: issue_or_refund?msg=nosent");
						
			$Where = "air_line_id = '".$_POST['air_line_id']."'";
			$strAirLine = GetRecord('tblairlines', $Where);

			$Issue = $_POST['mode_type'];
			$body = "

			<table>

			<tr align='left'>

			<th>Email From:</th>

			<td align='left'>".$_SESSION["strUserName"]."</td>

			</tr>
			<tr align='left'>

			<th align='left'>Pax Name:</th>

			<td align='left'>".$_POST['pax_name']."</td>

			</tr>

			<tr>

			<th align='left'>Sector:</th>

			<td>".$_POST['sector']."</td>

			</tr>

			<tr>


			<tr>

			<th align='left'>PNR:</th>

			<td>".$_POST['pnr']."</td>

			</tr>

			<tr>

			<th align='left'>Air Line Name:</th>

			<td>".$strAirLine['air_line_name']."</td>

			</tr>

			<tr>

			<th align='left'>Issue:</th>

			<td>".$arrIssue[$Issue-1]."</td>

			</tr>

			</table>

			";
			
			//$EmployeeEmail = UserEmail($_SESSION['employee_id']);
			//$to  = TO.", ".$EmployeeEmail;
			$to = "b2b@uniquegroup.com.pk";
			$subject = "Issue or Refund";

			$str = SendEmail($to, $from, $subject, $body);

			

			

		break;

		// Get Image Name 
		case 'GetImageName':
			$current_id = $_POST['current_id'];
			$Where = "id = '$current_id'";
			$nRecUser = GetRecord("tblepayment", $Where);
			echo $nRecUser['bank_slip_image'];
		break;

		// Get Passport Image Name
		case 'GetPassportImageName':
			$current_id = $_POST['current_id'];
			$Where = "id = '$current_id'";
			$nRecUser = GetRecord("tblumrah", $Where);
			echo $nRecUser['upload_passport'];
		break;

		// Payment

		case "AddPayment":
			// Upload Image
			$fileName = $_FILES["fileToUpload"]["name"];
			$fileName = generateRandomString(5).$fileName;
			//echo $fileName; die;
			if(!empty($fileName))
			{
			$fileTempName = $_FILES["fileToUpload"]["tmp_name"];
			$folderName = "images/payment_scan_images";
			UploadImage($fileName, $fileTempName, $folderName);
			}
			//$fileName = generateRandomString(5).$fileName; 
			$date = date("Y-m-d");
			$today_invoice_id = TodayInvoiceId($date,"tblepayment");
			$arr = array("amount" => RemoveComma($_POST['Amount']),
						"transection_id" => $_POST['transection_id'],
						"bank_id" => $_POST['bank_id'],
						"user_id" => $_SESSION["client_id"],
						"bank_slip_image" => $fileName,
						"today_invoice_id" => $today_invoice_id,
						"date" => date("Y-m-d H:i:s")
						);

			$nLastId = InsertRec("tblepayment", $arr);

			//header("Location: payment?msg=sent");

			$body = "

			<table>
			<tr align='left'>

			<th>Email From:</th>

			<td align='left'>".$_SESSION["strUserName"]."</td>

			</tr>
			<tr align='left'>

			<th>Amount:</th>

			<td align='left'>".$_POST['Amount']."</td>

			</tr>

			<tr>

			<th>TransductionID:</th>

			<td>".$_POST['transection_id']."</td>

			</tr>

			<tr>

			<th align='left'>Bank:</th>

			<td>".$arrBank[$_POST['bank_id'] - 1]."</td>

			</tr>

			</table>

			";
			$EmployeeEmail = UserEmail($_SESSION['employee_id']);
			$TO = "b2b@uniquegroup.com.pk";
			//$to  = $TO.", ".$EmployeeEmail;
			$subject = "Payment";

			$str = SendEmail($TO, $from, $subject, $body);
			header("Location: payment?msg=sent");
			// if($str == "sent")
			// 	header("Location: payment?msg=sent");
			// else
			// 	header("Location: payment?msg=nosent");
		break;
		
		// Feedback

		case "AddFeedback":
			
			$feedback = $_POST['feedback'];
			$body = "
			<table>
			<tr align='left'>

			<th width='20%'>Email From:</th>

			<td align='left' width='80%'>".$_SESSION["strUserName"]."</td>

			</tr>
			<tr align='left'>

			<th>Feedback and Complain:</th>

			<td align='left'>".$feedback."</td>

			</tr>

			</table>

			";

			$subject = "Feedback and Complains";
			
			$EmployeeEmail = UserEmail($_SESSION['employee_id']);
			$to  = TO.", ".$EmployeeEmail;

			$str = SendEmail($to, $from, $subject, $body);
			header("Location: feedback?msg=sent");
			// if($str == "sent")
			// 	header("Location: feedback?msg=sent");
			// else
			// 	header("Location: feedback?msg=nosent");
		break;

		// change password
		case "ChangePassword":
			$old_password = md5($_POST['old_password']);
			$new_password = md5($_POST['new_password']);
			
			$Where = "user_id = '".$_SESSION['client_id']."'";
			$nRecUser = GetRecord('tbluser', $Where);
			if($old_password == $nRecUser['user_password'])
			{
				$arr = array('user_password' => $new_password);
				$nLastID = UpdateRec('tbluser', "user_id = '".(int)$_SESSION['client_id']."'",$arr);			
				header("Location: change_password.php?msg=true");		
			}
			else
				header("Location: change_password.php?msg=false");
					
		break;
		
		// Umrah
		case "Umrah123":
//		print_r($_POST['package_code']); die;
			$body = "";
			$body .= "<!DOCTYPE html><html lang='en'><head><style type='text/css'>table {

	background-color: transparent

}

caption {

	padding-top: 8px;

	padding-bottom: 8px;

	color: #777;

	text-align: left

}

th {

	text-align: left

}

.table {

	width: 100%;

	max-width: 100%;

	margin-bottom: 20px

}

.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {

	padding: 8px;

	line-height: 1.42857143;

	vertical-align: top;

	border-top: 1px solid #ddd

}

.table>thead>tr>th {

	vertical-align: bottom;

	border-bottom: 2px solid #ddd

}

.table>caption+thead>tr:first-child>td, .table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>th, .table>thead:first-child>tr:first-child>td, .table>thead:first-child>tr:first-child>th {

	border-top: 0

}

.table>tbody+tbody {

	border-top: 2px solid #ddd

}

.table .table {

	background-color: #fff

}

.table-condensed>tbody>tr>td, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>td, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>thead>tr>th {

	padding: 5px

}

.table-bordered {

	border: 1px solid #ddd

}

.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {

	border: 1px solid #ddd

}

.table-bordered>thead>tr>td, .table-bordered>thead>tr>th {

	border-bottom-width: 2px

}

.table-striped>tbody>tr:nth-of-type(odd) {

	background-color: #f9f9f9

}

.table-hover>tbody>tr:hover {

	background-color: #f5f5f5

}

table col[class*=col-] {

	position: static;

	display: table-column;

	float: none

}

table td[class*=col-], table th[class*=col-] {

	position: static;

	display: table-cell;

	float: none

}</style></head><body>";
			for( $i=0 ; $i < count($_POST['package_code']); $i++ )
			{
				//echo  $_POST['package_code'][1]."--------";
				
				$body .= "<div class='row' style='width:1000px; margin-bottom:40px;'><div class='col-lg-12'><div class='dataTable_wrapper'><table class='table table-striped table-bordered table-hover' width='87%'><tbody><tr class='odd gradeX'></tr><tr class='odd gradeX'><th width='19%'>Package Code</th><td width='29%'>".$_POST['package_code'][$i]."</td><th width='19%'>Relation</th><td width='33%'>".$arrRelation[$_POST['Relation'][$i]-1]."</td></tr><tr class='even gradeC'><th>Sur Name</th><td>".$_POST['sur_name'][$i]."</td><th>Given Name</th><td>".$_POST['given_name'][$i]."</td></tr><tr class='odd gradeA'><th>Father/Husband Name</th><td>".$_POST['father_husband_name'][$i]."</td><th>Sex</th><td>".$arrSex[$_POST['Sex'][$i]-1]."</td></tr><tr class='even gradeA'><th>Date of Birth</th><td>".$_POST['dob'][$i]."</td><th>Place of Birth</th><td>".$_POST['place_of_birth'][$i]."</td></tr><tr class='even gradeA'><th>Passport No</th><td>".$_POST['passport_no'][$i]."</td><th>Passport Issue Date</th><td>".$_POST['passport_issue_date'][$i]."</td></tr><tr class='even gradeA'><th>Passport Expire Date</th><td>".$_POST['passport_expire_date'][$i]."</td><th>CNIC No</th><td>".$_POST['cnic'][$i]."</td></tr><tr class='even gradeA'><th>CNIC Issue Date</th><td>".$_POST['cnic_issue_date'][$i]."</td><th>CNIC Expiry Date</th><td>".$_POST['cnic_expiry_date'][$i]."</td></tr><tr class='even gradeA'><th>Address CNIC</th><td>".$_POST['Address_CNIC'][$i]."</td></tr></tbody></table></div></div></div>";
		
	//	$body .= $body;
			}
			$body .= "</body></html>";
			
			$subject = "Umrah Feeding From : ".$_SESSION["strUserName"]."";
			
			//echo $body; die;

			$str = SendEmail(TO, $from, $subject, $body);
			if($str == "sent")
				header("Location: umrah?msg=sent");
			else
				header("Location: umrah?msg=nosent");
			
			
	 break;

	 // Umrah
	 case "Umrah":
	 		if(!empty($_POST['package_code']))
	 		{
	 			for( $i=0 ; $i < count($_POST['package_code']); $i++ )
				{
					// Upload Image
					$fileName = "";
					$fileName = $_FILES["fileToUpload"]["name"][$i];
					$fileName = generateRandomString(5).$fileName;
					//echo $fileName; die;
					if(!empty($fileName))
					{
					$fileTempName = $_FILES["fileToUpload"]["tmp_name"][$i];
					$folderName = "images/user_passport";
					UploadImage($fileName, $fileTempName, $folderName);
					}
					$arr = array(
						"user_id" => $_SESSION["client_id"],
						"package_code" => $_POST['package_code'][$i],
						"upload_passport" => $fileName,
						"relation" => $_POST['Relation'][$i],
						"sur_name" => $_POST['sur_name'][$i],
						"given_name" => $_POST['given_name'][$i],
						"father_husband_name" => $_POST['father_husband_name'][$i],
						"sex" => $_POST['Sex'][$i],
						"date_of_birth" => $_POST['dob'][$i],
						"place_of_birth" => $_POST['place_of_birth'][$i],
						"passport_no" => $_POST['passport_no'][$i],
						"passport_issue_date" => $_POST['passport_issue_date'][$i],
						"passport_expire_date" => $_POST['passport_expire_date'][$i],
						"cnic_no" => $_POST['cnic'][$i],
						"cnic_issue_date" => $_POST['cnic_issue_date'][$i],
						"cnic_expire_date" => $_POST['cnic_expiry_date'][$i],
						"address_cnic" => $_POST['Address_CNIC'][$i],
						"visa_type" => $_POST['Visa_type'][$i],
						"no_of_days" => $_POST['No_of_Days'][$i],
						"date_created" => date("Y-m-d H:i:s")
						);
					$nLastId = InsertRec("tblumrah", $arr);
				}	
				header("Location: umrah?msg=sent");
	 		}
	 		
	 break;

		// Get Visa Detail
	 	case 'GetVisaDetail':
	 		$current_id = (int)$_POST['current_id'];
			$Where = "id = '$current_id'";
			$row = GetRecord("tblumrah", $Where);

	 		echo "<table class='table'>
				    <thead>
				      <tr>
				        <th style='width: 200px;'>Package Code</th>
				        <td>".$row['package_code']."</td>
				      </tr>
				    </thead>
				    <tbody>
				      <tr>
				        <th style='width: 200px;'>Relation</th>
				        <td>".$arrRelation[$row['relation'] - 1]."</td>
				      </tr>
				      <tr>
				        <th style='width: 200px;'>Sur Name</th>
				        <td>".$row['sur_name']."</td>
				      </tr>
				      <tr>
				        <th style='width: 200px;'>Given Name</th>
				        <td>".$row['given_name']."</td>
				      </tr>
				      <tr>
				        <th style='width: 200px;'>Father/Husband Name</th>
				        <td>".$row['father_husband_name']."</td>
				      </tr>
				      <tr>
				        <th style='width: 200px;'>Sex</th>
				        <td>".$arrSex[$row['sex']]."</td>
				      </tr>
				      <tr>
				        <th style='width: 200px;'>Date of Birth</th>
				        <td>".$row['date_of_birth']."</td>
				      </tr>
				      <tr>
				        <th style='width: 200px;'>Place of Birth</th>
				        <td>".$row['place_of_birth']."</td>
				      </tr>
				      <tr>
				        <th style='width: 200px;'>Passport No</th>
				        <td>".$row['passport_no']."</td>
				      </tr>
				      <tr>
				        <th style='width: 200px;'>Passport Issue Date</th>
				        <td>".$row['passport_issue_date']."</td>
				      </tr>
				      <tr>
				        <th style='width: 200px;'>Passport Expire Date</th>
				        <td>".$row['passport_expire_date']."</td>
				      </tr>
				      <tr>
				        <th style='width: 200px;'>CNIC No</th>
				        <td>".$row['cnic_no']."</td>
				      </tr>
				      <tr>
				        <th style='width: 200px;'>CNIC Issue Date</th>
				        <td>".$row['cnic_issue_date']."</td>
				      </tr>
				      <tr>
				        <th style='width: 200px;'>CNIC Expiry Date</th>
				        <td>".$row['cnic_expire_date']."</td>
				      </tr>
				      <tr>
				        <th style='width: 200px;'>Address CNIC</th>
				        <td>".$row['address_cnic']."</td>
				      </tr>
				      <tr>
				        <th style='width: 200px;'>Visa Type</th>
				        <td>".$arrVisaType[$row['visa_type']]."</td>
				      </tr>
				      <tr>
				        <th style='width: 200px;'>No. of Days</th>
				        <td>".$row['no_of_days']."</td>
				      </tr>
				    </tbody>
				  </table>";
	 	break;

	 	// Get Visa Docs Name
		case 'GetVisaDocsImageName':
			$current_id = $_POST['current_id'];
			$Where = "id = '$current_id'";
			$nRecUser = GetRecord("tblumrah", $Where);
			echo $nRecUser['visa_docs'];
		break;

	 	// Update Amount Comments
		case 'UpdateAmountComments':
			$request_id = $_POST['request_id'];
			$Where = "id = '$request_id'";
			// Check update status
			$arr = array("amount" => RemoveComma($_POST['amount']),
						"comments" => $_POST['user_comments']);
			UpdateRec('tblgrouprequest', $Where, $arr);
		break;

		// GetRequestComments
		case 'GetRequestComments':
			$current_id = $_POST['current_id'];
			$Where = "id = '$current_id'";
			$nRec = GetRecord("tblgrouprequest", $Where);
			$nRec['amount'] = $nRec['amount'];
			$nRec['comments'] = $nRec['comments'];
			echo json_encode($nRec);		
		break;

		// Update Available Balance
		case 'UpdateAvailableBalance':
			$client_id = (int)$_POST['client_id'];
			$current_available_balance = $_POST['current_available_balance'];
			//echo $client_id."****".$current_available_balance; die;
			$Where = "client_id = '$client_id' AND staus_id = 1"; // AND staus_id = 0
			$nRec = GetRecord("tblavailablebalance", $Where);
			$db_balance = $nRec['available_balance'];
			$current_available_balance = RemoveComma(number_format($current_available_balance,2));
			//echo $db_balance ."****". $current_available_balance; die;
			// Insert new if balance is update
			if($db_balance != $current_available_balance)
			{
				// Set status 0 to keep record history
				$arr = array("staus_id" => 0);
				UpdateRec('tblavailablebalance', $Where, $arr);
				// insert new balance
				$arr = array("available_balance" => $current_available_balance,
						"staus_id" => 1,
						"client_id" => $client_id,
						"date" => date("Y-m-d H:i:s"));
				InsertRec('tblavailablebalance', $arr);
			}
			
		break;

		// Save Encode URL to DB
		case 'SaveEncodeURLDB':
		//echo "adfasd"; die;
			//print_r($_POST); die;
			$client_id = (int)$_POST['client_id'];
			$url = $_POST['url'];
			$type_id = $_POST['type_id'];
			$air_line_id = $_POST['air_line_id'];
			$Where = "client_id = '$client_id' AND air_line_id = '$air_line_id' AND url_encode = '$url'"; // AND staus_id = 0
			$nRec = GetRecord("tblencodeurl", $Where);
			$arr = array("client_id" => $client_id,
						  "air_line_id" => $air_line_id,
						  "type_id" => $type_id,
						  "url_encode" => $url);
			if(empty($nRec))
				InsertRec('tblencodeurl', $arr);
			else
				UpdateRec('tblencodeurl', $Where, $arr);
			echo "2";
		break;

		// Get Ticket Comments
		case 'GetTicketComments':
			$comment_id = $_POST['comment_id'];
			$Where = "id = '$comment_id'";
			$nRec = GetRecord("tblissuerefund", $Where);
			if(!empty($nRec['user_comment']))
				echo $nRec['user_comment'];
			else
				echo "";
		break;	
	}

	
?>