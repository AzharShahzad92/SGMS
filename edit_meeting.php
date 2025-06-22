<?php
session_start();
include_once 'inc/connect.php';
include_once 'inc/redirect.php';

error_reporting(0);

	if(!isset($_SESSION["user_type"])||$_SESSION["user_type"]!="admin")
	{
       header('Location: login.php');
       $_SESSION['unaccess'] = true;	   
	}
	
	$mid = $_GET['mid'];
	
	pg_query($db, "set search_path to fsrif");
	$meeting = pg_query($db, "select * from meetings where mid=".$mid.";");
	$meeting_details = pg_fetch_assoc($meeting);
	
	$stime = $meeting_details['start_time'];
	$etime =  $meeting_details['end_time'];
	
	

	
	//echo $time;

	
	//edit new meeting error
	  if(isset($_SESSION["edit_meeting_error"]))
	{
    ?>
        <div class="alert alert-danger" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Failure!</strong> <?php echo $_SESSION['edit_meeting_error'];?>
		</div>
    <?php
	}
	unset($_SESSION['edit_meeting_error']);	
	

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
		

	</style>
  </head>
  
  <?php
     include_once 'inc/navbar.php';
  ?>

  <body class="text-center" data-new-gr-c-s-check-loaded="14.1012.0" data-gr-ext-installed="">

    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
      <main role="main" class="inner cover my-auto">
        <h1 class="cover-heading mt-2">Welcome to FSRIF Online Portal Dashboard</h1>
        <p class="lead">Edit Meeting</p>
		<br>
      
		   <form action="data/edit_meeting.php" method="post" class="text-left">
			  <div class="form-group">
				<label for="meetingplace">Meeting Place</label>
				<input type="text" class="form-control" value="<?php echo $meeting_details['place'];?>" id="meetingplace" name="place" aria-describedby="emailHelp" placeholder="Enter place" required>
			  </div>
			  
			  <input name="meetingid" value="<?php echo $mid;?>" hidden="true">
			  
			  <div class="form-group">
				<label for="meetingdate">Meeting Date</label>
				<input type="date" class="form-control" value="<?php echo $meeting_details['date'];?>" name="date" id="meetingdate" placeholder="Enter date" required>
			  </div>
			  
			  <div class="form-group">
				<label for="meetingstarttime">Meeting Start time</label>
				<input type="time" class="form-control" name="stime" value="<?php echo $stime;?>" id="meetingstarttime" placeholder="Enter start time" required>
			  </div>
			  
			  <div class="form-group">
				<label for="meetingendtime">Meeting End time</label>
				<input type="time" class="form-control" name="etime" value="<?php echo $etime;?>" id="meetingendtime" placeholder="Enter end time"required>
			  </div>
			  
			  <br>
			  <button type="submit" class="btn btn-dark">Save changes</button>
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


</script>
</body></html>