<?php
session_start();
include('connect.php');
    if(isset($_POST['loginadminstate'])){
         $username = scnsqli($dbcon,scnxss($_POST['user']));
         $password = scnsqli($dbcon,scnxss($_POST['pass']));
         
         if($username == "jude" && $password == "jude"){
             $advar = md5('adminloginstate');
             $adval = md5("truly-admin");
             $_SESSION[$advar] = $adval;
             $snd['lstate']="true"; 
         }else{
            $snd['lstate']="false"; 
         }
         echo json_encode($snd);
    }
    
    
    
    function scnsqli($con,$sqlstring){
    $scen = mysqli_real_escape_string($con,$sqlstring);
    return $scen;
}
//to scan for any malicious input leading to XSS
function scnxss($data){
    $data = trim($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>