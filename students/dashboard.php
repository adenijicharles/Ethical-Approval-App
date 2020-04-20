<?php
session_start();
require_once "../connection/connection.php";
require_once "includes/auth.php";
$query = $connection->prepare('SELECT * FROM experiments WHERE student_id = :student_id ORDER BY id DESC');
$query->bindParam(':student_id', $_SESSION['user']['student_id']);
$query->execute();
$experiments = $query->fetchAll(PDO::FETCH_ASSOC);
include "includes/header.php";
?>
	<div class="container">
		<div class="top-header">
			Welcome <?php echo $_SESSION['user']['name']?> <br>
			MY EXPERIMENTS - <a href="add-experiment.php">add new</a>
		</div>
		<div class="content cf">
			<?php foreach($experiments as $experiment){?>
				<div class="stat-box">
					<h4> <?php echo $experiment['title']; ?></h4>
					<h5> <a href="handlers/experiments/delete.php?id=<?php echo $experiment['id']; ?>">Delete</a> - <a href="edit-experiment.php?id=<?php echo $experiment['id']; ?>">Edit</a> </h5>
				</div>
			<?php }?>									
		</div>
	</div>
<?php include "includes/footer.php";?>	