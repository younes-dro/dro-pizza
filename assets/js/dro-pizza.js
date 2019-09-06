/*
 * 
 * 
 * 
 */

(function ($) {
    /**
     * Creating the mobile menu.
     * 
     */
    var droPizzaMainMenu = $('nav.main-navigation ul.nav-menu').clone(true, true);
    console.log(droPizzaMainMenu);
    $(droPizzaMainMenu).droSlidingMenu();

    /**
     * Show/ hide meta entry (Tags , Categories).
     */
    $('.open-meta-tags').on('click', function () {
        $entryfooter = $(this).parent();
        $(this).parent().parent().toggleClass('active').promise().done(function () {
            $(this).find('.meta-infos').slideToggle('fast');
            $entryfooter.toggleClass('open');
        });
        $(this).toggleClass('active');
    });
    /**
     * Aply Blur effect when the mobile menu is opned
     */
    $('#toggle-menu, .body_overlay').on('click', function () {
        if ($(this).hasClass('open')) {
            if ($('.top-header').length) {
                $('.top-header').toggleClass('zoom-in');
            }
            $('svg, .site-branding , .site-content , .site-footer, #site-navigation').toggleClass('blured');
        } else {
            if ($('.top-header').length) {
                $('.top-header').toggleClass('zoom-in');
            }
            $('svg, .site-branding , .site-content , .site-footer, #site-navigation').toggleClass('blured');
        }
    });
})(jQuery);


