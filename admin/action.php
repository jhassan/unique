<?php
	session_start();

	ob_start();

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
						'staff_permissions' => $arrayChickList,
						'user_type' => $_POST['user_type']);

			if(empty($_POST['nUserID']))

				$nLastID = InsertRec("tbluser", $arr);

			else

			{

				$nLastID = UpdateRec('tbluser', "user_id = '".(int)$_POST['nUserID']."'",$arr);

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

			$fileTempName = $_FILES["fileToUpload"]["tmp_name"];

			$folderName = "images/air_lines";
			UploadImage($fileName, $fileTempName, $folderName);

			}

			}

			$ID = $_POST['ID'];

			$arr = array("air_line_name" => $_POST['air_line_name'],

						"air_line_code" => $_POST['air_line_code'],

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

			echo "upload"; die;		

			//header("Location: view_air_lines");

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

		

		// Delete Users

		case "DeleteUsers":

			$DelID = $_REQUEST['DelID'];

			$arrAirLine = array(

						'user_status' => '0');

			$nLastID = UpdateRec('tbluser', "user_id = '".(int)$DelID."'",$arrAirLine);

			echo "Record Deleted Successfully!";

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

			echo "upload"; die;		

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

		// Update Payment Status
		case 'UpdatePaymentStatus':
			$current_id = $_POST['current_id'];
			$Where = "id = '$current_id'";
			// Check update status
			$nRecStatus = GetRecord("tblepayment", $Where);
			if($nRecStatus['update_status'] == 0 && $_SESSION["user_type"] == 2)
			{
				$arr = array("payment_status" => $_POST['selected_value'], "update_status" => 1);
				UpdateRec('tblepayment', $Where, $arr);
				echo "2";	
			}
			else
			{
				$arr = array("payment_status" => $_POST['selected_value']);
				UpdateRec('tblepayment', $Where, $arr);
				echo "1";
			}
		break;

		// Update Visa Status
		case 'UpdateVisaStatus':
			$current_id = $_POST['current_id'];
			$Where = "id = '$current_id'";
			// Check update status
			$nRecStatus = GetRecord("tblumrah", $Where);
			if($nRecStatus['visa_status'] == 0 && $_SESSION["user_type"] == 2)
			{
				$arr = array("visa_status" => $_POST['selected_value'], "visa_status" => 1);
				UpdateRec('tblumrah', $Where, $arr);
				echo "2";	
			}
			else
			{
				$arr = array("visa_status" => $_POST['selected_value']);
				UpdateRec('tblumrah', $Where, $arr);
				echo "1";
			}
		break;

		// Update Ticket Status
		case 'UpdateTicketStatus':
			$current_id = $_POST['current_id'];
			$Where = "id = '$current_id'";
			// Check update status
			$nRecStatus = GetRecord("tblissuerefund", $Where);
			if($nRecStatus['update_status'] == 0 && $_SESSION["user_type"] == 2)
			{
				$arr = array("ticket_status" => $_POST['selected_value'], "update_status" => 1);
				UpdateRec('tblissuerefund', $Where, $arr);
				echo "2";	
			}
			else
			{
				$arr = array("ticket_status" => $_POST['selected_value']);
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
				$arr = array("request_status" => $_POST['selected_value'], "update_status" => 1, "update_user_id" => $_SESSION["nUserId"]);
				UpdateRec('tblgrouprequest', $Where, $arr);
				echo "2";	
			}
			else
			{
				$arr = array("request_status" => $_POST['selected_value']);
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
				"pin" => $_POST['pin'],
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

	}



?>