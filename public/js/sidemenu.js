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
