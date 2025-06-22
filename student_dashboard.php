<?php
session_start();
include_once 'inc/connect.php';
include_once 'inc/redirect_admin.php';

	if(!isset($_SESSION["user_type"])||$_SESSION["user_type"]!="student")
	{
       header('Location: ../student_login.php');
       $_SESSION['unaccess'] = true;	   
	}
	
	//hide all those meeting that have passed before the app starts
	pg_query($db, "set search_path to fsrif");	
	$allvisbility = pg_query($db, "select changemeetingvisibility()");
     
	 if(!$allvisbility)
	{
    ?>
        <div class="alert alert-danger" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Failure!</strong> Unexpected Error! Contact administrator
		</div>
    <?php		
	}
	

?>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>FSRIF</title>

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
   
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
   
     <!--Message Div for visibility-->
     <div class="alert alert-success vis_msg" id="vis_msg" role="alert" style="display:none;">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>			
     </div>   

   
  <?php
     include_once 'inc/navbar_student.php';
  ?>

  <body class="text-center" data-new-gr-c-s-check-loaded="14.1012.0" data-gr-ext-installed="">

    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
      <main role="main" class="inner cover my-auto">
        <h1 class="cover-heading mt-2">Welcome to FSRIF Online Portal Dashboard</h1>
        <p class="lead">You can add, join, edit or delete<small> (only yours)</small> a Study Group here...</p>
		<br>
      </main>
	  
	  <br>


				<div class="alert alert-dark text-left" role="alert" style="margin:0 20% 0 20%;">
				  	<form action="data/change_name.php" class="form-inline text-left" method="POST">
						  <div class="form-group mr-3" style="right:0;position:absolute;">
							<input type="text" class="form-control" name="nname" value="<?php echo $_SESSION["student_name"];?>" required>
						    <button type="submit" class="btn btn-dark">Change Name</button>
						  </div>
						  
					</form>
				  <h4 class="alert-heading">Select a Meeting</h4>
				  <p>Please select a meeting to show corresponding Study Groups. You can join any group that you wish to. You can only join one group at the same time!</p>
				</div>
				<br>
				
	  
	            <div class="row col-heads alert-dark" style="margin:0 20% 0 20%; padding:2% 0 2% 0">
				    <div class="col-sm-2 col-md-2 col-lg-2 text-left">
						<h6>Meeting Nr</h6>
					</div>
					<div class="col-sm-2 col-md-2 col-lg-2 text-left">
						<h6>Place</h6>
					</div>
					<div class="col-sm-2 col-md-2 col-lg-2 text-left">
						<h6>Date</h6>
					</div>
					<div class="col-sm-2 col-md-2 col-lg-2 text-left">
						<h6>Start Time</h6>
					</div>
					<div class="col-sm-2 col-md-2 col-lg-2 text-left">
						<h6>End Time</h6>
					</div>
				</div>

				
	  			<div class="list-group" style="margin:0 20% 0 20%;">
				 <?php 
				    pg_query($db, "set search_path to fsrif");
				    $results = pg_query($db, "SELECT * from getvisiblemeetings();");
					$meetingnr = 1;
                    if(pg_num_rows($results)>0){
					 while ($row_meeting = pg_fetch_assoc($results)) {
				 
				  ?>
				    
				   <a href="select_group.php?mid=<?php echo $row_meeting['meetingid'];?>" class="list-group-item list-group-item-action flex-column align-items-start">	
				    <div class="row">
						<div class="col-sm-2 col-md-2 col-lg-2">
							<?php echo $meetingnr;?>
						</div>
						<div class="col-sm-2 col-md-2 col-lg-2 text-left">
						   <h6> <?php echo $row_meeting['mplace'];?> </h6>
						</div>
						
						<div class="col-sm-2 col-md-2 col-lg-2 text-left">
						   <h6> <?php echo $row_meeting['mdate'];?> </h6>
						</div> 
						
						<div class="col-sm-2 col-md-2 col-lg-2 text-left">
							 <h6> <?php echo date('H:i',strtotime($row_meeting['stime']));?> </h6>
						</div> 
						 
						<div class="col-sm-2 col-md-2 col-lg-2 text-left"> 
						   <h6> <?php echo date('H:i',strtotime($row_meeting['etime']));?> </h6>
						</div>
				    </div>
					<br>
					<small class="text-center">Click to view Study Groups...</small>
				   </a>

					  
				   <br>
				   
				  <?php
				      ++$meetingnr;
					 }
					 }else
						echo "No Meeting added yet!";
				  ?>
				</div>

      <footer class="mastfoot mt-auto">
        <div class="inner">
          <p>Desgined & Developed For TU CHEMNITZ, By@Azhar Shahzad.</p>
        </div>
      </footer>
    </div>

<script src="http://code.jquery.com/jquery.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>


<script>
$(".show_msgs").delay(3000).slideUp(200, function() {
    $(this).alert('close');
});

$(".list-group .list-group-item").first().addClass("active");

</script>
</body></html>