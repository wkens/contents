<?php

namespace App\Libraries;

use Michelf\MarkdownExtra;

class CustomMarkdown extends MarkdownExtra {
    
    protected $level = [0,0,0,0,0,0];
    protected $showLevel = 0;
    protected $labels = array();
    
    public function __construct( $numberingLevel = 0 ){
        parent::__construct();
        $this->level = [0,0,0,0,0,0];
        $this->showLevel = $numberingLevel;
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

    public function getHeaderLinkHtml($showLevel = 0){
        if(!$showLevel){
            $showLevel = $this->showLevel;
        }
        $currentLevel = 0;
        $adgenda = '';
        foreach($this->getLabels() as $label){
            $level = intval($label['Level']);
            if($showLevel<$level){
                continue;
            }
            if($currentLevel < $level){
                for($i=$currentLevel ; $i<$level ; $i++){
                    $adgenda .= "<ul>\n";
                }
                $currentLevel = $level;
            }else if($currentLevel > $level){
                for($i=$currentLevel ; $i>$level ; $i--){
                    $adgenda .= "</ul>\n";
                }
                $currentLevel = $level;
            }
            $adgenda .=
                    '<li>' .
                    "<a href=\"#{$label['ID']}\">" .
                    $label['Number'] . ' ' .
                    $label['Subject'] . "</a>\n";
        }
        return $adgenda;
    }


    protected function _doHeaders_callback_numbering($matches) {
        $level = intval($matches['level']);
        $this->countHeader($level);
        $headerStr = $this->getHeaderStr($level);
        $headerId = $this->getHeaderId($level);
        
        $block =
            $matches['header'] .
            " id=\"{$headerId}\">" .
            (trim($headerStr)!==''? $headerStr . ' ' : '') .
            $matches['subject'] .
            $matches['footer'];

        $this->labels[$headerId] = [
            'Level' => $level,
            'ID' => $headerId,
            'Number' => $headerStr,
            'Subject' => $matches['subject'],
        ];

        return $block;
    }
    
    public function transform($text) {
    #
    # Main function. Performs some preprocessing on the input text
    # and pass it through the document gamut.
    #
        $text = parent::transform($text);
        $text = preg_replace_callback(
            '{
                ^(?<header><h(?<level>[123456]).*)>
                (?<subject>.*)
                (?<footer></h[123456]>)$
            }mx',
            array($this, '_doHeaders_callback_numbering'), $text);

        return $text;
    }

}
