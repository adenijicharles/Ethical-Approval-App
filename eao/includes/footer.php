			<script type="text/javascript" src="../assets/js/jquery-1.10.1.min.js"></script>
			<script type="text/javascript" src="../assets/js/main.js"></script>
			<script type="text/javascript" src="../assets/Toast/js/Toast.min.js"></script>
			<script type="text/javascript" src="../assets/fancybox/jquery.fancybox.min.js"></script>
			<?php if(isset($_SESSION['success'])){
			    $message = $_SESSION['success'];
			?>
			    <script type="text/javascript">
			          new Toast({ message: '<?php echo $message; ?>', type: 'success' });
			    </script>
			    <?php unset($_SESSION['success']);
			}
			?>

			<?php if(isset($_SESSION['error'])){
			    $message = $_SESSION['error'];
			?>
			    <script type="text/javascript">
			          new Toast({ message: '<?php echo $message; ?>', type: 'danger' });
			    </script>
			    <?php unset($_SESSION['error']);
			}
			?>
		</div>
	</body>
</html>