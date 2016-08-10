{{-- resources/views/template.blade.phpに保存 --}}
@extends('layout')
@section('title', 'contents')

@section('contents')
<div class="menu">
    @include('menu')
</div>
<div class="adgenda">
    @include('adgenda')
</div>
<div class="contents">
    <div class="markdown">
    {!! $contents or '' !!}
    </div>
</div>
@endsection
