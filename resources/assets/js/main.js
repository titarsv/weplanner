//Gridrotator initialization
$(function() {			
	$( '#ri-grid' ).gridrotator( {
		rows		: 3,
		columns		: 7,
		animType	: 'fadeInOut',
		animSpeed	: 1000,
		interval	: 1500,
		step		: 1
	} );
});

/* fixed / unfixed menu */
$(document).ready(function()
{
    var menu = $('#white-header');
    var section = $('.categories');
    var menu_y = menu.position().top;
    
    $(window).bind('resize', function()
    {
        menu_y = menu.position().top;
    });

    var window_y = 0;
    $(window).bind('ready scroll', function()
    {
        window_y = $(window).scrollTop();
        
        if (window_y < 0)
        window_y = -window_y;
        
        if (window_y >= menu_y)
        {
            menu.addClass('fixed');
            section.addClass('p-top');
        }
        else if (window_y < menu_y)
        {
            menu.removeClass('fixed');
            section.removeClass('p-top');
        }
    });
});