<?php
session_start();
include_once 'inc/connect.php';
include_once 'inc/redirect_admin.php';

	if(!isset($_SESSION["user_type"])||$_SESSION["user_type"]!="student")
	{
       header('Location: login.php');
       $_SESSION['unaccess'] = true;	   
	}
	
		if(isset($_GET['mid']))
		$mid = $_GET['mid'];
			else
	  	header('Location: student_dashboard.php');
	 
	 //add new group error
	  if(isset($_SESSION["add_group_error"]))
	{
    ?>
        <div class="alert alert-danger msg" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Failure!</strong> <?php echo $_SESSION['add_group_error'];?>
		</div>
    <?php
	}
	unset($_SESSION['add_group_error']);	
	
	

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
		
		.cover, inner p{
		   color:balck !important;
		}
		
		form{
		    margin: 2% 40% 5% 40%;
		}
		
		.form-group button:hover{
			color:white !important;
			background-color:grey !important;
		}
		
		.col-heads h6{
			color:black;
		}

	
	.active{
		background-color:black !important;
		border:none;
	}


.list-group a:hover{
	background-color:black !important;
	color:white !important;
}

	</style>
  </head>
  
  <?php
     include_once 'inc/navbar_student.php';
  ?>

  <body class="text-center" data-new-gr-c-s-check-loaded="14.1012.0" data-gr-ext-installed="">

    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
      <main role="main" class="inner cover my-auto">
        <h1 class="cover-heading mt-2">Welcome to FSRIF Online Portal Dashboard</h1>
        <p class="lead">Add a New Study Group</p>
		<br>
      
		   <form action="data/add_group.php" method="post" class="text-left">
			  <div class="form-group">
				<label for="topic">Topic</label>
				<input type="text" class="form-control" id="topic" name="topic" placeholder="Enter topic" required>
			  </div>
			  
			  <input type="number" name="mid" value="<?php echo $mid;?>" hidden>
			  
			  <div class="form-group">
				<label for="description">Description</label>
				<input type="text" class="form-control" name="description" id="description" placeholder="Enter description" required>
			  </div>
			  
			  
			  <div class="form-group">
				<label for="limit">Allowed members</label>
				<input type="number" class="form-control" name="limit" min="2" id="limit" placeholder="Enter limit" required>
			    <input type="checkbox" onchange="doalert(this)" name="unlimited"> Unlimited
				<small id="limitHelp" class="form-text text-muted">Minimum members can be 2</small>
			  </div>
			  

			  
			  
			  <br>
			  <button type="submit" class="btn btn-dark">Add Study Group</button>
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
<script>
$(".alert").delay(3000).slideUp(200, function() {
    $(this).alert('close');
});


function doalert(checkboxElem) {
  if (checkboxElem.checked) {
    document.getElementById("limit").value = 2147483647;
  } else {
    document.getElementById("limit").value = 2;
  }
}
</script>
</body></html>