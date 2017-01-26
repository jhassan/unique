<?

	error_reporting(E_ERROR | E_WARNING | E_PARSE);

	ini_set("register_globals", 1);

	session_start();

	include_once('config.php');



	// open a connection with MySQL server

	// display an error message if connection

	// was not properly openned

	Function MySQLConnect()

	{

		$success= mysql_pconnect($GLOBALS["DB_Server"], $GLOBALS["DB_Username"], $GLOBALS["DB_Password"]);

		//var_dump($success); die;

		if (!$success)

			echo mysql_errno() . ": " . mysql_error() . "<BR>\r\n";



	}

 

	// send a query to MySQL server.

	// display an error message if there

	// was some error in the query

	Function MySQLQuery($query)

	{

		$success= mysql_db_query($GLOBALS["DB_DBName"], $query);



		if(!$success)

		{	

			echo mysql_errno().": ".mysql_error()."<BR>";

			echo "<hr>";

			echo $query;

			echo "<hr>\r\n";

		}

		

		if(substr($query, 0, 6) != "select") // for all queries other than SELECT

		{

			$strLog = $query . " - " . mysql_errno() . " - " . mysql_error();

		//	logToFile($strLog);		// log to file

		}

		

		return $success;

	}



	/*	the function remove single quote from the string

		and replace it with two single quotes



		strString:		string to be fixed

		returns:		fixed string

	*/

	function FixString($strString)

	{

		$strString = str_replace("'", "''", $strString);

		$strString = str_replace("\'", "'", $strString);

		

		return $strString;

	}



	/*	the function returns true if strString contains

		strFindWhat within itself otherwise it returns

		false



		strString:		string to be searched in

		strFindWhat:	string to be searched

		returns:		true if found, flase otherwise

	*/

	function HasString($strString, $strFindWhat)

	{

		$nPos = strpos($strString, $strFindWhat);

		

		if (!is_integer($nPos)) 

			return false;

		else

			return true;

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

		if(empty($strCriteria))

			$strQuery = "select count(*) as cnt from $strTable;";

		else

			$strQuery = "select count(*) as cnt from $strTable where $strCriteria;";

	

		$nResult = MySQLQuery($strQuery);

		$rstRow = mysql_fetch_array($nResult);

		return $rstRow["cnt"];

	}

	/*
		the function displays combox box

		nSelectedVal:		index of selected value
		arr:				array containig items to be displayed
		bIndexValue:		true: use array index as item value e.g: 0, 1, 2, ...
							false: use array value as item value e.g: 2003, 2004, 2005, ...
	*/
	function ComboBox($nSelectedVal, $arr, $bIndexValue)
	{
		for($i=0; $i < sizeof($arr); $i++)
		{
			$j = $i+1;
			
			if($bIndexValue)
				if($j == $nSelectedVal)
					echo "<option value=$j selected>" . $arr[$i] . "\r\n";
				else
					echo "<option value=$j>" . $arr[$i] . "\r\n";
			else
				if($nSelectedVal == $arr[$i])
					echo "<option selected>" . $arr[$i] . "\r\n";
				else
					echo "<option>" . $arr[$i] . "\r\n";
		}
	}


	/*
		the function draws combo box fitted in table row by
		using the function ComboBox();
	*/
	function ArrayComboBox($strName, $nSelectedVal, $arr, $bIndexValue = true, $strOnChange = "", $strFirstOption = "", $strClass="", $Style="")
	{
		
		if(empty($strOnChange))
		{
			echo "		<select name='$strName' id='$strName' style='$Style' class='$strClass'>";
			if(!empty($strFirstOption))
			echo "<option value=''>$strFirstOption</option>";
		}
		else
		{
			echo "<select name=$strName id=$strName onChange=\"javascript: $strOnChange\" style='$Style' class=$strClass><br>";
			if(!empty($strFirstOption))
			echo "<option value=''>$strFirstOption</option>";
		}
		ComboBox($nSelectedVal, $arr, $bIndexValue);
		echo "		</select>";
			
	}



	/*	the function returns an associative array containing

		the field names and their type



		strTable:		table name to be described

		returns:		associative array, for instance:

							"user_id" => "int(11)"

							"user_name" => "varchar(32)"						 

	*/

	function DescTable($strTable)

	{

		$strQuery = "desc $strTable";

		$nResult = MySQLQuery($strQuery);



		$arrArray = array();



		while($rstRow = mysql_fetch_array($nResult))

		{

			$arrArray[$rstRow["Field"]] = $rstRow["Type"];

		}



		return $arrArray;

	}



	/* the function updates the given table.

	

		strTable:		table name to be updates.

		strWhere:		where clause for record selection.

		arrValue:		an associated array with key-value of fields

						to be updated.

	*/

	function UpdateRec($strTable, $strWhere, $arrValue)

	{

		$strQuery = "	update $strTable set ";



		reset($arrValue);



		while (list ($strKey, $strVal) = each ($arrValue))

		{

			$strQuery .= $strKey . "='" . FixString($strVal) . "',";

		}



		// remove last comma

		$strQuery = substr($strQuery, 0, strlen($strQuery) - 1);



		$strQuery .= " where $strWhere;";

//echo $strQuery; die;

		// execute query

		MySQLQuery($strQuery);		

	}



	/*	the function insert a record in strTable with

		the values given by the associated array



		strTable:		table name where record will be inserted

		arrValue:		assoicated array with key-val pairs

		returns:		ID of the record inserted

	*/

	function InsertRec($strTable, $arrValue)

	{

		$strQuery = "	insert into $strTable (";



		reset($arrValue);

		while(list ($strKey, $strVal) = each($arrValue))

		{

			$strQuery .= $strKey . ",";

		}



		// remove last comma

		$strQuery = substr($strQuery, 0, strlen($strQuery) - 1);



		$strQuery .= ") values (";



		reset($arrValue);

		while(list ($strKey, $strVal) = each($arrValue))

		{

			$strQuery .= "'" . FixString($strVal) . "',";

		}



		// remove last comma

		$strQuery = substr($strQuery, 0, strlen($strQuery) - 1);

		$strQuery .= ");";



		// execute query

		//echo $strQuery;

		MySQLQuery($strQuery);

		//echo $strQuery . "<br>";

		

		// return id of last insert record

		return mysql_insert_id();

	}



	// the function returns the assocatied array containing

	// the field name and field value pair for record.

	//

	// strTable:		table name.

	// strCriteria:		where criteria

	//

	function GetRecord($strTable, $strCriteria)

	{

		$strQuery = "select * from $strTable ";



		if(!empty($strCriteria))

			$strQuery .= "where $strCriteria;";

		

		$nResult = MySQLQuery($strQuery);



		return mysql_fetch_array($nResult);

	}



	/*	the function deletes the record from the

		given table.



		strTable:		table name.

		strCriteria:	where criteria

	*/

	function DeleteRec($strTable, $strCriteria)

	{

		$strQuery = "delete from $strTable where $strCriteria";

		MySQLQuery($strQuery);

	}

	

	function TextField($strLabel, $strField, $strValue, $nMaxLength, $nDivWidth, $strClass, $bPassword="", $strExtra="")

	{

		$str = '';

		$str .="<div class='form-group m-b-0 col-lg-".$nDivWidth."'>";

		if(!empty($strLabel))

			$str .="<label>".$strLabel."</label>";

			//$strLabel = empty($strValue) ? 0 : $strLabel;

			//$strLabel = $strValue == "0.00%" ? "0.00%" : $strLabel;

			if(empty($bPassword))

				$str .="<input type='text' class=\"$strClass\" placeholder=\"$strLabel\" name=\"$strField\" id=\"$strField\" value=\"$strValue\" maxlength='".$nMaxLength."' class=\"$strClass\" $strExtra>";

			else

				$str .="<input type='password' class='form-control required' placeholder=\"$strLabel\" name=\"$strField\" id=\"$strField\" value=\"$strValue\" maxlength='".$nMaxLength."' class=\"$strClass\" $strExtra>";

		$str .="</div>";

		echo $str;

	}

	

	

	function TextField2($strLabel, $strField, $strValue, $nMaxLength, $nDivWidth, $strClass, $bPassword="", $strStyle="", $strScript = "")

	{

		$str = '';

		$strValue = empty($strValue) ? 0 : $strValue;

		if(empty($strValue) && (strpos($strClass, 'number_only') !== false))

			$strLabel = 0;

		else if($strValue == "0.00%")

		{

			$strLabel = "0.00%";

			$strValue = "0";

		}

		$str .="<div class='form-group m-b-0 txt-box p-0 col-lg-".$nDivWidth."'>";

			if(empty($bPassword))

				$str .="<input type='text' class=\"$strClass\" name=\"$strField\" id=\"$strField\" value=\"$strValue\" maxlength='".$nMaxLength."' class=\"$strClass\" style=\"$strStyle\" $strScript>"; // placeholder=\"$strLabel\"

			else

				$str .="<input type='password' name=\"$strField\" id=\"$strField\" value=\"$strValue\" maxlength='".$nMaxLength."' class=\"$strClass\" style=\"$strStyle\" \"$strScript\">"; //placeholder=\"$strLabel\"

		$str .="</div>";

		echo $str;

	}

	

	/*

		the function draws a check box in the form

		

		strLabel:			label in the left column

		strName:			name of check box in HTML form

		nChecked:			if true, checkbox will appear checked

							otherwise it appears unchecked

	*/

	function CheckBox($strLabel, $strName, $nChecked = false)

	{

		echo "<tr><td></td><td>";

		

		if($nChecked == true)

			echo "<input type=checkbox name=$strName CHECKED> $strLabel";

		else

			echo "<input type=checkbox name=$strName> $strLabel";

		

		echo "</td></tr>";

	}

	

	/*

		the function draws a 4 check box in the for

		

		strLabel:			label in the left column

		strName:			name of check box in HTML form

		nChecked:			if true, checkbox will appear checked

							otherwise it appears unchecked

	*/

	function CheckBox4($strLabel, $strName, $nChecked = false)

	{

		echo "<tr>

				<td>

					$strLabel

				</td>";

		

		if($nChecked == true)

		{

			echo "<td><input type=checkbox name= ".$strName ."_view CHECKED></td> ";

			echo "<td><input type=checkbox name= ".$strName ."_edit CHECKED></td> ";

			echo "<td><input type=checkbox name= ".$strName ."_delete CHECKED></td> ";

			echo "<td><input type=checkbox name= ".$strName ."_add CHECKED></td> ";

		}	

		else

		{

			echo "<td><input type=checkbox name= ".$strName. "_view ></td>";

			echo "<td><input type=checkbox name= ".$strName. "_edit ></td>";

			echo "<td><input type=checkbox name= ".$strName. "_delete ></td>";

			echo "<td><input type=checkbox name= ".$strName. "_add ></td>";

		}

		echo "</tr>";

	}



	//end of check box

	

	function ReadOnlyField($strLabel, $strField, $strValue, $nSize, $nMaxLength, $strExtra="")

	{

		echo "<tr>";

		echo "	<td>";

		echo		$strLabel;

		echo "	</td>";

		echo "	<td>";

		echo "		<input type=text name=$strField value=\"$strValue\" size=$nSize maxlength=$nMaxLength $strExtra READONLY>";		

		echo "	</td>";

		echo "</tr>";

	}



	

	/*

		funtcion Maintain Log

		Module 		: 		Contact, tickte, Visa etc

		Action 		: 		Insert, Edit, Delete etc

		Document Type :		Contact. Inv, Vou etc

		Document No :		contact peson ID, Voucher no v/2/2014

		Remarks 	 :		Progfile Changed, Amount Change

		Computer Name : 	Jawad-PC

		User Name 	  :  	Login User Name		

	*/

		function MainTainUserLog($strModuleName = "", $strAction = "", $strDocType = "", $strDocNo = "", $strRemarks = "", $strComputerName = "", $strUserName = "")

		{

			$arr = array("log_module" => $strModuleName,

							"log_action" => $strAction,

							"log_doc_type" => $strDocType,

							"log_doc_no" => $strDocNo,

							"log_date" => date("Y-m-d"),

							"log_computer_name" => $_SERVER["REMOTE_ADDR"],

							"log_user_name" => $strUserName,

							"log_remarks" => $strRemarks);

			$nInsert = InsertRec("tblLog", $arr);

		}

	



	/*

		the function shows a combo box with values from a table



		strTable:			table name

		strDispField:		field name to show

		strIDField:			id field name

		strCriteria:		select criteria for where clause

		strName:			combo name

		nSelId:				id of selected record

		strOnChange			JS to be executed onChange event

		strFirstItem		complete html code for the first item in combo (for: All or <blank>)

	*/

	function TableCombo($strLabel, $strTable, $strDispField, $strIDField, $strCriteria, $strName, $nSelId, $strOnChange = "", $strFirstItem = "")

	{

		echo "<tr><td valign=middle valign=top>$strLabel</td><td>";

	

		if(empty($strCriteria))

			$strQuery = "select $strDispField, $strIDField from $strTable";



		else

			$strQuery = "select $strDispField, $strIDField from $strTable where $strCriteria";



		$nResult = MySQLQuery($strQuery);



		if(empty($strOnChange))

			echo "<select name=$strName id=$strName><br>";

		else

			echo "<select name=$strName id=$strName onChange=\"javascript: $strOnChange\"><br>";

			

		if(!empty($strFirstItem)) echo $strFirstItem;		



		while($rstRow = mysql_fetch_array($nResult))

		{

			$nID = $rstRow[$strIDField];



			if($nID == $nSelId)

				echo "<option value=$nID selected>" . $rstRow[$strDispField] . "\r\n";

			else

				echo "<option value=$nID>" . $rstRow[$strDispField] . "\r\n";

		}

		

		echo "</td></tr>";

	}

	

	function TableComboMsSql($strTable, $strDispField, $strIDField, $strCriteria, $strName, $nSelId, $strOnChange = "", $strFirstItem = "", $strClass="", $CssStyle="")

		 {

		  

		  if(empty($strCriteria))

		   $strQuery = "select $strDispField, $strIDField from $strTable order by $strDispField";

		  else

		   $strQuery = "select $strDispField, $strIDField from $strTable where $strCriteria  order by $strDispField";

		  #$nResult = MySQLQuery($strQuery);

		  $nResult = MySQLQuery($strQuery);

		  if(empty($strOnChange))

		   echo "<select name=$strName id=$strName class=$strClass style=$CssStyle><br>";

		  else

		   echo "<select name=$strName id=$strName class=$strClass style=$CssStyle onChange=\"javascript: $strOnChange\"><br>";

		   

		  if(!empty($strFirstItem)) echo $strFirstItem;  



		  while($rstRow = mysql_fetch_array($nResult))

		  {

		   $nID = $rstRow[$strIDField];



		   if($nID == $nSelId)

			echo "<option value=$nID selected>" . $rstRow[$strDispField] . "\r\n";

		   else

			echo "<option value=$nID>" . $rstRow[$strDispField] . "\r\n";

		  }

		  

		  echo "</select>";

		 }

	

	/*

		the function select multiple values in combo box with values from a table



		strTable:			table name

		strDispField:		field name to show

		strIDField:			id field name

		strCriteria:		select criteria for where clause

		strName:			combo name

		nSelId:				id of selected record

		strOnChange			JS to be executed onChange event

		strFirstItem		complete html code for the first item in combo (for: All or <blank>)

	*/

	function TableComboMultipleSelection($strLabel, $strTable, $strDispField, $strIDField, $strCriteria, $strName, $nSelId, $strOnChange = "", $strFirstItem = "")

	{

		echo "<tr><td valign=middle valign=top>$strLabel</td><td>";

	

		if(empty($strCriteria))

			$strQuery = "select $strDispField, $strIDField from $strTable";

		else

			$strQuery = "select $strDispField, $strIDField from $strTable where $strCriteria";



		$nResult = MySQLQuery($strQuery);



		if(empty($strOnChange))

			echo "<select name=".$strName."[] id=$strName multiple='multiple'><br>";

		else

			echo "<select name=$strName id=$strName onChange=\"javascript: $strOnChange\"><br>";

			

		if(!empty($strFirstItem)) echo $strFirstItem;		



		while($rstRow = mysql_fetch_array($nResult))

		{

			$nID = $rstRow[$strIDField];



			if($nID == $nSelId)

				echo "<option value=$nID>" . $rstRow[$strDispField] . "\r\n";

			else

				echo "<option value=$nID>" . $rstRow[$strDispField] . "\r\n";

		}

		

		echo "</td></tr>";

	}



	// connect to database

	MySQLConnect();

	if(($_SERVER["SCRIPT_NAME"] != $strLoginScriptPath) && (PHP_SAPI != "cli"))

	{

		$strWhere = "user_login = '" . $_SESSION["strLogin"] . "' and user_password = '" . $_SESSION["strPassword"] . "' and ( user_type = 1 OR user_type = 2)";

		$rstRow = GetRecord("tbluser", $strWhere);

		// if we have not found this user

		if(empty($rstRow["user_id"]))

		{

			header("Location: index?error=1");

			exit;

		}

		else

		{

			$_SESSION["nUserId"] = $rstRow["user_id"];

			$_SESSION["strUserName"] = $rstRow["user_name"];

			$_SESSION["strUserAdmin"] = $rstRow["user_admin"];

			$_SESSION["nEnableDisable"] = $rstRow["user_disabled"];

			$_SESSION["staff_permissions"] = $rstRow["staff_permissions"];

			$_SESSION["user_type"] 			= $rstRow["user_type"];



		

		}

	}

	else

	{echo "out"; die;}

	

	// Get air line names

	function AirLinesCode($UserID)

	{

		$Code = "";

		$strQuery  = "SELECT tblairlines.* 

						FROM `tbluserairlines` INNER JOIN `tblairlines` 

						ON `tblairlines`.`air_line_id` = `tbluserairlines`.`air_line_id` 

						WHERE `tbluserairlines`.`user_id` = '".(int)$UserID."' ";

		$nResult = MySQLQuery($strQuery);	

		while($rstRow = mysql_fetch_array($nResult)){

		$Code .= $rstRow["air_line_code"].",";

		}

		return rtrim($Code,",");

	}

	

	

	function AirLinesCode1($airLineID)

	{

		$Code = "";

		$str = explode(",",$airLineID);

		foreach($str as $ID)

		{

			$strQuery  = "SELECT air_line_code FROM tblairlines WHERE air_line_id = '".(int)$ID."'";

			$nResult = MySQLQuery($strQuery);	

			$rstRow = mysql_fetch_array($nResult);

			$Code .= $rstRow["air_line_code"].",";

		}

			return rtrim($Code,",");

	}

	function AirLinesName($airLineID)

	{

			$strQuery  = "SELECT air_line_name FROM tblairlines WHERE air_line_id = '".(int)$airLineID."'";

			$nResult = MySQLQuery($strQuery);	

			$rstRow = mysql_fetch_array($nResult);

			$Name .= $rstRow["air_line_name"];
			return $Name;
	}


	function UserName($ID)

	{

			$strQuery  = "SELECT user_name FROM tbluser WHERE user_id = '".(int)$ID."'";

			$nResult = MySQLQuery($strQuery);	

			$rstRow = mysql_fetch_array($nResult);

			$Name .= $rstRow["user_name"];
			return $Name;
	}

	

	function generateRandomString($length) 

	{

		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

		$charactersLength = strlen($characters);

		$randomString = '';

		for ($i = 0; $i < $length; $i++) {

			$randomString .= $characters[rand(0, $charactersLength - 1)];

		}

		return $randomString;

	}

	

	// Upload Image

	function UploadImage($fileName, $fileTempName, $folderName)

	{

		//$random_no = generateRandomString(5);

			$target_dir = "$folderName/";

			$target_file = $target_dir . basename($random_no.$fileName);

			$uploadOk = 1;

			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

			// Check if image file is a actual image or fake image

			if(isset($_POST["submit"])) {

				$check = getimagesize($fileTempName);

				if($check !== false) {

					echo "File is an image - " . $check["mime"] . ".";

					$uploadOk = 1;

				} else {

					echo "File is not an image.";

					$uploadOk = 0;

					die;

				}

			}

			

			// Check if file already exists

			if (file_exists($target_file)) {

				echo "Sorry, file already exists.";

				$uploadOk = 0;

				die;

			}

			// Check file size

			if ($_FILES["fileToUpload"]["size"] > 1000000) {

				echo "Sorry, your file is too large.";

				$uploadOk = 0;

				die;

			}

			// Allow certain file formats

			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"

			&& $imageFileType != "gif" ) {

				echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";

				$uploadOk = 0;

				die;

			}

			// Check if $uploadOk is set to 0 by an error

			if ($uploadOk == 0) {

				echo "Sorry, your file was not uploaded.";

				die;

			// if everything is ok, try to upload file

			} else {

				if (move_uploaded_file($fileTempName, $target_file)) {

					$_POST['fileToUpload'] = $random_no.$fileName;

					$n = 1;

				} else {

					echo "Sorry, there was an error uploading your file.";

					$n = 0;

					die;

				}

			}

			return $n;	

	}

	

	

?>

