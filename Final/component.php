<?php
switch($action[2]) {
    case "dashboard" :
		$sTitle = "Dashboard";
        include('includes/dashboard.php');
        break;
		
	case "member" :
		$sTitle = "Member";
        include('includes/member.php');
        break;

    case "stats" :
		$sTitle = "Stats";
        include('includes/stats.php');
        break;
		
	case "data" :
        include('includes/data-hub.php');
        die();
		break;
		
	default:
		$sTitle = "404 Page not found.";
		include('includes/404.php');
}
header('Content-Type: text/html; charset=utf-8');
?>
<script>document.title = "<?php echo $sTitle; ?> - " + _Site.name;</script>