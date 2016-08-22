{{-- resources/views/template.blade.phpに保存 --}}
@section('menu')
<div id="note-icon" class="menu-icon right-arrow" onclick="toggleMenu('#note-icon','right-arrow','left-arrow','#note-list');return false;"></div>
<div id="note-list" class="note-list" style="display:none">
@foreach($noteDB as $note)
<a href="{{url('note/'.$note->id)}}">{{$note->name}}</a></br>
@endforeach
</div>
@show
