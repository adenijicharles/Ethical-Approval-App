<?php
session_start();
require_once "../connection/connection.php";
require_once "includes/auth.php";
$experiment_id = $_GET['id'];
$query = $connection->prepare('SELECT approval_requests.id AS arid, experiments.id AS eid, approval_requests.*, experiments.* FROM approval_requests LEFT JOIN experiments ON approval_requests.experiment_id =  experiments.id  WHERE approval_requests.id = :experiment_id');
$query->bindParam(':experiment_id', $experiment_id);
$query->execute();
$experiments = $query->fetchAll(PDO::FETCH_ASSOC);

$query1 = $connection->prepare('SELECT * FROM eaos ORDER BY name ASC');
$query1->execute();
$eaos = $query1->fetchAll(PDO::FETCH_ASSOC);
include "includes/header.php";
?>
	<div class="container">
		<div class="top-header">
			Welcome <?php echo $_SESSION['staff']['name']?> 			
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
                <form action="handlers/requests/assign.php" enctype="multipart/form-data" method="post">
                    <div class="form-body">
						<label> <b>Assign Approval Request to Experiment Approval Officers</label>
						<table>
							<tr>
								<td> Select </td>
								<td> Name </td>
							</tr>
							<?php foreach($eaos as $eao){?>
							<tr>
								<td> <input type="checkbox" name="eao[]" value="<?php echo $eao['staff_id'];?>"> </td>
								<td> <?php echo $eao['name'];?> </td>
							</tr>	
							<?php }?>						
						</table>
				 	</div>                
				 	<div class="full-width-small">
						 <input type="hidden" name="request_id" value="<?php echo $experiment['arid'];?>">
						<input type="submit" value="ASSIGN REQUEST">
				 	</div>	
                </form>
            </div>	
		</div>
		<?php } ?>
	</div>
<?php include "includes/footer.php";?>	