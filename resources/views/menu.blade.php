{{-- resources/views/template.blade.phpに保存 --}}
@section('menu')
<div id="menu-icon" class="menu-icon left-arrow" onclick="toggleMenu('#menu-icon','left-arrow','right-arrow','#menu-list');return false;"></div>
<div id="menu-list" class="note-list">
@foreach($noteDB as $note)
<a href="{{url('note/'.$note->id)}}">{{$note->name}}</a></br>
@endforeach
</div>
@show
