<?php 
session_start();
require_once('../../_app/config.php');
$Login = new Login(3);
if (!$Login->CheckLogin()):
    header('Location: ../index.php');
endif;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Cadastro</title>
	 <link rel="stylesheet" href="<?=BASE?>_cdn/bootstrap/css/bootstrap.min.css">
	 <link rel="stylesheet" href="<?=BASE?>admin/css/style.css">
	 <link rel="stylesheet" href="css/style.css">
</head>
	<body>
		<header>
			<?php require_once('../inc/nav-admin.php');?>
		</header>
		<main>
			<div class="container">
				<div class="row">
					<form>
					  <div class="form-group">
					    <label for="titulo">Título:</label>
					    <input type="text" class="form-control">
					  </div>
					  <div class="form-group">
					    <label for="titulo">Descrição:</label>
					    <textarea class="form-control"></textarea>
					  </div>
					  <div class="form-group">
	                	<input type="file" name="files[]" id="js-upload-files" multiple>
	              	  </div>
	              	  <button type="submit" class="btn btn-success">Salvar</button>
					</form>
				</div>
			</div>
		</main>
		<footer>
			<?php require_once('../inc/footer-admin.php');?>
		</footer>
		<script type="text/javascript" src="<?=BASE?>_cdn/jquery.min.js"></script>
		<script type="text/javascript" src="js/cadastro.js"></script>
	</body>
</html>