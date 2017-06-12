<?
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	ini_set("register_globals", 1);
	session_start();
	include_once('config.php');
	date_default_timezone_set('Asia/Karachi');
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
		//echo $strQuery; die;
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
	
	// the function displays the records from the given table
	// in an nicely formatted HTML table with edit and delete
	// icons along every record. It also displays next and
	// previous links to browse the entire table.
	//
	// strTable:		Table name to be shown.
	// strCriteria:		Expression for where cluase, if empty no where.
	//					is added to the query and all records from
	//					the table are selected.
	// strOrderBy:		Field names for order by clause.
	// strField:		Field name to be displayed
	// strScript:		Script name to be used for new, edit and delete
	// nRows:			Number of rows to be shown per page.
	// nStart:			Start offset of record.
	// strNewLink:		Extra parameters with new link.
	// strNewTarget:	link target on New link
	// strCallBack:		Function given in this argument is called at the end
	//					of each record.
	//
	function ShowTable($strTable, $strCriteria, $strOrderBy, 
						$strField, $strScript, $nRows, $nStart, $strNewLink, $strNewTarget,
						$strCallBack = null, $strEditTarget = null)
	{
		$strColor1 = "#86A8EC";
		$strColor2 = "#D8D8D8";

		// if $arrAddlLinks is null
		if($arrAddlLinks == null)
			$arrAddlLinks = array();		
		
		// if we are not passed any starting value
		if(empty($nStart))
			$nStart = 0;		// lets start from scratch

		$nNext = $nStart + $nRows;
		$nPrev = $nStart - $nRows;
		$nTotalRec = RecCount($strTable, $strCriteria);

		if(!empty($strNewTarget))

			$strNewTarget = "target=$strNewTarget";

		echo "<table width=100%>";
		echo "	<tr>";
		echo "		<td width=5%><a $strNewTarget href='new_$strScript?nStart=$nStart&$strNewLink'>New</a>&nbsp;&nbsp;</td>";
		
		$nShowingStart = $nStart+1;
		if($nStart+$nRows > $nTotalRec)			
			$nShowingEnd = $nTotalRec;
		else
			$nShowingEnd = $nShowingStart + $nRows - 1;

		echo "<td align=right>";

		if($nTotalRec)
		{
			if ($nPrev > -1)
				echo "<a href='$PHP_SELF?nStart=$nPrev&$strNewLink'><! img src='images/previous.gif' border=0></a>";
			else
				echo "<! img src='images/previous.gif'>";
			
			echo "<! img src='horz_bubble.php?nStart=$nShowingStart&nEnd=$nShowingEnd&nTotal=$nTotalRec'>";

			if ($nNext < $nTotalRec)
				echo "<a href='$PHP_SELF?nStart=$nNext&$strNewLink'><! img src='images/next.gif' border=0></a>";
			else
				echo "<! img src='images/next.gif'>";
		}
		
		echo "</td>";

		// display all admins from tblAdmin
		if (empty($strCriteria))
			$strQuery = "select * from $strTable ";
		else
			$strQuery = "select * from $strTable where $strCriteria ";

		echo "	</td></tr>";
		echo "	<tr><td colspan=3><hr></td></tr>";
		echo "</table>";
		echo "<table width=100%>";

		if(!empty($strOrderBy))
			$strQuery .= " order by $strOrderBy ";

		$strQuery .= " limit $nStart, $nRows;";
		$nResult = MySQLQuery($strQuery);

		while($rstRow = mysql_fetch_array($nResult))
		{
			reset($arrAddlLinks);
			$nId = $rstRow[0];

			$strBGColor = " bgcolor=" . ($bColor ? $strColor1 : $strColor2);
			
			echo "<tr>";
			echo "	<td $strBGColor width=20 align=center valign=top>";
			echo "		<a $strEditTarget href='edit_$strScript?nId=$nId&nStart=$nStart'><img src='images/icon_edit.gif' border=0 alt='Edit'></a>";
			echo "	</td>";
			echo "	<td $strBGColor width=20 align=center valign=top>";
			echo "		<a href='del_$strScript?nId=$nId&nStart=$nStart' onClick=\"return confirm('Are you sure you want to delete this?');\"><img src='images/icon_delete.gif' border=0 alt='Delete'></a>";
			echo "	</td>";
			echo "	<td $strBGColor valign=top>";
			echo		$rstRow[$strField];
			echo "	</td>";
			
			if(!empty($strCallBack))
			{
				echo "	<td $strBGColor>";

				// callback function		
				eval("echo $strCallBack(\$rstRow);");
      				
				echo "\r\n</td>";
			}

			echo "</tr>";
			$bColor = !$bColor;
		}

		echo "</table>";
	}

	// the displays a text field in HTML row with two columns in it.
	// left column contains label and right column contains the
	// text field.
	//
	// strLabel:			Label in left column.
	// strField:			Text field name in form.
	// strValue:			Value to be shown in text field.
	// nSize:				Size attribute of text field.
	// nMaxLength:			Max length attribute of text field.
	// bPassword:			1 if to be displayed as password, 0 as text
	// strExtra				to write some thing extra like some onClick="alert('I'm Good')"
	//
	
	function TextField($strLabel, $strField, $strValue, $nMaxLength, $nDivWidth, $strClass, $bPassword="", $strExtra="")
	{
		$str = '';
		$str .="<div class='form-group m-b-0 col-lg-".$nDivWidth."'>";
		if(!empty($strLabel))
			$str .="<label>".$strLabel."</label>";
			//$strLabel = empty($strValue) ? 0 : $strLabel;
			//$strLabel = $strValue == "0.00%" ? "0.00%" : $strLabel;
			if(empty($bPassword))
				$str .="<input type='text' class=\"$strClass\" placeholder=\"$strLabel\" name=\"$strField\" id=\"$strField\" value=\"$strValue\" maxlength='".$nMaxLength."' class=\"$strClass\" \"$strExtra\">";
			else
				$str .="<input type='password' class='form-control required' placeholder=\"$strLabel\" name=\"$strField\" id=\"$strField\" value=\"$strValue\" maxlength='".$nMaxLength."' class=\"$strClass\" \"$strExtra\">";
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


	// the displays a read only text field for as date field in HTML row with two columns in it.
	// left column contains label and right column contains the

	// text field.
	//
	// strLabel:			Label in left column.
	// strField:			Text field name in form.
	// strValue:			Value to be shown in text field.
	// nSize:				Size attribute of text field.
	// nMaxLength:			Max length attribute of text field.
	// strFormName:			Name of HTML form	
	//
	function DateField($strLabel, $strField, $strValue, $nSize, $nMaxLength, $strFormName)
	{
		$strUnique = time();
		echo "<tr>";
		echo "	<td>";
		echo		$strLabel;
		echo "	</td>";
		echo "	<td>";
		
		echo  "		
				<input type=text name='$strField' value='$strValue' size=$nSize maxlength=$nMaxLength readonly>
				<a href=\"JavaScript: CalPop_".$strUnique."('document.$strFormName.$strField');\"><img src='/images/ico-cal.gif' border=0></a>
			<script>
				function CalPop_".$strUnique."(sInputName)
				{
					window.open('/include/code/calender.php?strFieldName=' + escape(sInputName) , 'CalPop', 'toolbar=0,width=240,height=215');
				}
			</script>
			";
		
		echo "	</td>";
		echo "</tr>";
	}
	
	function CalendarWithoutTable($strField, $strDate="")
	{
		$myCalendar = new tc_calendar($strField);
		$myCalendar->setIcon("images/iconCalendar.gif");
		
		if(empty($strDate))
			$myCalendar->setDate(date('d'), date('m'), date('Y'));
		else
		{
			$arr = explode("-", $strDate);
			$myCalendar->setDate($arr[2], $arr[1], $arr[0]);
		}
		
		$myCalendar->setPath("calendar/");
		$myCalendar->setYearInterval(1970, 2030);
		$myCalendar->dateAllow(date("2000-01-01"), '2030-12-31', false);
		$myCalendar->startMonday(true);
		$myCalendar->disabledDay("Fri");
		$myCalendar->writeScript();
	}
	
	// Display the inline calendar control
	function Calendar($strLabel, $strField, $strDate="")
	{
		echo "<tr>";
		echo "	<td valign=top>";
		echo		$strLabel;
		echo "	</td>";
		echo "	<td>";

		CalendarWithoutTable($strField, $strDate);

		echo "	</td>";
		echo "</tr>";
	}
	
	// Same as Calendar() except that it submits to form URL 
	// when a date is selected.
	function CalendarAutoSubmit($strLabel, $strField, $strForm, $strDate="")
	{
		echo "<tr>";
		echo "	<td valign=top>";
		echo		$strLabel;
		echo "	</td>";
		echo "	<td>";

		$myCalendar = new tc_calendar($strField);
		$myCalendar->setIcon("images/iconCalendar.gif");
		
		if(empty($strDate))
			$myCalendar->setDate(date('d'), date('m'), date('Y'));
		else
		{
			$arr = explode("-", $strDate);
			$myCalendar->setDate($arr[2], $arr[1], $arr[0]);
		}
		
		$myCalendar->setPath("calendar/");
		$myCalendar->setYearInterval(1970, 2020);
		$myCalendar->dateAllow('2008-05-13', '2015-03-01', false);
		$myCalendar->startMonday(true);
		$myCalendar->disabledDay("Fri");
		$myCalendar->autoSubmit(true, $strForm);
		$myCalendar->writeScript();

		echo "	</td>";
		echo "</tr>";
	}
	
	/*	the function displays OK and Cancel buttons in the form

	*/
	function OKCancelButtons()
	{
		echo "<tr>";
		echo "	<td></td>";
		echo "	<td>";
		echo "		<input type=submit id='ok-button' value='   OK   '>";
		echo "</tr>";
	}

	/*	the function creates an hidden field
		
		strName:		name of hidden field
		strValue:		value to be passed in hidden field
	*/
	function HiddenField($strName, $strValue)
	{
		echo "<input type=hidden id='$strName' name='$strName' value='$strValue'>\r\n";
	}

	/*	the function creates a text area
		
		strLabel:			Label in left column.
		strField:			Text field name in form.
		strValue:			Value to be shown in text field.
		nRows:				number of rows in text area
		nCols:				number of columsn in text area
	*/	
	function TextArea($strLabel, $strField, $strValue, $nRows, $nCols)
	{
		echo "<tr>";
		echo "	<td valign=top>";
		echo		$strLabel;
		echo "	</td>";
		echo "	<td>";		
		echo "		<textarea id=$strField name=$strField rows=$nRows cols=$nCols>$strValue</textarea>";
		
		echo "	</td>";
		echo "</tr>";
	}

	/*
		the function creates a file upload widget on form.

		strLabel:			Label in left column
		strFileName:		File name	
	*/
	function FileUpload($strLabel, $strFileName)
	{
		echo "<tr>";
		echo "	<td valign=top>";
		echo		$strLabel;
		echo "	</td>";
		echo "	<td>";

		echo "<input type=file name='$strFileName' size=10>";

		echo "	</td>";
		echo "</tr>";
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
		the function shows the date combo box
	*/
	function DateCombo($strLabel, $strField, $strDate = "")
	{
		echo "<tr>";
		echo "	<td valign=middle>";
		echo		$strLabel;
		echo "	</td>";
		echo "	<td>";		

		if(empty($strDate))
			$strDate = date("Y-m-d");
			
		$strDate = strtok($strDate, " ");
		
		$strYr = strtok($strDate, "-");
		$strMn = strtok("-");
		$strDy = strtok("-");
		
		$arrYr = array();

	//	for($i = $strYr-50; $i <= ($strYr+5); $i++)
		for($i = 1920; $i <= 2020; $i++)
			array_push($arrYr, $i);

		$arrDay = array();
		for($i = 1; $i <= 31; $i++)
			array_push($arrDay, sprintf("%02d",$i));
		
		$strTemp = $strField . "Year";
		echo "<select id='$strTemp' name=$strTemp>";
		ComboBox($strYr, $arrYr, false);
		echo "</select>";

		$strTemp = $strField . "Month";
		echo "<select id='$strTemp' name=$strTemp>";
		$arr = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
		ComboBox($strMn, $arr, true);
		echo "</select>";

		$strTemp = $strField . "Date";
		echo "<select id='$strTemp' name=$strTemp>";
		ComboBox($strDy, $arrDay, false);
		echo "</select>";

		echo "	</td>";
		echo "</tr>";
	}

	/*
		the function shows time combox with first combo of hours and
		second combo of minutes.

		strTime:		time to show in combo
						Format: hh:mm[:ss]
	*/
	function TimeCombo($strLabel, $strField, $strTime)
	{
		$nHr = strtok($strTime, ":");
		$nMn = strtok(":");

		$arrHr = array();
		for($i = 0; $i <= 23; $i++)
			array_push($arrHr, $i);

		$strHr = $strField . "Hr";

		$arrMn = array();
		for($i = 0; $i <= 59; $i += 5)
			array_push($arrMn, $i);
		
		echo "<tr>";
		echo "	<td valign=top>";
		echo		$strLabel;
		echo "	</td>";
		echo "	<td>";
		echo "<select name=$strHr>";
		ComboBox(-1, $arrHr, true);
		echo "</select>";
		echo "<select name=$strMn>";
		ComboBox(-1, $arrMn, true);
		echo "</select>";
		echo "	</td>";
		echo "</tr>";
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

	/*
		the function creates radio buttons group

		strLabel:		lable to be shown in the right cell
		arrButtons:		the lables to be shown along radio buttons
		strName:		form name for the button group
		nSelIndex:		index of selected button
	*/
	function RadioButtons($strLabel, $arrButtons, $strName, $nSelIndex = -1)
	{
		echo "<tr>";
		echo "	<td valign=top>";
		echo		$strLabel;
		echo "	</td>";
		echo "	<td>";

		for($i=0; $i<sizeof($arrButtons); $i++)
			if($i == $nSelIndex)
				echo "<input type=radio value=$i name=$strName checked> &nbsp;" . $arrButtons[$i] . "<br>";	
			else
				echo "<input type=radio value=$i name=$strName> &nbsp;" . $arrButtons[$i] . "<br>";	

		echo "	</td>";
		echo "</tr>";
	}

	/*
		show text in left and right cells of table

		strLeft:		text to appear in left cell
		strRight:		text to appera in right cell
	*/
	function TextCells($strLeft, $strRight)
	{
		echo "<tr>";
		echo "	<td valign=top>";
		echo		$strLeft;
		echo "	</td>";
		echo "	<td valign=top>";
		echo		$strRight;
		echo "	</td>";
		echo "</tr>\r\n";
	}

	/*
		the function converts data format from SQL data format
		to Month date, Year format e.g November 18, 2003
	*/
	function ConvertDateFormat($strDate, $strFormat = "M j, Y")
	{
		return date($strFormat, strtotime($strDate));
	}



	// Function to draw HTML table within lookup POPUP
	//
	// strQuery				Source Query
	// strIdField			Title of ID field in DB
	// strTitleField		Title of TITLE field in DB	
	//
	function drawLookUpTable($strQuery, $strIdField, $strTitleField, 
		$nWidth = "100%", $strCallBack = null)
	{	
		global $strTitleFieldName, $strIdFieldName, $nId;
		
		$nResult = MySQLQuery($strQuery);

		echo "
			<html>
				<head>
					<title>Look Up</title>
				<head>
				<style>
					A {
						font-family : arial;
						color: black;
						font-size :  9pt;
						font-style :  normal;
						font-weight : none;
						text-decoration : underline;
						text-align: right;
					};
				
					td {
						font-family : arial;
						color: black;
						font-size :  9pt;
						font-style :  normal;
						font-weight : none;
						text-align: left;				
					}				
				</style>
				<body>
			";
		echo "<table width=$nWidth><tr><td bgcolor=silver><table cellspacing=1 border=0 cellpadding=3 width=$nWidth>\r\n";
		$nI = 0;
		while($nRow = mysql_fetch_array($nResult))
		{
			$nI++;
			$nID = $nRow[$strIdField];
			$strTitle = $nRow[$strTitleField];
			
			if(empty($strCallBack))
			{
				if($nID == $nId)
					echo "
						<tr bgcolor=lightblue>
							<td><a href=\"JavaScript: updateParent('$nID', '$strTitle')\">$nID</a></td>
							<td><a href=\"JavaScript: updateParent('$nID', '$strTitle')\">$strTitle</a></td>
						</tr>
					";
				else
					echo "
					<tr bgcolor=ffffff>
						<td><a href=\"JavaScript: updateParent('$nID', '$strTitle')\" class=NAV>$nID</a></td>
						<td><a href=\"JavaScript: updateParent('$nID', '$strTitle')\" class=NAV>$strTitle</a></td>
					</tr>
					";
			}
			else
			{
				$strScriptFunc = "updateParent";
				eval("echo $strCallBack(\$nRow, \$nId, \$strIdField, \$strTitleField, \$strScriptFunc);");
			}
		}
		echo "</table></td></tr></table>\r\n";
	
		echo "		
		<script>
			function updateParent(nId, strTitle)
			{			
				window.opener.eval('$strTitleFieldName').value = strTitle;
				window.opener.eval('$strIdFieldName').value = nId;
				window.close();
			}
		</script>
		</body>
		</html>
		";
	
	}

	// Function to create combo based on tblConfiguration
	//
	// strProperty				Key value to make comob of
	// strTableName				2nd Table name
	// strMatchField			Field name to match with conf_value
	// strMatchValue			Inpout match value
	// strTitleField			Field name to display in comobo
	// strObjName				Name of comobo
	// strLabel					Label to dispay for combo
	//
	function ConfigCombo($strProperty, $strTableName, $strMatchField, $strMatchValue, $strTitleField, $strObjName, $strLabel)
	{

		echo "<tr>\r\n";
		echo "	<td>\r\n";
		echo "		$strLabel\r\n";
		echo "	</td>\r\n";
		echo "	<td>\r\n";
		echo "		<SELECT name='$strObjName'>\r\n";
		

		$strQuery = "
						SELECT 
							* 
						FROM 
							tblConfiguration, 
							$strTableName
						WHERE
							conf_value = $strMatchField AND
							conf_key = '$strProperty'
					";
		$nResult = MySQLQuery($strQuery);
		while($nRow = mysql_fetch_array($nResult))
		{
			if($strMatchValue == $nRow[$strMatchField])
				echo "<option value='". $nRow[$strMatchField] ."' SELECTED>".$nRow[$strTitleField]."</option>\r\n";
			else
				echo "<option value='". $nRow[$strMatchField] ."'>".$nRow[$strTitleField]."</option>\r\n";
		}	


		echo "		</SELECT>\r\n";
		echo "	</td>\r\n";
		echo "</tr>\r\n";
	}

	// function returns the index of given strValue in array arrArray
	// returns -1 if no match found.
	function GetArrayIndex($arrArray, $strValue)
	{
		for($i=0; $i<count($arrArray); $i++)
			if($arrArray[$i] == $strValue)
				return $i;
				
		return -1;
	}

	/*
		Remove comma in a number
	
	*/
	
	function RemoveComma($No)
	{
		$No = str_replace(",","",$No);
		return str_replace(",","",$No);
	}
	

	// Get air line names
	function AirLinesCode($airLineID)
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

	function getUserIP()
	{
	    $client  = @$_SERVER['HTTP_CLIENT_IP'];
	    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	    $remote  = $_SERVER['REMOTE_ADDR'];

	    if(filter_var($client, FILTER_VALIDATE_IP))
	    {
	        $ip = $client;
	    }
	    elseif(filter_var($forward, FILTER_VALIDATE_IP))
	    {
	        $ip = $forward;
	    }
	    else
	    {
	        $ip = $remote;
	    }

	    return $ip;
	}

	// Create User Activity Log
	function activity_log($user_id, $activity_type, $status_id = "", $descriptions = "")
	{
		global $conn;
		$user_ip = getUserIP();
		$date_time = date("Y-m-d H:i:s");
		$strQuery = "INSERT INTO tbllog (user_id, computer_name , activity_type, status_id, date_time, descriptions)
				VALUES ('".(int)$user_id."', '".$user_ip."', '".$activity_type."', '".(int)$status_id."' ,'".$date_time."' ,'".$descriptions."')";
				//echo $sql_log; die;
		MySQLQuery($strQuery);	
	}
	
	// Send Email
	function SendEmail($to, $from, $subject, $message)
	{
		// Always set content-type when sending HTML email
		$headers .= 'From: '.$from.'' . "\r\n";
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$Email = mail($to, $subject, $message, $headers);
		if($Email)
			$str = "sent";
		else 
			$str = "not sent";
		return $str;	
	}
	
	// Get user email
	function UserEmail($employee_id)
	{
		$Where = "employee_id = '".$employee_id."'";
		$nRecUser = GetRecord('tblemployee', $Where);
		return $nRecUser['employee_email'];
	}

	function UserName($ID)

	{

			$strQuery  = "SELECT user_name FROM tbluser WHERE user_id = '".(int)$ID."'";

			$nResult = MySQLQuery($strQuery);	

			$rstRow = mysql_fetch_array($nResult);

			$Name .= $rstRow["user_name"];
			return $Name;
	}
	
	// connect to database
	MySQLConnect();
	//echo $_SERVER["SCRIPT_NAME"]."==========".$strLoginScriptPath; die;
	if(($_SERVER["SCRIPT_NAME"] != $strLoginScriptPath) && (PHP_SAPI != "cli"))
	{
		// echo $_SERVER["SCRIPT_NAME"]."==========".$strLoginScriptPath; die;
		$strWhere = "user_login = '" . $_SESSION["strLogin"] . "' and user_password = '" . $_SESSION["strPassword"] . "' and (user_status = 1 OR user_status = 3)";
		$rstRow = GetRecord("tbluser", $strWhere);
		//var_dump($rstRow["user_id"]); die;
		// if we have not found this user
		if(empty($rstRow["user_id"]))
		{
			header("Location: login_form?error=1");
			exit;
		}
		else
		{
		
			$_SESSION["client_id"] = $rstRow["user_id"];
			$_SESSION["employee_id"] = $rstRow["employee_id"];
			$_SESSION["strUserName"] = $rstRow["user_name"];
			$_SESSION["strUserAdmin"] = $rstRow["user_admin"];
			$_SESSION["nEnableDisable"] = $rstRow["user_disabled"];
			$_SESSION["franchize_user_permissions"] = $rstRow["franchize_user_permissions"];
			$_SESSION["user_type"] = $rstRow["user_type"];
			$_SESSION["staff_permissions"] = $rstRow["staff_permissions"];
			
			$strWhere = "user_id = '" . $_SESSION["client_id"] . "' and status_id = 1";
			$rstRow = GetRecord("tbllog", $strWhere);
			if(empty($rstRow["user_id"]))
			{
				activity_log($_SESSION["client_id"], 2, 1);
			}
		}
	}
	else
	{echo "out"; die;}

	function AirLinesName($airLineID)

	{

			$strQuery  = "SELECT air_line_name FROM tblairlines WHERE air_line_id = '".(int)$airLineID."'";

			$nResult = MySQLQuery($strQuery);	

			$rstRow = mysql_fetch_array($nResult);

			$Name .= $rstRow["air_line_name"];
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
			// var_dump($_FILES["fileToUpload"]["size"]); die;
			// if ($_FILES["fileToUpload"]["size"] > 1000000) {

			// 	echo "Sorry, your file is too large.";

			// 	$uploadOk = 0;

			// 	die;

			// }

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

					$_POST['fileToUpload'] = $fileName;

					$n = 1;

				} else {

					echo "Sorry, there was an error uploading your file.";

					$n = 0;

					die;

				}

			}

			return $n;	

	}

	// Get Today Invoice id
	function TodayInvoiceId($date, $table)
	{
		$strQuery  = "SELECT MAX(today_invoice_id) AS max_id FROM `".$table."` WHERE `date` LIKE '%".$date."%'";
		//echo $strQuery; die;
		$nResult = MySQLQuery($strQuery);	
		$rstRow = mysql_fetch_array($nResult);
		return $rstRow['max_id'] + 1;
	}

		
?>
