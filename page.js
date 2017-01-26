var Websiteid="1";
var lang="GB";
var compid="SS";
var Channel="Online-DC";
var seturl__="";
var get__id="";
var index_url="http://www.travelsonya.com/ss/Index.aspx"
function reload(id)
{
debugger ;


if (id=="Login__")
{
 seturl__="http://www.travelsonya.com/ss/Online/UrlLandingPage.aspx?ReqType=Login&comid=" + compid + "&webid="+ Websiteid +"";
}
if (id=="Booking_")
{

 seturl__ ="http://www.travelsonya.com/ss/Online/UrlLandingPage.aspx?ReqType=BookingStatus&comid=" + compid + "&webid="+ Websiteid +"";

}

if (id=="Register_")
{

seturl__ ="http://www.travelsonya.com/ss/Online/UrlLandingPage.aspx?ReqType=Reg&comid=" + compid + "&webid="+ Websiteid +"";

}

if (id=="agt__register")
{

seturl__ ="http://www.travelsonya.com/ss/Online/UrlLandingPage.aspx?ReqType=Agt&comid=" + compid + "&webid="+ Websiteid +"";
}
 
get__id=document .getElementById (id);
get__id .href =seturl__ ; 
window .location .href=get__id .href;
}





 function select_(id,id_menu)
 {
 
  document .getElementById ('flight').style .display ="none";
   document .getElementById ('Hotel').style .display ="none";
    document .getElementById ('Packages_').style .display ="none";
    document .getElementById ("Hotels_").className ="";
      document .getElementById ("Flights_").className ="";
      document .getElementById ("Cruises__").className ="";
      document .getElementById ("Home__").className ="";
  document .getElementById (id).style.display ="block";
 document .getElementById (id_menu).className ="selected";
 }
 
 function Checkpage__()
 {
    // debugger ;
      document .getElementById ("Hotels_").className ="";
      document .getElementById ("Flights_").className ="";
      document .getElementById ("Cruises__").className ="";
      document .getElementById ("Home__").className ="selected";
      document .getElementById ("HolidayPackages_").className ="";
      document .getElementById ("Tours_Attractions").className ="";
      document .getElementById ("Flight+Hotel_").className ="";
      document .getElementById ("Cars_").className ="";
      document .getElementById ("ReligiousPilgrimage__").className ="";
      document .getElementById ("Visas_").className ="";
      document .getElementById ("HotDeals_").className ="";
      document .getElementById ('flight').style .display ="block";
      document .getElementById ('Hotel').style .display ="none";
      document .getElementById ('Packages_').style .display ="none";
      var str=window.location.search;
      if (str!="" && str!=null )
      {
      
      var Get_id=str.split("=");
      var count__=str.split("=").length;
      var get_ID=Get_id[1];
      if ((count__>2) && (get_ID=="Hotels_"||get_ID =="Flights_"||get_ID =="Cruises__"||
             get_ID=="Home__"||get_ID=="HolidayPackages_"||get_ID =="Tours_Attractions"||
             get_ID=="Flight+Hotel_"||get_ID=="Cars_"||get_ID =="ReligiousPilgrimage__"||get_ID =="Visas_"||get_ID =="HotDeals_"))
      {
     
      
      var get_selectedvalue=Get_id[2];
      document .getElementById ("Home__").className ="";
      document .getElementById ('flight').style .display ="none";
      document .getElementById (get_ID).className ="selected";
      document .getElementById (get_selectedvalue).style .display ="block";
         return false ;
      }
      
      else 
      
       {
         if (get_ID=="Hotels_"||get_ID =="Flights_"||get_ID =="Cruises__"||
             get_ID=="Home__"||get_ID=="HolidayPackages_"||get_ID =="Tours_Attractions"||
             get_ID=="Flight+Hotel_"||get_ID=="Cars_"||get_ID =="ReligiousPilgrimage__"||get_ID =="Visas_"||get_ID =="HotDeals_")
         
         {
         document .getElementById ("Home__").className ="";
         document .getElementById (get_ID).className ="selected";
            return false ;
       }
       
       }
      
      }
      
      
      
      
      
 }
 
 function FCheckpage__()
 {
 debugger;
  if (get_ID=="FHotels_"||get_ID =="FFlights_"||get_ID =="FCruises__"||
             get_ID=="FHome__"||get_ID=="FHolidayPackages_"||get_ID =="FTours_Attractions"||
             get_ID=="FFlight+Hotel_" ||get_ID =="FHotDeals_")
         
         {
    // debugger ;
      document .getElementById ("FHotels_").className ="";
      document .getElementById ("Flights_").className ="";
      document .getElementById ("FCruises__").className ="";
      document .getElementById ("FHome__").className ="selected";
      document .getElementById ("FHolidayPackages_").className ="";
      document .getElementById ("FTours_Attractions").className ="";
      document .getElementById ("FFlight+Hotel_").className ="";
      //document .getElementById ("FCars_").className ="";
      //document .getElementById ("FReligiousPilgrimage__").className ="";
      //document .getElementById ("FVisas_").className ="";
      document .getElementById ("FHotDeals_").className ="";
      document .getElementById ('flight').style .display ="block";
      document .getElementById ('Hotel').style .display ="none";
      document .getElementById ('Packages_').style .display ="none";
      }
      var str=window.location.search;
      if (str!="" && str!=null )
      {
      
      var Get_id=str.split("=");
      var count__=str.split("=").length;
      var get_ID=Get_id[1];
      if ((count__>2) && (get_ID=="FHotels_"||get_ID =="FFlights_"||get_ID =="FCruises__"||
             get_ID=="FHome__"||get_ID=="FHolidayPackages_"||get_ID =="FTours_Attractions"||
             get_ID=="FFlight+Hotel_" ||get_ID =="FHotDeals_"))
      {
     
      
      var get_selectedvalue=Get_id[2];
      document .getElementById ("FHome__").className ="";
      document .getElementById ('flight').style .display ="none";
      document .getElementById (get_ID).className ="selected";
      document .getElementById (get_selectedvalue).style .display ="block";
         return false ;
      }
      
      else 
      
       {
         if (get_ID=="FHotels_"||get_ID =="FFlights_"||get_ID =="FCruises__"||
             get_ID=="FHome__"||get_ID=="FHolidayPackages_"||get_ID =="FTours_Attractions"||
             get_ID=="FFlight+Hotel_" ||get_ID =="FHotDeals_")
         
         {
         document .getElementById ("FHome__").className ="";
         document .getElementById (get_ID).className ="selected";
            return false ;
       }
       
       }
      
      }
      
      
      
      
      
 }
 
 
  function Setclass_(id)
 {
     // debugger ;
      document .getElementById ("Hotels_").className ="";
      document .getElementById ("Flights_").className ="";
      document .getElementById ("Cruises__").className ="";
      document .getElementById ("Home__").className ="";
      document .getElementById ("HolidayPackages_").className ="";
      document .getElementById ("Tours_Attractions").className ="";
      document .getElementById ("Flight+Hotel_").className ="";
      document .getElementById ("Cars_").className ="";
      document .getElementById ("ReligiousPilgrimage__").className ="";
      document .getElementById ("Visas_").className ="";
      document .getElementById ("HotDeals_").className ="";
      document .getElementById ("HotDeals_").className ="";
      document .getElementById (id).className ="selected";
      return false ;
      
      }
 
//          document.onkeydown = function(e)
//        {
//          //debugger ;
//           var keyCode = document.all ? event.keyCode : e.which;
//           if (keyCode == 13) getLogin();
//       }

         function checkagtlogin()
       {
          debugger;   
            var str_1=window.location.search;
           
            if(str_1=="?status=failed")
            {
                 
                alert("Invalid Username or Password");
                
                window.location.href=index_url;
            }
       }
       
       function actionurl()
       {
           //debugger ;
          var urll="http://www.travelsonya.com/ss/subagent/ASP/new_weblanding.aspx";
          window .location .href=urll;
       }
       
       function sethiddenvalue_()
       {
       debugger ;
         document .getElementById ('CompID').value=compid;
         document .getElementById ('Ref').value=index_url;
       
       }