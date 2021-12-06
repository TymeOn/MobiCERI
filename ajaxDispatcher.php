<?php
//nom de l'application
$nameApp = "monApplication";

//action par défaut
$action = "index";

if(key_exists("action", $_REQUEST))
$action =  $_REQUEST['action'];

require_once 'lib/core.php';
require_once $nameApp.'/controller/mainController.php';

foreach(glob($nameApp.'/model/*.class.php') as $model)
	include_once $model ;

$context = context::getInstance();
$context->init($nameApp);

$view=$context->executeAction($action, $_REQUEST);

// base error management
if($view===false)
{
	echo "Une grave erreur s'est produite, il est probable que l'action ".$action." n'existe pas...";
	die;
}
// direct view include
elseif($view!=context::NONE)
{
	include($nameApp."/view/".$action.$view.".php");
}

?>
