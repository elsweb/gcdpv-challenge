<?php

/**
 * Login.class [TIPO]
 * Descricao
 * @copyright (c) year, Emanuel L.D. Silva elsWeb Freelancer
 */
class Login {

    private $Level;
    private $Email;
    private $Senha;
    private $Error;
    private $Result;

    function __construct($Level) {
        $this->Level = (int) $Level;
    }

    public function ExeLogin(array $UserData) {
        $this->Email = strip_tags(trim($UserData['user']));
        $this->Senha = strip_tags(trim($UserData['pass']));
        $this->setLogin();
    }

    function getResult() {
        return $this->Result;
    }

    function getError() {
        return $this->Error;
    }

    public function CheckLogin() {
        if (empty($_SESSION['userlogin']) || $_SESSION['userlogin'] < $this->Level):
            unset($_SESSION['userlogin']);
            return FALSE;
        else:
            return TRUE;
        endif;
    }

    private function setLogin() {
        if (!$this->Email || !$this->Senha || !Check::Email($this->Email)):
            $this->Error = ['Informe seu E-mail e senha para efeturar o login!'];
            $this->Result = FALSE;
        elseif (!$this->getUser()):
            $this->Error = ['Os dados informados não são compatíveis'];
            $this->Result = FALSE;
        elseif ($this->Result['user_level'] < $this->Level):
            $this->Error = ["Desculpe <b>{$this->Result['user_name']}</b>, você não tem permissão para acessar esta área!", WS_ERROR];
            $this->Result = FALSE;
        else:
            $this->Execute();
        endif;
    }

    private function getUser() {

        $this->Senha = md5($this->Senha);

        $read = new Read;
        $read->ExeRead("ws_users", "WHERE user_email = :e AND user_password = :p", "e={$this->Email} & p={$this->Senha}");
        if ($read->getResult()):
            $this->Result = $read->getResult()[0];
            return TRUE;
        else:
            return FALSE;
        endif;
    }

    private function Execute() {
        if (!session_id()):
            session_start();
        endif;

        $_SESSION['userlogin'] = $this->Result;
        $this->Error = ["Olá <b>{$this->Result['user_name']}</b>, seja bem vindo(a). Aguarde redirecionamento!"];
        $this->Result = TRUE;
    }

}
