<?php
session_start();
include_once 'inc/session.php';

	if(isset($_SESSION["login_error"])&&$_SESSION["login_error"]==true)
	{
	?>
	
		  <div class="alert alert-danger" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Failure!</strong> Invalid Credentials!
		  </div>
	<?php
      unset($_SESSION["login_error"]);	   
	}
	
    if(isset($_SESSION["unaccess"])&&$_SESSION["unaccess"]==true)
	{
	?>
	
		  <div class="alert alert-danger" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Failure!</strong> Unauthorized Access!
		  </div>
	<?php
      unset($_SESSION["unaccess"]);	   
	}




  

?>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>FSRIF</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/cover/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
	    body{
		   background-color:black;
		}
		
		.cover, inner p{
		   color:white !important;
		}
		
		form{
		    margin: 2% 35% 5% 35%;
		}
		
		.form-group button:hover{
			color:white !important;
			background-color:grey !important;
		}
	</style>
  </head>

  <body class="text-center" data-new-gr-c-s-check-loaded="14.1012.0" data-gr-ext-installed="">

    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
      <div style="left:0px; position:absolute; margin:5%;">
	      <a href="index.php" style="color:white;text-decoration: none;"> 
		  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
			  <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
		  </svg>&nbsp Go Back</a>
	  </div>
      <main role="main" class="inner cover my-auto">
        <h1 class="cover-heading">Welcome to FSRIF Online Portal Student Signup</h1>
        <p class="lead">Please enter your Details.</p>
		<br>
			<form action="data/signup.php" method="post">
				<div class="form-group text-left">
				  <label for="email">Username:</label>
				  <input type="text" class="form-control" placeholder="Enter username" name="username">
				</div>
				<div class="form-group text-left">
				  <label for="pwd">Password:</label>
				  <input type="password" class="form-control" placeholder="Enter password" name="pwd">
				</div>
				
				<br>
				<div class="form-group text-left">
					<button type="submit" class="btn btn-secondary">Signup</button>
				</div>	
			 </form>
      </main>

      <footer class="mastfoot mt-auto">
        <div class="inner">
          <p>Desgined & Developed For TU CHEMNITZ, By@Azhar Shahzad.</p>
        </div>
      </footer>
    </div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<>
<script>
$(".alert").delay(3000).slideUp(200, function() {
    $(this).alert('close');
});
</script>
</body></html>