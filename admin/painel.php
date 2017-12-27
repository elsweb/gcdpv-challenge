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
$posti = 0;
$getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
$Pager = new Pager('painel.php?page=');
$Pager->ExePager($getPage, 6);

$readVideos = new Read;
$readVideos->ExeRead("ws_video", "ORDER BY video_title ASC, video_id DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

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
						<?php 
							if ($readVideos->getResult()):
							foreach ($readVideos->getResult() as $video):
							
						?>
						<div class='col-xs-6 col-md-4 text-center'>
							<div class="w3-card-4 video-card">
								<div class="w3-container w3-center">
							    	<h3><?=$video['video_title']?></h3>
							    </div>
								<video width="140" height="100">
									<source src="<?=BASE?>uploads/<?=$video['video_path']?>" type="video/mp4">
								</video>
								<br>
								<a href="video/delete?del_id=<?=$video['video_id'];?>" class="btn btn-danger">Apagar</a>
							</div>
						</div>
						<?php 
								endforeach;
							else:
							?>
							<div class="row">
								<div class="col-md-12">
									<h3 class="alert alert-info text-center">Nenhum registro cadastrado</h3>
								</div>
							</div>
							<?php	
							endif;	
							?>
					</div>
				</div>
				<div class="row page">
					<div class="col-md-12 text-center">
						<?php
						$Pager->ExePaginator("ws_video");
						echo $Pager->getPaginator();
						?>
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