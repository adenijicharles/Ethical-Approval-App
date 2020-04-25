<?php
session_start();
require_once "../connection/connection.php";
require_once "includes/auth.php";
$experiment_id = $_GET['id'];
$query = $connection->prepare('SELECT approval_requests.id AS arid, experiments.id AS eid, approval_requests.*, experiments.* FROM approval_requests LEFT JOIN experiments ON approval_requests.experiment_id =  experiments.id  WHERE approval_requests.id = :experiment_id');
$query->bindParam(':experiment_id', $experiment_id);
$query->execute();
$experiments = $query->fetchAll(PDO::FETCH_ASSOC);

include "includes/header.php";
?>
	<div class="container">
		<div class="top-header">
			Welcome <?php echo $_SESSION['eao']['name']?> 			
		</div>
		<?php foreach($experiments as $experiment){?>
		<div class="content">
			<div class="full-width">
				 	<div class="form-body">
						<b> Experiment Title </b> <br>
						<?php echo $experiment['title'];?>
				 	</div>
				 	<div class="form-body" style="width: 500px; margin: 10px 0;">
						<b> Description </b> <br>
						<?php echo $experiment['description'];?>
					 </div>					 				 						 				 								 		 		 	
					 <div class="form-body" style="width: 500px; margin: 30px 0;">
						<b> Reasons why experiment should be approved </b> <br>
						<?php echo $experiment['reasons'];?>
					 </div>
					 
					 <div class="form-body" style="width: 500px; margin: 30px 0;">
						<b> Backing Documents </b> <br>
						<?php 
							$files = json_decode($experiment['files'], true);
							foreach($files as $file){
								echo "<a href='../uploads/$file' target='_blank'> $file </a><br>";
							}
						;?>
				 	</div>
			</div>		
            <div class="full-width">
                <form action="handlers/requests/send-feedback.php" enctype="multipart/form-data" method="post">
					<div class="form-body">
						<label> Feedback </label>
						<textarea name="feedback" required></textarea>
				 	</div>                
                    <div class="form-body">
						<label> Select Approval Status </label>
						<select name="status" required>
							<option value="" selected></option>
							<option value="1"> Approve </option>
							<option value="2"> Deny </option>
						</select>
						<?php
							$request_id = $experiment['arid'];
							$query = $connection->prepare('SELECT * FROM assigned_requests WHERE request_id = :rid');
							$query->bindParam(':rid', $request_id);
							$query->execute();
							$details = $query->fetch(PDO::FETCH_ASSOC);
						?>
						<input type="hidden" name="id" value="<?php echo $details['id']; ?>">
						<input type="hidden" name="exid" value="<?php echo $experiment_id; ?>">
				 	</div>	
				 	<div class="full-width-small">
						<input type="submit" value="SUBMIT FEEDBACK">
				 	</div>	
                </form>
            </div>	
		</div>
		<?php } ?>
	</div>
<?php include "includes/footer.php";?>	