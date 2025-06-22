<?php
session_start();
include_once 'inc/connect.php';
include_once 'inc/redirect_admin.php';

	if(!isset($_SESSION["user_type"])||$_SESSION["user_type"]!="student")
	{
       header('Location: ../student_login.php');
       $_SESSION['unaccess'] = true;	   
	}
	
	$sid = $_SESSION['sid'];
	
	if(isset($_GET['sgid'])){
	  $sgid = $_GET['sgid'];
	  $mid= $_GET['mid'];
	  
	    pg_query($db, "set search_path to fsrif");
	  	$owner_result = pg_query($db, "SELECT isowner('$sid','$sgid')");
		$owner = pg_fetch_array($owner_result);
		$isowner= $owner[0];
		
	}else{
		header('Location: ../student_dashboard.php');
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
			<h4 class="alert-heading">Edit a Study Group</h4>
			<p>You can only edit a group if you are owner of the group</p>
		</div>
		<br>
		
		<?php
		   if($isowner=='t'){
			   $result = pg_query($db, "SELECT * from study_groups where sgid=".$sgid);
		       $rows= pg_fetch_assoc($result);
			   $topic = $rows['topic'];
			   $description = $rows['description'];
			   $limit = $rows['count'];
			   
		?>
		   <form action="data/edit_group.php" method="post" class="text-left">
			  <div class="form-group">
				<label for="topic">Topic</label>
				<input type="text" class="form-control" value="<?php echo $topic;?>" id="topic" name="topic" placeholder="Enter topic" required>
			  </div>
			  
			  <input type="number" name="sgid" value="<?php echo $sgid;?>" hidden>
			  <input type="number" name="mid" value="<?php echo $mid;?>" hidden>
			  
			  <div class="form-group">
				<label for="description">Description</label>
				<input type="text" value="<?php echo $description;?>" class="form-control" name="description" id="description" placeholder="Enter description" required>
			  </div>
			  
			  
			  <div class="form-group">
				<label for="limit">Allowed members</label>
				<input type="number" value="<?php echo $limit;?>" class="form-control" name="limit" min="2" id="limit" placeholder="Enter limit" required>
			    <input type="checkbox" onchange="doalert(this)" name="unlimited"> Unlimited
				<small id="limitHelp" class="form-text text-muted">Minimum members can be 2</small>
			  </div>  
			  
			  <br>
			  <button type="submit" class="btn btn-dark">Save Changes</button>
		  </form>
		<?php
		   }else{
		?>  
		
		  <div class="alert alert-danger">
		       <h6>Authetication Error!</h6> You don't have permission to edit this group
		  </div>

         <?php
		    
		   }
		 ?>		
	  

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


function doalert(checkboxElem) {
  if (checkboxElem.checked) {
    document.getElementById("limit").value = 2147483647;
  } else {
    document.getElementById("limit").value = 2;
  }
}

</script>
</body></html>