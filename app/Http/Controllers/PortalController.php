<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\Libraries\NoteDB;

class PortalController extends Controller
{
    public function getIndex(Request $req){
        $noteDB = NoteDB::getNotes();
        $contents = null;
        $adgenda = null;
        return view('contents',compact('noteDB','contents','adgenda'));
    }
    public function getAsset(Request $req, $id=null, $item=null){
        $noteDB = NoteDB::getNotes();
        if( isset($noteDB[$id])){
            //画像のパスとファイル名
            $fpath = $noteDB[$id]->dir."/".base64_decode($item);
            $mime = \File::mimeType($fpath);
            $fname = base64_decode($item);
            $inline = preg_match('{image/(jpeg|gif|png)}',$mime);
            \Log::info("$mime, $id, $item, $fpath");

            //画像のダウンロード
            header('Content-Type: '.$mime);
            header('Content-Length: '.filesize($fpath));
            header('Content-disposition: '.($inline?'inline':'attachment').'; filename="'.$fname.'"');
            readfile($fpath);
            return null;
        }
        return \App::abort(404);
    }

    public function getShowNote(Request $req, $id=""){
        $noteDB = NoteDB::getNotes();
        $contents = null;
        $adgenda = null;
        if(isset($noteDB[$id])){
            $markdown = '';
            foreach ($noteDB[$id]->files as $file) {
                $markdown .= file_get_contents($file);
            }
            $mk = new \CustomMarkdown(3);
            $contents = $mk->transform($markdown);
            $adgenda = $mk->getHeaderLinkHtml(3);
        }
        return view('contents',compact('noteDB','contents','adgenda'));
    }

}
