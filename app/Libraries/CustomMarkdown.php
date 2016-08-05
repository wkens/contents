<?php

namespace App\Libraries;

use Michelf\MarkdownExtra;

class CustomMarkdown extends MarkdownExtra {
    
    protected $level = [0,0,0,0,0,0];
    protected $showLevel = 0;
    protected $labels = array();
    
    public function __construct( $showLevel = 0 ){
        parent::__construct();
        $this->level = [0,0,0,0,0,0];
        $this->showLevel = $showLevel;
        $this->labels = array();
    }
    
    public function getLabels(){
        return $this->labels;
    }
    
    protected function countHeader($level){
        $this->level[$level-1] += 1;
        for($i=$level ; $i<6 ; $i++){
            $this->level[$i] = 0;
        }
    }
    
    protected function getHeaderStr($level){
        if($level>$this->showLevel){
            return "";
        }
        $text = '';
        for($i=0 ; $i < $this->showLevel && $i < $level ; $i++){
            if($i) $text .= '.';
            $text .= "{$this->level[$i]}";
        }
        return $text;
    }
    
    protected function getHeaderId($level){
        $text = 'hid';
        for($i=0 ; $i < 6 ; $i++){
            $text .= "-{$this->level[$i]}";
        }
        return $text;
    }
    
    protected function _doHeaders_callback_setext($matches) {
		if ($matches[3] == '-' && preg_match('{^- }', $matches[1]))
			return $matches[0];

		$level = $matches[3]{0} == '=' ? 1 : 2;
        
        $this->countHeader($level);
        $headerStr = $this->getHeaderStr($level);
        $headerId = $this->getHeaderId($level);

		$defaultId = is_callable($this->header_id_func) ? call_user_func($this->header_id_func, $matches[1]) : null;
        
		$attr  = $this->doExtraAttributes("h$level", $dummy =& $matches[2], $defaultId);
		$block = "<h$level$attr id=\"{$headerId}\">{$headerStr} ".$this->runSpanGamut($matches[1])."</h$level>";
        $this->labels[$headerId] = [
            'Level' => $level,
            'ID' => $headerId,
            'Number' => $headerStr,
            'Subject' => $this->runSpanGamut($matches[1])." ({$headerId})",
        ];
        return "\n" . $this->hashBlock($block) . "\n\n";
	}
    
	protected function _doHeaders_callback_atx($matches) {
		$level = strlen($matches[1]);
        
        $this->countHeader($level);
        $headerStr = $this->getHeaderStr($level);
        $headerId = $this->getHeaderId($level);

		$defaultId = is_callable($this->header_id_func) ? call_user_func($this->header_id_func, $matches[2]) : null;
		$attr  = $this->doExtraAttributes("h$level", $dummy =& $matches[3], $defaultId);
		$block = "<h$level$attr id=\"{$headerId}\">{$headerStr} ".$this->runSpanGamut($matches[2])."</h$level>";
        $this->labels[$headerId] = [
            'Level' => $level,
            'ID' => $headerId,
            'Number' => $headerStr,
            'Subject' => $this->runSpanGamut($matches[2])." ({$headerId})",
        ];
        return "\n" . $this->hashBlock($block) . "\n\n";
	}
}
