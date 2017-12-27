<?php
class videoManager {

	private $Data;
    private $Video;
    private $Error;
    private $Result;

    const Entity = 'ws_video';

    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        
        if (!$this->Data):
            $this->Error = ["Erro ao cadastrar: Para cadastrar um video, favor preencha todos os campos!"];
            $this->Result = FALSE;
        else:
            $this->setData();
            $this->setName();

            if ($this->Data['video_path']):
                $upload = new Upload;
                $upload->Media($this->Data['video_path'], $this->Data['video_title']);
                var_dump($upload);
            endif;
            if (isset($upload) && $upload->getResult()):
                $this->Data['video_path'] = $upload->getResult();
                $this->Create();
            else:
                $this->Data['video_path'] = NULL;
                $this->Create();
            endif;
        endif;
    }

    public function ExeDelete($Id) {
        $this->Video = (int) $Id;

        $ReadVideo = new Read;
        $ReadVideo->ExeRead(self::Entity, "WHERE video_id = :Video", "Video={$this->Video}");

        if (!$ReadVideo->getResult()):
            $this->Error = ["O Video que você tentou deletar não existe no sistema!"];
            $this->Result = FALSE;
        else:
            $VideoDelete = $ReadVideo->getResult()[0];
            if (file_exists('../../uploads/' . $VideoDelete['video_path']) && !is_dir('../../uploads/' . $VideoDelete['video_path'])):
                unlink('../../uploads/' . $VideoDelete['video_path']);
            endif;
            
            $deleta = new Delete;
            $deleta->ExeDelete(self::Entity, "WHERE video_id = :Id", "Id={$this->Video}");
            $this->Error = ["O Video <b>{$VideoDelete['video_title']}</b> foi removido com sucesso do sistema!"];
            $this->Result = TRUE;
        endif;
    }

    private function Create() {
        $cadastra = new Create;
        $cadastra->ExeCreate(self::Entity, $this->Data);
        if ($cadastra->getResult()):
            $this->Error = ["O Video <b>{$this->Data['video_title']}</b> foi cadastrado com sucesso no sistema!"];
            $this->Result = $cadastra->getResult();
        endif;
    }

    function getResult() {
        return $this->Result;
    }

    function getError() {
        return $this->Error;
    }

    private function setData() {
    	$Path = $this->Data['video_path'];
        $Desc = $this->Data['video_desc'];
       	unset($this->Data['video_path'], $this->Data['video_desc']);
        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);
        $this->Data['video_title'] = $this->Data['video_title'];
        $this->Data['video_desc'] = $Desc;
        $this->Data['video_path'] = $Path;
    }

    private function setName() {
        $where = (isset($this->Video) ? "video_id != {$this->Video} AND" : '');
        $readName = new Read;
        $readName->ExeRead(self::Entity, "WHERE {$where} video_title = :t", "t={$this->Data['video_title']}");
        if ($readName->getResult()):
            $this->Data['video_title'] = $this->Data['video_title'] . '-' . $readName->getRowCount();
        endif;
    }
	
}
?>