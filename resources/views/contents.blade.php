{{-- resources/views/template.blade.phpに保存 --}}
@extends('layout')
@section('title', 'contents')

@section('contents')
<div class="notes">
    @include('notes')
</div>
@include('adgenda')
<div class="contents">
    <div class="markdown">
    {!! $contents or '' !!}
    </div>
</div>
@endsection
