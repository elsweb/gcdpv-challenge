<?php 
session_start();
require_once('../_app/config.php');
$Login = new Login(3); // Nível 3
echo'<pre>';
	print_r($Login);
echo'</pre>';

//Se tiver sessão
if ($Login->CheckLogin()):
    header('Location: painel.php');
endif;
$dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if (!empty($dataLogin['AdminLogin'])):
    $Login->ExeLogin($dataLogin);
    if (!$Login->getResult()):
        echo $Login->getError()[0];
    else:
        header('Location: painel.php');
    endif;
endif;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Administração - Video Manager</title>
</head>
<body>

	<form name="AdminLoginForm" action="" method="post">
                    <label>
                        <span>E-mail:</span>
                        <input type="email" name="user" />
                    </label>

                    <label>
                        <span>Senha:</span>
                        <input type="password" name="pass" />
                    </label>  

                    <input type="submit" name="AdminLogin" value="Logar" class="btn blue" />

                </form>
	
</body>
</html>