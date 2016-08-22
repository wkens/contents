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
<script type="text/javascript">
function toggleMenu(iconId,closeIconClass,openIconClass,menuId){
    var icon = $(iconId);
    if(icon.hasClass(closeIconClass)){
        icon.removeClass(closeIconClass);
        icon.addClass(openIconClass);
        $(menuId).css('display','block');
    }else{
        icon.removeClass(openIconClass);
        icon.addClass(closeIconClass);
        $(menuId).css('display','none');
    }
}
</script>
@endif
@show
