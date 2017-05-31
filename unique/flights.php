<?php include_once('top.php');

	$ID = mysql_real_escape_string($_GET['id']);

	$Where = " user_air_line_id = ".(int)$ID."";

	$nRecUser = GetRecord('tbluserairlines', $Where);

	$Url = $nRecUser['user_url'];

    $alphabet_raw = "23456789abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";
    $alphabet = str_split($alphabet_raw);
     
    function base56_encode($num, $alphabet){
        /*
        Encode a number in Base X
     
        `num`: The number to encode
        `alphabet`: The alphabet to use for encoding
        */
        if ($num == 0){
            return 0;
        }
     
        $n = str_split($num);
        $arr = array();
        $base = sizeof($alphabet);
     
        while($num){
            $rem = $num % $base;
            $num = (int)($num / $base);
            $arr[]=$alphabet[$rem];
        }
     
        $arr = array_reverse($arr);
        return implode($arr);
    }

?>



<body>



    <div id="wrapper">



        <!-- Navigation -->

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

        <?php include_once('header.php');?>    



        <?php include_once('leftsidebar.php');?>     

        </nav>



        <div id="page-wrapper">

            <div class="row">

                <div class="col-lg-12 hide">

                    <h1 class="page-header">Flights</h1>

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row" style="margin-top:25px;">

                <div class="col-lg-12">

                    <div class="panel panel-default">

                        <div class="panel-heading">

                            Flights

                        </div>

                        <div class="panel-body">

                            <div class="row">

                                <div class="col-lg-12">
                            
                                <!-- <iframe style="margin-top:150px;" scrolling="yes" FRAMEBORDER="0" MARGINWIDTH="0" MARGINHEIGHT="0" src=""> -->
                                    <?php
                                    $str = "";
                                    $client_id = (int)$_SESSION['client_id'];
                                    $Where = " user_id = ".(int)$client_id."";
                                    $nRecLine = GetRecord('tbluser', $Where); 
                                    //var_dump($nRecLine); die;
                                    $url_user = md5($nRecLine['bsp_url']);
                                    $air_line_id_user = base56_encode($nRecLine['user_id'], $alphabet);
                                    //$air_line_id_user = $nRecLine['user_id'];
                                    //var_dump($air_line_id_user);
                                    ?>
                                   <!-- <a href="<?php echo $url_user; ?>" target="_blank"><img style="cursor: pointer; margin-top: 20px;" src="../images/toplogo.png" height="60" width="150" alt="Air Line"></a> -->
                                    <img style="cursor: pointer; margin-top: 20px;" onclick="SaveEncodeURL('<?php echo $air_line_id_user; ?>', '<?php echo $url_user;?>', <?php echo $client_id; ?>, 1);" src="../images/toplogo.png" height="60" width="150" alt="Air Line">
                                    <?php
                                    // $strQuery  = "SELECT tblairlines.*,user_air_line_id 
                                    //              FROM `tbluserairlines` INNER JOIN `tblairlines` 
                                    //              ON `tblairlines`.`air_line_id` = `tbluserairlines`.`air_line_id` 
                                    //              WHERE `tbluserairlines`.`user_id` = '".(int)$_SESSION['client_id']."' ";
                                    $strQuery  = "SELECT * FROM `tblairlines` WHERE url_status = 0 and client_id = 0";
                                    $nResult = MySQLQuery($strQuery);    
                                    $i = 2;
                                    while($rstRow = mysql_fetch_array($nResult)){ 
                                        // str_rot13("Hello World");
                                        $url = md5($rstRow['air_line_url']);
                                        $air_line_id = base56_encode($rstRow['air_line_id'], $alphabet);
                                        //var_dump($user_air_line_id);
                                    ?>
                                    <img style="cursor: pointer; margin-top: 20px;" onclick="SaveEncodeURL('<?php echo $air_line_id;?>', '<?php echo $url;?>', <?php echo $client_id; ?>, <?php echo $i; ?>);" src="../utt-staff/images/air_lines/<?php echo $rstRow['air_line_image'];?>" height="60" width="200" alt="Air Line">
                                    <?php $i++; } ?>
                                <!-- </iframe> -->
                            
                            <!-- /.row (nested) -->
                                </div>
                            </div>
                        </div>

                        <!-- /.panel-body -->

                    </div>

                    <!-- /.panel -->

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

        </div>

        <!-- /#page-wrapper -->



    </div>

    <!-- /#wrapper -->



    <?php include_once('jquery.php');?>

    <style>
   /*html,body { height: 100% }
   .stockIframe {  width:100%; height:100%; }
   .stockIframe iframe {  width:100%; height:100%; border:0;overflow:hidden }*/
   iframe {
    position: fixed;
    /*background: #000;*/
    border: none;
    top: 0; right: 0;
    bottom: 0; left: 0;
    width: 100%;
    height: 100%;
}
</style>

<script type="text/javascript">
        function SaveEncodeURL(air_line_id, url, client_id, type_id)
       {
        //console.log(air_line_id+"******"+url+"----"+client_id);
        var action = "SaveEncodeURLDB";
        var http = new XMLHttpRequest();
        var action = "action.php?action=SaveEncodeURLDB";
        var params = "air_line_id="+air_line_id+"&url="+url+"&client_id="+client_id+"&type_id="+type_id;
        http.open("POST", action, true);

        //Send the proper header information along with the request
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        http.onreadystatechange = function() {//Call a function when the state changes.
            if(http.readyState == 4 && http.status == 200) {
                //alert(http.responseText);
                current_url = "air_lines?2530="+air_line_id+"&6390="+url+"&1580="+type_id+"";
                //window.location.href = "air_lines?2530="+air_line_id+"&6390="+url+"";
                window.open(current_url, '_blank');
            }
        }
        http.send(params);
        // jQuery.ajax({
        //     type: "POST",
        //     url: "action.php",
        //     data: {air_line_id: air_line_id, action: action, url: url, client_id: client_id},
        //     cache: false,
        //     success: function(response)
        //     {
        //         //console.log(response); return false;
        //         if(response == 2)
        //         {
        //             //var current_url = "air_lines?2530="+air_line_id+"&6390="+url+"";
        //             //window.location.href = "air_lines?2530="+air_line_id+"&6390="+url+"";
        //             //window.open(current_url, '_blank');
        //             //return false;
        //             //air_lines?2530=<?php echo $id;?>&6390=<?php echo $url;?>
        //         }
                
        //     }
        // });
       }

   
</script>


</body>



</html>

