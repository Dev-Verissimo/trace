<?php


namespace App\Suport;


class Message
{
    private $text;
    private $type;

    public function getType()
    {
        return $this->type;
    }

    public function getText()
    {
        return $this->text;
    }
    public function error(string $mensagem) : Message
    {
        $this->type = 'error';
        $this->text = $mensagem;
        return $this;
    }

    public function success(string $mensagem) : Message
    {
        $this->type = 'error';
        $this->text = $mensagem;
        return $this;
    }

    public function render()
    {
        return "<div class='message {$this->getType()}'> {$this->getText()} </div>";
    }
}
