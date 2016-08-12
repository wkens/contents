{{-- resources/views/template.blade.phpに保存 --}}
@section('adgenda')
@if($adgenda)
<div class="adgenda">
    <div class="adgenda-icon right-arrow"></div>
    <div class="adgenda-list" style="display:none;">
        {!! $adgenda or ''!!}
    </div>
</div>
@endif
@show
