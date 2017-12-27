<?php require_once('_app/config.php');?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Grupo CDPV - Video Manager</title>
		<link rel="stylesheet" href="<?=BASE?>_cdn/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?=BASE?>theme/gcdpv/css/style.css">
	</head>
	<body>
		<header>
			<?php require_once('theme/gcdpv/inc/navbar.php');?>
		</header>
		<main>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-8">
							<?php for($x=0; $x<1 ; $x++):?>
								<div class='col-xs-12 col-md-12'>
								<div class="w3-card-4 video-card-main">
									<img class="img-responsive text-center" src="http://via.placeholder.com/700x350" alt="">
								</div>
								<h3>title video</h3><br>
								<p>description</p>
							</div>
							<?php endfor;?>
						</div>
						<div class="col-md-4" class="video-card">
							<?php for($x=0; $x<6 ; $x++):?>
								<div class='col-xs-6 col-md-12 text-center'>
								<div class="w3-card-4 video-card" style="display: inline;">
									<img class="img-responsive text-center" src="http://via.placeholder.com/140x100" alt="">
									<h3>title</h3>
								</div>
							</div>
							<?php endfor;?>
						</div>
						
					</div>
				</div>
			</div>
		</main>
		<footer>
		<div class="container">
			<?php require_once('theme/gcdpv/inc/footer.php');?>
		</div>
		</footer>
		<script type="text/javascript" src="<?=BASE?>_cdn/jquery.min.js"/></script>
        <script type="text/javascript" src="<?=BASE?>_cdn/bootstrap/js/bootstrap.min.js"/></script>
	</body>
</html>