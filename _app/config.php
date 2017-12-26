<?php  
define('THEME', 'video-manager');
define('BASE', 'http://localhost/projeto/competicao/php/gcdpv-challenge/');

// database config
define('HOST', 'localhost');
define('USER', 'elscode');
define('PASS', '');
define('DBSA', 'challenge_gcdpv');

//auto-load-classes
function __autoload($Class) {
    $cDir = ['conn', 'model','helper'];
    $iDir = null;
    foreach ($cDir as $dirName):
        if (!$iDir && file_exists(__DIR__ . DIRECTORY_SEPARATOR . "{$dirName}" . DIRECTORY_SEPARATOR . "{$Class}.class.php") && !is_dir(__DIR__ . DIRECTORY_SEPARATOR . "{$dirName}" . DIRECTORY_SEPARATOR . "{$Class}.class.php")):
            include_once (__DIR__ . DIRECTORY_SEPARATOR . "{$dirName}" . DIRECTORY_SEPARATOR . "{$Class}.class.php");
            $iDir = true;
        endif;
    endforeach;
    if (!$iDir):
        trigger_error("Não Foi Possível Incluir {$Class}.class.php", E_USER_ERROR);
        die;
    endif;
}