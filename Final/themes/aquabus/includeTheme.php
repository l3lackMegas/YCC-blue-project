<!DOCTYPE html>
<html lang="th-TH">
    <head>
        <title><?php echo $Site['name']; ?></title>
        <meta charset="UTF-8">
        <meta name="description" content="<?php echo $Site['description']; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="manifest" href="<?php echo $themePath; ?>/manifest.json">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <meta name="theme-color" content="#fff">

        <link rel="stylesheet" type="text/css" href="<?php echo $themePath; ?>/css/animated.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $themePath; ?>/css/style.css?v=1">
        <script src="<?php echo $themePath; ?>/js/jquery.min.js"></script>
		<script src='<?php echo $themePath; ?>/js/jquery-ui.min.js'></script>
        <script src="<?php echo $themePath; ?>/js/index.js"></script>
	</head>
    <body>
        <header id="appBar">
			<i id="btnBack" class="fas fa-chevron-left"></i>
			<center><img class="logoCenter" src="<?php echo $themePath; ?>/img/textrodeway.png"></center>
		</header>
		<div id="container">
			<?php
			switch($sTarget['page'])
			{
				case "login" : include('page/login.php'); break;
				case "home" : include('page/home.php'); break;
				case "waiting" : include('page/waiting.php'); break;
				case "selectS" : include('page/selectS.php'); break;
				case "destination" : include('page/destination.php'); break;
				case "nfc" : include('page/nfc.php'); break;
				case "nfc2" : include('page/nfc2.php'); break;
				case "singup" : include('page/sign-up.php'); break;
				default: break;
			}
			?>
		</div>
		<script>
			$('#btnBack').hide();
		</script>
    </body>
</html>