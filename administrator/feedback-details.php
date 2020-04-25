<?php
session_start();
require_once "../connection/connection.php";
require_once "includes/auth.php";
$experiment_id = $_GET['id'];
$query = $connection->prepare('SELECT approval_requests.id AS arid, experiments.id AS eid, approval_requests.*, experiments.* FROM approval_requests LEFT JOIN experiments ON approval_requests.experiment_id = experiments.id  WHERE approval_requests.id = :experiment_id');
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
                    <div class="form-body">
                        <label> <b>Experiment Approval Officers Feedbacks</b></label>
                        
                        <?php
                            $query2 = $connection->prepare('SELECT * FROM assigned_requests LEFT JOIN eaos ON assigned_requests.eao_id = eaos.staff_id WHERE assigned_requests.request_id = :id');
                            $query2->bindParam(':id', $experiment['arid']);
                            $query2->execute();
                            $eaos = $query2->fetchAll(PDO::FETCH_ASSOC);
                            foreach($eaos as $eao){
                        ?>
                            <b>EXPERIMENT APPROVAL OFFICER: </b><?php echo $eao['name'];?> <br>
                            <b>FEEDBACK: </b><?php echo $eao['feedback'];?><br>
                            <b>FEEDBACK STATUS: </b><?php echo $eao['feedback_status'] == 1 ? 'Approved' : 'Denied';?><br>
                            <hr>
                        <?php } ?>
						
                     </div>    
                    <form action="handlers/requests/final.php" method="post">            
                        <div class="full-width-small">
                            <label> <b>Administrator Final Approval</b></label> <hr>
                            <label> Select Final Approval Status </label>
                            <select name="status" required>
                                <option value="" selected></option>
                                <option value="1"> Approve </option>
                                <option value="2"> Deny </option>
                            </select>
                            <input type="hidden" name="experiment_id" value="<?php echo $experiment['eid'];?>">
                            <input type="hidden" name="id" value="<?php echo $experiment_id;?>">
                            <input type="submit" value="SUBMIT">
                        </div>	
                    </form>
            </div>	
		</div>
		<?php } ?>
	</div>
<?php include "includes/footer.php";?>	