$('.navbar').on('show.bs.collapse', function () {
    var actives = $(this).find('.collapse.in'),
        hasData;
    
    if (actives && actives.length) {
        hasData = actives.data('collapse')
        if (hasData && hasData.transitioning) return
        actives.collapse('hide')
        hasData || actives.data('collapse', null)
    }
});

$(".search, input[name='search']").click(function(e){
    e.stopPropagation();
});

$(function(){
    $(".search").click(function(){
        $("input[name='search']").toggle();
        $("input[name='search']").focus();
        $(".search img").toggleClass("search-mar-left");
    });
    
    $(document).click(function(){
        $("input[name='search']").hide();
    });
});