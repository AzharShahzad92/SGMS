<?php
session_start();
include_once 'inc/connect.php';
include_once 'inc/redirect.php';

	if(!isset($_SESSION["user_type"])||$_SESSION["user_type"]!="admin")
	{
       header('Location: ../login.php');
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
	
	  if(isset($_SESSION["deletion"])&&$_SESSION["deletion"]==false)
	{
    ?>
        <div class="alert alert-danger" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Failure!</strong> Cannot delete a visible meeting, to delete first set it to hidden!
		</div>
    <?php	
       	   
	}if(isset($_SESSION["deletion"])&&$_SESSION["deletion"]==true){
		?>
	     <div class="alert alert-success" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Success!</strong> Meeting successfully deleted!
		</div>
       <?php	
	}
	
	
	//add new meeting success
       	   
	if(isset($_SESSION["add_meeting_success"])){
		?>
	     <div class="alert alert-success" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Success!</strong> <?php echo $_SESSION["add_meeting_success"];?>
		</div>
       <?php	
	}
	
		if(isset($_SESSION["edit_meeting_success"])){
		?>
	     <div class="alert alert-success" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Success!</strong> <?php echo $_SESSION["edit_meeting_success"];?>
		</div>
       <?php	
	}
	
	

    unset($_SESSION['deletion']);
	unset($_SESSION['add_meeting_success']);
	unset($_SESSION['edit_meeting_success']);
	


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

	.toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20rem; }
	.toggle.ios .toggle-handle { border-radius: 20rem; }
	
	.active{
		background-color:black !important;
		border:none;
	}

.custom-control-input:focus~.custom-control-label::before {
  border-color: black !important;
  box-shadow: 0 0 0 0.2rem rgba(255, 47, 69, 0.25) !important;
}

.custom-control-input:checked~.custom-control-label::before {
  border-color: black !important;
  background-color: black !important;
}

.custom-control-input:active~.custom-control-label::before {
  background-color: black !important;
  border-color: black !important;
}

.custom-control-input:focus:not(:checked)~.custom-control-label::before {
  border-color: black !important;
}

.custom-control-input-green:not(:disabled):active~.custom-control-label::before {
  background-color: black !important;
  border-color: black !important;
}

