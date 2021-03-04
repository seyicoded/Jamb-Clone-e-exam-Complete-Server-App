//function to handle front-end input user validation you can inprove on it later
function dosubmit(){          
    //declaration of variables
    var noti_state = $("#regstate");
    var f_name = $("input[name='firstname']").val();
    var s_name = $("input[name='surname']").val();
    var gender = $("select[name='gender']").val();    
    var course= $("select[name='course']").val();    
    var sj1= $("select[name='first']").val();    
    var sj2= $("select[name='second']").val();    
    var sj3= $("select[name='third']").val();    
    var sj4= $("select[name='fourth']").val();    
    
     //alert(f_name+s_name+gender+course+sj1+sj2+sj3+sj4);
     
     //handle input-length
     if(f_name.length > 2){
         if(s_name.length > 2){
              if(gender.length > 2){
                  if(course !=0 ){
                         if(sj1 !=0 && sj2 !=0 && sj3 !=0 && sj4 !=0 ){
                              noti_state.html("Please wait <img src='img/i.gif' alt='error' style='width:14px;height:12px;>");
                              return true;
                         }else{
                              noti_state.html("Please Select a subject <img src='img/error.png' alt='error' style='width:14px;height:12px;'>");
                         }
                  }else{
                      noti_state.html("Please Select a course <img src='img/error.png' alt='error' style='width:14px;height:12px;'>");
                  }
              }else{
                   noti_state.html("Please Select a gender <img src='img/error.png' alt='error' style='width:14px;height:12px;'>");
              }
         }else{
              noti_state.html("Sur-name is too short <img src='img/error.png' alt='error' style='width:14px;height:12px';>");
         }
     }else{
         noti_state.html("first-name is too short <img src='img/error.png' alt='error' style='width:14px;height:12px;'>");
     }
     return false;
}