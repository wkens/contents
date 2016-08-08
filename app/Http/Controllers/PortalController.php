<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;

class PortalController extends Controller
{

    
    public function getDetail(Request $req, $cid){
        $contents = \Common::getNotesDB();
        $html = '';
        foreach($contents as $note){
            $html .= "<li>{$note->id} : {$note->dir} : {$note->name}\n";
        }
        return $html;
        // $mk = new \CustomMarkdown(0);
        // $contents = $mk->transform($sample);
        // $adgenda = $mk->getHeaderLinkHtml(3);
        // return view('contents',compact('contents','adgenda'));
    }
}
