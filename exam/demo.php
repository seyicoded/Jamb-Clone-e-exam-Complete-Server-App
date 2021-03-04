<?php
session_start();               
include('connect.php');
$reg_number = $_SESSION['reg_number'];
if(isset($_GET['sub_id'])){
     $_SESSION['sub_id'] = scnsqli($dbcon,scnxss($_GET['sub_id']));
}
$sub_id = $_SESSION['sub_id'];   
$result = "SELECT * FROM subjects AS a WHERE a.sub_id = '$sub_id' ";
$res = mysqli_query($dbcon,$result);
$result2 = mysqli_fetch_assoc($res);
$sub_name = $result2['sub_name'];
 echo "<h1>".$sub_name."</h2>";

?>
<!DOCTYPE html>
<html> 
<body>
<script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript">
        function loada(qidd){ 
            var blshow = $("#questionblock");
            var https;
            if(window.XMLHttpRequest){
                https = new XMLHttpRequest();
            }
            else if(window.ActiveXObject){
                https= new ActiveXObject("MICROSOFT.XMLHTTP");
            }
            
            https.onreadystatechange = function(){
                if(https.readyState <4 && https.status == 200){
                    blshow.html("Please wait Question content Loading <img src='img/i.gif' alt='...' style='width:20px; height:15px;'>");
                }
                else if(https.readyState <=4 && https.status == 404){
                    blshow.html("Please try again Later can\'t Load subject content <img src='img/error.png' alt='error style='width:20px; height:15px;'>");
                }
                else if(https.readyState ==4 && https.status ==200){
                    blshow.html(https.responseText);
                }
            }
            
            https.open("GET","load.php?quest="+qidd,true);
            https.send();
        }
        
        function soi(ms){
             var hts;
             if(window.XMLHttpRequest){
                hts = new XMLHttpRequest();
            }
            else if(window.ActiveXObject){
                hts= new ActiveXObject("MICROSOFT.XMLHTTP");
            }
            
            //ht.onreadystatechange =function(){if(hts){alert(done);}}
            
            hts.open("GET","nps.php?newnumber="+ms,true);
            hts.send();
        }
    </script>
  <?php
  
    $data = "SELECT * FROM question_list WHERE subject_id='$sub_id'";
    $pro = mysqli_query($dbcon,$data);
    $num = mysqli_num_rows($pro);
    echo "<h3>Subject Question numbers: </h3>";
    $syn = 1;
    while($line = mysqli_fetch_assoc($pro)){
        ?> 
        <div onmouseup="soi(this.innerHTML)" onclick='loada(<?php echo $line['question_id'];?>)' class='qnumb'><?php echo $syn;?></div>
         <?php
         $syn++;
    }          
  ?>
    <div id='questionblock'></div>
</body>
</html>
<?php
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