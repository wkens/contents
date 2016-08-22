{{-- resources/views/template.blade.phpに保存 --}}
@section('menu')
<div id="notes-icon" class="notes-icon right-arrow"
     onclick="toggleMenu('#notes-icon','right-arrow','left-arrow','#notes-list');return false;"></div>
<div id="notes-list" class="notes-list" style="display:none;">
@foreach($noteDB as $note)
<a href="{{url('note/'.$note->id)}}">{{$note->name}}</a></br>
@endforeach
</div>
@show
