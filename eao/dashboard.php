<?php
session_start();
require_once "../connection/connection.php";
require_once "includes/auth.php";
$query = $connection->prepare('SELECT approval_requests.id AS arid, experiments.id AS eid, approval_requests.*, assigned_requests.*, experiments.*, students.* FROM approval_requests LEFT JOIN experiments ON approval_requests.experiment_id = experiments.id LEFT JOIN students ON experiments.student_id = students.student_id LEFT JOIN assigned_requests ON approval_requests.id = assigned_requests.request_id WHERE assigned_requests.eao_id = :eao_id ORDER BY assigned_requests.id DESC');
$query->bindParam(':eao_id', $_SESSION['eao']['staff_id']);
$query->execute();
$requests = $query->fetchAll(PDO::FETCH_ASSOC);
include "includes/header.php";
?>
	<div class="container">
		<div class="top-header">
			Welcome <?php echo $_SESSION['eao']['name']?> <br>
			EXPERIMENT APPROVAL REQUESTS 
		</div>
		<div class="content cf">
            <table class="table">
                <thead>
                    <tr>
                        <th> Experiment Title </th>
                        <th> Submitted By </th>
                        <th> Your Approval Status</th>
                        <th> Actions </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($requests as $request){ ?>
                    <tr>
                        <td><?php echo $request['title']; ?></td>
                        <td><?php echo $request['name']; ?></td>
                        <td>
                            <?php 
                                if ($request['feedback_status'] == 1) {
                                    echo 'Approved';
                                } else if($request['feedback_status'] == 2){
                                    echo 'Rejected';
                                } else {
                                    echo 'Pending';
                                }
                            ?>
                        </td>
                        <td><a href='request-details.php?id=<?php echo $request['arid'];?>'>View Details</a></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
		</div>
	</div>
<?php include "includes/footer.php";?>	