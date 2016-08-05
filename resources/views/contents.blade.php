{{-- resources/views/template.blade.phpに保存 --}}
@extends('layout')
@section('title', 'contents')

@section('contents')
<div class="markdown">
{!! $contents or '' !!}
</div>
@endsection

@section('adgenda')
<div class="adgenda">
{!! $adgenda or '' !!}
</div>
@endsection
