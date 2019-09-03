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
    $(".open-meta-tags").on('click', function () {
        $(this).parent().parent().toggleClass('active').promise().done(function () {
            $(this).find('.meta-infos').slideToggle('fast');
        });
        $(this).toggleClass('active');
    });
})(jQuery);


