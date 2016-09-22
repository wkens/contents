{{-- resources/views/template.blade.phpに保存 --}}
@extends('layout')
@section('title', 'contents')

@section('contents')

@include('sb-notes')
@include('sb-adgenda')

<div class="contents">
    <div class="markdown-main">
    {!! $contents or '' !!}
    </div>
</div>

@endsection
