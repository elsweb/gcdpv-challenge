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
					<?php

					$video = filter_input_array(INPUT_POST, FILTER_DEFAULT);
					if (isset($video)):
						$video['video_path'] = ($_FILES['video_path']['tmp_name'] ? $_FILES['video_path'] : null );
						require_once('model/videoManager.php');
						$cadastra = new videoManager;
						$cadastra->ExeCreate($video);
						if ($cadastra->getResult()):
			                header('Location: ../painel.php');
			            else:
			                WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
			            endif;
					endif;
					?>
					<form name="VideoForm" action="" method="post" enctype="multipart/form-data">
					  <div class="form-group">
					    <label for="titulo">Título:</label>
					    <input type="text" name="video_title" class="form-control">
					  </div>
					  <div class="form-group">
					    <label for="titulo">Descrição:</label>
					    <textarea class="form-control" name="video_desc"></textarea>
					  </div>
					  <div class="form-group">
	                	<input type="file" name="video_path"/>
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