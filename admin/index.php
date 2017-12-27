<?php 
session_start();
require_once('../_app/config.php');
$Login = new Login(3); // Nível 3
if ($Login->CheckLogin()):
    header('Location: painel.php');
endif;
$dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$error = false;
$success = false;
if (!empty($dataLogin['AdminLogin'])):
    $Login->ExeLogin($dataLogin);
    if (!$Login->getResult()):
        $error = $Login->getError()[0];
    else:
        sleep(1);
        header('Location: painel.php');
    endif;
endif;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Administração - Video Manager</title>
    <link rel="stylesheet" href="<?=BASE?>_cdn/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=BASE?>admin/css/style.css">
    <link rel="stylesheet" href="<?=BASE?>admin/css/login.css">
</head>
    <body>
        <a href="#" class="data-t" data-toggle="modal" data-target="#login-modal">Login</a>
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="loginmodal-container">
                    <h1>Administração</h1><br>
                    <form name="AdminLoginForm" action="" method="post">
                        <input type="email" name="user" placeholder="E-mail">
                        <input type="password" name="pass" placeholder="Senha">
                        <input type="submit" name="AdminLogin" class="login loginmodal-submit" value="Logar">
                        <?php
                            if($error):
                                echo "<div class='alert alert-info'>$error</div>";
                            endif;
                        ?>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="<?=BASE?>_cdn/jquery.min.js"/></script>
        <script type="text/javascript" src="<?=BASE?>_cdn/bootstrap/js/bootstrap.min.js"/></script>
        <script type="text/javascript" src="<?=BASE?>admin/js/login.js"/></script>
    </body>
</html>