<?php

namespace models;


abstract class Questions{
    protected $uuid;
    protected $label;
    public function __construct(string $uuid, string $label){
        $this->uuid = $uuid;
        $this->label = $label;
    }
    public function getUuid(){
        return $this->uuid;
    }
    public function getLabel(){
        return $this->label;
    }
    public function render(): string{
        return "<h2>".$this->label."</h2>";
    }


}

?>
