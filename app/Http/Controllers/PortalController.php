<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PortalController extends Controller
{
    public function getIndex(Request $req){
        $sample =<<< EOD
Section 1
=====
Section 2
----
### Section 3
#### Section 4
#### Section 4
##### Section 5
###### Section 6
###### Section 6
##### Section 5
###### Section 6
###### Section 6
# Section 1
## Section 2
### Section 3
#### Section 4
#### Section 4
##### Section 5
###### Section 6
###### Section 6
##### Section 5
###### Section 6
###### Section 6

EOD;

        $mk = new \CustomMarkdown(3);
        $contents = $mk->transform($sample);
        $adgenda = '<ul><li>'.implode('<li>',array_column($mk->getLabels(),'Subject')).'</ul>';
        
        return view('contents',compact('contents','adgenda'));
    }
}
