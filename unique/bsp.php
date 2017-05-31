<?php
session_start();
include_once('conn.php');
$SQL = "SELECT bsp_email, user_email  FROM tbluser WHERE user_id = ".(int)$_SESSION["client_id"].""; 
//echo $SQL;           
$result = mysqli_query($connection,$SQL);
$row = mysqli_fetch_array($result);
//print_r($row); die;
$user_email = $row['user_email'];
$bsp_email = $row['bsp_email'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1"><title>
	
        
    LOGIN

        :: Tours View		
    
</title><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" /><meta http-equiv="CACHE-CONTROL" content="NO-CACHE" /><meta http-equiv="content-type" content="text/html; charset=utf-8" /><link href="css/common.css" rel="Stylesheet" type="text/css" /><link id="cssLinkTheme" rel="Stylesheet" type="text/css" href="css/themes/ash/ibe/default.css" /><link href="css/smoothness/jquery-ui-1.8.17.custom.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>
    <script src="js/json2.js" type="text/javascript"></script>
    <script src="js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="js/additional-methods.js" type="text/javascript"></script>
    <script src="js/fc.functions-1.0.1.js" type="text/javascript"></script>
    <script src="js/jquery.maxlength-min.js" type="text/javascript"></script>
    <script src="js/common.js" type="text/javascript"></script>
    <script src="js/jquery.cookie.js" type="text/javascript"></script>
    <script src="js/localizate/jquery.ui.datepicker-en-US.js" type="text/javascript"></script>

    <!-- media queries css -->
    <link href="css/media-queries.css" rel="stylesheet" type="text/css" /></head>
<body>

    <form method="post" action="https://webstart.sabretnapac.com/unique-travel-tour/member-login.aspx?lasturl=%2funique-travel-tour%2fflight-search.aspx%3f" id="form1" class="clsForm">
<div class="aspNetHidden">
<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="" />
<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" />
<input type="hidden" name="__LASTFOCUS" id="__LASTFOCUS" value="" />
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUJMTQ5NTM5OTIzD2QWAmYPZBYEAgEPZBYEAgYPFgIeBGhyZWYFHmNzcy90aGVtZXMvYXNoL2liZS9kZWZhdWx0LmNzc2QCCQ8WAh4EVGV4dAVaPHNjcmlwdCBzcmM9ImpzL2xvY2FsaXphdGUvanF1ZXJ5LnVpLmRhdGVwaWNrZXItZW4tVVMuanMiIHR5cGU9InRleHQvamF2YXNjcmlwdCI+PC9zY3JpcHQ+ZAIDD2QWEAIBD2QWCgILDw8WAh4HVmlzaWJsZWhkZAINDw8WAh8CaGRkAg8PDxYCHwJoZGQCEQ8PFgIfAmhkZAITDw8WAh8CaGRkAgIPEGQPFgFmFgEQBQdFbmdsaXNoBQVlbi1VU2cWAWZkAgMPDxYCHwJoZGQCBA8PFgIfAmhkZAIFD2QWAmYPZBYGZg8WAh8BZWQCBA8PFgIfAQUEQkFDS2RkAgUPZBYCAgEPDxYCHghJbWFnZVVybAViaHR0cHM6Ly93ZWJzdGFydC5zYWJyZXRuYXBhYy5jb20vZmlsZXMvYWJhY3VzL3VzZXJmaWxlcy91bmlxdWUtdHJhdmVsLXRvdXIvbG9nby8yMDE2MDgyMDAyMjUxMi5wbmdkZAIGDw8WAh8CaGRkAgcPFgIfAWVkAggPFgIfAQW7EDxzY3JpcHQgdHlwZT0idGV4dC9qYXZhc2NyaXB0Ij4NCnZhciB1c2VyQWdlbnQgPSBuYXZpZ2F0b3IudXNlckFnZW50LCByTXNpZSA9IC8obXNpZVxzfHRyaWRlbnQuKnJ2OikoW1x3Ll0rKS8sIHJGaXJlZm94ID0gLyhmaXJlZm94KVwvKFtcdy5dKykvLA0Kck9wZXJhID0gLyhvcGVyYSkuK3ZlcnNpb25cLyhbXHcuXSspLywgckNocm9tZSA9IC8oY2hyb21lKVwvKFtcdy5dKykvLHJTYWZhcmkgPSAvdmVyc2lvblwvKFtcdy5dKykuKihzYWZhcmkpLzsNCnZhciBicm93c2VyOyB2YXIgdmVyc2lvbjt2YXIgdWEgPSB1c2VyQWdlbnQudG9Mb3dlckNhc2UoKTsNCmZ1bmN0aW9uIHVhTWF0Y2godWEpIHsNCnZhciBtYXRjaCA9IHJNc2llLmV4ZWModWEpOyBpZiAobWF0Y2ggIT0gbnVsbCkgeyByZXR1cm4gcGFyc2VJbnQobWF0Y2hbMl0gfHwgJzAnKSA+PSA5OyB9DQp2YXIgbWF0Y2ggPSByRmlyZWZveC5leGVjKHVhKTtpZiAobWF0Y2ggIT0gbnVsbCkge3JldHVybiBwYXJzZUludChtYXRjaFsyXSB8fCAnMCcpID49IDI2OyB9DQp2YXIgbWF0Y2ggPSByT3BlcmEuZXhlYyh1YSk7aWYgKG1hdGNoICE9IG51bGwpIHtyZXR1cm4gcGFyc2VJbnQobWF0Y2hbMl0gfHwgJzAnKSA+PSAxODsgfQ0KdmFyIG1hdGNoID0gckNocm9tZS5leGVjKHVhKTsgaWYgKG1hdGNoICE9IG51bGwpIHsgcmV0dXJuIHBhcnNlSW50KG1hdGNoWzJdIHx8ICcwJykgPj0gMzE7IH0NCnZhciBtYXRjaCA9IHJTYWZhcmkuZXhlYyh1YSk7IGlmIChtYXRjaCAhPSBudWxsKSB7IHJldHVybiBwYXJzZUludChtYXRjaFsxXSB8fCAnMCcpPj01IDsgfQ0KcmV0dXJuIGZhbHNlO30gICANCjwvc2NyaXB0Pg0KPGRpdiBpZD0nZGl2QkNEaWFsb2cnPg0KICAgIFZhbGlkYXRpbmcgRW52aXJvbm1lbnQuLi4NCiAgICA8YnIgLz4NCiAgICA8YnIgLz4NCkNoZWNraW5nIGNvb2tpZXMuLi48c3BhbiBpZD0ic3BDb29raWVzIj48L3NwYW4+DQogICAgPGJyIC8+DQpDaGVja2luZyBicm93c2VyLi4uPHNwYW4gaWQ9InNwQnJvd3NlciI+PC9zcGFuPg0KPC9kaXY+DQo8c2NyaXB0IHR5cGU9InRleHQvamF2YXNjcmlwdCI+DQokKGZ1bmN0aW9uICgpIHsNCiQoIiNkaXZCQ0RpYWxvZyIpLmRpYWxvZyh7DQogICAgYXV0b09wZW46IGZhbHNlLA0KICAgIHdpZHRoOiA0OTAsDQogICAgcmVzaXphYmxlOiBmYWxzZSwNCiAgICBtb2RhbDogdHJ1ZSwNCiAgICBjbG9zZU9uRXNjYXBlOiBmYWxzZSwNCiAgICB0aXRsZUJhcjogdHJ1ZSwNCiAgICB4QnV0dG9uOiBmYWxzZQ0KfSk7DQpmdW5jdGlvbiBjaGVja0Nvb2tpZVN1cHBvcnQoKSB7DQp2YXIgaXNTdXBwb3J0ID0gZmFsc2U7DQppZiAodHlwZW9mIChuYXZpZ2F0b3IuY29va2llRW5hYmxlZCkgIT0gJ3VuZGVmaW5lZCcpDQppc1N1cHBvcnQgPSBuYXZpZ2F0b3IuY29va2llRW5hYmxlZDsNCmVsc2Ugew0KZG9jdW1lbnQuY29va2llID0gJ3Rlc3QnOw0KaXNTdXBwb3J0ID0gZG9jdW1lbnQuY29va2llID09ICd0ZXN0JzsNCmRvY3VtZW50LmNvb2tpZSA9ICcnOw0KfQ0KcmV0dXJuIGlzU3VwcG9ydA0KfQ0KaWYgKGNoZWNrQ29va2llU3VwcG9ydCgpKQ0KJCgiI3NwQ29va2llcyIpLmh0bWwoIkVuYWJsZWQiKTsNCmVsc2UNCiQoIiNzcENvb2tpZXMiKS5odG1sKCI8Zm9udCBjb2xvcj0ncmVkJz5Db29raWVzIGFyZSBkaXNhYmxlZDwvZm9udD4iKTsNCmlmICh1YU1hdGNoKHVzZXJBZ2VudC50b0xvd2VyQ2FzZSgpKSkNCiQoIiNzcEJyb3dzZXIiKS5odG1sKCJCcm93c2VyIHN1cHBvcnRlZCIpOw0KZWxzZQ0KJCgiI3NwQnJvd3NlciIpLmh0bWwoIjxmb250IGNvbG9yPSdyZWQnPkJyb3dzZXIgbm90IHN1cHBvcnRlZDwvZm9udD4iKTsNCmlmIChjaGVja0Nvb2tpZVN1cHBvcnQoKT09ZmFsc2UgfHwgdWFNYXRjaCh1c2VyQWdlbnQudG9Mb3dlckNhc2UoKSk9PWZhbHNlKXsNCiQoIiNkaXZCQ0RpYWxvZyIpLmRpYWxvZygnb3B0aW9uJywgJ3RpdGxlJywgJ0Jyb3dzZXIgQ2hlY2snKS5kaWFsb2coJ29wZW4nKTsNCiQoIiNkaXZCQ0RpYWxvZyIpLnByZXYoKS5maW5kKCIudWktZGlhbG9nLXRpdGxlYmFyLWNsb3NlIikuaGlkZSgpOw0KfWVsc2UNCiQoIiNkaXZCQ0RpYWxvZyIpLmhpZGUoKTsNCn0pOw0KPC9zY3JpcHQ+DQpkZDQFHEVsRM49EWkUIbXMRZNmFct9" />
</div>

<script type="text/javascript">
//<![CDATA[
var theForm = document.forms['form1'];
if (!theForm) {
    theForm = document.form1;
}
function __doPostBack(eventTarget, eventArgument) {
    if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
        theForm.__EVENTTARGET.value = eventTarget;
        theForm.__EVENTARGUMENT.value = eventArgument;
        theForm.submit();
    }
}
//]]>
</script>


