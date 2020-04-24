<?php
session_start();
require_once "../connection/connection.php";
require_once "includes/auth.php";
$query = $connection->prepare('SELECT * FROM eaos');
$query->execute();
$eaos = $query->fetchAll(PDO::FETCH_ASSOC);
include "includes/header.php";
?>
	<div class="container">
		<div class="top-header">
			Welcome <?php echo $_SESSION['staff']['name']?> <br>
			EXPERIMENT APPROVAL OFFICERS - <a href="add-eaos.php">add new</a>
		</div>
		<div class="content cf">
            <table class="table">
                <thead>
                    <tr>
                        <th> Name </th>
                        <th> Email </th>
                        <th> Staff ID </th>
                        <th> Actions </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($eaos as $eao){ ?>
                    <tr>
                        <td><?php echo $eao['name']; ?></td>
                        <td><?php echo $eao['email']; ?></td>
                        <td><?php echo $eao['staff_id']; ?></td>
                        <td><a href='handlers/eao/delete.php?id=<?php echo $eao['id']; ?>'>delete</a> --- <a href='edit-eao.php?id=<?php echo $eao['id']; ?>'>edit</a></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
		</div>
	</div>
<?php include "includes/footer.php";?>	