<?php
session_start();
include("header.php");
include('connect.php');               
?>
<h2 style="color: red;">ADMIN/STUFF LOGIN PAGE</h2>
<marquee>WELCOME TO THIS ADMIN PORTAL CREATED FOR STAFF TO BE ABLE TO ADD QUESTIONS, OPTIONS, AND ANSWER TO THE QUESTION ONLY.</marquee>
<style type="text/css">
    
</style>
<script src="js/jquery.js"></script>
<script type="text/javascript">
      function loginnow(){
          var username = $("input[name='username']").val();
          var password = $("input[name='password']").val(); 
          var submit = $("button");submit.attr("disabled","true"); 
          submit.text("Loading");
          
          if(username.length >= 2 && password.length > 2){
               var sendz;
               if(window.XMLHttpRequest){
                    sendz = new XMLHttpRequest();
               }
               else if(window.ActiveXOject){
                   sendz = new ActiveXOject("MICROSOFT.XMLHTTP");
               }
               
               sendz.onreadystatechange = function(){
                   if(sendz.readyState <4 && sendz.status==200){
                         submit.html("Processing Please wait <img src='img/i.gif' alt='...' style='width:15px;height:10px;'>");
                   }
                   else if(sendz.readyState <=4 && sendz.status == 404){
                         submit.html("Sorry can't Process due to server error <img src='img/error.png' alt='...' style='width:15px;height:10px;'>");
                   }
                   else if(sendz.readyState ==4 && sendz.status == 200){ 
                         var inp = JSON.parse(sendz.responseText);
                         if(inp.lstate == "true"){
                              submit.html("Admin Validation successful <img src='img/correct.png' alt='...' style='width:15px;height:10px;'> redirecting in 5sec...<img src='img/i.gif' alt='...' style='width:15px;height:10px;'>");
                              setInterval(function(){window.location.replace("adminarena.php");},5000);
                              
                         }else{
                               submit.html("Invalid login info. <img src='img/error.png' alt='...' style='width:15px;height:10px;'>");
                               setInterval(function(){window.location.reload();},1000);
                         }
                   }
               }
               
               sendz.open("POST","adminajax.php",true);
               sendz.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
               sendz.send("loginadminstate=true&user="+username+"&pass="+password);
               
          }else{
              alert("Invalid credientials");
              submit.text("ERROR");
              submit.css("enabled","true");
              window.location.reload();
          }
          
          return false;
      }
</script>

<form method="post" action="#" onsubmit='return loginnow()'>
     <label for='username'>Username:</label>
     <input type="text" class="form-control" placeholder='Enter Your Username' name="username" required> <br>
     
     <label for='password'>Password:</label>
     <input type="password" class="form-control" eholder='Enter Your Password' name="password" required> <br>
     
     <button type="submit" class="btn btn-primary" name="submit">Submit</button>
     
</form>