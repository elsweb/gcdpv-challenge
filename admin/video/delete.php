<?php
session_start();
require_once('../../_app/config.php');
$Login = new Login(3);
if (!$Login->CheckLogin()):
    header('Location: ../index.php');
endif;
$id = filter_input(INPUT_GET, 'del_id', FILTER_VALIDATE_INT);
require_once('model/videoManager.php');
$videoDelete = new videoManager;
$videoDelete->ExeDelete($id);
if($videoDelete->getResult()):
	header('Location: ../index.php');
endif;
?>