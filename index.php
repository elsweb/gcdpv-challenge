<?php 
require_once('_app/config.php');
$id_video = filter_input(INPUT_GET, 'id_video', FILTER_VALIDATE_INT);
$readVideos = new Read;
if($id_video):
	$readVideos->ExeReadSingle("ws_video", "WHERE video_id = $id_video");
else:
	$readVideos->ExeReadSingle("ws_video", "ORDER BY video_id DESC, video_id DESC LIMIT 1");
endif;
$id_new = $readVideos->getResult()['video_id'];
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Grupo CDPV - Video Manager</title>
		<link rel="stylesheet" href="<?=BASE?>_cdn/bootstrap/css/bootstrap.min.css">
		<link href="//vjs.zencdn.net/5.19/video-js.min.css" rel="stylesheet">
		<script src="//vjs.zencdn.net/5.19/video.min.js"></script>
		<script>window.HELP_IMPROVE_VIDEOJS = false;</script>
		<style type="text/css">
			.vjs-poster{display: none;}
		</style>
		
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
								<div class='col-xs-12 col-md-12'>
								<div class="w3-card-4 video-card-main"> 
									<video width="auto" height="400" class="video-js" controls preload="false" poster="" data-setup='{}'>
									 	<source src="<?=BASE?>uploads/<?=$readVideos->getResult()['video_path']?>" type="video/mp4"></source>
									</video>
								</div>
								<h3><?=$readVideos->getResult()['video_title']?></h3><br>
								<p><?=$readVideos->getResult()['video_desc']?></p>
							</div>
						</div>
						<div class="col-md-4" class="video-card">
							<?php
								$readVideos->ExeRead("ws_video", "WHERE video_id <> $id_new ORDER BY video_id DESC, video_id DESC LIMIT 3");
								foreach ($readVideos->getResult() as $video):
							?>
								<div class='col-xs-6 col-md-12 text-center'>
								<div style="margin: 10px;" class="w3-card-4 video-card" style="display: inline;">
									<a href="index.php?id_video=<?=$video['video_id']?>">
									<video style="float: left;"  width="auto" height="100" class="video-js" preload="false" poster="" data-setup='{}'>
									 	<source src="<?=BASE?>uploads/medias/2017/12/teste.mp4" type="video/mp4"></source>
									</video>
									</a>
									<h3 style="float: left;"><?=$video['video_title']?></h3>
								</div>
							</div>
							<?php endforeach; ?>
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