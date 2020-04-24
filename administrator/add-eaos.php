<?php
session_start();
require_once "../connection/connection.php";
require_once "includes/auth.php";
include "includes/header.php";
?>
	<div class="container">
		<div class="top-header">
			Welcome <?php echo $_SESSION['staff']['name']?> <br>
			ADD EXPERIMENT APPROVAL OFFICERS 
		</div>
		<div class="content">
			<div class="full-width">
				 <form action="handlers/eao/add.php" method="post">
				 	<div class="form-body">
						<label> Officer name </label>
						<input type="text" name="full_name" required>
					 </div>
				 	<div class="form-body">
						<label> Email Address </label>
						<input type="text" name="email" required>
					 </div>		
				 	<div class="form-body">
						<label> Staff ID </label>
						<input type="text" name="staff_id" required>
				 	</div>					 
				 	<div class="form-body">
						<label> Password </label>
						<input type="password" name="password" required>
				 	</div>					 			 	
				 	<div class="full-width-small">
						<input type="submit" value="SUBMIT">
				 	</div>					 				 						 				 								 		 		 	
				 </form>
			</div>			
		</div>
	</div>
<?php include "includes/footer.php";?>	