<?php
session_start();
require_once "../connection/connection.php";
require_once "includes/auth.php";
$query = $connection->prepare('SELECT approval_requests.id AS arid, experiments.id AS eid, approval_requests.*, experiments.*, students.* FROM approval_requests LEFT JOIN experiments ON approval_requests.experiment_id = experiments.id LEFT JOIN students ON experiments.student_id = students.student_id ORDER BY approval_requests.id DESC');
$query->execute();
$requests = $query->fetchAll(PDO::FETCH_ASSOC);
include "includes/header.php";
?>
	<div class="container">
		<div class="top-header">
			Welcome <?php echo $_SESSION['staff']['name']?> <br>
			EXPERIMENT APPROVAL REQUESTS 
		</div>
		<div class="content cf">
            <table class="table">
                <thead>
                    <tr>
                        <th> Experiment Title </th>
                        <th> Submitted By </th>
                        <th> Approval Status</th>
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
                                if ($request['status'] == 1) {
                                    echo 'Approved';
                                } else if($request['status'] == 2){
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