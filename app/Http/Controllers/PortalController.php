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
    public function getList(Request $req){
        $noteDB = NoteDB::getNotes();
        // $html = '';
        // foreach($noteDB as $note){
        //     $html .= "<li>{$note->id} : {$note->dir} : {$note->name}\n";
        // }
        return view('layout', compact('noteDB'));
        // $mk = new \CustomMarkdown(0);
        // $contents = $mk->transform($sample);
        // $adgenda = $mk->getHeaderLinkHtml(3);
        // return view('contents',compact('contents','adgenda'));
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
