{{-- resources/views/template.blade.phpに保存 --}}
@section('adgenda')
@if($adgenda)
<div class="adgenda">
    <div id="adgenda-icon" class="adgenda-icon left-arrow" onclick="toggleMenu('#adgenda-icon','left-arrow','right-arrow','#adgenda-list');return false;"
    ></div>
    <div id="adgenda-list" class="adgenda-list" style="display:none">
        {!! $adgenda or ''!!}
    </div>
</div>
@endif
@show
