<?php
session_start();
include_once 'inc/connect.php';
include_once 'inc/redirect.php';

	if(!isset($_SESSION["user_type"])||$_SESSION["user_type"]!="admin")
	{
       header('Location: login.php');
       $_SESSION['unaccess'] = true;	   
	}
	
	
	$meetingid=$_GET['mid'];
	

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
        <p class="lead">Meetings & respective groups details</p>
		<br>
      
	 
	  
 <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>Meeting place</th>
        <th>Meeting date</th>
        <th>Start time</th>
        <th>End time</th>
		<th>Status</th>
      </tr>
    </thead>
    <tbody>
      <tr>
				<?php 
				    pg_query($db, "set search_path to fsrif");
				    $results = pg_query($db, "SELECT * from meetings where mid=".$meetingid.";");
                    $status;
					$row_meeting = pg_fetch_assoc($results);
						 if($row_meeting['visibility']=='t')
							 $status="Visible";
						 else
							 $status="Hidden";
				 
				  ?>
				  <td><?php echo $row_meeting['place'];?></td>
				  <td><?php echo $row_meeting['date'];?></td>
				  <td><?php echo date('H:i',strtotime($row_meeting['start_time']));?></td>
				  <td><?php echo date('H:i',strtotime($row_meeting['end_time']));?></td>
				  <td><?php echo $status;?></td>
			  </tr>
			</tbody>
		  </table>
		  </div>
		  
		  
		  
	   <div class="table-responsive">          
		  <table class="table">
			<thead>
			  <tr>
				<th>#</th>
				<th>Group Topic</th>
				<th>Group Description</th>
				<th>Joined Members</th>
				<th>Members Limit</th>
				<th>Members List</th>
			  </tr>
			</thead>
			<tbody>
				<?php 
				    $sr = 1;
				    pg_query($db, "set search_path to fsrif");
				    $results = pg_query($db, "SELECT * from study_groups where meeting_id=".$meetingid.";");
					if(pg_num_rows($results)>0){
					   while($row_groups = pg_fetch_assoc($results)){
						   $mem_count = pg_query($db, "SELECT count(*) from members where study_group_id=".$row_groups['sgid'].";");
						   $count = pg_fetch_array($mem_count);
						   
						   $names="";
						   $student_names_query = pg_query($db, "SELECT * from members left join students on (members.student_id=students.sid) where study_group_id=".$row_groups['sgid'].";");
				           while($name_row = pg_fetch_array($student_names_query)){
									$names = $names.$name_row['name'].", ";
							  }
							$names = rtrim($names, ", ");
									if($row_groups['count']==2147483647)
									 $max_mem = "Unlimited";
								 else
									 $max_mem = $row_groups['count'];   
				   
				  ?>
				  <tr>
					  <td><?php echo $sr;?></td>
					  <td><?php echo $row_groups['topic'];?></td>
					  <td><?php echo $row_groups['description'];?></td>
					  <td><?php echo $count[0];?></td>
					  <td><?php echo $max_mem;?></td>
					  <td><?php echo $names;?></td>
				  </tr>
				  <?php
					  ++$sr;
					}}else
					   echo "<td>No Groups Added Yet!!</td>";
				  
				  ?>
			</tbody>
		  </table>
		  </div>

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