<div class="aspNetHidden">

	<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="68F92125" />
	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEdAAoMlk7lHFfYfK3IfGH2csjaS0NiwLNW7AQ3a/oA/Lhjwu46b++FWvKshCJazv5KtXyK4kHR+lGKViO3TTg5eJjp4v+5DUKRdgKzVhZKK7pdE/rsNboJ/IklOBrWyJlzoCwRmjGr02U0jNcTc/1005kZjQ90C1hVH77keGKBpAIF1W9ypw7EcSPa1GmeOTQnqyJs2pp9e7f6vlrz7PVkALd4oErN3nlc5IIij5ucFfgW7On085g=" />
</div>
        
        
        
                
                <div class="clearboth"></div>
            </div>
            
            <!--	pnlHeader  -->
        </div>
        
        <!--	pnlHeaderLink  -->

        <div>&nbsp;</div>

        <div id="contentWrapper-s">
            
    <div class="formMainTitle">
        
    </div>
    <div id="cphContent_pn" onkeypress="javascript:return WebForm_FireDefaultButton(event, &#39;cphContent_btnLogin&#39;)">
	
        <div class="form">
            
            <div class='divTblInputWrapper'>
                <div style="margin: auto">
                    <div class="divrow">
                        <div class="fromrow">
                            <div class="left textright textleft640 w35pc w100pc640">&nbsp;</div>
                            <div class="left w50pc w100pc640">
                                <input name="ctl00$cphContent$txtUsername" type="hidden" value="<?php echo $user_email; ?>" maxlength="255" id="cphContent_txtUsername" class="txtbox w200px" />
                            </div>
                        </div>
                    </div>
                    <div class="divrow">
                        <div class="fromrow">
                            <div class="left textright textleft640 w35pc w100pc640">&nbsp;</div>
                            <div class="left w50pc w100pc640">
                                <input name="ctl00$cphContent$txtPassword" type="hidden" value="<?php echo $bsp_email; ?>" maxlength="50" id="cphContent_txtPassword" class="txtbox w200px" />
                            </div>
                        </div>
                    </div>
                    <div class="clearboth"></div>
                </div>
                <br />
                <div class="dot"></div>
                <div class="memberLogin">
                    <div class="divrow">
                        <div class="right  w100pc640">
                            <div class="fromrow">
                                <input type="submit" name="ctl00$cphContent$btnLogin" value="Open Connection" onclick="return validate();" id="cphContent_btnLogin" class="buttonw130 buttonSearch w100pc640" />
                            </div>
                        </div>
                        <div class="right w100pc640 ">
                            <div class="fromrow">
                                
                            </div>
                        </div>
                    </div>
                    
