<?php
session_start();
require_once "../connection/connection.php";
require_once "includes/auth.php";
$experiment_id = $_GET['id'];
$query = $connection->prepare('SELECT * FROM experiments WHERE id = :experiment_id');
$query->bindParam(':experiment_id', $experiment_id);
$query->execute();
$experiments = $query->fetchAll(PDO::FETCH_ASSOC);

$sql = $connection->prepare('SELECT * FROM approval_requests WHERE experiment_id = :experiment_id');
$sql->bindParam(':experiment_id', $experiment_id);
$sql->execute();
$approval = $sql->fetchAll(PDO::FETCH_ASSOC);
include "includes/header.php";
?>
	<div class="container">
		<div class="top-header">
			Welcome <?php echo $_SESSION['user']['name']?> 			
		</div>
		<div class="content">
			<div class="full-width">
                    <?php foreach($experiments as $experiment){?>
				 	<div class="form-body">
						<b> Experiment Title </b> <br>
						<?php echo $experiment['title'];?>
				 	</div>
				 	<div class="form-body" style="width: 500px; margin: 0;">
						<b> Description </b> <br>
                        <input type="hidden" name="id" value="<?php echo $experiment['id'];?>">
						<?php echo $experiment['description'];?>
				 	</div>					 				 						 				 								 		 		 	
                    <?php } ?>
			</div>		
            <div class="full-width">
            <?php foreach($approval as $a){?>
                <form action="handlers/requests/update.php" enctype="multipart/form-data" method="post">
                    <div class="form-body">
						<label> Reasons why experiment should be approved </label>
						<textarea name="reasons" required><?php echo $a['reasons']?></textarea>
				 	</div>                
                    <div class="form-body">
						<label> Upload Documents to back your requests </label>
						<input type="file" name="files[]" multiple required>
						<input type="hidden" name="id" value="<?php echo $a['id'] ?>">
				 	</div>	
				 	<div class="full-width-small">
						<input type="submit" value="UPDATE REQUEST">
				 	</div>	
                </form>
            <?php } ?>
            </div>	
		</div>
	</div>
<?php include "includes/footer.php";?>	