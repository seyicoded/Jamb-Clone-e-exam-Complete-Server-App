<?php
session_start();     
include('connect.php');               
$advar = md5('adminloginstate');
$adval = md5("truly-admin");
$php = $_SERVER['PHP_SELF'];
if(!isset($_SESSION[$advar]) || $_SESSION[$advar] != $adval){
    header("Location:adminlogin.php");
    echo "<script>window.location.replace(adminlogin.php);</script>";
}
if(isset($_POST['submitquestionnow'])){
    $subject_id = scnsqli($dbcon,scnxss($_POST['sid']));
    $question = scnsqli($dbcon,scnxss($_POST['question']));
    $op1 = scnsqli($dbcon,scnxss($_POST['op1']));
    $op2 = scnsqli($dbcon,scnxss($_POST['op2']));
    $op3 = scnsqli($dbcon,scnxss($_POST['op3']));
    $op4 = scnsqli($dbcon,scnxss($_POST['op4']));
    $answerid = scnsqli($dbcon,scnxss($_POST['answeroption']));
    switch($answerid){
        case "op1":
             $answer = $op1;
        break;
        case "op2":
             $answer = $op2;
        break;
        case "op3":
             $answer = $op3;
        break;
        case "op4":
             $answer = $op4;
        break;   
    }
    //echo "<script>alert('  sid : $subject_id :$answer : q :$question');</script>";
    
    $num =mysqli_num_rows(mysqli_query($dbcon,"SELECT * FROM question_list"));
    $num+=2;
    $insert = "INSERT INTO question_list(question_id,subject_id,Question) VALUES('$num','$subject_id','$question');";
    $insert .= "INSERT INTO option_list(question_id,qo_1,qo_2,qo_3,qo_4) VALUES('$num','$op1','$op2','$op3','$op4') ;";
    $insert .= "INSERT INTO answer_list(question_id,answer) VALUES('$num','$answer');";
    if(mysqli_multi_query($dbcon,$insert)){
         echo "<script>alert('Question added');</script>";
    }else{
        echo "<script>alert('Adding error due to:".mysqli_error($dbcon);":');</script>";
    }
}
if(isset($_GET['doneediting']) && isset($_POST['submiteditionnow'])){
    $ques_id = scnsqli($dbcon,scnxss($_POST['qid']));
    $question = scnsqli($dbcon,scnxss($_POST['question']));
    $op1 = scnsqli($dbcon,scnxss($_POST['op1']));
    $op2 = scnsqli($dbcon,scnxss($_POST['op2']));
    $op3 = scnsqli($dbcon,scnxss($_POST['op3']));
    $op4 = scnsqli($dbcon,scnxss($_POST['op4']));
    $answeroption = scnsqli($dbcon,scnxss($_POST['answeroption']));
    
    switch($answeroption){
        case "op1":
             $answer = $op1;
        break;
        case "op2":
             $answer = $op2;
        break;
        case "op3":
             $answer = $op3;
        break;
        case "op4":
             $answer = $op4;
        break;   
    }
    $insert = "UPDATE question_list SET Question='$question' WHERE question_id='$ques_id';";
    $insert .= "UPDATE option_list SET qo_1='$op1', qo_2='$op2', qo_3='$op3', qo_4='$op4' WHERE question_id='$ques_id';";
    $insert .= "UPDATE answer_list answer='$answer' WHERE question_id='$ques_id';";
    
    if(mysqli_multi_query($dbcon,$insert)){
         echo "<script>alert('Question Edited');</script>";
    }else{
        echo "<script>alert('Editing error due to:".mysqli_error($dbcon);":');</script>";
    }
}
if(isset($_POST['submiteditedusernownow'])){
    $uid = scnsqli($dbcon,scnxss($_POST['uid']));;
    $fn = scnsqli($dbcon,scnxss($_POST['fname']));;
    $sn = scnsqli($dbcon,scnxss($_POST['sname']));;
    $email = scnsqli($dbcon,scnxss($_POST['email']));;
    $dob = scnsqli($dbcon,scnxss($_POST['dob']));;
    $course = scnsqli($dbcon,scnxss($_POST['course']));;
    $s1 = scnsqli($dbcon,scnxss($_POST['first']));;
    $s2= scnsqli($dbcon,scnxss($_POST['second']));;
    $s3 = scnsqli($dbcon,scnxss($_POST['third']));;
    $s4 = scnsqli($dbcon,scnxss($_POST['fourth']));;
    
     if($dob == "" || strlen($dob) <2){
         $dt = mysqli_fetch_assoc(mysqli_query($dbcon,"SELECT * FROM registration WHERE id='$uid'"));
         $dob = $dt['dateofbirth'];
     }                         //08159899941       
     if($course == "0"){                       
         $dt = mysqli_fetch_assoc(mysqli_query($dbcon,"SELECT * FROM registration WHERE id='$uid'"));
         $course = $dt['course'];
     }
     if($s1 == 0){
         $dt = mysqli_fetch_assoc(mysqli_query($dbcon,"SELECT * FROM registration WHERE id='$uid'"));
         $s1 = $dt['first_subject'];
     }
     if($s2 == 0){
         $dt = mysqli_fetch_assoc(mysqli_query($dbcon,"SELECT * FROM registration WHERE id='$uid'"));
         $s2 = $dt['second_subject'];
     }
     if($s3 == 0){
         $dt = mysqli_fetch_assoc(mysqli_query($dbcon,"SELECT * FROM registration WHERE id='$uid'"));
         $s3 = $dt['third_subject'];
     }
     if($s4 == 0){
         $dt = mysqli_fetch_assoc(mysqli_query($dbcon,"SELECT * FROM registration WHERE id='$uid'"));
         $s4 = $dt['fourth_subject'];
     }
     
    $sqll = "UPDATE registration SET firstname='$fn',surname='$sn',email='$email',dateofbirth='$dob',course='$course',first_subject='$s1',second_subject='$s2',third_subject='$s3',fourth_subject='$s4' WHERE id='$uid'";
    if(mysqli_query($dbcon,$sqll)){
       echo "<script>alert('users edited');</script>"; 
    }else{
       echo "<script>alert('Error due to ".mysqli_error($dbcon)."');</script>";  
    }
}
//to scan for any malicious input leading to SQLinjection
function scnsqli($con,$sqlstring){
    $scen = mysqli_real_escape_string($con,$sqlstring);
    return $scen;
}
//to scan for any malicious input leading to XSS
function scnxss($data){
    $data = trim($data);      
    $data = htmlspecialchars($data);
    return $data;
}
?>             
<!doctype html>
<html>   
    <head>
       <style type="text/css">
        *{
            box-sizing:border-box;
        }
        .option{
            padding:6px 10px;
            text-decoration: none;
            background: green;
            border-radius:4px;
            margin:3% 4px;
        }
        .option:hover{
            box-shadow:2px 2px 3px 2px rgba(0,0,0,.7);
        }
        #sl{
            width:80%;
            position: relative;
            left: 10%;
            border:1px solid black;
            margin-top:4%;                            
            box-shadow:1px 1px 2px 2px rgba(0,0,0,1.0);
        }
        #ques{
            width:80%;
            position: relative;
            left: 10%;
            border:1px solid black;
            box-shadow:1px 1px 2px 2px rgba(0,0,0,1.0);
        }
       </style>
       <title>ADMIN PORTAL</title>
       <link type="text/css" rel="stylesheet" href="css\bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css\styles.css">
    </head>
    <body>
    <br>
        <a class='option' href="<?php echo $php;?>?addquestion=true">ADD A QUESTION.</a>  
        <a class='option' href="<?php echo $php;?>?editquestion=true">EDIT A QUESTION.</a>  
        <a class='option' href="<?php echo $php;?>?viewuser=true">VIEW REGISTERED USER.</a>  
        <a class='option' href="<?php echo $php;?>?edituser=true">EDIT REGISTERED USER.</a>  
        <a class='option' href="adminlogout.php">LOGOUT.</a>  
        <br>
        <?php
            if(isset($_GET['edituser'])){
                 $sqluu = mysqli_query($dbcon,"SELECT * FROM registration ORDER BY id DESC");
                 ?>
                     <form method="post" id='sl' action="<?php echo $php;?>?edituser=true&editusernow=true">
                            <h2>EDIT USER INFO.</h2>
                            <select name="userid" class='box2'>
                                   <?php
                                    while($line = mysqli_fetch_assoc($sqluu)){  
                                        echo "<option value='".$line['id']."'>".$line['surname']." ".$line['firstname']."</option>";
                                    }
                                   ?>
                            </select>
                            <input type="submit" class="btn btn-primary" name="submiteditedusernow" value='Select'>
                     </form>
                 <?php
            }
             if(isset($_GET['editusernow']) && isset($_POST['submiteditedusernow'])){
                 $uid = $_POST['userid'];
                 $data = mysqli_fetch_assoc(mysqli_query($dbcon,"SELECT * FROM registration WHERE id='$uid'"));
                 $fname=$data['firstname'];
                 $sname=$data['surname'];
                 $course=$data['course'];
                 $email=$data['email'];
                 $dob=$data['dateofbirth'];
                 $su1=$data['first_subject'];
                 $su2=$data['second_subject'];
                 $su3=$data['third_subject'];
                 $su4=$data['fourth_subject'];
                 ?>
                   <form method="post" id='sl' action="<?php echo $php;?>"> 
                        <input type="hidden" name="uid" value="<?php echo $uid;?>">
                       <div class="form-group">
                            <label for="">First Name:</label>
                            <input type="text" class="form-control" value="<?php echo $fname;?>" name="fname" placeholder='Enter the info'  required>
                       </div>
                       
                       <div class="form-group">
                            <label for="">Sur Name:</label>
                            <input type="text" class="form-control" value="<?php echo $sname;?>" name="sname" placeholder='Enter the info'  required>
                       </div>
                       
                       <div class="form-group">
                            <label for="">Email:</label>
                            <input type="email" class="form-control" value="<?php echo $email;?>" name="email" placeholder='Enter the info'  required>
                       </div>
                       
                       <div class="form-group">
                            <label for="">Date of Birthday:</label>
                            <input type="date" class="form-control" value="<?php echo $email;?>" name="dob" placeholder='Enter the info'>
                       </div>
                       
                       <div class="form-group">
    <select class="box2" name="course" required>
        <option value="0">Select your course</option>
        <option>Computer Science</option>
        <option>Mass Communication</option>
        <option>Marketing</option>
        <option>Accountacy</option>
        <option>Civil Engineering</option>
        <option>Electrical Engineering</option>
        <option>Science Laboratory</option>
        <option>Estate management</option>
    </select>
</div>

  <div class="form-group">
    <select class="box2" name="first"  required>
        <option value="0">Select First Subject</option>
        <option value="1">English Language</option>
        <option value="2">Mathematics</option>
        <option value="3">Physics</option>
        <option value="4">Chemistry</option>
        <option value="5">Agric</option>
        <option value="6">Biology</option>
        <option value="7">Government</option>
        <option value="8">Commerce</option>
        <option value="9">Economic</option>
    </select>
  </div>
  
  <div class="form-group">
    <select class="box2" name="second"  required>
        <option value="0">Select Second Subject</option>
        <option value="1">English Language</option>
        <option value="2">Mathematics</option>
        <option value="3">Physics</option>
        <option value="4">Chemistry</option>
        <option value="5">Agric</option>
        <option value="6">Biology</option>
        <option value="7">Government</option>
        <option value="8">Commerce</option>
        <option value="9">Economic</option>
    </select>
  </div>
  
  <div class="form-group">
    <select class="box2" name="third"  required>
        <option value="0">Select Third Subject</option>
        <option value="1">English Language</option>
        <option value="2">Mathematics</option>
        <option value="3">Physics</option>
        <option value="4">Chemistry</option>
        <option value="5">Agric</option>
        <option value="6">Biology</option>
        <option value="7">Government</option>
        <option value="8">Commerce</option>
        <option value="9">Economic</option>
    </select>
  </div>
  
  <div class="form-group">
    <select class="box2" name="fourth"  required>
        <option value="0">Select Four Subject</option>
        <option value="1">English Language</option>
        <option value="2">Mathematics</option>
        <option value="3">Physics</option>
        <option value="4">Chemistry</option>
        <option value="5">Agric</option>
        <option value="6">Biology</option>
        <option value="7">Government</option>
        <option value="8">Commerce</option>
        <option value="9">Economic</option>
    </select>
  </div>
                 <button type="submit" class="btn btn-primary" name="submiteditedusernownow">Change</button>
                   </form>
                 <?php
             }
            //edit user
            
            if(isset($_GET['viewuser'])){
               $udata = mysqli_query($dbcon,"SELECT * FROM registration ORDER BY id DESC"); 
               echo "<table border='2' align='center' style='text-align:center;margin-top:3%; border:1px solid black; box-shadow:2px 2px 2px 2px rgba(0,0,0,.8);'>";
               echo "<tr>";
               echo "<th>NO.</th>"; 
               echo "<th>NAMES</th>"; 
               echo "<th>GENDER</th>"; 
               echo "<th>D.O.B</th>"; 
               echo "<th>EMAIL</th>"; 
               echo "<th>COURSE</th>"; 
               echo "<th>REG. NUMB.</th>"; 
               echo "<th>ALL SUBJECT</th>"; 
               echo "<th>REG.DATE</th>"; 
               echo "</tr>";
               $num = mysqli_num_rows($udata);
               $count=1;
               if($num > 0){
                  while($line = mysqli_fetch_assoc($udata)){ 
                      $nameu = $line['firstname']." ".$line['surname'];
                      
                      $first_s = $line['first_subject'];
$fil1 = mysqli_fetch_assoc(mysqli_query($dbcon,"SELECT * FROM subjects WHERE sub_id='$first_s'"));
$first_subject = $fil1['sub_name'];

$second_s = $line['second_subject'];
$fil2 = mysqli_fetch_assoc(mysqli_query($dbcon,"SELECT * FROM subjects WHERE sub_id='$second_s'"));
$second_subject = $fil2['sub_name'];

$third_s = $line['third_subject'];
$fil3 = mysqli_fetch_assoc(mysqli_query($dbcon,"SELECT * FROM subjects WHERE sub_id='$third_s'"));
$third_subject = $fil3['sub_name'];

$fourth_s = $line['fourth_subject'];
$fil4 = mysqli_fetch_assoc(mysqli_query($dbcon,"SELECT * FROM subjects WHERE sub_id='$fourth_s'"));
$fourth_subject = $fil4['sub_name'];
                      
                      $subjectu = $first_subject.", ".$second_subject.",<br> ".$third_subject.", ".$fourth_subject;
                      echo "<tr>";
                      echo "<td>$count.</td>";
                      echo "<td>$nameu</td>";
                      echo "<td>".$line['gender']."</td>";
                      echo "<td>".$line['dateofbirth']."</td>";
                      echo "<td>".$line['email']."</td>";
                      echo "<td>".$line['course']."</td>";
                      echo "<td>".$line['reg_number']."</td>";
                      echo "<td>$subjectu</td>";
                      
                      echo "<td>".$line['registration_date']."</td>";  
                      echo "</tr>";
                      $count++;
                  }
               }else{
                   echo "<tr><td colspan='8'>Sorry no user registered yet</td></tr>";
               }
               echo "</table>";
            }
            if(isset($_GET['editquestion'])){
                ?>
                  <form id='sl' method="post" action="<?php echo $php;?>?editquestion=true&editnow=true">
                       <h2>EDIT QUESTION.</h2>
                       <h3>Please select the SUBJECT: </h3>
                       <select class="box2" name="subjects" required>
                           <?php
                            $sql = mysqli_query($dbcon,"SELECT * FROM subjects");
                            while($line = mysqli_fetch_assoc($sql)){
                                 echo "<option value='".$line['sub_id']."'>".$line['sub_name']."</option>";
                            }
                         ?> 
                       </select>
                       <input type="submit" class="btn btn-primary" name="submitedit" value='Select'>
                  </form>  
                <?php
            }
            if(isset($_GET['editnow']) && isset($_POST['submitedit'])){
                $sidd = $_POST['subjects'];
                ?>
                    <form method="post" id='sl' action="<?php echo $php;?>?editquestion=true&editnow=true&editnnownow=true">
                    <h3>Please select the Question: </h3> 
                        <select class="box2" name="questionid" required>
                           <?php
                            $sql = mysqli_query($dbcon,"SELECT * FROM question_list WHERE subject_id='$sidd'");
                            while($line = mysqli_fetch_assoc($sql)){
                                 echo "<option value='".$line['question_id']."'>".$line['Question']."</option>";
                            }
                         ?> 
                       </select>
                        <input type="submit" class="btn btn-primary" name="submiteditnow" value='Select'> 
                    </form>
                <?php
            }
            if(isset($_GET['editnnownow']) && isset($_POST['submiteditnow'])){
                 $qidn = $_POST['questionid'];
                 $qdata = mysqli_fetch_assoc(mysqli_query($dbcon,"SELECT * FROM question_list AS a INNER JOIN option_list AS b ON a.question_id=b.question_id WHERE a.question_id='$qidn'"));
                 $quest_d = $qdata['Question'];
                 $op1 = $qdata['qo_1'];
                 $op2 = $qdata['qo_2'];
                 $op3 = $qdata['qo_3'];
                 $op4 = $qdata['qo_4'];
                 $qdata = mysqli_fetch_assoc(mysqli_query($dbcon,"SELECT * FROM answer_list WHERE question_id='$qidn'"));
                 $answer = $qdata['answer'];
                   //trying
                 ?>
                     <form method="post" id='sl' action="<?php echo $php;?>?doneediting=true">
                        <input type="hidden" name="qid" value="<?php echo $qidn;?>">
                            
                            <div class="form-group">
                                <label for="question">Question:</label>
                                <input type="text" class="form-control" name="question" value="<?php echo $quest_d;?>" placeholder='Enter Your Question'  required>
                            </div>
                            
                           <div class="form-group">
                                <label for="op1">Option-1:</label>
                                <input type="text" class="form-control" value="<?php echo $op1;?>" name="op1" placeholder='Enter an Option'  required>
                            </div>
                            
                           <div class="form-group">
                                <label for="op2">Option-2:</label>
                                <input type="text" class="form-control" value="<?php echo $op2;?>" name="op2" placeholder='Enter an Option'  required>
                            </div>
                           <div class="form-group">
                                <label for="op3">Option-3:</label>
                                <input type="text" class="form-control" value="<?php echo $op3;?>" name="op3" placeholder='Enter an Option'  required>
                            </div>
                           <div class="form-group">
                                <label for="op4">Option-4:</label>
                                <input type="text" class="form-control" value="<?php echo $op4;?>" name="op4" placeholder='Enter an Option'  required>
                            </div> 
                            <br>
                            <label>ANSWER: <?php echo $op1;?></label>
                            <br>
                            <div class="form-group">
                                <label for="opanswer">PLEASE SELECT WHICH OPTION IS THE ANSWER AGAIN:</label>
                                <select class="box2" name='answeroption' onclick="loadanswer()">
                                    <option value="op1">OPTION-1:<span class='an1'></span></option>
                                    <option value="op2">OPTION-2:<span class='an2'></span></option>
                                    <option value="op3">OPTION-3:<span class='an3'></span></option>
                                    <option value="op4">OPTION-4:<span class='an4'></span></option>
                                </select>
                            </div>  
                            <script type="text/javascript" src='js/jquery.js'></script>
                             <script type="text/javascript">
                                function loadanswer(){                                                 
                                     $(".an1").html(document.adminquest.op1.value);                
                                     $(".an2").html(document.adminquest.op2.value);                
                                     $(".an3").html(document.adminquest.op3.value);                
                                     $(".an4").html(document.adminquest.op4.value);                
                                }
                             </script>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="submiteditionnow">CHANGE</button> 
                            </div>
                     </form>
                     
                 <?php
                 //trying
                 
            }
        ?>
         
        <?php
            if(isset($_GET['addquestion'])){
               ?>
               <form id='sl' method="post" action="<?php echo $php;?>?addquestion=true&selected=true">
                    <h3>Please select the SUBJECT: </h3>
                    <div class="form-group">
                    <select class="box2" name="subject" required>
                         <?php
                            $sql = mysqli_query($dbcon,"SELECT * FROM subjects");
                            while($line = mysqli_fetch_assoc($sql)){
                                 echo "<option value='".$line['sub_id']."'>".$line['sub_name']."</option>";
                            }
                         ?>
                    </select>
                    </div>  
                        <input type="submit" class="btn btn-primary" name="submit" value='Select'>
               </form>
               <?php 
            }
            if(isset($_GET['selected']) && isset($_POST['submit'])){
                 $s_id = $_POST['subject'];
                 ?>
                    <div id='ques'>
                          <form name='adminquest' method="post" action="<?php echo $php;?>">
                            <input type="hidden" name="sid" value="<?php echo $s_id;?>">
                            
                            <div class="form-group">
                                <label for="question">Question:</label>
                                <input type="text" class="form-control" name="question" placeholder='Enter Your Question'  required>
                            </div>
                            
                           <div class="form-group">
                                <label for="op1">Option-1:</label>
                                <input type="text" class="form-control" name="op1" placeholder='Enter an Option'  required>
                            </div>
                            
                           <div class="form-group">
                                <label for="op2">Option-2:</label>
                                <input type="text" class="form-control" name="op2" placeholder='Enter an Option'  required>
                            </div>
                           <div class="form-group">
                                <label for="op3">Option-3:</label>
                                <input type="text" class="form-control" name="op3" placeholder='Enter an Option'  required>
                            </div>
                           <div class="form-group">
                                <label for="op4">Option-4:</label>
                                <input type="text" class="form-control" name="op4" placeholder='Enter an Option'  required>
                            </div> 
                            
                            <div class="form-group">
                                <label for="opanswer">SELECT WHICH OPTION IS THE ANSWER:</label>
                                <select class="box2" name='answeroption' onclick="loadanswer()">
                                    <option value="op1">OPTION-1:<span class='an1'></span></option>
                                    <option value="op2">OPTION-2:<span class='an2'></span></option>
                                    <option value="op3">OPTION-3:<span class='an3'></span></option>
                                    <option value="op4">OPTION-4:<span class='an4'></span></option>
                                </select>
                            </div>  
                            <script type="text/javascript" src='js/jquery.js'></script>
                             <script type="text/javascript">
                                function loadanswer(){                                                 
                                     $(".an1").html(document.adminquest.op1.value);                
                                     $(".an2").html(document.adminquest.op2.value);                
                                     $(".an3").html(document.adminquest.op3.value);                
                                     $(".an4").html(document.adminquest.op4.value);                
                                }
                             </script>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="submitquestionnow">Submit</button> 
                            </div>
                          </form>
                    </div>
                 <?php
            }
        ?>
    </body> 
</html>