
<!DOCTYPE html>
<html>
<head>
	<title>Online Post UTME</title>
	<link type="text/css" rel="stylesheet" href="css\bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css\styles.css">
</head>
<body><br>
 <div class="container">
         <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="index.php">Home</a></li>
            <li role="presentation"><a href="about.php">About</a></li>
            <li role="presentation"><a href="contact.php">Contact</a></li>
            <li role="presentation"><a href="registration.php">Register</a></li>
            <li role="presentation"><a href=""data-toggle="modal" data-target="#myModal" >login</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Online Post UTME</h3>
      </div>


      <!-- Trigger the modal with a button -->
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Login with your registration number to start exam</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="login.php">
          <div class="form-group">
              <input type="text" class="form-control" name="reg" placeholder="registration number">
        </div>

  <button type="submit" class="btn btn-primary" name="login">login</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>