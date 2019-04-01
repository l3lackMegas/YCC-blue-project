<?php
require_once('config.php');
require_once('class/core.php');//Include core ออกมา
$core = new SystemCore();

$Site = $core->getSiteSetting('system');
if (empty($_SERVER['HTTPS'])) {
    header('Location: '.$Site['url'].$_SERVER['REQUEST_URI']);
    exit;
}
$action = explode('/', $_SERVER['REQUEST_URI']);
if($Site['maintenance'] == 1) $action[1] = "maintenance";
$themePath = 'themes/'.$Site['template'];
//if(!$_SESSION['logined']) $action[1] = "login";
//$action[1] = "waiting";
switch($action[1]) {
	case "component" :
        include('component.php');
		die();
		
	case "login" :
		$sTarget['page'] = "login";
		$sTarget['title'] = "Login";
		break;
		
	case "signup" :
		$sTarget['page'] = "singup";
		$sTarget['title'] = "Sign-up";
		break;
		
	case "waiting" :
		$sTarget['page'] = "waiting";
		$sTarget['title'] = "Waiting";
		break;
		
	case "selectS" :
		$sTarget['page'] = "selectS";
		$sTarget['title'] = "selectS";
		break;
		
	case "destination" :
		$sTarget['page'] = "destination";
		$sTarget['title'] = "Destination";
		break;
		
	case "nfc" :
		$sTarget['page'] = "nfc";
		$sTarget['title'] = "NFC";
		break;
		
	case "nfc2" :
		$sTarget['page'] = "nfc2";
		$sTarget['title'] = "NFC2";
		break;
		
	case "" :
		$sTarget['page'] = "home";
		$sTarget['title'] = "Home";
		break;
		
	case "test" :
		include('test.php');
		die();
		break;
		
	default: 
		$sTarget['page'] = "404";
		$sTarget['title'] = "Page not found";
		break;		
}
include($themePath.'/index.php');
?>