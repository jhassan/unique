<?php 
    include_once('functions.php');
    $alphabet_raw = "23456789abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";
    $alphabet = str_split($alphabet_raw);
    $client_id = (int)$_SESSION['client_id'];
	function base56_decode($string, $alphabet){
    /*
    Decode a Base X encoded string into the number
 
    Arguments:
    - `string`: The encoded string
    - `alphabet`: The alphabet to use for encoding
    */
 
    $base = sizeof($alphabet);
    $strlen = strlen($string);
    $num = 0;
    $idx = 0;
 
    $s = str_split($string);
    $tebahpla = array_flip($alphabet);
 
    foreach($s as $char){
        $power = ($strlen - ($idx + 1));
        $num += $tebahpla[$char] * (pow($base,$power));
        $idx += 1;
    }
    return $num;
}
    $url = $_GET['6390'];
    $airlineid = $_GET['2530'];
    $type_id = $_GET['1580'];
    $air_id = base56_decode($airlineid, $alphabet);
    $Where = "client_id = '$client_id' AND air_line_id = '$airlineid' AND url_encode = '$url'  AND type_id = '$type_id'"; // AND staus_id = 0
    //echo $Where; die;
    $nRec = GetRecord("tblencodeurl", $Where);
    //var_dump($nRec); die;
    if($nRec['url_encode'] == $url && $nRec['air_line_id'] == $airlineid && $type_id != 1)
    {
        $Where = " air_line_id = ".(int)$air_id."";
        $nRecUser = GetRecord('tblairlines', $Where);
        $Url = $nRecUser['air_line_url'];
        //$Url = $nRec['user_url'];    
        //var_dump($Url); die;
    }
    else
    {
        $client_id = (int)$_SESSION['client_id'];
        $Where = " user_id = ".(int)$client_id."";
        $nRecLine = GetRecord('tbluser', $Where); 
        //var_dump($nRecLine); die;
        $Url = $nRecLine['bsp_url'];
    }
    
	   //var_dump($Url); die;
       //echo $Url;
?>
<!-- <!DOCTYPE html>
<html>
<body>

<iframe src="<?php echo trim($Url);?>">
  <p>Your browser does not support iframes.</p>
</iframe>

</body>
</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tours View|Login</title>
    <style>html, body, iframe{margin: 0px;padding: 0px;border: 0;text-align: center;overflow-x: hidden;overflow-y: auto;}</style>
</head>
<body>
    <iframe SRC="http://toursview.com/<?php echo trim($Url);?>" scrolling="yes" style="height:1200px;" width="100%" FRAMEBORDER="0" MARGINWIDTH="0" MARGINHEIGHT="0" ></iframe>
</body>
</html>