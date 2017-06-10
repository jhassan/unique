<?php
	session_start();

	ob_start();
	date_default_timezone_set("Asia/Karachi");
	include_once('config.php');

	include_once('functions.php');

	/*include_once('include/csv.php');

	include_once('accounts.php');*/  
	$action = $_REQUEST['action'];

	$nUserId = $_SESSION["nUserId"];

	$strDate = date("Y-m-d");

	// Upload Images

	$folderName = "uploads/";
	switch($action)

	{

		// Create User

		case "AddUser":
			// Get data for exist user

			$Where = "user_id = '".$_POST['nUserID']."'";
			$staff_permissions = $_POST['staff_permissions'];
			if(!empty($staff_permissions))
	        	$arrayChickList = implode(',', $staff_permissions);
			else
				$arrayChickList = "";
			$franchize_users = $_POST['franchize_users'];
			if(!empty($franchize_users))
	        	$arrayFranchizeUsers = implode(',', $franchize_users);
			else
				$arrayFranchizeUsers = "";

			//print_r($arrayChickList); die;
			$nRecUser = GetRecord('tbluser', $Where);
			if(!empty($_POST['nUserID']))

			{

				if(empty($_POST['user_password']))

					$_POST['user_password'] = $nRecUser['user_password'];

				else

				$_POST['user_password'] = md5($_POST['user_password']);

			}

			else

			$_POST['user_password'] = md5($_POST['user_password']);

			$arr = array(

						'user_name' => $_POST['user_name'],

						'user_login' => $_POST['user_login'],

						'user_password' => $_POST['user_password'],

						'user_status' => $_POST['user_status'],

						'user_email' => $_POST['user_email'],
						'employee_id' => $_POST['employee_id'],
						'sales_report_status' => $_POST['sales_report'],
						'sales_report_url' => $_POST['sales_report_url'],
						'notes_status' => $_POST['notes_status'],
						'notes' => $_POST['notes'],
						'bank_accounts_status' => $_POST['bank_accounts_status'], 
						'umrah_status' => $_POST['umrah_status'],
						'opening_balance' => $_POST['opening_balance'],
						'account_limit' => $_POST['account_limit'],
						'bsp_url' => $_POST['bsp_url'],
						'id_date' => date("Y-m-d", strtotime($_POST['id_date'])),
						'expire_guarantee' => date("Y-m-d", strtotime($_POST['expire_guarantee'])),
						'staff_permissions' => $arrayChickList,
						'franchize_user_permissions' => $arrayFranchizeUsers,
						'user_type' => $_POST['user_type']);
			

			if(empty($_POST['nUserID']))
			{	
				$nLastID = InsertRec("tbluser", $arr);
				// Insert air line
				// $arrAirLine = array("air_line_url"  => $_POST['air_line_url'],
				// 					"client_id"  	=> $nLastID);
				// $InsPassID = InsertRec("tblairlines", $arrAirLine);
			}
			else

			{

				$nLastID = UpdateRec('tbluser', "user_id = '".(int)$_POST['nUserID']."'",$arr);
				// // Insert air line
				// 	$arrAirLine = array("air_line_url"  => $_POST['air_line_url'],
				// 					"client_id"  	=> (int)$_POST['nUserID']);
				// $whereAirline = " client_id = ".(int)$_POST['nUserID'];
				// $GetRecord = GetRecord("tblairlines", $whereAirline);
				// if(empty($GetRecord['air_line_url']))
				// 	$InsPassID = InsertRec("tblairlines", $arrAirLine);
				// else
				// {
				// 	// Update air line
				// 	$nLastID = UpdateRec('tblairlines', "client_id = '".(int)$_POST['nUserID']."'",$arrAirLine);
				// }
					

				$nLastID = $_POST['nUserID'];

			}

			// Add details in air line details

			if(isset($_POST['user_permissions']) && !empty($_POST['user_permissions']))

			{

				// Chcek Exists Or Not

				$where = " user_id = ".$_POST['nUserID'];

				$GetRecord = GetRecord("tbluserairlines", $where);

				if(!empty($GetRecord['user_id']))

					$nRec = DeleteRec('tbluserairlines', " user_id = '".$GetRecord['user_id']."'");

				for( $i=0 ; $i < sizeof($_POST['user_permissions']); $i++ )

					{

						//$str .= $_POST['url'][$i];

						$arrPassDetail = array("air_line_id"  => $_POST['user_permissions'][$i],

												"user_url"  	=> $_POST['url'][$i],

												"user_id"  	 => $nLastID);

						if(!empty($_POST['url'][$i]) && !empty($_POST['user_permissions'][$i]))						

						$InsPassID = InsertRec("tbluserairlines", $arrPassDetail);						

					}

			}

			header("Location: view_users");

			//}

		break;

		

		// Add Air Lines AddAirLines

		case "AddAirLines":

			if(empty($_POST['air_line_name']))

			{

				echo "Please enter air line name!"; 

				die;

			}

			else if(empty($_POST['air_line_code']))

			{

				echo "Please enter air line code!"; 

				die;	

			} else if(empty($_FILES["fileToUpload"]["name"]) && empty($_POST['ID']))

			{

				echo "Please select air line image!"; 

				die;	

			}

			else

			{

			// Upload Image

			$fileName = $_FILES["fileToUpload"]["name"];

			if(!empty($fileName))

			{
			$fileName = generateRandomString(5).$fileName;		
			$fileTempName = $_FILES["fileToUpload"]["tmp_name"];

			$folderName = "images/air_lines";
			UploadImage($fileName, $fileTempName, $folderName);

			}

			}

			$ID = $_POST['ID'];

			$arr = array("air_line_name" => $_POST['air_line_name'],

						"air_line_code" => $_POST['air_line_code'],

						"url_status" => $_POST['url_status'],

						"air_line_url" => $_POST['air_line_url'],

						"air_line_image" => $_POST['fileToUpload']);

			if(empty($ID))

			{ 

				$nLastId = InsertRec("tblairlines", $arr);

			}

			else

			{

				if(!empty($_POST['fileToUpload']))

				{

				// Remove file from folder

				$Where = " air_line_id = '".$ID."' ";

				$nRecUser = GetRecord('tblairlines', $Where);

				$file = "images/air_lines/".$nRecUser['air_line_image'];

				unlink($file);

				UpdateRec('tblairlines', "air_line_id = '$ID'",$arr);

				}

				else 

				{

					$arr = array("air_line_name" => $_POST['air_line_name'],
						"url_status" => $_POST['url_status'],

						"air_line_url" => $_POST['air_line_url'],

						"air_line_code" => $_POST['air_line_code']);

					UpdateRec('tblairlines', "air_line_id = '$ID'",$arr);

				}

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

			echo "3"; die;		

			//header("Location: view_air_lines");

		break;

		// Add Others

		case "AddOthers":

			// Upload Image

			$fileName = $_FILES["fileToUpload"]["name"];

			if(!empty($fileName))

			{
			$fileName = generateRandomString(5).$fileName;		
			$fileTempName = $_FILES["fileToUpload"]["tmp_name"];

			$folderName = "images/others";
			UploadImage($fileName, $fileTempName, $folderName);

			}

			

			$ID = $_POST['ID'];

			$arr = array("other_url" => trim($_POST['other_url']),
						"other_image" => $fileName,
						"date" => date("Y-m-d H:i:s"));

			if(empty($ID))

			{ 

				$nLastId = InsertRec("tblothers", $arr);

			}

			else

			{

				if(!empty($_POST['fileToUpload']))

				{

				// Remove file from folder

				$Where = " id = '".$ID."' ";

				$nRecUser = GetRecord('tblothers', $Where);

				$file = "images/others/".$nRecUser['other_image'];

				unlink($file);

				UpdateRec('tblothers', "id = '$ID'",$arr);

				}

				else 

				{

					$arr = array("other_url" => trim($_POST['other_url']),
								"date" => date("Y-m-d H:i:s"));

					UpdateRec('tblothers', "id = '$ID'",$arr);

				}

			}
			header("Location: view_others");

		break;

		

		// Delete Air Lines

		case "DeleteAirLines":

			$DelID = $_REQUEST['DelID'];

			$Where = " air_line_id = '".$DelID."' ";
			// Remove file from folder

			$nRecUser = GetRecord('tblairlines', $Where);

			$file = "images/air_lines/".$nRecUser['air_line_image'];

			unlink($file);
			// Delete record from table

			$nRec = DeleteRec('tblairlines', $Where);

			echo "Record Deleted Successfully!";

		break;

		// Delete Others

		case "DeleteOthers":

			$DelID = $_REQUEST['DelID'];

			$Where = " id = '".$DelID."' ";
			// Remove file from folder

			$nRecUser = GetRecord('tblothers', $Where);

			$file = "images/others/".$nRecUser['other_image	'];

			unlink($file);
			// Delete record from table

			$nRec = DeleteRec('tblothers', $Where);

			echo "2";

		break;

		// Delete Ticket
		case "DeleteTicket":
			$DelID = $_POST['DelID'];
			$Where = " id = '".$DelID."' ";
			$nRec = DeleteRec('tblissuerefund', $Where);
			echo "2";
		break;

		// Delete Payment
		case 'DeletePayment':
			$DelID = $_POST['DelID'];
			$Where = " id = '".$DelID."' ";
			$nRec = DeleteRec('tblepayment', $Where);
			echo "2";
		break;

		// Delete Visa
		case 'DeleteVisa':
			$DelID = $_POST['DelID'];
			$Where = " id = '".$DelID."' ";
			$nRec = DeleteRec('tblumrah', $Where);
			echo "2";
		break;

		// Delete Request
		case 'DeleteRequest':
			$DelID = $_POST['DelID'];
			$Where = " id = '".$DelID."' ";
			$nRec = DeleteRec('tblgrouprequest', $Where);
			echo "2";
		break;

		//Edit Group Request
		case 'EditGroupRequest':
		//echo $_POST['one_way_or_return']; die;
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
			$Where = " id = '".$_POST['edit_id']."' ";
			$nLastId = UpdateRec("tblgrouprequest", $Where, $arr);
			header("Location: view_request?msg=edit");
		break;
		

		// Payment

		case "EditPayment":
			// Upload Image
			$fileName = $_FILES["fileToUpload"]["name"];
			if(!empty($fileName))
			{
			$fileName = generateRandomString(5).$fileName;				
			$fileTempName = $_FILES["fileToUpload"]["tmp_name"];
			$folderName = "../unique/images/payment_scan_images";
			UploadImage($fileName, $fileTempName, $folderName);
			$arr = array("amount" => RemoveComma($_POST['Amount']),
						"transection_id" => $_POST['transection_id'],
						"bank_id" => $_POST['bank_id'],
						//"user_id" => $_SESSION["client_id"],
						"bank_slip_image" => $fileName,
						"date" => date("Y-m-d H:i:s")
						);
			}
			else
			{
			$arr = array("amount" => RemoveComma($_POST['Amount']),
						"transection_id" => $_POST['transection_id'],
						"bank_id" => $_POST['bank_id'],
						//"user_id" => $_SESSION["client_id"],
						"date" => date("Y-m-d H:i:s")
						);	
			}
			$Where = " id = '".(int)$_POST['edit_id']."' ";
			$nLastId = UpdateRec("tblepayment", $Where ,$arr);
			header("Location: view_payment?msg=edit");
		break;

		// Delete Users

		case "DeleteUsers":

			$DelID = $_REQUEST['DelID'];

			$arrAirLine = array(

						'user_status' => '0');

			$nLastID = UpdateRec('tbluser', "user_id = '".(int)$DelID."'",$arrAirLine);

			echo "2";

		break;

		

		// Add Logo

		case "AddLogo":

			if(empty($_FILES["fileToUpload"]["name"]) && empty($_POST['ID']))

			{

				echo "Please select logo!"; 

				die;	

			}

			else

			{

			// Upload Image

			$fileName = $_FILES["fileToUpload"]["name"];

			if(!empty($fileName))

			{

			$fileTempName = $_FILES["fileToUpload"]["tmp_name"];

			$folderName = "images/logo";
			UploadImage($fileName, $fileTempName, $folderName);

			}

			}
			// Update status of logo

			$arrLogo = array("logo_status" => "0");

			UpdateRec('tbllogo', " 1 = 1 ",$arrLogo);
			$ID = $_POST['ID'];

			$arr = array("logo_status" => $_POST['logo_status'],

						"logo_image" => $_POST['fileToUpload']);

			if(empty($ID))

			{ 

				$nLastId = InsertRec("tbllogo", $arr);

			}

			else

			{

				if(!empty($_POST['fileToUpload']))

				{

				// Remove file from folder

				$Where = " logo_id = '".$ID."' ";

				$nRecUser = GetRecord('tbllogo', $Where);

				$file = "images/logo/".$nRecUser['logo_image'];

				unlink($file);

				UpdateRec('tbllogo', "logo_id = '$ID'",$arr);

				}

				else 

				{

					$arr1 = array("logo_status" => $_POST['logo_status']);

					UpdateRec('tbllogo', "logo_id = '$ID'",$arr1);

				}
			}

			echo "upload"; die;		

			break;
			// Delete Logo

		case "DeleteLogo":

			$DelID = $_REQUEST['DelID'];

			$Where = " logo_id = '".$DelID."' ";
			// Remove file from folder

			$nRecUser = GetRecord('tbllogo', $Where);

			$file = "images/logo/".$nRecUser['logo_image'];

			unlink($file);
			// Delete record from table

			$nRec = DeleteRec('tbllogo', $Where);

			echo "Record Deleted Successfully!";

		break;

		

		// Add Banner

		case "AddBanner":

			if(empty($_FILES["fileToUpload"]["name"]) && empty($_POST['ID']))

			{

				echo "Please select banner!"; 

				die;	

			}

			else

			{

			// Upload Image

			$fileName = $_FILES["fileToUpload"]["name"];

			if(!empty($fileName))

			{

			$fileTempName = $_FILES["fileToUpload"]["tmp_name"];

			$folderName = "images/banners";
			UploadImage($fileName, $fileTempName, $folderName);

			}

			}

			$ID = $_POST['ID'];

			$arr = array("banner_status" => $_POST['banner_status'],

						"banner_image" => $_POST['fileToUpload']);

			if(empty($ID))

			{ 

				$nLastId = InsertRec("tblbanner", $arr);

			}

			else

			{

				if(!empty($_POST['fileToUpload']))

				{

				// Remove file from folder

				$Where = " banner_id = '".$ID."' ";

				$nRecUser = GetRecord('tblbanner', $Where);

				$file = "images/banners/".$nRecUser['banner_image'];

				unlink($file);

				UpdateRec('tblbanner', "banner_id = '$ID'",$arr);

				}

				else 

				{

					$arr1 = array("banner_status" => $_POST['banner_status']);

					UpdateRec('tblbanner', "banner_id = '$ID'",$arr1);

				}
			}

			echo "2"; die;		

			break;
			// Delete Banner

		case "DeleteBanner":

			$DelID = $_REQUEST['DelID'];

			$Where = " banner_id = '".$DelID."' ";
			// Remove file from folder

			$nRecUser = GetRecord('tblbanner', $Where);

			$file = "images/banners/".$nRecUser['banner_image'];

			unlink($file);
			// Delete record from table

			$nRec = DeleteRec('tblbanner', $Where);

			echo "Record Deleted Successfully!";

		break;

		

		// Add Text

		case "AddText":

			if(empty($_POST["textname"]))

			{

				echo "Please enter text!"; 

				die;	

			}

			else

			{

			$ID = $_POST['ID'];
			if(isset($_POST['text_bold']))
				$_POST['text_bold'] = "1";
					
			$arr = array("marque_text" => $_POST['textname'],
						"text_status" => $_POST['text_status'],
						"text_color" => $_POST['text_color'],
						"text_bold" => $_POST['text_bold']);

			if(empty($ID))

			{ 

				$nLastId = InsertRec("tbltext", $arr);

			}

			else

			{

					UpdateRec('tbltext', "text_id = '$ID'",$arr);

			}
			}

			header("Location: view_text");		

			break;
			// Delete Text

		case "DeleteText":

			$DelID = $_REQUEST['DelID'];

			$Where = " text_id = '".$DelID."' ";
			$arr = array("text_status" => '0');

			UpdateRec('tbltext', "text_id = '$ID'",$arr);			

			echo "Record Deleted Successfully!";

		break;

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

		// Add Post Notification

		case "AddPostNotification":

			if(empty($_POST["textname"]))

			{

				echo "Please enter text!"; 

				die;	

			}

			else

			{
			// Upload Image
			$fileName = $_FILES["fileToUpload"]["name"];
			//echo $fileName; die;
			if(!empty($fileName))
			{
			$fileName = generateRandomString(5).$fileName;	
			$fileTempName = $_FILES["fileToUpload"]["tmp_name"];
			$folderName = "../unique/images/notification_images";
			UploadImage($fileName, $fileTempName, $folderName);
			}	

			$ID = $_POST['ID'];
			if(isset($_POST['text_bold']))
				$_POST['text_bold'] = "1";
					
			$arr = array("marque_text" => $_POST['textname'],
						"text_status" => $_POST['text_status'],
						"text_color" => $_POST['text_color'],
						"text_image" => $fileName,
						"date" => date("Y-m-d H:i:s"),
						"text_bold" => $_POST['text_bold']);

			if(empty($ID))

			{ 

				$nLastId = InsertRec("tblnotification", $arr);

			}

			else

			{
				if(!empty($_POST['fileToUpload']))

				{

				// Remove file from folder

				$Where = " text_id = '".$ID."' ";

				$nRecUser = GetRecord('tblnotification', $Where);

				$file = "../unique/images/notification_images/".$nRecUser['text_image'];

				unlink($file);

				UpdateRec('tblnotification', "text_id = '$ID'",$arr);

				}

				else 

				{

					$arr = array("marque_text" => $_POST['textname'],
						"text_status" => $_POST['text_status'],
						"text_color" => $_POST['text_color'],
						"date" => date("Y-m-d H:i:s"),
						"text_bold" => $_POST['text_bold']);

					UpdateRec('tblnotification', "text_id = '$ID'",$arr);

				}

					//UpdateRec('tblnotification', "text_id = '$ID'",$arr);

			}
			}

			header("Location: view_post");		

			break;
		
		// Delete Text

		case "DeletePost":

			$DelID = $_REQUEST['DelID'];

			$Where = " text_id = '".$DelID."' ";
			$arr = array("text_status" => '0');

			UpdateRec('tblnotification', $Where, $arr);			

			echo "1";

		break;

		
		// Add Top Banner

		case "AddTopBanner":

			if(empty($_FILES["fileToUpload"]["name"]) && empty($_POST['ID']))

			{

				echo "Please select banner!"; 

				die;	

			}

			else

			{

			// Upload Image

			$fileName = $_FILES["fileToUpload"]["name"];

			if(!empty($fileName))

			{

			$fileTempName = $_FILES["fileToUpload"]["tmp_name"];

			$folderName = "images/top_banners";
			UploadImage($fileName, $fileTempName, $folderName);

			}

			}

			$ID = $_POST['ID'];

			$arr = array("banner_status" => $_POST['banner_status'],

						"banner_image" => $_POST['fileToUpload']);

			if(empty($ID))

			{ 

				$nLastId = InsertRec("tbltopbanner", $arr);

			}

			else

			{

				if(!empty($_POST['fileToUpload']))

				{

				// Remove file from folder

				$Where = " banner_id = '".$ID."' ";

				$nRecUser = GetRecord('tbltopbanner', $Where);

				$file = "images/top_banners/".$nRecUser['banner_image'];

				unlink($file);

				UpdateRec('tbltopbanner', "banner_id = '$ID'",$arr);

				}

				else 

				{

					$arr1 = array("banner_status" => $_POST['banner_status']);

					UpdateRec('tbltopbanner', "banner_id = '$ID'",$arr1);

				}
			}

			echo "upload"; die;		

			break;
			// Delete Top Banner

		case "DeleteTopBanner":

			$DelID = $_REQUEST['DelID'];

			$Where = " banner_id = '".$DelID."' ";
			// Remove file from folder

			$nRecUser = GetRecord('tbltopbanner', $Where);

			$file = "images/top_banners/".$nRecUser['banner_image'];

			unlink($file);
			// Delete record from table

			$nRec = DeleteRec('tbltopbanner', $Where);

			echo "Record Deleted Successfully!";

		break;
			

		// Add Employee
		case "AddEmployee":
			$ID = $_POST['ID'];
			$arr = array("employee_name" => $_POST['employee_name'],
						"employee_email" => $_POST['employee_email']);
			if(empty($ID))
			{ 
				$nLastId = InsertRec("tblemployee", $arr);
			}
			else
			{
				UpdateRec('tblemployee', "employee_id = '$ID'",$arr);
			}
				header("Location: view_employee");
		break;

		// Delete Employee
		case "DeleteEmployee":

			$DelID = $_REQUEST['DelID'];
			$Where = " employee_id = '".$DelID."' ";
			$nRec = DeleteRec('tblemployee', $Where);

			echo "Record Deleted Successfully!";

		break;

		// Check exist fields
		case "CheckValue":
			$value = $_REQUEST['value'];
			$table = $_REQUEST['table'];
			$field_name = $_REQUEST['field_name'];
			$Where = " $field_name = '".$value."' ";
			$nRecUser = GetRecord("$table", $Where);
			if(!empty($nRecUser["$field_name"]))
			{echo json_encode(array('true' => 'ok'));}
			else
			{echo 'false';}
			
	
		break;
		
		
		// Add bank text
		case "AddBankText":
			
			$ID = '1';
			$arr = array("bank_accounts_text" => $_POST['bank_text']);
			$Where = "bank_id = '$ID'";
			$nRecUser = GetRecord("tblbanktext", $Where);
			if(empty($nRecUser["bank_accounts_text"]))
			{ 
				$nLastId = InsertRec("tblbanktext", $arr);
			}
			else
			{
				UpdateRec('tblbanktext', "bank_id = '$ID'",$arr);
			}	
			header("Location: bank");
		
		break;

		// Add persoanl info
		case "AddPersonalInfo":
			
			$ID = '1';
			$arr = array("text_details" => $_POST['text_details']);
			$Where = "text_id = '$ID'";
			$nRecUser = GetRecord("tblpersonaltext", $Where);
			if(empty($nRecUser["text_details"]))
			{ 
				$nLastId = InsertRec("tblpersonaltext", $arr);
			}
			else
			{
				UpdateRec('tblpersonaltext', "text_id = '$ID'",$arr);
			}	
			header("Location: personal_info");
		
		break;

		// Update Payment Status
		case 'UpdatePaymentStatus':
			$array = array();
			$date = date("Y-m-d");
			$today_status_id = TodayPaymentStatusId($date,"tblepayment", (int)$_POST['selected_value']);
			$current_id = $_POST['current_id'];
			$Where = "id = '$current_id'";
			// Check update status
			$nRecStatus = GetRecord("tblepayment", $Where);
			if($nRecStatus['update_status'] == 0 && $_SESSION["user_type"] == 2)
			{
				$arr = array("payment_status" => $_POST['selected_value'], "update_status" => 1, "is_active" => 1, 'update_user_id' => $_SESSION["nUserId"], 'today_status_id' => $today_status_id);
				UpdateRec('tblepayment', $Where, $arr);
				//echo "2";	
				$array['value'] = 2;
			}
			else
			{
				$arr = array("payment_status" => $_POST['selected_value'], "is_active" => 1, 'update_user_id' => $_SESSION["nUserId"], 'today_status_id' => $today_status_id);
				UpdateRec('tblepayment', $Where, $arr);
				//echo "1";
				$array['value'] = 1;
			}
			$nRec = GetRecord("tblepayment", $Where);
			$array['user_id'] = $nRec['user_id'];
			echo json_encode($array);
		break;

		// Update Visa Status
		case 'UpdateVisaStatus':
			$current_id = $_POST['current_id'];
			$Where = "id = '$current_id'";
			// Check update status
			$nRecStatus = GetRecord("tblumrah", $Where);
			if($nRecStatus['visa_status'] == 0 && $_SESSION["user_type"] == 2)
			{
				$arr = array("visa_status" => $_POST['selected_value'], "visa_status" => 1, "is_active" => 1, 'update_user_id' => $_SESSION["nUserId"]);
				UpdateRec('tblumrah', $Where, $arr);
				echo "2";	
			}
			else
			{
				$arr = array("visa_status" => $_POST['selected_value'], "is_active" => 1, 'update_user_id' => $_SESSION["nUserId"]);
				UpdateRec('tblumrah', $Where, $arr);
				echo "1";
			}
		break;

		// Update Ticket Status
		case 'UpdateTicketStatus':
			$current_id = $_POST['current_id'];
			$Where = "id = '$current_id'";
			// Update amount in account statment
			$user_id = $_POST['user_id'];
			$WhereAccount = "id = '$current_id' AND user_id = '$user_id'";
			$nRecAccount = GetRecord("tblissuerefund", $WhereAccount);
			$issu_amount = RemoveComma(number_format($nRecAccount['amount']));
			// Get Current balance
			$WhereBalance = "client_id = '$user_id' AND staus_id = 1"; // AND staus_id = 0
			$nRecBalance = GetRecord("tblavailablebalance", $WhereBalance);
			$current_balance = RemoveComma(number_format($nRecBalance['available_balance']));
			$current_available_balance = $current_balance + $issu_amount;
			// Set status 0 to keep record history
			$arrUpdate = array("staus_id" => 0);
			$WhereUpdate = "client_id = '$user_id' AND staus_id = 1"; // AND staus_id = 0
			UpdateRec('tblavailablebalance', $WhereUpdate, $arrUpdate);
			// insert new balance
			$arrBalance = array("available_balance" => $current_available_balance,
					"staus_id" => 1,
					"client_id" => $user_id,
					"date" => date("Y-m-d H:i:s"));
			InsertRec('tblavailablebalance', $arrBalance);

			// Check update status
			$nRecStatus = GetRecord("tblissuerefund", $Where);
			if($nRecStatus['update_status'] == 0 && $_SESSION["user_type"] == 2)
			{
				$arr = array("ticket_status" => $_POST['selected_value'], "update_status" => 1, "is_active" => 1, 'update_user_id' => $_SESSION["nUserId"], "update_status_date_time" => date("Y-m-d H:i:s"));
				UpdateRec('tblissuerefund', $Where, $arr);
				echo "2";	
			}
			else
			{
				$arr = array("ticket_status" => $_POST['selected_value'], "is_active" => 1, 'update_user_id' => $_SESSION["nUserId"], "update_status_date_time" => date("Y-m-d H:i:s"));
				UpdateRec('tblissuerefund', $Where, $arr);
				echo "1";
			}
		break;

		// Update Request Status
		case 'UpdateRequestStatus':
			$current_id = $_POST['current_id'];
			$Where = "id = '$current_id'";
			// Check update status
			$nRecStatus = GetRecord("tblgrouprequest", $Where);
			if($_SESSION["user_type"] == 2)
			{
				$arr = array("request_status" => $_POST['selected_value'], "update_status" => 1, "update_user_id" => $_SESSION["nUserId"], "is_active" => 1);
				UpdateRec('tblgrouprequest', $Where, $arr);
				echo "2";	
			}
			else
			{
				$arr = array("request_status" => $_POST['selected_value'], "update_user_id" => $_SESSION["nUserId"], "is_active" => 1);
				UpdateRec('tblgrouprequest', $Where, $arr);
				echo "1";
			}
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

		// Get Visa Docs Name
		case 'GetVisaDocsImageName':
			$current_id = $_POST['current_id'];
			$Where = "id = '$current_id'";
			$nRecUser = GetRecord("tblumrah", $Where);
			echo $nRecUser['visa_docs'];
		break;

		// Update Ticket
		case 'UpdateTicket':
			$edit_id = $_POST['edit_id'];
			$arr1 = array(
				"pax_name" => $_POST['pax_name'],
				"sector" => $_POST['sector'],
				"pnr" => $_POST['pnr'],
				"amount" => RemoveComma($_POST['amount']),
				"edit_rows_status" => 1);
			UpdateRec('tblissuerefund', "id = '$edit_id'",$arr1);
			header("Location: view_ticket");
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
				        <td>".$arrSex[$row['sex'] -1 ]."</td>
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
				        <td>".$arrVisaType[$row['visa_type'] - 1]."</td>
				      </tr>
				      <tr>
				        <th style='width: 200px;'>No. of Days</th>
				        <td>".$row['no_of_days']."</td>
				      </tr>
				    </tbody>
				  </table>";
	 	break;

		// Upload Visa Docs
		case 'UploadVisaDocs':
			//print_r($_POST); die;
			$visa_doc_id = $_POST['visa_doc_id'];
			// Upload Image
			$fileName = $_FILES["fileToUpload"]["name"];
			//$fileName = generateRandomString(5).$fileName;
			if(!empty($fileName))
			{
			$fileTempName = $_FILES["fileToUpload"]["tmp_name"];
			$folderName = "../unique/images/visa_docs";
			UploadImage($fileName, $fileTempName, $folderName);
			}
			$Where = "id = '$visa_doc_id'";
			// Check update status
			$arr = array("visa_docs" => $fileName);
			UpdateRec('tblumrah', $Where, $arr);
			
			echo "1";
		break;

		// Update Amount Comments
		case 'UpdateAmountComments':
			$request_id = $_POST['request_id'];
			$Where = "id = '$request_id'";
			// Check update status
			$arr = array("amount" => $_POST['amount'],
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

		// Update Umrah
	 case "UpdateUmrah":

	 		$edit_id = $_POST['edit_id'];
	 		$Where = "id = '$edit_id'";
			$nRec = GetRecord("tblumrah", $Where);	
			// Upload Image
			$fileName = $_FILES["fileToUpload"]["name"];
			if(!empty($fileName))
			{
			$fileName = generateRandomString(5).$fileName;	
			$fileTempName = $_FILES["fileToUpload"]["tmp_name"];
			$folderName = "../unique/images/user_passport";
			UploadImage($fileName, $fileTempName, $folderName);
			}
			else
			{
				$fileName = $nRec['upload_passport'];
			}
			$arr = array(
				"user_id" => $_SESSION["client_id"],
				"package_code" => $_POST['package_code'],
				"upload_passport" => $fileName,
				"relation" => $_POST['Relation'],
				"sur_name" => $_POST['sur_name'],
				"given_name" => $_POST['given_name'],
				"father_husband_name" => $_POST['father_husband_name'],
				"sex" => $_POST['Sex'],
				"date_of_birth" => $_POST['dob'],
				"place_of_birth" => $_POST['place_of_birth'],
				"passport_no" => $_POST['passport_no'],
				"passport_issue_date" => $_POST['passport_issue_date'],
				"passport_expire_date" => $_POST['passport_expire_date'],
				"cnic_no" => $_POST['cnic'],
				"cnic_issue_date" => $_POST['cnic_issue_date'],
				"cnic_expire_date" => $_POST['cnic_expiry_date'],
				"address_cnic" => $_POST['Address_CNIC'],
				"visa_type" => $_POST['Visa_type'],
				"no_of_days" => $_POST['No_of_Days'],
				"date_created" => date("Y-m-d H:i:s")
				);
				$nLastId = UpdateRec("tblumrah", $Where ,$arr);
			
			header("Location: view_visa?msg=edit");
		
	 break;

	

	// getAllFranchizeUsers
	case 'getAllFranchizeUsers':
		$SQL = "SELECT user_id, user_name FROM tbluser WHERE user_type = '0' ORDER BY user_name";			
		$result = MySQLQuery($SQL);
		$str = "";
		while($row = mysql_fetch_array($result)) {
			 $str = "<div class='col-lg-3' style='padding-left: 0px;'>";
              $str .= "<p style='padding-left: 0px;' class='text-left col-sm-9'>".$row['user_name']."</p>";
              $str .= "<input class='' name='franchize_users[".$row['user_id']."]' type='checkbox' value='".$row['user_id']."' id='".$row['user_id']."'>";
            $str .= "</div>"; 
            echo $str;
		}
		
	break;

	// Update Supervised Ticket
	case 'UpdateSupervisedTicket':
		$current_id = $_POST['current_id'];
		$is_supervised = $_POST['is_supervised'];
		$Where = "id = '$current_id'";
		// Check update status
		$arr = array("is_supervised" => $is_supervised);
		UpdateRec('tblissuerefund', $Where, $arr);
		echo "2";
	break;

	// Update Supervised Payment
	case 'UpdateSupervisedPayment':
		$current_id = $_POST['current_id'];
		$is_supervised = $_POST['is_supervised'];
		$Where = "id = '$current_id'";
		// Check update status
		$arr = array("is_supervised" => $is_supervised);
		UpdateRec('tblepayment', $Where, $arr);
		echo "2";
	break;

	// Issue OR Refund
		case "IssueOrRefund":
			$arr = array("pax_name" => $_POST['pax_name'],
						"sector" => $_POST['sector'],
						"amount" => RemoveComma($_POST['amount']),
						"pnr" => $_POST['pnr'],
						"air_line_id" => $_POST['air_line_id'],
						"mode_type" => $_POST['mode_type'],
						"user_id" => $_POST["user_id"],
						"date" => date("Y-m-d H:i:s")
						);

			$nLastId = InsertRec("tblissuerefund", $arr);
			header("Location: issue_or_refund?msg=sent");
		break;

	case "AddPayment":
			// Upload Image
			$fileName = $_FILES["fileToUpload"]["name"];
			//echo $fileName; die;
			if(!empty($fileName))
			{
			$fileName = generateRandomString(5).$fileName;	
			$fileTempName = $_FILES["fileToUpload"]["tmp_name"];
			$folderName = "../unique/images/payment_scan_images";
			UploadImage($fileName, $fileTempName, $folderName);
			}
			//$fileName = generateRandomString(5).$fileName; 
			$arr = array("amount" => RemoveComma($_POST['Amount']),
						"transection_id" => $_POST['transection_id'],
						"bank_id" => $_POST['bank_id'],
						"user_id" => $_POST["user_id"],
						"bank_slip_image" => $fileName,
						"date" => date("Y-m-d H:i:s")
						);

			$nLastId = InsertRec("tblepayment", $arr);
			header("Location: payment?msg=sent");	
		break;	

		// Add Ticket Comments
		case 'AddTicketComments':
			//print_r($_POST);
			// user_comment
			$comment_id = $_POST['comment_id'];
			$text_comments = trim($_POST['text_comments']);
			$Where = "id = '$comment_id'";
			// Check update status
			$arr = array("user_comment" => $text_comments);
			UpdateRec('tblissuerefund', $Where, $arr);

			$Where = "id = '$comment_id'";
			$nRec = GetRecord("tblissuerefund", $Where);
			if(!empty($nRec['user_comment']))
				echo $nRec['user_comment'];
			else
				echo "";
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

		// UpdateCommissions
		case 'UpdateCommissions':
			$current_id = $_POST['current_id'];
			$current_value = str_replace(",", "", $_POST['current_value']);
			$Where = "id = '$current_id'";
			// Check update status
			$arr = array("user_commisions" => $current_value);
			UpdateRec('tblissuerefund', $Where, $arr);
			echo "2";
		break;

		// CreateCommissionForms
		case 'CreateCommissionForms':
		//print_r($_POST); die;
		$edit_action_id = $_POST['edit_action_id'];
		$Where = "id = '$edit_action_id'";
		$date = date("Y-m-d");
		$today_status_id = TodayStatusId($date,"tblissuerefund", (int)$_POST['ticket_status']);
		//var_dump($today_status_id); die;
			$arr = array(
			    "basic_fare" => RemoveComma($_POST['basic_fare']),
			    "tax" => RemoveComma($_POST['tax']),
			    "actual_fare_total" => RemoveComma($_POST['hdn_actual_fare_total']),
			    "clint_psf_percent" => RemoveComma($_POST['client_percent_rec_comm']), 
			    "clint_psf_percent_value" => RemoveComma($_POST['client_rec_comm_total']),
			    "hdn_total_amount" => RemoveComma($_POST['hdn_total_amount']),
			    "refund_charges" => RemoveComma($_POST['hdn_refund_charges']),
			    "service_charges" => RemoveComma($_POST['hdn_service_charges']),
			    "amount" => RemoveComma($_POST['hdn_receivable_charges']),
			    "ven_percent_rec_comm" => RemoveComma($_POST['ven_percent_rec_comm']),
			    "vendor_rec_comm_total" => RemoveComma($_POST['vendor_rec_comm_total']),
			    "user_commisions" => RemoveComma($_POST['hdn_commissions']),
			    "vendor_id" => $_POST['view_vendor'],
			    "update_status_date_time" => date("Y-m-d H:i:s"),
			    "ticket_status" => $_POST['ticket_status'],
			    'today_status_id' => $today_status_id,
			    "update_user_id" => $_SESSION['nUserId'],
			    "is_active" => 1
			);
			UpdateRec('tblissuerefund', $Where, $arr);
			$nRec = GetRecord("tblissuerefund", $Where);
			echo $nRec['user_id'];
		break;

		// AddVendor
		case "AddVendor":

			if(empty($_POST["vendor_name"]))

			{

				echo "Please enter Vendor!"; 

				die;	

			}

			else

			{

			$ID = $_POST['ID'];
			$arr = array("vendor_name" => $_POST['vendor_name']);
			if(empty($ID))
			{ 

				$nLastId = InsertRec("tblvendor", $arr);

			}

			else

			{

					UpdateRec('tblvendor', "vendor_id = '$ID'",$arr);

			}
			}

			header("Location: view_vendor");		

			break;
			// Delete vendor

		case "DeleteVendor":

			$DelID = $_POST['DelID'];
			$Where = " vendor_id = '".$DelID."' ";
			DeleteRec('tblvendor', "vendor_id = '$DelID'");			
			echo "2";

		break;

		// UpdateVendor
		case 'UpdateVendor':
			$current_id = $_POST['current_id'];
			$current_value = $_POST['current_value'];
			$Where = "id = '$current_id'";
			// Check update status
			$arr = array("vendor_id" => $current_value, "vendor_status" => 1);
			UpdateRec('tblissuerefund', $Where, $arr);
			echo "2";
		break;

		// GetCommisionsData
		case 'GetCommisionsData':
			$current_id = $_POST['current_id'];
			$Where = "id = '$current_id'";
			$getArray = GetRecord('tblissuerefund', $Where);
			//print_r($agetArray);
			echo json_encode($getArray);
		break;

		// change password
		case "ChangePassword":
			$old_password = md5($_POST['old_password']);
			$new_password = md5($_POST['new_password']);
			
			$Where = "user_id = '".$_SESSION['nUserId']."'";
			$nRecUser = GetRecord('tbluser', $Where);
			if($old_password == $nRecUser['user_password'])
			{
				$arr = array('user_password' => $new_password);
				$nLastID = UpdateRec('tbluser', "user_id = '".(int)$_SESSION['nUserId']."'",$arr);			
				header("Location: change_password.php?msg=true");		
			}
			else
				header("Location: change_password.php?msg=false");
					
		break;

		// UpdateASI
		case 'UpdateASI':
			$current_id = $_POST['current_id'];
			$current_value = str_replace(",", "", $_POST['current_value']);
			$Where = "id = '$current_id'";
			// Check update status
			$arr = array("asi_no" => $current_value);
			UpdateRec('tblissuerefund', $Where, $arr);
			echo "2";
		break;

		// UpdateASIPayment
		case 'UpdateASIPayment':
			$current_id = $_POST['current_id'];
			$current_value = str_replace(",", "", $_POST['current_value']);
			$Where = "id = '$current_id'";
			// Check update status
			$arr = array("asi_no" => $current_value);
			UpdateRec('tblepayment', $Where, $arr);
			echo "2";
		break;

		// Update User Tickets
		case 'UpdateUserTickets':
		$selected_ids = "";
		if(isset($_POST['selected_id']))
		{
			$selected_ids = $_POST['selected_id'];
			$selected_ids = implode(',', $selected_ids);
		}
			print_r($selected_ids); die;
		break;
		
	}



?>