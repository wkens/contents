<?php

namespace App\Libraries;

abstract class Entry{
    private $data = array();
    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        return null;
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
        return null;
    }

    public function toArray(){
        return $this->data;
    }
    public function fromArray($data){
        $this->data = $data;
    }
}

class Note extends Entry {
    public function __construct($id,$dir,$name){
        $this->id = $id;
        $this->dir = $dir;
        $this->name = $name;
        $this->files = array();
    }
}



class Common {
    
    public static function saveNotes($file, $notes){
        $contents = [];
        foreach($notes as $id=>$obj){
            $contents[$id] = $obj->toArray();
        }
        file_put_contents(storage_path('contents/db.json'), json_encode($contents));
    }
    
    public static function lodeNotes($file){
        $notes = [];
        $contents = json_decode(file_get_contents(storage_path('contents/db.json')),true);
        foreach($contents as $id=>$note){
            $obj = new Note(0,0,0);
            $obj->fromArray($note);
            $notes[$id] = &$obj;
            unset($obj);
        }
        return $notes;
    }
    
    public static function searchNotes($path, $wildCard = '*.md') {
        $notes = [];
        if(is_file(storage_path('contents/db.json'))){
            $notes = self::lodeNotes(storage_path('contents/db.json'));
        }
        var_dump($notes);
        foreach(glob($path . "/*") as $folder) {
            if (is_dir($folder)) {
                unset($files);
                unset($leafs);
                $files = glob($folder . "/" . $wildCard);
                $leafs = [];
                if(count($files)){
                    foreach($files as $file) {
                        if (is_file($file)) {
                            $leafs[] = $file;
                        }
                    }
                    if(count($leafs)){
                        unset($obj);
                        sort($leafs);
                        $hash = md5($folder);
                        if(!isset($notes[$hash])){
                            $obj = new Note($hash,$folder,'second');
                            $notes[$hash] = &$obj;
                        }else{
                            $obj = &$notes[$hash];
                        }
                        $obj->files = $leafs;
                    }
                }
            }
        }
        self::saveNotes(storage_path('contents/db.json'), $notes);
        return $notes;
    }

    public static function getNotesDB(){
        $contentsPath = storage_path('contents');
        $notes = self::searchNotes($contentsPath, '*.md');
        return $notes;
    }
}
