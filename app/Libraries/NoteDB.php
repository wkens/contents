<?php
namespace App\Libraries;

use App\Libraries\Object;
use App\Libraries\Note;

class Note extends Object {
    public function __construct($id,$dir,$name){
        $this->id = $id;
        $this->dir = $dir;
        $this->name = $name;
        $this->files = array();
    }
}

class NoteDB {
    
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
            $obj->setArray($note);
            $notes[$id] = &$obj;
            unset($obj);
        }
        return $notes;
    }
    
    public static function searchNotes($path, $wildCard = '*.md') {
        $notes = [];
        if(is_file(storage_path('contents/db.json'))){
            $notes = self::lodeNotes(storage_path('contents/notes.json'));
        }

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
                            $obj = new Note($hash,$folder,'');
                            $notes[$hash] = &$obj;
                        }else{
                            $obj = &$notes[$hash];
                        }
                        if(trim($obj->name)===''){
                            if(preg_match('{.*/(?<name>.*)\.md}',$leafs[0],$match)){
                                $obj->name = $match['name'];
                            }
                        }
                        $obj->files = $leafs;
                    }
                }
            }
        }
        self::saveNotes(storage_path('contents/notes.json'), $notes);
        return $notes;
    }

    public static function getNotes(){
        $contentsPath = storage_path('contents');
        $notes = self::searchNotes($contentsPath, '*.md');
        return $notes;
    }
}
