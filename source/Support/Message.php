<?php

namespace Source\Support;

use Source\Support\Session;

class Message
{
    private string $text;
    private string $type;

    public function __toString()
    {
        return $this->render();
    }

    public function getText() : ?string{
        return $this->text;
    }

    public function getType() : ?string
    {
        return $this->type;
    }

    public function info(string $message) : Message
    {
        $this->type = CONF_MESSAGE_INFO;
        $this->text = $this->filter($message);
        return $this;
    }

    public function success(string $message) : Message
    {
        $this->type = CONF_MESSAGE_SUCCESS;
        $this->text = $this->filter($message);
        return $this;
    }

    public function warning(string $message) : Message
    {
        $this->type = CONF_MESSAGE_WARNING;
        $this->text = $this->filter($message);
        return $this;
    }

    public function error(string $message) : Message
    {
        $this->type = CONF_MESSAGE_ERROR;
        $this->text = $this->filter($message);
        return $this;
    }

    public function render() : string
    {
        return "<div class='" . CONF_MESSAGE_CLASS . " {$this->getType()}'>{$this->getText()}</div>";
    }

    public function json() : string
    {
        if($this->getType() == 'error' or $this->getType() == 'warning'){
            
            return json_encode([
                'type' => 1,
                'message' => $this->getText()
            ]);

        }else{

            return json_encode([
                'type' => 0,
                'message' => $this->getText()
            ]);

        }
      
    }

    public function flash(string $message) : void
    {
        (new Session())->set("flash", $this);
    }

    private function filter(string $message) : string
    {
        return filter_var($message, FILTER_SANITIZE_STRIPPED);
    }
}