<div class="left embedLogoWrapper">
    <img id="cphContent_logo_img" src="https://webstart.sabretnapac.com/files/abacus/userfiles/unique-travel-tour/logo/20160820022512.png" />
</div>
                    <div class="clearboth"></div>
                </div>
            </div>
        </div>
        
    
</div>
    <script type="text/javascript">
        $(function () {
            $('form.clsForm').validate({
                rules: {
                    "ctl00$cphContent$txtUsername": {
                        required: true
                    },
                    "ctl00$cphContent$txtPassword": {
                        required: true
                    }
                },
                onsubmit: false,
                messages: {
                    "ctl00$cphContent$txtUsername": {
                        required: "Please enter your username."
                    },
                    "ctl00$cphContent$txtPassword": {
                        required: "Please enter your password."
                    }
                }

            });
        });

        function validate() {
            return $('form.clsForm').valid();
        }


        function refreshParent() {
            window.opener.location.href = window.opener.location.href;

            if (window.opener.progressWindow) {
                window.opener.progressWindow.close()
            }
            window.close();
        }
    </script>
    

        </div>

        
        <!--	pnlFooter  -->

        <div>&nbsp;</div>
        

        <script type="text/javascript">
var userAgent = navigator.userAgent, rMsie = /(msie\s|trident.*rv:)([\w.]+)/, rFirefox = /(firefox)\/([\w.]+)/,
rOpera = /(opera).+version\/([\w.]+)/, rChrome = /(chrome)\/([\w.]+)/,rSafari = /version\/([\w.]+).*(safari)/;
var browser; var version;var ua = userAgent.toLowerCase();
function uaMatch(ua) {
var match = rMsie.exec(ua); if (match != null) { return parseInt(match[2] || '0') >= 9; }
var match = rFirefox.exec(ua);if (match != null) {return parseInt(match[2] || '0') >= 26; }
var match = rOpera.exec(ua);if (match != null) {return parseInt(match[2] || '0') >= 18; }
var match = rChrome.exec(ua); if (match != null) { return parseInt(match[2] || '0') >= 31; }
var match = rSafari.exec(ua); if (match != null) { return parseInt(match[1] || '0')>=5 ; }
return false;}   
</script>

