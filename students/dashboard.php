<?php
session_start();
require_once "../connection/connection.php";
require_once "includes/auth.php";
$query = $connection->prepare('SELECT experiments.id AS eid, approval_requests.id AS aid, experiments.*, approval_requests.* FROM experiments LEFT JOIN approval_requests ON experiments.id = approval_requests.experiment_id WHERE experiments.student_id = :student_id ORDER BY experiments.id DESC');
$query->bindParam(':student_id', $_SESSION['user']['student_id']);
$query->execute();
$experiments = $query->fetchAll(PDO::FETCH_ASSOC);
include "includes/header.php";
?>
<div class="container">
	<div class="top-header">
		Welcome <?php echo $_SESSION['user']['name'] ?> <br>
		MY EXPERIMENTS - <a href="add-experiment.php">add new</a>
	</div>
	<div class="content cf">
		<?php foreach ($experiments as $experiment) { ?>
			<div class="stat-box">
				<h4> <?php echo $experiment['title']; ?></h4>
				<h5> <a href="handlers/experiments/delete.php?id=<?php echo $experiment['id']; ?>">Delete</a> - <a href="edit-experiment.php?id=<?php echo $experiment['id']; ?>">Edit</a> </h5>
				<hr>
				<?php
				if (isset($experiment['status'])) {
					if ($experiment['status'] == 1) {
				?>
						<a href="feedback.php?id=<?php echo $experiment['eid']?>&aid=<?php echo $experiment['aid']; ?>"> <span style='color: green !important; font-weight: bold;'>Experiment Approval Request Approved</span> <hr> view feedback </a>
					<?php }elseif($experiment['status'] == 2) { ?>
						<a href="feedback.php?id=<?php echo $experiment['eid']?>&aid=<?php echo $experiment['aid']; ?>"> <span style='color: red !important; font-weight: bold;'>Experiment Approval Request Rejected</span> <hr> view feedback  </a>
					<?php } else { ?>
						<a href="edit-approval-request.php?id=<?php echo $experiment['eid']; ?>"> Under review <hr> edit request  </a>
					<?php } ?>
				<?php } else { ?>
					<a href="submit-approval-request.php?id=<?php echo $experiment['eid']; ?>">submit request</a>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</div>
<?php include "includes/footer.php"; ?>