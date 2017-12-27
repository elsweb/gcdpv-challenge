<?php
session_start();
require_once('../_app/config.php');
$Login = new Login(3); // Nível 3
$logoff = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN);
if (!$Login->CheckLogin()):
    header('Location: index.php');
endif;
if ($logoff):
    unset($_SESSION['userlogin']);
    header('Location: index.php?exe=logoff');
endif;
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Área Administrativa</title>
		<link rel="stylesheet" href="<?=BASE?>_cdn/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?=BASE?>admin/css/style.css">
		<link rel="stylesheet" href="<?=BASE?>admin/css/painel.css">
	</head>
	<body>
		<header>
			<?php require_once('./inc/nav-admin.php');?>
		</header>
		<main>
			<div class="container">
				<div class="row">
					<div class="col-md 12">
						<?php for($x=0; $x<6 ; $x++):?>
							<div class='col-xs-6 col-md-4 text-center'>
								<div class="w3-card-4 video-card">
									<div class="w3-container w3-center">
								    	<h3>title</h3>
								    </div>
									<img src="http://via.placeholder.com/140x100" alt="Norway">
									<br>
									<button class="btn btn-info">Editar</button>
	  								<button class="btn btn-danger">Apagar</button>
								</div>
							</div>
						<?php endfor;?>
					</div>
				</div>
			</div>
		</main>
		<footer>
			<?php require_once('inc/footer-admin.php');?>
		</footer>
		<script type="text/javascript" src="<?=BASE?>_cdn/jquery.min.js"/></script>
		<script type="text/javascript" src="<?=BASE?>_cdn/bootstrap/js/bootstrap.min.js"/></script>
	</body>
</html>