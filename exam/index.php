<?php
include("header.php");
?>          
<!-- CAROUSEL BEGINGS HERE -->
 <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="img/one.jpg" alt="Los Angeles">
    </div>

    <div class="item">
      <img src="img/two.jpg" alt="Chicago">
    </div>

    <div class="item">
      <img src="img/three.jpg" alt="New York">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<!-- CAROUSEL ENDS HERE -->

  <!--newly added-->
     <link rel="stylesheet" type="text/css" href="css/index.css">
     <div id='new-detail'>
        <div id='title'>WHY USE THIS ONLINE POST-UTME TO PREPARE FOR EXAM</div>
        <div id='content'>
            <marquee id='slider'>THE FOLLOWINGS BELOW ARE REASON FOR USING THIS SITE TO PREPARE FOR ANY UTME EXAM</marquee>
            <ul>
                <li>To help you prepare for you exam</li>
                <li><marquee>To help you track your progress status</marquee></li>
                <li>To help you have easy access to your progress and excess your exam easy</li> 
            </ul>
        </div>
     </div>
     
  <!--newly added ends here-->
      <!--FOOTER BEGINGS FROM HERE-->
      <footer class="footer">
        <center class ="well">&copy; 2017 Online Post UTME</center>
      </footer>
    </div> <!-- /container END-->
    <!--  Jquery Core Script -->
    <script src="js/jquery.js"></script>
    <!--  Core Bootstrap Script -->
    <script src="js/bootstrap.js"></script>
</body>
</html>
