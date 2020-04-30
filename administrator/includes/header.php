<!DOCTYPE html>
<html>
<head>
	<title> EEA </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../assets/css/reset.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/app.css">
	<link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="../assets/Toast/css/Toast.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/fancybox/jquery.fancybox.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/table.css">
	<style>
		header{ 
			background-color: #FFF; 
			width: 75% !important; 
			margin: 30px auto 0 auto !important;
		}

		header > img{
			width: 80%;
		}

		.top-header{
			width: 94%;
			height: auto;
			margin: auto;
			padding: 20px 3%;
			border-bottom: 1px solid #E1E1E1;
		}
	</style>
</head>
<body>
	<div class="outerwrapper">
		<div class="sidebar">
			<header> 
				<img src="../assets/image/logo.gif">
			</header>
			<div class="desktop">
				<div class="sidebar-link"><a href="dashboard.php"><i class="fa fa-home"></i> ALL EXPERIMENTS </a></div>
				<div class="sidebar-link"><a href="eaos.php" title="Orders"><i class="fa fa-eyedropper"></i> EXPERIMENT APPROVAL OFFICERS </a></div>
				<div class="sidebar-link"><a href="requests.php" title="Orders"><i class="fa fa-eyedropper"></i> APPROVAL REQUESTS </a></div>				
				<div class="sidebar-link"><a href="logout.php" title="Logout"><i class="fa fa-sign-out"></i> LOGOUT </a></div>						
			</div>

			<div class="mobile" id="mobile" data-left="-201px">
				<div class="span-wrapper">
					<span><a href="#"><i class="fa fa-home"></i> MY EXPERIMENTS </a></span>
					<span><a href="#" title="Orders"><i class="fa fa-eyedropper"></i> MY ETHICAL APPROVAL REQUESTS </a></span>
				</div>
				<div class="tip" id="tip">
					<svg height="32px" id="Layer_1" fill="#FFF" style="enable-background:new 0 0 32 32;" version="1.1" viewBox="0 0 32 32" width="32px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
						<path d="M4,10h24c1.104,0,2-0.896,2-2s-0.896-2-2-2H4C2.896,6,2,6.896,2,8S2.896,10,4,10z M28,14H4c-1.104,0-2,0.896-2,2  s0.896,2,2,2h24c1.104,0,2-0.896,2-2S29.104,14,28,14z M28,22H4c-1.104,0-2,0.896-2,2s0.896,2,2,2h24c1.104,0,2-0.896,2-2  S29.104,22,28,22z"/>
					</svg>					
				</div>
			</div>
		</div>