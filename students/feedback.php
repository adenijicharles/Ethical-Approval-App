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

$request_id = $_GET['aid'];
$sql = $connection->prepare('SELECT * FROM assigned_requests LEFT JOIN eaos ON assigned_requests.eao_id = eaos.staff_id WHERE assigned_requests.request_id = :request_id');
$sql->bindParam(':request_id', $request_id);
$sql->execute();
$feedbacks = $sql->fetchAll(PDO::FETCH_ASSOC);
include "includes/header.php";
?>
<div class="container">
    <div class="top-header">
        Welcome <?php echo $_SESSION['user']['name'] ?>
    </div>
    <div class="content">
        <div class="full-width">
            <?php foreach ($experiments as $experiment) { ?>
                <div class="form-body">
                    <b> Experiment Title </b> <br>
                    <?php echo $experiment['title']; ?>
                </div>
                <div class="form-body" style="width: 500px; margin: 0;">
                    <b> Description </b> <br>
                    <input type="hidden" name="id" value="<?php echo $experiment['id']; ?>">
                    <?php echo $experiment['description']; ?>
                </div>
            <?php } ?>
        </div>
        <div class="full-width">
            <?php foreach ($approval as $a) { ?>
                <div class="form-body">
                    <b> Reasons why experiment should be approved </b> <br>
                    <?php echo $a['reasons'] ?>
                </div>
                <div class="form-body">
                    <b> Documents </b> <br>
                    <?php
                    $files = json_decode($a['files'], true);
                    foreach ($files as $file) {
                        echo "<a href='../uploads/$file' target='_blank'> $file </a><br>";
                    }; ?>
                </div>
            <?php } ?>
        </div>

        <div class="full-width">
            <h6> <b>Experiment Approval Oficers Feedbacks </b> </h6>
            <hr>
            <ul>
                <?php foreach ($feedbacks as $f) { ?>
                    <li>
                        <div class="form-body">
                            <b> EAO Name: </b> <?php echo $f['name']?> <br>
                            <b>EAO Feedback: </b><?php echo $f['feedback']; ?>
                        </div>
                        <hr>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>