<html>
<script language="javascript" src="http://eticket.shaheenair.com/js/jquery.js"></script>

 <script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
function jumpto(url){
//alert("hello");
//break;
//window.frames.mainFrame.location="http://www.google.com";
parent.mainFrame.location = url;
}
function submenu(x)
{
	if(x == "Monitor")
	{
	Show("MonSubLayer");
	}
	
	if(x == "Reports")
	{
        jumpto('sales/tkt_reports.php?cc=1');
	Show("ReportsSubLayer");
	}

	if(x == "Reports2")
	{
        jumpto('sales/tkt_uplift.php?cc=1');

	Show("ReportsSubLayer2");
	}
	
	if(x == "Cancel")
	{
	Show("CancelSubLayer");
	}

}

function Show(x)
{
	
	if(x=="MasterLayer")
	{


	MasterLayer.style.visibility = "visible";
	ReportsSubLayer.style.visibility = "hidden";
	ReportsSubLayer2.style.visibility = "hidden";
	MonSubLayer.style.visibility = "hidden";	

	}
	

	if(x=="MonSubLayer")
	{
	MasterLayer.style.visibility = "hidden";
	ReportsSubLayer.visibility = "hidden";
	ReportsSubLayer2.visibility = "hidden";
	MonSubLayer.style.visibility = "visible";	
	}

	if(x=="ReportsSubLayer")
	{
	MasterLayer.style.visibility = "hidden";
	MonSubLayer.style.visibility = "hidden";	
	ReportsSubLayer2.visibility = "hidden";
	ReportsSubLayer.style.visibility = "visible";
	}
	if(x=="ReportsSubLayer2")
	{
	ReportsSubLayer.visibility = "hidden";
	MasterLayer.style.visibility = "hidden";
	MonSubLayer.style.visibility = "hidden";	
	ReportsSubLayer2.style.visibility = "visible";
	}


	if(x=="CancelSubLayer")
	{
//	alert("Cancel");
//	MasterLayer.visiblity = "hidden";
//	MonSubLayer.visiblity = "visible";
	}
	


}
/*
	jQuery(document).ready(function () {
    		setInterval("$('.r_e').fadeOut().fadeIn();",1500);
	});

*/
</script>
<style type="text/css">
<!--
.rescss {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	line-height: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
}
.rescssheadings {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-style: normal;
	line-height: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	color: #000066;
}

.r_e{

	background-color: #FF0;
	color: #F00;
	padding:3px 1px;
	font-size:13px;
	font-weight:bold;
	width:100%;
	text-align:center;
	margin-bottom:3px;

}

-->
</style>
<link href="http://eticket.shaheenair.com/resstyle.css" rel="stylesheet" type="text/css">
<p class="rescss">&nbsp;</p>

<p>&nbsp; </p>
<div id="MasterLayer" style="position:absolute; width:161px; height:70px; 
z-index:2; left: 1px; top: 1px;"> 
  <div align="center"><span class="rescssheadings"></span> <br>    
	<input name="button0" type="button" class="rescss" 
style="background-color:9932CC; font-size: 14px; border-style: groove; 
border-width: 1; font-family: Verdana; font-weight=bold; color:white; width:100px; 
height:50px;" onClick="jumpto('http://eticket.shaheenair.com/booking/availability.php')"  value="Availability"> 
    
    <input name="button0" type="button" class="rescss" 
style="background-color:87CEFA; font-size: 14px; border-style: groove; 
border-width: 1; font-family: Verdana; font-weight=bold; color:black; width:100; 
height:50px;" onClick="jumpto('http://eticket.shaheenair.com/refund')"  value="Refund">   
   

<input name="button0" type="button" class="rescss" 
style="background-color:D2691E; font-size: 14px; border-style: groove; 
border-width: 1; font-family: Verdana; font-weight=bold; color:white; width:100; 
height:50px;" onClick="jumpto('http://eticket.shaheenair.com/reoperate/split.php')"  value="SPLIT PNR">   


    <input name="button0" type="button" class="rescss" 
style="background-color:FFF8DC; font-size: 14px; border-style: groove; 
border-width: 1; font-family: Verdana; font-weight=bold; color:black; width:100; 
height:50px;" onClick="jumpto('http://eticket.shaheenair.com/reoperate/index.php?ri=1')"  value="Re-issue">   

   <input name="button0" type="button" class="rescss" 
style="background-color:B22222; font-size: 14px; border-style: groove; 
border-width: 1; font-family: Verdana; font-weight=bold; color:white; width:100; 
height:50px;" onClick="jumpto('http://eticket.shaheenair.com/sales/tkt_agent_sales_detail.php?cc=1')"  value="Reports">   

 
   <input name="button0" type="button" class="rescss" 
style="background-color:ADFF2F; font-size: 10.5px; border-style: groove; 
border-width: 1; font-family: Verdana; font-weight=bold; color:white; width:100; 
height:50px;" onClick="jumpto('http://eticket.shaheenair.com/res/pnrn_modify.php?code=1')"  value="PNR Modification">   

<input name="button0" type="button" class="rescss" 
style="background-color:20B2AA; font-size: 10.5px; border-style: groove; 
border-width: 1; font-family: Verdana; font-weight=bold; color:white; width:100; 
height:50px;" onClick="jumpto('http://eticket.shaheenair.com/logout.php')"  value="Logout">   

  </div>
<p class="rescss">&nbsp;</p>
<p class="rescssheadings">&nbsp;</p>

<body leftmargin="2">

</body>
</html>
