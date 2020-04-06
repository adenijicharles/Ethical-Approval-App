<?php
session_start();
require_once "../connection/connection.php";
require_once "includes/auth.php";
include "includes/header.php";
?>
	<div class="container">
		<div class="top-header">
			Welcome <?php echo $_SESSION['user']['name']?> 			
		</div>
		<div class="content">
			<div class="full-width">
				 <form action="handlers/experiments/add.php" method="post" enctype="multipart/form-data">
				 	<div class="form-body">
						<label> Experiment Title </label>
						<input type="text" name="title" required>
				 	</div>
				 	<div class="form-body">
						<label> Description </label>
						<textarea name="description" required></textarea>
				 	</div>	
				 	<div class="full-width-small">
						<input type="submit" value="CREATE EXPERIMENT">
				 	</div>					 				 						 				 								 		 		 	
				 </form>
			</div>			
		</div>
	</div>
<?php include "includes/footer.php";?>	