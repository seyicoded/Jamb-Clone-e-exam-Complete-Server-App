<?php
session_start();
include("includes/header.php");
include('connect.php');
$reg_number = $_SESSION['reg_number'];

$one =1;
    $trialnumber = mysqli_num_rows(mysqli_query($dbcon,"SELECT * FROM trailer_number WHERE reg_name='$reg_number' AND number='$one'"));
    if($trialnumber == 0){
          
    }else{
          echo "<script>                      
            window.open('profile.php','_self')
          </script>";
    }
    

$result = "SELECT * FROM registration WHERE reg_number= '$reg_number' ";
$res = mysqli_query($dbcon,$result);
$result2 = mysqli_fetch_assoc($res);
$user_id = $result2['id'];

$firstname = $result2['firstname'];
$surname = $result2['surname'];
//$gender = $result2['gender'];
//$dateofbirth = $result2['dateofbirth'];
//$email = $result2['email'];
//$course = $result2['course'];
$first_s = $result2['first_subject'];
$fil1 = mysqli_fetch_assoc(mysqli_query($dbcon,"SELECT * FROM subjects WHERE sub_id='$first_s'"));
$first_subject = $fil1['sub_name'];

$second_s = $result2['second_subject'];
$fil2 = mysqli_fetch_assoc(mysqli_query($dbcon,"SELECT * FROM subjects WHERE sub_id='$second_s'"));
$second_subject = $fil2['sub_name'];

$third_s = $result2['third_subject'];
$fil3 = mysqli_fetch_assoc(mysqli_query($dbcon,"SELECT * FROM subjects WHERE sub_id='$third_s'"));
$third_subject = $fil3['sub_name'];

$fourth_s = $result2['fourth_subject'];
$fil4 = mysqli_fetch_assoc(mysqli_query($dbcon,"SELECT * FROM subjects WHERE sub_id='$fourth_s'"));
$fourth_subject = $fil4['sub_name'];

?>
<!DOCTYPE html>
<html>
<head>
	<title>Examination page</title>
	<link type="text/css" rel="stylesheet" href="css\bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css\styles.css">
    <script type="text/javascript" src="js/jquery.js"></script>
	<style type="text/css">
		.box2{
		width: 450px;
		height: 30px;
		border-radius: 4px;
	}
	</style>

	<script type="text/javascript">
		function la(src){
			window.location=src;
		}

	</script>
</head>
<body>
<center><h4 class="well">Welcome &nbsp;&nbsp;<b><?php echo $surname;?></b> which subject do you want to start with</h4></center>
<br><br>
<div class="container">
	<div class="row">
		<div class="col-md-3">
			
		</div>

		<div class="col-md-3">

	<form method="get" onsubmit="return dos()">
		<div class="form-group">
	     <select class="box2" name="course" onchange="loadexam()">
		<option value="<?php echo $first_s?>"><?php echo $first_subject?></option> 
		<option value="<?php echo $second_s?>"><?php echo $second_subject?></option>
		<option value="<?php echo $third_s?>"><?php echo $third_subject?></option>
		<option value="<?php echo $fourth_s?>"><?php echo $fourth_subject?></option>
	    </select>
	    <button class="btn btn-success" name="button" onclick="loadexam()">Continue</button>
	      
</div>
             
	</form>
	            
		</div>
	</div>
    <script type="text/javascript">
            function dos(){
                return false;
            }
             function loadexam(){
                 var id= $("select[name='course']").val();   
                 var http;
                 var exam_box = $("#exam-border");
                 if(window.XMLHttpRequest){
                    http = new XMLHttpRequest();
                 }
                 else if(window.ActiveXOject){
                    http= new ActiveXOject("MICROSOFT.XMLHTTP");
                 }
                 
                 http.onreadystatechange = function(){
                     if(http.readyState <4 && http.status == 200){
                         exam_box.html("Please wait Subject content Loading <img src='img/i.gif' alt='...' style='width:20px; height:15px;'>");
                     }
                     else if(http.readyState <=4 && http.status == 404){
                          exam_box.html("Please try again Later can\'t Load subject content <img src='img/error.png' alt='error style='width:20px; height:15px;'>");
                     }
                     else if(http.readyState ==4 && http.status ==200){
                         exam_box.html(http.responseText);
                     }
                 }
                 
                 http.open("GET","demo.php?sub_id="+id,true);
                 http.send();
             }
    </script>
    <style type="text/css">
          #exam-border{
              border: 1px double black;
              box-shadow:2px 2px 3px 3px rgba(0,0,0,.6);
              border-radius:4px;
              height:auto;
          }
          .qnumb:hover{
              color:black;
              background: rgba(0,255,0,.9);
              box-shadow:2px 2px 2px 2px rgba(10,10,10,.7);
          }
          .qnumb:active{
              color:black;
              background: rgba(0,255,0,.9);
              box-shadow:2px 2px 2px 2px rgba(30,30,30,.7);
          }
          .qnumb{
              padding:10px 13px;      
              color:black;
              width:50px;
              text-align: center;
              cursor:pointer;
              background: rgba(0,255,0,.8);
              border-radius:4px;
              margin:1%;
              display: inline;
          }
          #ques-in{
              margin: 1px 0px 1px 10%;
              font-size: 18px;
          }
          #ques-head{
              margin: 1px 0px 1px 5%;
              font-size: 24px;
              font-weight: bolder;
          }
    </style>
</div>                   <div id='exam-border'>Please select Any subject above ....</div>
</body>
</html>

