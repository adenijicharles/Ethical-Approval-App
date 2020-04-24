<?php if(isset($_SESSION['success'])){?>
    <div class="status_message">
        <div class="success">
            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    </div>
<?php } ?>

<?php if(isset($_SESSION['error'])){?>
    <div class="status_message">
        <div class="error">
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    </div>
<?php } ?>