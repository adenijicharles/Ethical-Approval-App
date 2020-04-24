<?php
session_start();
require_once "../connection/connection.php";
require_once "includes/auth.php";
$id = $_GET['id'];
$query = $connection->prepare('SELECT * FROM eaos WHERE id = :id');
$query->bindParam(':id', $id);
$query->execute();
$eaos = $query->fetchAll(PDO::FETCH_ASSOC);
include "includes/header.php";
?>
	<div class="container">
		<div class="top-header">
			Welcome <?php echo $_SESSION['staff']['name']?> <br> Update EAO details
		</div>
		<div class="content">
			<div class="full-width">
				 <form action="handlers/eao/update.php" method="post" enctype="multipart/form-data">
                    <?php foreach($eaos as $eao){?>
					<div class="form-body">
						<label> Officer name </label>
						<input type="hidden" name="id" value="<?php echo $eao['id'];?>" required>
						<input type="text" name="full_name" value="<?php echo $eao['name'];?>" required>
					 </div>
				 	<div class="form-body">
						<label> Email Address </label>
						<input type="text" name="email" required value="<?php echo $eao['email'];?>">
					 </div>		
				 	<div class="form-body">
						<label> Staff ID </label>
						<input type="text" name="staff_id" required value="<?php echo $eao['staff_id'];?>">
				 	</div>					 
				 	<div class="form-body">
						<label> Password </label>
						<input type="password" name="password" required>
				 	</div>					 			 	
				 	<div class="full-width-small">
						<input type="submit" value="UPDATE">
				 	</div>					 						 						 				 								 		 		 	
                    <?php } ?>
				 </form>
			</div>			
		</div>
	</div>
<?php include "includes/footer.php";?>	