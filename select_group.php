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
	
	if(isset($_GET['mid']))
	  $mid = $_GET['mid'];
    else
	  	header('Location: student_dashboard.php');
	
		 //add new group success
	  if(isset($_SESSION["add_group_success"]))
	{
    ?>
        <div class="alert alert-success msg" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Success!</strong> <?php echo $_SESSION['add_group_success'];?>
		</div>
    <?php
	}
	
	if(isset($_SESSION["join_group_success"]))
	{
    ?>
        <div class="alert alert-success msg" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Success!</strong> You have successfully joined the group
		</div>
    <?php
	}
	
		if(isset($_SESSION["join_group_error"]))
	{
    ?>
        <div class="alert alert-danger msg" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Failure!</strong> The group cannot be joined
		</div>
    <?php
	}
	
		if(isset($_SESSION["leave_group_success"]))
	{
    ?>
        <div class="alert alert-success msg" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Success!</strong> You have successfully left the group
		</div>
    <?php
	}
	
		if(isset($_SESSION["leave_group_error"]))
	{
    ?>
        <div class="alert alert-danger msg" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Failure!</strong> The group cannot be left
		</div>
    <?php
	}
	
	
	
	
	if(isset($_SESSION["edit_group_success"]))
	{
    ?>
        <div class="alert alert-success msg" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Success!</strong> You have successfully edited the group
		</div>
    <?php
	}
	
		if(isset($_SESSION["edit_group_error"]))
	{
    ?>
        <div class="alert alert-danger msg" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Failure!</strong> <?php echo $_SESSION["edit_group_error"]; ?>
		</div>
    <?php
	}
	
	
	
		if(isset($_SESSION["delete_group_success"]))
	{
    ?>
        <div class="alert alert-success msg" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Success!</strong> You have successfully deleted the group
		</div>
    <?php
	}
	
		if(isset($_SESSION["delete_group_error"]))
	{
    ?>
        <div class="alert alert-danger msg" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Failure!</strong> <?php echo $_SESSION["delete_group_error"]; ?>
		</div>
    <?php
	}
	
	unset($_SESSION['add_group_success']);
	unset($_SESSION['join_group_success']);
	unset($_SESSION['join_group_error']);
	unset($_SESSION['leave_group_success']);
	unset($_SESSION['leave_group_error']);
	unset($_SESSION['edit_group_success']);
	unset($_SESSION['edit_group_error']);
	unset($_SESSION['delete_group_success']);
	unset($_SESSION['delete_group_error']);

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
				  <h4 class="alert-heading">Select a Study Group To Join</h4>
				  <p>You can also create a new study group, any previouly joined group will be automatically left!</p>
				</div>
				<br>
				
				<div style="margin:0 20% 0 20%;">
				    <div class="text-left">
						<a href="add_group.php?mid=<?php echo $mid;?>" class="btn btn-dark bg-dark">Add a New Study Group
					    </svg></a>
					</div>	
				</div>
				<br>
				
	  
	            <div class="row alert-dark" style="margin:0 20% 1% 20%; padding:2% 0 2% 0">
				    <div class="col-sm-1 col-md-1 col-lg-1 text-left">
						<h6>#</h6>
					</div>
					<div class="col-sm-2 col-md-2 col-lg-2 text-left">
						<h6>Topic</h6>
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3 text-left">
						<h6>Description</h6>
					</div>
					<div class="col-sm-2 col-md-2 col-lg-2 text-left">
						<h6>Members</h6>
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3 text-left">
						<h6>Join/Leave Group</h6>
					</div>
					<div class="col-sm-1 col-md-1 col-lg-1 text-left">
						<h6>Joined</h6>
					</div>
				</div>

				
	  			<div class="list-group" style="margin:0 20% 0 20%;">
				 <?php 
				    pg_query($db, "set search_path to fsrif");
				    $results = pg_query($db, "SELECT * from study_groups where meeting_id=".$mid.";");
					$studygroupnr = 1;
					$isjoined = false;
					$sid = $_SESSION['sid'];

					
                    if(pg_num_rows($results)>0){
					 while ($row_sg = pg_fetch_assoc($results)) {
						 
						 $sgid = $row_sg['sgid'];
						 $join_result = pg_query($db, "SELECT isjoinable('$sgid')");
						 $isjoinable= pg_fetch_array($join_result);
						 
						 $joined_result = pg_query($db, "SELECT isjoined('$sid','$sgid')");
					     $joined = pg_fetch_array($joined_result);
					     $isjoined = $joined[0];
						 
						 if($isjoinable[0]=='t' || $isjoined=='t'){
						 
						 
						 
						 
						 $mem_result = pg_query($db, "SELECT getmembers('$sgid')");
						 $count_mem = pg_fetch_array($mem_result);
						 $count = $count_mem[0];

						

						 $owner_result = pg_query($db, "SELECT isowner('$sid','$sgid')");
						 $owner = pg_fetch_array($owner_result);
						 $isowner= $owner[0];

                        	if($row_sg['count']==2147483647)
								$max_mem = "Unlimited";
							else
								$max_mem = $row_sg['count'];						 
				 
				  ?>
				    
				    <div class="row">
						<div class="col-sm-1 col-md-1 col-lg-1">
							<?php echo $studygroupnr;?>
						</div>
						<div class="col-sm-2 col-md-2 col-lg-2 text-left">
						   <h6> <?php echo $row_sg['topic'];?> </h6>
						</div>
						
						<div class="col-sm-3 col-md-3 col-lg-3 text-left">
						   <h6> <?php echo $row_sg['description'];?> </h6>
						</div> 
						
						<div class="col-sm-2 col-md-2 col-lg-2 text-left">
							 <h6> <?php echo $count." / ".$max_mem;?> </h6>
						</div> 
						
						<?php
						   if($isjoined=='t'){
						?>
						
						<div class="col-sm-3 col-md-3 col-lg-3 text-left"> 
						   <h6> <a href="data/leave_group.php?sgid=<?php echo $sgid."&mid=".$mid;?>" class="btn btn-dark">leave</a> </h6>
						</div>			
						
						<div class="col-sm-1 col-md-1 col-lg-1 text-left"> 
						   <h6 class="mt-2"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
							  <path d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z"/>
							</svg> </h6>
						</div>
						<?php
						   }else{
						?>
						<div class="col-sm-3 col-md-3 col-lg-3 text-left"> 
						   <h6> <a href="data/join_group.php?sgid=<?php echo $row_sg['sgid']."&mid=".$mid;?>" class="btn btn-dark">Join</a> </h6>
						</div>

						<div class="col-sm-1 col-md-1 col-lg-1 text-left"> 
						   <h6 class="mt-2"> 
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
								  <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
								</svg>
						   </h6>
						</div>						
						<?php
						   }
						?>
				    </div>
					
					  <!--Edit/Delete Buttons -->
					  <?php
					      if($isowner=='t'){
					  ?>
					  <div style="margin-top:5px; margin-left:2%;" align="left">
						<a href="data/delete_group.php?sgid=<?php echo $sgid."&mid=".$mid;?>" class="btn btn-warning btn-sm">
						  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
							  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
							  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
							</svg>
						</a>
						<a href="edit_group.php?sgid=<?php echo $sgid."&mid=".$mid;?>" class="btn btn-dark btn-sm">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
							  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
							</svg>
						</a>
					  </div>
					  <?php
						  }
					  ?>
					  <!--Edit/Delete Buttons Ends Here-->
					<br>  
				   <br>
				   
				  <?php
				      ++$studygroupnr;
					 }else
						 echo "<tr><td>No Groups added yet!<td><tr>";
					 }
					 }else
						echo "<tr><td>No Groups added yet!<td><tr>";
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
$(".msg").delay(3000).slideUp(200, function() {
    $(this).alert('close');
});

$(".list-group .list-group-item").first().addClass("active");

</script>
</body></html>