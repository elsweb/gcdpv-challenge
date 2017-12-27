<?php

/**
 * Upload.class [TIPO]
 * Descricao
 * @copyright (c) year, Emanuel L.D. Silva elsWeb Freelancer
 */
class Upload {

    private $File;
    private $Name;
    private $Send;

    /**VIDEO UPLOAD */
    private $Width;
    //private $Video;

    /** RESULTSET */
    private $Result;
    private $Error;

    /** DIRETÓRIOS */
    private $Folder;
    private static $BaseDir;

    public function __construct($BaseDir = null) {
        self::$BaseDir = ((string) $BaseDir ? $BaseDir : '../../uploads/');
        if (!file_exists(self::$BaseDir) && !is_dir(self::$BaseDir)):
            mkdir(self::$BaseDir, 0777);
        endif;
    }
    public function Media(array $Media, $Name = NULL, $Folder = NULL, $MaxFileSize = NULL) {
        $this->File = $Media;
        $this->Name = ((string) $Name ? $Name : substr($Media['name'], 0, strrpos($Media['name'], '.')));
        $this->Folder = ((string) $Folder ? $Folder : 'medias');
        $MaxFileSize = ((int) $MaxFileSize ? $MaxFileSize : 50);
        $FileAccept = [
            'audio/mp3',
            'video/mp4'
        ];

        if ($this->File['size'] > ($MaxFileSize * (1024 * 1024))):
            $this->Result = FALSE;
            $this->Error = "Arquivo muito grande, tamanho máximo permitido de {$MaxFileSize}MB";
        elseif (!in_array($this->File['type'], $FileAccept)):
            $this->Result = FALSE;
            $this->Error = 'Tipo de arquivo não suportado. Envie audio MP3 ou video MP4';
        else:
            $this->CheckFolder($this->Folder);
            $this->setFileName();
            $this->MoveFile();
        endif;
    }

    public function getResult() {
        return $this->Result;
    }

    public function getError() {
        return $this->Error;
    }

    private function CheckFolder($Folder) {
        list($y, $m) = explode('/', date('Y/m'));
        $this->CreateFolder("{$Folder}");
        $this->CreateFolder("{$Folder}/{$y}");
        $this->CreateFolder("{$Folder}/{$y}/{$m}/");
        $this->Send = ("{$Folder}/{$y}/{$m}/");
    }

    private function CreateFolder($Folder) {
        if (!file_exists(self::$BaseDir . $Folder) && !is_dir(self::$BaseDir . $Folder)):
            mkdir(self::$BaseDir . $Folder, 0777);
        endif;
    }

    private function setFileName() {
        $FileName = Check::Name($this->Name) . strrchr($this->File['name'], '.');
        if (file_exists(self::$BaseDir . $this->Send . $FileName)):
            $FileName = Check::Name($this->Name) . '-' . time() . strrchr($this->File['name'], '.');
        endif;
        $this->Name = $FileName;
    }

    //ENVIA ARQUIVOS E MIDIAS
    private function MoveFile() {
        if (move_uploaded_file($this->File['tmp_name'], self::$BaseDir . $this->Send . $this->Name)):
            $this->Result = $this->Send . $this->Name;
            $this->Error = NULL;
        else:
            $this->Result = FALSE;
            $this->Error = 'Erro ao mover o arquivo. Favor tente mais tarde!';
        endif;
    }

}
