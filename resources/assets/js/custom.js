$(document).ready(function(){
    $( ".action-form .action-btn" ).click(function(e) {
        e.preventDefault();
        $( "#action-block" ).toggleClass("open");
        $( "#select-wrap" ).slideToggle();
    });

    //bill-coupon toggle class fixed
    $(window).scroll(function(){
        var sticky = $('.bill-coupon'),
            scroll = $(window).scrollTop();

        if ( scroll >= 470) {
            sticky.addClass('fixed');
        } else {
            sticky.removeClass('fixed');
        }
    });

    $(window).on("resize", function () {
        var coord = $( ".for-coordinats" );
        if(coord.length) {
            var rt = coord.offset().left + coord.outerWidth();
            $(".bill-coupon").css({"left": rt + 'px'});
        }
    }).resize();

    $( "#filter-btn" ).click(function(event) {
        event.preventDefault();
        $( "#search-prov" ).addClass( "is-fixed" );
        $( ".sliding-panel-wrap" ).show();
        $( ".sliding-panel" ).animate({
            left: "0"
        }, 800);
    });

    $( ".sliding-panel .close" ).click(function(event) {
        event.preventDefault();
        $( ".sliding-panel" ).animate({
            left: "-50%"
        }, 800, function() {
            // Animation complete.
            $( "#search-prov" ).removeClass( "is-fixed" );
            $( ".sliding-panel-wrap" ).hide();
        });
    });

    $( "#slider" ).slider({
        range: true,
        min: 10,
        max: 1000,
        values: [ 200, 800 ],
        slide: function( event, ui ) {
            $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        }
    });

    $('.fancyselect').fancySelect();
});