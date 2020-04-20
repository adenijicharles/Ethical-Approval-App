<?php
session_start();
require_once "../connection/connection.php";
require_once "includes/auth.php";
$experiment_id = $_GET['id'];
$query = $connection->prepare('SELECT * FROM experiments WHERE id = :experiment_id');
$query->bindParam(':experiment_id', $experiment_id);
$query->execute();
$experiments = $query->fetchAll(PDO::FETCH_ASSOC);
include "includes/header.php";
?>
	<div class="container">
		<div class="top-header">
			Welcome <?php echo $_SESSION['user']['name']?> 			
		</div>
		<div class="content">
			<div class="full-width">
				 <form action="handlers/experiments/update.php" method="post" enctype="multipart/form-data">
                    <?php foreach($experiments as $experiment){?>
				 	<div class="form-body">
						<label> Experiment Title </label>
						<input type="text" name="title" required value="<?php echo $experiment['title'];?>">
				 	</div>
				 	<div class="form-body">
						<label> Description </label>
                        <input type="hidden" name="id" value="<?php echo $experiment['id'];?>">
						<textarea name="description" required><?php echo $experiment['description'];?></textarea>
				 	</div>	
				 	<div class="full-width-small">
						<input type="submit" value="UPDATE EXPERIMENT">
				 	</div>					 				 						 				 								 		 		 	
                    <?php } ?>
				 </form>
			</div>			
		</div>
	</div>
<?php include "includes/footer.php";?>	