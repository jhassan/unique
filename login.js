function getLogin()
{
debugger;
if((document.getElementById('user').value=="")||(document.getElementById('pass').value==""))
{
alert("Please fill the username or password.");
return false;
}
document.forms[0].action="http://www.travelsonya.com/subagent/ASP/new_weblanding.aspx";
document.forms[0].submit();
}





//======== script for forgot password=======
var xmlHttp;
var url;
var is_ie = (navigator.userAgent.indexOf("MSIE") >= 0) ? 1 : 0;
var is_ie5 = (navigator.userAgent.indexOf("MSIE 5.5") != -1) ? 1 : 0;
var is_opera = (navigator.userAgent.indexOf("Opera6") != -1) ? 1 : 0 || (navigator.userAgent.indexOf("Opera/6") != -1) ? 1 : 0;
var is_netscape = (navigator.userAgent.indexOf("Netscape") >= 0) ? 1 : 0;

function Forgot() {
//debugger;
    var Email = document.getElementById('EmaiL').value
    if (Email != "") {
        url = "http://" + window.location.host + "/Online/Sonya/forgotPassword.aspx?Email=" + Email + "&CID=SS";  //"/SahibJI/UserControl/forgotPassword.aspx?Email=" + Email + "&CID=ST&type=forgot";
       
        xmlHttp = GetXmlHttpObject1(ChangeHandlerSupl);
        xmlHttp_Get(xmlHttp, url);
    }
    else 
    {
        alert("Please Enter Email ID");
        return false;
    }
}


function GetXmlHttpObject1(handler) {
//debugger ;
    var objXmlHttp = null; //Create the local xmlHTTP object instance 
    //Create the xmlHttp object depending on the browser 
    if (is_ie) {
        //if not IE default to Msxml2 
        var strObjName = (is_ie5) ? "Microsoft.XMLHTTP" : "Msxml2.XMLHTTP";
        //Create the object 
        try {
            objXmlHttp = new ActiveXObject(strObjName);
            objXmlHttp.onreadystatechange = handler;
        }
        catch (e) {
            //Object creation error 
            alert("Object cannot be created");
            return;
        }
    }
    else if (is_opera) {
        alert("Opera browser");
        return;
    }
    else {
        // other browsers eg mozilla , netscape and safari 
        objXmlHttp = new XMLHttpRequest();
        objXmlHttp.onload = handler;
        objXmlHttp.onerror = handler;
    }

    //Return the instantiated object 
    return objXmlHttp;
}

function ChangeHandlerSupl() 
{
//debugger;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
        alert(xmlHttp.responseText);
        Popup.hide('modal');
        return false;
        
    }


}
function xmlHttp_Get(xmlhttp, url) {
    xmlhttp.open("GET", url, false);
    xmlhttp.send(null);
}

function MeClear() {
    document.getElementById('EmaiL').value = "";
}