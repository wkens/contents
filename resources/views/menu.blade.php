{{-- resources/views/template.blade.phpに保存 --}}
@section('menu')
<div class="menu-icon left-arrow"></div>
<div class="note-list">
@foreach($noteDB as $note)
<a href="{{url('note/'.$note->id)}}">{{$note->name}}</a></br>
@endforeach
</div>
@show
