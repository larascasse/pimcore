<?php 

class Object_Data_TemplateWysiwyg {

    protected $rawText;
    protected $compiledText;

    public function __construct($rawText, $compiledText) {
        $this->rawText = $rawText;
        $this->compiledText = $compiledText;
    }

    public function setCompiledText($compiledText) {
        $this->compiledText = $compiledText;
    }

    public function getCompiledText() {
        return $this->compiledText;
    }

    public function setRawText($rawText) {
        $this->rawText = $rawText;
    }

    public function getRawText() {
        return $this->rawText;
    }


    public function __toString() {
        return $this->compiledText;
    }

}
