/*
 * 
 * 
 * 
 */

(function($){
    /**
     * Creating the mobile menu
     * 
     */
        var droPizzaMainMenu = $('nav.main-navigation ul.nav-menu').clone(true, true);
    console.log(droPizzaMainMenu);
    $(droPizzaMainMenu).droSlidingMenu();    
})(jQuery);