.list-group a:hover{
	background-color:black !important;
	color:white !important;
}

	</style>
  </head>
 

   
  <?php
     include_once 'inc/navbar.php';
  ?>

  <body class="text-center" data-new-gr-c-s-check-loaded="14.1012.0" data-gr-ext-installed="">

    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column mt-5">
      <main role="main" class="inner cover my-auto">
        <h1 class="cover-heading mt-2">Welcome to FSRIF Online Portal Dashboard</h1>
        <p class="lead">You can add, read, edit or delete<small> (only hidden)</small> a meeting here...</p>
		<br>
      </main>
	  
	  <br>
	  <br>
	  	        <div class="row col-heads" style="margin:0 20% 0 20%;">
				    <div class="col-sm-2 col-md-2 col-lg-2 text-left">
						<a href="add_meeting.php" class="btn btn-dark bg-dark">Add Meeting 
						</svg></a>
					</div>
				</div>
				<br>
				
	  
	            <div class="row col-heads" style="margin:0 20% 0 20%;">
				    <div class="col-sm-2 col-md-2 col-lg-2 text-left">
						<h6>Meeting Nr</h6>
					</div>
					<div class="col-sm-4 col-md-4 col-lg-4 text-left">
						<h6>Meeting Details</h6>
					</div>
					<div class="col-sm-4 col-md-4 col-lg-4 text-left">
						<h6>Group Offered</h6>
					</div>
					<div class="col-sm-2 col-md-2 col-lg-2 text-left">
						<h6>Max Members</h6>
					</div>
				</div>
				<br>
				
	  			<div class="list-group" style="margin:0 20% 0 20%;">
				 <?php 
				    pg_query($db, "set search_path to fsrif");
				    $results = pg_query($db, "SELECT * from getallmeetings();");
					$meetingnr = 1;
                    $status;
                    if(pg_num_rows($results)>0){
					 while ($row_meeting = pg_fetch_assoc($results)) {
						 if($row_meeting['mvisibility']=='t')
							 $status="Visible";
						 else
							 $status="Hidden";
				 
				  ?>
				    
				   <a href="read_meeting.php?mid=<?php echo $row_meeting['meetingid'];?>" class="list-group-item list-group-item-action flex-column align-items-start" style="border: 1px solid;">	
				    <div class="row">
						<div class="col-sm-2 col-md-2 col-lg-2">
							<?php echo $meetingnr;?>
						</div>
						<div class="col-sm-4 col-md-4 col-lg-4 text-left">
						   <h6> <?php echo "Meeting Date : ".$row_meeting['mdate'];?> </h6>
						   <h6> <?php echo "Meeting Place : ".$row_meeting['mplace'];?> </h6>
						   <h6> <?php echo "Start Time: ".date('H:i',strtotime($row_meeting['mst']));?> </h6>
						   <h6> <?php echo "End Time: ".date('H:i',strtotime($row_meeting['met']));?> </h6>
						   <h6> <?php echo "Status: ".$status;?> </h6>
						</div>
						<div class="col-sm-4 col-md-4 col-lg-4 text-left">
						   <?php
						     $gr = pg_query($db, "SELECT topic from study_groups where meeting_id=".$row_meeting['meetingid'].";");
						     if(pg_num_rows($gr)>0){
							 while ($row_groups = pg_fetch_assoc($gr)) {
						   ?>
						     <h6> <?php echo "Topic : ".$row_groups['topic'];?> </h6>
						   <?php
						     }
							 }else
								 echo "No Group added yet!";
						   ?>
						</div> 
						<div class="col-sm-2 col-md-2 col-lg-2 text-left">
						   <?php
						     $mm = pg_query($db, "SELECT count from study_groups where meeting_id=".$row_meeting['meetingid'].";");
							 while ($mc = pg_fetch_assoc($mm)) {
								 
								 if($mc['count']==2147483647)
									 $max_mem = "Unlimited";
								 else
									 $max_mem = $mc['count'];
						   ?>
						     <h6> <?php echo $max_mem;?> </h6>
						   <?php
						     }
						   ?>
						</div> 
				    </div>
					<br>
					<small class="text-center">Click to read more details...</small>
				   </a>
					 
					  <div style="margin-top:5px;" align="left">
						<a href="data/delete_meeting.php?mid=<?php echo $row_meeting['meetingid'];?>" class="btn btn-warning btn-sm">
						  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
							  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
							  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
							</svg>
						</a>
						<a href="edit_meeting.php?mid=<?php echo $row_meeting['meetingid'];?>" class="btn btn-dark btn-sm">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
							  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
							</svg>
						</a>
						
						<?php
						   if($row_meeting['mvisibility']=='t'){
							   
						?>
						<div class="custom-control custom-switch" style="display:inline; float:right !important;">
						  <input type="checkbox" name="visibility" class="custom-control-input visibility input-dark" id="<?php echo $row_meeting['meetingid'];?>" checked>
						  <label class="custom-control-label" for="<?php echo $row_meeting['meetingid'];?>">Meeting Visibility</label>
						</div>
						<?php
						   }else{
						?>
						<div class="custom-control custom-switch" style="display:inline; float:right !important;">
						  <input type="checkbox" name="visibility" class="custom-control-input visibility" id="<?php echo $row_meeting['meetingid'];?>">
						  <label class="custom-control-label" for="<?php echo $row_meeting['meetingid'];?>">Meeting Visibility</label>
						</div>						
						<?php
						   }
						?>
						
					  </div>
					  

					  
				   <br>
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
$(".alert").delay(3000).slideUp(200, function() {
    $(this).alert('close');
});

$(".list-group .list-group-item").first().addClass("active");

$(".visibility").change(function() {

	if(this.checked) {
		
        var visibility = true;
		
		
		$.ajax({
            type: "POST",
            url: "data/visibility.php",
            data: {mid:this.id,mvisibility:visibility} 
        }).done(function(data){

        });
		
    }else{
         var visibility = false;
		
		$.ajax({
            type: "POST",
            url: "data/visibility.php",
            data: {mid:this.id,mvisibility:visibility} 
        }).done(function(data){

        });
	}
		location.reload();
});

</script>
</body></html>