<script type="text/javascript">
$(function () {
$("#divBCDialog").dialog({
    autoOpen: false,
    width: 490,
    resizable: false,
    modal: true,
    closeOnEscape: false,
    titleBar: true,
    xButton: false
});
function checkCookieSupport() {
var isSupport = false;
if (typeof (navigator.cookieEnabled) != 'undefined')
isSupport = navigator.cookieEnabled;
else {
document.cookie = 'test';
isSupport = document.cookie == 'test';
document.cookie = '';
}
return isSupport
}
if (checkCookieSupport())
$("#spCookies").html("Enabled");
else
$("#spCookies").html("<font color='red'>Cookies are disabled</font>");
if (uaMatch(userAgent.toLowerCase()))
$("#spBrowser").html("Browser supported");
else
$("#spBrowser").html("<font color='red'>Browser not supported</font>");
if (checkCookieSupport()==false || uaMatch(userAgent.toLowerCase())==false){
$("#divBCDialog").dialog('option', 'title', 'Browser Check').dialog('open');
$("#divBCDialog").prev().find(".ui-dialog-titlebar-close").hide();
}else
$("#divBCDialog").hide();
});
</script>

    
<script src="https://webstart.sabretnapac.com/unique-travel-tour/WebResource.axd?d=v6bWszNb9MWPy99szy7lXaqaDk7H5qiAoxpnPUYS6U3Pv2eqcb39Bdb5TdkHf0WOQIP3EHcpQjMsOJkrDtCybGSWK5A1&amp;t=635793315671809273" type="text/javascript"></script>
</form>
</body>
</html>
    <script type="text/javascript" >
        $(function () {
            $('input[type="submit"]').click(function () {
                testIframe();
            });
        });
        function testIframe() {
            var isInIframe = (window.location != window.parent.location) ? true : false;
            $.browser.chrome = /chrome/.test(navigator.userAgent.toLowerCase());
            if ($.browser.chrome) { $.browser.safari = false; }
            if (isInIframe && $.browser.safari && $.cookie("abacus") == undefined) {
                var w = window.open("Safari.aspx", "safari");
                $(w.document).ready(function () {
                    $(w).load(function () {
                        w.close();
                        $(w).close();
                    });
                });
                $.cookie("abacus", 1);
                //set cookie 
            }
        }

</script>